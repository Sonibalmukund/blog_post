<x-dropdown>

    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-32 text-left">
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>

            {{isset($currentCategory)?ucwords($currentCategory->name):'Categories'}}
        </button>
    </x-slot>
    <x-dorpodown-iteam href="/?{{http_build_query(request()->except('$category','page'))}}"
                       :active="request()->routeIs('home')">
        All
    </x-dorpodown-iteam>

    @foreach($categories as $category)
        <x-dorpodown-iteam
            href="/?category={{$category->slug}}&&{{http_build_query(request()->except('$category','page'))}}"
            :active='request()->is("categories/{$category->slug}")'
        >
            {{ucwords($category->name)}}
        </x-dorpodown-iteam>
    @endforeach
</x-dropdown>
