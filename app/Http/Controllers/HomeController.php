<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


       
        $Invoices_Count = invoices::count();
        $Paid           = invoices::where('Value_Status',1)->count();
        $unPaid         = invoices::where('Value_Status',2)->count();
        $Partial        = invoices::where('Value_Status',3)->count();
        if($Invoices_Count==0){
            $Invoices_Count = 1;
        }
        else{
        $PaidPercent    = round(($Paid/$Invoices_Count)*100);
        $UnpaidPercent  = round(($unPaid/$Invoices_Count)*100);
        $PartialPercent = round(($Partial/$Invoices_Count)*100);
        }



        $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(
            ['الفواتير المدفوعة جزئيا','الفواتير غير المدفوعة','الفواتير المدفوعة'

                ])
        ->datasets([
            [
                'backgroundColor' => [ '#fd7e14','#FF6384','#36A2EB'],
                'hoverBackgroundColor' =>[ '#fd7e14','#FF6384','#36A2EB'],
                'data' =>  [$PaidPercent, $UnpaidPercent, $PartialPercent],
            ]
        ])
        ->options([]);


         $chartjs1 = app()->chartjs
        ->name('lineChartTest')
        ->type('bar')
        ->size(['width' => 450, 'height' => 150])
        ->labels(
            [
                 'الفواتير المدفوعة'
                 ,'الفواتير الغير مدفوعة'
                ,'الفواتير المدفوعة جزئيا'
                ])
        ->datasets([
            [
                "label" => "نسبة الفواتير",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$PaidPercent, $UnpaidPercent, $PartialPercent],
            ],
        ])
        ->optionsRaw([
            'legend' => [
                'display' => true,
                'labels' => [
                    'fontColor' => 'black',
                    'fontFamily' => 'Cairo',
                    'fontStyle' => 'bold',
                    'fontSize' => 14,
                ]
            ]
        ]);

        return view('home', compact('chartjs','chartjs1'));

    }
}
