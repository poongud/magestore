<?php
namespace Hiddentechies\Bizkick\Plugin;

use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\DataType\Number;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Catalog\Api\Data\ProductAttributeInterface;

class AdvancedPricing
{

    protected $arrayManager;

    public function __construct(
        ArrayManager $arrayManager
    ) {
        
        $this->arrayManager = $arrayManager;
    }

    public function afterModifyMeta(
        \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AdvancedPricing $subject,
        $result
    ) {
        $meta = $result;
        $meta['advanced_pricing_modal']['children']['advanced-pricing']['children']['tier_price']['children']['record']['children']['price_mrp'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'formElement' => Input::NAME,
                        'componentType' => Field::NAME,
                        'dataType' => Number::NAME,
                        'label' => __('MRP (AMT/%)'),
                        'dataScope' => 'price_mrp',
                        'sortOrder' => 35,
                        'validation' => [
                            'required-entry' => true,
                            'validate-greater-than-zero' => true,
                            'validate-digits' => false,
                            'validate-number' => true,
                        ],
                    ],
                ],
            ],
        ];
        return $meta;
    }
}
