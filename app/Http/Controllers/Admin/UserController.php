<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private User $model;
    private $adminId1 = '64aed7a67c76333ed40e6435';
    private $adminId2 = '649a42ecf92cacd72fc85572';



    public function __construct()
    {
        $this->model = new User();
        View::share('countList', count($this->model->where('_id','!=', $this->adminId1)->where('_id','!=', $this->adminId2)->get()));
        View::share('countTrash', count($this->model->onlyTrashed()->get()));
        $arrUserStatus = UserStatusEnum::getUserStatus();
        View::share('arrUserStatus',$arrUserStatus);
    }
    public function index(Request $request)
    {
        $query = $this->model->newQuery();
        if ($request->has('q')) {
            $searchTerm = $request->input('q');
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }
        $query->where('_id','!=', $this->adminId1)->where('_id','!=', $this->adminId2);
        $users = $query->paginate(5);
        return view('admin.module.users.index', compact('users'));
    }
    public function trash(Request $request)
    {
        $query = $this->model->newQuery();
        if ($request->has('q')) {
            if ($request->input('q') != '') {
                $searchTerm = $request->input('q');
                $query->where('name', 'LIKE', '%' . $searchTerm . '%');
            }
        }
        $users = $query->onlyTrashed()->paginate(3);
        return view('admin.module.users.trash', compact('users'));

    }
    public function restore($id_user_trash){
//        dd($id_user_trash);
        $this->model->withTrashed()->where('_id', $id_user_trash)->restore();
        return redirect()->route('users.index')->with('success','Restore User Successfully !');
    }
    public function force($id_user_trash){
//        dd($user);
        $this->model->withTrashed()->where('_id', $id_user_trash)->forceDelete();
        return redirect()->route('users.trash')->with('success','Delete User Successfully !');
    }
    public function create()
    {
        return view('admin.module.users.create');
    }
    public function store(StoreUser $request)
    {
//         dd($request);
        $image = $request->file('image');
        $arr =$request->all();
        $uploadedFileUrl = $this->UploadImageCloudinary($image,'users');
        // dd($uploadedFileUrl);
        $arr['image'] = $uploadedFileUrl;
        $arr['password'] = Hash::make($request->get('pass'));
        //  dd($arr);
        $this->model->create($arr);
        return redirect()->route('users.index')->with('success','Create User Successfully !');
    }
    public function edit(Request $request, $user)
    {
        if($user == $this->adminId1 || $user == $this->adminId2){
            return redirect()->route('users.index')->with('error','Don\'t edit this User!');
        }else{
            $object = $this->model->find($user);
            // dd($object);
            if($object){
                return view('admin.module.users.edit',[
                    'user'=> $object,
                ]);
            }else{
                return redirect()->route('users.index')->with('error','User not found! ');
            }
//            return view('admin.module.users.edit');
        }
    }
    public function update(UpdateUser $request, $userId)
    {
        // dd($userId);
        $object = $this->model->find($userId);
//         dd($object);
        $image = $request->file('image');
        if($image){
            $uploadedFileUrl = $this->UploadImageCloudinary($image,'users');
            // $arr = $request->validate();
            $arr['image'] = $uploadedFileUrl;
            $object->update($arr);
        }
        else{
            $object->fill($request->all())->save();
        }
        return redirect()->route('users.index')->with('success','Update User Successfully !');
    }
    public function destroy(Request $request, $userId)
    {
        if($userId == $this->adminId1 || $userId == $this->adminId2){
            return redirect()->route('users.index')->with('error','Don\'t delete this User!');
        }
        else{
            $this->model->destroy($userId);
            return redirect()->route('users.index')->with('success','Delete User Successfully !');
        }
    }

    public function deleteAll(){
        $this->model
            ->where('deleted_at', '!=', null)
            ->forceDelete();
        return redirect()->route('users.trash')->with('success','Delete All User Successfully !');
    }
}
