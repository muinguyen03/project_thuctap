<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\ChangePasswordRequest;
use App\Http\Requests\Client\Profile\InfomationRequest;
use App\Http\Requests\Client\Profile\UpdateImageRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private User $model;

    public function __construct()
    {
        $this->model = new User();
    }
    public function update_image(UpdateImageRequest $request): RedirectResponse
    {
        $user = $this->model->find(Auth::user()->id);
        $image = $request->file('image_user');
        $uploadedFileUrl = $this->UploadImageCloudinary($image,'users');
        $user->image = $uploadedFileUrl;
        $user->save();
        return redirect()->route('client.profile')->with('success','Update Image Successfully !');
    }
    public function update_info(InfomationRequest $request)
    {
        $user = $this->model->find(Auth::user()->id);
        $user->fill($request->all())->save();
        return redirect()->route('client.profile')->with('success','Update Information Successfully !');
    }
    public function update_password(ChangePasswordRequest $request)
    {
        $user = $this->model->find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('client.profile')->with('success','Update Password Successfully !');
    }
}
