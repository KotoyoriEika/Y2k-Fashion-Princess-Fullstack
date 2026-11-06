<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $limit = (int) $request->get('limit', 10);

        return ProductResource::collection(
            $query->orderBy('product_id', 'desc')->paginate($limit)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'specifications' => 'nullable|array',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['img'] = $request->hasFile('img')
            ? $request->file('img')->store('products', 'public') : null;
        $data['slug'] = Str::slug($data['name']);

        return new ProductResource(Product::create($data)->load('category'));
    }

    public function show(string $id)
    {
        return new ProductResource(Product::with('category')->findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'specifications' => 'nullable|array',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('img')) {
            if ($product->img)
                Storage::disk('public')->delete($product->img);
            $data['img'] = $request->file('img')->store('products', 'public');
        }
        $data['slug'] = Str::slug($data['name']);

        $product->update($data);
        return new ProductResource($product->load('category'));
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);

        if ($product->img)
            Storage::disk('public')->delete($product->img);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}