# SilverStripe Products

A module to display a product catalog in your website. 

[![Build Status](https://travis-ci.org/dynamic/silverstripe-products.svg?branch=master)](https://travis-ci.org/dynamic/silverstripe-products)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dynamic/silverstripe-products/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dynamic/silverstripe-products/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/dynamic/silverstripe-products/badges/build.png?b=master)](https://scrutinizer-ci.com/g/dynamic/silverstripe-products/build-status/master)
[![codecov](https://codecov.io/gh/dynamic/silverstripe-products/branch/master/graph/badge.svg)](https://codecov.io/gh/dynamic/silverstripe-products)

[![Latest Stable Version](https://poser.pugx.org/dynamic/silverstripe-products/v/stable)](https://packagist.org/packages/dynamic/silverstripe-products)
[![Total Downloads](https://poser.pugx.org/dynamic/silverstripe-products/downloads)](https://packagist.org/packages/dynamic/silverstripe-products)
[![Latest Unstable Version](https://poser.pugx.org/dynamic/silverstripe-products/v/unstable)](https://packagist.org/packages/dynamic/silverstripe-products)
[![License](https://poser.pugx.org/dynamic/silverstripe-products/license)](https://packagist.org/packages/dynamic/silverstripe-products)

## Overview

Products are created as pages in your website, and can be organized by Product Categories. Product files, such as the included Brochures, can be attached to products. With the Product File Collection page, you can display a filterable list of all brochures across the system.

Instructions to create custom product files are included below.

## Requirements

* SilverStripe ^4.0
* dynamic/silverstripe-collection ^2.0
* symbiote/silverstripe-gridfieldextensions ^3.0
* bummzack/sortablefile ^2.0

## Installation

```
composer require dynamic/silverstripe-products
```

## Usage

### Upgrading to 1.1.0

Upgrading from 1.0.x to 1.1.0 will require running the following task as the Product's image upload now supports `mp4` video files for upload.

`sake dev/tasks/product-image-relation-update-task`

### Related Products

If you'd like to add the ability to include related products on a product page, you can apply the `RelatedProductsDataExtension` to `Product`.

In `config.yml`:

```
Dynamic\Products\Page\Product:
  extensions:
    - Dynamic\Products\Extension\RelatedProductsDataExtension
```

Related products can be added to any page type on your website, such as a `BlogPost`.

### Custom Product Files

SilverStripe Products includes a Brochure object, which is an example of a Product File that can be assigned to products. You can create additional product file types per the following example:

```
use Dynamic\Products\Extension\ProductFileDataExtension;

class SpecSheet extends ProductFile
{
	private static $table_name = 'SpecSheet';
	
	private static $extensions = [ProductFileDataExtension::class];
}
```

Then, create a DataExtension and apply it to `Product`. Include the relation to the new product file:

```
private static $many_many = [
	'SpecSheets' => SpecSheet::class,
];

private static $many_many_extraFields = [
	'SpecSheets' => [
		'SortOrder' => 'Int',
	]
];
```

## License

See [License](license.md)

## Maintainers
 * Dynamic <dev@dynamicagency.com>
 
## Bugtracker
Bugs are tracked in the issues section of this repository. Before submitting an issue please read over 
existing issues to ensure yours is unique. 
 
If the issue does look like a new bug:
 
 - Create a new issue
 - Describe the steps required to reproduce your issue, and the expected outcome. Unit tests, screenshots 
 and screencasts can help here.
 - Describe your environment as detailed as possible: SilverStripe version, Browser, PHP version, 
 Operating System, any installed SilverStripe modules.
 
Please report security issues to the module maintainers directly. Please don't file security issues in the bugtracker.
 
## Development and contribution
If you would like to make contributions to the module please ensure you raise a pull request and discuss with the module maintainers.
