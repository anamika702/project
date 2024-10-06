<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Strona_glownaController extends Controller
{
    public function index()
    {
        return view('strona_glowna');
    }
}
