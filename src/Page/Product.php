<?php

namespace Dynamic\Products\Page;

use Bummzack\SortableFile\Forms\SortableUploadField;
use Dynamic\Products\Model\Brochure;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\TextField;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class Product extends \Page
{
    /**
     * @var string
     */
    private static $table_name = 'Product';

    /**
     * @var array
     */
    private static $db = [
        'SKU' => 'Varchar(100)',
    ];

    /**
     * @var array
     */
    private static $many_many = [
        'Images' => Image::class,
        'Brochures' => Brochure::class,
    ];

    /**
     * @var array
     */
    private static $many_many_extraFields = [
        'Images' => [
            'SortOrder' => 'Int',
        ],
        'Brochures' => [
            'SortOrder' => 'Int',
        ],
    ];

    /**
     *
     */
    private static $owns = [
        'Images',
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
            $fields->insertBefore(
                'Content',
                TextField::create('SKU', 'Product SKU')
            );

            // Images tab
            $images = SortableUploadField::create('Images')
                ->setSortColumn('SortOrder')
                ->setIsMultiUpload(true)
                ->setAllowedFileCategories('image')
                ->setFolderName('Uploads/Products/Images');

            $fields->addFieldsToTab('Root.Images', [
                $images,
            ]);

            if ($this->ID) {
                // Brochures
                $config = GridFieldConfig_RecordEditor::create();
                $config->addComponents([
                    new GridFieldOrderableRows('SortOrder'),
                    new GridFieldAddExistingSearchButton()
                ])
                    ->removeComponentsByType([
                        GridFieldAddExistingAutocompleter::class
                    ]);

                $brochures = GridField::create(
                    'Brochures',
                    'Brochures',
                    $this->Brochures()->sort('SortOrder'),
                    $config
                );
                $fields->addFieldsToTab('Root.Files.Brochures', array(
                    $brochures,
                ));
            }
        });

        return parent::getCMSFields();
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        if ($this->Images()->exists()) {
            $image = $this->Images()->first();
            return $image;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        if ($image = $this->getImage()) {
            if ($thumb = Image::get()->byID($image->ID)) {
                return $thumb->CMSThumbnail();
            }
        }

        return false;
    }
}
