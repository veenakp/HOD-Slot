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
use HOD\Slot\Api\Data\AddslotSearchResultsInterfaceFactory;
use HOD\Slot\Model\ResourceModel\Addslot\CollectionFactory;
use HOD\Slot\Model\AddslotFactory;
use HOD\Slot\Api\Data\AddslotInterface;
use HOD\Slot\Model\ResourceModel\Addslot;
use HOD\Slot\Api\Data\addslotInterfaceFactory;

class AddslotRepository implements \HOD\Slot\Api\AddslotRepositoryInterface
{
    /**
     * @var addslotFactory
     */
    private $addslotFactory;

    /**
     * @var ResourceModel\Addslot
     */
    private $addslotResource;

    /**
     * @var \HOD\Slot\Api\Data\AddslotInterfaceFactory
     */
    private $addslotDataFactory;

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
     * @var addslotSearchResultsInterfaceFactory
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
     * @param AddslotFactory                       $addslotFactory
     * @param Addslot                              $addslotResource
     * @param AddslotInterfaceFactory              $addslotkDataFactory
     * @param ExtensibleDataObjectConverter        $dataObjectConverter
     * @param DataObjectHelper                     $dataObjectHelper
     * @param AddslotSearchResultsInterfaceFactory $searchResultFactory
     * @param DataObjectProcessor                  $dataObjectProcessor
     * @param CollectionProcessorInterface         $collectionProcessor
     * @param CollectionFactory                    $collectionFactory
     */
    public function __construct(
        AddslotFactory $addslotFactory,
        Addslot $addslotResource,
        AddslotInterfaceFactory $addslotDataFactory,
        ExtensibleDataObjectConverter $dataObjectConverter,
        DataObjectHelper $dataObjectHelper,
        AddslotSearchResultsInterfaceFactory $searchResultFactory,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory
    ) {
        $this->addslotFactory = $addslotFactory;
        $this->addslotResource = $addslotResource;
        $this->addslotDataFactory = $addslotDataFactory;
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
     * @param  int $slot_id
     * @return AddslotInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($slot_id)
    {
        $addslotObj = $this->addslotFactory->create();
        $this->addslotResource->load($addslotObj, $slot_id);
        if (!$addslotObj->getId()) {
            throw new NoSuchEntityException(__('Item with id "%1" does not exist.', $slot_id));
        }
        $data = $this->addslotDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $data,
            $addslotObj->getData(),
            AddslotInterface::class
        );
        $data->setId($addslotObj->getId());

        return $data;
    }

    /**
     * Save slot Data
     *
     * @param  AddslotInterface $addslot
     * @return AddslotInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(AddslotInterface $addslot)
    {
        try {
            /**
             * @var AddslotInterface|\Magento\Framework\Model\AbstractModel $data
            */
            $this->addslotResource ->save($addslot);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __(
                    'Could not save the data: %1',
                    $exception->getMessage()
                )
            );
        }
        return $addslot;
    }

    /**
     * Delete the Slot by  id
     *
     * @param  int $addslotId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($addslotId)
    {
        $addslotObj = $this->addslotFactory->create();
        $this->addslotResource->load($addslotObj, $addslotId);
        $this->addslotResource->delete($addslotObj);
        if ($addslotObj->isDeleted()) {
            return true;
        }
        return false;
    }

    /**
     * GetList
     *
     * @param  SearchCriteriaInterface $searchCriteria
     * @return \HOD\Slot\Api\Data\AddslotSearchResultsInterface
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
