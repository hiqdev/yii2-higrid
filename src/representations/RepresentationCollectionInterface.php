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

use yii\base\InvalidConfigException;

/**
 * Interface RepresentationCollectionInterface provides contract for collection of
 * available representations of the GridView.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
interface RepresentationCollectionInterface
{
    /**
     * Provides all available representations.
     *
     * @return RepresentationInterface[]
     */
    public function getAll();

    /**
     * Return representation by name.
     * In case it does not exist - return the default one.
     *
     * @param $name
     * @return RepresentationInterface
     */
    public function getByName($name);

    /**
     * Returns default representation.
     *
     * @throws InvalidConfigException when there are no available representations
     * @return RepresentationInterface
     */
    public function getDefault();

    /**
     * @param string $name
     * @return bool whether the representation exists in this collection
     */
    public function exists($name);
}
