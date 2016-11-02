<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PermissionsController extends Controller
{
    public function index()
    {
        $humanreadable = DB::connection('auth')->table('rbac_permissions')->get();
        $lids = [];
        foreach ($humanreadable as $lineitem) { $lids[$lineitem->id] = $lineitem->name; }
        $perms = DB::connection('auth')->table('rbac_linked_permissions')->get();
        foreach ($perms as $perm) {
            $perm->oid = $perm->id;
            $perm->id = $lids[$perm->id];
            $perm->olid = $perm->linkedId;
            $perm->linkedId = $lids[$perm->linkedId];
        }
        return view('permissions.default.index', compact('perms'));
    }

    public function update(Request $request)
    {
        DB::transaction(function() {
            $perms = Input::except('_token');
            foreach ($perms as $lid => $id) {
                DB::connection('auth')->table('rbac_linked_permissions')->where('linkedId', $lid)->update(['id' =>
                    $id]);
            }
        });
        session()->flash('status', 'Permissions updated successfully. Please ".reload rbac" in-game or 
        "reload rbac" from the Trinity CLI.');
        return redirect()->to('/admin/permissions');
    }
}
