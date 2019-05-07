<?php

namespace Dynamic\Products\Page;

use Dynamic\ProductCatalog\Docs\ProductDoc;
use Dynamic\Products\Model\ProductFile;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;

class ProductFileCollection extends \Page
{
    /**
     * @var array
     */
    private static $db = array(
        'ManagedClass' => 'Varchar(255)',
    );

    /**
     * @var string
     */
    private static $table_name = 'ProductDocCollection';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($relations = ClassInfo::subclassesFor(ProductFile::class)) {
            unset($relations[ProductFile::class]);
            foreach ($relations as $key => $value) {
                $relations[$key] = singleton($value)->i18n_singular_name();
            }

            $fields->addFieldToTab(
                'Root.Main',
                DropdownField::create('ManagedClass', 'Files to display', $relations)
                    ->setEmptyString(''),
                'Content'
            );
        }

        return $fields;
    }
}
