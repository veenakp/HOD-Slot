<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Api\Data;

interface AddslotInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const SLOT_ID = 'slot_id';
    const START = 'start';
    const END = 'end';
    const MAX_QTY = 'max_qty';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param  int $slot_id
     * @return SlotInterface
     */
    public function setId($slot_id);

    /**
     * Get Start Time
     *
     * @return string
     */
    public function getStart();

    /**
     * Set Start Time
     *
     * @param  string $start
     * @return mixed
     */
    public function setStart($start);

    /**
     * Get End Time
     *
     * @return string
     */
    public function getEnd();

    /**
     * Set End Time
     *
     * @param  int $end
     * @return mixed
     */
    public function setEnd($end);
    
    /**
     * Get Max Quantity
     *
     * @return mixed
     */
    public function getMaxQty();

    /**
     * Set Max Quantity
     *
     * @param  int $max_qty
     * @return mixed
     */
    public function setMaxQty($max_qty);
}
