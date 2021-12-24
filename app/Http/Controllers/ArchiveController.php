<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
   
    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();

        return view('invoices.Archive_Invoices',compact('invoices'));
    }

    public function update(Request $request)
    {
        $id = $request->invoice_id;

        $filght = invoices::withTrashed()->where('id',$id)->restore();

        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    public function destroy (Request $request)
    {
        $id         = $request->invoice_id;
        $invoice    = invoices::withTrashed()->where('id',$id)->first();

        $invoice->forcedelete();

        session()->flash('delete_invoice');
        return redirect('Archive');
    }
}
