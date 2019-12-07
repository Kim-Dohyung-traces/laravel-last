<div class="page-header">
  <h4>댓글</h4>
</div>

<div class="form__new__comment">
    @include('comments.partial.create')
</div>
<!-- 댓글 리스트를 출력 -->
<div id = "list__comments" class="list__comment">
  @forelse($comments as $comment)
    @include('comments.partial.comment', [
      'parentId' => $comment->id,
      'isReply' => false,
    ])
  @empty
  @endforelse
</div>