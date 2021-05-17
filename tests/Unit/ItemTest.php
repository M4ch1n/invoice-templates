<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use App\Models\Item;

class ItemTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_createItem()
    {
        $itemData = Item::factory()->make();
        $item = new \App\Http\Controllers\ItemController();
        
        $request = new Request();
        $request->replace([            
            'invoice_internal_id' => $itemData->invoice_internal_id,
            'description' => $itemData->description,
            'quantity' => $itemData->quantity,
            'price' => $itemData->price,
        ]);
        
        $response = $item->store($request);        
        $testRes  = new TestResponse($response);
        $testRes->assertJson(['message' => 'success']);
        $testRes->assertStatus(200);
    }

    public function test_deleteItem()
    {
        $item = new \App\Http\Controllers\ItemController();
        $response = $item->delete(2);

        $testRes  = new TestResponse($response);
        $testRes->assertJson(['message' => 'success']);
    }
}
