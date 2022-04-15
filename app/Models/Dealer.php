<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dealer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'address', 'phone', 'email', 'bank_account', 'logo'];
    public function main_sale()
    {
        return $this->hasMany(Main_sale::class);
    }
}
