<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function __construct(){
      $this->middleware('permission:dashboard index')->only('index');
      $this->middleware('permission:dashboard create')->only(['create','store']);
      $this->middleware('permission:dashboard update')->only(['edit','update']);
      $this->middleware('permission:dashboard delete')->only('destroy');
   }

   public function index()
   {
      /* $userId = auth()->id();       
      $role = Role::find($userId); */

      /* $user = Auth::user();
      if ($user->hasRole('admin')) {
        echo "You are an admin!";
      } else if ($user->hasRole('trainer')) {
         echo "You are a trainer!";
      } else if ($user->hasRole('member')) {
         echo "You are a member!";
      } else {
         echo "You are not authorized!";
      }  */
      
      
      $members = \App\Models\Member::count();
      $maleMembers = \App\Models\Member::where('gender', 'male')->count();
      $femaleMembers = \App\Models\Member::where('gender', 'female')->count();
      $activeMembers = \App\Models\Member::where('status', 'active')->count();
      $inactiveMembers = \App\Models\Member::where('status', 'inactive')->count();
      
      $services = \App\Models\Service::count();
      $trainers = \App\Models\Trainer::count();
      $users = \App\Models\User::count();
      
      return view('dashboard', compact(
         'members',
         'maleMembers',
         'femaleMembers',
         'services',
         'trainers',
         'activeMembers',
         'inactiveMembers',
         'users',
      ));
   }
}
