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

    /**
     *
     */
    public function testGetProductList()
    {
        $this->markTestSkipped('Currently doesn\'t seem to respect the groups/members in automated tests');

        $this->logOut();
        $member = $this->objFromFixture(Member::class, 'author');
        $this->logInAs(Member::get()->byID($member->ID));
        $categoryID = $this->objFromFixture(ProductCategory::class, 'restricted')->ID;
        /** @var ProductCategory $category */
        $category = ProductCategory::get()->byID($categoryID);

        $this->assertEquals(2, $category->getProductList()->count());

        $this->logOut();
        $member = $this->objFromFixture(Member::class, 'default');
        $this->logInAs(Member::get()->byID($member->ID));
        /** @var ProductCategory $category */
        $category = ProductCategory::get()->byID($categoryID);

        $this->assertEquals(1, $category->getProductList()->count());

        $this->logOut();
    }
}
