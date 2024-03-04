
<x-layout>
    <x-setting :heading="'Edit Post:'.$post->title">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="title" :value="old('title',$post->title)"/>
            <x-form.input name="slug" :value="old('slug',$post->slug)"/>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail',$post->thumbnail)"/>
                </div>
                    <img src="{{asset('storage/'.$post->thumbnail)}}" alt="" class="rounded-xl ml-6" width="100">
            </div>
            <x-form.textarea name="expert">{{old('expert',$post->expert)}}</x-form.textarea>
            <x-form.textarea name="body" >{{ old('body', $post->body) }}</x-form.textarea>
            <x-form.field>
                <x-form.lable name="category"/>
                <select name="category_id" id="category_id" >
                    @php
                        $categories=\App\Models\Category::all();
                    @endphp
                    @foreach($categories as $category)
                        @if($category->status==1)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ ucwords($category->name) }}
                            </option>
                        @endif
                    @endforeach
                </select>
                <x-form.error name="category"/>
            </x-form.field>
            <x-form.field>
                <x-form.lable name="Author"/>
                <select name="user_id" id="user_id" >
                    @php
                        $users=\App\Models\User::all();
                    @endphp
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ ucwords($user->name) }}
                        </option>
                    @endforeach
                </select>
                <x-form.error name="user_id"/>
            </x-form.field>
            <x-button>Update</x-button>
        </form>

    </x-setting>
</x-layout>
