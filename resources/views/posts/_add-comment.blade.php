@auth
    <x-pannel>
        <form action="/posts/{{$post->slug}}/comments" method="post">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{auth()->id()}}" alt="" srcset="" height="40" width="40" class="rounded-full">

                <h2 class="ml-3">Want to participate?</h2>
            </header>
            <div class="mt-8">
                <textarea
                   name="body" id=""
                   class="w-full text-sm focus:outline-none focus:ring"
                   cols="30" rows="5"
                   placeholder="Quick, thing of something to say!"
                   required>
                </textarea>
                @error('body')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200 pt-6">
                <x-button>Post</x-button>
            </div>
        </form>
    </x-pannel>
@else
    <p>
        <a href="/register" class="hover:underline">Register</a> or
        <a href="/login" class="hover:underline">Log in </a> to leave comment..
    </p>
@endauth
