@props(['heading'])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{$heading}}
    </h1>
    <div class="flex">
        <aside class="w-48">
            <h4 class="font-semibold mb-4">Links</h4>
            <ul>
                <li>
                <a href="{{route('admin.posts')}}" class="{{request()->is('admin/posts') ? 'text-blue-500' :''}}">All Posts</a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.create') }}"
                       class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : '' }}">New Post</a>
                </li>
                <li>
                    <a href="{{route('admin.posts.bookmark')}}"
                       class="{{ request()->routeIs('admin.posts.bookmark') ? 'text-blue-500' : '' }}">Bookmark</a>
                </li>
                <li>
                    <a href="{{ route('admin.category.index') }}" class="{{ request()->is('admin/category*') ? 'text-blue-500' : '' }}">Category</a>
                </li>

                <li>
                    <a href="{{route('admin.category.create')}}" class="{{request()->is('admin/category/create') ? 'text-blue-500' :''}}">New Category</a>
                </li>
            </ul>
        </aside>
        <main class="flex-1">
            <x-pannel>
                {{$slot}}
            </x-pannel>
        </main>
    </div>
</section>
