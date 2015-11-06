<?php

/*
 * Advanced Grid for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-higrid
 * @package   yii2-higrid
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\higrid;

/**
 * Class DataColumn.
 *
 * Gives FeaturedColumnTrait features.
 */
class DataColumn extends \yii\grid\DataColumn
{
    use FeaturedColumnTrait {
        init as traitInit;
    }

    /**
     * @var GridView the grid view object that owns this column.
     */
    public $grid;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if ($this->grid->resizableColumns) {
            $this->headerOptions['data-resizable-columns-id'] = $this->attribute;
        }

        $this->traitInit();
    }
}
