<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;

class InvoiceTest extends TestCase
{
    //use DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_listInvoices()
    {
        $invoice = new \App\Http\Controllers\InvoiceController();
        $list =  (array) json_decode($invoice->getInvoices()->content());
        
        $this->assertContains('success', $list);
        $this->assertArrayHasKey('data', $list);
    }

    public function test_createInvoice()
    {
        $invoiceData = Invoice::factory()->make();
        $invoice = new \App\Http\Controllers\InvoiceController();
        $user = User::find(1);
        Auth::login($user);

        $request = new Request();
        $request->replace([            
            'invoice_number' => $invoiceData->invoice_number,
            'invoice_date' => $invoiceData->invoice_date,
            'invoice_due_date' => $invoiceData->invoice_due_date,
            'subtotal' => $invoiceData->subtotal,
            'tax' => $invoiceData->tax,
            'discount' => $invoiceData->discount,
            'total' => $invoiceData->total,
            'company_name' => $invoiceData->company_name,
            'full_name' => $invoiceData->full_name,
            'company_website' => $invoiceData->company_website,
            'company_address' => $invoiceData->company_address,
            'company_city_state_zip' => $invoiceData->company_city_state_zip,
            'country' => $invoiceData->country,
            'company_phone' => $invoiceData->company_phone,
            'company_email' => $invoiceData->company_email,
            'company_logo' => $invoiceData->company_logo,
            'client_company_name' => $invoiceData->client_company_name,
            'client_full_name' => $invoiceData->client_full_name,
            'client_address' => $invoiceData->client_address,
            'client_city_state_zip' => $invoiceData->client_city_state_zip,
            'client_country' => $invoiceData->client_country,
            'notes' => $invoiceData->notes
        ]);
        
        $response = $invoice->store($request);
        $testRes  = new TestResponse($response);
        $testRes->assertJson(['message' => 'success']);
        $testRes->assertStatus(200);
    }

    public function test_createItem()
    {
        $itemData = Item::factory()->count(3)->make();
        $invoice = new \App\Http\Controllers\InvoiceController();

        $invoice->createItemArray($itemData);
    }
}
