<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Creates a new item
     * @param  Request  $request Item information
     * @return response         Item data
     */
    public function store(Request $request)
    {
        // Validation
        
        $item = new Item();
        $item->invoice_internal_id = $request->input('invoice_internal_id');
        $item->description = $request->input('description');
        $item->quantity = $request->input('quantity');
        $item->price = $request->input('price');
        $item->save();

        return response(['message' => 'success', 'data' => $item], 200);        
    }

    /**
     * Updates an item
     * @param  integer  $id      Item ID
     * @param  Request  $request Item information
     * @return response          Item data
     */
    public function update($id, Request $request)
    {
        $item = Item::find($id);
        $item->invoice_internal_id = $request->input('invoice_internal_id');
        $item->description = $request->input('description');
        $item->quantity = $request->input('quantity');
        $item->price = $request->input('price');
        $item->save();

        return response(['message' => 'success', 'data' => $item], 200);
    }

    /**
     * Deletes an item
     * @param  integer  $id Item ID
     * @return response     Message
     */
    public function delete($id)
    {        
        $item = Item::where('id', $id)->first();
        $item->delete();

        return response(['message' => 'success'], 200);    
    }
}
