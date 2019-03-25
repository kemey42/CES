@extends('layouts.app') 
@section('content')

<h2>User: {{$user->fullname}}</h2>
<hr/>

<div class="row justify-content-center">
    <div class="col-md-8 mb-3">
        <div class="card">
            <div class="card-header">
                Update User Information
            </div>
            <div class="card-body">

                {!! Form::open(['action' => ['UserController@update', $user], 'method' => 'POST']) !!}

                <div class="form-group row required">
                    <label for="fullname" class="control-label col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                    <div class="col-md-6">
                        {{Form::text('fullname', old("fullname") ? old("fullname") : (!empty($user) ? $user->fullname : null), ['class' => 'form-control
                        required '.( $errors->has('fullname') ? 'is-invalid' : '' )]) }}
                        @if ($errors->has('fullname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('fullname') }}</strong>
                            </span> 
                        @endif
                    </div>
                </div>

                <div class="form-group row required">
                    <label for="email" class="control-label col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div class="col-md-6">
                        {{Form::text('email', old("email") ? old("email") : (!empty($user) ? $user->email : null), ['class' => 'form-control
                        required '.( $errors->has('email') ? 'is-invalid' : '' )]) }}
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span> 
                        @endif
                    </div>
                </div>

                <div class="form-group row required">
                    <label for="phone_number" class="control-label col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                    <div class="col-md-6">
                        {{Form::text('phone_number', old("phone_number") ? old("phone_number") : (!empty($user) ? $user->phone_number : null), ['class' => 'form-control
                        required '.( $errors->has('phone_number') ? 'is-invalid' : '' )]) }}
                        @if ($errors->has('phone_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span> 
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="control-label col-md-4 col-form-label text-md-right">{{ __('Mailing Address') }}</label>
                    <div class="col-md-6">
                        {{Form::textarea('address', old("address") ? old("address") : (!empty($user) ? $user->address : null), 
                        ['rows' => "3", 'class' => 'form-control'.( $errors->has('address') ? 'is-invalid' : '' )]) }}
                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span> 
                        @endif
                    </div>
                </div>

                <div class="form-group row required">
                    <label for="user-role" class="control-label col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                    <div class="col-md-6">
                                {{Form::select("user-role", $rolelist, old("user-role") ? old("user-role") : (!empty($user) ? $user->roles()->get() : null), 
                                [ "class" => "form-control required", "placeholder" => "Choose role below: -" ] )}}
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                            {{Form::hidden('_method', 'PUT')}} {{Form::submit('Update', ['class' => 'btn btn-primary'])}} 
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>

@endsection