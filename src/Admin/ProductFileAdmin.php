<?php

namespace Dynamic\Products\Admin;

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
