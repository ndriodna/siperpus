<x-app-layout>
	<x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Rak Edit') }} - {{$rak->nama}}
    </h2>
  </x-slot>

	<form action="{{route('rak.update',$rak->id)}}" method="POST" class="w-1/2 mx-auto">
		@csrf
		@method('PUT')
		<div class="form-control">
			<label class="label">
				<span class="label-text">Nama Rak</span>
			</label>
			<input type="text" class="input input-primary" name="nama" value="{{$rak->nama}}">
		</div>
		<div class="modal-action">
			<button type="submit" class="btn btn-primary">Update</button>
			<label for="add-modal" class="btn btn-error">Tutup</label>
		</form>
	</x-app-layout>