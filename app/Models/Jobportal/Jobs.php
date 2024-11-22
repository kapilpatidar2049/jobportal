<?php

namespace App\Models\Jobportal;

use App\Models\JobPortalUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    protected $table = 'jobportaljobs';

    protected $fillable = [
        'user_id',
        'language',
        'country',
        'title',
        'type',
        'city',
        'state',
        'area',
        'address',
        'pincode',
        'adscity',
        'job_type',
        'timelength',
        'timeperiod',
        'showby',
        'schedule',
        'startdate',
        'startdatefield',
        'numberofpeople',
        'recruitment_timeline',
        'pay',
        'exactamount',
        'minimumamount',
        'maximumamount',
        'rate',
        'supplement',
        'benefit',
        'job_description'
    ];

    protected $casts = [
        'job_type' => 'array',
        'schedule' => 'array',
        'supplement' => 'array',
        'benefit' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(JobPortalUser::class)->withDefault();
    }
    public function candidates()
    {
        return $this->hasMany(JobportalCandidate::class);
    }
}
