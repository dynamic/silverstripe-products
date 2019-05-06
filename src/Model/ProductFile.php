<?php

namespace Dynamic\Products\Model;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class ProductFile extends DataObject
{
    /**
     * @var array
     */
    private static $db = array(
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'FileLink' => 'Varchar(255)',
    );

    /**
     * @var array
     */
    private static $has_one = array(
        'Image' => Image::class,
        'Download' => File::class,
    );

    /**
     * @var string
     */
    private static $table_name = 'ProductFile';

    /**
     * @var array
     */
    private static $summary_fields = array(
        'Title' => 'Title',
    );

    /**
     * @var array
     */
    private static $searchable_fields = array(
        'Title',
    );

    /**
     * @var string
     */
    private static $default_sort = 'Title';

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Products',
        ]);

        $file = UploadField::create('Download')
            ->setFolderName('Uploads/ProductFiles/File')
            //->setAllowedFileCategories('doc')
        ;

        $fields->addFieldsToTab('Root.Main', array(
            $file,
            TextField::create('FileLink')
                ->setDescription('URL of external file. will display on page if no Download is specified above.')
                ->setAttribute('placeholder', 'http://'),
            ),
            'Content'
        );

        $fields->insertBefore(
            UploadField::create('Image')
                //->setFolderName('Uploads/ProductDocs/Images')
                ->setDescription('Optional preview image of file'),
            'Content'
        );

        return $fields;
    }

    /**
     * if SetClass dropdown is set, create a new instance of the new class.
     */
    public function onAfterWrite()
    {
        parent::onAfterWrite();
        if (isset($_REQUEST['SetClass'])) {
            $object = $this->newClassInstance($_REQUEST['SetClass']);
            $object->write();
        }
    }
}
