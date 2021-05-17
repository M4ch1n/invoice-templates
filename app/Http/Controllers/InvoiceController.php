<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Http\Traits\ItemTrait;

class InvoiceController extends Controller
{
    use ItemTrait;

    public function index()
    {
        return view('');
    }

    /**
     * Return template window
     * @return view template
     */
    public function template()
    {
        return view('template');
    }

    /**
     * Return invoices window
     * @return response View with data
     */
    public function getInvoices()
    {
        $invoices = Invoice::all();
        
        return response(['message' => 'success', 'data' => $invoices], 200);
    }
    
    /**
     * Create a new Invoice
     * @param  Request $request Request info
     * @return json             Response
     */
    public function store(Request $request)
    {
        // Validate        
        $userId = Auth::user()->id;

        $invoice = new Invoice();
        $invoice->user_id = $userId;
        $invoice->invoice_number = $request->input('invoice_number');
        $invoice->invoice_date = $request->input('invoice_date');
        $invoice->invoice_due_date = $request->input('invoice_due_date');
        $invoice->subtotal = $request->input('subtotal');
        $invoice->tax = $request->input('tax');
        $invoice->discount = $request->input('discount');
        $invoice->total = $request->input('total');

        $invoice->company_name = $request->input('company_name');
        $invoice->full_name = $request->input('full_name');
        $invoice->company_website = $request->input('company_website');
        $invoice->company_address = $request->input('company_address');
        $invoice->company_city_state_zip = $request->input('company_city_state_zip');
        $invoice->country = $request->input('country');
        $invoice->company_phone = $request->input('company_phone');
        $invoice->company_email = $request->input('company_email');
        $invoice->company_logo = Storage::putFile('public', $request->file('logo'));;
        
        $invoice->client_company_name = $request->input('client_company_name');
        $invoice->client_full_name = $request->input('client_full_name');
        $invoice->client_address = $request->input('client_address');
        $invoice->client_city_state_zip = $request->input('client_city_state_zip');
        $invoice->client_country = $request->input('client_country');
        $invoice->notes = $request->input('notes');
        
        $invoice->save();
        
        if( $request->has('items') && count( json_decode($request->input('items'))) > 0 ) {
            $items = $this->createItemArray($request->input('items'));

            $this->createInvoiceItems($invoice->id, $items);    
        }

        return response(['message' => 'success', 'data' => $invoice], 200);
    }

    /**
     * Create array with ID Items
     * @param  array $items Data to create items
     * @return array        IDs from items
     */
    public function createItemArray($items)
    {
        $itemArray = [];
        
        foreach($items as $item) {
            $itemId = $this->createItems($item);
            array_push($itemArray, $itemId);
        }

        return $itemArray;        
    }

    /**
     * Create an invoice item
     * @param  integer $invoiceId Invoice ID
     * @param  array $items       IDs from Items
     * @return void
     */
    public function createInvoiceItems($invoiceId, $items)
    {
        foreach($items as $item) {
            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_id = $invoiceId;
            $invoiceItem->item_id = $item;
            $invoiceItem->save();
        }
    }
}
