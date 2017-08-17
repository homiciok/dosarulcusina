
@extends('layouts.master')

@section('title')
    Authentification
    @endsection

@section('content')
   @include('includes.messages-block')
    <div class="row">
        <div class="col-md-6">
        <h3>Sign up</h3>
            <form action="{{ route('signup') }}" method="post">
                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                    <label for "email">Your e-mail</label>
                    <input  class="form-control"  type="text" name="email" id="email" value="{{Request::old('email')}}">
                </div>
                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                    <label for "name">Your name</label>
                    <input  class="form-control" type="text" name="name" id="name" value="{{Request::old('name')}}">
                </div>
                <div class="form-group {{$errors->has('surname') ? 'has-error' : ''}}">
                    <label for "surname">Your surname</label>
                    <input  class="form-control" type="text" name="surname" id="surname" value="{{Request::old('surname')}}">
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                    <label for "password">Your password</label>
                    <input  class="form-control" type="password" name="password" id="password">
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                    <label for "password_check">Your password</label>
                    <input  class="form-control" type="password" name="password_check" id="password_check">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>

         <div class="col-md-6">
         <h3>Sign in</h3>
            <form action="{{ route('signin') }}" method="post">
                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                    <label for "email">Your e-mail</label>
                    <input  class="form-control" type="text" name="email" id="email">
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                    <label for "password">Your password</label>
                    <input  class="form-control" type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                
            </form>
        </div>
    </div>

    @endsection