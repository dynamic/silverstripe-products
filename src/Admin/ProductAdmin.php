<?php

namespace Dynamic\Products\Admin;

use Dynamic\Products\Model\Brochure;
use Dynamic\Products\Model\ProductObject;
use SilverStripe\Admin\ModelAdmin;

/**
 * Class \Dynamic\Products\Admin\ProductFileAdmin
 *
 */
class ProductAdmin extends ModelAdmin
{
    /**
     * @var array
     */
    private static $managed_models = array(
        ProductObject::class,
        Brochure::class,
    );

    /**
     * @var string
     */
    private static $url_segment = 'products';

    /**
     * @var string
     */
    private static $menu_title = 'Products';
}
