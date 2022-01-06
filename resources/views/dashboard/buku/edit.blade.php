<input type="checkbox" class="modal-toggle" id="modal{{$buku->id}}">
<div class="modal overflow-y-auto grid sm:mx-auto lg:-mr-80">
  <div class="modal-box my-6 w-screen">
    <h2 class="font-semibold text-xl text-content leading-tight">
      {{ __('Buku Edit') }} - {{$buku->judul }}
    </h2>
    <form action="{{route('buku.update',$buku->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-control">
        <label class="label">
          <span class="label-text">Judul</span>
        </label>
        <input type="text" class="input input-primary" name="judul" value="{{$buku->judul}}">
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">ISBN</span>
        </label>
        <input type="text" class="input input-primary" name="isbn" value="{{$buku->isbn}}">
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Pengarang</span>
        </label>
        <input type="text" class="input input-primary" name="pengarang" value="{{$buku->pengarang}}">
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Penerbit</span>
        </label>
        <input type="text" class="input input-primary" name="penerbit" value="{{$buku->penerbit}}">
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Tahun</span>
        </label>
        <input class="input-primary input" name="tahun_terbit" type="number" min="1990" max="2099" step="1" value="{{$buku->tahun_terbit}}" />
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Stok</span>
        </label>
        <input type="number" class="input input-primary" name="stok" value="{{$buku->stok}}">
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Rak</span>
        </label>
        <select name="rak_id" id="" class="select select-bordered select-primary">
          @foreach($raks as $rak)
          <option value="{{$rak->id}}" {{$rak->id == $buku->rak_id ? 'selected' : ''}}>
            {{$rak->nama}}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Cover</span>
        </label>
        <input type="file" class="input input-primary" name="cover">
        <figure>
          <img src="{{$buku->cover}}" alt="" class="max-h-80">
        </figure>
      </div>
      <div class="modal-action">
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
      <label for="modal{{$buku->id}}" class="btn btn-error">Tutup</label>
    </div>
  </form>
</div>
</div>