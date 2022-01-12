<div class="navbar sticky inset-x-0 top-0 z-50 shadow-lg bg-base-100 text-neutral rounded-box m-6 px-12">
  <div class="flex-1 px-2 mx-2 hidden lg:flex">
    <span class="text-lg font-bold">
      <div class="inline-block text-3xl font-title text-primary"><span class="uppercase">perpus</span><span
        class="uppercase text-error">mulia</span></div>
      </span>
    </div>
    <div class="hidden lg:flex">
      <div class="flex-none mx-2">
        <a href="{{url('/')}}" class="btn btn-ghost text-neutral">Beranda</a>
      </div>
      {{-- <div class="flex-none mx-2">
        <a href="{{url('/')}}" class="btn btn-ghost text-neutral">Statistik</a>
      </div> --}}
      @auth
      <div class="flex-none mx-2">
        <a href="{{route('dashboard')}}" class="btn btn-ghost text-neutral">Dashboard</a>
      </div> 
      @else
      <div class="flex-none mx-2">
        <a href="{{route('login')}}" class="btn btn-ghost text-neutral">Login</a>
      </div>
      <div class="flex-none mx-2">
        <a href="{{route('register')}}" class="btn btn-ghost text-neutral">Register</a>
      </div>
      @endauth
    </div>


    {{-- navbar mobile --}}
    <div class="mx-auto space-x-1 max-w-none lg:hidden">
    <div class="flex items-center flex-none lg:hidden"><a href="/" aria-label="Homepage" class="px-2 flex-0 btn btn-ghost md:px-4 nuxt-link-active">
      <div class="inline-block text-3xl font-title text-primary"><span class="uppercase">perpus</span><span class=" upercase text-error">mulia</span></div></a></div>

    </div>
    <div class="flex-none mx-2"><label for="sidenav-mobile" class="btn btn-square btn-ghost drawer-button lg:hidden"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></label>
    </div>
  </div>