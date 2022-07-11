<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Cron;

use HOD\Slot\Model\ResourceModel\Slot\CollectionFactory;
use HOD\Slot\Helper\Data;

class Test
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var Data
     */
    private $helper;

    /**
     * Constructor
     *
     * @param CollectionFactory         $collectionFactory
     * @param Data                      $helper
     */
    public function __construct(
        CollectionFactory         $collectionFactory,
        Data                      $helper
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->helper = $helper;
    }
    
    /**
     * Execute cron
     *
     * @return void
     */
    public function execute()
    {
        $currentTime = date('Y-m-d H:i:00');
        $day = date('l');
        $logger->info(print_r('Cuurent Time: '.$currentTime, true));
        $collection = $this->collectionFactory->create();
        foreach ($collection as $slotItems) {
            $weekday = explode(',', $slotItems->getWeekDays());
            $startTime = $slotItems->getStartTime();
            $endTime = $slotItems->getEndTime();
            $logger->info(print_r('Start Time: '.$startTime, true));
            $logger->info(print_r('End Time: '.$endTime, true));
            if ($currentTime > $startTime && $currentTime < $endTime) {
                $logger->info(print_r('Slot is available', true));
                if (in_array($day, $weekday)) {
                    $logger->info(print_r('Slot is available on '.$day, true));
                    $dataArray['start'] = $slotItems->getStartTime();
                    $dataArray['end'] = $slotItems->getEndTime();
                    $dataArray['max_qty'] = $slotItems->getMaxQuantity();
                    $this->helper->saveSlotData($dataArray);
                }
            }
        }
        return $this;
    }
}
