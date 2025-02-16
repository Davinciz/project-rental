<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Bagian Form Rental -->
    <div class="bg-white p-6 rounded-lg shadow-md lg:col-span-2">
        <h2 class="text-lg font-semibold mb-4">Rental</h2>
        <form method="POST" id="rentalForm" action="{{ route('rental.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700">Pilih Console</label>
                <select id="console" name="console_id" class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                    <option value="" data-price="0">Pilih Console</option>
                    @foreach ($consoles as $console)
                        <option value="{{ $console->id }}" data-price="{{ $console->price_console }}">
                            {{ $console->name }} - Rp {{ number_format($console->price_console, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Pilih Televisi (opsional)</label>
                <select id="television" name="television_id"
                    class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                    <option value="" data-price="0">Tanpa Televisi</option>
                    @foreach ($televisions as $television)
                        <option value="{{ $television->id }}" data-price="{{ $television->price_television }}">
                            {{ $television->model }} - Rp
                            {{ number_format($television->price_television, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Jumlah hari</label>
                    <input type="number" id="rent_day" name="rent_day" value="1" min="1"
                        class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                </div>
                <div>
                    <label class="block text-gray-700">Waktu Mulai</label>
                    <input type="datetime-local" id="start_date" name="start_date"
                        class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                </div>
                <div>
                    <label class="block text-gray-700">Waktu Berakhir</label>
                    <input type="datetime-local" id="end_date" name="end_date" readonly
                        class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                </div>
            </div>
            <div>
                {{-- Total Price --}}
                <input type="text" id="total_price" name="total_price" hidden
                    class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
            </div>
    </div>

    <!-- Bagian Detail Rental -->
    <aside class="bg-white p-6 rounded-lg shadow-md h-fit">
        <h2 class="text-lg font-semibold mb-4">Detail</h2>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span>Playstation</span>
                <span id="console_price">0</span>
            </div>
            <div class="flex justify-between">
                <span>Television</span>
                <span id="television_price">0</span>
            </div>
            <div class="flex justify-between">
                <span>Durasi Sewa</span>
                <span id="display_rent_day"> Hari</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between font-semibold">
                <span>Total</span>
                <span id="display_total_price">Rp 0</span>
            </div>
        </div>
        <button type="submit" class="w-full mt-4 py-2 bg-black text-white rounded-md">Sewa Sekarang</button>
    </aside>
</div>
</form>

{{-- Pop-Up Data Rental --}}
<script>
    document.getElementById('rentalForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah reload halaman
    
        let formData = new FormData(this);
    
        fetch("{{ route('rental.store') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: "Rental Berhasil!",
                    html: `
                        <b>Kode Rental:</b> ${data.rental.code} <br>
                        <b>Jumlah Hari:</b> ${data.rental.rent_day} Hari <br>
                        <b>Total Harga:</b> Rp ${parseInt(data.rental.total_price).toLocaleString()} <br>
                        <b>Tanggal Mulai:</b> ${new Date(data.rental.start_date).toLocaleString()} <br>
                        <b>Tanggal Selesai:</b> ${new Date(data.rental.end_date).toLocaleString()}
                    `,
                    icon: "success",
                    allowOutsideClick: false,
                    confirmButtonText: "Kembali",
                    confirmButtonColor: "#3085d6"
                }).then(() => {
                    window.location.href = "{{ route('rental.index') }}"; // Redirect setelah klik tombol
                });
            } else {
                Swal.fire({
                    title: "Gagal!",
                    text: data.message,
                    icon: "error",
                    allowOutsideClick: false,
                    confirmButtonText: "OK"
                });
            }
        })
        .catch(error => console.error("Error:", error));
    });
    </script>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        let rentDayInput = document.getElementById('rent_day');
        let totalPriceInput = document.getElementById('total_price');
        let consoleSelect = document.getElementById('console');
        let televisionSelect = document.getElementById('television');
        let startDateInput = document.getElementById('start_date');
        let endDateInput = document.getElementById('end_date');
        // Elemen untuk menampilkan harga di bagian "Detail Rental"
        let consolePriceDisplay = document.getElementById('console_price');
        let televisionPriceDisplay = document.getElementById('television_price');
        let rentDayDisplay = document.getElementById('display_rent_day');
        let totalPriceDisplay = document.getElementById('display_total_price');

        // Fungsi untuk Mengupdate Total Harga (tidak diubah)
        function updateTotalPrice() {
            let rentDay = parseInt(rentDayInput.value) || 1; // Default 1 hari jika kosong
            let selectedConsole = consoleSelect.options[consoleSelect.selectedIndex];
            let selectedTelevision = televisionSelect.options[televisionSelect.selectedIndex];
            let consolePrice = parseInt(selectedConsole.getAttribute('data-price')) || 0;
            let televisionPrice = parseInt(selectedTelevision.getAttribute('data-price')) || 0;
            let totalPrice = (consolePrice + televisionPrice) * rentDay;

            // Update tampilan di bagian "Detail Rental"
            consolePriceDisplay.textContent = `Rp ${consolePrice.toLocaleString()}`;
            televisionPriceDisplay.textContent = `Rp ${televisionPrice.toLocaleString()}`;
            rentDayDisplay.textContent = `${rentDay} Hari`;
            totalPriceInput.value = totalPrice;
            totalPriceDisplay.textContent = `Rp ${totalPrice.toLocaleString()}`;
        }

        // Fungsi untuk Mengupdate End Date yang disesuaikan untuk datetime-local
        function updateEndDate() {
            let startDateValue = startDateInput.value;
            let rentDays = parseInt(rentDayInput.value) || 1;

            if (!startDateValue) {
                endDateInput.value = "";
                return;
            }

            // Buat objek Date baru dari nilai start date
            let startDate = new Date(startDateValue);

            // Pastikan startDate valid
            if (isNaN(startDate.getTime())) {
                endDateInput.value = "";
                return;
            }

            // Hitung end date
            let endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + rentDays);

            // Format datetime ke YYYY-MM-DDTHH:mm
            let year = endDate.getFullYear();
            let month = String(endDate.getMonth() + 1).padStart(2, '0');
            let day = String(endDate.getDate()).padStart(2, '0');
            let hours = String(endDate.getHours()).padStart(2, '0');
            let minutes = String(endDate.getMinutes()).padStart(2, '0');

            // Set nilai end date dengan format datetime-local
            endDateInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
        }

        // Fungsi gabungan (tidak diubah)
        function updateAll() {
            updateTotalPrice();
            updateEndDate();
        }

        // Event listeners (tidak diubah)
        rentDayInput.addEventListener('input', updateAll);
        consoleSelect.addEventListener('change', updateTotalPrice);
        televisionSelect.addEventListener('change', updateTotalPrice);
        startDateInput.addEventListener('change', updateAll);

        // Initial update
        updateAll();
    });
</script>
