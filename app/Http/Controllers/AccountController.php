<?php

namespace App\Http\Controllers;

use App\Models\Console;
use App\Models\HistoryRental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $historys = HistoryRental::get();
        $consoles = Console::get();
        $historys = HistoryRental::where('user_id', auth::id())->get();
    
        return view('account', compact('historys', 'consoles'));
    }

    public function search(Request $request)
    {
        $query = HistoryRental::query();

        if ($request->has('search')) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }

        $historys = $query->paginate(10);

        return view('account', compact('historys'));
    }
}

