<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Serialize\SerializerInterface;
use HOD\Slot\Api\Data\SlotInterfaceFactory;
use HOD\Slot\Api\SlotRepositoryInterface;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var SlotRepositoryInterface
     */
    private $slotRepository;

    /**
     * @var SlotInterfaceFactory
     */
    private $SlotInterfaceFactory;

    /**
     * @var RequestInterface
     */
    private $request;
    
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Constructor
     *
     * @param Context                 $context
     * @param RequestInterface        $request
     * @param DataObjectHelper        $dataObjectHelper
     * @param SlotInterfaceFactory    $slotInterfaceFactory
     * @param SlotRepositoryInterface $slotRepository
     * @param SerializerInterface     $serializer
     */
    public function __construct(
        Context                  $context,
        RequestInterface         $request,
        DataObjectHelper         $dataObjectHelper,
        SlotInterfaceFactory     $slotInterfaceFactory,
        SlotRepositoryInterface  $slotRepository,
        SerializerInterface      $serializer
    ) {
        $this->request = $request;
        $this->slotRepository = $slotRepository;
        $this->slotInterfaceFactory = $slotInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->serializer = $serializer;
        parent::__construct($context);
    }
    
    /**
     * Excecute Function
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->request->getPostValue();
        try {
            if (isset($data['id'])) {
                $this->update($data);
                $this->messageManager->addSuccess(__('You saved Slot.'));
                return $resultRedirect->setPath('*/*/index');
            } else {
                $dataArray['start_time'] = $data['start_time'];
                $dataArray['end_time'] = $data['end_time'];
                $dataArray['week_days'] = implode(',', $data['week_days']);
                $dataArray['max_quantity'] = $data['max_quantity'];
                $slotSaveData= $this->slotInterfaceFactory->create();
                $this->dataObjectHelper->populateWithArray(
                    $slotSaveData,
                    $dataArray,
                    \HOD\Slot\Api\Data\SlotInterface::class
                );
                $this->slotRepository->save($slotSaveData);
                $slotId = $slotSaveData->getId();
                $this->messageManager->addSuccess(__('You have saved block.'));
                return $resultRedirect->setPath('*/*/index');
            }
        } catch (\Magento\Framework\Exception\ LocalizedException $e) {
            $this->messageManager->addError(__($e->getMessage()));
            return $resultRedirect->setPath('*/*/index');
        }
    }

    /**
     * Update Block information
     *
     * @param array $data
     */
    public function update($data)
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $updateArray['start_time'] = $data['start_time'];
            $updateArray['end_time'] = $data['end_time'];
            $updateArray['week_days'] = implode(',', $data['week_days']);
            $updateArray['max_quantity'] = $data['max_quantity'];
            $slotData = $this->slotRepository->getById($data['id']);
            $this->dataObjectHelper->populateWithArray(
                $slotData,
                $updateArray,
                \HOD\Slot\Api\Data\SlotInterface::class
            );
            $this->slotRepository->save($slotData);
        } catch (\Magento\Framework\Exception\ LocalizedException $e) {
            $this->messageManager->addError(__($e->getMessage()));
            return $resultRedirect->setPath('*/*/show');
        }
    }
}
