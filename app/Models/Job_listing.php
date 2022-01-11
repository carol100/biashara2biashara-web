<?php

namespace App\Models;

use App\Traits\Notifiable;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job_listing extends Model
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

    public function job_applications()
    {
        return $this->hasMany(Job_application::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
