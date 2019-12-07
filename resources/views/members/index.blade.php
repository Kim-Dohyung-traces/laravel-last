@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <div>
        <div class="page-header">
            <h2>조원소개</h2>
        </div>
        <label class="btn btn-primary btnCreate" onclick="create()">멤버 추가</label>
        <div class="createDiv" id="createDiv">
            <hr />
        </div>
    </div>
    <div class="contentDiv" id="contentDiv">
        @forelse ($members as $member)
            <div class="memberDiv" id="memberDiv{{$member->id}}">
                <div class="imgDiv">
                        <img src="http://127.0.0.1:8000/files2/{{$member->filename}}" alt="11"
                        onclick="imgClick({{$member->id}},'{{$member->name}}','{{$member->comments}}')"></img>
                </div>
                <div class="conDiv" id="conDiv{{$member->id}}"></div>
                <div class="btnDiv">
                    <label class="btn btn-primary btnEdit" onclick="edit({{$member->id}})">정보 수정</label>
                    <label class="btn btn-primary "onclick="del('{{$member->id}}')">멤버 삭제</label>
                </div>
                <div class="editDiv" id="editDiv{{$member->id}}">
                </div>  
            </div>
        @empty
        @endforelse
    </div>
@stop
@section('script')
    <script>
        var createCheck = 1; //create()함수 온오프 관리 
        var editCheck =1; //edit 함수 온오프 관리
        var check =999; // 조회 함수 온오프 관리
        var nameDiv = document.createElement("div");
        var commentsDiv = document.createElement("div");

        function imgClick(id,name,comments){
            console.log('imgClick!!!');
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type:"GET",
                url:'/members/'+id+'/edit',
                data: {'id': id, 'name' : name, 'comments':comments},
            }).then(function(data){
                console.log(data);
                var conDiv = document.getElementById("conDiv"+data.id);
                if(check==999){
                    nameDiv.id = "nameDiv"+data.id;
                    commentsDiv.id = "commentsDiv"+data.id;
                    nameDiv.innerHTML= data.name;
                    commentsDiv.innerHTML= data.comments;                   
                    conDiv.append(nameDiv);
                    conDiv.append(commentsDiv);
                    check= data.id;
                    console.log("이프문"+check);
                }
                else if(check==data.id){
                    nameDiv.innerHTML= '';
                    commentsDiv.innerHTML= '';
                    check=999;
                    console.log("이프엘스문"+check);
                }
                else{
                    nameDiv.id = "nameDiv"+data.id;
                    commentsDiv.id = "commentsDiv"+data.id;
                    nameDiv.innerHTML= data.name;
                    commentsDiv.innerHTML= data.comments;                   
                    conDiv.append(nameDiv);
                    conDiv.append(commentsDiv);
                    check= data.id;
                    console.log("엘스문"+check);
                }
            
            })
        };
        function del(id){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            if(confirm('멤버를 삭제합니다.')){
                console.log("이프문");
                $.ajax({
                    type:"DELETE",
                    url: '/members/' +id
                }).then(function(e){
                    console.log("덴");
                    window.location.href='/members';
                },function(e){
                    console.log(e);
                });
            }
        };

        function btnCre(){
            var contentDiv = document.getElementById('contentDiv');
            var form =$('#creForm')[0];
            var data = new FormData(form);
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                console.log("이프문");
                $.ajax({
                    type:"post",
                    enctype:"multipart/form-data",
                    data: data,
                    url: "/members",
                    processData: false,
                    contentType: false,
                    cache:false,
                    success:function(data){
                        console.log(data);
                        var createDiv = document.getElementById('createDiv');
                        createDiv.innerHTML = '';
                        createCheck=1;
                        var editDiv = document.createElement('div');
                        var memberDiv = document.createElement('div');
                        var imgDiv = document.createElement('div');
                        var conDiv = document.createElement('div');
                        var btnDiv = document.createElement('div');
                        var nameDiv = document.createElement('div');
                        var commentsDiv = document.createElement('div');
                        var img = document.createElement('img');
                        var btnEdit = document.createElement('label');
                        var btnDel =document.createElement('label');

                        editDiv.id = "editDiv"+data.id;
                        editDiv.className = "editDiv";

                        nameDiv.id= "nameDiv"+data.id;
                        commentsDiv.id = "comments"+data.id;

                        img.src="http://127.0.0.1:8000/files2/"+data.filename;
                        img.alt= "사진 안보여";
                        $(img).on('click',function(){
                            imgClick(data.id,data.name,data.comments);
                        });

                        btnEdit.innerHTML="정보 수정";
                        $(btnEdit).on('click',function(){                            
                            edit(data.id);
                        });
                        btnDel.innerHTML="멤버 삭제";
                        $(btnDel).on('click',function(){
                            del(data.id);
                        });

                        memberDiv.id = 'memberDiv'+data.id;
                        memberDiv.className = "memberDiv";
                        imgDiv.className = "imgDiv";
                        conDiv.id = "conDiv"+data.id;
                        conDiv.className = "conDiv";
                        btnDiv.className = "btnDiv";
                        btnEdit.className = "btn btn-primary";
                        btnDel.className = "btn btn-primary";

                        contentDiv.appendChild(memberDiv);
                        memberDiv.appendChild(imgDiv);
                        memberDiv.appendChild(conDiv);
                        conDiv.appendChild(nameDiv);
                        conDiv.appendChild(commentsDiv);
                        memberDiv.appendChild(btnDiv);
                        memberDiv.appendChild(editDiv);

                        imgDiv.appendChild(img);

                        btnDiv.appendChild(btnEdit);
                        btnDiv.appendChild(btnDel);
                    }
                    ,
                    error:function(e){
                        console.log(e);
                    alert("정보를 전부 기입해 주세요.");
                    }
                });
        }
        function btnEdit(id){
            console.log('btnEdit 실행!');
            var editDiv = document.getElementById('editDiv'+id);
            var form  = $('#editForm'+id)[0];
            var data = new FormData(form);
            console.log(form);
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                    type:"post",
                    url: '/members/' +id+'/update',
                    data: data,
                    processData:false,
                    contentType:false,
                }).then(function(data){
                    var nameDiv = document.getElementById('nameDiv'+data.id);
                    var commentsDiv = document.getElementById('commentsDiv'+data.id);
                    console.log("수정 성공");
                    console.log(data);
                    // nameDiv.innerHTML= data.name;
                    // commentsDiv.innerHTML= data.comments;
                    editDiv.innerHTML = '';
                    editCheck=1;
                },function(e){
                    console.log("수정실패");
                    console.log(e);
                });
        };


        function create(){
                var createDiv = document.getElementById('createDiv');
                var creForm = document.createElement('form');
                var nameLabel = document.createElement('label');
                var nameInput = document.createElement('input');
                var commentsLabel = document.createElement('label');
                var commentsTextarea = document.createElement('textarea');
                var fileLabel = document.createElement('label');
                var fileInput = document.createElement('input');
                var creLabel = document.createElement('label');

                var nameDiv = document.createElement('div');
                var commentsDiv=document.createElement('div');
                var fileDiv =document.createElement('div');
                nameDiv.className = "form-group";
                commentsDiv.className = "form-group";
                fileDiv.className = "form-group";

                creForm.id = "creForm";
                creForm.enctype = "multipart/form-data";

                nameLabel.innerHTML = "이름";
                nameInput.type ="text";
                nameInput.name = "name";

                commentsLabel.innerHTML="한마디";
                commentsTextarea.name ='comments';
                commentsTextarea.className = "form-control";
                
                fileLabel.innerHTML = "파일";
                fileInput.type = "file";
                fileInput.name = "file";

                creLabel.innerHTML = "저장 하기";
                $(creLabel).on('click',function(){
                    btnCre();
                })
                creLabel.className="btn btn-primary";

                if(createCheck == 1){
                    createDiv.appendChild(creForm);
                    creForm.appendChild(nameDiv);
                    creForm.appendChild(commentsDiv);
                    creForm.appendChild(fileDiv);
                    nameDiv.appendChild(nameLabel);
                    nameDiv.appendChild(nameInput);
                    commentsDiv.appendChild(commentsLabel);
                    commentsDiv.appendChild(commentsTextarea);
                    fileDiv.appendChild(fileLabel);
                    fileDiv.appendChild(fileInput);
                    creForm.appendChild(creLabel);
                    createCheck=0;
                }
                else if(createCheck == 0){
                    console.log("작동");
                    createDiv.innerHTML='';
                    createCheck=1;
                }         
        }

        function edit(id){
            var memberDiv = document.getElementById('memberDiv'+id);
            var editDiv = document.getElementById('editDiv'+id);
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type:"GET",
                url:'/members/'+id+'/edit',
                data: {'id': id},
            }).then(function(data){
                var editForm = document.createElement('form');
                var nameLabel = document.createElement('label');
                var nameInput = document.createElement('input');
                var commentsLabel = document.createElement('label');
                var commentsTextarea = document.createElement('textarea');
                var editLabel = document.createElement('label');

         
                editForm.id = "editForm"+data.id;
                editForm.method = "POST";

                nameLabel.innerHTML = "이름";
                nameInput.type = "text";
                nameInput.id="name2";
                nameInput.name="name2";
                nameInput.value = data.name;
                nameInput.className = "form-control"

                commentsLabel.innerHTML = "한마디";
                commentsTextarea.type = "textarea";
                commentsTextarea.id="comments2";
                commentsTextarea.name="comments2";
                commentsTextarea.value = data.comments;
                commentsTextarea.className = "form-control"

                editLabel.className = "btn btn-primary";
                editLabel.innerHTML = "수정하기";
                $(editLabel).on("click",function(){
                    btnEdit(data.id);
                })

                if(editCheck == 1){
                    console.log("이프문");
                    editDiv.appendChild(editForm);
                    editForm.appendChild(nameLabel);
                    editForm.appendChild(nameInput);
                    editForm.appendChild(commentsLabel);
                    editForm.appendChild(commentsTextarea);
                    editForm.appendChild(editLabel);
                    editCheck=0;
                                  }
                else if(editCheck == 0){
                    console.log("엘스문");
                    editDiv.innerHTML = '';
                    editCheck=1;
                                       }
            })
        
        }
      
    </script>
@stop
@section('style')
        <style>
            .memberDiv{
                display:inline-block;

            }

            .conDiv,.btnDiv{
                width:230px;
            }

            .btn-info{
                margin-left:70px;
            }
            img{
                width:230px;
                height:300px;
            }
        </style>
@stop
