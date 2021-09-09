@extends('layouts.app')
@section('container')
<!-- Main Container -->
<!-- Main Container -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Categorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.categorie')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Nom de Categorie:</label>
                        <input type="text" class="form-control" id="example-text-input" name="nom_categorie"
                            placeholder="Nom de categorie">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" id="text" name="image" onchange="previewFile(this)">
                        <img id="image" style="width: 40px; margin-top: 20px ">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<!------------------edit------------------------------------------->
<div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Categorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="">
                    <div class="mb-3">
                        <label for="nom_categorie" class="col-form-label">Nom de Categorie:</label>
                        <input type="text" class="form-control" id="nom_categorie" name="nom_categorie" value="">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" name="image" onchange="previewFile(this)">
                        <img id="image" src="" style="width: 40px; margin-top: 20px ">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Editer</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Liste des Categories</a>
                    </li>
                </ol>
            </nav>
            <div class="block-options">
                <button type="button" class="btn-block-option btn btn-light" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="nav-main-link-icon si si-plus"> Ajouter Categorie</i></button>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Dynamic Table Full Pagination -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Liste des Categories</h3>
        </div>
        <div class="block-content block-content-full">
            @if(Session::has('Categorie_Update'))
            <div class="alert alert-success">
                {{ Session::get('Categorie_Update')}}
            </div>
            @endif
            @if(Session::has('Categry_add'))
            <div class="alert alert-success">
                {{ Session::get('Categry_add')}}
            </div>
            @endif
            @if(Session::has('categorie_delete'))
            <div class="alert alert-success">
                {{ Session::get('categorie_delete')}}
            </div>
            @endif
            @if(Session::has('categorie_modified'))
            <div class="alert alert-success">
                {{ Session::get('categorie_modified')}}
            </div>
            @endif
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Nom de categorie</th>
                        <th class="text-center font-size-sm" style="width: 100px;">Photo</th>
                        <th class="text-center font-size-sm" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $Cat as $cat )

                    <tr>
                        <input type="hidden" value="{{  $cat->id }}">
                        <td class="text-center font-size-sm">{{ $cat->id }}</td>
                        <td class="font-w600 font-size-sm">{{ $cat->nom_categorie }}</td>
                        <td class="font-size-sm"><img src="{{ $cat->image }}" style=" width: 100px;" alt=""></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light" data-myID="{{ $cat->id }}"
                                    data-myNomCat="{{ $cat->nom_categorie }}" data-myImage="{{ $cat->image }}"
                                    data-bs-toggle="modal" data-bs-target="#Edit" data-toggle="tooltip"
                                    title="Modifier">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button ype="button" class="btn btn-sm btn-danger" data-myID="{{ $cat->id }}"
                                    data-myNomCat="{{ $cat->nom_categorie }}" data-toggle="modal"
                                    data-target="#exampleModalCenter" data-toggle="tooltip" title="Supprimer">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full Pagination -->
</div>
<!-- END Page Content -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Si vous souhaitez de supprimer cette catégorie,
                    déplacez leurs services à une de ces categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(Session::has('categorie_modified'))
            <div class="alert alert-success">
                {{ Session::get('categorie_modified')}}
            </div>
            @endif
            <div class="modal-body">
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control delete_val" id="id" name="id" value="">
                    <input type="hidden" class="form-control" id="nom_categorie" name="nom_categorie" value="">

                    <div class="form-group">
                        <select id="op" class="form-control" name="categorie_id">
                            @foreach($allCategories as $allCategories)
                            <option value="{{$allCategories -> id}}">{{$allCategories -> nom_categorie}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-secondary">Deplacer
                            </button>
                        <button type="button" class="btn btn-sm btn-danger categorydeletebtn"
                            data-toggle="tooltip">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- END Main Container -->
@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.categorydeletebtn').click(function(e) {
        e.preventDefault();
        var delete_id = $(this).closest('form').find(".delete_val").val();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Êtes-vous sûr?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'delete ',
            cancelButtonText: 'cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                var data = {
                    "_token": $('input[name=_token]').val(),
                    "id": delete_id,
                };

                $.ajax({
                    type: "DELETE",
                    url: "/deletecategorie/" + delete_id,
                    data: data,
                    success: function(response) {
                        swalWithBootstrapButtons.fire(response.categorie_delete, {
                                icon: "success"
                            })
                            .then((result) => {
                                location.reload();
                            });

                    }
                })

            }
        })

    });

});
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
    integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
    integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
</script>
<script>
function previewFile(input) {
    var file = $('input[type=file]').get(0).files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function() {
            $('#image').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    }
}
</script>
<script>
$('#Edit').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget);
    console.log('modal open');
    var Id = button.data('myid');
    var NomCat = button.data('mynomcat');
    var Image = button.data('myimage');
    console.log(button);
    var modal = $(this);
    var rout = "{{ route('categorie.update','" + Id + "') }}";
    modal.find('.modal-body #id').val(Id);
    modal.find('.modal-body #form').attr('action', rout);
    modal.find('.modal-body #nom_categorie').val(NomCat);
    modal.find('.modal-body #image').attr('src', Image);
})
</script>
<script>
$('#exampleModalCenter').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget);
    console.log('modal open');
    var Id = button.data('myid');
    var NomCat = button.data('mynomcat');
    console.log(button);
    var modal = $(this);
    var rout = "{{ route('categorie.updatecat','" + Id + "') }}";
    modal.find('.modal-body #id').val(Id);
    modal.find('.modal-body #form').attr('action', rout);
    modal.find('.modal-body #nom_categorie').val(NomCat);
    modal.find('.modal-body #op').val(Id).attr('selected', true);
})
</script>
@endsection