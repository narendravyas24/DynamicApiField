## Synopsis

This extension add two static constant attributes to product GET APis (/V1/products/:sku, /V1/products).

The example of adding extension attributes with plugin could be find in this extension

## Motivation

To demonstrate how to add extension attributes to product list and getlist REST API

### API

In order to get product or list of products by Magento API you need to do API request to appropriate service.
In Response you will see product object which returns extension attributes

### Product Repository Plugin

You can find plugin here: {extension_folder}/Plugin/ProductAttributesLoad
afterGet, afterGetList - this methods are listen ProductRepositoryInterface in order to add custom own attributes

## Installation
The extension can be installed using composer - composer require narendrav24/dynamicapifield

Enable the module by adding it the list of enabled modules in [the config](app/etc/config.php) or, if that file does not exist, installing Magento.
After including this component and enabling it, you can verify it is installed by checking
bin/magento module:status Narendra_DynamicApiField

This should say that the module is enabled.
