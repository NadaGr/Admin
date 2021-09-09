@extends('layouts.app')
@section('container')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ url('/addservice') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="text" class="col-form-label">Nom du Service:</label>
                        <input type="text" class="form-control" id="text" name="nom_service"
                            placeholder="Nom du service">
                    </div>
                    <div class="mb-3">
                        <label for="textarea" class="col-form-label">Description :</label>
                        <textarea class="form-control" id="example-textarea-input" name="description" rows="4"
                            placeholder="Description.."></textarea>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="categorie_id">
                            <option selected> Select Categorie</option>
                            @foreach( $categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->nom_categorie}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" id="text" name="image" onchange="previewFile(this)">
                        <img id="image" style="width: 40px; margin-top: 20px ">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Prix:</label>
                        <input type="number" class="form-control" step="0.001" name="prix" placeholder="Prix..">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">points:</label>
                        <input type="number" class="form-control" step="0.001" name="nb_points"
                            placeholder="Nombre des points..">
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


<!----Edite---->
<div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" action=" " method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id" name="id" value="">
                    </div>
                    <div class="mb-3">
                        <label for="nom_service" class="col-form-label">Nom du Service:</label>
                        <input type="text" class="form-control" id="nom_service" name="nom_service" value="">
                    </div>
                    <div class="mb-3">
                        <label for="textarea" class="col-form-label">Description :</label>
                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="categorie_id" aria-label="Default select example"
                            name="categorie_id">
                            <option disabled> Select Categorie</option>
                            @foreach( $categories as $cat)
                            <option value="{{$cat->id}}" selected>{{$cat->nom_categorie}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" name="image" onchange="previewFile(this)">
                        <img id="image" src="" style="width: 40px; margin-top: 20px ">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Prix:</label>
                        <input type="number" class="form-control" step="0.001" id="prix" name="prix" value="">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">points:</label>
                        <input type="number" class="form-control" step="0.001" id="nb_points" name="nb_points" value="">
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
                        <a class="link-fx" href="">Liste des Services</a>
                    </li>
                </ol>
            </nav>
            <div class="block-options">
                <button type="button" class="btn-block-option btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="nav-main-link-icon si si-plus"> Ajouter Service</i></button>
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
            <h3 class="block-title">Liste des Services</h3>
        </div>
        <div class="block-content block-content-full">
            @if(Session::has('service_Added'))
            <div class="alert alert-success">
                {{ Session::get('service_Added')}}
            </div>
            @endif
            @if(Session::has('service_Update'))
            <div class="alert alert-success">
                {{ Session::get('service_Update')}}
            </div>
            @endif

            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead class="thead-dark">
                    <tr>
                        <th class="font-size-sm" style="width: 10%;">ID_Service</th>
                        <th class="font-size-sm" style="width: 10%;">Nom de categorie</th>
                        <th class="text-center font-size-sm" style="width: 10%;">Photo</th>
                        <th class="font-size-sm" style="width: 15%;">Nom de service</th>
                        <th class="font-size-sm" style="width: 20%;">Description</th>
                        <th class="font-size-sm" style="width: 10%;">Prix</th>
                        <th class="font-size-sm" style="width: 10%;">Points</th>
                        <th class="font-size-sm" style="width: 5%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $Sc as $d )

                    <tr>
                        <input type="hidden" class="delete_val" value="{{  $d->id }}">
                        <td><span class="font-size-sm">{{ $d->id }}</span></td>
                        <td class="text-center"> {{ $d->categorie->nom_categorie }} </td>
                        <td class="font-size-sm"><img src="{{ $d->image }}" style=" width: 100px;" alt=""></td>
                        <td class="font-size-sm">{{ $d->nom_service }}</td>
                        <td> {{ $d->description }} </td>
                        <td class="text-center font-size-sm">{{ $d->prix }}</td>
                        <td class="text-cente font-size-smr">{{ $d->nb_points }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-light" data-myID="{{$d->id}}"
                                    data-myNomCat="{{ $d->categorie->id }}" data-myImage="{{ $d->image }}"
                                    data-myNomServ="{{ $d->nom_service }}" data-myDesc="{{ $d->description }}"
                                    data-myPrix="{{ $d->prix }}" data-myNbP="{{ $d->nb_points }}" data-bs-toggle="modal"
                                    data-bs-target="#Edit" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-danger servideletebtn" title="Delete">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full Pagination -->
    <!-- Modal -->

</div>
<!-- END Page Content -->

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
    $('.servideletebtn').click(function(e) {
        e.preventDefault();
        var delete_id = $(this).closest('tr').find(".delete_val").val();
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
                    url: "/deleteservice/" + delete_id,
                    data: data,
                    success: function(response) {
                        swalWithBootstrapButtons.fire(response.service_delete, {
                                icon: "success"
                            })
                            .then((result) => {
                                location.reload();
                            });

                    }
                })

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                )
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
    var NomServ = button.data('mynomserv');
    var Image = button.data('myimage');
    var Desc = button.data('mydesc');
    var Prix = button.data('myprix');
    var NbP = button.data('mynbp');
    console.log(button);
    var modal = $(this);
    var rout = "{{ route('service.update','" + Id + "') }}";
    modal.find('.modal-body #id').val(Id);
    modal.find('.modal-body #form').attr('action', rout);

    modal.find('.modal-body #categorie_id').val(NomCat);
    console.log(Image);
    modal.find('.modal-body #nom_service').val(NomServ);
    modal.find('.modal-body #image').attr('src', Image);
    modal.find('.modal-body #description').val(Desc);
    modal.find('.modal-body #prix').val(Prix);
    modal.find('.modal-body #nb_points').val(NbP);
})
</script>
@endsection