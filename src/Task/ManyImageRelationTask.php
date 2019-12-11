<?php

namespace Dynamic\Products\Task;

use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;

/**
 * Class ManyImageRelationTask
 * @package Dynamic\Products\Task
 */
class ManyImageRelationTask extends BuildTask
{
    /**
     * @var string
     */
    protected $title = 'Product Image Relation Update Task';

    /**
     * @var string
     */
    private static $segment = 'product-image-relation-update-task';

    /**
     * @param \SilverStripe\Control\HTTPRequest $request
     */
    public function run($request)
    {
        $this->updateRelationTable();
    }

    /**
     *
     */
    protected function updateRelationTable()
    {
        foreach ($this->yieldProductImages() as $record) {
            DB::prepared_query(
                'UPDATE `Product_Images` SET `FileID` = ? WHERE `ID` = ?',
                [$record['ImageID'], $record['ID']]
            );
        }
    }

    /**
     * @return \Generator
     */
    protected function yieldProductImages()
    {
        foreach (DB::query('SELECT * FROM `Product_Images`') as $record) {
            yield $record;
        }
    }
}
