@props(['comment'])
<x-pannel class="bg-gray-50 ">
<article class="flex  space-x-4">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/60?u={{$comment->user_id}}" alt="" srcset="" height="60" width="60" class="rounded-xl">
    </div>
    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{$comment->author->user_name}}</h3>
            <p class="text-xs">
                Posted
                <time>{{$comment->created_at->format('F j,Y, g:i:a')}}</time>
            </p>
        </header>
        <p>
            {{$comment->body}}
        </p>
    </div>
</article>
</x-pannel>
