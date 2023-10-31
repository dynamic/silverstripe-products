<?php

namespace Dynamic\Products\Model;

use Dynamic\Products\Extension\ProductFileDataExtension;

/**
 * Class \Dynamic\Products\Model\Brochure
 *
 * @method ManyManyList|ProductObject[] Products()
 * @mixin ProductFileDataExtension
 */
class Brochure extends ProductFile
{
    /**
     * @var string
     */
    private static $table_name = 'Brochure';
    
    private static $extensions = [ProductFileDataExtension::class];
}
