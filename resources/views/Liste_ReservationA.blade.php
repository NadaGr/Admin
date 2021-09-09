@extends('layouts.app')
@section('container')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: 	rgb(153, 187, 255);">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter l'etat de traitement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id" name="id" value="">
                        <input type="hidden" class="form-control" id="id1" name="client_id" value="">
                        <input type="hidden" class="form-control" id="id2" name="service_id" value="">
                    </div>
                    <div class="mb-3">
                        <label for="textarea" class="col-form-label">Description :</label>
                        <textarea class="form-control" id="example-textarea-input" name="description" rows="4"
                            placeholder="Description.." require></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="col-form-label">Etat d'avancement:</label>
                        <select class="form-select" aria-label="Default select example" name="etat" require>
                            <option value="terminé" id="T">Terminé</option>
                            <option value="en progress" id="P">En progress</option>
                            <option value="annulé" id="A">Annulé</option>
                        </select>
                    </div>

                    <!-- <div class="mb-3" id="radio">
                        <label for="text" class="col-form-label">Mode de paiement:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="R1">
                            <label class="form-check-label" for="flexCheckDefault">
                                Espèces
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="R2" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Points
                            </label>
                        </div>
                       
                    </div> -->
                    <div class="mb-3" id="m">
                    <label class="col-form-label">Montant:</label>
                        <input type="number" class="form-control" step="0.001" name="montant" placeholder="montant.."
                            require>
                        </div>
                    <div class="mb-3" id="bloc">
                        <div class="mb-3">
                            <label class="col-form-label">Montant restant:</label>
                            <input type="number" class="form-control" step="0.001" name="montant_restant"
                                placeholder="Montant restant..">
                        </div>
                        <div class="mb-3">
                            <label for="dateRes" class="col-form-label">Prochaine date de traitement:</label>
                            <input type="datetime-local" class="form-control" id="dateRes" name="prochaine_date"
                                value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Confirmer</button>
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
                        <a class="link-fx" href="">Liste des Reservations Acceptées</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<!-- END Page Content -->
<div class="content">
    <!-- Dynamic Table Full Pagination -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Liste des Reservations Acceptée</h3>
        </div>
        <div class="block-content block-content-full">

            @if(Session::has('Reservation_Supprimer'))
            <div class="alert alert-success">
                {{ Session::get('Reservation_Supprimer')}}
            </div>
            @endif
            @if(Session::has('Reservation_confirmer'))
            <div class="alert alert-success">
                {{ Session::get('Reservation_confirmer')}}
            </div>
            @endif
            @if(Session::has('prix_incorrect'))
            <div class="alert alert-danger">
                {{ Session::get('prix_incorrect')}}
            </div>
            @endif
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead class="thead-dark">
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">id</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Nom & Prenom de client</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Nom du service</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Prix de service</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Date de reservation</th>
                        <th class="text-center font-size-sm" style="width: 15%;">Ajoute</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $resaccepter as $resaccepter )
                    <tr>
                        <td class="text-center font-size-sm">{{$resaccepter->id}}</td>
                        <td class="font-w600 font-size-sm">
                            <div>{{$resaccepter->client->nom_user}} {{$resaccepter->client->prenom}}</div>
                            <div style="color: gray;">Telephone : {{$resaccepter->client->telephone}}</div>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resaccepter->service->nom_service}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resaccepter->service->prix}}</td>
                        <td class="text-center font-size-sm">{{$resaccepter->date}}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light js-tooltip-enabled"
                                    data-myIDcl="{{  $resaccepter->client->id }}"
                                    data-myIDserv="{{  $resaccepter->service->id }}" data-myId="{{$resaccepter->id}}"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal" data-toggle="tooltip"
                                    title="confirmer">
                                    <i class="fa fa-check-square fa-fw text-info" size="30px"></i>
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
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="text-align:centre">Êtes-vous sûr de confirmer
                    cette réservation ? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="display: block; margin-left: auto; margin-right: auto; ">
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="">
                    <input type="hidden" class="form-control" id="id1" name="client_id" value="">
                    <input type="hidden" class="form-control" id="id2" name="service_id" value="">
                    <img src="\images\images.png">
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Confirmer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
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
$('#exampleModal').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget);
    console.log('modal open');
    var Id = button.data('myid');
    var Idcl = button.data('myidcl');
    var Idserv = button.data('myidserv');
    console.log(Id);
    console.log(Idcl);
    console.log(Idserv);
    var modal = $(this);
    var rout = "{{ route('reservation.confirmer') }}";
    modal.find('.modal-body #id').val(Id);
    modal.find('.modal-body #id1').val(Idcl);
    modal.find('.modal-body #id2').val(Idserv);
    modal.find('.modal-body #form').attr('action', rout);
})
</script>
<script>
let bloc = document.getElementById("bloc");
let radio = document.getElementById("radio");
let m = document.getElementById("m");
var elt = document.querySelector('select');
console.log(document.getElementById('R1'))
bloc.style.display = "none";
elt.addEventListener('change', function() {
    console.log(this.options[this.selectedIndex].label);
    let option = this.options[this.selectedIndex].label;
    console.log(option);
    if (option == "En progress") {
        bloc.style.display = "block";
    } else if (option == "Annulé") {
        bloc.style.display = "none";
        m.style.display = "none"
    } else {
        bloc.style.display = "none";
        m.style.display = "block"
    }
    
})
</script>

@endsection