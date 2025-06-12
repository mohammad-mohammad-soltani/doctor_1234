<?php

use Illuminate\Support\Facades\Route;
Route::prefix('Manager')->group(function () {
    Route::get("/login" , [\App\Http\Controllers\Manager::class , 'login'])->name("manager.login");
    Route::post("/login" , [\App\Http\Controllers\Manager::class , 'login_post'])->name("manager.login_post");
    Route::middleware(\App\Http\Middleware\ManagerAuth::class)->group( function () {
        Route::get("/" , [\App\Http\Controllers\Manager::class, "panel"]) -> name("manager.dashboard");
        Route::get("/add_client" , [\App\Http\Controllers\Manager::class, "add_client"]) -> name("manager.add_client");
        Route::get("/products" , [\App\Http\Controllers\Manager::class, "products"]) -> name("manager.products");
        Route::get("/doctors" , [\App\Http\Controllers\Manager::class, "add_client"]) -> name("manager.doctors");
        Route::get("/origins" , [\App\Http\Controllers\Manager::class, "add_client"]) -> name("manager.origins");
        Route::get("/settings" , [\App\Http\Controllers\Manager::class, "settings"]) -> name("manager.settings");
        Route::get("/clinic" , [\App\Http\Controllers\Manager::class, "clinic"]) -> name("manager.clinic");
        Route::get("/clinic/{id}" , [\App\Http\Controllers\Manager::class, "clinic2"]) -> name("manager.clinic_2");
        Route::get("/category" , [\App\Http\Controllers\Manager::class, "category"]) -> name("manager.category");
        Route::prefix("api")->group(function () {
            Route::post('update_clinic', [\App\Http\Controllers\Manager::class, 'update_clinic'])->name('manager.update_clinic');
            Route::post("add_clinic" , [\App\Http\Controllers\Manager::class, "add_clinic"]);
            Route::post("add_doctor" , [\App\Http\Controllers\Manager::class, "add_doctor"]);
            Route::post("add_origin" , [\App\Http\Controllers\Manager::class, "add_origin"]);
            Route::post("delete_product" , [\App\Http\Controllers\Manager::class, "delete_product"]);
            Route::post("delete_category" , [\App\Http\Controllers\Manager::class, "delete_category"]);
            Route::post("delete_clinic" , [\App\Http\Controllers\Manager::class, "delete_clinic"]);
            Route::post("add_product" , [\App\Http\Controllers\Manager::class, "add_product"]);
            Route::get("get_origins" , [\App\Http\Controllers\Manager::class, "get_origins"]);
            Route::get("get_doctor" , [\App\Http\Controllers\Manager::class, "get_doctor"]);
            Route::get("get_origin" , [\App\Http\Controllers\Manager::class, "get_origin"]);
            Route::post("delete_doctor" , [\App\Http\Controllers\Manager::class, "delete_doctor"]);
            Route::post("edite_doctor" , [\App\Http\Controllers\Manager::class, "edite_doctor"]);
            Route::post("edite_origin" , [\App\Http\Controllers\Manager::class, "edite_origin"]);
            Route::post("delete_origin" , [\App\Http\Controllers\Manager::class, "delete_origin"]);

        });
    });
});

Route::prefix('Receptionist')->group(function () {
    Route::get("/login" , [\App\Http\Controllers\Origin::class , 'login'])->name("origin.login");
    Route::post("/login" , [\App\Http\Controllers\Origin::class , 'login_post'])->name("origin.login_post");
    Route::middleware(\App\Http\Middleware\OriginAuth::class)->group( function () {
        Route::get("/" , [\App\Http\Controllers\Origin::class, "panel"]) -> name("origin.dashboard");
        Route::get("/products" , [\App\Http\Controllers\Origin::class, "products"]) -> name("origin.products");
        Route::get("/calendar" , [\App\Http\Controllers\Origin::class, "calendar"]) -> name("origin.calendar");
        Route::get("/calendar/{id}" , [\App\Http\Controllers\Origin::class, "calendar_edite"]) -> name("origin.calendar_edite");
        Route::get("/category" , [\App\Http\Controllers\Origin::class, "category"]) -> name("origin.category");
//        Route::get("/clinic" , [\App\Http\Controllers\Origin::class, "clinic"]) -> name("origin.clinic");

        Route::prefix("api")->group(function () {
            Route::post("add_category" , [\App\Http\Controllers\Origin::class, "add_category"]);
            Route::post("delete_product" , [\App\Http\Controllers\Origin::class, "delete_product"]);
            Route::post("add_product" , [\App\Http\Controllers\Origin::class, "add_product"]);
            Route::post("add_calendar" , [\App\Http\Controllers\Origin::class, "add_calendar"]);
            Route::post("edite_calendar" , [\App\Http\Controllers\Origin::class, "edite_calendar"]);
            Route::post("delete_calendar" , [\App\Http\Controllers\Origin::class, "delete_calendar"]);
            Route::post("delete_category" , [\App\Http\Controllers\Manager::class, "delete_category"]);

        });
    });
});


Route::prefix('Doctor')->group(function () {
    Route::get("/login" , [\App\Http\Controllers\Doctor::class , 'login'])->name("doctor.login");
    Route::post("/login" , [\App\Http\Controllers\Doctor::class , 'login_post'])->name("doctor.login_post");
    Route::get("/calendar/{id}" , [\App\Http\Controllers\Doctor::class, "calendar_edite"]) -> name("doctor.calendar_edite");

    Route::middleware(\App\Http\Middleware\DoctorAuth::class)->group( function () {
        Route::get("/" , [\App\Http\Controllers\Doctor::class, "panel"]) -> name("doctor.dashboard");
        Route::prefix("api")->group(function () {
            Route::post("edite_calendar" , [\App\Http\Controllers\Doctor::class, "edite_calendar"]);
            Route::post("delete_calendar" , [\App\Http\Controllers\Doctor::class, "delete_calendar"]);

        });
    });
});

Route::get('logout', function () {
    Auth::guard('doctor')->logout();
    Auth::guard('manager')->logout();
    Auth::guard('origin')->logout();

    return redirect("/");
})->name("user.logout");
