<?php

namespace App\Repositories;

use App\Http\Requests\CategoryComplaintRequest;
use App\Interfaces\CategoryComplaintInterfaces;
use App\Models\CategoryCompalintModel;
use App\Traits\HttpResponseTraits;

class CategoryComplaintRepositories implements CategoryComplaintInterfaces
{
    use HttpResponseTraits;
    protected $categoryComplaintModel;
    public function __construct(CategoryCompalintModel $categoryComplaintModel)
    {
        $this->categoryComplaintModel = $categoryComplaintModel;
    }
    public function getAllData()
    {
    }
    public function getDataById($id)
    {
    }
    public function createData(CategoryComplaintRequest $request)
    {
    }
    public function updateDataById(CategoryComplaintRequest $request, $id)
    {
    }
    public function deleteDataById($id)
    {
    }
}
