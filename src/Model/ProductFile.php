<?php

namespace Dynamic\Products\Model;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

/**
 * Class \Dynamic\Products\Model\ProductFile
 *
 * @property string $Title
 * @property string $Content
 * @property string $FileLink
 * @property int $ImageID
 * @property int $DownloadID
 * @method Image Image()
 * @method File Download()
 */
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
     * @var array
     */
    private static $owns = [
        'Image',
        'Download',
    ];

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

        $file = UploadField::create('Download')
            ->setAllowedMaxFileNumber(1)
            ->setFolderName('Uploads/ProductFiles/File')
            ->setAllowedFileCategories('document')
            ->setDescription('Product file for download')
        ;

        $fields->addFieldsToTab(
            'Root.Main',
            [
                $file,
                TextField::create('FileLink')
                    ->setDescription('URL of external file. Will display on page if no file is specified.')
                    ->setAttribute('placeholder', 'http://'),
            ],
            'Content'
        );

        $fields->insertBefore(
            'Content',
            UploadField::create('Image')
                ->setAllowedMaxFileNumber(1)
                ->setFolderName('Uploads/ProductDocs/Images')
                ->setAllowedFileCategories('image')
                ->setDescription('Optional preview image of file')
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
