<aside class="flex flex-col justify-between border-r border-base-400 bg-base-100 text-base-content w-80 overflow-hidden lg:hidden">
	<div class="overflow-y-auto h-screen mb-4">
		<ul class="menu flex flex-col p-4 pt-2 compact">
			<li class="mt-4 menu-title">
				<span>Menu</span>
			</li>
			<li class="mb-2">
				<a href="{{ url('/') }}" class="capitalize">
					<i data-feather="home" class="mr-2"></i>
					Beranda
				</a>
			</li>
			{{-- <li class="mb-2">
				<a href="{{ url('/') }}" class="capitalize">
					<i data-feather="pie-chart" class="mr-2"></i>
					Statistik
				</a>
			</li> --}}
			<li class="mt-4 menu-title">
				<span>User</span>
			</li>
			@auth
			<li class="mb-2">
				<a href="{{ route('dashboard') }}" class="capitalize">
					<i data-feather="grid" class="mr-2"></i>
					Dashboard
				</a>
			</li>
			@else
			<li class="w-90">
				<a href="{{ route('login') }}" class="capitalize">
					<i data-feather="user" class="mr-2"></i>
					Masuk
				</a>
			</li>
			<li class="w-90">
				<a href="{{ route('register') }}" class="capitalize">
					<i data-feather="user" class="mr-2"></i>
					Daftar
				</a>
			</li>
			@endif
		</ul>
	</div>
</aside>
