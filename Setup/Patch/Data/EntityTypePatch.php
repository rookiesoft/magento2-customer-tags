<?php
namespace RookieSoft\CustomerTags\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use RookieSoft\CustomerTags\Model\EntityTypeFactory;

class EntityTypePatch implements DataPatchInterface
{
    public  function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EntityTypeFactory $entityTypeFactory
    ) {
        $this->moduleDataSetup   = $moduleDataSetup;
        $this->entityTypeFactory = $entityTypeFactory;  
    }

    /**
     * apply
     * @return void patch to set defaults for rookiesoft_customertags_guest_customer;
     */
    public function apply()
    {
        $this->entityTypeFactory
            ->create()
            ->setData([
                'code'      => 'guest',
                'type_name' => 'Guests',
                'reference' => 'rookiesoft_customertags_guest_customer'
            ])
            ->save();
        $this->entityTypeFactory
            ->create()
            ->setData([
                'code'      => 'customer',
                'type_name' => 'Customer',
                'reference' => 'customer_entity'
            ])
            ->save();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
