<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamMember;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard');
    }
}
