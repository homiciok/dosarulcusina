@extends ('layouts.master')


@section('title')
	Account
@endsection

@section('content')
	<section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your Account</h3></header>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" class="form-control" value="{{ $user->surname }}" id="surname">
                    <label for="password">Actual Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <label for="password">New password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <label for="password">Change your password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <label for="posts">Your posts</label>
                    <input type="text" name="posts" class="form-control" id="posts" value="{{ $user->posts }}">
                </div>
                <div class="form-group">
                    <label for="image">Avatar</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>

    @if (Storage::disk('local')->has($user->id . '.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('account.image', [ $user->id . '.jpg']) }}" alt="" class="img-responsive">
            </div>
        </section>
    @endif

@endsection