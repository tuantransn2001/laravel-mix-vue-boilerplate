<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;



/** 
 * Interface Eloquent Repository
 * @package App\Repositories
 **/
interface IEloquentRepository
{

    /** 
     * @param array $attributes
     * @return Model
     **/
    public function insertOne(array $attributes): Model;

    /** 
     * @return Collection
     **/
    public function findAll(): Collection;

    /**
     * @param $id
     * @return Model
     **/
    public function findOne($id): ?Model;

    /**
     * @param $id
     * @return Model
     **/
    public function softDelete($id): ?Model;

    /**
     * @param $id
     * @return Model
     **/
    public function hardDelete($id): ?Model;

    /**
     * @param $id
     * @return Model
     **/
    public function updateOne($id, array $attributes): ?Model;
}
