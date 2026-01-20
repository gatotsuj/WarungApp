<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class RevenueChart2 extends ChartWidget
{
    protected ?string $heading = 'Revenue Chart2';

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
        return 'bar';
    }
}
