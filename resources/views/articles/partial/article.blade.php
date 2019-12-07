<!-- 게시판 제목, 작성자, 날짜 등을 보여줌 -->
<div class="media{{$article->id}}">
    @include('users.partial.avatar', ['user' => $article->user])
    <div class="media-body">
        <h4 class="meida-heading">
            <button class="btn__show__article btn btn-info" data-id = "{{$article->id}}">
                {{$article->title}}
        </h4>

        <p class="text-muted">
            <i class="fa fa-user"></i> {{ $article->user->name}} ({{$article->user->email}})
            <i class="text-right">
                <i class="fa fa-clock-o"></i> {{$article->created_at->format('Y-m-d')}}
            </i>
        </p>
        @if($viewName === 'articles.index')
        @include('tags.partial.list',['tags' => $article->tags])
        @endif

        @if($viewName === 'articles.show')
        @include('attachments.partial.list', ['attachments' => $article->attachments])
        @endif
    </div>
</div>