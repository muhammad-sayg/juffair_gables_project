<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';

    public function tenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }
}
