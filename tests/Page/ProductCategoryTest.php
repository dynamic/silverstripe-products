<?php

namespace Dynamic\Products\Test\Page;

use Dynamic\Products\Page\ProductCategory;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Security\Member;

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

    public function testGetProductList()
    {
        $this->logInAs($this->objFromFixture(Member::class, 'author'));

        /** @var ProductCategory $category */
        $category = $this->objFromFixture(ProductCategory::class, 'restricted');
        $this->assertEquals(2, $category->getProductList()->count());

        $this->logOut();
        $this->logInAs($this->objFromFixture(Member::class, 'default'));
        /** @var ProductCategory $category */
        $category = $this->objFromFixture(ProductCategory::class, 'restricted');

        $this->assertEquals(1, $category->getProductList()->count());

        $this->logOut();
    }
}
