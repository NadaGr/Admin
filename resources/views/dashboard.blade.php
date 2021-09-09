@extends('layouts.app')
@section('container')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-image overflow-hidden" style="background-image: url('assets/media/photos/photo3@2x.jpg');">
        <div class="bg-primary-dark-op">
            <div class="content content-narrow content-full">
                <div
                    class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Dashboard</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">
                            Welcome {{$admin->name}}</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-narrow">
        <!-- Stats -->
        <div class="row">
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h4 font-w600 text-uppercase text-muted"><i class="fas fa-users"
                                style="size:3x"></i> Clientes</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$client}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h4 font-w600 text-uppercase text-muted"><i class="fab fa-servicestack"
                                style="size:3x"></i> Services</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$service}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h4 font-w600 text-uppercase text-muted"><i class="fas fa-calendar-check"
                                style="size:3x"></i> Reservations Confirmées</div>
                        <div class="font-size-h2 font-w400 text-dark">{{$RC}}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h4 font-w600 text-uppercase text-muted"><i class="fas fa-dollar-sign"
                                style="size:3x"></i> Total</div>
                        <div class="font-size-h2 font-w400 text-dark">${{$sum}}</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content">
            <!-- Dynamic Table Full Pagination -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Etat de taritement</h3>
                </div>
                <div class="block-content block-content-full">

                    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table id="tableau"
                        class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                        <thead class="thead-dark">
                            <tr>
                                <th class="d-none d-sm-table-cell" style="width: 5%;">id</th>
                                <th class="d-none d-sm-table-cell" style="width: 25%;">Nom & Prenom de client</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Nom du service</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Date de Confirmation</th>
                                <th class="text-center font-size-sm" style="width: 15%;">Prochaine date de traitement
                                </th>
                                <th class="d-none d-sm-table-cell" style="width: 10%;">Montant payé</th>
                                <th class="d-none d-sm-table-cell" style="width: 25%; ">description</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Etat</th>
                                <th class="d-none d-sm-table-cell" style="width: 10%;">Montant restant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $etat as $resConfirmer )
                            <tr>
                                <td class="text-center font-size-sm">{{$resConfirmer->id}}</td>
                                <td class="font-w600 font-size-sm">
                                    <div>{{$resConfirmer->client->nom_user}} {{$resConfirmer->client->prenom}}</div>
                                    <div style="color: gray;">Telephone : {{$resConfirmer->client->telephone}}</div>
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->service->nom_service}}
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->updated_at}}</td>
                                <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->suivi->prochaine_date}}
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->suivi->montant}}</td>
                                <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->suivi->description}}
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm " id="t" style="color: #0000FF;">
                                    {{$resConfirmer->suivi->etat}}
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm">
                                    {{$resConfirmer->suivi->montant_restant}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full Pagination -->
        </div>
     <!-- Page Content -->
        <!-- END Page Content -->
        <div class="content">
            <!-- Dynamic Table Full Pagination -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Liste des Reservations Acceptée</h3>
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                        <thead class="thead-dark">
                            <tr>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">id</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Nom & Prenom de client</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Nom du service</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Prix de service</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Date de reservation</th>
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
                                <td class="d-none d-sm-table-cell font-size-sm">{{$resaccepter->service->nom_service}}
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm">{{$resaccepter->service->prix}}</td>
                                <td class="text-center font-size-sm">{{$resaccepter->date}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full Pagination -->
        </div>
        @endsection
        @section('scripts')
        
        @endsection