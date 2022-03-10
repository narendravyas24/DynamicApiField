## Synopsis

This extension add two static constant attributes to product GET APis (/V1/products/:sku, /V1/products).

The example of adding extension attributes with plugin could be find in this extension

The list of feeds can be accessed at the following url:

## Motivation

To demonstrate how to add extension attributes to product or to list of products

## Technical features

### API

In order to get product or list of products by Magento API you need to do API request to appropriate service.
In Response you will see product object with described extension attributes
You can find them by path, introduced below

### Product Repository Plugin

You can find plugin here: {extension_folder}/Plugin/ProductAttributesLoad
afterGet, afterGetList - this methods are listen ProductRepositoryInterface in order to add there own attributes

## Installation

Enable the module by adding it the list of enabled modules in [the config](app/etc/config.php) or, if that file does not exist, installing Magento.
After including this component and enabling it, you can verify it is installed by checking
bin/magento module:status Adobe_DynamicApiField

This should say that the module is enabled.
