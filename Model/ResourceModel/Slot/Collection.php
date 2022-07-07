<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Model\ResourceModel\Slot;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $idFieldName = 'id';

    /**
     * Collection initialisation
     */
    protected function _construct()
    {
        $this->_init(
            \HOD\Slot\Model\Slot::class,
            \HOD\Slot\Model\ResourceModel\Slot::class
        );
    }
}
