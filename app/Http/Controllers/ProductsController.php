<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            Product::create($validated);

            DB::commit();

            return redirect()->route('products.index')
                ->with('success', 'Product created successfully.');

        } catch (QueryException $e) {

            DB::rollBack();

            return back()->with('error', 'Database conflict occurred.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Unexpected error occurred.');
        }
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            $product->update($validated);

            DB::commit();

            return redirect()->route('products.index')
                ->with('success', 'Product updated successfully.');

        } catch (QueryException $e) {

            DB::rollBack();

            return back()->with('error', 'Update conflict detected.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Unexpected error occurred.');
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('products.index')
                ->with('success', 'Product deleted successfully.');

        } catch (\Exception $e) {

            return back()->with('error', 'Failed to delete product.');
        }
    }
}