<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductsController extends Controller
{
    // Halaman daftar produk (katalog)
    public function index(Request $request): Response
    {
        $query = $request->input('q'); // ambil kata kunci pencarian

        $products = Product::with('category')
            ->when($query, function ($qbuilder) use ($query) {
                $qbuilder->where('name', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%")
                         ->orWhereHas('category', function ($cat) use ($query) {
                             $cat->where('name', 'like', "%{$query}%");
                         });
            })
            ->select('id', 'name', 'slug', 'cash_price', 'image_url', 'description', 'category_id', 'stock')
            ->get();

        return Inertia::render('Member/Products', [
            'products' => $products,
            'search'   => $query,
        ]);
    }

    // Halaman detail produk
    public function show(Product $product): Response
    {
        $product->load('category');

        return Inertia::render('Member/ProductDetail', [
            'product' => $product,
        ]);
    }
}
