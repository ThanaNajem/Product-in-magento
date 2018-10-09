<?php
namespace Products\Statistics\Model\ResourceModel\Recommendation;
/**
* Subscription Collection
*/
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
/**
* Initialize resource collection
*
* @return void
*/
public function _construct() {
   $this->_init('Products\Statistics\Model\Recommendation','Products\Statistics\Model\ResourceModel\Recommendation');
}
}