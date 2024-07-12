<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mendapatkan total complaint
        $totalComplaint = ComplaintModel::count();

        // Mendapatkan total complaint not reviewed
        $totalNotReviewed = ComplaintModel::where('status_complaint', 'not reviewed')->count();

        // Mendapatkan total complaint reviewed
        $totalReviewed = ComplaintModel::where('status_complaint', 'reviewed')->count();

        return response()->json([
            'total_complaint' => $totalComplaint,
            'total_not_reviewed' => $totalNotReviewed,
            'total_reviewed' => $totalReviewed,
        ]);
    }
}
