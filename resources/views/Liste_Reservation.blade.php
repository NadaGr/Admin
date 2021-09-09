@extends('layouts.app')
@section('container')
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Si vous souhaitez modifier la date de cette
                    réservation, sinon vous devez accepter la date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="">
                    <input type="hidden" class="form-control" id="id1" name="client_id" value="">
                    <input type="hidden" class="form-control" id="id2" name="service_id" value="">
                    <div class="mb-3">
                        <label for="dateRes" class="col-form-label">Date:</label>
                        <input type="datetime-local" class="form-control" id="dateRes" name="date" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Accepter</button>
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
                        <a class="link-fx" href="">Liste des Reservations</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Dynamic Table Full Pagination -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Liste des Reservations</h3>
        </div>
        <div class="block-content block-content-full">
            @if(Session::has('Reservation_Aceptée'))
            <div class="alert alert-success">
                {{ Session::get('Reservation_Aceptée')}}
            </div>
            @endif
            @if(Session::has('Reservation_Supprimer'))
            <div class="alert alert-success">
                {{ Session::get('Reservation_Supprimer')}}
            </div>
            @endif
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead class="thead-dark">
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">id</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Nom & Prenom de client</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Nom du service</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Date de reservation</th>
                        <th class="text-center font-size-sm" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $resC as $resC )
                    <tr>
                        <!--<input type="hidden" class="delete_val" value="{{$resC->id}}">-->
                        <td class="text-center font-size-sm">{{$resC->id}}</td>
                        <td class="font-w600 font-size-sm">
                            <div>{{$resC->client->nom_user}} {{$resC->client->prenom}}</div>
                            <div style="color: gray;">Telephone : {{$resC->client->telephone}}</div>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resC->service->nom_service}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resC->date}}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light js-tooltip-enabled"
                                    data-myIDcl="{{  $resC->client->id }}" data-myIDserv="{{  $resC->service->id }}"
                                    data-myDR="{{ $resC->date }}" data-myId="{{$resC->id}}" data-toggle="modal"
                                    data-target="#exampleModalCenter" data-toggle="tooltip" title="Accepter">
                                    <i class="fa fa-check fa-fw text-secondary"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light js-tooltip-enabled " data-myIDcl="{{  $resC->client->id }}" data-myIDserv="{{  $resC->service->id }}"
                                        data-myId="{{$resC->id}}" data-toggle="modal" data-target="#delete" data-toggle="tooltip"
                                        title="Supprimer">
                                        <i class="fa fa-fw fa-times text-danger"></i>
                                    </button>

                                </div>
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
<!-- END Page Content -->

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                        <button type="submit" class="btn btn-success">Supprimer</button>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
$('#delete').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget);
    console.log('modal open');
    var Id = button.data('myid');
    var Idcl = button.data('myidcl');
    var Idserv = button.data('myidserv');
    console.log(Id);
    console.log(Idcl);
    console.log(Idserv);
    var modal = $(this);
    var rout = "{{ route('reservation.refuser') }}";
    modal.find('.modal-body #id').val(Id);
    modal.find('.modal-body #id1').val(Idcl);
    modal.find('.modal-body #id2').val(Idserv);
    modal.find('.modal-body #form').attr('action', rout);
})
</script>
<script>
$('#exampleModalCenter').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget);
    console.log('modal open');
    var Id = button.data('myid');
    var Idcl = button.data('myidcl');
    var Idserv = button.data('myidserv');
    var Dres = button.data('mydr');
    var year = Dres.substr(0, 10);
    var time = Dres.substr(11, 15);
    var dataTime=year+"T"+time;
    console.log(Dres);
    console.log(year);
    console.log(time);
    console.log(dataTime);
    var modal = $(this);
    var rout = "{{ route('reservation.accepter') }}";
    modal.find('.modal-body #form').attr('action', rout);
    modal.find('.modal-body #id').val(Id);
    modal.find('.modal-body #id1').val(Idcl);
    modal.find('.modal-body #id2').val(Idserv);
    modal.find('.modal-body #dateRes').val(dataTime);
    
})
</script>
@endsection