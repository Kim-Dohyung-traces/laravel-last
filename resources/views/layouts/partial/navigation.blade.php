<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <!-- Branding Image -->
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'WWW') }}
      </a>

      <!-- ############# 추가 ############# -->
      <a class="navbar-brand" href="{{ route('members.index') }}">
      멤버 소개
      </a>
      <a class="navbar-brand" href="">
      현지 학기
      </a>
      <a class="navbar-brand" href="">
      질의 응답
      </a>
      <!-- ############# 추가 ############# -->

      <!-- Collapsed Hamburger -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        Auth
      </button>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <!-- Left Side Of Navbar -->
      <ul class="nav navbar-nav">
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
          <li>
            <a href="{{ route('sessions.create') }}">
            로그인
            </a>
          </li>
          <li>
            <a href="{{ route('users.create') }}">
            회원가입
            </a>
          </li>
          
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="{{ route('sessions.destroy') }}">
                로그아웃
                </a>
              </li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>