<?php

// namespace App\Http\Controllers;

// use App\Models\Menu; // Ensure this line is included
// use Illuminate\Http\Request;

// class MenuController extends Controller
// {
//     public function search(Request $request)
//     {
//         $query = $request->input('query');

//         if ($query) {
//             $items = Menu::where('name', 'LIKE', "%{$query}%")->get();
//         } else {
//             $items = Menu::all(); // Show all items if no query
//         }

//         return view('kiosk.index', compact('items'));
//     }
// }
