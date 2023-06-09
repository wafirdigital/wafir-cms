<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppModel extends Model
{
    use HasFactory, SoftDeletes;

    protected function runSoftDelete()
    {
        $query = $this->newQuery()->where($this->getKeyName(), $this->getKey());

        $this->{$this->getDeletedAtColumn()} = $time = $this->freshTimestamp();

        $deleted_by = (auth()->user()->id) ?: null;

        $query->update(array(
        $this->getDeletedAtColumn() => $this->fromDateTime($time), 
        'deleted_by' => $deleted_by
        ));
    }

    protected static function boot()
    {

        parent::boot();

        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });

        static::deleting(function ($model) {
            if (!$model->isDirty('deleted_by')) {
                $model->deleted_by = auth()->user()->id;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
