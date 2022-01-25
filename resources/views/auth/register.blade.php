<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
             <div class="font-title text-primary text-center">
              <div class="inline-block">
                <span class="uppercase text-5xl font-bold">perpus</span>
                <span class="uppercase text-5xl font-bold text-error">mulia</span>
                <div class="text-2xl uppercase">perpustakaan online universitas mulia</div>
            </div>
        </div>
    </a>
</x-slot>

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <x-label for="name" :value="__('Username')" />

        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-label for="email" :value="__('Email')" />

        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-label for="password" :value="__('Password')" />

        <x-input id="password" class="block mt-1 w-full"
        type="password"
        name="password"
        required autocomplete="new-password" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-input id="password_confirmation" class="block mt-1 w-full"
        type="password"
        name="password_confirmation" required />
    </div>

    <div class="flex items-center justify-center my-4">
       
        {{-- <x-button class="ml-4">
            {{ __('Daftar') }}
        </x-button> --}}
        <button type="submit" class="btn btn-block btn-primary">Daftar</button>
    </div>
    <div class="flex items-center justify-center">
        <a href="{{route('landing.index')}}" class="btn btn-error btn-block"><i data-feather="arrow-left" class="mr-2"></i> Halaman Utama</a>
        
    </div>
     <div class="flex py-4">
            {{ __('Sudah punya akun?') }}
         <a class="underline text-gray-600 hover:text-gray-900 ml-2" href="{{ route('login') }}">
            Masuk
        </a>
     </div>
</form>
</x-auth-card>
</x-guest-layout>
