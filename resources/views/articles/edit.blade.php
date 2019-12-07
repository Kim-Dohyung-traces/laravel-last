@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4>
        <a href="{{ route('articles.index') }}">
            포럼
        </a>
        <small>
            / 글 수정
            / {{ $article->title }}
        </small>
    </h4>
</div>


    <form action ='', id = "article_edit_form" method="PUT" enctype="multipart/form-data" class="form__article">
        <hr />
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        @include('articles.partial.form')
    </form>

    <div class="form-group text-center">
        <button class="button__update__articles btn btn-primary">
            수정하기
        </button>
    </div>
@stop
