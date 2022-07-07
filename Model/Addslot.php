<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Model;

use Magento\Framework\Model\AbstractModel;
use HOD\Slot\Api\Data\AddslotInterface;

class Addslot extends AbstractModel implements AddslotInterface
{
    /**
     * Table name
     * Cache tag
     */
    const CACHE_TAG = 'cron_slot';

    /**
     * Initialise resource model
     */
    protected function _construct()
    {
        $this->_init(\HOD\Slot\Model\ResourceModel\Addslot::class);
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
    public function getStart()
    {
        return $this->getData(AddslotInterface::START_TIME);
    }

    /**
     * Set Start Time
     *
     * @param  string $start
     * @return $this
     */
    public function setStart($start)
    {
        return $this->setData(AddslotInterface::START, $start);
    }

    /**
     * Get End Time
     *
     * @return string
     */
    public function getEnd()
    {
        return $this->getData(AddslotInterface::END);
    }

    /**
     * Set End Time
     *
     * @param  int $end
     * @return $this
     */
    public function setEnd($end)
    {
        return $this->setData(AddslotInterface::END, $end_time);
    }
    
    /**
     * Get Max Quantity
     *
     * @return
     */
    public function getMaxQty()
    {
        return $this->getData(AddslotInterface::MAX_QTY);
    }

    /**
     * Set Max Quantity
     *
     * @param  string $max_qty
     * @return mixed
     */
    public function setMaxQty($max_qty)
    {
        return $this->setData(AddslotInterface::MAX_QTY, $max_qty);
    }
}
