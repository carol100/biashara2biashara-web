<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, Uuids, SoftDeletes;
    protected $guarded = [];

    public function users(){

        return $this->hasMany(User::class);
    }

    public function payment_methods()
    {
        return $this->hasMany(PaymentMethod::class);
    }
}
