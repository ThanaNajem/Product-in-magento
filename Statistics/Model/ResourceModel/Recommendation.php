<?php
namespace Products\Statistics\Model\ResourceModel;
class Recommendation extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('recommandation', 'id');
    }
}