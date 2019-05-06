<?php

namespace Dynamic\Products\Extension;

use Dynamic\Products\Model\ProductFile;
use Dynamic\Products\Page\Product;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Dev\Debug;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\ORM\DataExtension;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;

class ProductFileDataExtension extends DataExtension
{
    /**
     * @var array
     */
    private static $belongs_many_many = array(
        'Products' => Product::class,
    );

    /**
     * @var array
     */
    private static $summary_fields = array(
        'Title' => 'Title',
        'ProductsCt' => 'Products',
    );

    /**
     * @var array
     */
    private static $searchable_fields = array(
        'Title',
        'Products.ID',
    );

    /**
     * @return int
     */
    public function getProductsCt()
    {
        if ($this->owner->Products()->exists()) {
            return $this->owner->Products()->count();
        }

        return 0;
    }

    /**
     * @return string
     */
    public function getProductsList()
    {
        $list = '';

        if ($this->owner->Products()->exists()) {
            $i = 0;
            foreach ($this->owner->Products() as $product) {
                $list .= $product->Title;
                if (++$i !== $this->owner->Products()->Count()) {
                    $list .= ', ';
                }
            }
        }

        return $list;
    }

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName(array(
            'Link',
            'SortOrder',
        ));

        $classes = ClassInfo::subclassesFor(ProductFile::class);

        unset($classes['dynamic\products\model\productfile']);

        $result = array();
        foreach ($classes as $class) {
            $instance = singleton($class);
            $pageTypeName = $instance->i18n_singular_name();
            $result[$class] = $pageTypeName;
        }

        $fields->addFieldToTab(
            'Root.Main',
            DropdownField::create('SetClass', 'File type', $result, $this->owner->Classname)
                ->setEmptyString(''),
            'Content'
        );

        $fields->dataFieldByName('Image')
            ->setFolderName('Uploads/ProductFiles/Images');

        $config = GridFieldConfig_RelationEditor::create();
        $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
        $config->addComponent(new GridFieldAddExistingSearchButton());
        $config->removeComponentsByType(GridFieldAddNewButton::class);
        $products = $this->owner->Products();
        $productsField = GridField::create('Products', 'Products', $products, $config);

        $fields->addFieldToTab('Root.Products', $productsField);
    }

    /**
     * Link for searchable result set.
     *
     * @return mixed
     */
    public function Link()
    {
        return $this->owner->Download()->URL;
    }

    /**
     * @return bool
     */
    public function getIsProductFile()
    {
        return true;
    }
}
