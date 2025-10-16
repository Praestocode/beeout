<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\PlaceController;
use App\Http\Controllers\api\v1\UserController;



/*
|
|----------------------------------------------------------------
| API Routes
|----------------------------------------------------------------
|
*/

if(!defined('_VERS')) {
    define('_VERS', 'v1');
}

// ----- Public APIs ----- // ----- Public APIs ----- // ----- Public APIs ----- // ----- Public APIs ----- //
Route::post(_VERS . '/login', [UserController::class, 'login']);
Route::get(_VERS . '/places', [PlaceController::class, 'index']); // show resources
Route::get(_VERS . '/places/{place}', [PlaceController::class, 'show']); // show single resource
// ----- Public APIs ----- // ----- Public APIs ----- // ----- Public APIs ----- // ----- Public APIs ----- //
/*
 * 
 * 
 * 
 */
// ----- Auth APIs ----- // ----- Auth APIs ----- // ----- Auth APIs ----- // ----- Auth APIs ----- //
Route::middleware('auth:api')->group(function () {
    Route::post(_VERS . '/logout', [UserController::class, 'logout']);
    Route::post(_VERS . '/places', [PlaceController::class, 'store']);    // create place
    Route::put(_VERS . '/places/{place}', [PlaceController::class, 'update']); // update place
    Route::delete(_VERS . '/places/{place}', [PlaceController::class, 'destroy']); // delete place
});
// ----- Auth APIs ----- // ----- Auth APIs ----- // ----- Auth APIs ----- // ----- Auth APIs ----- //
?>