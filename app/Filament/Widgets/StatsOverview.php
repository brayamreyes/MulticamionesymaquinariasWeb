<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array {
        $total_customers = Customer::all()->count();
        $total_products = Product::all()->count();
        return [
            Stat::make('Clientes registrados', $total_customers)->icon('heroicon-s-users')->description('Cantidad de clientes registrados en total'),
            Stat::make('Vehículos registrados', $total_products)->icon('heroicon-s-briefcase')->description('Cantidad de vehículos registrados en total'),
        ];
    }
}
