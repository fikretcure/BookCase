<?php

namespace App\Interfaces;

/**
 *
 */
interface RepositoryInterface
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed;

    /**
     * @param array $filtered
     * @return mixed
     */
    public function get(array $filtered): mixed;

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed;

}
