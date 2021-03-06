<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-content leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- alert user login --}}
    <div class="w-full pb-4">
        <div class="alert alert-info">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                    class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <Label>Selamat datang <span class="text-error capitalize">{{ auth()->user()->name }}</span></Label>
            </div>
        </div>
    </div>
    @if (Auth::user()->level == 'member' && auth::user()->member->nim == '')
        <div class="hero min-h-screen bg-base-200">
            <div class="text-center hero-content">
                <div class="max-w-md">
                    <h1 class="mb-5 text-3xl font-bold">
                        Halo, Selamat Datang
                    </h1>
                    <p class="mb-5">
                        Silahkan lengkapi profile anda untuk bisa melakukan peminjaman buku
                    </p>
                    <a href="{{ route('profile.index') }}" class="btn btn-primary text-white">Lengkapi
                        Profile</a>
                </div>
            </div>
        </div>
    @else
      @include('components.notif')
        {{-- card --}}

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-3 ">
            @if (Auth::user()->level != 'member')
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div><span class="font-semibold text-gray-500">Buku </span><br> <span
                                    class="text-xl font-semibold">{{ $countBuku }}</span></div>
                            <div class="flex justify-end">
                                <button class="btn btn-primary btn-md btn-circle">
                                    <i data-feather="book" color="white"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-sm mt-4">
                            @if ($hasilAkhirBuku < 0)
                                <span class="text-sm text-error mr-2">
                                    <i data-feather="arrow-down" class="inline-block"></i>
                                    {{ substr($hasilAkhirBuku, 0, 4) }} % Bulan Lalu
                                </span>
                            @elseif($hasilAkhirBuku > 0)
                                <span class="text-sm text-green-500 mr-2">
                                    <i data-feather="arrow-up" class="inline-block"></i>
                                    {{ substr($hasilAkhirBuku, 0, 4) }} % Bulan Lalu
                                </span>
                            @else
                                <span class="text-sm text-green-500 mr-2">
                                    <i data-feather="minus" class="inline-block"></i>
                                    0 % Bulan Lalu
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div><span class="font-semibold text-gray-500">Transaksi </span><br> <span
                                    class="text-xl font-semibold">{{ $countTransaksi }}</span></div>
                            <div class="flex justify-end">
                                <button class="btn btn-error btn-md btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="white">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="text-sm mt-4">
                            @if ($hasilAkhirTransaksi < 0)
                                <span class="text-sm text-error mr-2">
                                    <i data-feather="arrow-down" class="inline-block"></i>
                                    {{ substr($hasil_akhir_transaAkhirTransaksiksi, 0, 4) }} % Bulan Lalu
                                </span>
                            @elseif($hasilAkhirTransaksi > 0)
                                <span class="text-sm text-green-500 mr-2">
                                    <i data-feather="arrow-up" class="inline-block"></i>
                                    {{ substr($hasilAkhirTransaksi, 0, 4) }} % Bulan Lalu
                                </span>
                            @else
                                <span class="text-sm text-green-500 mr-2">
                                    <i data-feather="minus" class="inline-block"></i>
                                    0 % Bulan Lalu
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div><span class="font-semibold text-gray-500">Users </span><br> <span
                                    class="text-xl font-semibold">{{ $countUser }}</span></div>
                            <div class="flex justify-end">
                                <button class="btn btn-warning btn-md btn-circle">
                                    <i data-feather="users" color="white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div><span class="font-semibold text-gray-500">Petugas </span><br> <span
                                    class="text-xl font-semibold">{{ $countPetugas }}</span></div>

                            <div class="flex justify-end">
                                <button class="btn btn-md btn-info btn-circle">
                                    <i data-feather="user"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div><span class="font-semibold text-gray-500">Member </span><br> <span
                                    class="text-xl font-semibold">{{ $countMember }}</span></div>
                            <div class="flex justify-end">
                                <button class="btn btn-success btn-md btn-circle">
                                    <i data-feather="user" color="white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="flex justify-between">
                            <div><span class="font-semibold text-gray-500">Peminjaman </span><br> <span
                                    class="text-xl font-semibold">{{ $transakiAuthMember->count() }}</span></div>
                            <div class="flex justify-end">
                                <button class="btn btn-error btn-md btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="white">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
</x-app-layout>
