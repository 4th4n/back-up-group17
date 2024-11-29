<?php

// app/Http/Controllers/RestockController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class RestockController extends Controller
{
    // Display the restock page
    public function index()
    {
        $items = Item::all(); // Fetch all items for display
        return view('admin.restock', compact('items'));
    }

    // Handle the restocking of items
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::find($request->item_id);

        // Update the stock of the item
        $item->increment('quantity', $request->quantity);

        return redirect()->route('restock.index')->with('success', "{$item->name} stock has been updated by {$request->quantity}.");
    }
}
