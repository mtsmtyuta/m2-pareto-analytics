<?php

namespace Veriteworks\ParetoAnalytics\Controller\Adminhtml\Manage;

use Magento\Store\Api\StoreRepositoryInterface;
use \Veriteworks\ParetoAnalytics\Api\CalendarRepositoryInterface;
use \Veriteworks\ParetoAnalytics\Model\ResourceModel\Pareto\CollectionFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Veriteworks\ParetoAnalytics\Model\ParetoFactory;

/**
 * Class Refresh
 * @package Veriteworks\Calendar\Controller\Adminhtml\Manage
 */
class Refresh extends \Magento\Backend\App\Action
{

    private $calendarRepository;
    /**
     * @var CalendarFactory
     */
    private $calendarFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var \Magento\Store\Model\App\Emulation
     */
    private $appEmulation;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var DateTime
     */
    private $dateTime;
    /**
     * @var \Magento\Framework\Locale\ResolverInterface
     */
    private $locale;
    /**
     * @var \Veriteworks\Calendar\Helper\Data
     */
    private $helper;


    /**
     * Refresh constructor.
     * @param \Veriteworks\Calendar\Helper\Data $helper
     * @param StoreRepositoryInterface $storeRepository
     * @param CalendarRepositoryInterface $calendarRepository
     * @param CalendarFactory $calendarFactory
     * @param CollectionFactory $collectionFactory
     * @param DateTime $dateTime
     * @param \Magento\Store\Model\App\Emulation $appEmulation
     * @param ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Locale\ResolverInterface $localeResolver
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Veriteworks\Calendar\Helper\Data $helper,
        StoreRepositoryInterface $storeRepository,
        CalendarRepositoryInterface $calendarRepository,
        CalendarFactory $calendarFactory,
        CollectionFactory $collectionFactory,
        DateTime $dateTime,
        \Magento\Store\Model\App\Emulation $appEmulation,
        ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Locale\ResolverInterface $localeResolver,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->helper = $helper;
        $this->storeRepository = $storeRepository;
        $this->calendarRepository = $calendarRepository;
        $this->calendarFactory = $calendarFactory;
        $this->collectionFactory = $collectionFactory;
        $this->dateTime = $dateTime;
        $this->appEmulation = $appEmulation;
        $this->scopeConfig = $scopeConfig;
        $this->locale = $localeResolver;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {

        $stores = $this->storeRepository->getList();

        foreach ($stores as $store) {

            if ($store->getId() == 0) {
                continue;
            }

            try {

                $this->resetHoliday();
                $this->messageManager->addSuccess(__('Date has been successfully refreshed.'));

            } catch (\Exception $e) {
                $this->messageManager->addError(__($e->getMessage()));
            }

            $this->_redirect('*/*/index');
        }
    }


    /**
     *
     */
    protected function resetHoliday()
    {
        $collection = $this->collectionFactory->create()->load();
        $holidayList = $this->getHolidayList();

        foreach ($collection as $day) {

            $day->setIsHoliday(false);
            $day->setDayComment(null);


            if($this->helper->isWeekEnd($day->getDay())){
                $day->setIsHoliday(true);
            }

            if (array_key_exists($day->getDay(), $holidayList)) {
                $day->setIsHoliday(true);
                $day->setDayComment($holidayList[$day->getDay()]);
            }

            $day->save();
        }
    }


    /**
     * To get Holidaylist for 2years
     * @return array
     * @throws \ReflectionException
     */
    protected function getHolidayList()
    {
        $year = (int)$this->dateTime->gmtDate('Y');

        $holiday_array = $this->helper->getHolidayList($year);
        $holiday_array += $this->helper->getHolidayList($year + 1);

        return $holiday_array;
    }

}