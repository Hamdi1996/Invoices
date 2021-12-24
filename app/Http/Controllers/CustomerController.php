<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\Section;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('reports.customers_report')->with('sections',$sections);
    }

    public function Search_customers(Request $request)
    {
        // if search 
            if ($request->Section && $request->product && $request->start_at == '' && $request->end_at == '') {

                $invoices = invoices::select('*')->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
                $sections =Section::all();
                return view('reports.customers_report', compact('sections'))->withDetails($invoices);
            }
           
            else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $sections =Section::all();

                $invoices = invoices::whereBetween('invoice_Date', [$start_at, $end_at])->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
                return view('reports.customers_report', compact('sections', 'start_at', 'end_at'))->withDetails($invoices);
            }


    }


}

