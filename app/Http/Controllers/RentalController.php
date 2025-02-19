<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Console;
use App\Models\Television;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RentalController extends Controller
{
    public function index()
    {
        $consoles = Console::where('status', 'available')->get();
        $televisions = Television::where('status_television', 'available')->get();
        
        return view('rental', compact('consoles', 'televisions'));
    }

    // Ambil data console dan televisi yang statusnya available
    public function create() 
    {
        $consoles = Console::where('status', 'available')->get();
        $televisions = Television::where('status_television', 'available')->get();

        return view('rental', compact('consoles', 'televisions'));
    }   

    // Fungsi untuk menyimpan data rental
    public function store(Request $request) 
    {
        $request->validate([
            'console_id' => 'nullable|exists:consoles,id',
            'television_id' => 'nullable|exists:televisions,id',
            'rent_day' => 'required|integer|min:1|max:3',
            'start_date' => 'required|date',
            'total_price' => 'required|numeric|min:0',
        ]);
    
        try {
            $randomCode = strtoupper(substr(md5(uniqid()), 0, 5));
            $code = "ID-" . $randomCode;
            $end_date = date('Y-m-d H:i:s', strtotime($request->start_date . ' + ' . $request->rent_day . ' days'));
    
            $rental = Rental::create([
                'user_id' => Auth::id(),
                'code' => $code,
                'console_id' => $request->console_id,
                'television_id' => $request->television_id,
                'rent_day' => $request->rent_day,
                'start_date' => $request->start_date,
                'end_date' => $end_date,
                'total_price' => $request->total_price,
                'status' => 'Pending',
            ]);
    
            if ($request->console_id) {
                Console::where('id', $request->console_id)->update(['status' => 'not_available']);
            }
            if ($request->television_id) {
                Television::where('id', $request->television_id)->update(['status_television' => 'not_available']);
            }
    
            $user = Auth::user();
            $console = Console::find($request->console_id);
            $television = Television::find($request->television_id);
            
            $message = "Halo, saya ingin menyewa:\n";
            $message .= "- Kode Rental: {$code}\n";
            $message .= "- Console: " . ($console ? $console->name : "Tidak dipilih") . "\n";
            $message .= "- Televisi: " . ($television ? $television->model : "Tidak dipilih") . "\n";
            $message .= "- Durasi: {$rental->rent_day} hari\n";
            $message .= "- Harga Total: Rp " . number_format($rental->total_price, 0, ',', '.') . "\n";
            $message .= "- Mulai: " . date('d-m-Y H:i', strtotime($request->start_date)) . "\n";
            $message .= "- Berakhir: " . date('d-m-Y H:i', strtotime($end_date)) . "\n";
            $message .= "\nMohon konfirmasi pesanan saya. Terima kasih!";

            $whatsappNumber = '6289501265224';
            $whatsappUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);
    
            return response()->json([
                'success' => true,
                'message' => 'Rental berhasil dibuat!',
                'rental' => $rental,
                'whatsapp_url' => $whatsappUrl
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // Fungsi untuk membatalkan pesanan
    public function cancel(Rental $rental)
    {
        if ($rental->status !== 'Pending') {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak bisa dibatalkan.']);
        }

        $rental->update(['status' => 'canceled']);

        if ($rental->console_id) {
            Console::where('id', $rental->console_id)->update(['status' => 'available']);
        }

        if ($rental->television_id) {
            Television::where('id', $rental->television_id)->update(['status_television' => 'available']);
        }

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil dibatalkan.']);
    }


    

}
