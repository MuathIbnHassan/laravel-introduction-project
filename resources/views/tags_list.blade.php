Tags: 
@forelse ($tags as $tag)
   <a href="/tags/{{ $tag }}" class="badge badge-secondary">{{ $tag  }}</a>
@empty
    There is no Tags!
@endforelse