<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'price', 'description', 'quantity', 'image'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
    public function incrementQuantity($amount)
    {
        $this->quantity += $amount;
        $this->save();
    }

    public function decrementQuantity($amount)
    {
        if ($this->quantity - $amount < 0) {
            throw new \Exception("Stock cannot be negative.");
        }
        $this->quantity -= $amount;
        $this->save();
    }
}


