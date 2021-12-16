<x-app-layout>
	<x-slot name="header">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Profile') }}
    </h2>
  </x-slot>
  <div class="form-control">
    <form action="#" method="post">
      @csrf
      <div class="form-control my-2">
        <label class="label">
          <span class="label-text">Username</span>
        </label>
        <input type="text" class="input input-bordered" value="{{$currentUser->name}}">
      </div>
      <div class="form-control my-2">
        <label class="label">
          <span class="label-text">Email</span>
        </label>
        <input type="mail" class="input input-bordered" value="{{$currentUser->email}}">
      </div>
    </form>
  </div>
</x-app-layout>