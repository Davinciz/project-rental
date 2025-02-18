<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Console;
use App\Models\Television;
use App\Models\HistoryRental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RentalController extends Controller
{
    public function index()
{
    // Ambil semua console dan televisi yang tersedia
    $consoles = Console::where('status', 'available')->get();
    $televisions = Television::where('status_television', 'available')->get();
    
    // Kirim data ke view rental.blade.php
    return view('rental', compact('consoles', 'televisions'));
}

    public function create() {
        $consoles = Console::where('status', 'available')->get();
        $televisions = Television::where('status_television', 'available')->get();

        return view('rental', compact('consoles', 'televisions'));
    }   

    public function store(Request $request) {
        $request->validate([
            'console_id' => 'nullable|exists:consoles,id',
            'television_id' => 'nullable|exists:televisions,id',
            'rent_day' => 'required|integer|min:1|max:3',
            'start_date' => 'required|date',
            'total_price' => 'required|numeric|min:0',
        ]);
    
        try {

            // Generate code unik dengan format "ID-XXXXX"
            $randomCode = strtoupper(substr(md5(uniqid()), 0, 5));
            $code = "ID-" . $randomCode;

            // Hitung tanggal end_date berdasarkan start_date + rent_day
            $end_date = date('Y-m-d H:i:s', strtotime($request->start_date . ' + ' . $request->rent_day . ' days'));
    
            // Simpan ke database
            $rental = Rental::create([
                'user_id' => Auth::id(),
                'code' => $code,
                'console_id' => $request->console_id,
                'television_id' => $request->television_id,
                'rent_day' => $request->rent_day, // ✅ Perbaikan dari rent_dat
                'start_date' => $request->start_date,
                'end_date' => $end_date, // ✅ Perbaikan
                'total_price' => $request->total_price,
                'status' => 'Pending',
            ]);

            // Update status console dan televisi jadi 'not_available'
            if ($request->console_id) {
                Console::where('id', $request->console_id)->update(['status' => 'not_available']);
            }
            if ($request->television_id) {
                Television::where('id', $request->television_id)->update(['status_television' => 'not_available']);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Rental berhasil dibuat!',
                'rental' => $rental
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function cancel(Request $request, Rental $rental)
{

    if ($rental->status !== 'pending') {
        return response()->json(['success' => false, 'message' => 'Pesanan tidak bisa dibatalkan.']);
    }

    // Update status rental
    $rental->update(['status' => 'canceled']);

    // Kembalikan status console dan television jika ada
    if ($rental->console_id) {
        Console::where('id', $rental->console_id)->update(['status' => 'available']);
    }

    if ($rental->television_id) {
        Television::where('id', $rental->television_id)->update(['status_television' => 'available']);
    }

    return response()->json(['success' => true, 'message' => 'Pesanan berhasil dibatalkan.']);
}

    

}

