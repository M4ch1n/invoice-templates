<?php

namespace App\Http\Traits;

use App\Models\Item;

trait ItemTrait {    
    protected function createItems($item)
    {        
        $newItem = new Item();
        $newItem->invoice_internal_id = $item->invoice_internal_id;
        $newItem->description = $item->description;
        $newItem->quantity = $item->quantity;
        $newItem->price = $item->price;
        $newItem->save();

        return $newItem->id;
    }
}
