<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductApiController extends Controller
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index(){
        return DataTables::of($this->product->all())
            ->editColumn('status', function ($object) {
                return StatusEnum::getStatusKeyByValue($object->status);
            })
            ->addColumn('edit', function ($object) {
                return route('product.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('product.del', $object);
            })
            ->make(true);
    }

    public function store(Request $request){
        $this->product->create($request->all());
        return response()->json(['message' => 'Product created successfully']);
    }

    public function update(Request $request, Product $product){
        $product->update($request->all());
        return response()->json(['message' => 'Product updated successfully']);
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function show(Product $product){
        return response()->json($product);
    }
}
