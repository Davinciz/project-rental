<?php 

namespace App\Http\Controllers;

use App\Models\Console;
use App\Models\Television;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $consoles = Console::where('status', 'available')->get();
        $televisions = Television::where('status_television', 'available')->get();

        return view('homepage', compact('consoles', 'televisions'));
    }
}
