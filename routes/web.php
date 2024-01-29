<?php

use App\Http\Controllers\ExecutionController;
use App\Http\Controllers\GroupingController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\OprUnitController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubcatinspectionController;
use App\Http\Controllers\SubplanningController;
use App\Http\Controllers\ThirdlayerinspectionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('oprunits', OprUnitController::class);
    Route::resource('inspections', InspectionController::class);
    Route::get('inspections/search', [InspectionController::class, 'search'])->name('inspections.search');
    Route::get('inspections/clear', [InspectionController::class, 'clearIndex'])->name('inspections.clear');

    Route::controller(SubcatinspectionController::class)->group(function() {
        Route::get('/inspections/{id}/sub-inspection/search', 'SubcatInspectionController@search')->name('inspections.sub.search');
        Route::get('/inspections/{id}/sub-inspection', 'index')->name('inspections.sub.index');
        Route::get('/inspections/{id}/sub-inspection-create', 'create')->name('inspections.sub.create');
        Route::post('/inspections/{id}/sub-inspection-store', 'store')->name('inspections.sub.store');
        Route::get('/inspections/{id}/sub-inspection/{sub_id}', 'edit')->name('inspections.sub.edit');
        Route::put('/inspections/{id}/sub-inspection/{sub_id}', 'update')->name('inspections.sub.update');
        Route::delete('/inspections/{id}/sub-inspection/{sub_id}/destroy', 'destroy')->name('inspections.sub.destroy');
     
    });
    Route::controller(ThirdlayerinspectionsController::class)->group(function() {
        Route::get('/inspections/{id}/sub-inspection/{sub_id}/third/search', 'ThirdlayerinspectionsController@search')->name('inspections.sub.third.search');
        Route::get('/inspections/{id}/sub-inspection/{sub_id}/third', 'index')->name('inspections.sub.third.index');
        Route::get('/inspections/{id}/sub-inspection-create/{sub_id}/third-create', 'create')->name('inspections.sub.third.create');
        Route::post('/inspections/{id}/sub-inspection-store/{sub_id}/third-store', 'store')->name('inspections.sub.third.store');
        Route::get('/inspections/{id}/sub-inspection/{sub_id}/third/{third_id}', 'edit')->name('inspections.sub.third.edit');
        Route::put('/inspections/{id}/sub-inspection/{sub_id}/third/{third_id}', 'update')->name('inspections.sub.third.update');
        Route::delete('/inspections/{id}/sub-inspection/{sub_id}/third/{third_id}/destroy', 'destroy')->name('inspections.sub.third.destroy');
    });
    

     
    Route::controller(SubplanningController::class)->group(function() {
        Route::get('/plannings/{id}/sub-planning', 'index')->name('plannings.sub.index');
        Route::get('/plannings/{id}/sub-planning-create', 'create')->name('plannings.sub.create');
        Route::post('/plannings/{id}/sub-planning-store', 'store')->name('plannings.sub.store');
        Route::get('/plannings/{id}/sub-planning/{sub_id}', 'edit')->name('plannings.sub.edit');
        Route::put('/plannings/{id}/sub-planning/{sub_id}', 'update')->name('plannings.sub.update');
        Route::delete('/plannings/{id}/sub-planning/{sub_id}/destroy', 'destroy')->name('plannings.sub.destroy');
 });

 Route::controller(ExecutionController::class)->group(function() {
    Route::get('/plannings/{id}/sub-planning/{sub_id}/execution/search', 'ExecutionController@search')->name('plannings.sub.execution.search');
    Route::get('/plannings/{id}/sub-planning/{sub_id}/execution', 'index')->name('plannings.sub.execution.index');
    Route::get('/plannings/{id}/sub-planning-create/{sub_id}/execution-create', 'create')->name('plannings.sub.execution.create');
    Route::post('/plannings/{id}/sub-planning-store/{sub_id}/execution-store', 'store')->name('plannings.sub.execution.store');
    Route::get('/plannings/{id}/sub-planning/{sub_id}/execution/{execution_id}', 'edit')->name('plannings.sub.execution.edit');
    Route::put('/plannings/{id}/sub-planning/{sub_id}/execution/{execution_id}', 'update')->name('plannings.sub.execution.update');
    Route::delete('/plannings/{id}/sub-planning/{sub_id}/execution/{execution_id}/destroy', 'destroy')->name('plannings.sub.execution.destroy');
    Route::get('/plannings/{id}/sub-planning/{sub_id}/PDF', 'generatePDF')->name('plannings.sub.printpdf');
   

});


  

    Route::resource('plannings', PlanningController::class);
    // Route::resource('groupings', GroupingController::class);
    Route::controller(GroupingController::class)->group(function() {
        Route::get('/groupings', 'index')->name('groupings.index');
        Route::get('/groupings-create', 'create')->name('groupings.create');
        Route::post('/groupings-store', 'store')->name('groupings.store');
        Route::get('/groupings/{group}/edit', 'edit')->name('groupings.edit');
        Route::put('/groupings/{group}', 'update')->name('groupings.update');
        Route::get('/groupings/{group}', 'show')->name('groupings.show');
        Route::delete('/groupings/{group}/destroy', 'destroy')->name('groupings.destroy');
        Route::delete('/groupings/{group}/users/{user}', 'destroyUserGroup')->name('groupings.user.destroyUserGroup');
    });

    Route::controller(ZoneController::class)->group(function() {
        Route::get('/zones', 'index')->name('zones.index');
        Route::get('/zones-create', 'create')->name('zones.create');
        Route::post('/zones-store', 'store')->name('zones.store');
        Route::get('/zones/{zone}/edit', 'edit')->name('zones.edit');
        Route::put('/zones/{zone}', 'update')->name('zones.update');
        Route::get('/zones/{zone}', 'show')->name('zones.show');
        Route::delete('/zones/{zone}/destroy', 'destroy')->name('zones.destroy');
        Route::delete('/zones/{zone}/groups/{group}', 'destroyGroup')->name('zones.group.destroyGroup');
    });
    // Route::resource('groupusers', GroupUserController::class);
    // Route::resource('inspectionform', InspectionformController::class);

});

Route::get('/testing', function () {
    return view('testing');
});