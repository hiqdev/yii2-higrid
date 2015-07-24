<?php
/**
 * @link    http://hiqdev.com/yii2-higrid
 * @license http://hiqdev.com/yii2-higrid/license
 * @copyright Copyright (c) 2015 HiQDev
 */

namespace hiqdev\higrid;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * Class GridView.
 *
 * Gives 2 features:
 * - creates DetailView widget based on this GridView
 * - default columns functionality
 */
class GridView extends \kartik\grid\GridView
{
    /**
     * @inheritdoc
     */
    public $dataColumnClass = 'hiqdev\higrid\DataColumn';

    /**
     * @inheritdoc
     */
    static public $detailViewClass = 'hiqdev\higrid\DetailView';

    /**
     * Runs DetailView widget based on this GridView.
     * @param
     */
    static public function detailView (array $config = []) {
        $class = static::$detailViewClass ?: DetailView::className();
        $grid = Yii::createObject([
            'class'         => get_called_class(),
            'dataProvider'  => new ArrayDataProvider(),
        ]);

        return call_user_func([$class, 'widget'], array_merge(compact('grid'), $config));
    }

    /**
     * Creates a [[DataColumn]] object with given additional config
     * @param array $config additional config for [[DataColumn]]
     * @return DataColumn the column instance
     */
    protected function createColumnObject (array $config = [])
    {
        return Yii::createObject(array_merge([
            'class' => $this->dataColumnClass ?: 'yii\grid\DataColumn',
            'grid' => $this,
        ], $config));
    }

    /**
     * Default (predefined) columns.
     * @return array array of predefined DataColumn configs
     */
    static protected function defaultColumns()
    {
        return [];
    }

    /**
     * @var array Cached default columns.
     */
    static protected $_defaultColumns = [];

    /**
     * Getter for $_defaultColumns.
     * @return array
     */
    static public function getDefaultColumns()
    {
        $class = get_called_class();
        if (is_array(static::$_defaultColumns[$class])) {
            return static::$_defaultColumns[$class];
        };
        return static::$_defaultColumns[$class] = static::gatherDefaultColumns();
    }

    /**
     * Scans recursively by hierarchy for defaultColumns and caches to $_defaultColumns
     */
    static public function gatherDefaultColumns()
    {
        $columns = static::defaultColumns();
        $parent  = (new \ReflectionClass(get_called_class()))->getParentClass();
        if ($parent->hasMethod('gatherDefaultColumns')) {
            $columns = array_merge(call_user_func([$parent->getName(), 'gatherDefaultColumns']), $columns);
        };
        return $columns;
    }

    /**
     * Returns column from $_defaultColumns
     * @return array DataColumn config
     */
    static public function column ($name, array $config = []) {
        $column = static::getDefaultColumns()[$name];

        return is_array($column) ? array_merge($column, $config) : null;
    }

    /**
     * @inheritdoc
     */
    protected function createDataColumn ($text)
    {
        $column = static::column($text);
        if (is_array($column)) {
            $column['attribute'] = $column['attribute'] ?: $text;
            return $this->createColumnObject($column);
        }
        return parent::createDataColumn($text);
    }

}
