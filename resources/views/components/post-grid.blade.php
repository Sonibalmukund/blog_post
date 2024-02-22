@props(['post'])


<x-post-fetured-card :post="$post[0]"/>
@if($post->count() > 1)
    <div class="lg:grid lg:grid-cols-6">
        @foreach($post->skip(1) as $posts)
            <x-post-card
                :post="$posts"
                class="{{$loop->iteration<3?'col-span-3':'col-span-2'}}"
            />
        @endforeach
    </div>
@endif
