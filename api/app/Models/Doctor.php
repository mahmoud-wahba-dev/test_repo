<?php

namespace App\Models;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends User
{
    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->contexts()->syncWithoutDetaching(Context::whereIn('name', [UserType::DOCTOR])->pluck('id')->toArray());
        });
    }

    /**
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('patient', function (Builder $builder) {
            $builder->whereHas('contexts', function (Builder $builder) {
                $builder->whereIn('name', [UserType::PATIENT]);
            });
        });
    }
}
