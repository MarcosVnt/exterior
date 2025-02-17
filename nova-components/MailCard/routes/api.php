<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });

Route::post('/send-mail', function (Request $request) {

    // This is where you'll send your mail
    // Mail::to($request->email)->send(new MyMailer());

    sleep(2);  // For example we'll sleep the process for 2 seconds before returning a response

    return response()->json([
        'code' => '200',
        'email' => $request->email
    ]);
});
