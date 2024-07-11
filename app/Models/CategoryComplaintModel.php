<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryComplaintModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tb_category_complaint';
    protected $fillable = [
        'id',
        'name_category',
        'created_at',
        'updated_at',
    ];
    public function complaints()
    {
        return $this->hasMany(ComplaintModel::class, 'id_user');
    }
}
