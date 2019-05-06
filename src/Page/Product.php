<?php

namespace Dynamic\Products\Page;

use Bummzack\SortableFile\Forms\SortableUploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;

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
        'Code' => 'Varchar(100)',
    ];

    /**
     * @var array
     */
    private static $many_many = [
        'Images' => Image::class,
    ];

    /**
     * @var array
     */
    private static $many_many_extraFields = [
        'Images' => [
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
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            // Images tab
            $images = SortableUploadField::create('Images')
                ->setSortColumn('SortOrder')
                ->setIsMultiUpload(true)
                ->setAllowedFileCategories('image')
                ->setFolderName('Uploads/Products/Images');

            $fields->addFieldsToTab('Root.Images', [
                $images,
            ]);
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
            if ($image->ImageID > 0) {
                return $image->Image();
            }
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function Image()
    {
        return $this->getImage();
    }

    /**
     * @return mixed
     */
    public function Thumbnail()
    {
        if ($image = $this->getImage()) {
            if ($thumb = Image::get()->byID($image->ID)) {
                return $thumb->CMSThumbnail();
            }
        }

        return false;
    }
}
