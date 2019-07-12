<?php

namespace RookieSoft\CustomerTags\Helper\UiComponent\DataProvider;

use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\ResourceConnection;

class Tags extends AbstractDataProvider
{
    protected $_resource;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ResourceConnection $resource
     * @param CollectionFactory $tagCollection
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ResourceConnection $resource,
        CollectionFactory $tagCollection,
        array $meta = [],
        array $data = []
    ) {
        $this->_resource          = $resource;
        $this->name               = $name;
        $this->primaryFieldName   = $primaryFieldName;
        $this->requestFieldName   = $requestFieldName;

        $this->collection         = $tagCollection
            ->create();

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

    }
}