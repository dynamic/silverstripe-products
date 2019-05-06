<?php

namespace Dynamic\Products\Test\TestOnly;

use Dynamic\Products\Extension\ProductDocDataExtension;
use Dynamic\Products\Model\ProductDoc;
use SilverStripe\Dev\TestOnly;

class TestProductFile extends ProductDoc implements TestOnly
{
    /**
     * @var string
     */
    private static $table_name = 'TestProductDoc';

    /**
     * @var array
     */
    private static $extensions = [
        ProductDocDataExtension::class,
    ];
}
