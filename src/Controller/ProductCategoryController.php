<?php

namespace Dynamic\Products\Page;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\PaginatedList;

/**
 * Class \Dynamic\Products\Page\ProductCategoryController
 *
 * @property ProductCategory $dataRecord
 * @method ProductCategory data()
 * @mixin ProductCategory
 */
class ProductCategoryController extends \PageController
{
    /**
     * @param HTTPRequest|null $request
     * @return PaginatedList
     */
    public function ProductPaginatedList(HTTPRequest $request = null)
    {
        if (!$request instanceof HTTPRequest) {
            $request = $this->getRequest();
        }
        $recipes = $this->data()->getProductList();
        $start = ($request->getVar('start')) ? (int)$request->getVar('start') : 0;
        $records = PaginatedList::create($recipes, $request);
        $records->setPageStart($start);
        $records->setPageLength($this->data()->ProductsPerPage);

        // allow $records to be updated via extension
        $this->extend('updateProductPaginatedList', $records);

        return $records;
    }
}
