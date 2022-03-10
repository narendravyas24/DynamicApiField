<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Narendra\DynamicApiField\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductSearchResultsInterface;

/**
 * Class ProductAttributesLoad
 * @package Narendra\DynamicApiField\Plugin
 */
class ProductAttributesLoad
{
    /**
     * Value of custom_attribute1 extension attribute
     */
    public const VALUE_CUSTOM_ATTRIBUTE_1 = 'Value for custom attribute 1';

    /**
     * Value of custom_attribute2 extension attribute
     */
    public const VALUE_CUSTOM_ATTRIBUTE_2 = 'Value for custom attribute 2';

    /**
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $subject
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    public function afterGet
    (
        ProductRepositoryInterface $subject,
        ProductInterface $entity
    ) {
        $extensionAttributes = $entity->getExtensionAttributes(); /** get current extension attributes from entity **/
        $extensionAttributes->setCustomAttribute1(self::VALUE_CUSTOM_ATTRIBUTE_1);
        $extensionAttributes->setCustomAttribute2(self::VALUE_CUSTOM_ATTRIBUTE_2);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }

    /**
     * Add custom static attributes to product extension attributes
     *
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $subject
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResults
     */
    public function afterGetList(
        ProductRepositoryInterface $subject,
        ProductSearchResultsInterface $searchResults
    ) : ProductSearchResultsInterface {
        $products = [];
        foreach ($searchResults->getItems() as $entity) {

            $extensionAttributes = $entity->getExtensionAttributes();
            $extensionAttributes->setCustomAttribute1(self::VALUE_CUSTOM_ATTRIBUTE_1);
            $extensionAttributes->setCustomAttribute2(self::VALUE_CUSTOM_ATTRIBUTE_2);
            $entity->setExtensionAttributes($extensionAttributes);

            $products[] = $entity;
        }
        $searchResults->setItems($products);
        return $searchResults;
    }
}
