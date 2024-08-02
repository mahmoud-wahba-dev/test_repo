<?php

use App\Http\Controllers\Api\Doctor\Account\AccountController;
use App\Http\Controllers\Api\Doctor\Appointment\AppointmentController;
use App\Http\Controllers\Api\Doctor\Auth\AuthController;
use App\Http\Controllers\Api\Doctor\Disease\DiseaseController;
use App\Http\Controllers\Api\Doctor\Patient\PatientController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'api.'
],function (){
    Route::group([
        'as' => 'doctor.',
        'prefix' => 'doctor'
    ],function (){

        Route::group([
            'as' => 'auth.',
            'prefix' => 'auth'
        ], function (){
            Route::post('login', [AuthController::class, 'login'])->name('login');
        });

        Route::group([
            'middleware' => [
                Authenticate::class . ':sanctum',
            ]
        ],function (){
            /**
             * account routes
             */
            Route::group([
                'as' => 'account.',
                'prefix' => 'account'
            ],function (){
                Route::get('me', [AccountController::class, 'show'])->name('me');
                Route::put('', [AccountController::class, 'update'])->name('update');
            });

            /**
             * patient routes
             */
            Route::group([
                'as' => 'patients.',
            ],function (){
                Route::apiResource('patients' , PatientController::class);
            });

            /**
             * diseases routes
             */
            Route::group([
                'as' => 'diseases.'
            ], function (){
                Route::apiResource('diseases', DiseaseController::class);
            });


            /**
             * appointments
             */
            Route::group([
                'as' => 'appointments.'
            ], function (){
                Route::apiResource('appointments' , AppointmentController::class);
            });

        });

    });
});
