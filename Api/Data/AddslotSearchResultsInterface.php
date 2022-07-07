<?php
/**
 * @package HOD_Slot
 */

declare(strict_types=1);

namespace HOD\Slot\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface AddslotSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get data list.
     *
     * @return \HOD\Slot\Api\Data\AddslotInterface[]
     */
    public function getItems();

    /**
     * Set data list.
     *
     * @param  \HOD\Slot\Api\Data\AddslotInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
