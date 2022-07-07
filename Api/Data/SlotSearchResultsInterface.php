<?php
/**
 * @package HOD_Slot
 */

declare(strict_types=1);

namespace HOD\Slot\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface SlotSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get data list.
     *
     * @return \HOD\Slot\Api\Data\SlotInterface[]
     */
    public function getItems();

    /**
     * Set data list.
     *
     * @param  \HOD\Slot\Api\Data\SlotInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
