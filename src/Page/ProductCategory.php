<?php

namespace Dynamic\Products\Page;

use SilverStripe\CMS\Model\RedirectorPage;
use SilverStripe\CMS\Model\VirtualPage;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\NumericField;
use SilverStripe\Security\Security;

/**
 * Class \Dynamic\Products\Page\ProductCategory
 *
 * @property int $ProductsPerPage
 */
class ProductCategory extends \Page
{
    /**
     * @var array
     */
    private static $db = [
        'ProductsPerPage' => 'Int',
    ];

    /**
     * @var array
     */
    private static $defaults = [
        'ProductsPerPage' => 12,
    ];

    /**
     * @var string
     */
    private static $table_name = 'ProductCategory';

    /**
     * @var array
     */
    private static $allowed_children = [
        ProductCategory::class,
        Product::class,
        RedirectorPage::class,
        VirtualPage::class,
    ];

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->addFieldToTab(
                'Root.Main',
                NumericField::create('ProductsPerPage')
                    ->setTitle(_t(__CLASS__ . '.ProductsPerPage', 'Products Per Page')),
                'Content'
            );
        });

        return parent::getCMSFields();
    }

    /**
     * @return mixed
     */
    public function getProductList()
    {
        $products = Product::get()
            ->filter([
                'ParentID' => $this->data()->ID,
                'Product.ID:GreaterThan' => 0,
            ]);

        $this->extend('updateProductList', $products, $categories);

        $products = $products->filterByCallback(function ($page) {
            return $page->canView(Security::getCurrentUser());
        });

        return $products;
    }
}
