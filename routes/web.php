<?php

use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\ManagerAuth::class)->group(function () {
    Route::get("/" , [\App\Http\Controllers\Manager::class, "panel"]) -> name("manager.dashboard");
    Route::get("/add_client" , [\App\Http\Controllers\Manager::class, "add_client"]) -> name("manager.add_client");
    Route::get("/clinic" , [\App\Http\Controllers\Manager::class, "manage_client"]) -> name("manager.clinic");
    Route::get("/doctors" , [\App\Http\Controllers\Manager::class, "add_client"]) -> name("manager.doctors");
    Route::get("/origins" , [\App\Http\Controllers\Manager::class, "add_client"]) -> name("manager.origins");
    Route::prefix("api")->group(function () {
        Route::post("add_clinic" , [\App\Http\Controllers\Manager::class, "add_clinic"]);
        Route::post("add_doctor" , [\App\Http\Controllers\Manager::class, "add_doctor"]);
        Route::post("add_origin" , [\App\Http\Controllers\Manager::class, "add_origin"]);
    });
});
Route::get("/login" , [\App\Http\Controllers\Manager::class , 'login'])->name("manager.login");
Route::post("/login" , [\App\Http\Controllers\Manager::class , 'login_post'])->name("manager.login_post");
