<?php

namespace App\Repositories;

use App\Http\Requests\CategoryComplaintRequest;
use App\Interfaces\CategoryComplaintInterfaces;
use App\Models\CategoryCompalintModel;
use App\Models\CategoryComplaintModel;
use App\Traits\HttpResponseTraits;

class CategoryComplaintRepositories implements CategoryComplaintInterfaces
{
    use HttpResponseTraits;
    protected $categoryComplaintModel;
    public function __construct(CategoryComplaintModel $categoryComplaintModel)
    {
        $this->categoryComplaintModel = $categoryComplaintModel;
    }
    public function getAllData()
    {
        $data = $this->categoryComplaintModel::all();
        if (!$data) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }
    public function getDataById($id)
    {
        $data = $this->categoryComplaintModel::where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            return $this->success($data);
        }
    }
    public function createData(CategoryComplaintRequest $request)
    {
        try {
            $data = new $this->categoryComplaintModel;
            $data->name_category = $request->input('name_category');
            $data->save();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
    public function updateDataById(CategoryComplaintRequest $request, $id)
    {
        try {
            $data = $this->categoryComplaintModel::where('id', $id)->first();
            if (!$data) {
                return $this->idOrDataNotFound();
            }
            $data->name_category = $request->input('name_category');
            $data->save();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
    public function deleteDataById($id)
    {
        try {
            $data = $this->categoryComplaintModel::where('id', $id)->first();
            if (!$data) {
                return $this->idOrDataNotFound();
            }
            $data->delete();
            return $this->delete();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
}
