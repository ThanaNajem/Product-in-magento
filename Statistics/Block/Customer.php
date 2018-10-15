<?php
namespace Products\Statistics\Block;
class Customer extends \Magento\Framework\View\Element\Template
{
    
    protected $_customerSession;
    protected $_productCollectionFactory;
    protected $messageManager;
    protected $product;
    protected $registry;
    protected $_categoryFactory;
    protected $_productFactory;
    protected $_productRepositoryFactory;
    protected $_storeManager;
    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Catalog\Api\ProductRepositoryInterfaceFactory $_productRepositoryFactory, \Magento\Customer\Model\Session $_customerSession, \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Catalog\Model\Product $product, \Magento\Framework\Registry $registry, \Magento\Catalog\Model\ProductFactory $productFactory, \Magento\Catalog\Model\Category $categoryFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, array $data = [])
    {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_customerSession          = $_customerSession;
        $this->messageManager            = $messageManager;
        $this->product                   = $product;
        $this->registry                  = $registry;
        $this->_categoryFactory          = $categoryFactory;
        $this->_productFactory           = $productFactory;
        $this->_productRepositoryFactory = $_productRepositoryFactory;
        $this->_storeManager             = $storeManager;
        parent::__construct($context, $data);
    }
    
    public function addSuccessMessage()
    {
        $this->messageManager->addSuccess(__('recommedation send successfully.'));
    }
    public function addErrorMessage()
    {
        $this->messageManager->addError(__('recommedation don\'t send successfully.'));
    }
    
    public function checkIfCustomerLogged()
    {
        return $this->_customerSession->isLoggedIn();
    }
    
    public function getCustomerID()
    {
        return $this->_customerSession->getCustomerId();
    }
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        // $collection->setPageSize(3); // fetching only 3 products
        return $collection;
    }
    
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
    
    public function getInfoForFixedID($product_id)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*')->load($product_id);
        return $collection;
    }
    
    public function getFixedProduct()
    {
        $product_id = $this->registry->registry('id');
 
        return $this->product->load($product_id);
    }
     public function getProductId()
    { 
        return $this->registry->registry('id');
    }
    public function getCategoryFromProductId($pid)
    {
        $product = $this->_productFactory->create()->load($pid); //->create();
        $cats    = $product->getCategoryIds(); //array
        
        if (count($cats)) {
            $firstCategoryId = $cats[0];
            $_category       = $this->_categoryFactory->load($firstCategoryId);
            return $_category->getName();
        }
    }
    //it works fine but it has row for product_id = 2;
    public function getImageFromProductId($pid)
    {
        
        $product = $this->_productRepositoryFactory->create()->getById($pid);
        return substr($product->getData('thumbnail'), 2, strlen($product->getData('thumbnail')));
        
    }
    public function getMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        
    }
}
?>