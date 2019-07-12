<?php

namespace RookieSoft\CustomerTags\Ui\Component\Listing\GuestCustomer\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;

class Sales extends \Magento\Ui\Component\Listing\Columns\Column
{

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param PriceCurrencyInterface $priceFormatter
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        PriceCurrencyInterface $priceFormatter,
        array $components = [],
        array $data = []
    ) {
        $this->priceFormatter = $priceFormatter;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * prepareDataSource
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

        if(isset($dataSource['data']['items'])) {
            foreach($dataSource['data']['items'] as &$items) {
                $currencyCode = isset($item['order_currency_code']) ? $item['order_currency_code'] : null;
                
                $items['sales'] = $price = $this->priceFormatter->format(
                    $items['base_grand_total'],
                    false,
                    null,
                    null,
                    $currencyCode
                );
            }
        }
        return $dataSource;
    }
}
