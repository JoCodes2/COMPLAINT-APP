<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintRequest;
use App\Repositories\ComplaintRepositories;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    protected $complaintRepo;
    public function __construct(ComplaintRepositories $complaintRepo)
    {
        $this->complaintRepo = $complaintRepo;
    }
    public function getAllData()
    {
        return $this->complaintRepo->getAllData();
    }
    public function createData(ComplaintRequest $request)
    {
        return $this->complaintRepo->createData($request);
    }
    public function deleteDataById($id)
    {
        return $this->complaintRepo->deleteDataById($id);
    }
}
