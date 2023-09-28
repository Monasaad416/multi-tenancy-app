<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Work;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::pluck('name_ar')->toArray();
        $works = [];
        for($i = 1;$i <= 12 ;$i++)
        {
            $monthWorks = Work::whereMonth('finishing_date', '0'.$i)->get()->count();
            $works[] = $monthWorks;
        }

        $counter = [];
        foreach(Category::get() as $cat) {
            $servicePerCatCount = Service::where('category_id',$cat->id)->get()->count();
            $counter[] = $servicePerCatCount;
        }
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 550, 'height' => 400])
            ->labels($categories)
            ->datasets([
                    [
                        "label" => "عدد الخدمات  بكل تصنيف",
                        'backgroundColor' => "#EBF5FB",
                        'borderColor' => "#AED6F1 ",
                        "pointBorderColor" => "#2471A3",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $counter,
                    ],
            ])->options([
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




        $chartjs2 = app()->chartjs
        ->name('lineChartTest2')
        ->type('line')
        ->size(['width' => 550, 'height' => 400])
        ->labels(['يناير', 'فبراير', 'مارس', 'إبريل', 'مايو', 'يونيو', 'يوليو','اغسطس','سبتمبر','اكتوبر','نوفمبر','ديسمبر'])
        ->datasets([
            [
                "label" => "عدد الأعمال المنجزة شهريا",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $works,
            ]

        ])
        ->options([]);
        return view('tenants_pages.admin.dashboard.index',compact('chartjs','chartjs2','categories'));
    }
}

