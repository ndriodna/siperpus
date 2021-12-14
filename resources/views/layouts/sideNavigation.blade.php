<aside class="flex flex-col justify-between border-r border-base-200 bg-base-100 text-base-content w-80 overflow-hidden">
  <div class="sticky inset-x-0 top-0 z-50 hidden w-full py-1 transition duration-200 ease-in-out border-b lg:block border-base-200 bg-base-100">
    <div class="mx-auto flex">
      <div class="flex items-center flex-none"><a href="/" aria-label="Homepage" class="px-2 flex-0 btn btn-ghost md:px-4 nuxt-link-active">
        <div class="inline-block text-3xl font-title text-primary"><span class="lowercase">si</span><span class="uppercase text-base-content">Perpus</span></div></a></div>
      </a>
    </div>
  </div>
  <div>
    <ul class="menu flex flex-col p-4 pt-2 compact h-screen"><li class="mt-4 menu-title"><span>
      Menu
    </span></li> 
    <li><a href="/docs/install" class="capitalize"><i data-feather="user" class="mr-2"></i>profile</a></li>
    <li class="dropdown">
      <a href="#" class="capitalize" tabindex="0"><i data-feather="users" class="mr-2"></i>Users 
        <div class="absolute -right-0"><i data-feather="chevron-down" class="align-right"></i></div>
      </a> 
      <div>
        <ul tabindex="0" class="p-2 shadow-lg menu dropdown-content bg-base-200 rounded-box w-72">
          <li><a href="{{route('petugas.index')}}"><i data-feather="user" class="mr-2"></i>Petugas</a></li>
          <li><a href="{{route('member.index')}}"><i data-feather="user" class="mr-2"></i>Member</a></li>
        </ul>
      </div>  
    </li>
    <li><a href="{{route('buku.index')}}" class="capitalize"><i data-feather="book" class="mr-2"></i>Buku
    </a></li>
    <li><a href="/dashboard" class="capitalize"><i data-feather="archive" class="mr-2"></i>Rak Buku
    </a></li> 
    <li><a href="{{route('transaksi.index')}}" class="capitalize"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
    </svg>Transaksi
  </a></li>
</ul> 
</div>
</aside>