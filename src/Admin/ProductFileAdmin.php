<?php

namespace Dynamic\ProductCatalog\Admin;

use Dynamic\ProductCatalog\Docs\CareCleaningDoc;
use Dynamic\ProductCatalog\Docs\OperationManual;
use Dynamic\ProductCatalog\Docs\SpecSheet;
use Dynamic\ProductCatalog\Docs\Warranty;
use Dynamic\ProductCatalog\ORM\CatalogProduct;
use Dynamic\Products\Model\Brochure;
use SilverStripe\Admin\ModelAdmin;

class ProductFileAdmin extends ModelAdmin
{
    /**
     * @var array
     */
    private static $managed_models = array(
        Brochure::class,
    );

    /**
     * @var string
     */
    private static $url_segment = 'product-files';

    /**
     * @var string
     */
    private static $menu_title = 'Product Files';
}
