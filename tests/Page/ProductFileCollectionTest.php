<?php

namespace Dynamic\Products\Test;

use Dynamic\Products\Page\ProductFileCollection;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class ProductFileCollectionTest extends SapphireTest
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
        $object = singleton(ProductFileCollection::class);
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
        $this->assertNotNull($fields->dataFieldByName('ManagedClass'));
    }
}
