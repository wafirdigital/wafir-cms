<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends AppModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

}
