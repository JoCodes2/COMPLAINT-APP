<?php

namespace App\Interfaces;

use App\Http\Requests\CategoryComplaintRequest;

interface CategoryComplaintInterfaces
{
    public function getAllData();

    public function getDataById($id);
    public function createData(CategoryComplaintRequest $request);
    public function updateDataById(CategoryComplaintRequest $request, $id);
    public function deleteDataById($id);
}
