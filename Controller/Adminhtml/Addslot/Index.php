<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Controller\Adminhtml\Addslot;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context        $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
    /**
     * @var \Magento\Backend\Model\View\Result\Page $resultPage
     */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend(__('Slot Management'));
        return $resultPage;
    }

    /**
     * Init page
     *
     * @param  \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu('HOD_Slot::slots')
            ->addBreadcrumb(__('slots'), __('slots'))
            ->addBreadcrumb(__('slots'), __(''));
        return $resultPage;
    }

    /**
     * Authorization
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('HOD_Slot::slots');
    }
}
