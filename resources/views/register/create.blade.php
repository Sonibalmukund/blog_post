<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg m-auto mt-10">
            <x-pannel>
                <h1 class="text-center font-bold text-xl">Register!</h1>

                <form method="post" action="/register" class="mt-10">

                @csrf
                    <x-form.input name="name"  autocomplete="user_name"/>
                    <x-form.input name="user_name"  autocomplete="new-password"/>
                    <x-form.input name="email" type="email" autocomplete="user_name"/>
                    <x-form.input name="password" type="password" autocomplete="new-password"/>
                    <x-button>Submit</x-button>
                </form>
            </x-pannel>
        </main>
    </section>
</x-layout>


