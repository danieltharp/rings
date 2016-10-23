<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realm;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HearthstoneController extends Controller
{
    public function confirm($guid)
    {
    $chartohearth = Auth::user()->characters()->where('guid', $guid)->first();
        if($chartohearth) {
            return view('hearth.confirm', compact('chartohearth'));
        } else {
            abort(403);
        }

    }

    public function hearth($guid)
    {
        $chartohearth = Auth::user()->characters()->where('guid', $guid)->first();
        if($chartohearth) {
            $cc = DB::connection('character');
            $customhearth = $cc->table('character_homebind')->where('guid', $guid)->first();
            if ($customhearth) { // They set their own hearthstone.
                $chartohearth->position_x = $customhearth->posX;
                $chartohearth->position_y = $customhearth->posY;
                $chartohearth->position_z = $customhearth->posZ;
                $chartohearth->map = $customhearth->mapId;
                $chartohearth->zone = $customhearth->zoneId;
                if($chartohearth->save()) {
                    session()->flash('status', 'Hearthstone completed successfully. You may now log on.');
                    return redirect()->to('/home');
                }
                else { abort(500); }
            }
            else {
                abort(500);
            }
        }
        else {
            abort(403);
        }
    }
}
