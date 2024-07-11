<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryComplaintRequest;
use App\Repositories\CategoryComplaintRepositories;

class CategoryComplaintController extends Controller
{
    protected $categoryComplaintRepo;
    public function __construct(CategoryComplaintRepositories $categoryComplaintRepo)
    {
        $this->categoryComplaintRepo = $categoryComplaintRepo;
    }
    public function getAllData()
    {
        return $this->categoryComplaintRepo->getAllData();
    }
    public function getDataById($id)
    {
        return $this->categoryComplaintRepo->getDataById($id);
    }
    public function createData(CategoryComplaintRequest $request)
    {
        return $this->categoryComplaintRepo->createData($request);
    }
    public function updateDataById(CategoryComplaintRequest $request, $id)
    {
        return $this->categoryComplaintRepo->updateDataById($request, $id);
    }
    public function deleteDataById($id)
    {
        return $this->categoryComplaintRepo->deleteDataById($id);
    }
}
