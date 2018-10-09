<?php
namespace Products\Statistics\Block;
class Customer extends \Magento\Framework\View\Element\Template
{    
    protected $_productCollectionFactory;
    protected $_productRepositoryFactory;    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,        
        array $data = [] 
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;   
        parent::__construct($context, $data);
    }
    
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        // $collection->setPageSize(3); // fetching only 3 products
        return $collection;
    }
    public function getProductImage()
    {

    $productId = 4;
    $objectManagerProd = \Magento\Framework\App\ObjectManager::getInstance(); 
    $currentproduct = $objectManagerProd->create('Magento\Catalog\Model\Product')->load($productId);
    $images = $currentproduct->getImage();
    return $images;
 

    }
     public function getAllProducts()
    {
 
    $objectManagerProd = \Magento\Framework\App\ObjectManager::getInstance(); 
    $currentproduct = $objectManagerProd->create('Magento\Catalog\Model\Product');
    
    return $currentproduct;
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
    
    }
?>