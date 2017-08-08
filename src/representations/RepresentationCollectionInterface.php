<?php

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
     * Provides all available representations
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
     * @return RepresentationInterface
     * @throws InvalidConfigException when there are no available representations
     */
    public function getDefault();

    /**
     * @param string $name
     * @return bool whether the representation exists in this collection
     */
    public function exists($name);
}
