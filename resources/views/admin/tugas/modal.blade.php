


<!-- Modal Delete-->
<div class="modal fade" id="ModalTugasDelete{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header badge-info text-white">
        <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}" tabindex="-1">Detail {{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
        <div class="row">
          <div class="col-6">
            Nama 
          </div>
          <div class="col-6">
            : {{ $item->user->nama }}
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            Email 
          </div>
          <div class="col-6">
            :
            <span class="badge badge-primary badge-pill">
              {{ $item->user->email }}
              </span> 
          </div>  
        </div>
        <div class="row">
          <div class="col-6">
            Jabatan 
          </div>
          <div class="col-6">
            :
            <span class="badge badge-info badge-pill">
              {{ $item->user->jabatan }}
              </span> 
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
          <i class="fas fa-times"></i>
          Tutup
        </button>
        <form action="{{ route('tugasDestroy', $item->id)}}">
          @csrf
          <button type="submit" class="btn btn-danger btn-sm ">
            <i class="fas fa-trash"></i>
            Hapus
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Show-->
<div class="modal fade" id="ModalShowTugas{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="close">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header badge-info text-white">
        <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}" tabindex="-1">Detail {{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
        <div class="row">
          <div class="col-6">
            Nama 
          </div>
          <div class="col-6">
            : {{ $item->user->nama }}
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            Email 
          </div>
          <div class="col-6">
            :
            <span class="badge badge-primary badge-pill">
              {{ $item->user->email }}
              </span> 
          </div>  
        </div>
        <div class="row">
          <div class="col-6">
            Jabatan 
          </div>
          <div class="col-6">
            :
            <span class="badge badge-info badge-pill">
              {{ $item->user->jabatan }}
              </span> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>