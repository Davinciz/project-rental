<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex flex-wrap items-center justify-between mb-4">
        <div class="flex items-center">
            <i class="fas fa-history mr-2"></i>
            <span class="font-bold text-lg">History</span>
        </div>

        <form method="GET" action="{{ route('account') }}"
            class="flex items-center space-x-2 w-full sm:w-auto mt-2 sm:mt-0">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode"
                class="form-control px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-64" />
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 w-full sm:w-auto">
                Cari
            </button>
        </form>
    </div>

    <div>
        <div class="space-y-4">
            @foreach ($querys as $rental)
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-gray-100 rounded-lg p-4 shadow-sm">
                    <div class="flex flex-col">
                        <p class="font-bold text-lg">{{ $rental->console->name }}</p>
                        <p class="text-gray-600 text-sm">{{ $rental->code }}</p>
                        <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($rental->start_date)->format('d M Y') }}</p>

                        <p class="text-gray-800 font-semibold">Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 mt-3 sm:mt-0">
                        @if ($rental->status === 'pending')
                            <span class="bg-yellow-200 text-yellow-600 px-3 py-1 rounded-lg text-sm">Pending</span>
                        @elseif($rental->status === 'canceled')
                            <span class="bg-red-200 text-red-600 px-3 py-1 rounded-lg text-sm">Dibatalkan</span>
                        @elseif($rental->status === 'accepted')
                            <span class="bg-blue-200 text-blue-600 px-3 py-1 rounded-lg text-sm">Disewa</span>
                        @elseif($rental->status === 'returned')
                            <span class="bg-green-200 text-green-600 px-3 py-1 rounded-lg text-sm">Dikembalikan</span>
                        @else
                            <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-lg text-sm">Tidak Diketahui</span>
                        @endif

                        <button onclick="showRentalDetail({{ json_encode($rental) }})"
                            class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 w-full sm:w-auto">
                            Detail
                        </button>

                        @if ($rental->status === 'pending')
                            <button onclick="cancelRental({{ $rental->id }})"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 w-full sm:w-auto">
                                Batalkan Pesanan
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function cancelRental(rentalId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pesanan akan dibatalkan dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/rental/cancel/${rentalId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Dibatalkan!', 'Pesanan Anda telah dibatalkan.', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Gagal!', data.message, 'error');
                        }
                    });
            }
        });
    }


    function showRentalDetail(history) {
        Swal.fire({
            title: '<span class="text-lg font-bold">Detail Rental</span>',
            html: `
                <div class="bg-white rounded-lg shadow-md p-4 text-left">
                    <p class="text-gray-500 text-sm">Kode Rental:</p>
                    <p class="font-semibold">${history.code}</p>

                    <div class="border-t my-2"></div>
                    
                    <p class="text-gray-500 text-sm">Console:</p>
                    <p class="font-semibold">${history.console?.name}</p>
                    
                    <p class="text-gray-500 text-sm">Television:</p>
                    <p class="font-semibold">${history.television?.model ?? 'Tidak ada television'}</p>
                    
                    <div class="border-t my-2"></div>

                    <p class="text-gray-500 text-sm">Durasi Sewa:</p>
                    <p class="font-semibold">${history.rent_day} Hari</p>

                    <p class="text-gray-500 text-sm">Tanggal Sewa:</p>
                    <p class="font-semibold">${new Date(history.start_date).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' })}</p>

                    <p class="text-gray-500 text-sm">Sewa Berakhir:</p>
                    <p class="font-semibold">${new Date(history.end_date).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' })}</p>

                    <p class="text-gray-500 text-sm">Total Harga:</p>
                    <p class="font-semibold text-lg">Rp ${parseInt(history.total_price).toLocaleString()}</p>

                    <button class="bg-indigo-600 text-white w-full mt-4 px-4 py-2 rounded-lg hover:bg-indigo-700" onclick="Swal.close()">
                        Terimakasih Sudah Menyewa
                    </button>
                </div>
            `,
            showConfirmButton: false,
            customClass: {
                popup: 'rounded-lg'
            }
        });
    }
</script>
