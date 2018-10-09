<?php

namespace Products\Statistics\Controller\Result;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class Result extends \Magento\Framework\App\Action\Action
{

     /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory; 

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory
        )
    {

        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory; 
        return parent::__construct($context);
    }


    public function execute()
    {
        // $recommendation = $this->getRequest()->getParam('recommendation'); 
        $result = $this->resultJsonFactory->create();
        $resultPage = $this->resultPageFactory->create();
         /* start save database code */

        // $recommendation = $this->getRequest()->getParam('recommendation');
        $post = $this->getRequest()->getPostValue();
        $recommendation = $post['recommendation'];
        $product_id = $post['product_id'];
        $customer_id = $post['customer_id'];

        $crudObj = $this->_objectManager->create('Products\Statistics\Model\Recommendation');
        

        $crudObj->setData('recommendation',$recommendation);
        $crudObj->setData('product_id_index',$product_id);
        $crudObj->setData('sender_index',$customer_id);

        $crudObj->save();
         /* end save database code */
         
        $block = $resultPage->getLayout()
                ->createBlock('Products\Statistics\Block\Statistics')
                ->setTemplate('Products_Statistics::result.phtml')
                ->setData('recommendation',$recommendation)
                // ->setData('product_id_index',$product_id)
                // ->setData('sender_index',$customer_id)

                ->toHtml();

        $result->setData(['output' => $block]);
        return $result;
    } 
}