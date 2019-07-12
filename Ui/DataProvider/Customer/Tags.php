<?php
namespace RookieSoft\CustomerTags\Ui\DataProvider\Customer;

class Tags implements \Magento\Ui\DataProvider\AddFieldToCollectionInterface
{
	public function addField(\Magento\Framework\Data\Collection $collection, $field, $alias = null)
	{
		// error_log('something');
		
		$collection->joinField(
			'tags',
			'rookiesoft_customertags_tag',
			'label',
			'id = entity_id',
			null,
			'left'
		);
	}
}