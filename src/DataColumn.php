<?php

/*
 * Advanced Grid for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-higrid
 * @package   yii2-higrid
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
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
        renderFilterCellContent as traitRenderFilterCellContent;
    }

    /**
     * @var string|array|boolean|callable the HTML code representing a filter input (e.g. a text field, a dropdown list)
     * that is used for this data column. This property is effective only when [[GridView::filterModel]] is set.
     *
     * - If this property is not set, a text field will be generated as the filter input;
     * - If this property is an array, a dropdown list will be generated that uses this property value as
     *   the list options.
     * - If this property is a closure, it's output will be used as a filter value.
     * Example determination of closure: `function ($dataColumn, $model, $attribute) { ... }`
     * - If you don't want a filter for this data column, set this value to be false.
     */
    public $filter;

    protected function renderFilterCellContent() {
        if ($this->filter instanceof \Closure) {
            return call_user_func($this->filter, $this, $this->grid->filterModel, $this->attribute);
        } else {
            return static::traitRenderFilterCellContent();
        }
    }
}
