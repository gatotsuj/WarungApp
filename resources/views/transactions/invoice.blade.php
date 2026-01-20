<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $transaction->code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 py-10 text-slate-700">

    <div class="max-w-4xl mx-auto bg-white shadow-sm rounded-none border border-gray-200 p-12">

        {{-- Header: Logo Kiri, Judul Kanan --}}
        <div class="flex justify-between items-start mb-12">
            <div>
                {{-- Logo Placeholder --}}
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-indigo-600 text-white font-bold h-10 w-10 flex items-center justify-center rounded">L
                    </div>
                    <span class="text-xl font-bold text-gray-900">NAMA PERUSAHAAN</span>
                </div>
                <div class="text-sm text-gray-500 leading-relaxed">
                    Jl. Sudirman No. 88, Jakarta Selatan<br>
                    info@perusahaan.com | (021) 555-1234
                </div>
            </div>
            <div class="text-right">
                <h1 class="text-4xl font-light text-indigo-600 tracking-wide uppercase">INVOICE</h1>
                <p class="text-gray-500 mt-2">#{{ $transaction->code }}</p>
                <p class="text-sm text-gray-400 mt-1">{{ $transaction->created_at->format('d F Y') }}</p>
            </div>
        </div>

        {{-- Bill To --}}
        <div class="mb-10">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Ditagihkan Kepada</h3>
            <p class="text-xl font-bold text-gray-800">{{ $transaction->customer_name }}</p>
            <p class="text-gray-500">{{ $transaction->customer_phone ?? '-' }}</p>
        </div>

        {{-- Table Modern --}}
        <table class="w-full mb-8">
            <thead>
                <tr class="border-b border-gray-300">
                    <th class="text-left py-3 text-sm font-semibold text-gray-900">Deskripsi</th>
                    <th class="text-center py-3 text-sm font-semibold text-gray-900 w-24">Qty</th>
                    <th class="text-right py-3 text-sm font-semibold text-gray-900 w-32">Harga</th>
                    <th class="text-right py-3 text-sm font-semibold text-gray-900 w-32">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($transaction->items as $item)
                    <tr>
                        <td class="py-4 text-sm">{{ $item->product->name }}</td>
                        <td class="py-4 text-center text-sm">{{ $item->quantity }}</td>
                        <td class="py-4 text-right text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="py-4 text-right text-sm font-medium text-gray-900">Rp
                            {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Total & Notes --}}
        <div class="flex justify-between items-start border-t border-gray-300 pt-6">
            <div class="w-1/2">
                @if ($transaction->notes)
                    <p class="text-sm text-gray-500 italic">Catatan: {{ $transaction->notes }}</p>
                @endif
            </div>
            <div class="w-1/2 text-right">
                <div class="flex justify-between items-center text-2xl font-bold text-gray-900">
                    <span>Total</span>
                    <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Signature (Jauh) --}}
        <div class="mt-20 flex justify-between px-4 text-center">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-16">Penerima</p>
                <p class="font-bold text-gray-900 border-t border-gray-300 pt-2 min-w-[150px]">
                    {{ $transaction->customer_name }}</p>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-16">Authorized By</p>
                <p class="font-bold text-gray-900 border-t border-gray-300 pt-2 min-w-[150px]">Finance Dept</p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-12 text-center print:hidden">
            <button onclick="window.print()"
                class="bg-gray-900 text-white px-6 py-2 rounded hover:bg-gray-800 transition">Print Invoice</button>
        </div>
    </div>
</body>

</html>
