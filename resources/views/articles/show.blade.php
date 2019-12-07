@extends('layouts.app')

@section('content')
@php $viewName = 'articles.show'; @endphp
<div class="page-header">
    <h4>
        <a href="{{ route('articles.index') }}">
            게시글
        </a>
        <small>
            / {{ $article->id }}번째 게시글
        </small>
    </h4>
</div>


<div class ="row container__article">
    <div class="col-md-3 sidebar__article">
      <aside>
        @include('tags.partial.index')
      </aside>
    </div>

    <div class="col-md-9 list__article">
        <article class ="article_show" data-id="{{ $article->id }}">
            @include('articles.partial.article', compact('article'))
            <div>
                <p>{!! $article->content !!}</p>
            </div>
        </article>

        <div class="text-center action__article">
            @can('update', $article)
            <button class="btn btn-info button__edit__articles">
                <i class="fa fa-pencil"></i>
                글 수정
            @endcan
        
            @can('delete', $article)
            <button class="btn btn-danger button__delete__articles">
                <i class="fa fa-trash-o"></i>
                글 삭제
            </button>
            @endcan
            <button class="btn btn-default button__list__articles">
                <i class="fa fa-list"></i>
                글 목록
            </button>
        </div>

        <div class="container__comment">
            @include('comments.index')
        </div>
    </div>
</div>
@stop

@section('script')
<script>
//글 목록 버튼

// $(document).on('click', '.button__list__articles', function(e) {
//     $.ajax({
//         type: "GET",
//         url: '/articles'
//     }).then(function() {
//         $('#main_container').load(`/articles #main_container`);
//     });
// });

// //게시글 수정 버튼
// $(document).on('click', '.button__edit__articles', function(e) {
//     var articleId = $('article').data('id');
//     $.ajax({
//         type: "GET",
//         url: `/articles/${articleId}edit`
//     }).then(function() {
//         $('#main_container').load(`/articles/${articleId}/edit #main_container`);
//     });
// });

// //게시글 삭제 버튼
// $(document).on('click', '.button__delete__articles', function(e) {

//     var articleId = $('article').data('id');
//     if (confirm('글을 삭제합니다.')) { //글을 삭제합니다 경고창에서 yes를누르면 true
//         $.ajax({
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},  
//             type: "DELETE",
//             url: '/articles/' + articleId
//         }).then(function() {
//             $('#main_container').load(`/articles #main_container`);
//         });
//     }
// });

// //선택한 태그인 게시글만 보여줌
// $(document).on('click', '.btn__tag__article', function(e) {
//     var tag = $(this).closest('.btn__tag__article').data('id');
//     console.log(tag);
//     $.ajax({
//         type: 'GET',
//         url: `/tags/${tag}/articles`,
//     }).then(function (data){
//         $('.container__article').load(`/tags/${tag}/articles .container__article`);
//     });
// });
//댓글 수정
$(document).on('click', '.btn__update__comment', function(e) {
    var parent_id =  $(this).closest('.item__comment').data('id');  //대댓글이면 부모 댓글id, 아니면 null
    var content = $(`#edit_comment${parent_id}`).val();
    
    console.log("댓글 : ", content);
    console.log(parent_id);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},  
        type: 'PUT',
        url: '/comments/' + parent_id,
        data : {
            'content' : content,
            'commentable_id' : article_id,
        }
    }).then(function (){
        $(`.media${article_id}`).load(`/articles/${article_id} .container__comment`);
    });
});
</script>
@stop
