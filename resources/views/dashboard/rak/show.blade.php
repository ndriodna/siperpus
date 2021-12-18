<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Rak') }} - {{$rak->nama}}
    </h2>
  </x-slot>

@foreach($rak->buku as $buku)
<div class="card shadow-lg p-6">
  <h3>{{$buku->judul}}</h3>
  <div class="card-body">
    {{$buku->isbn}}
  </div>
</div>
@endforeach
</x-app-layout>