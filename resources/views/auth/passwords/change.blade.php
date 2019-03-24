@extends('layouts.app') 
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Change Password
            </div>
            <div class="card-body">

                <form method="POST" action="{{ route('password.change') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="control-label">Current Password</label>

                        <div class="">
                            <input id="current-password" type="password" class="form-control" name="current-password" required>                            @if ($errors->has('current-password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="ontrol-label">New Password</label>

                        <div class="">
                            <input id="new-password" type="password" class="form-control" name="new-password" required> @if ($errors->has('new-password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new-password-confirm" class="control-label">Confirm New Password</label>

                        <div class="">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection