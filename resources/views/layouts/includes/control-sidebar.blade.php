<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="{{ route('profile', [Auth::user()->id]) }}" class="d-block">{{ Auth::user()->name }}</a>
    </div>
  </div>

  <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-block btn-default">Logout</button>
</form>