<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('iptv/login', 'IptvController@login')->named('iptv.login');
