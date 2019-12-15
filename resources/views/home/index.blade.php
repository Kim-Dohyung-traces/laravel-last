@extends('layouts.app')

@section('content')
  <header class="masthead">
    <div class="page-header">
      <div class="home-title">
        <h2>홈페이지</h2>
      </div>
      <div class="row">
        <div class="home-imgbox col-sm-8">
          <img class="img-thumbnail" src="http://127.0.0.1:8000/img/home-bg.jpg" alt="Background Image">
        </div>
        <div class="home-authbox col-sm-4">
          @if (Auth::guest())
          <form class="form__auth" action="{{ route('sessions.store') }}" method="POST" role="form" >
            {!! csrf_field() !!}
            <div class="col-sm-12">
              <div class="form-group">
                <label for="exampleInputEmail1">이메일 주소</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="이메일을 입력하세요" value="admin@mail.com" autofocus>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">암호</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="암호" value="secret">
              </div>
            </div>
            <div class="home-authbox-buttondiv row col-sm-12">
              <button class="home-buttons col-sm-6" type="submit">로그인</button>
              <a class="home-buttons col-sm-6 " href="{{ route('users.create') }}">회원가입</a>
            </div>
          </form>
          @else
          <form class="form__auth" action="{{ route('sessions.destroy') }}" method="GET" role="form">
            {!! csrf_field() !!}
            <div class="col-sm-12">
              <div class="form-horizontal">
                <label class="control-label" for="inputSuccess1">logged Email</label>
                <label class="form-control" id="inputSuccess1">{{ Auth::user()->email }}</label>
              </div>
              <div class="form-group">
                <button class="home-buttons col-sm-12 " type="submit">로그아웃</button>
              </div>
            </div>
          </form>
          @endif
        </div>
      </div>
    </div>
  </header>
@stop

@section('script')
<script>
  $(document).ready(function(){
    console.log("good");
  })
</script>
@stop