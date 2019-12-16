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
        @if($programs->count()>3)
            <div class="carousel-divbox">
                <div class="carousel-div">
                    @include('programs.carousel', compact('program')) 
                </div>
            </div>
        @endif
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
        <div class="edit-div">
            @forelse ($programs as $program)
                @include('programs.edit',compact('program'))
            @empty
            @endforelse
        </div>
        <div class="show-divbox">
            <div class="show-div">
                @forelse ($programs as $program)
                    @include('programs.show', compact('program'))
                @empty
                @endforelse
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $('#carousel-example-generic').carousel();
        $('.carousel').carousel({interval: 2000});

        function create(){
            console.log('create form 호출');
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type:'GET',
                url: '/programs/'+'create',
                data: {},
                error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
            }).then(function(){    
                $('.program-div').css("display","none");
                $('.create-form').css("display","block");
                $('.page-header').css("display","none");
                $('.carousel-div').css("display","none");
                $(".form-control").val("");
            });
            if(!'{{auth()->user()}}'){
                alert("로그인 한 유저만 글 작성이 가능합니다");
                return;
            }
        }

        function back(){
            $('.program-div').css("display","block");
            $('.create-form').css("display","none");
            $('.page-header').css("display","block");
            $('.carousel-div').css("display","block");
            $(`.showbox`).css("display","none");
            $(`.edit-form`).css("display","none");
        }   

        function show(program_id){
            console.log('show-form 호출');
            $.ajax({
                type:'GET',
                url: `/programs/${program_id}`,
                data: program_id,
                error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
            }).then(function(e){  
                $('.program-div').css("display","none");
                $('.create-form').css("display","none");
                $('.page-header').css("display","none");
                $('.carousel-div').css("display","none");
                $(`.showbox`).css("display","none");
                // $(`.show-form${program_id}`).css("display","none");
                $(`.show-form${program_id}`).css("display","block");
            });
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
            }).then(function(){    
                $('.program-div').load('/programs .program-div').css("display","block");
                $('.create-form').css("display","none");
                $('.page-header').css("display","block");
                $(`.show-divbox`).load('/programs .show-div');
                $('.carousel-divbox').load('/programs .carousel-div').css("display","block");
            });
        }

        function dorp(program_id){
            if(confirm('글을 삭제합니다.')){
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: "DELETE",
                    url: `/programs/${program_id}`,
                    data: program_id,
                    error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
                }).then(function(program){  
                    console.log(program); 
                    $('.program-div').load('/programs .program-div').css("display","block");
                    $('.create-form').css("display","none");
                    $('.page-header').css("display","block");
                    $(`.show-divbox`).load('/programs .show-div');
                    $('.carousel-divbox').load('/programs .carousel-div').css("display","block");
                });
            }
        }
        function edit(program_id){
            $.ajax({
                type: "get",
                url: `/programs/${program_id}/edit`,
                data: program_id,
                error:function(request,status,error){
                alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
            }).then(function(program){  
                console.log(program); 
                $('.program-div').load('/programs .program-div').css("display","none");
                $(`.edit-form`).css("display","none");
                $(`.edit${program_id}`).css("display","block");
                $('.page-header').css("display","none");
                $(`.show-divbox`).load('/programs .show-div');
                $('.carousel-divbox').load('/programs .carousel-div').css("display","none");
                
            });
        }
        function update(program_id){
            var form = $('#program_edit_form')[0];
            var data = new FormData(form);
            console.log(form);
            data.append('_method','PUT');
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type:'POST',
                url: `/programs/${program_id}`,
                data: data,
                processData:false,
                contentType:false,
            }).then(function(){    
                $('.program-div').load('/programs .program-div').css("display","block");
                $('.create-form').css("display","none");
                $('.page-header').css("display","block");
                $(`.show-divbox`).load('/programs .show-div');
                $(`.edit-form`).css("display","none");
                $('.carousel-divbox').load('/programs .carousel-div').css("display","block");
            });
        }
    </script>
@stop