<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Criteria;
use App\Models\Position;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index ()
    {

        // $user = User::all()->count();
        // $employee = Employee::all()->count();
        return view('admin.dashboard.index',);
        // return view('admin.dashboard.index', compact('user','employee'));
    }
}
