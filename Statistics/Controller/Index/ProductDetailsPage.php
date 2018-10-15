<?php
namespace Products\Statistics\Controller\Index;
class ProductDetailsPage extends \Magento\Framework\App\Action\Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;
    protected $registry;
    /**      * @param \Magento\Framework\App\Action\Context $context   
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory   
     
     */
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Registry $registry)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->registry          = $registry;
        parent::__construct($context);
    }
    /**
     * Statistics Index, shows a list of recent Statistics products.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        
        $resultPage = $this->resultPageFactory->create();
        
        $product_id = $this->getRequest()->getParam('id'); 
        $this->registry->register('id', $product_id);
        
        return $resultPage;
        
    }
}