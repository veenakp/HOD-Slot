<?php
/**
 * @package HOD_slot
 */

declare(strict_types=1);

namespace HOD\Slot\Block\Adminhtml\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Slot  Admin Edit Back Button
 */
class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('config/index/index')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}
