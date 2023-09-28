<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bundle;
use App\Models\Tenant;

class HomeController extends Controller
{
    public function index() {

        $bundles = Bundle::pluck('name')->toArray();
        //dd($bundles);
        $tenant = Tenant::all();
        $counter = [];
        foreach(Bundle::all() as $bundle) {
            $tenantsCount = Tenant::where('bundle_id',$bundle->id)->get()->count();
            $counter[] = $tenantsCount;
        }
  
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($bundles)
            ->datasets([
                [
                    "label" => "عدد المشتركين بكل باقة",
                    'backgroundColor' => "#EBF5FB",
                    'borderColor' => "#AED6F1 ",
                    "pointBorderColor" => "#2471A3",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $counter,
                ],

            ])
                ->options([
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'min' => 0, // Set the minimum value for the y-axis
                            // 'max' => 100, // Set the maximum value for the y-axis
                            'stepSize' => 1,
                        ],
                    ],
                ],
            ],
        ]);
        return view('admin.pages.dashboard.index',compact('chartjs','counter' ,'bundles'));
    }
}
