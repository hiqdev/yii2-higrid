<?php
/**
 * @link    http://hiqdev.com/yii2-higrid
 * @license http://hiqdev.com/yii2-higrid/license
 * @copyright Copyright (c) 2015 HiQDev
 */

namespace hiqdev\higrid;

use Yii;

/**
 * Our GridView for extending.
 *
 */
class GridView extends \kartik\grid\GridView
{
    /**
     * Creates a [[DataColumn]] object with given additional config
     * @param array $config additional config for [[DataColumn]]
     * @return DataColumn the column instance
     */
    protected function createColumnObject (array $config = [])
    {
        return Yii::createObject(array_merge([
            'class' => $this->dataColumnClass ? : DataColumn::className(),
            'grid' => $this,
        ], $config));
    }
}
