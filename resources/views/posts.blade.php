<x-layout>
    @include('_posts_header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count())
            <x-post-grid :post="$posts"/>
        @else
            <p>No Post Yet. Please Check Back</p>
         @endif
    </main>
</x-layout>

