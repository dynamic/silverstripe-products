<?php

namespace Dynamic\Products\Model;

use SilverStripe\Assets\File;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use Dynamic\Products\Page\Product;
use SilverStripe\Forms\GridField\GridField;
use Bummzack\SortableFile\Forms\SortableUploadField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;

/**
 * Class \Dynamic\Products\Model\ProductObject
 *
 * @property string $Title
 * @property string $Content
 * @property string $SKU
 * @method DataList|Product[] ProductPages()
 * @method ManyManyList|File[] Images()
 * @method ManyManyList|Brochure[] Brochures()
 */
class ProductObject extends DataObject
{
    /**
     * @var
     */
    private $image;

    /**
     * @var
     */
    private $has_images;

    /**
     *
     * @var string
     */
    private static $table_name = 'ProductObject';

    /**
     * @var string
     */
    private static $singular_name = 'Product';

    /**
     * @var string
     */
    private static $plural_name = 'Products';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'SKU' => 'Varchar(100)',
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'ProductPages' => Product::class,
    ];

    /**
     * @var array
     */
    private static $many_many = [
        'Images' => File::class,
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
     * The relation name was established before requests for videos.
     * The relation has subsequently been updated from Image::class to File::class
     * to allow for additional file types such as mp4
     *
     * @var array
     */
    private static $allowed_images_extensions = [
        'gif',
        'jpeg',
        'jpg',
        'png',
        'bmp',
        'ico',
        'mp4',
    ];

    /**
     *
     * @return void
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
                ->setAllowedExtensions($this->config()->get('allowed_images_extensions'))
                ->setFolderName('Uploads/Products/Images');

            $fields->addFieldsToTab('Root.Images', [
                $images,
            ]);

            if ($this->ID) {
                // Brochures
                $brochures = $fields->dataFieldByName('Brochures');
                $config = $brochures->getConfig();
                $config->addComponents([
                    new GridFieldOrderableRows('SortOrder'),
                    new GridFieldAddExistingSearchButton(),
                ])
                    ->removeComponentsByType([
                        GridFieldAddExistingAutocompleter::class,
                    ]);
            }
        });

        return parent::getCMSFields();
    }

    /**
     * @return bool
     */
    public function setImage()
    {
        if ($this->getHasImages()) {
            $this->image = $this->Images()->sort('SortOrder')->first();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        if (!$this->image) {
            $this->setImage();
        }
        return $this->image;
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

    /**
     * @return $this
     */
    public function setHasImages()
    {
        $this->has_images = $this->Images()->exists();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHasImages()
    {
        if (!$this->has_images) {
            $this->setHasImages();
        }
        return $this->has_images;
    }
}
