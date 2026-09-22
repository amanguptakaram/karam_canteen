<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $foods = Food::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('price', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        if ($request->ajax()) {
            return response()->json($foods);
        }

        return view('admin.foods.index', compact('foods'));
    }


    public function create()
    {
        return view('admin.foods.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        Food::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()
            ->route('foods.index')
            ->with('success', 'Food added successfully!');
    }


    public function show(Food $food)
    {
        return view('admin.foods.show', compact('food'));
    }


    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
    }


    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $food->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()
            ->route('foods.index')
            ->with('success', 'Food updated successfully!');
    }


    public function destroy(Food $food)
    {
        $food->delete();

        return redirect()
            ->route('foods.index')
            ->with('success', 'Food deleted successfully!');
    }


    public function home(Request $request)
    {
        $query = Food::where('is_available', true);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $foods = $query->latest()->get();

        return view('home', compact('foods'));
    }
}
