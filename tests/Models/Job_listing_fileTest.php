<?php

namespace Tests\Models;

use App\Models\Job_listing_file;
use App\Traits\Notifiable;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\TestCase;

class Job_listing_fileTest extends TestCase
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
}
