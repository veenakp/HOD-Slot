<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use HOD\Slot\Api\Data\SlotInterface;

interface SlotRepositoryInterface
{
    /**
     * Save
     *
     * @param  SlotInterface $data
     * @return mixed
     */
    public function save(SlotInterface $data);

    /**
     * Get by id
     *
     * @param  int $dataId
     * @return mixed
     */
    public function getById($dataId);

    /**
     * Get list
     *
     * @param  SearchCriteriaInterface $searchCriteria
     * @return \HOD\Slot\Api\Data\SlotSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete by id
     *
     * @param  int $dataId
     * @return mixed
     */
    public function deleteById($dataId);
}
