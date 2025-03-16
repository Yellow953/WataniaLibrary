<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Helpers\Helper;
use App\Models\Business;
use App\Models\Currency;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'image', 'name', 'email', 'role', 'phone', 'business_id')->filter()->orderBy('id', 'desc')->paginate(25);
        $roles = Helper::get_roles();
        $businesses = Business::select('id', 'name')->get();

        return view('users.index', compact('users', 'roles', 'businesses'));
    }

    public function new()
    {
        $businesses = Business::select('id', 'name')->get();
        $currencies = Currency::select('id', 'name')->get();
        $roles = Helper::get_roles();

        $data = compact('businesses', 'currencies', 'roles');
        return view('users.new', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
            'role' => 'required',
            'business_id' => 'required',
            'currency_id' => 'required',
            'password' => 'required|max:255|confirmed',
        ]);

        User::create([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'phone' => $request->phone,
            'image' => 'assets/images/default_profile.png',
            'business_id' => $request->business_id,
            'currency_id' => $request->currency_id,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        $text = ucwords(auth()->user()->name) . " created User : " . $request->name . ", datetime :   " . now();
        Log::create([
            'text' => $text,
        ]);

        return redirect()->route('users')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        $businesses = Business::select('id', 'name')->get();
        $currencies = Currency::select('id', 'name')->get();
        $roles = Helper::get_roles();

        $data = compact('user', 'businesses', 'currencies', 'roles');
        return view('users.edit', $data);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'role' => 'required',
            'business_id' => 'required',
            'currency_id' => 'required',
        ]);

        $user->update([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'phone' => $request->phone,
            'business_id' => $request->business_id,
            'currency_id' => $request->currency_id,
            'role' => $request->role,
        ]);

        if ($user->name != trim($request->name)) {
            $text = ucwords(auth()->user()->name) . ' updated User ' . $user->name . " to " . $request->name . ", datetime :   " . now();
        } else {
            $text = ucwords(auth()->user()->name) . ' updated User ' . $user->name . ", datetime :   " . now();
        }

        Log::create([
            'text' => $text,
        ]);

        return redirect()->route('users')->with('success', 'User created successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->can_delete()) {
            $text = ucwords(auth()->user()->name) . " deleted user : " . $user->name . ", datetime :   " . now();

            Log::create([
                'text' => $text,
            ]);
            $user->delete();

            return redirect()->back()->with('error', 'User deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Unothorized Access...');
        }
    }

    public function terms()
    {
        return view('users.terms');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
