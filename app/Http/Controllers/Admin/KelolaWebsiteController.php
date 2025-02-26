<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class KelolaWebsiteController extends Controller
{
    public function ShowKelolaWebsite(){
        $panorama = DB::table('ms_panorama')->get();
        return view('admin.kelola-website.website',compact('panorama'));
    }
}