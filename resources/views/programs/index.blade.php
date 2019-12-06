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
        </div>
        <hr>

        <div class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="img\about-bg.jpg" alt="carousel-img" style="max-width: 100%">
                    <div class="carousel-caption">
                        <h1 style="font-size: 10em">test1</h1>
                    </div>
                </div>
                <!-- <div class="item">
                    <img src="img\about-bg.jpg" alt="carousel-img" style="max-width: 100%">
                    <div class="carousel-caption">
                        <h1 style="font-size: 10em">test2</h1>
                    </div>
                </div> -->
            </div>
        </div> 
        <div class="program-div">
  
                <div class="card" onclick="show()">
                    <div class="card-imgbox col-md-4">
                        <img class="cardimg" src="img\about-bg.jpg" alt="program-img">
                    </div>
                    <div class="card-body col-md-8">
                        <h1 class="card-title">test</h1>
                        <div class="card-information">
                            <p class="card-information-name col-md-6">작성자 : 김도형</p>
                            <p class="card-information-time col-md-6">작성시간 : 2019.12.06</p>
                        </div>
                        <p>12345678</p>
                    </div>
                </div>

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
                url: 'ajaxtests/'+'create',
                data: {
                mydata: "mydata",
                },
                success: function(data){
                console.log(data);
                }
            });
        }
        function show(){

        }
    </script>
@stop
@section("style")
    <style>
        .program-title{
        display: inline-block;
        margin: 5px !important;
        }
        .program-button{
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
    </style>
@stop