<?php

namespace Dynamic\Products\Extension;

use Dynamic\Products\Page\Product;
use Dynamic\Products\Page\ProductCategory;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;

class ProductFileCollectionDataExtension extends DataExtension
{
    /**
     * @param $object
     */
    public function updateCollectionObject(&$object)
    {
        if ($class = $this->owner->data()->ManagedClass) {
            $object = singleton((string) $class);
        }
    }

    /**
     * @param $form
     */
    public function updateCollectionForm(&$form)
    {
        $fields = $form->Fields();

        $fields->insertAfter(
            'Title',
            DropdownField::create('CategoryID', 'Category', ProductCategory::get()->map())
                ->setEmptyString('All categories')
        );

        $fields->insertAfter(
            'CategoryID',
            DropdownField::create('Products__ID', 'Product', Product::get()->map())
                ->setEmptyString('All products')
        );

        $fields->removeByName([
            'Title',
        ]);
    }

    /**
     * @param $collection
     * @param $searchCriteria
     */
    public function updateCollectionItems(&$collection, &$searchCriteria)
    {
        $class = $this->owner->data()->ManagedClass;

        if (isset($searchCriteria['CategoryID']) && $searchCriteria['CategoryID'] != '') {
            $category = ProductCategory::get()->byID($searchCriteria['CategoryID']);
            $products = $category->Products();
            $docs = new ArrayList();

            foreach ($products as $product) {
                $records = $class::get()->filter(['Products.ID' => $product->ID]);
                foreach ($records as $record) {
                    $docs->push($record);
                }
            }

            $collection = $docs;
        }
    }
}
