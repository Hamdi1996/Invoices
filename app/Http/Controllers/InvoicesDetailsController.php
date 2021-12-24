<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\InvoicesAttachment;
use App\Models\InvoicesDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoicesDetails  $invoicesDetails
     * @return \Illuminate\Http\Response
     */
    public function show(InvoicesDetails $invoicesDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoicesDetails  $invoicesDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices    = invoices::where('id',$id)->first();
        $details     = InvoicesDetails::where('id_Invoice',$id)->get();
        $attachments = InvoicesAttachment::where('invoice_id',$id)->get(); 

        
         return view('invoices.invoices_details',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoicesDetails  $invoicesDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoicesDetails $invoicesDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoicesDetails  $invoicesDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = InvoicesAttachment::findOrFail($request->id_file);
        $invoices->delete();

        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete','تم حذف المرفق بنجاح');
        return back();
    }



    public function download($invoice_number , $file_name)
    {
        
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download($files);

    }

    public function file_open($invoice_number , $file_name)
    {
        
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($contents);

    }


}
