<?php

namespace App\Http\Controllers;

use App\Models\Console;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class AccountController extends Controller
{
    public function index(Request $request)
{
    $querys = Rental::where('user_id', Auth::id());

    if ($request->has('search') && $request->search) {
        $querys->where('code', 'like', '%' . $request->search . '%')
              ->orWhereHas('console', function ($consoleQuery) use ($request) {
                  $consoleQuery->where('name', 'like', '%' . $request->search . '%');
              });
    }
    
    $querys = $querys->get();
    $consoles = Console::all();    

    return view('account', compact('consoles', 'querys'));
}
}
