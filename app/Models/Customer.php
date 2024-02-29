<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tel',
        'email',
        'postcode',
        'address',
        'birthday',
        'gender',
        'memo'
    ];

    /**
     * relation
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'customer_items')
        ->withPivot('quantity', 'purchase_datetime')
        ->withTimestamps();
    }
}
