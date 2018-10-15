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
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;
    
    protected $crudObj;
    
    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Products\Statistics\Model\Recommendation $crudObj)
    {
        
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->crudObj           = $crudObj;
        return parent::__construct($context);
    }
    
    
    public function execute()
    {
        
        // $resultPage = $this->resultPageFactory->create(); 
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        
        /* get ajax's request data*/
        $recommendation = $this->getRequest()->getParam('recommendation');
        $product_id     = $this->getRequest()->getParam('product_id');
        $customer_id    = $this->getRequest()->getParam('customer_id');
        /* check if ajax's request data isn't empty */
        if (!empty($recommendation) && !empty($product_id) && !empty($customer_id)) {
            
            // $crudObj = $this->_objectManager->create('Products\Statistics\Model\Recommendation');
            return $this->saveRecommendationIntoDatabaseRecord($recommendation, $product_id, $customer_id);
            
        }
        
        
    }
    
    public function saveRecommendationIntoDatabaseRecord($recommendation, $product_id, $customer_id)
    {
        try {
            $resultJson = $this->resultJsonFactory->create();
            $response   = array();
            $this->crudObj->setData('recommandation', $recommendation);
            $this->crudObj->setData('product_id_index', $product_id);
            $this->crudObj->setData('sender_index', $customer_id);
            
            
            if ($this->crudObj->save()) {
                $response = array(
                    "status" => "success"
                );
            } else {
                
                $response = array(
                    "status" => "fail"
                );
            }
            
            $resultJson->setData($response);
        }
        catch (\Exception $e) {
            
            $this->logger->critical($e->getMessage());
            
        }
        return $resultJson;
    }
}