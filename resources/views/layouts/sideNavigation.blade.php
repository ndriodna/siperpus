<aside class="flex flex-col justify-between border-r border-base-400 bg-base-100 text-base-content w-80 overflow-hidden">
	<div class="sticky inset-x-0 top-0 z-50 hidden w-full py-1 transition duration-200 ease-in-out border-b lg:block border-base-200 bg-base-100">
	<div class="mx-auto flex">
		<div class="flex items-center flex-none"><a href="/" aria-label="Homepage"
			class="px-2 flex-0 btn btn-ghost md:px-4 nuxt-link-active">
			<div class="inline-block text-3xl font-title text-primary"><span class="lowercase">si</span><span
				class="uppercase text-base-content">Perpus</span></div>
			</a></div>
		</a>
	</div>
</div>
<div class="overflow-y-auto h-screen mb-4">
	<ul class="menu flex flex-col p-4 pt-2 compact">
		<li class="mt-4 menu-title">
			<span>Menu</span>
		</li>
		<li class="mb-2">
			<a href="{{ route('dashboard') }}" class="capitalize">
				<i data-feather="grid" class="mr-2"></i>
				Dashboard
			</a>
		</li>
		<li class="w-90">
			<a href="{{ route('profile.index') }}" class="capitalize">
				<i data-feather="user" class="mr-2"></i>
				profile
			</a>
		</li>
		@if (Auth::user()->level != 'member')
		<li>
			<div class="collapse w-90 rounded-box collapse-arrow">
				<input type="checkbox">
				<div class="collapse-title">
					<i data-feather="users" class="ml-1 mr-2 inline-block"></i>Users
				</div>
				<div class="collapse-content">
					<ul>
						@if(Auth::user()->level == 'admin')
						<li><a href="{{ route('user.index') }}"><i data-feather="users" class="mr-2"></i>User List</a></li>
						@endif
						<li><a href="{{ route('petugas.index') }}"><i data-feather="user" class="mr-2"></i>Petugas</a></li>
						<li><a href="{{ route('member.index') }}"><i data-feather="user" class="mr-2"></i>Member</a></li>
					</ul>
				</div>
			</div>
		</li>
		@endif
		<li class="mb-2">
			<a href="{{ route('buku.index') }}" class="capitalize">
				<i data-feather="book" class="mr-2"></i>
				Buku
			</a>
		</li>
		@if (Auth::user()->level != 'member')
		<li class="mb-2">
			<a href="{{ route('rak.index') }}" class="capitalize">
				<i data-feather="archive" class="mr-2"></i>
				Rak Buku
			</a>
		</li>
		<li>
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
