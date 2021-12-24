@extends('layouts.landing')
@section('content')
<div class="mx-auto px-0 md:px-12 lg:px-12">
	
<div class="text-primary text-center">
	<div class="inline-block">
		<span class="uppercase text-5xl font-bold">perpus</span>
		<span class="uppercase text-5xl font-bold text-error">mulia</span>
	<div class="text-2xl uppercase">perpustakaan online universitas mulia</div>
	</div>
</div>

<div class="mx-auto py-12">
	<div  class="relative">
	<form action="#" class="mx-auto">
	<input type="text" class="input input-bordered input-primary w-full" placeholder="Cari Judul">
	<button class="absolute top-0 right-0 rounded-1-none btn btn-primary">
		<i data-feather="search"></i>
	</button>
</form>
	</div>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-8 ">
		@foreach($bukus as $buku)
		<div class="card shadow-lg bg-base-100">
			<figure>
				<img src="{{$buku->cover ? asset($buku->cover) : asset('cover-default.svg')}}" alt=""  class="max-h-80">
			</figure>
			<div class="card-body">
				<div class="card-title text-center">{{$buku->judul}}</div>
					<span class="text-gray-400 text-sm block">Penulis</span>
				<span>{{$buku->pengarang}}</span>
				<span class="text-gray-400 text-sm">Penerbit</span>
				<span>{{$buku->penerbit}}</span><span class="text-gray-400 text-sm">Tahun</span>
				<span>{{$buku->tahun_terbit}}</span>
			</div>
				<div class="card-actions justify-end px-2">
					<form action="#">
					<button type="submit" class="btn btn-md btn-primary">Pinjam</button>
					<a href="{{route('landing.show',$buku->id)}}" class="btn btn-md btn-ghost">Lihat Detail</a>
					</form>
				</div>
		</div>
		@endforeach
	</div>
	<div class="px-2 py-4">
	{{$bukus->links()}}
		
	</div>
</div>
@endsection