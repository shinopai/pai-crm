<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price'
    ];

    /**
     * relation
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_items')
        ->withPivot('quantity', 'purchase_datetime')
        ->withTimestamps();
    }
}
