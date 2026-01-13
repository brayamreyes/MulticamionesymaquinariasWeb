<?php

namespace App\Filament\Widgets;

use App\Concerns\Enums\Status;
use App\Models\Quotation;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class QuotationsChart extends ChartWidget {

    use HasWidgetShield;
    protected static ?string $heading = "Cotizaciones finalizadas durante el año";
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '200px';
    protected static ?int $sort = 1;

    protected function getData(): array {
        $data = Trend::query(Quotation::where('status', Status::ACCEPTED->value))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )->perMonth()->count();
        return [
            'datasets' => [
                [
                    'label' => 'Recaudado ' . date('Y'),
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => ucfirst(Carbon::parse($value->date)->locale('es_ES')->monthName)),
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
