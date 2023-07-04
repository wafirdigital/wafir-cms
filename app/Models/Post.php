<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function boot()
    {

        parent::boot();
   
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = !is_null(auth()->user()) ? auth()->user()->id : null;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = !is_null(auth()->user()) ? auth()->user()->id : null;
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = is_null(auth()->user()) ? auth()->user()->id : null;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
