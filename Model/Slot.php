<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Model;

use Magento\Framework\Model\AbstractModel;
use HOD\Slot\Api\Data\SlotInterface;

class Slot extends AbstractModel implements SlotInterface
{
    /**
     * Table name
     * Cache tag
     */
    const CACHE_TAG = 'slot_configuration';

    /**
     * Initialise resource model
     */
    protected function _construct()
    {
        $this->_init(\HOD\Slot\Model\ResourceModel\Slot::class);
    }

    /**
     * Get cache identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get Start Time
     *
     * @return string
     */
    public function getStartTime()
    {
        return $this->getData(SlotInterface::START_TIME);
    }

    /**
     * Set Start Time
     *
     * @param  string $start_time
     * @return $this
     */
    public function setStartTime($start_time)
    {
        return $this->setData(SlotInterface::START_TIME, $start_time);
    }

    /**
     * Get End Time
     *
     * @return string
     */
    public function getEndTime()
    {
        return $this->getData(SlotInterface::END_TIME);
    }

    /**
     * Set End Time
     *
     * @param  int $end_time
     * @return $this
     */
    public function setEndTime($end_time)
    {
        return $this->setData(SlotInterface::END_TIME, $end_time);
    }
    
    /**
     * Get Week Days
     *
     * @return int
     */
    public function getWeekDays()
    {
        return $this->getData(SlotInterface::WEEK_DAYS);
    }

    /**
     * Set Week Days
     *
     * @param  int $week_days
     * @return int
     */
    public function setWeekDays($week_days)
    {
        return $this->setData(SlotInterface::WEEK_DAYS, $week_days);
    }

    /**
     * Get Max Quantity
     *
     * @return
     */
    public function getMaxQuantity()
    {
        return $this->getData(SlotInterface::MAX_QUANTITY);
    }

    /**
     * Set Max Quantity
     *
     * @param  string $max_quantity
     * @return mixed
     */
    public function setMaxQuantity($max_quantity)
    {
        return $this->setData(SlotInterface::MAX_QUANTITY, $max_quantity);
    }
}
