<x-layout>
    <x-setting heading="Manage Posts">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <img src="{{asset('storage/'.$post->thumbnail)}}" alt="" class="rounded-xl ml-6" width="80">

                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="/posts/{{ $post->slug }}">
                                                    {{ $post->title }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if (auth()->user()->can('admin') || $post->status == 1)
                                            <a href="{{ url('admin/posts/status/' . ($post->status == 1 ? 0 : 1), $post->id) }}" class="border border-gray-200 p-2 w-full text-sm rounded-xl" style="font-family:Bodoni MT Poster Compressed; color: {{ $post->status == 1 ? 'blue' : 'red' }}">
                                                {{ $post->status == 1 ? 'Published' : 'Draft' }}
                                            </a>
                                        @else
                                            <span class="border border-gray-200 p-2 w-full text-sm rounded-xl" style="font-family:Bodoni MT Poster Compressed; color: {{ $post->status == 1 ? 'blue' : 'red' }}">
                                                {{ $post->status == 1 ? 'Published' : 'Draft' }}
                                            </span>
                                        @endif
                                    </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="/admin/posts/{{ $post->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                        </td>
                                    @can('admin')

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/posts/{{ $post->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-xs text-gray-400">Delete</button>
                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-setting>
</x-layout>
