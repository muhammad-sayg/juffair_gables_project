<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'contact_person',
        'job_title',
        'number',
        'scope_of_work',
    ];
}
