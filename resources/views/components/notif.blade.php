{{-- alert trasaction pending --}}
@if (Auth::user()->level != 'member')
<div class="py-4">
  <div class="alert">
    <div class="flex-1">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#009688"
      class="flex-shrink-0 w-6 h-6 mx-2">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
    </path>
  </svg>
  <label class="text-left font-semibold">
    <h4>Notifikasi</h4>
    <p class="text-md text-base-content text-opacity-60">
      @if ($transaksi->count() <= 0)
      Tidak ada pemberitahuan
      @else
      <span class="text-error text-xl font-bold">{{ $transaksi->count() }}</span>
      transaksi menunggu verifikasi
      @endif
    </p>
  </label>
</div>
</div>
</div>
@endif

{{-- alert member --}}
@if (Auth::user()->level == 'member')
<div class="space-y-4">
  @if ($onlyAuthMember->count() > 0)
  <div class="alert">
    <div class="flex-1">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#009688"
      class="flex-shrink-0 w-6 h-6 mx-2">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
    </path>
  </svg>
  <label class="text-left font-semibold">
    <h4>Notifikasi</h4>
    <p class="text-md text-base-content text-opacity-60">
      {{ $onlyAuthMember->count() }} transaksi menunggu verifikasi
    </p>
  </label>
</div>
</div>
@endif

{{-- alert terlambat --}}
@if (Auth::user()->member && $notifTerlambat->count() > 0)
<div class="alert alert-warning">
  <div class="flex-1">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
    class="w-6 h-6 mx-2 stroke-current">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
  </path>
</svg>
<label class="text-left font-semibold">
  <h4>Terlambat!</h4>
  <p class="text-md text-base-content text-opacity-60">{{ $notifTerlambat->count() }} peminjaman
  terlambat</p>
</label>
</div>
</div>
@endif

@if($notifDenda > 0)
<div class="alert alert-error">
  <div class="flex-1">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">    
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>                      
    </svg> 
    <label class="text-left font-semibold">
      <h4>Denda</h4>
      <p class="text-md text-base-content text-opacity-60"><span class="text-error text-lg">{{$notifDenda}}</span> Denda Belum lunas</p>
    </label>
  </div>
</div>
@endif
</div>
@endif