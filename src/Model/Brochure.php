<?php

namespace Dynamic\Products\Model;

use Dynamic\Products\Extension\ProductFileDataExtension;

class Brochure extends ProductFile
{
    /**
     * @var string
     */
    private static $table_name = 'Brochure';
    
    private static $extensions = [ProductFileDataExtension::class];
}