<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Model\Slot;

use Magento\Ui\DataProvider\AbstractDataProvider;
use HOD\Slot\Model\ResourceModel\Slot\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    private $slotFactory;

    /**
     * @var StoreManager
     */
    private $storeManager;

    /**
     * @var LoadData
     */
    private $loadedData;
    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $slotFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $slotFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->slotFactory = $slotFactory;
        $this->collection = $this->slotFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $basePath = $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        foreach ($items as $data) {
            $requestData = $data->getData();

            unset($requestData['week_days']);
            $requestData['week_days'] =explode(',', $data->getWeekDays());
            
            $this->loadedData[$data->getId()] = $requestData;
        }
        return $this->loadedData;
    }
}
