<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Promotion\StorePromotion;
use App\Http\Requests\Promotion\UpdatePromotion;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;



class PromotionController extends Controller
{
    private Promotion $promotion;
    public function __construct()
    {
        $this->promotion = new Promotion();
        view::share('countList',count($this->promotion->all()));
        view::share('countTrash',count($this->promotion->onlyTrashed()->get()));
        $arrProStatus = StatusEnum::getStatus();
        view::share('arrProStatus',$arrProStatus);
    }

    public function index(Request $request){
        $query = $this->promotion->newQuery();
        if($request->has('q')){
            if($request->input('q') != ''){
                $searchTerm = $request->input('q');
                $query->where('code', 'LIKE', '%' . $searchTerm . '%');
            }else{
                return redirect()->route('promotion.index');
            }
        }
        $promotions = $query->paginate(5);
        return view('admin.module.promotions.index',compact('promotions'));
    }

    public function trash(Request $request){
        $query = $this->promotion->newQuery();
        if($request->has('q')){
            if($request->input('q') != ''){
                $searchTerm = $request->input('q');
                $query->where('code', 'LIKE', '%' . $searchTerm . '%');
            }
        }
        $promotions = $query->onlyTrashed()->paginate(5);
        return view('admin.module.promotions.trash',compact('promotions'));
    }

    public function restore($id_item_trash)
    {
        $promotion = $this->promotion->withTrashed()->where('_id', $id_item_trash)->restore();
        return redirect()->route('promotion.index')->with('success','Restore Promotion Successfully !');

    }

    public function force($id_item_trash)
    {
        $this->promotion->withTrashed()->where('_id', $id_item_trash)->forceDelete();
        return redirect()->route('promotion.trash')->with('success','Delete Promotion Successfully !');
    }


    public function create(){
        return view('admin.module.promotions.create');
    }

    public function store(StorePromotion $request){
//        dd($request);
        $this->promotion->create($request->validated());
        return redirect()->route('promotion.index')->with('success','Create Promotion Successfully !');
    }

    public function edit($promotion){
        $promotion = $this->promotion->find($promotion);
        return view('admin.module.promotions.edit',compact('promotion'));
    }

    public function update(UpdatePromotion $request, $promotionId){
//        dd($request);
        $promotion = $this->promotion->find($promotionId);
        $promotion->update($request->validated());
        return redirect()->route('promotion.index')->with('success','Update Promotion Successfully !');
    }

    public function destroy($promotionId){
        $this->promotion->destroy($promotionId);
        return redirect()->route('promotion.index')->with('success','Delete Promotion Successfully !');
    }

}
