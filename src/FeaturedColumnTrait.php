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
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Trait FeaturedColumnTrait.
 *
 * Gives 2 features:
 * - popover text shown at header cell
 * - filterAttribute: to specify name of attribute used for filtering distinct from attribute
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
        'selector'  => 'a',
    ];

    /**
     * @var string name for filter input
     */
    public $filterAttribute;

    /**
     * @var string name for filter input
     */
    public $sortAttribute;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->hasProperty('defaultOptions')) {
            foreach ($this->defaultOptions as $k => $v) {
                $this->{$k} = ArrayHelper::merge($v, $this->{$k});
            }
        };
        $this->registerClientScript();
    }

    /**
     * {@inheritdoc}
     */
    public function registerClientScript()
    {
        $view = Yii::$app->getView();
        $ops  = Json::encode($this->popoverOptions);
        $view->registerJs("$('#{$this->grid->id} thead th[data-toggle=\"popover\"]').popover($ops);", \yii\web\View::POS_READY);
    }

    /**
     * {@inheritdoc}
     */
    public function renderHeaderCellContent()
    {
        /// XXX better change yii
        if ($this->hasProperty('attribute')) {
            $save            = $this->attribute;
            $this->attribute = $this->getSortAttribute();
        }

        if ($this->popover) {
            $this->headerOptions = ArrayHelper::merge($this->headerOptions, [
                'data-toggle'  => 'popover',
                'data-trigger' => 'hover',
                'data-content' => $this->popover,
            ]);
        }

        $res = parent::renderHeaderCellContent();
        if ($this->hasProperty('attribute')) {
            $this->attribute = $save;
        }

        return $res;
    }

    /**
     * Getter for filterAttribute.
     */
    public function getFilterAttribute()
    {
        return $this->filterAttribute ?: $this->attribute;
    }

    /**
     * Getter for sortAttribute.
     */
    public function getSortAttribute()
    {
        return $this->sortAttribute ?: $this->attribute;
    }

    /**
     * {@inheritdoc}
     */
    protected function renderFilterCellContent()
    {
        /// XXX better change yii
        if ($this->hasProperty('attribute')) {
            $save            = $this->attribute;
            $this->attribute = $this->getFilterAttribute();
        };
        $out = parent::renderFilterCellContent();
        if ($this->hasProperty('attribute')) {
            $this->attribute = $save;
        };

        return $out;
    }
}
