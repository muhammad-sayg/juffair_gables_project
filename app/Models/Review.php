<?php

namespace App\Models;
use App\Models\ReviewStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory; protected $fillable = [
        'name',
        'email',
        'review',
        'review_status_code',
    ];
    public function review_status(){
        return $this->belongsTo(ReviewStatus::class, 'review_status_code', 'review_status_code');
    }
}
