<x-layout>
    <x-setting heading="New Category">
        <form method="post" action="/admin/category/{{$category->id}}">
            @csrf
            @method('PATCH')
            <x-form.input name="name" :value="old('slug',$category->name)"/>
            <x-form.input name="slug" :value="old('slug',$category->slug)"/>
            <x-button>Update</x-button>
        </form>
    </x-setting>
</x-layout>
