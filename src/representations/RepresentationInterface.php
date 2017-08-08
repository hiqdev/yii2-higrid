<?php

namespace hiqdev\higrid\representations;

/**
 * Interface RepresentationInterface provides contract for representation
 * description.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
interface RepresentationInterface
{
    /**
     * Returns array of columns, compatible with [[hiqdev\higrid\GridView::columns()]]
     * requirements.
     *
     * @return array
     */
    public function getColumns();

    /**
     * User-friendly label of representation
     *
     * @return string
     */
    public function getLabel();
}
