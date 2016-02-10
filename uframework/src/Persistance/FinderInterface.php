<?php

namespace Persistance;

interface FinderInterface
{
    /**
     * Returns all elements.
     *
     * @return array
     */
    public function findAll($filtre);

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function findOneById($id);
}
