<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    const PAGE_COUNT_10 = 10;

    protected $fillable = ['name','website','logo','email','address'];
}
