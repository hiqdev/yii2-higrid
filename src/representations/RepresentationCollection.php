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

use Yii;
use yii\base\InvalidConfigException;

/**
 * Class RepresentationCollection represents a collection of [[Representation]] objects
 * and provides API to access them.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class RepresentationCollection implements RepresentationCollectionInterface
{
    /**
     * RepresentationCollection constructor.
     */
    public function __construct()
    {
        $this->fillRepresentations();
    }

    /**
     * @var array
     */
    protected $representations = [];

    /**
     * @void
     */
    protected function fillRepresentations()
    {
        $this->representations = [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        foreach ($this->representations as $name => $representation) {
            if (!is_object($representation)) {
                $representation = $this->representations[$name] = Yii::createObject(array_merge([
                    'class' => Representation::class,
                ], $representation));
            }

            if (!$representation instanceof RepresentationInterface) {
                throw new InvalidConfigException('Representation "' . $name . '" must be instance of RepresentationInterface');
            }
        }

        return $this->representations;
    }

    /**
     * {@inheritdoc}
     */
    public function getByName($name)
    {
        if (!$this->exists($name)) {
            return $this->getDefault();
        }

        return $this->getAll()[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function getDefault()
    {
        $representations = $this->getAll();
        if (count($representations) === 0) {
            throw new InvalidConfigException('Default can not be applied because collection is empty.');
        }

        return reset($representations);
    }

    /**
     * {@inheritdoc}
     */
    public function exists($name)
    {
        return isset($this->getAll()[$name]);
    }
}
