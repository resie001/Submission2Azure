<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AzureController extends Controller
{
    public function index()
    {
        return view('landing');
    }
}
