<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_date',
        'invoice_number',
        'customer_name',
        'total_amount'
    ];

    public function transactions()
    {
        return $this->hasMany(InvoiceDetail::class);
    }
}
