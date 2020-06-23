<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function noView()
    {
        return 'Esta aplicação não possui interface de interação com telas !!';
    }

}
