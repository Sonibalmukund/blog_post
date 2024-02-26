@props(['heading'])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{$heading}}
    </h1>
    <div class="flex">
        <aside class="w-48">
            <h4 class="font-semibold mb-4">Links</h4>
            <ul>
                @can('admin')
                <li>
                <a href="{{route('admin.posts')}}" class="{{request()->is('admin/posts') ? 'text-blue-500' :''}}">All Posts</a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.create') }}"
                       class="{{ request()->is('admin/posts/create*') ? 'text-blue-500' : '' }}">New Post</a>
                </li>
                @endcan
                <li>
                    <a href="{{ route('admin.user.edit', ['user' => auth()->user()->id]) }}"
                       class="{{ request()->routeIs('admin.user.edit') ? 'text-blue-500' : '' }}">Profile</a>
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
