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

<div class="mb-4 text-xl font-bold text-center">
    Terimakasih sudah mendaftar
</div>
<div class="mb-4 text-md text-gray-600">
    {{ __('Silahkan cek email anda untuk verifikasi') }}
</div>

@if (session('status') == 'verification-link-sent')
<div class="mb-4 font-medium text-sm text-green-600">
    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang anda gunakan saat pendaftaran.') }}
</div>
@endif

<div class="mt-4 flex items-center justify-between">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <div>
            <x-button>
                {{ __('Kirim Ulang Verifikasi Email') }}
            </x-button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
            {{ __('Log Out') }}
        </button>
    </form>
</div>
</x-auth-card>
</x-guest-layout>
