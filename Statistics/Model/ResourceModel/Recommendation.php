<?php
namespace Products\Statistics\Model\ResourceModel;
class Crud extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
		public function _construct() {
		$this->_init('recommendation','id');
		}
}