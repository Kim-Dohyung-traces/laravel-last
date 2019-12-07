@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div>
        <div class="page-header">
            <div class="program-title">
                <h2>현지학기제</h2>
            </div>
            <div class="program-button">
                <label class="btn btn-primary btnCreate" onclick="create()">새글 쓰기</label>   
            </div>
            <hr>
        </div>

        <!-- <div class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="img\about-bg.jpg" alt="carousel-img" style="max-width: 100%">
                    <div class="carousel-caption">
                        <h1 style="font-size: 10em">test1</h1>
                    </div>
                </div>
                <div class="item">
                    <img src="img\about-bg.jpg" alt="carousel-img" style="max-width: 100%">
                    <div class="carousel-caption">
                        <h1 style="font-size: 10em">test2</h1>
                    </div>
                </div>
            </div>
        </div>  -->
        <div class="program-div">
            @forelse ($programs as $program)
               @include('programs.partials.program', compact('program'))
            @empty
                <p class="text-center text-danger">
                    글이 없습니다.
                </p>
            @endforelse
            @if($programs->count())
                <div class="text-center program-paginator">
                    <div class="paginator">
                        {!! $programs->appends(request()->except('page'))->render() !!}
                    </div>
                </div>
            @endif
        </div>
        <div class="create-form">
            @include('programs.create')
        </div>
    </div>
@stop
@section('script')
    <script>
        function create(){
            console.log('create form 호출');
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type:'GET',
                url: 'programs/'+'create',
                data: {
                mydata: "mydata",
                },
                success: function(data){
                console.log(data);
                }
            });
            if(!'{{auth()->user()}}'){
                alert("로그인 한 유저만 글 작성이 가능합니다");
                return;
            }
            $('.program-div').css("display","none");
            $('.create-form').css("display","block");
            $('.page-header').css("display","none");
        }
        function back(){
            $('.program-div').css("display","block");
            $('.create-form').css("display","none");
            $('.page-header').css("display","block");
        }   
        function show(){

        }
        function store(){
            var form = $('#program_create_form')[0];
            var data = new FormData(form);
            $.ajax({
                type:'POST',
                url: 'programs',
                data: data,
                processData:false,
                contentType:false,
                error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
            }).then(function(){    
                $('.program-div').load('/programs .program-div').css("display","block");
                $('.create-form').css("display","none");
                $('.page-header').css("display","block");
            });
        }
    </script>
@stop
@section("style")
    <style>
        .create-header{
        margin-top:15px;
        }
        .program-title{
        display: inline-block;
        margin: 5px !important;
        }
        .create-title{
        margin-top:auto;
        margin-bottom:auto;
        display: inline-block;
        }
        .program-button{
        float: right;
        display: inline-block;
        margin: 5px !important;
        }
        .create-button{
        margin-top:auto;
        margin-bottom:auto;
        float: right;
        display: inline-block;
        margin: 5px !important;
        }
        .card {
        position: relative;
        display: -webkit-box;
        display: flex;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
        }
        .card-imgbox{
        margin: 5px;
        }
        .cardimg{
        margin: 5px;
        max-width: 100%;
        border-radius: 0.25rem;
        }
        .card-body {
        margin: 5px;
        -webkit-box-flex: 1;
                flex: 1 1 auto;
        min-height: 1px;
        padding: 1.25rem;
        }
        .card-information{
        display: flex;
        margin-bottom:10px;
        margin-left:0;
        }
        .card-information-name{
        margin-left:-2%;
        margin-top:auto;
        margin-bottom:auto;
        }
        .card-information-time{
        margin-left:-2%;
        margin-top:auto;
        margin-bottom:auto;
        }
        .card-content{
            max-height:100px;
            overflow:hidden;
        }
        .create-form{
            display:none;
        }
        .program-paginator{
            margin:10px 0 0 0;
        }
        .paginator{
            display:inline-block;
            margin:0 auto;
        }
    </style>
@stop