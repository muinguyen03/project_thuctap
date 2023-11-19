<style>
    .img-account-profile {
        height: 10rem;
    }
    .rounded-circle {
        border-radius: 50% !important;
    }
    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
    }
    .card .card-header {
        font-weight: 500;
    }
    .card-header:first-child {
        border-radius: 0.35rem 0.35rem 0 0;
    }
    .card-header {
        padding: 1rem 1.35rem;
        margin-bottom: 0;
        background-color: rgba(33, 40, 50, 0.03);
        border-bottom: 1px solid rgba(33, 40, 50, 0.125);
    }
</style>

<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-4">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Account Image</div>
                <div class="card-body text-center">
                    <img class="img-account-profile rounded-circle mb-2" src="{{ Auth::user()->image }}" alt="">
                </div>
            </div>
            <div class="mt-3 mb-3"></div>
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Upload new image</div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{route('user.update.image')}}">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control mb-1" id="inputImage" name="image_user" type="file">
                            @if($errors->has('image_user'))
                                <span class="text-danger">
                                    {{ $errors->first('image_user') }}
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form method="post" action="{{route('user.update.info')}}" class="form" id="change-information-form">
                        @csrf
                        <div class="form-group mb-3 {{$errors->has('name') ? 'invalid' : ''}} ">
                            <label class="small mb-1" for="inputName">Name</label>
                            <input class="form-control" id="inputName" name="name" type="text" placeholder="Enter your name" value="{{Auth::user()->name}}">
                            @if($errors->has('name'))
                                <span class="text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                            <span class="form-message"></span>
                        </div>

                        <div class=" row gx-3 mb-3">
                            <div class="form-group col-md-6 {{$errors->has('email') ? 'invalid' : ''}}">
                                <label class="small mb-1" for="inputEmail">Email</label>
                                <input class="form-control" id="inputEmail" name="email" type="email" placeholder="Enter your email" value="{{Auth::user()->email}}">
                                @if($errors->has('email'))
                                    <span class="text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group col-md-6 {{$errors->has('phone') ? 'invalid' : ''}}">
                                <label class="small mb-1" for="inputPhone">Phone Number</label>
                                <input class="form-control" id="inputPhone" name="phone" type="text" placeholder="Enter your phone" value="{{Auth::user()->phone != '' ? Auth::user()->phone : ''}}">
                                @if($errors->has('phone'))
                                    <span class="text-danger">
                                        {{ $errors->first('phone') }}
                                    </span>
                                @endif
                                <span class="form-message"></span>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="inputAddress">Address</label>
                            <textarea class="form-control" id="inputAddress" name="address" cols="10" rows="5">{{Auth::user()->address != '' ? Auth::user()->address : ''}}</textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    <script>
        changeInfomationValidate();
    </script>
@endsection
