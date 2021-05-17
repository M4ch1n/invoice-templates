<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function items()
    {
        return $this->hasManyThrough(
            Item::class, 
            InvoiceItem::class,
            'invoice_id',
            'id',
            'item_id'
        );
    }
}
