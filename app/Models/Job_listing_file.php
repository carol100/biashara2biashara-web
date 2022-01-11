<?php

namespace App\Models;

use App\Traits\Notifiable;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job_listing_file extends Model
{

    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use Uuids;

    protected $guarded = [];
    public $incrementing = false;

    public function getCreatedAtAttribute($key)
    {
        return Carbon::parse($key)->format('Y-m-d h:m');
    }

    public function job_listing()
    {
        return $this->belongsTo(Job_listing::class);
    }
}
