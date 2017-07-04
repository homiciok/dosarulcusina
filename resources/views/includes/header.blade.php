<header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="{{route('homepage')}}">Dosarulcusina</a>
    </div>
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Search</button>
    </form>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::user())
        <li><a href="{{ route('account') }}">Account</a></li> 
          <li><a href="{{ route('logout') }}">Logout</a></li> 
        @else
          <li><a  href="{{ route('authenticatePage') }}">Sign in/Sign out</a></li> 
        @endif  
      </ul>  
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>
</header>
