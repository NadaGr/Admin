@extends('layouts.app')
@section('container')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Liste des Clients</a>
                    </li>
                </ol>
            </nav>
            <div class="block-options">
                <button type="button" class="btn-block-option btn btn-light" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="nav-main-link-icon si si-plus"> Ajouter user</i></button>
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
            <h3 class="block-title">Liste des Clients</h3>
        </div>
        <div class="block-content block-content-full">
            @if(Session::has('Client_Add'))
            <div class="alert alert-success">
                {{ Session::get('Client_Add')}}
            </div>
            @endif
            @if(Session::has('Client_Update'))
            <div class="alert alert-success">
                {{ Session::get('Client_Update')}}
            </div>
            @endif
           
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center font-size-sm">id</th>
                        <th class="text-center font-size-sm" style="width: 100px;">Photo</th>
                        <th class="font-size-sm">Nom & Prenom </th>
                        <th class="font-size-sm">Email</th>
                        <th class="font-size-sm">Adresse</th>
                        <th class="font-size-sm">Telephone</th>
                        <th class="text-center font-size-sm" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $CU as $CU )

                    <tr>
                        <input type="hidden" class="delete_val" value="{{  $CU->id }}">
                        <td class="text-center"> {{  $CU->id }} </td>
                        <td class="font-size-sm"><img src="{{ $CU->photo }}" style=" width: 100px;" alt=""></td>
                        <td class="text-center"> {{ $CU->nom_user }} {{ $CU->prenom }} </td>
                        <input type="hidden" value="{{  $CU->user->id }}">
                        <td class="font-size-sm">{{ $CU->user->email }}</td>
                        <td class="text-center font-size-sm">{{ $CU->adresse }}</td>
                        <td class="text-cente font-size-smr">{{ $CU->telephone }}</td>
                        <td class=" text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-light" data-myID="{{ $CU->id }}"
                                    data-myIdUser="{{  $CU->user->id }}" data-myNom="{{ $CU->nom_user }}"
                                    data-myPrenom="{{ $CU->prenom }}" data-myEmail="{{ $CU->user->email }}"
                                    data-myAdresse="{{ $CU->adresse }}" data-myTelephone="{{ $CU->telephone }}"
                                    data-myImage="{{ $CU->photo }}" data-bs-toggle="modal" data-bs-target="#Edit"
                                    data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-danger clientdeletebtn" data-toggle="tooltip" title="Supprimer">
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

