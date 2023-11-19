<style>
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
    .btn-danger-soft {
        color: #000;
        background-color: #f1e0e3;
        border-color: #f1e0e3;
    }
</style>


<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('user.update.password')}}" method="post" class="form" id="change-password-form" >
                        @csrf
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="current-password">Current Password</label>
                            <input class="form-control" id="current-password" name="old_password" type="password" placeholder="Enter current password">
                            @if($errors->has('old_password'))<span class="text-danger">{{ $errors->first('old_password') }}</span>@endif
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="new-password">New Password</label>
                            <input class="form-control" id="new-password" name="new_password" type="password" placeholder="Enter new password">
                            @if($errors->has('new_password'))<span class="text-danger">{{ $errors->first('new_password') }}</span>@endif
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="confirm-password">Confirm Password</label>
                            <input class="form-control" id="confirm-password" name="password_confirmation" type="password" placeholder="Confirm new password">
                            @if($errors->has('password_confirmation'))<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>@endif
                            <span class="form-message"></span>
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">Delete Account</div>
                <div class="card-body">
                    <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
{{--                    <button class="btn btn-danger-soft text-danger mt-2" type="button">I understand, delete my account</button>--}}
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    <script>
        changePasswordValidate();
    </script>
@endsection
