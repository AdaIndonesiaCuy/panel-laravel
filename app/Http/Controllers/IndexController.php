<?php

// app/Http/Controllers/IndexController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $asset_dir = 'css/';

        return view('index', ['asset_dir' => $asset_dir]);
    }
}

