<x-layout>
    <x-setting heading="New Category">
        <form method="post" action="/admin/category">
            @csrf
            <x-form.input name="name"/>
            <x-form.input name="slug"/>
            <x-button>Submit</x-button>
        </form>
    </x-setting>
</x-layout>
