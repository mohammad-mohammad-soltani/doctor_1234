<?php

use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\ManagerAuth::class)->group(function () {
    Route::get("/" , [\App\Http\Controllers\Manager::class, "panel"]) -> name("manager.dashboard");
});
Route::get("/login" , [\App\Http\Controllers\Manager::class , 'login'])->name("manager.login");
Route::post("/login" , [\App\Http\Controllers\Manager::class , 'login_post'])->name("manager.login_post");
