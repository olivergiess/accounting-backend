<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository;

abstract class EloquentBaseRepository implements BaseRepository
{
	protected $resource;
    protected $model;

    protected $expansions = [];

    public function __construct($resource, $model)
    {
    	$this->resource = $resource;
        $this->model    = $model;
    }

    public function expand(string $expansions)
	{
		$this->expansions = explode(',', $expansions);
	}

    public function create(array $data)
    {
        $model = $this->model->create($data);

        $model->refresh();

        $result = $this->resource->make($model);

        return $result;
    }

    public function show(int $id)
    {
		$model = $this->model::findOrFail($id);

		$model->load($this->expansions);

        $result = $this->resource->make($model);

        return $result;
    }

    public function update(int $id, array $data)
    {
        $model = $this->model::findOrFail($id);

        $model->update($data);

        $model->refresh();

        $result = $this->resource->make($model);

        return $result;
    }
}
