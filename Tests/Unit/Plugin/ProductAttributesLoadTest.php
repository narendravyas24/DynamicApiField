<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Narendra\DynamicApiField\Tests\Unit\Plugin;

use Magento\Catalog\Api\Data\ProductExtensionFactory;
use Magento\Catalog\Api\Data\ProductExtensionInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Narendra\DynamicApiField\Plugin\ProductAttributesLoad;

class ProductAttributesLoadTest extends TestCase
{
    /**
     * Value of custom_attribute1 extension attribute
     */
    public const VALUE_CUSTOM_ATTRIBUTE_1 = 'Value for custom attribute 1.';

    /**
     * Value of custom_attribute2 extension attribute
     */
    public const VALUE_CUSTOM_ATTRIBUTE_2 = 'Value for custom attribute 2.';

    /**
     * @var ProductAttributesLoad
     */
    private ProductAttributesLoad $repository;

    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $subject;

    /**
     * @var ProductExtensionInterface
     */
    private ProductExtensionInterface $productExtensionAttributes;

    /**
     * @var ProductInterface
     */
    private ProductInterface $product;

    public function setUp(): void
    {
        $productExtensionFactory = $this->getMockBuilder(ProductExtensionFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->product = $this->createMock(ProductInterface::class);
        $this->productExtensionAttributes = $this->createMock(ProductExtensionInterface::class);
        $this->subject = $this->createMock(ProductRepositoryInterface::class);

        $this->repository = new ProductAttributesLoad(
            $productExtensionFactory
        );
    }

    public function testAfterGet()
    {
        $this->product->expects($this->once())
            ->method("getExtensionAttributes")
            ->willReturn($this->productExtensionAttributes);
        $this->productExtensionAttributes->expects($this->exactly(1))
            ->method("setCustomAttribute1")
            ->with(self::VALUE_CUSTOM_ATTRIBUTE_1);
        $this->productExtensionAttributes->expects($this->exactly(1))
            ->method("setCustomAttribute2")
            ->with(self::VALUE_CUSTOM_ATTRIBUTE_2);
        $this->repository->afterGet($this->subject, $this->product);
    }

    public function testAfterGetList()
    {
        $searchResult = $this->getMockBuilder(\Magento\Catalog\Api\Data\ProductSearchResultsInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $searchResult->expects($this->once())
            ->method("getItems")
            ->willReturn([$this->product]);
        $this->product->expects($this->once())
            ->method("getExtensionAttributes")
            ->willReturn($this->productExtensionAttributes);
        $this->productExtensionAttributes->expects($this->exactly(1))
            ->method("setCustomAttribute1")
            ->with(self::VALUE_CUSTOM_ATTRIBUTE_1);
        $this->productExtensionAttributes->expects($this->exactly(1))
            ->method("setCustomAttribute2")
            ->with(self::VALUE_CUSTOM_ATTRIBUTE_2);
        $this->product->expects($this->once())
            ->method("setExtensionAttributes")
            ->with($this->productExtensionAttributes);

        $this->repository->afterGetList($this->subject, $searchResult);
    }
}
