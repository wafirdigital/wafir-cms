<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppModel;

class Media extends AppModel
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

}
