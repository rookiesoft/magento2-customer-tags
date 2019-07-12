<?php

namespace RookieSoft\CustomerTags\Ui\Component\Listing\GuestCustomer\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Action extends Column
{
    /** Url path */
    const ROW_VIEW_URL = 'customertags/guestcustomer/view';

    /** @var UrlInterface */
    protected $_urlBuilder;

    /**
     * @var string
     */
    // private $_editUrl;

    private $_viewUrl;

    // private $_editForm;

    /**
     * Constructor
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     * @param string             $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $viewUrl = self::ROW_VIEW_URL
    )
    {
        $this->_urlBuilder = $urlBuilder;
        // $this->_editUrl = $editUrl;
        $this->_viewUrl = $viewUrl;
        // $this->_editForm = $editForm;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['entity_id'])) {
                    $item[$name] = [
                        'view' => [
                            'href' => $this->_urlBuilder->getUrl(
                                $this->_viewUrl,
                                [
                                    'id' => $item['entity_id']
                                ]
                            ),
                            'label' => __('View'),
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
