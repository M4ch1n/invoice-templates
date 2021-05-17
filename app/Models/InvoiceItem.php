<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'invoice_item';
    // public function items()
    // {
    //     return $this->hasManyThrough(Item::class, 'App\Podcast');
    //     return $this->hasMany(Item::class);
    // }
}
