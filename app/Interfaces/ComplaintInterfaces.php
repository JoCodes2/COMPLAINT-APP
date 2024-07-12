<?php

namespace App\Interfaces;

use App\Http\Requests\ComplaintRequest;
use Illuminate\Http\Request;

interface ComplaintInterfaces
{
    public function getAllData();
    public function createData(ComplaintRequest $request);
    public function getDataById($id);
    public function deleteDataById($id);

    public function updateStatusComplaint(Request $request, $id);
}
