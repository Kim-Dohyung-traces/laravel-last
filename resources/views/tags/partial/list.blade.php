@if ($tags->count())
  <ul class="tags__article">
    <li>
      <i class="fa fa-tags"></i>
    </li>
    @foreach ($tags as $tag)
      <li>
        <label>{{ $tag->name }}</label>
      </li>
    @endforeach
  </ul>
@endif