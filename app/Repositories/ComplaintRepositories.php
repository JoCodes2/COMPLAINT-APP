<?php

namespace App\Repositories;

use App\Http\Requests\ComplaintRequest;
use App\Interfaces\ComplaintInterfaces;
use App\Mail\ComplaintMail;
use App\Mail\ComplaintReviewedNotification;
use App\Models\CategoryComplaintModel;
use App\Models\ComplaintModel;
use App\Models\User;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ComplaintRepositories implements ComplaintInterfaces
{
    use HttpResponseTraits;

    protected $userModel;
    protected $categoryModel;
    protected $complaintModel;

    public function __construct(ComplaintModel $complaintModel, CategoryComplaintModel $categoryModel, User $userModel)
    {
        $this->complaintModel = $complaintModel;
        $this->categoryModel = $categoryModel;
        $this->userModel = $userModel;
    }
    public function getAllData()
    {
        $data = $this->complaintModel::with('user', 'categoryComplaint')->get();
        if (!$data) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }

    private function generateComplaintNumber()
    {
        $date = now()->format('d/m/Y');
        $latestComplaint = $this->complaintModel::whereDate('created_at', now()->format('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->first();

        $number = 1;
        if ($latestComplaint) {
            $lastNumber = intval(substr($latestComplaint->no_complaint, -4));
            $number = $lastNumber + 1;
        }

        $formattedNumber = sprintf('%04d', $number);
        return "SPS/{$date}/{$formattedNumber}";
    }

    public function createData(ComplaintRequest $request)
    {
        try {
            $data = new $this->complaintModel;
            $data->id_user = $request->input('id_user');
            $data->no_complaint = $this->generateComplaintNumber();
            $data->id_category_complaint = $request->input('id_category_complaint');
            $data->status_complaint = 'not reviewed';
            $data->description_complaint = $request->input('description_complaint');
            $data->created_at = now('Asia/Makassar');

            if ($request->hasFile('image_complaint')) {
                $file = $request->file('image_complaint');
                $extension = $file->getClientOriginalExtension();
                $filename = 'FILE-PENGADUAN-' . Str::random(15) . '.' . $extension;
                Storage::makeDirectory('uploads/file-pengaduan');
                $file->move(public_path('uploads/file-pengaduan'), $filename);
                $data->image_complaint = $filename;
            }

            $data->save();

            // Ambil informasi pengguna
            $user = $this->userModel::findOrFail($data->id_user);
            $category = $this->categoryModel::findOrFail($data->id_category_complaint, ['name_category']);

            // Kirim notifikasi email
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ComplaintMail($data, $user, $category->name_category));


            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
    public function getDataById($id)
    {
        $data = $this->complaintModel::with('user', 'categoryComplaint')->where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            return $this->success($data);
        }
    }
    public function deleteDataById($id)
    {
        $data = $this->complaintModel::where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            $locationSP = 'uploads/file-pengaduan/' . $data->image_complaint;
            $data->delete();
            if (File::exists($locationSP)) {
                File::delete($locationSP);
            }
        }

        return $this->delete();
    }

    public function updateStatusComplaint(Request $request, $id)
    {
        try {
            $data = $this->complaintModel::with('categoryComplaint')->find($id);

            if (!$data) {
                return $this->idOrDataNotFound();
            }

            $data->status_complaint = 'reviewed';
            $data->save();
            // Kirim email notifikasi
            Mail::to($data->user->email)->send(new ComplaintReviewedNotification($data));

            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
}