<!-- Page Content -->
<div class="content" id="histo">
    <!-- Dynamic Table Full Pagination -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Historique des Clients</h3>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead class="thead-dark">
                    <tr class="text-uppercase">
                        <th class="font-w700">ID Reservation</th>
                        <th class="d-none d-sm-table-cell font-w700">Nom Client</th>
                        <th class="d-none d-sm-table-cell font-w700">Service</th>
                        <th class="d-none d-sm-table-cell font-w700">Date</th>
                        <th class="font-w700">State</th>
                        <th class="d-none d-sm-table-cell font-w700 text-right" style="width: 120px;">Price
                        </th>
                        <th class="d-none d-sm-table-cell font-w700 text-right" style="width: 120px;">Points
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($res as $res)
                    <tr>
                        <td>
                            <span class="d-none d-sm-table-cell text-right">{{ $res->id}}</span>
                        </td>
                        <td>
                            <div>
                                <span class="d-none d-sm-table-cell text-right">{{ $res->client->nom_user}}
                                    {{ $res->client->prenom}}</span>
                            </div>
                            <div> <span class="d-none d-sm-table-cell text-right font-size-sm" style="color: gray;">Num
                                    Tel: {{ $res->client->telephone}}</span>
                            </div>
                        </td>
                        <td>
                            <span class="d-none d-sm-table-cell text-right">{{ $res->service->nom_service}}</span>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <span class="font-size-sm text-muted">{{ $res->updated_at}}</span>
                        </td>
                        <td>
                            <span class="font-w600">{{ $res->etat}}</span>
                        </td>
                        <td class="d-none d-sm-table-cell text-right">
                            {{ $res->service->prix}}
                        </td>
                        <td class="d-none d-sm-table-cell text-right">
                            {{ $res->service->nb_points}}
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/adduser')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Nom de Client:</label>
                        <input type="text" class="form-control" id="example-text-input" name="name"
                            placeholder="Nom de client .. " required>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Email :</label>
                        <input type="email" class="form-control" id="example-text-input" name="email"
                            placeholder="email@gmail.com .. " required>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="example-text-input" name="password"
                            placeholder="password .." required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="example-text-input" name="role" value="cliente">
                    </div>

                    <div class="mb-3">
                        <label for="prenom" class="col-form-label">Prenom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom .."
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" name="photo" onchange="previewFile(this)" required>
                        <img id="image" src="" style="width: 40px; margin-top: 20px ">
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="col-form-label">Adress:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse .."
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="col-form-label">telephone:</label>
                        <input type="number" class="form-control" id="telephone" name="telephone"
                            placeholder="telephone .." required>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Modifier Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="">
                    <input type="hidden" class="form-control" id="iduser" name="user_id" value="">
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" name="photo" onchange="previewFile(this)">
                        <img id="image" src="" style="width: 40px; margin-top: 20px ">
                    </div>
                    <div class="mb-3">
                        <label for="nom_user" class="col-form-label">Nom de Client:</label>
                        <input type="text" class="form-control" id="nom_user" name="nom_user" value="">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="col-form-label">Prenom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="">
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="col-form-label">Adress:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" value="">
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="col-form-label">telephone:</label>
                        <input type="number" class="form-control" id="telephone" name="telephone" value="">
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









<div class="modal fade" id="exampleModalCl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/addClient')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Nom de Client:</label>
                        <input type="text" class="form-control" id="example-text-input" name="nom_user"
                            placeholder="Nom de client .. " required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="col-form-label">Prenom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom .."
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="col-form-label">Image:</label>
                        <input type="file" class="form-control" name="photo" onchange="previewFile(this)" required>
                        <img id="image" src="" style="width: 40px; margin-top: 20px ">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="user_id">
                            <option selected> Select Nom</option>
                            @foreach( $user as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="col-form-label">Adress:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse .."
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="col-form-label">telephone:</label>
                        <input type="number" class="form-control" id="telephone" name="telephone"
                            placeholder="telephone .." required>
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
    $('.clientdeletebtn').click(function(e) {
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
                    url: "/deleteClient/" + delete_id,
                    data: data,
                    success: function(response) {
                        swalWithBootstrapButtons.fire(response.client_delete, {
                            icon: "success"
                        }).then((result) => {
                            location.reload();
                        });
                    }
                })
            }
        })

    });

}); 
</script>
<script>
$('#Edit').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget);
    console.log('modal open');
    var Id = button.data('myid');
    var Iduser = button.data('myiduser');
    var Nom = button.data('mynom');
    var Prenom = button.data('myprenom');
    var Email = button.data('myemail');
    var Adresse = button.data('myadresse');
    var Telephone = button.data('mytelephone');
    var Image = button.data('myimage');
    console.log(button);
    var modal = $(this);
    var rout = "{{ route('client.update','" + Id + "') }}";
    modal.find('.modal-body #id').val(Id);
    modal.find('.modal-body #iduser').val(Iduser);
    modal.find('.modal-body #form').attr('action', rout);
    modal.find('.modal-body #nom_user').val(Nom);
    modal.find('.modal-body #prenom').val(Prenom);
    modal.find('.modal-body #email').val(Email);
    modal.find('.modal-body #adresse').val(Adresse);
    modal.find('.modal-body #telephone').val(Telephone);
    modal.find('.modal-body #image').attr('src', Image);
})
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

</script>
@endsection