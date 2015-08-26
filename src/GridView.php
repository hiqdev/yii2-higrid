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
    public $boxed = true;
    /**
     * {@inheritdoc}
     */
    public $dataColumnClass = 'hiqdev\higrid\DataColumn';

    /**
     * {@inheritdoc}
     */
    public static $detailViewClass = 'hiqdev\higrid\DetailView';

    /**
     * Runs DetailView widget based on this GridView.
     *
     * @param
     */
    public static function detailView(array $config = [])
    {
        $class = static::$detailViewClass ?: DetailView::className();
        $grid  = Yii::createObject([
            'class'        => get_called_class(),
            'dataProvider' => new ArrayDataProvider(['allModels' => [$config['model']]]),
        ]);

        return call_user_func([$class, 'widget'], array_merge(compact('grid'), $config));
    }

    /**
     * Creates a [[DataColumn]] object with given additional config.
     *
     * @param array $config additional config for [[DataColumn]]
     *
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
     *
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
        };

        return static::$_defaultColumns[$class] = static::gatherDefaultColumns();
    }

    /**
     * Scans recursively by hierarchy for defaultColumns and caches to $_defaultColumns.
     */
    public static function gatherDefaultColumns()
    {
        $columns = static::defaultColumns();
        $parent  = (new \ReflectionClass(get_called_class()))->getParentClass();
        if ($parent->hasMethod('gatherDefaultColumns')) {
            $columns = array_merge(call_user_func([$parent->getName(), 'gatherDefaultColumns']), $columns);
        };

        return $columns;
    }

    /**
     * Returns column from $_defaultColumns.
     *
     * @return array DataColumn config
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
}
