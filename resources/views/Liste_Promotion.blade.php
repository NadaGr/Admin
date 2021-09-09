@extends('layouts.app')
@section('container')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Promotion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/addPromotion') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="col-form-label">nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="col-form-label">date de debut:</label>
                        <input type="date" class="form-control" id="date" name="date_debut">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">date de fin :</label>
                        <input type="date" class="form-control" id="message-text" name="date_fin">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Pourcentage :</label>
                        <input type="number" class="form-control" id="message-text" name="pourcentage">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" id="text" name="image" onchange="previewFile(this)">
                        <img id="image" style="width: 40px; margin-top: 20px ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Choisissez les services: </label>
                        <select class="form-control" name="service_id[]" multiple>
                            @foreach($allServices as $allService)
                            <option value="{{$allService -> id}}">{{$allService -> nom_service}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ajouter Promotion</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-----------------------------edit---------------->
<div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editer Promotion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id" name="id" value="">
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="col-form-label">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="">
                    </div>
                    <div class="mb-3">
                        <label for="dateD" class="col-form-label">date de debut:</label>
                        <input type="date" class="form-control" id="dateD" name="date_debut" value="">
                    </div>
                    <div class="mb-3">
                        <label for="dateF" class="col-form-label">date de fin :</label>
                        <input type="date" class="form-control" id="dateF" name="date_fin" value="">
                    </div>
                    <div class="mb-3">
                        <label for="pourcentage" class="col-form-label">Pourcentage :</label>
                        <input type="number" class="form-control" id="pourcentage" name="pourcentage" value="">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" name="image" onchange="previewFile(this)">
                        <img id="image" src="" style="width: 40px; margin-top: 20px ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Choisissez les services: </label>
                        <select id="op" class="form-control" name="service_id[]">
                            @foreach($allServices as $allService)
                            <option value="{{$allService -> id}}">{{$allService -> nom_service}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        <a class="link-fx" href="">Liste des promotions</a>
                    </li>

                </ol>
            </nav>
            <div class="block-options">
                <button type="button" class="btn-block-option btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="nav-main-link-icon si si-plus"> Ajouter Promotion</i></button>
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
            <h3 class="block-title">Liste des Promotions</h3>
        </div>
        <div class="block-content block-content-full">

            @if(Session::has('Promotion_Added'))
            <div class="alert alert-success">
                {{ Session::get('Promotion_Added')}}
            </div>
            @endif
            @if(Session::has('Promotion_Update'))
            <div class="alert alert-success">
                {{ Session::get('Promotion_Update')}}
            </div>
            @endif
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center font-size-sm" style="width: 100px;">Photo</th>
                        <th class="text-center font-size-sm" style="width: 30%;">Titre</th>
                        <th>Pourcentage </th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Nom du service</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Prix</th>
                        <th class="text-center font-size-sm" style="width: 15%;">Date de début</th>
                        <th class="text-center font-size-sm" style="width: 15%;">Date d'expiration</th>
                        <th class="text-center font-size-sm" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $sql as $sql )
                    @foreach( $sql->services as $ssnom )
                    <tr>
                        <input type="hidden" class="delete_val" value="{{  $sql->id }}">
                        <input type="hidden" class="delete_val2" value="{{  $ssnom->id }}">
                        <td class="font-size-sm"><img src="{{ $sql->image }}" style=" width: 100px;" alt=""></td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{ $sql->nom }}</td>
                        <td class="font-w600 font-size-sm">{{ $sql->pourcentage}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$ssnom->nom_service}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$ssnom->prix}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{ $sql->date_debut }}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{ $sql->date_fin }}</td>

                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light" data-myID="{{ $sql->id }}"
                                    data-myName="{{ $sql->nom }}" data-myImage="{{ $sql->image }}"
                                    data-myPourcentage="{{ $sql->pourcentage }}" data-myDD="{{ $sql->date_debut }}"
                                    data-myDF="{{ $sql->date_fin }}" data-myIdService="{{$ssnom->id}}"
                                    data-myNomService="{{$ssnom->nom_service}}" data-bs-toggle="modal"
                                    data-bs-target="#Edit" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger promodeletebtn"
                                    data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full Pagination -->
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
    $('.promodeletebtn').click(function(e) {
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
                    url: "/deletePromo/" + delete_id,
                    data: data,
                    success: function(response) {
                        swalWithBootstrapButtons.fire(response.Promo_delete, {
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
    var Nom = button.data('myname');
    var DateD = button.data('mydd');
    var DateF = button.data('mydf');
    var Pourcentage = button.data('mypourcentage');
    var Image = button.data('myimage');
    var IdService = button.data('myidservice');
    var NomService = button.data('mynomservice');
    console.log(button);
    var modal = $(this);
    var rout = "{{ route('promo.update','" + Id + "') }}";
    modal.find('.modal-body #id').val(Id);
    modal.find('.modal-body #nom').val(Nom);
    modal.find('.modal-body #form').attr('action', rout);
    modal.find('.modal-body #dateD').val(DateD);
    modal.find('.modal-body #image').attr('src', Image);
    modal.find('.modal-body #dateF').val(DateF);
    modal.find('.modal-body #pourcentage').val(Pourcentage);
    modal.find('.modal-body #op').val(IdService);
})

function selectfunction(s1) {

}
</script>
@endsection