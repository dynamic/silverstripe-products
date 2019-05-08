<?php

namespace Dynamic\Products\Test;

use Dynamic\Products\Model\Brochure;
use Dynamic\Products\Model\ProductDoc;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class ProductFileDataExtensionTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = '../fixtures.yml';

    /**
     *
     */
    public function testGetProductsCt()
    {
        $object = $this->objFromFixture(Brochure::class, 'one');
        $this->assertEquals($object->getProductsCt(), 1);
    }

    /**
     *
     */
    public function testGetProductsList()
    {
        $object = $this->objFromFixture(Brochure::class, 'one');
        $this->assertEquals($object->getProductsList(), 'Product One');
    }

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture(Brochure::class, 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }

    /**
     *
     */
    public function testLink()
    {
        $object = $this->objFromFixture(Brochure::class, 'one');
        $this->assertEquals($object->getLink(), $object->Download()->URL);
    }

    /**
     *
     */
    public function testGetIsProductDoc()
    {
        $object = $this->objFromFixture(Brochure::class, 'one');
        $this->assertEquals($object->getIsProductFile(), true);
    }
}
