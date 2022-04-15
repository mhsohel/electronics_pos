<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'invoiceID',
        'supplier_id',
        'product_id',
        'batchID',
        'cost_price',
        'mrp',
        'qty',
        'discount_type',
        'discount',
        'total',
        'warranty_type',
        'user_id',
        'grn',
        'approval'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
