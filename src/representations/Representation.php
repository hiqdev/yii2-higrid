<?php

namespace hiqdev\higrid\representations;

use yii\base\BaseObject;

/**
 * Class Representation
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
