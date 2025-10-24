<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class ProductsController extends Controller
{
    // Halaman daftar produk (katalog)
    public function index(): Response
    {
        $products = Product::with('category')
            ->select('id', 'name', 'slug', 'cash_price', 'image_url', 'description', 'category_id', 'stock')
            ->get();

        return Inertia::render('Member/Products', [
            'products' => $products,
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
