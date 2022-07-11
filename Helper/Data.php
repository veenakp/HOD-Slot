<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use HOD\Slot\Api\Data\AddslotInterfaceFactory;
use HOD\Slot\Api\AddslotRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;

class Data extends AbstractHelper
{
    /**
     * @var AddslotInterfaceFactory
     */
    private $addSlotInterfaceFactory;

    /**
     * @var AddslotRepositoryInterface
     */
    private $addSlotRepository;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * Constructor
     *
     * @param AddslotInterfaceFactory    $addSlotInterfaceFactory
     * @param AddslotRepositoryInterface $addSlotRepository
     * @param DataObjectHelper           $dataObjectHelper
     */
    public function __construct(
        AddslotInterfaceFactory    $addSlotInterfaceFactory,
        AddslotRepositoryInterface $addSlotRepository,
        DataObjectHelper           $dataObjectHelper
    ) {
        $this->addSlotInterfaceFactory = $addSlotInterfaceFactory;
        $this->addSlotRepository = $addSlotRepository;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * To save slot data
     *
     * @param array $data
     * @return void
     */
    public function saveSlotData(array $data)
    {
        $addSlot = $this->addSlotInterfaceFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $addSlot,
            $data,
            AddslotInterface::class
        );
        $this->addSlotRepository->save($addSlot);
    }
}
