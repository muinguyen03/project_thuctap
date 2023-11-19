<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\StatusEnum;

class CategoryApiController extends Controller
{
    private Category $category;
    public function __construct()
    {
        $this->category = new Category();
    }
    public function index(Request $request){
        $query = $this->category->newQuery();
        if ($request->has('q')) {
            $searchTerm = $request->input('q');
            $query->where('name_category', 'LIKE', '%' . $searchTerm . '%');
        }
        return response()->json($this->category->all());
    }
    public function show($id){
        $category = $this->category->find($id);
        if(!$category){
            return response()->json([
                'status'  => false,
                'message' => 'Khong tim thay danh muc !'
            ]);
        }
        return response()->json($this->category->find($id));
    }
    public function store(Request $request){
        return response()->json($this->category->create($request->all()));
    }
    public function update(Request $request, $id){
        $category = $this->category->find($id);
        if(!$category){
            return response()->json([
                'status'  => false,
                'message' => 'Khong tim thay danh muc !'
            ]);
        }
        return response()->json($category->update($request->all()));
    }
    public function destroy($categoryId){
        $category = $this->category->find($categoryId);
        if(!$category){
            return response()->json([
                'status'  => false,
                'message' => 'Khong tim thay danh muc !'
            ]);
        }
        $this->category->destroy($categoryId);
        return response()->json([
            'status'  => true,
            'message' => 'Xoa danh muc thanh cong !'
        ]);
    }

}
