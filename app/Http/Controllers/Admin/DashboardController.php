<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    use ApiResponse;

    public function index()
    {
        return view('Admin.dashboard.index');
    }

}
