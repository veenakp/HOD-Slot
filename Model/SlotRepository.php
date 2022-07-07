<?php
/**
 * @package HOD_Slot
 */

declare(strict_types=1);

namespace HOD\Slot\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use HOD\Slot\Api\Data\SlotSearchResultsInterfaceFactory;
use HOD\Slot\Model\ResourceModel\Slot\CollectionFactory;
use HOD\Slot\Model\SlotFactory;
use HOD\Slot\Api\Data\SlotInterface;
use HOD\Slot\Model\ResourceModel\Slot;
use HOD\Slot\Api\Data\SlotInterfaceFactory;

class SlotRepository implements \HOD\Slot\Api\SlotRepositoryInterface
{
    /**
     * @var slotFactory
     */
    private $slotFactory;

    /**
     * @var ResourceModel\Slot
     */
    private $slotResource;

    /**
     * @var \HOD\Slot\Api\Data\SlotInterfaceFactory
     */
    private $slotDataFactory;

    /**
     * @var \Magento\Framework\Api\ExtensibleDataObjectConverter
     */
    private $dataObjectConverter;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;
    
    /**
     * @var DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * @var SlotSearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * SlotRepository constructor.
     *
     * @param SlotFactory                       $slotFactory
     * @param Slot                              $slotResource
     * @param SlotInterfaceFactory              $slotkDataFactory
     * @param ExtensibleDataObjectConverter     $dataObjectConverter
     * @param DataObjectHelper                  $dataObjectHelper
     * @param SlotSearchResultsInterfaceFactory $searchResultFactory
     * @param DataObjectProcessor               $dataObjectProcessor
     * @param CollectionProcessorInterface      $collectionProcessor
     * @param CollectionFactory                 $collectionFactory
     */
    public function __construct(
        SlotFactory $slotFactory,
        Slot $slotResource,
        SlotInterfaceFactory $slotDataFactory,
        ExtensibleDataObjectConverter $dataObjectConverter,
        DataObjectHelper $dataObjectHelper,
        SlotSearchResultsInterfaceFactory $searchResultFactory,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory
    ) {
        $this->slotFactory = $slotFactory;
        $this->slotResource = $slotResource;
        $this->slotDataFactory = $slotDataFactory;
        $this->dataObjectConverter = $dataObjectConverter;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->searchResultFactory = $searchResultFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Save Slot data
     *
     * @param  int $id
     * @return SlotInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id)
    {
        $slotObj = $this->slotFactory->create();
        $this->slotResource->load($slotObj, $id);
        if (!$slotObj->getId()) {
            throw new NoSuchEntityException(__('Item with id "%1" does not exist.', $id));
        }
        $data = $this->slotDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $data,
            $slotObj->getData(),
            SlotInterface::class
        );
        $data->setId($slotObj->getId());

        return $data;
    }

    /**
     * Save slot Data
     *
     * @param  SlotInterface $slot
     * @return SlotInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(SlotInterface $slot)
    {
        try {
            /**
             * @var SlotInterface|\Magento\Framework\Model\AbstractModel $data
            */
            $this->slotResource ->save($slot);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __(
                    'Could not save the data: %1',
                    $exception->getMessage()
                )
            );
        }
        return $slot;
    }

    /**
     * Delete the Slot by  id
     *
     * @param  int $slotId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($slotId)
    {
        $slotObj = $this->slotFactory->create();
        $this->slotResource->load($slotObj, $slotId);
        $this->slotResource->delete($slotObj);
        if ($slotObj->isDeleted()) {
            return true;
        }
        return false;
    }

    /**
     * GetList
     *
     * @param  SearchCriteriaInterface $searchCriteria
     * @return \HOD\Slot\Api\Data\SlotSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
