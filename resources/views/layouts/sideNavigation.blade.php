<aside class="flex flex-col justify-between border-r border-base-400 bg-base-100 text-base-content w-80 overflow-hidden">
    <div
        class="sticky inset-x-0 top-0 z-50 hidden w-full py-1 transition duration-200 ease-in-out border-b lg:block border-base-200 bg-base-100">
        <div class="mx-auto flex">
            <div class="flex items-center flex-none">
                <a href="/" aria-label="Homepage" class="px-2 flex-0 btn btn-ghost md:px-4 nuxt-link-active">
                    <span class="text-lg font-bold">
                        <div class="inline-block text-3xl font-title text-primary">
                            <span class="uppercase">perpus</span><span class="uppercase text-error">mulia</span>
                        </div>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="overflow-y-auto h-screen mb-4">
        <ul class="menu flex flex-col p-4 pt-2 compact">
            <li class="mt-4 menu-title">
                <span>Menu</span>
            </li>
            <li class="mb-2 {{ Request::is('dashboard') ? 'bg-red-400 rounded-lg' : '' }}">
                <a href="{{ route('dashboard') }}" class="capitalize">
                    <i data-feather="grid" class="mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="w-90 {{ Request::is('dashboard/profile*') ? 'bg-red-400 rounded-lg' : '' }}">
                <a href="{{ route('profile.index') }}" class="capitalize">
                    <i data-feather="user" class="mr-2"></i>
                    profile
                </a>
            </li>
            @if (Auth::user()->level != 'member')
                <li
                    {{ Request::is(['dashboard/user*, dashboard/petugas*, dashboard/member*']) ? 'bg-red-400 rounded-lg' : '' }}>
                    <div class="collapse w-90 rounded-box collapse-arrow">
                        <input type="checkbox">
                        <div class="collapse-title">
                            <i data-feather="users" class="ml-1 mr-2 inline-block"></i>Users
                        </div>
                        <div class="collapse-content">
                            <ul>
                                @if (Auth::user()->level == 'admin')
                                    <li class="{{ Request::is('dashboard/user*') ? 'bg-red-400 rounded-lg' : '' }}"><a
                                            href="{{ route('user.index') }}"><i data-feather="users"
                                                class="mr-2"></i>User List</a></li>
                                @endif
                                <li class="{{ Request::is('dashboard/petugas*') ? 'bg-red-400 rounded-lg' : '' }}"><a
                                        href="{{ route('petugas.index') }}"><i data-feather="user"
                                            class="mr-2"></i>Petugas</a></li>
                                <li class="Request::is('dashboard/member*') ? 'bg-red-400 rounded-lg' : '' }}"><a
                                        href="{{ route('member.index') }}"><i data-feather="user"
                                            class="mr-2"></i>Member</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif
            @if (Auth::user()->level != 'member')
            <li
                    {{ Request::is(['dashboard/user*, dashboard/petugas*, dashboard/member*']) ? 'bg-red-400 rounded-lg' : '' }}>
                    <div class="collapse w-90 rounded-box collapse-arrow">
                        <input type="checkbox">
                        <div class="collapse-title">
                            <i data-feather="book" class="ml-1 mr-2 inline-block"></i>Buku
                        </div>
                        <div class="collapse-content">
                            <ul>
                                    <li class="{{ Request::is('dashboard/buku*') ? 'bg-red-400 rounded-lg' : '' }}"><a
                                            href="{{ route('buku.index') }}"><i data-feather="book"
                                                class="mr-2"></i>Buku</a></li>
                                <li class="{{ Request::is('dashboard/kategori*') ? 'bg-red-400 rounded-lg' : '' }}"><a
                                        href="{{ route('kategori.index') }}"><i data-feather="archive"
                                            class="mr-2"></i>Kategori</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif
            
            @if (Auth::user()->level == 'member')
                @if (Auth::user()->member->nim != '')
                    <li class="{{ Request::is('dashboard/transaksi*') ? 'bg-red-400 rounded-lg' : '' }}">
                        <a href="{{ route('transaksi.index') }}" class="capitalize">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                            Transaksi
                        </a>
                    </li>
                @endif
            @else
                <li class="{{ Request::is('dashboard/transaksi*') ? 'bg-red-400 rounded-lg' : '' }}">
                    <a href="{{ route('transaksi.index') }}" class="capitalize">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        Transaksi
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
