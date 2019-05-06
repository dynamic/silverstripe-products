<?php

namespace Dynamic\ProductCatalog\Test;

use Dynamic\Products\Model\ProductFile;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class ProductDocTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = '../fixtures.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = singleton(ProductFile::class);
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }
}
