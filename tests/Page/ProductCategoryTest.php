<?php

namespace Dynamic\Products\Test\Page;

use Dynamic\Products\Page\ProductCategory;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class ProductCategoryTest extends SapphireTest
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
        $object = $this->objFromFixture(ProductCategory::class, 'default');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }
}
