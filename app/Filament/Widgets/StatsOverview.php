<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $todayRevenue = Transaction::whereDate('created_at', today())
            ->where('status', 'completed')
            ->sum('total_amount');

        $yesterdayRevenue = Transaction::whereDate('created_at', today()->subDay())
            ->where('status', 'completed')
            ->sum('total_amount');

        $revenueChange = $yesterdayRevenue > 0
            ? round((($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100, 1)
            : 0;

        return [
            Stat::make('Total Kategori', Category::where('is_active', true)->count())
                ->description('Kategori aktif')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary'),

            Stat::make('Total Produk', Product::where('is_active', true)->count())
                ->description(Product::where('stock', '<=', 10)->count().' stok rendah')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),

            Stat::make('Transaksi Hari Ini', Transaction::whereDate('created_at', today())->count())
                ->description(Transaction::where('status', 'pending')->count().' pending')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),

            Stat::make('Pendapatan Hari Ini', 'Rp '.number_format($todayRevenue, 0, ',', '.'))
                ->description($revenueChange >= 0 ? "+{$revenueChange}%" : "{$revenueChange}%")
                ->descriptionIcon($revenueChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($revenueChange >= 0 ? 'success' : 'danger'),
        ];
    }
}
