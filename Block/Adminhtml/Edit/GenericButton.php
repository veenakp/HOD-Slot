<?php

declare(strict_types=1);
/**
 * @package HOD_Slot
 */

declare(strict_types=1);

namespace HOD\Slot\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * Constructor
     *
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }
    /**
     * Generate url by route and parameters
     *
     * @param  string $route
     * @param  array  $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
    /**
     * Get Request
     *
     * @return int|null
     */
    public function getRequest()
    {
        return $this->context->getRequest()->getParam('id');
    }
}
