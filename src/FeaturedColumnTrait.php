<?php
/**
 * Advanced Grid for Yii2.
 *
 * @link      https://github.com/hiqdev/yii2-higrid
 * @package   yii2-higrid
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\higrid;

use Closure;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Trait FeaturedColumnTrait.
 *
 * Gives the next features:
 * - popover text shown at header cell
 * - filterAttribute: to specify name of attribute used for filtering distinct from attribute
 * - resizable columns
 */
trait FeaturedColumnTrait
{
    /**
     * @var string Popover text
     */
    public $popover;

    /**
     * @var array Options to popover()
     */
    public $popoverOptions = [
        'placement' => 'bottom',
        'selector' => 'a',
    ];

    /**
     * Like a `DataColumn::value` for change the value of the column for export to CSV, TSV etc.
     *
     * @var string|Closure an anonymous function or a string that is used to determine the value to display in the export column.
     *
     * If this is an anonymous function, it will be called for each row and the return value will be used as the value to
     * display for every data model. The signature of this function should be: `function ($model, $key, $index, $column)`.
     * Where `$model`, `$key`, and `$index` refer to the model, key and index of the row currently being rendered
     * and `$column` is a reference to the [[DataColumn]] object.
     */
    public $exportedValue;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if ($this->grid->resizableColumns !== false && !isset($this->headerOptions['data-resizable-column-id'])) {
            $this->headerOptions['data-resizable-column-id'] = $this->attribute;
        }

        if ($this->hasProperty('defaultOptions')) {
            foreach ($this->defaultOptions as $k => $v) {
                $this->{$k} = ArrayHelper::merge($v, $this->{$k});
            }
        }
        $this->registerClientScript();
    }

    /**
     * {@inheritdoc}
     */
    public function registerClientScript()
    {
        $view = Yii::$app->getView();
        $ops = Json::encode($this->popoverOptions);
        if (property_exists($this, 'grid')) {
            $view->registerJs("$('#{$this->grid->id} thead th[data-attribute=\"{$this->attribute}\"]').popover($ops);", \yii\web\View::POS_READY);
        } else {
            $view->registerJs("$('table[role=\"grid\"] thead th[data-attribute=\"{$this->attribute}\"]').popover($ops);", \yii\web\View::POS_READY);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderHeaderCellContent()
    {
        /// XXX better change yii
        if ($this->hasProperty('attribute')) {
            $save = $this->attribute;
            $this->attribute = $this->getSortAttribute();
        }

        if ($this->popover) {
            $this->headerOptions = ArrayHelper::merge($this->headerOptions, [
                'data' => [
                    'toggle' => 'popover',
                    'trigger' => 'hover',
                    'content' => $this->popover,
                    'attribute' => $this->attribute,
                ],
            ]);
        }

        $res = parent::renderHeaderCellContent();
        if ($this->hasProperty('attribute')) {
            $this->attribute = $save;
        }

        return $res;
    }

    /**
     * @var string name for filter input
     */
    public $sortAttribute;

    /**
     * Getter for sortAttribute.
     */
    public function getSortAttribute()
    {
        if ($this->sortAttribute === false) {
            return false;
        }

        return $this->sortAttribute ?: $this->attribute;
    }

    /**
     * @var string name for filter input
     */
    public $filterAttribute;

    /**
     * Getter for filterAttribute.
     */
    public function getFilterAttribute()
    {
        return $this->filterAttribute ?: $this->attribute;
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

    /**
     * {@inheritdoc}
     */
    protected function renderFilterCellContent()
    {
        if ($this->filter instanceof Closure) {
            return call_user_func($this->filter, $this, $this->grid->filterModel, $this->attribute);
        }
        /// XXX better change yii
        if ($this->hasProperty('attribute')) {
            $save = $this->attribute;
            $this->attribute = $this->getFilterAttribute();
        }
        $out = parent::renderFilterCellContent();
        if ($this->hasProperty('attribute')) {
            $this->attribute = $save;
        }

        return $out;
    }
}
