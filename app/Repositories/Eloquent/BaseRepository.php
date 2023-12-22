<?php

use App\Repositories\IEloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class BaseRepository implements IEloquentRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function _construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * @param array $attributes
     * @return Model
     */
    public function insertOne(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->all();
    }


    /**
     * @param $id
     * @return Model
     */
    public function findOne($id): ?Model
    {
        return $this->model->find($id);
    }


    /**
     * @param $id
     * @return Model
     */
    public function softDelete($id): Model
    {
        $model = $this->model->find($id);
        $model->softDelete();
        return $model;
    }

    /**
     * @param $id
     * @return Model
     */
    public function hardDelete($id): ?Model
    {
        $model = $this->model->find($id);
        $model->forceDelete();
        return $model;
    }

    /**
     * @param $id
     * @return Model
     */
    public function updateOne($id, array $attributes): ?Model
    {
        $model = $this->model->find($id);
        $model->update($attributes);
        return $model;
    }
}
