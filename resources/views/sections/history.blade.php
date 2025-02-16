<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex items-center mb-4">
        <i class="fas fa-history mr-2"></i>
        <span class="font-bold text-lg">History</span>
    </div>

    <div>
        <input type="text" wire:model="search" placeholder="Cari kode atau console..." class="form-control mb-4" />
    
        <div class="space-y-4">
            @foreach ($histories as $history)
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
    
                        <button wire:click="$emit('showRentalDetail', {{ $history->id }})"
                            class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">
                            Detail
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>    
{{-- </div>
    <div class="space-y-4">
        @foreach ($historys as $history)
            <div class="flex justify-between items-center bg-gray-100 rounded-lg p-4 shadow-sm">
                <div class="flex flex-col">
                    <p class="font-bold text-lg">{{ $history->console->name }}</p>
                    <p class="text-gray-600 text-sm">{{ $history->code }}</p>
                    <p class="text-gray-600 text-sm">{{ $history->start_date }}</p>
                    <p class="text-gray-800 font-semibold">Rp {{ number_format($history->total_price, 0, ',', '.') }}
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    @if ($history->status === 'disewa')
                        <span class="bg-yellow-200 text-yellow-600 px-3 py-1 rounded-lg text-sm">Disewa</span>
                    @elseif($history->status === 'dibatalkan')
                        <span class="bg-red-200 text-red-600 px-3 py-1 rounded-lg text-sm">Dibatalkan</span>
                    @elseif($history->status === 'dikembalikan')
                        <span class="bg-green-200 text-green-600 px-3 py-1 rounded-lg text-sm">Dikembalikan</span>
                    @endif

                    <button wire:click="$emit('showRentalDetail', {{ $history->id }})"
                        class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">
                        Detail
                    </button>
                    
                </div>
            </div>
        @endforeach
    </div>
    @livewire('history-search')
</div> --}}
