<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\Category as CategoryInterface;

class Category
{
	protected $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->category->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->category->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->category->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function delete($params = [])
    {
        return $this->category->delete($params);
    }

}