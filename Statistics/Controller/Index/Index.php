<?php
namespace Products\Statistics\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
	/** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

     /**      * @param \Magento\Framework\App\Action\Context $context   
			  * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory   

        */
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
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

        // $resultPage->getConfig()->getTitle()->prepend(__('Statistics products'));

        $customerSession = $this->_objectManager->get('Magento\Customer\Model\Session');

        if($customerSession->isLoggedIn()) 
        {

           // customer login action
             $resultPage->getConfig()->getTitle()->prepend(__('Statistics products - customer login'));
             
        $this->registry->register('current_product', 'this is a test!');
              return $this->_redirect('statistics/index/customer');
        }
        else
        {
             $resultPage->getConfig()->getTitle()->prepend(__('Statistics products - guest login'));
              return $this->_redirect('statistics/index/guest');
        }
        return $resultPage;
        
    }
}