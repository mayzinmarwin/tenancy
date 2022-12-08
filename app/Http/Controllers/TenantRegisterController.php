<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
class TenantRegisterController extends Controller
{
    //
    public function register(Request $request){
        $name = $request->input('name');
        $domain = $name.'.'.'localhost';
        $tenant = Tenant::create(['id' => $name]);
        $tenant->domains()->create(['domain' => $domain]);
    }
    public function login(Request $request) {
        $name = $request->input('name');
        $user = Tenant::where('id', $name)->firstOrFail();
    }
}
