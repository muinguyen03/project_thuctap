<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategory;
use App\Http\Requests\Category\UpdateCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private Product $product;
    private Category $category;
    private string $id = '64ba54a608a04b6e800859a2';

    public function __construct()
    {
        $this->category = new Category();
        $this->product = new Product();
        \Illuminate\Support\Facades\View::share('countList', count($this->category->all()));
        \Illuminate\Support\Facades\View::share('countTrash', count($this->category->onlyTrashed()->get()));
        $arrStatus = StatusEnum::getStatus();
        \Illuminate\Support\Facades\View::share('arrStatus', $arrStatus);
        \Illuminate\Support\Facades\View::share('cate_no_del', $this->id);
    }

    public function index(Request $request): View|Factory|Application|RedirectResponse
    {
        $query = $this->category->newQuery();
        if ($request->has('q')) {
            if($request->input('q') != ''){
                $searchTerm = $request->input('q');
                $query->where('name_category', 'LIKE', '%' . $searchTerm . '%');
            }
            else {
                return redirect()->route('category.index');
            }
        }
        $categories = $query->paginate(5);
        return view('admin.module.categories.index',compact('categories'));
    }

    public function trash(Request $request): Factory|View|Application
    {
        $query = $this->category->newQuery();
        if ($request->has('q')) {
            if($request->input('q') != ''){
                $searchTerm = $request->input('q');
                $query->where('name_category', 'LIKE', '%' . $searchTerm . '%');
            }
        }
        $categories = $query->onlyTrashed()->paginate(5);
        return view('admin.module.categories.trash',compact('categories'));
    }

    public function restore($id_item_trash): RedirectResponse
    {
        $category = $this->category->withTrashed()->where('_id', $id_item_trash);
        if(!$category){
            return redirect()->route('category.trash')->with('error','Category Not Found !');
        }
        $category->restore();
        return redirect()->route('category.index')->with('success','Restore Category Successfully !');
    }

    public function force($id_item_trash): RedirectResponse
    {
        $category = $this->category->withTrashed()->where('_id', $id_item_trash);
        if(!$category){
            return redirect()->route('category.trash')->with('error','Category Not Found !');
        }
        $category->forceDelete();
        return redirect()->route('category.trash')->with('success','Delete Category Successfully !');
    }

    public function create(): Factory|View|Application
    {
        return view('admin.module.categories.create');
    }

    public function store(StoreCategory $request): RedirectResponse
    {
        $this->category->create($request->validated());
        return redirect()->route('category.index')->with('success','Create Category Successfully !');
    }

    public function edit($categoryId): Factory|View|RedirectResponse|Application
    {
        $category = $this->category->find($categoryId);

        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category Not Found!');
        }

        if($categoryId == $this->id){
            return redirect()->route('category.index')->with('error','Don\'t edit Category !');
        }

        $category = $this->category->find($categoryId);
        return view('admin.module.categories.edit',compact('category'));
    }

    public function update(UpdateCategory $request, $categoryId): RedirectResponse
    {
        $category = $this->category->find($categoryId);
        $input    = $request->validated();
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category Not Found!');
        }
        if($categoryId == $this->id){
            return redirect()->route('category.index')->with('error','Don\'t edit Category !');
        }
        if ($request->status == 1) {
            $this->product->where('category_id', $categoryId)->update(['category_id' => $this->id]);
        }
        $input['status'] = (integer)$request->status;
        $category->update($input);
        return redirect()->route('category.index')->with('success', 'Update Category Successfully!');
    }

    public function destroy($categoryId): RedirectResponse
    {
        $category = $this->category->find($categoryId);

        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category Not Found!');
        }

        if ($categoryId == $this->id) {
            return redirect()->route('category.index')->with('error', 'You are not allowed to delete this Category!');
        }
        $this->product->where('category_id', $categoryId)->update(['category_id' => $this->id]);

        $this->category->destroy($categoryId);
        return redirect()->route('category.index')->with('success', 'Delete Category Successfully!');
    }

    public function deleteAll(){
        $this->category
            ->where('deleted_at', '!=', null)
            ->forceDelete();
        return redirect()->route('category.trash')->with('success','Delete All Category Successfully !');
    }

}
