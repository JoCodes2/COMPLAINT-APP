<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackComplaintModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tb_feedback_complaint';
    protected $fillable = [
        'id',
        'id_complaint',
        'desciption_feedback',
        'image_feedback',
        'created_at',
        'updated_at',
    ];
    public function complaint()
    {
        return $this->belongsTo(ComplaintModel::class, 'id_complaint');
    }
}
