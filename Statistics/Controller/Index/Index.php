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
     * @return statistics/Index/Customer
     */
    public function execute()
    {

        // $resultPage = $this->resultPageFactory->create();

        return $this->_redirect('statistics/Index/Customer');
       
        // return $resultPage;
        
    }
}