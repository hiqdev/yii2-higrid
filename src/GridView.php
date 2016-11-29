<?php

/*
 * Advanced Grid for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-higrid
 * @package   yii2-higrid
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\higrid;

use Closure;
use hiqdev\yii2\assets\JqueryResizableColumns\ResizableColumnsAsset;
use ReflectionClass;
use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Class GridView.
 *
 * Gives 2 features:
 * - creates DetailView widget based on this GridView
 * - default columns functionality
 * - representations functionality
 * - summary section extendability with summaryRenderer()
 */
class GridView extends \yii\grid\GridView
{
    public $boxed = true;
    /**
     * {@inheritdoc}
     */
    public $dataColumnClass = DataColumn::class;

    /**
     * {@inheritdoc}
     */
    public static $detailViewClass = DetailView::class;

    /**
     * @var array|boolean
     *  - array: options for Jquery Resizable Columns plugin initiate call
     *  - boolean false: resizable is disabled
     *
     * Defaults to `['store' => new JsExpression('store')]`.
     * @see registerResizableColumns()
     */
    public $resizableColumns = [];

    public function run()
    {
        $this->registerResizableColumns();
        parent::run();
    }

    /**
     * {@inheritdoc}
     */
    public function getId($autoGenerate = true)
    {
        if ($autoGenerate && parent::getId(false) === null) {
            $this->id = hash('crc32b', Json::encode($this->columns));
        }

        return parent::getId();
    }

    /**
     * Registers ResizableColumns plugin when [[resizableColumns]] is not false.
     */
    public function registerResizableColumns()
    {
        if (!$this->resizableColumns !== false) {
            return;
        }

        $this->tableOptions['data-resizable-columns-id'] = $this->id;

        ResizableColumnsAsset::register($this->getView());
        $resizableColumns = Json::encode(ArrayHelper::merge([
            'store' => new JsExpression('store'),
        ], $this->resizableColumns));
        $this->getView()->registerJs("$('#{$this->id} table[data-resizable-columns-id]').resizableColumns($resizableColumns);");
    }

    /**
     * Runs DetailView widget based on this GridView.
     *
     * @param array $config Config that will be passed to [[detailViewClass]] initialisation.
     * Special element `gridOptions` will be merged to `GridView` initialisation config array.
     *
     * @throws \yii\base\InvalidConfigException
     *
     * @return mixed
     */
    public static function detailView(array $config = [])
    {
        $class = static::$detailViewClass ?: DetailView::class;
        $grid  = Yii::createObject(ArrayHelper::merge([
            'class' => get_called_class(),
            'dataProvider' => new ArrayDataProvider(['allModels' => [$config['model']]]),
        ], ArrayHelper::remove($config, 'gridOptions', [])));
        $config['grid'] = $grid;

        return call_user_func([$class, 'widget'], $config);
    }

    /**
     * Creates a [[DataColumn]] object with given additional config.
     * @param array $config additional config for [[DataColumn]]
     * @return DataColumn the column instance
     */
    protected function createColumnObject(array $config = [])
    {
        return Yii::createObject(array_merge([
            'class' => $this->dataColumnClass ?: 'yii\grid\DataColumn',
            'grid'  => $this,
        ], $config));
    }

    /**
     * Default (predefined) columns.
     * @return array array of predefined DataColumn configs
     */
    protected static function defaultColumns()
    {
        return [];
    }

    /**
     * @var array Cached default columns.
     */
    protected static $_defaultColumns = [];

    /**
     * Getter for $_defaultColumns.
     *
     * @return array
     */
    public static function getDefaultColumns()
    {
        $class = get_called_class();
        if (is_array(static::$_defaultColumns[$class])) {
            return static::$_defaultColumns[$class];
        }

        return static::$_defaultColumns[$class] = static::gatherDefaultColumns();
    }

    /**
     * Scans recursively by hierarchy for defaultColumns and caches to $_defaultColumns.
     */
    public static function gatherDefaultColumns()
    {
        $columns = static::defaultColumns();
        $parent  = (new ReflectionClass(get_called_class()))->getParentClass();
        if ($parent->hasMethod('gatherDefaultColumns')) {
            $columns = array_merge(call_user_func([$parent->getName(), 'gatherDefaultColumns']), $columns);
        }

        return $columns;
    }

    /**
     * Returns column from $_defaultColumns.
     *
     * @return array|null DataColumn config or null if not found
     */
    public static function column($name, array $config = [])
    {
        $column = static::getDefaultColumns()[$name];

        return is_array($column) ? array_merge($column, $config) : null;
    }

    /**
     * {@inheritdoc}
     */
    protected function createDataColumn($text)
    {
        $column = static::column($text);
        if (is_array($column)) {
            $column['attribute'] = $column['attribute'] ?: $text;

            return $this->createColumnObject($column);
        }

        return parent::createDataColumn($text);
    }

    /**
     * @var string|Closure use it to change default summary rendering
     */
    public $summaryRenderer;

    public function renderSummary()
    {
        return $this->summaryRenderer instanceof Closure ? call_user_func($this->summaryRenderer, $this) : (parent::renderSummary() . $this->summaryRenderer);
    }

    public function parentSummary()
    {
        return parent::renderSummary();
    }

    /**
     * @var string selected representation
     */
    protected $_representation;

    /**
     * @var array available representations
     */
    protected static $_representations = [];

    /**
     * Default (predefined) representations.
     * Representation is array of label and columns like this:
     * TODO add Representation class
     * [
     *     'label' => Yii::t('cat', 'common'),
     *     'columns' => ['id', 'name', ... ],
     * ].
     * @return array array of predefined representations
     */
    public static function defaultRepresentations()
    {
        return [];
    }

    /**
     * Returns representations.
     * If not set gets from defaultRepresentations().
     * @static
     * @return array
     */
    public static function getRepresentations()
    {
        $class = get_called_class();
        if (!isset(static::$_representations[$class])) {
            static::$_representations[$class] = array_filter(static::defaultRepresentations());
        }

        return static::$_representations[$class];
    }

    /**
     * Sets current representation.
     * Also sets columns list.
     * @param string $value
     */
    public function setRepresentation($value)
    {
        $representations = static::getRepresentations();
        if (!isset($representations[$value])) {
            $value = key($representations);
        }
        if ($value) {
            $this->columns = $representations[$value]['columns'];
            $this->_representation = $value;
        }
    }

    /**
     * Returns current selected representation.
     * @return string
     */
    public function getRepresentation()
    {
        return $this->_representation;
    }
}
