<?php

/**
 * Class InstallData
 *
 * @package Products\Statistics\Setup
 */
namespace Products\Statistics\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
/**
 * Class InstallData
 * @package Products\Statistics\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $sampleTemplates = ['recommandation' => 'please put latest technical phone', 'recommandation' => 'please put latest technical phone', 'recommandation' => 'please put latest technical phone'];
        /** Add root category */
        $setup->getConnection()->insert($setup->getTable('recommandation'), $sampleTemplates);
        $installer->endSetup();
    }
}