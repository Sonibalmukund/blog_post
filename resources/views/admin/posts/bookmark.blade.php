<x-layout>
    <x-setting heading="Show Bookmark">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($Bookmark as $Bookmarks)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <img src="{{asset('storage/'.$Bookmarks->thumbnail)}}" alt="" class="rounded-xl ml-6" width="80">

                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">

                                                <a href="/posts/{{ $Bookmarks->slug }}">
                                                    {{ $Bookmarks->title }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="/?authors=/{{$Bookmarks->author->user_name}}">
                                                    {{$Bookmarks->author->name}}
                                                </a>
                                            </div>
                                        </div>
                                    </td>

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
