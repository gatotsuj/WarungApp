<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Faktur #{{ $transaction->code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Agar background warna (seperti header biru) tetap tercetak */
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* Transisi halus saat ganti template */
        .invoice-template {
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen pb-10 text-black">

    {{-- ========================================================================
         CONTROL PANEL (Akan hilang saat di-Print)
         ======================================================================== --}}
    <div class="print:hidden fixed top-0 left-0 w-full bg-white shadow-md z-50 p-4 border-b border-gray-300">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <label class="font-bold text-gray-700">Pilih Desain:</label>
                <select id="templateSelector" onchange="switchTemplate(this.value)"
                    class="border border-gray-300 rounded px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="classic">1. Classic Box (Original)</option>
                    <option value="modern">2. Modern Corporate (Blue)</option>
                    <option value="minimal">3. Minimalist (Clean)</option>
                    <option value="elegant">4. Elegant Purple</option>
                    <option value="professional">5. Professional Green</option>
                </select>
            </div>

            <button onclick="window.print()"
                class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 font-bold shadow-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                CETAK PDF
            </button>
        </div>
    </div>

    {{-- Spacer agar konten tidak tertutup Control Panel --}}
    <div class="h-24 print:hidden"></div>

    {{-- TEMPLATE 1: CLASSIC BOX --}}
    <div id="template-classic" class="invoice-template max-w-4xl mx-auto bg-white p-1">
        <div class="border-2 border-black p-1">
            <div class="border border-black p-8">
                <div class="grid grid-cols-2 gap-8 border-b-2 border-black pb-6 mb-6">
                    <div>
                        <h1 class="text-4xl font-serif font-bold mb-2">INVOICE</h1>
                        <p class="font-mono text-sm">No : #{{ $transaction->code }}</p>
                        <p class="font-mono text-sm">Tgl : {{ $transaction->created_at->format('d/m/Y') }}</p>

                    </div>
                    <div class="text-right">
                        <h2 class="font-bold text-lg">PT MAJU MUNDUR CANTIK</h2>
                        <p class="text-sm">Jakarta Selatan, DKI Jakarta</p>
                        <p class="text-sm">Tel: 021-1234567</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 border border-black mb-6">
                    <div class="p-4 border-r border-black">
                        <span class="block text-xs font-bold uppercase mb-1">Kepada Yth:</span>
                        <strong class="text-sm block">{{ $transaction->customer_name }}</strong>
                        <span class="text-sm">{{ $transaction->customer_address }}</span>
                        <span class="text-sm">{{ $transaction->customer_phone }}</span>
                    </div>
                    <div class="p-4 bg-gray-50">
                        <span class="block text-xs font-bold uppercase mb-1">Catatan:</span>
                        <p class="text-sm italic">Terima kasih atas kepercayaan Anda</p>
                    </div>
                </div>

                <table class="w-full border-collapse border border-black mb-6">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-black px-4 py-2 text-left text-sm font-bold">DESKRIPSI</th>
                            <th class="border border-black px-4 py-2 text-center text-sm font-bold w-20">QTY</th>
                            <th class="border border-black px-4 py-2 text-right text-sm font-bold w-32">HARGA (@)</th>
                            <th class="border border-black px-4 py-2 text-right text-sm font-bold w-40">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->items as $item)
                            <tr>
                                <td class="border border-black px-4 py-2">{{ $item->product->name }}</td>
                                <td class="border border-black px-4 py-2 text-center">{{ $item->quantity }}</td>
                                <td class="border border-black px-4 py-2 text-right">Rp.
                                    {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="border border-black px-4 py-2 text-right font-medium">
                                    Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-100">
                            <td colspan="3" class="border border-black px-4 py-2 text-right font-bold uppercase">
                                Total
                                Tagihan</td>
                            <td class="border border-black px-4 py-2 text-right font-bold text-lg">Rp
                                {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex justify-between mt-12 mb-4 px-8">
                    <div class="text-center w-48">
                        <p class="mb-20 text-sm">Penerima Barang,</p>
                        <p class="font-bold border-b border-black">{{ $transaction->customer_name }}</p>
                    </div>
                    <div class="text-center w-48">
                        <p class="mb-20 text-sm">Hormat Kami,</p>
                        <p class="font-bold border-b border-black">{{ $user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TEMPLATE 2: MODERN CORPORATE --}}
    <div id="template-modern"
        class="invoice-template max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden hidden">
        <div class="bg-gray-200 text-gray-800 p-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold tracking-wide">INVOICE</h1>
                <p class="mt-1 opacity-80"> #{{ $transaction->code }}</p>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-bold">PT MAJU MUNDUR CANTIK</h2>
                <p class="text-sm opacity-90">Jakarta Selatan, DKI Jakarta</p>
            </div>
        </div>

        <div class="p-8">
            <div class="flex justify-between mb-8">
                <div>
                    <p class="text-gray-500 text-sm uppercase tracking-wider mb-1">Ditagihkan Kepada:</p>
                    <h3 class="text-xl font-bold text-gray-900">{{ $transaction->customer_name }}</h3>
                    <p class="text-gray-600">{{ $transaction->customer_address }}</p>
                    <p class="text-gray-600">{{ $transaction->customer_phone }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-500 text-sm uppercase tracking-wider mb-1">Tanggal Transaksi:</p>
                    <p class="font-bold text-lg text-gray-900">{{ $transaction->created_at->format('d/m/Y') }}</p>
                </div>
            </div>

            <table class="w-full mb-8">
                <thead>
                    <tr class="text-left border-b-2 border-gray-600">
                        <th class="py-3 text-sm font-semibold text-gray-600 uppercase">Deskripsi</th>
                        <th class="py-3 text-center text-sm font-semibold text-gray-600 uppercase w-24">Qty</th>
                        <th class="py-3 text-right text-sm font-semibold text-gray-600 uppercase w-32">Harga</th>
                        <th class="py-3 text-right text-sm font-semibold text-gray-600 uppercase w-40">Total</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($transaction->items as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4">{{ $item->product->name }}</td>
                            <td class="py-4 text-center">{{ $item->quantity }}</td>
                            <td class="py-4 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            </td>
                            <td class="py-4 text-right font-medium text-gray-900">Rp.
                                {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="flex justify-between items-start">
                <div class="w-1/2 bg-gray-50 p-4 rounded text-sm text-gray-600">
                    <span class="font-bold block mb-1 text-gray-800">Catatan:</span>
                    Terima kasih atas kepercayaan Anda
                </div>
                <div class="w-1/3">
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <span class="font-bold text-lg">Total</span>
                        <span class="font-bold text-lg text-gray-600">Rp.
                            {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-16 flex justify-between text-center">
                <div>
                    <p class="text-sm text-gray-500 mb-16">Penerima,</p>
                    <p class="font-bold border-b border-gray-300 pb-1">{{ $transaction->customer_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-16">Admin,</p>
                    <p class="font-bold border-b border-gray-300 pb-1">{{ $user->name }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- TEMPLATE 3: MINIMALIST --}}
    <div id="template-minimal" class="invoice-template max-w-3xl mx-auto bg-white p-8 hidden">
        <div class="border-b-4 border-black pb-4 mb-8 flex justify-between items-end">
            <div>
                <h1 class="text-5xl font-bold tracking-tighter">INVOICE</h1>
            </div>
            <div class="text-right">
                <p class="font-bold">PT MAJU MUNDUR CANTIK</p>
                <p class="text-sm text-gray-600">#INV-001</p>
            </div>
        </div>

        <div class="mb-10">
            <p class="text-xs text-gray-500 uppercase mb-1">Kepada Yth.</p>
            <h2 class="text-2xl font-bold">John Doe</h2>
        </div>

        <table class="w-full mb-8">
            <thead>
                <tr class="border-b border-black">
                    <th class="text-left py-2 font-bold uppercase text-sm">Item</th>
                    <th class="text-center py-2 font-bold uppercase text-sm w-16">Qty</th>
                    <th class="text-right py-2 font-bold uppercase text-sm w-32">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200 text-sm">
                    <td class="py-3">Laptop Dell Inspiron 15</td>
                    <td class="py-3 text-center text-gray-600">x2</td>
                    <td class="py-3 text-right font-bold">17.000.000</td>
                </tr>
                <tr class="border-b border-gray-200 text-sm">
                    <td class="py-3">Mouse Wireless Logitech</td>
                    <td class="py-3 text-center text-gray-600">x5</td>
                    <td class="py-3 text-right font-bold">1.250.000</td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-end mb-12">
            <div class="w-1/2">
                <div class="flex justify-between py-2 border-b-4 border-black">
                    <span class="font-bold text-xl">TOTAL</span>
                    <span class="font-bold text-xl">Rp 18.250.000</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-10 text-xs text-gray-500 border-t border-gray-200 pt-6">
            <div>
                <p>Terima kasih atas kepercayaan Anda</p>
            </div>
            <div class="text-right">
                <p>Dicetak oleh: Admin Store | 21/01/2026</p>
            </div>
        </div>
    </div>

    {{-- TEMPLATE 4: ELEGANT PURPLE --}}
    <div id="template-elegant" class="invoice-template max-w-4xl mx-auto bg-white shadow-xl hidden">
        <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-10">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-5xl font-bold mb-3">Invoice</h1>
                    <div class="bg-white bg-opacity-20 rounded px-4 py-2 inline-block">
                        <p class="font-mono text-lg">#INV-001</p>
                    </div>
                </div>
                <div class="text-right">
                    <h2 class="text-2xl font-bold mb-2">PT MAJU MUNDUR CANTIK</h2>
                    <p class="text-purple-100">Jakarta Selatan, DKI Jakarta</p>
                    <p class="text-purple-100">Tel: 021-1234567</p>
                </div>
            </div>
        </div>

        <div class="p-10">
            <div class="grid grid-cols-2 gap-8 mb-10">
                <div class="bg-purple-50 p-6 rounded-lg">
                    <p class="text-purple-600 font-semibold mb-2 uppercase text-xs tracking-wide">Bill To</p>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">John Doe</h3>
                    <p class="text-gray-600">081234567890</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <p class="text-gray-600 font-semibold mb-2 uppercase text-xs tracking-wide">Invoice Date</p>
                    <p class="text-xl font-bold text-gray-800">21 Januari 2026</p>
                </div>
            </div>

            <div class="bg-purple-50 rounded-lg p-6 mb-8">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-purple-300">
                            <th class="py-3 text-left font-bold text-purple-800 uppercase text-sm">Item Description
                            </th>
                            <th class="py-3 text-center font-bold text-purple-800 uppercase text-sm w-24">Qty</th>
                            <th class="py-3 text-right font-bold text-purple-800 uppercase text-sm w-32">Price</th>
                            <th class="py-3 text-right font-bold text-purple-800 uppercase text-sm w-40">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-purple-200">
                            <td class="py-4 text-gray-800">Laptop Dell Inspiron 15</td>
                            <td class="py-4 text-center text-gray-700">2</td>
                            <td class="py-4 text-right text-gray-700">Rp 8.500.000</td>
                            <td class="py-4 text-right font-semibold text-gray-900">Rp 17.000.000</td>
                        </tr>
                        <tr class="border-b border-purple-200">
                            <td class="py-4 text-gray-800">Mouse Wireless Logitech</td>
                            <td class="py-4 text-center text-gray-700">5</td>
                            <td class="py-4 text-right text-gray-700">Rp 250.000</td>
                            <td class="py-4 text-right font-semibold text-gray-900">Rp 1.250.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mb-10">
                <div class="w-1/2 bg-purple-600 text-white rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold">TOTAL AMOUNT</span>
                        <span class="text-3xl font-bold">Rp 18.250.000</span>
                    </div>
                </div>
            </div>

            <div class="border-t-2 border-purple-200 pt-6">
                <p class="text-sm text-gray-600 italic mb-8">Catatan: Terima kasih atas kepercayaan Anda</p>
                <div class="flex justify-between">
                    <div class="text-center">
                        <div class="h-20"></div>
                        <p class="border-t-2 border-purple-600 pt-2 font-bold text-gray-800">
                            {{ $transaction->customer_name }}</p>
                        <p class="text-sm text-gray-600">Customer</p>
                    </div>
                    <div class="text-center">
                        <div class="h-20"></div>
                        <p class="border-t-2 border-purple-600 pt-2 font-bold text-gray-800">Admin Store</p>
                        <p class="text-sm text-gray-600">Authorized Signature</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TEMPLATE 5: PROFESSIONAL GREEN --}}
    <div id="template-professional"
        class="invoice-template max-w-4xl mx-auto bg-white border-l-8 border-gray-400 shadow-lg hidden">
        <div class="p-10">
            <div class="flex justify-between items-start mb-10">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-gray-400 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-2xl">MC</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">PT MAJU MUNDUR CANTIK</h2>
                            <p class="text-sm text-gray-600">Jakarta Selatan, DKI Jakarta</p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <h1 class="text-4xl font-bold text-gary-400 mb-2">INVOICE</h1>
                    <p class="text-gray-600">Invoice No: <span class="font-bold text-gray-800">INV-001</span></p>
                    <p class="text-gray-600">Date: <span class="font-bold text-gray-800">21/01/2026</span></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-10">
                <div class="border-l-4 border-gary-400 pl-4">
                    <p class="text-xs text-gray-500 uppercase mb-2">Invoice To:</p>
                    <h3 class="text-xl font-bold text-gray-800">John Doe</h3>
                    <p class="text-gray-600">Phone: 081234567890</p>
                </div>
                <div class="border-l-4 border-gray-300 pl-4">
                    <p class="text-xs text-gray-500 uppercase mb-2">Payment Details:</p>
                    <p class="text-sm text-gray-700">Bank Transfer</p>
                    <p class="text-sm text-gray-700">BCA - 1234567890</p>
                </div>
            </div>

            <table class="w-full mb-8">
                <thead>
                    <tr class="bg-gray-300 text-white">
                        <th class="py-4 px-4 text-left font-semibold text-gray-950">DESCRIPTION</th>
                        <th class="py-4 px-4 text-center font-semibold w-24 text-gray-950">QTY</th>
                        <th class="py-4 px-4 text-right font-semibold w-32 text-gray-950">UNIT PRICE</th>
                        <th class="py-4 px-4 text-right font-semibold w-40 text-gray-950">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-4 text-gray-800">Laptop Dell Inspiron 15</td>
                        <td class="py-4 px-4 text-center text-gray-700">2</td>
                        <td class="py-4 px-4 text-right text-gray-700">Rp 8.500.000</td>
                        <td class="py-4 px-4 text-right font-semibold text-gray-900">Rp 17.000.000</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-4 text-gray-800">Mouse Wireless Logitech</td>
                        <td class="py-4 px-4 text-center text-gray-700">5</td>
                        <td class="py-4 px-4 text-right text-gray-700">Rp 250.000</td>
                        <td class="py-4 px-4 text-right font-semibold text-gray-900">Rp 1.250.000</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td colspan="3" class="py-4 px-4 text-right font-bold text-gray-800 text-lg">TOTAL</td>
                        <td class="py-4 px-4 text-right font-bold text-gray-600 text-lg">Rp 18.250.000</td>
                    </tr>
                </tbody>
            </table>

            <div class="bg-gray-50 rounded p-6 mb-10">
                <p class="text-sm text-gray-700"><span class="font-bold">Notes:</span> Terima kasih atas kepercayaan
                    Anda</p>
            </div>

            <div class="flex justify-between items-end">
                <div>
                    <p class="text-xs text-gray-500 mb-1">Prepared by:</p>
                    <p class="font-bold text-gray-800">Admin Store</p>
                </div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-16">Customer Signature</p>
                    <div class="border-t-2 border-gray-800 w-48 mx-auto pt-2">
                        <p class="font-bold text-gray-800">{{ $transaction->customer_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========================================================================
         JAVASCRIPT LOGIC
         ======================================================================== --}}
    <script>
        function switchTemplate(templateName) {
            // 1. Sembunyikan semua template
            const templates = document.querySelectorAll('.invoice-template');
            templates.forEach(el => {
                el.classList.add('hidden');
            });

            // 2. Tampilkan template yang dipilih
            const selected = document.getElementById('template-' + templateName);
            if (selected) {
                selected.classList.remove('hidden');
            }
        }
    </script>

</body>

</html>
