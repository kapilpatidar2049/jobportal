<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobportalNotification extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','message','read'];
}
