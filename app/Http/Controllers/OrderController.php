<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $order = session()->get('order', []);

        // Calculate total amount
        $totalAmount = collect($order)->sum(function($details) {
            return $details['price'] * $details['quantity'];
        });

        return view('kiosk.index', compact('items', 'order', 'totalAmount'));
    }
    public function addToOrder(Request $request)
    {
        // Validate request to ensure `item_id` is provided
        $request->validate([
            'item_id' => 'required|integer|exists:items,id',
        ]);
    
        $item = Item::find($request->item_id);
    
        // Check if the item exists and has enough stock
        if (!$item || $item->quantity <= 0) {
            return redirect()->back()->with('error', 'Item is out of stock or not found.');
        }
    
        // Get the current order from session
        $order = session()->get('order', []);
    
        // Add item or update quantity
        if (isset($order[$item->id])) {
            // Check if the new quantity exceeds the available stock
            $newQuantity = $order[$item->id]['quantity'] + 1;
    
            if ($newQuantity > $item->quantity) {
                return redirect()->back()->with('error', 'Not enough stock available for this item.');
            }
    
            $order[$item->id]['quantity'] = $newQuantity;
        } else {
            // Add new item to the order
            $order[$item->id] = [
                "name" => $item->name,
                "price" => $item->price,
                "quantity" => 1,
            ];
        }
    
        // Save the updated order back to the session
        session()->put('order', $order);
    
        return redirect()->back()->with('success', 'Item added to order.');
    }
    
    // public function addToOrder(Request $request)
    // {
    //     $item = Item::find($request->item_id);
    
    //     // Check if the item exists and is not out of stock
    //     if (!$item || $item->quantity <= 0) {
    //         return redirect()->back()->with('error', 'Item is out of stock.');
    //     }
    
    //     // Get current order from session
    //     $order = session()->get('order', []);
    
    //     // Add item or update quantity
    //     if (isset($order[$item->id])) {
    //         // Check if the new quantity exceeds the available stock
    //         if ($order[$item->id]['quantity'] + 1 > $item->quantity) {
    //             return redirect()->back()->with('error', 'Not enough stock available for this item.');
    //         }
    //         $order[$item->id]['quantity']++;
    //     } else {
    //         $order[$item->id] = [
    //             "name" => $item->name,
    //             "price" => $item->price,
    //             "quantity" => 1
    //         ];
    //     }
    
    //     session()->put('order', $order);
    
    //     return redirect()->back()->with('success', 'Item added to order.');
    // }
    // public function removeFromOrder(Request $request)
    // {
    //     $order = session()->get('order');

    //     if(isset($order[$request->item_id])) {
    //         unset($order[$request->item_id]);
    //         session()->put('order', $order);
    //     }

    //     return redirect()->back()->with('success', 'Item removed from order.');
    // }

    public function checkout(Request $request)
    {
        DB::beginTransaction(); // Simulan ang database transaction
    
        try {
            // Kunin ang order data mula sa session
            $orderData = $request->session()->get('order');
    
            // I-validate kung may laman ang order
            if (!$orderData || !is_array($orderData)) {
                return redirect()->route('kiosk.index')->with('error', 'Walang order na available.');
            }
    
            // Kalkulahin ang kabuuang presyo ng order
            $totalPrice = collect($orderData)->sum(fn($details) => $details['price'] * $details['quantity']);
    
            // Lumikha ng bagong order na may unique order number
            $order = Order::create([
                'order_number' => strtoupper(uniqid('ORD-')), // Mas madaling basahin ang order number
                'total_price' => $totalPrice,
                'completed' => false,
            ]);
    
            // I-save ang bawat item sa order
            foreach ($orderData as $itemId => $details) {
                $item = Item::find($itemId);
    
                // I-validate kung available ang item
                if (!$item) {
                    DB::rollBack(); // Ibalik ang transaction kung may problema
                    return redirect()->route('kiosk.index')->with('error', "Item na may ID {$itemId} ay hindi nahanap.");
                }
    
                // Suriin kung sapat ang stock
                if ($item->quantity < $details['quantity']) {
                    DB::rollBack(); // Ibalik ang transaction kung kulang ang stock
                    return redirect()->route('kiosk.index')->with('error', "Kulang ang stock para sa {$item->name}.");
                }
    
                // Bawasan ang stock at i-save
                $item->decrement('quantity', $details['quantity']);
    
                // I-save ang order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $itemId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }
    
            // Linisin ang session order pagkatapos ng checkout
            $request->session()->forget('order');
    
            DB::commit(); // I-save ang transaction sa database
    
            // I-redirect sa "view order page" na may dalang order number
            return redirect()->route('order.view', ['orderNumber' => $order->order_number])
                ->with('success', "Order #{$order->order_number} na-save at naka-checkout na!");
        } catch (\Exception $e) {
            DB::rollBack(); // Ibalik ang transaction kung may error
            return redirect()->route('kiosk.index')->with('error', 'May error sa pag-checkout: ' . $e->getMessage());
        }
    }
    
    public function viewOrder($orderNumber)
    {
        // Fetch the order by its order_number
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
    
        return view('order.view', compact('order'));
    }
    

    public function update(Request $request)
    {
        $order = session()->get('order');

        if ($order) {
            $itemId = $request->input('item_id');
            $quantity = $request->input('quantity');

            // Ensure quantity is valid
            if ($quantity > 0) {
                $order[$itemId]['quantity'] = $quantity;
                session()->put('order', $order);
            }
        }

        return redirect()->back();
    }
 
    
    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->completed = request()->has('completed');
        $order->save();
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
    
    public function orderHistory()
    {
        // Fetch all orders from the database
        $orders = Order::with('items')->orderBy('created_at', 'desc')->get();
    
        return view('admin.history', compact('orders'));
    }
    
}




// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Item;
// use App\Models\Order;
// use App\Models\OrderItem;
// use Illuminate\Support\Facades\Session;

// class OrderController extends Controller
// {
//     public function index()
//     {
//         $items = Item::all();
//         $order = session()->get('order', []);

//         // Calculate total amount
//         $totalAmount = collect($order)->sum(function($details) {
//             return $details['price'] * $details['quantity'];
//         });

//         return view('kiosk.index', compact('items', 'order', 'totalAmount'));
//     }

//     public function addToOrder(Request $request)
//     {
//         $item = Item::find($request->item_id);

//         // Get current order from session
//         $order = session()->get('order', []);

//         // Add item or update quantity
//         if(isset($order[$item->id])) {
//             $order[$item->id]['quantity']++;
//         } else {
//             $order[$item->id] = [
//                 "name" => $item->name,
//                 "price" => $item->price,
//                 "quantity" => 1
//             ];
//         }

//         session()->put('order', $order);

//         return redirect()->back()->with('success', 'Item added to order.');
//     }

//     public function removeFromOrder(Request $request)
//     {
//         $order = session()->get('order');

//         if(isset($order[$request->item_id])) {
//             unset($order[$request->item_id]);
//             session()->put('order', $order);
//         }

//         return redirect()->back()->with('success', 'Item removed from order.');
//     }

//     public function checkout()
//     {
//         // Get order from session
//         $orderData = session('order');

//         if (!$orderData) {
//             return redirect()->route('kiosk.index')->with('error', 'Walang order na available.');
//         }

//         // Calculate total price
//         $totalPrice = collect($orderData)->sum(function($details) {
//             return $details['price'] * $details['quantity'];
//         });

//         // Save order to database
//         $newOrder = Order::create(['total_price' => $totalPrice, 'completed' => false]);

//         foreach ($orderData as $itemId => $details) {
//             OrderItem::create([
//                 'order_id' => $newOrder->id,
//                 'item_id' => $itemId,
//                 'quantity' => $details['quantity'],
//                 'price' => $details['price'],
//             ]);
//         }

//         // Clear session
//         Session::forget('order');

//         // Redirect to main menu after checkout
//         return redirect()->route('kiosk.index')->with('success', 'Order na-save at naka-checkout na!');
//     }

//     public function viewOrders()
//     {
//         // Query for orders where 'completed' is false (0)
//         $orders = Order::where('completed', false)->get();
    
//         return view('admin.orders', compact('orders'));
//     }
    

//     public function update(Request $request)
//     {
//         $order = session()->get('order');

//         if ($order) {
//             $itemId = $request->input('item_id');
//             $quantity = $request->input('quantity');

//             // Ensure quantity is valid
//             if ($quantity > 0) {
//                 $order[$itemId]['quantity'] = $quantity;
//                 session()->put('order', $order);
//             }
//         }

//         return redirect()->back();
//     }

//     public function completeOrder($id)
//     {
//         $order = Order::findOrFail($id);
//         $order->completed = request()->has('completed');
//         $order->save();

//         return redirect()->back()->with('success', 'Order status updated successfully.');
//     }

//     public function orderHistory()
//     {
//         // Fetch only completed orders from the database
//         $orders = Order::with('items')->where('completed', true)->orderBy('created_at', 'desc')->get();

//         return view('admin.history', compact('orders'));
//     }
    
// }
