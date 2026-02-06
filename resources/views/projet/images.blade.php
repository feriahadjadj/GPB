@extends('layouts.poste')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('fancybox/dist/jquery.fancybox.min.css') }}">

<div class="container-fluid px-4 py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3 class="fw-semibold mb-1">Galerie photos du projet</h3>
            <div class="text-muted small">
                {{ App\Projet::find($id)->designation }} ·
                {{ $images->count() }} photo(s)
            </div>
            <div class="small text-muted mt-1">
                Les photos servent de preuve visuelle de l’état réel du projet.
            </div>
        </div>

        @can('upw-role')
        <div class="text-end">
            <button class="btn btn-primary px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#uploadModal">
                Ajouter des photos
            </button>
            <div class="small text-muted mt-1">
                JPG / PNG · Recommandé ≤ 5 Mo
            </div>
        </div>
        @endcan
    </div>

    <hr class="mb-4">

    <!-- EMPTY STATE -->
    @if($images->isEmpty())
        <div class="empty-state">
            <img src="{{ asset('img/empty-images.svg') }}">
            <h5 class="mt-3">Aucune photo enregistrée</h5>
            <p>
                Ajoutez des photos pour documenter l’avancement ou l’état du projet.
            </p>
        </div>
    @else

    <!-- GALLERY GRID -->
    <div class="row g-4">
        @foreach($images as $img)
        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6">
            <div class="photo-card">

                <a href="{{ asset(Storage::url($img->src)) }}"
                   data-fancybox="gallery"
                   data-caption="{{ $img->observation }}">
                    <img src="{{ asset(Storage::url($img->src)) }}">
                </a>

                <div class="photo-info">
                    <div class="photo-date">
                        {{ $img->created_at->format('d/m/Y') }}
                    </div>
                    <div class="photo-note">
                        {{ $img->observation ?: 'Aucune observation' }}
                    </div>
                </div>

                @can('info')
                <form id="delete{{$img->id}}"
                      action="{{ route('images.destroy',$img->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                </form>

                <button class="photo-delete"
                        onclick="if(confirm('Supprimer cette photo ?')) document.getElementById('delete{{$img->id}}').submit();">
                    ✕
                </button>
                @endcan

            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<!-- UPLOAD MODAL -->
@can('upw-role')
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter des photos</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST"
                  action="{{ route('images.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">

                <div class="modal-body">

                    <div class="upload-zone">
                        <input type="file"
                               id="images"
                               name="image[]"
                               multiple
                               accept="image/*"
                               hidden>

                        <label for="images">
                            Cliquez ou glissez les photos ici
                            <small>
                                Utilisez des photos nettes et représentatives de l’état réel
                            </small>
                        </label>
                    </div>

                    <div id="preview" class="row g-2 mt-3"></div>

                    <label class="small text-muted mt-3">
                        Observation (facultatif)
                    </label>
                    <textarea class="form-control"
                              name="observation"
                              rows="3"
                              placeholder="Ex : Avancement des travaux, réception du matériel..."></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button class="btn btn-primary" id="submitBtn" disabled>
                        Enregistrer
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endcan

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('fancybox/dist/jquery.fancybox.min.js') }}"></script>

<script>
$('[data-fancybox]').fancybox({
    loop:true,
    buttons:["zoom","fullScreen","download","close"]
});

$('#images').on('change', function(){
    $('#preview').html('');
    $('#submitBtn').prop('disabled', !this.files.length);

    [...this.files].forEach(file=>{
        let r = new FileReader();
        r.onload = e => $('#preview').append(`
            <div class="col-3">
                <img src="${e.target.result}" class="img-fluid rounded">
            </div>
        `);
        r.readAsDataURL(file);
    });
});
</script>

<style>
.photo-card{
    position:relative;
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,.06);
}
.photo-card img{
    width:100%;
    height:220px;
    object-fit:cover;
}
.photo-info{
    padding:12px;
}
.photo-date{
    font-size:12px;
    color:#6c757d;
}
.photo-note{
    font-size:13px;
}
.photo-delete{
    position:absolute;
    top:10px;
    right:10px;
    width:28px;
    height:28px;
    border:none;
    border-radius:50%;
    background:#fff;
    opacity:0;
    transition:.2s;
}
.photo-card:hover .photo-delete{
    opacity:1;
}

.upload-zone{
    border:2px dashed #0068FE;
    border-radius:14px;
    padding:32px;
    text-align:center;
    cursor:pointer;
}
.upload-zone small{
    display:block;
    color:#6c757d;
    margin-top:6px;
}

.empty-state{
    text-align:center;
    padding:80px 20px;
}
.empty-state img{
    width:180px;
    margin-bottom:20px;
}
</style>

@endsection
