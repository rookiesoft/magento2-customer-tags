<?php
namespace RookieSoft\CustomerTags\Ui\DataProvider\Customer;
class TagsFilter implements \Magento\Ui\DataProvider\AddFilterToCollectionInterface
{
	public function addFilter(\Magento\Framework\Data\Collection $collection, $field, $condition = null)
	{
		error_log("something");
		if(isset($condition['like']))
		{
			$collection->addFieldToFilter($field, $condition);
		}
	}
}