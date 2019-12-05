@extends('layouts.app')

@section('content')
  <!-- Page Header -->
  <header class="masthead">
    <div class="page-header">
      <h2>홈페이지</h2>
      <div class="container">
        <h4>
          <span class="subheading">
            YEUNGJIN_UNIVERSITY_WDJ6
          </span>
            @if (Auth::guest())
            <form class="homeSessions" style="display: inline-block;" action="{{ route('sessions.store') }}" method="POST" role="form" class="form__auth">
              {!! csrf_field() !!}
              <div>
                <input type="email" name="email"  placeholder="이메일" value="admin@mail.com" autofocus />
              </div>
              <div>
                <input type="password" name="password"  placeholder="비밀번호" value="secret">
              </div>
              <div>
                <button class="btn" type="submit">
                  로그인
                </button>
              </div>
            </form>
            @else
            
            <form class="homeSessions" style="display: inline-block;" action="{{ route('sessions.destroy') }}" method="GET" role="form" class="form__auth">
              {!! csrf_field() !!}
              <div>
                <label for="">email : </label>
                <label for="">{{ Auth::user()->name }}</label>
              </div>
              <div>
                <button class="btn" type="submit">
                  로그아웃
                </button>
              </div>
            </form>
            @endif


        </h4>
        <div>
          <img src="http://127.0.0.1:8000/img/home-bg.jpg" alt="Background Image" style="max-width: 100%; height: auto;">
        </div>
      </div>
    </div>
  </header>
@stop