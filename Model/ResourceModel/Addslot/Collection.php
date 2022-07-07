<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Model\ResourceModel\Addslot;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $idFieldName = 'slot_id';

    /**
     * Collection initialisation
     */
    protected function _construct()
    {
        $this->_init(
            \HOD\Slot\Model\Addslot::class,
            \HOD\Slot\Model\ResourceModel\Addslot::class
        );
    }
}
