<?php

namespace Dynamic\Products\Test\Extension;

use Dynamic\ProductCatalog\Page\ProductDocCollectionController;
use Dynamic\Products\Model\Brochure;
use Dynamic\Products\Page\ProductFileCollection;
use Dynamic\Products\Page\ProductFileCollectionController;
use SilverStripe\Dev\SapphireTest;

class ProductFileCollectionDataExtensionTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = '../fixtures.yml';

    /**
     *
     */
    public function testUpdateCollectionObject()
    {
        $object = $this->objFromFixture(ProductFileCollection::class, 'default');
        $controller = ProductFileCollectionController::create($object);
        $this->assertEquals($controller->getCollectionObject(), Brochure::class);
    }

    /**
     *
     */
    public function testUpdateCollectionForm()
    {
        $object = $this->objFromFixture(ProductFileCollection::class, 'default');
        $controller = ProductFileCollectionController::create($object);
        $form = $controller->CollectionSearchForm();
        $this->assertNotNull($form->Fields()->dataFieldByName('CategoryID'));
        $this->assertNull($form->Fields()->dataFieldByName('Title'));
    }

    /**
     *
     */
    public function testUpdateCollectionItems()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
