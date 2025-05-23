<x-layout>

    <x-setting heading="Publish New Post">
        <form action="/admin/posts" method="post" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title"/>
            <x-form.input name="slug"/>
            <x-form.input name="thumbnail" type="file"/>
            <x-form.textarea name="expert" :isTextEditor="true"/>
            <x-form.textarea name="body"/>
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
            <x-button>Publish</x-button>
        </form>

    </x-setting>
</x-layout>
