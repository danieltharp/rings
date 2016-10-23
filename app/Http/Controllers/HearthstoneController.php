<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realm;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class HearthstoneController extends Controller
{
    public function confirm($guid)
    {
    $chartohearth = Auth::user()->characters()->find($guid)->first();
        if($chartohearth) {
            return view('hearth.confirm', compact('chartohearth'));
        } else {
            abort(403);
        }

    }
}
