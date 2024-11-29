<?php



namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Menu;
// use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ItemController extends Controller
{
    // Method to show the form for creating a new item
    public function create()
    {
        return view('items.create');
    }
 
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'nullable',
        'quantity' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image
        'category' => 'required|string',  // Add category validation
    ]);

    $item = new Item;
    $item->name = $request->name;
    $item->price = $request->price;
    $item->description = $request->description;
    $item->quantity = $request->quantity;
    $item->category = $request->category; // Assign the category from the form

    // Handle image upload
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();  // Generate a unique file name
        $request->image->move(public_path('images'), $imageName);  // Move image to public/images
        $item->image = $imageName;  // Save image file name in the database
    }

    $item->save();

    return redirect()->route('items.index')->with('success', 'Item created successfully');
}


    
    public function show($id)
{
    $item = Item::find($id);

    if (!$item) {
        return redirect()->route('items.index')->with('error', 'Item not found.');
    }

    return view('items.show', compact('item'));
}
public function index()
{
    // Kunin ang lahat ng mga item mula sa database
    $items = Item::all();

    // I-render ang view kasama ang mga item
    return view('items.index', compact('items'));
}

public function destroy($id)
{
    // Hanapin ang item gamit ang ID
    $item = Item::findOrFail($id);

    // Tanggalin ang item
    $item->delete();

    // I-redirect pabalik sa item list na may success message
    return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
}
public function search(Request $request)
{
    $query = $request->input('query');

    // Search items based on name or description
    $items = Item::where('name', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%")
                ->get();

    // Get the current order and calculate the total amount
    $order = session()->get('order', []);
    $totalAmount = collect($order)->sum(function ($details) {
        return $details['price'] * $details['quantity'];
    });

    // Return the view with the search results
    return view('kiosk.index', compact('items', 'order', 'totalAmount'));
}
public function category($category)
{
    $items = Item::where('category', $category)->get();

    // Get the current order and calculate the total amount
    $order = session()->get('order', []);
    $totalAmount = collect($order)->sum(function ($details) {
        return $details['price'] * $details['quantity'];
    });

    return view('kiosk.index', compact('items', 'order', 'totalAmount'));
}

public function showCategory($category)
{
    $items = Item::where('category', $category)->get();  // Make sure the category column exists

    // Get the current order and calculate the total amount
    $order = session()->get('order', []);
    $totalAmount = collect($order)->sum(function ($details) {
        return $details['price'] * $details['quantity'];
    });

    // Pass the items and totalAmount to the view
    return view('kiosk.index', compact('items', 'order', 'totalAmount'));
}

// app/Http/Controllers/ItemController.php

public function edit($id)
{
    $item = Item::findOrFail($id);
    return view('items.edit', compact('item'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer|min:0',
    ]);

    $item = Item::findOrFail($id);

    // Update the quantity by adding the input value to the current quantity
    $newQuantity = $item->quantity + $request->quantity;

    $item->update([
        'name' => $request->name,
        'price' => $request->price,
        'quantity' => $newQuantity,
    ]);

    return redirect()->route('items.index')->with('success', 'Item updated successfully.');
}




}


