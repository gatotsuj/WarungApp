<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class RevenueChart3 extends ChartWidget
{
    protected ?string $heading = 'Revenue Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => [
                        150000,
                        200000,
                        175000,
                        300000,
                        250000,
                        400000,
                        350000,
                    ],
                    'backgroundColor' => [
                        '#22c55e', // hijau
                        '#3b82f6', // biru
                        '#facc15', // kuning
                        '#f97316', // oranye
                        '#ef4444', // merah
                        '#8b5cf6', // ungu
                        '#14b8a6', // teal
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => [
                'Sen',
                'Sel',
                'Rab',
                'Kam',
                'Jum',
                'Sab',
                'Min',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
