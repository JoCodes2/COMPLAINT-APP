<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tb_complaint';
    protected $fillable = [
        'id_user',
        'no_complaint',
        'complaint_date',
        'complaint_title',
        'desciption_complaint',
        'status_complaint',
        'image_complaint',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function feedbackComplaint()
    {
        return $this->hasOne(FeedbackComplaintModel::class, 'id_complaint');
    }
}
