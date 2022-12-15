<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }


    public function index()
    {
        return view('auth.selection');
    }



    public function Admin()
    {
        $count_all =Order::count();
        $count_Order1 = Order::where('status', 'Initiated')->count();
        $count_Order2 = Order::where('status', 'Completed')->count();
        $count_Order3 = Order::where('status', 'Delivered')->count();

        if($count_Order2 == 0){
            $nspainvoices2=0;
        }
        else{
            $nspainvoices2 = $count_Order2/ $count_all*100;
        }

        if($count_Order1 == 0){
            $nspainvoices1=0;
        }
        else{
            $nspainvoices1 = $count_Order1/ $count_all*100;
        }

        if($count_Order3 == 0){
            $nspainvoices3=0;
        }
        else{
            $nspainvoices3 = $count_Order3/ $count_all*100;
        }


        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 370, 'height' => 200])
            ->labels(['اجمالي الطلبات في مرحلة البدء', 'اجمالي الطلبات المكتاملة','تم توصيل'])
            ->datasets([
                [
                    "label" => "اجمالي الطلبات في مرحلة البدء",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$nspainvoices1]
                ],
                [
                    "label" => "اجمالي الطلبات المكتاملة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$nspainvoices2]
                ],
                [
                    "label" => "تم توصيل",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$nspainvoices3]
                ],


            ])
            ->options([]);


        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['اجمالي الطلبات في مرحلة البدء', 'اجمالي الطلبات المكتاملة','تم توصيل'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
                    'data' => [$nspainvoices1, $nspainvoices2,$nspainvoices3]
                ]
            ])
            ->options([]);

        return view('admin.home', compact('chartjs','chartjs_2'));

    }

    public function Service()
    {
        $count_all =Order::count();
        $count_Order1 = Order::where('status', 'Initiated')->count();
        $count_Order2 = Order::where('status', 'Completed')->count();
        $count_Order3 = Order::where('status', 'Delivered')->count();

        if($count_Order2 == 0){
            $nspainvoices2=0;
        }
        else{
            $nspainvoices2 = $count_Order2/ $count_all*100;
        }

        if($count_Order1 == 0){
            $nspainvoices1=0;
        }
        else{
            $nspainvoices1 = $count_Order1/ $count_all*100;
        }

        if($count_Order3 == 0){
            $nspainvoices3=0;
        }
        else{
            $nspainvoices3 = $count_Order3/ $count_all*100;
        }


        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 370, 'height' => 200])
            ->labels(['اجمالي الطلبات في مرحلة البدء', 'اجمالي الطلبات المكتاملة','تم توصيل'])
            ->datasets([
                [
                    "label" => "اجمالي الطلبات في مرحلة البدء",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$nspainvoices1]
                ],
                [
                    "label" => "اجمالي الطلبات المكتاملة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$nspainvoices2]
                ],
                [
                    "label" => "تم توصيل",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$nspainvoices3]
                ],


            ])
            ->options([]);


        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['اجمالي الطلبات في مرحلة البدء', 'اجمالي الطلبات المكتاملة','تم توصيل'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
                    'data' => [$nspainvoices1, $nspainvoices2,$nspainvoices3]
                ]
            ])
            ->options([]);

        return view('service.home', compact('chartjs','chartjs_2'));

    }

}
