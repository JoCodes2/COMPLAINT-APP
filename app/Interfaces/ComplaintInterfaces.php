<?php

namespace App\Interfaces;

use App\Http\Requests\ComplaintRequest;

interface ComplaintInterfaces
{
    public function getAllData();
    public function createData(ComplaintRequest $request);
    public function deleteDataById($id);
}
