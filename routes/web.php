<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {

    $allowedIpList = ['127.0.0.19'];

    echo(in_array($request->ip(), $allowedIpList) ? "autorizado" : "NO AUTORIZADO");

    // return view('welcome');
});
