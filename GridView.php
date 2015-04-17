<?php

namespace hiqdev\higrid;

use Yii;

/**
 * Our GridView for extending.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 * @since 2.0
 */
class GridView extends \kartik\grid\GridView
{
    /**
     * Creates a [[DataColumn]] object with given additional config
     * @param array $config additional config for [[DataColumn]]
     * @return DataColumn the column instance
     */
    protected function createColumnObject(array $config = []) {
        return Yii::createObject(array_merge([
            'class' => $this->dataColumnClass ? : DataColumn::className(),
            'grid' => $this,
        ], $config));
    }
}