<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    public function getData()
    {
        $data = DB::table('orders')->select('order_date', 'total_price')->get();

        $labels = $data->pluck('order_date')->toArray();
        $values = $data->pluck('total_price')->toArray();

        $chartData = [
            'labels' => $labels,
            'values' => $values
        ];

        return response()->json($chartData);
    }
}
