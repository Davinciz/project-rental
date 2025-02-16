<div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center mb-4">
            <i class="fas fa-history mr-2"></i>
            <span class="font-bold text-lg">History</span>
        </div>
    
        <div class="space-y-4">
            @foreach ($historys as $history)
                <div class="flex justify-between items-center bg-gray-100 rounded-lg p-4 shadow-sm">
                    <div class="flex flex-col">
                        <p class="font-bold text-lg">{{ $history->console->name }}</p>
                        <p class="text-gray-600 text-sm">{{ $history->code }}</p>
                        <p class="text-gray-600 text-sm">{{ $history->start_date }}</p>
                        <p class="text-gray-800 font-semibold">Rp {{ number_format($history->total_price, 0, ',', '.') }}</p>
                    </div>
    
                    <div class="flex items-center gap-3">
                        @if ($history->status === 'disewa')
                            <span class="bg-yellow-200 text-yellow-600 px-3 py-1 rounded-lg text-sm">Disewa</span>
                        @elseif($history->status === 'dibatalkan')
                            <span class="bg-red-200 text-red-600 px-3 py-1 rounded-lg text-sm">Dibatalkan</span>
                        @elseif($history->status === 'dikembalikan')
                            <span class="bg-green-200 text-green-600 px-3 py-1 rounded-lg text-sm">Dikembalikan</span>
                        @endif
    
                        <button wire:click="showDetail({{ $history->id }})"
                            class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">
                            Detail
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    
        <!-- Modal Detail -->
        @if($showDetailModal && $selectedRental)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40" wire:click="closeDetail"></div>
        
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6" @click.away="closeDetail">
                <!-- Header Section -->
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-bold">Detail Rental</h2>
                    <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-lg text-sm">
                        {{ $selectedRental->status }}
                    </span>
                </div>
                
                <!-- UID Section -->
                <div class="text-gray-600 mb-4">
                    {{ $selectedRental->code }}
                </div>
                
                <!-- Details Section -->
                <div class="space-y-3">
                    <!-- Console -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">{{ $selectedRental->console->name }}</span>
                        <span class="font-medium">Rp {{ number_format($selectedRental->console_price, 0, ',', '.') }}</span>
                    </div>
                    
                    <!-- TV if exists -->
                    @if($selectedRental->television)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">{{ $selectedRental->television->name }}</span>
                        <span class="font-medium">Rp {{ number_format($selectedRental->television_price, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    <!-- Durasi -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Durasi Sewa:</span>
                        <span class="font-medium">{{ $selectedRental->rent_day }} Hari</span>
                    </div>
                    
                    <!-- Tanggal Sewa -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Tanggal Sewa:</span>
                        <span class="font-medium">{{ $selectedRental->start_date }}</span>
                    </div>
                    
                    <!-- Sewa Berakhir -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Sewa Berakhir:</span>
                        <span class="font-medium">{{ $selectedRental->end_date }}</span>
                    </div>
                    
                    <!-- Divider -->
                    <div class="border-t my-3"></div>
                    
                    <!-- Denda -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Denda</span>
                        <span class="font-medium">-</span>
                    </div>
                    
                    <!-- Total -->
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-gray-700">Total</span>
                        <span class="font-bold">Rp {{ number_format($selectedRental->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <!-- Message -->
                <div class="text-center text-gray-600 text-sm mt-6">
                    Mohon tunggu Admin untuk mengecek data anda
                </div>
                
                <!-- Button -->
                <button wire:click="closeDetail"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg mt-4 hover:bg-indigo-700 transition duration-200">
                    Terimakasih Sudah Menyewa
                </button>
            </div>
        </div>
        @endif
    </div></div>
