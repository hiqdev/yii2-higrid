<?php
/**
 * Advanced Grid for Yii2.
 *
 * @link      https://github.com/hiqdev/yii2-higrid
 * @package   yii2-higrid
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\higrid\representations;

use yii\base\BaseObject;

/**
 * Class Representation.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class Representation extends BaseObject implements RepresentationInterface
{
    /**
     * @var string
     */
    public $label;

    /**
     * @var array
     */
    public $columns = [];

    /**
     * {@inheritdoc}
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->label;
    }
}
