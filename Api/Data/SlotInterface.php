<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Api\Data;

interface SlotInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'id';
    const START_TIME = 'start_time';
    const END_TIME = 'end_time';
    const WEEK_DAYS = 'week_days';
    const MAX_QUANTITY = 'max_quantiy';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param  int $id
     * @return SlotInterface
     */
    public function setId($id);

    /**
     * Get Start Time
     *
     * @return string
     */
    public function getStartTime();

    /**
     * Set Start Time
     *
     * @param  string $start_time
     * @return mixed
     */
    public function setStartTime($start_time);

    /**
     * Get End Time
     *
     * @return string
     */
    public function getEndTime();

    /**
     * Set End Time
     *
     * @param  int $end_time
     * @return mixed
     */
    public function setEndTime($end_time);
    
    /**
     * Get Week Days
     *
     * @return int
     */
    public function getweekDays();

    /**
     * Set Week Days
     *
     * @param  string $week_days
     * @return string
     */
    public function setWeekDays($week_days);

    /**
     * Get Max Quantity
     *
     * @return mixed
     */
    public function getMaxQuantity();

    /**
     * Set Max Quantity
     *
     * @param  int $max_quantity
     * @return mixed
     */
    public function setMaxQuantity($max_quantity);
}
