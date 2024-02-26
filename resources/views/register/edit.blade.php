<x-layout>
    <x-setting :heading="'Edit Profile'">
        <form method="POST" action="/admin/user/{{ $user->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="name" :value="old('name',$user->name)"/>
            <x-form.input name="user_name" :value="old('user_name',$user->user_name)"/>
            <x-form.input name="email" type="email" autocomplete="user_name" :value="old('email',$user->email)"/>
            <x-form.input name="password" type="password" autocomplete="new-password"/>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="avatar" type="file" :value="old('avatar',$user->avatar)"/>
                </div>
                <img src="{{asset('storage/'.$user->avatar)}}" alt="" class="rounded-xl ml-6" width="100">
            </div>
            <x-button>Update</x-button>
        </form>

    </x-setting>

</x-layout>
