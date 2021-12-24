<?php

namespace App\Http\Controllers;

use App\Models\InvoicesAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request,[
            'file_name'=>'mimes:png,jpg,pdf,jpeg',
        ],
        ['file_name.mimes'=>'يجب ان تكون الصيغة  pdf, jpeg,png,jpg']);

        $image     = $request->file('file_name');
        $file_name = $image->getClientOriginalName();
        
        $attachments = new InvoicesAttachment();
        $attachments->file_name = $file_name;
        $attachments->invoice_number = $request->invoice_number;
        $attachments->invoice_id = $request->invoice_id;
        $attachments->Created_by = Auth::user()->name;
        $attachments->save();


        // Move File to it's Path

        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'.$request->invoice_number),$imageName);
        session()->flash('Add','تم حفظ المرفق  بنجاح');
        return back();



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoicesAttachment  $invoicesAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(InvoicesAttachment $invoicesAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoicesAttachment  $invoicesAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoicesAttachment $invoicesAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoicesAttachment  $invoicesAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoicesAttachment $invoicesAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoicesAttachment  $invoicesAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoicesAttachment $invoicesAttachment)
    {
        //
    }
}
