<div class="dropdown dropdown-end">
  <button class="btn btn-square btn-ghost" tabindex="0">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>                    
    </svg>
  </button>
  <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52 divide-y divide-grey-600">
    <li>
      <a href="{{route('profile.index')}}"> <i data-feather="user" class="inline-block mr-2"></i>{{Auth::user()->name}}</a>
    </li>
    <li>
      <a>
       <form action="{{route('logout')}}" method="POST">
        @csrf
        <button type="submit"><i data-feather="log-out" class="inline-block mr-2"></i>Keluar</button>
      </form>
    </a>
  </li>
</ul>
</div>