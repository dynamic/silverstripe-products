<?php

namespace Dynamic\Products\Page;

use SilverStripe\Forms\FieldList;
use Dynamic\Products\Model\ProductObject;
use SilverShop\HasOneField\HasOneButtonField;

/**
 * Class \Dynamic\Products\Page\Product
 *
 * @property int $ProductID
 * @method ProductObject Product()
 */
class Product extends \Page
{
    /**
     * @var string
     */
    private static $table_name = 'Product';

    /**
     * @var string
     */
    private static $singular_name = 'Product Page';

    /**
     * @var string
     */
    private static $plural_name = 'Product Pages';

    /**
     *
     * @var array
     */
    private static $has_one = [
        'Product' => ProductObject::class,
    ];

    /**
     * @var array
     */
    private static $allowed_children = [];

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->addFieldToTab(
                'Root.Main',
                HasOneButtonField::create(
                    $this->owner,
                    'Product',
                    ''
                )
            );
        });

        return parent::getCMSFields();
    }

    /**
     * @return bool|ProductCategory
     */
    public function getCategory()
    {
        if (!$this->owner->ParentID) {
            return false;
        }
        /** @var ProductCategory $parent */
        $parent = $this->owner->Parent();
        if (!$parent instanceof ProductCategory) {
            return false;
        }

        return $parent;
    }

    /**
     * @return string
     */
    public function getCategoryTitle()
    {
        if ($this->getCategory()) {
            return $this->getCategory()->Title;
        }
    }
}
