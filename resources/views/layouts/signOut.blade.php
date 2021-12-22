<div class="dropdown dropdown-left dropdown-end">
  <button class="btn btn-square btn-ghost" tabindex="0">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>                    
    </svg>
  </button>
  <ul tabindex="0" class="dropdown-content px-4">
   <form action="{{route('logout')}}" method="POST">
     <li>
      @csrf

      <a class="tooltip tooltip-bottom" data-tip="Logout">
      <button type="submit" class="btn btn-error"><i data-feather="log-out"></i></button>
      </a>
    </li>
  </form>
</ul>
</div>