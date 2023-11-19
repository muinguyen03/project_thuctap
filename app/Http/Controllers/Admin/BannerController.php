<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Mockery\Undefined;

class BannerController extends Controller
{
    private Banner $banner;
    private int $count_active;
    private int $count;

    public function __construct()
    {
        $this->banner = new Banner();
        View::share('countList', count($this->banner->all()));
        View::share('countTrash', count($this->banner->onlyTrashed()->get()));
        $arrStatus = StatusEnum::getStatus();
        View::share('arrStatus', $arrStatus);
        $banner = $this->banner->newQuery();
        $this->count_active = count($banner->where('status',0)->get());
        $this->count = count($banner->get());
    }

    public function index()
    {
        $banner = $this->banner->paginate(5);
        return view('admin.module.banners.index',compact('banner'));
    }

    public function trash()
    {
        $query = $this->banner->newQuery();
        $banner = $query->onlyTrashed()->paginate(5);
        return view('admin.module.banners.trash',compact('banner'));
    }

    public function restore($id_item_trash): RedirectResponse
    {
        $this->banner->withTrashed()->where('_id', $id_item_trash)->restore();
        return redirect()->route('banner.index')->with('success','Restore Banner Successfully !');
    }

    public function force($id_item_trash): RedirectResponse
    {
        $banner = $this->banner->withTrashed()->where('_id', $id_item_trash)->firstOrFail();
        Storage::disk('public')->delete($banner->url);
        $banner->forceDelete();
        return redirect()->route('banner.trash')->with('success','Delete Banner Successfully !');
    }

    public function create()
    {
        return view('admin.module.banners.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $list = $this->UploadMultiImage($request->file('image_banner'),'banners');
        foreach ($list as $item){
            $this->banner->create(['url' => $item]);
        }
        return redirect()->route('banner.index')->with('success','Create Banner Successfully !');
    }

    public function edit($id)
    {
        $banner = $this->banner->find($id);
        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Banner Not Found!');
        }
        return view('admin.module.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $banner = $this->banner->find($id);
        $image  = $request->file('image_banner');
        $arr    = $request->all();

        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'Banner Not Found!');
        }

        if ($image) {
            Storage::disk('public')->delete($banner->url);
            $uploadedFileUrl = $this->UploadImage($image,'banners');
            $arr['url'] = $uploadedFileUrl;
        }

        $arr['status'] = (integer)$request->status;
        $banner->update($arr);
        return redirect()->route('banner.index')->with('success', 'Update Banner Successfully!');
    }

    public function destroy($id): RedirectResponse
    {
        $banner = $this->banner->find($id);
        if($banner){
            if($this->count < 3){
                return redirect()->route('banner.index')->with('error','Minimum 3 banners !');
            }
            if($this->count_active < 3){
                return redirect()->route('banner.index')->with('error','Minimum 3 active banners !');
            }
            $this->banner->destroy($id);
            return redirect()->route('banner.index')->with('success','Banner is trash!');
        }
        else {
            return redirect()->route('banner.index')->with('error','Banner Not Found!');
        }
    }
    public function deleteAll(){
        $banner = $this->banner->onlyTrashed();
        $list = $banner->get();
         foreach($list as $item){
            Storage::disk('public')->delete($item->url);
        }
        $banner->forceDelete();
        return redirect()->route('banner.trash')->with('success','Delete All Banner Successfully !');
    }
}
