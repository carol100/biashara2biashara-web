<?php

namespace Tests;

use CreateJobApplicationsTable;
use PHPUnit\Framework\TestCase;

class CreateJobApplicationsTableTest extends TestCase
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
