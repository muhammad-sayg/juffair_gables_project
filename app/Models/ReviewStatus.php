<?php

namespace App\Models;
use App\Models\ReviewStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewStatus extends Model
{
    use HasFactory;
    
    public function review_status(){
        return $this->belongsTo(ReviewStatus::class, 'review_status_code', 'review_status_code');
    }
}
