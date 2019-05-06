<?php

namespace Dynamic\Products\Test\Page;

use Dynamic\Products\Page\Product;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class ProductTest extends SapphireTest
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
        $object = $this->objFromFixture(Product::class, 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }
}
