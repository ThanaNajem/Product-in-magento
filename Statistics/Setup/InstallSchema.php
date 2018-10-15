<?php 
namespace Products\Statistics\Setup;
 
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
 
class InstallSchema implements InstallSchemaInterface {
 
    public function install( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
        $installer->startSetup();
 
        /**
         *  Create table 'posts'
            public function addColumn($name, $type, $size = null, $options = [], $comment = null)
            string $name the column name - 1st argument.
            string $type the column data type - 2nd argument.
            string | int | array $size the column length - 3rd argument.
            array $options array of additional options - 4th argument.
            string $comment column description - 5th argument.
         */
        $connection = $installer->getConnection() ;
        $table = $connection->newTable(
            $installer->getTable( 'recommandation' )
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            10,
            [ 'auto_increment' => true,'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true ],
            'ID'
        )->addColumn(
            'recommandation',
            Table::TYPE_TEXT,
            255,
            [ 'nullable' => false ],
            'recommandation'
        )->addColumn(
            'sender_index',
            Table::TYPE_INTEGER, 
            10,
            [ 'nullable' => false,'unsigned' => true ],
            'sender_index'
        )->addColumn(
            'product_id_index',
            Table::TYPE_INTEGER, 
            10,
            [ 'nullable' => false,'unsigned' => true ],
            'product_id_index'
        )->setComment(
            'Statistics recommandation Table'
          )->addForeignKey(
                $installer->getFkName(
                    'recommandation_sender_table',
                    'entity_id',
                    'customer_entity',
                    'sender_index'
                ),
                'sender_index',
                $installer->getTable('customer_entity'), 
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_RESTRICT
            )->addForeignKey(
                $installer->getFkName(
                    'recommandation_product_table',
                    'entity_id',
                    'catalog_product_entity',
                    'product_id_index'
                ),
                'product_id_index',
                $installer->getTable('catalog_product_entity'), 
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_RESTRICT
            )
            ;
        
        $connection->createTable( $table );
        $installer->endSetup();
    }
}
