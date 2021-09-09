@extends('layouts.app')
@section('container')
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <table class="table table-striped table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 45%;">Service & traitement</th>
                        <th class="d-none d-lg-table-cell text-center" style="width: 15%;">Statut</th>
                        <th style="width: 25%;">Date de traitement</th>
                        <th class="text-center" style="width: 15%;">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h4 class="h5 mt-3 mb-2">
                                <a href="javascript:void(0)">nom de service</a>
                            </h4>
                            <p class="d-none d-sm-block text-muted">
                                discription de traitement.
                            </p>
                        </td>
                        <td class="d-none d-lg-table-cell text-center">
                            <span class="badge badge-success">Completed</span>
                        </td>
                        <td class="d-none d-lg-table-cell font-size-xl text-center font-w600">13/02/2022</td>
                        <td class="font-size-xl text-center font-w600">$ 35,287</td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td class="d-none d-lg-table-cell text-center">
                        </td>
                        <td class="d-none d-lg-table-cell font-size-xl text-center font-w600"></td>
                        <td class="font-size-xl text-center font-w600"></td>
                    </tr>
                </tbody>
            </table>
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
                        <a class="link-fx" href="">Liste des Reservations Confirmées</a>
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
            
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table id="tableau" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead class="thead-dark">
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width: 5%;">id</th>
                        <th class="d-none d-sm-table-cell" style="width: 25%;">Nom & Prenom de client</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Nom du service</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Date de Confirmation</th>
                        <th class="text-center font-size-sm" style="width: 15%;">Prochaine date de traitement</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Montant payé</th>
                        <th class="d-none d-sm-table-cell" style="width: 25%; ">description</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Etat</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Montant restant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $resConfirmer as $resConfirmer )
                    <tr>
                        <td class="text-center font-size-sm">{{$resConfirmer->id}}</td>
                        <td class="font-w600 font-size-sm">
                            <div>{{$resConfirmer->client->nom_user}} {{$resConfirmer->client->prenom}}</div>
                            <div style="color: gray;">Telephone : {{$resConfirmer->client->telephone}}</div>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->service->nom_service}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->updated_at}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->suivi->prochaine_date}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->suivi->montant}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->suivi->description}}</td>
                        <td class="d-none d-sm-table-cell font-size-sm " id="t" style="color: #0000FF;">{{$resConfirmer->suivi->etat}}
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">{{$resConfirmer->suivi->montant_restant}}</td>

                    </tr>
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
$('modal').modal('show')
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
var table = document.getElementsByTagName('table')[1];
var tr = table.getElementsByTagName('tr');
console.log(tr[2].cells[7].innerText);
console.log(tr);
for (var j = 1; j < tr.length + 1; j++) {

    if ((tr[j].cells[7].innerText) == "progress") {
        (tr[j].cells[7].innerText).style.color= '#00FF00';
    } else if ((tr[j].cells[7].innerText) == "terminé") {
        (tr[j].cells[7].innerText).style.color = "green";
    } else {
        (tr[j].cells[7].innerText).style.color = "red";
    }
    console.log(tr[j].cells[7].innerText);
}

$('#tableau tr').each(function() {
    let identifiant = $(this).find(t)
.html(); //L'index 0 permet de récupérer le contenu de la première cellule de la ligne

    console.log(identifiant.length);
});
</script>
@endsection
















<!-- let tableau = document.getElementById("tableau");
// console.log(document.getElementById("tableau").textContent);
 let text = document.getElementById("t").textContent;
console.log(text);
// //console.log(tableau[1].innerText);
// let line = tableau[1].innerHTML;
// //console.log(line.innerText);
// for (var j = 0; j < line.length; j++) {
//     //console.log(line[j]);
// }
// $('#tableau tr').each(function() {
// var identifiant = $(this).findById(t).eq(0).html(); //L'index 0 permet de récupérer le contenu de la première cellule de la ligne
// console.log(identifiant);
// });
function changecouleur(text) {
    console.log(text)
        if (text == "progress") {
            text.style.Color = "orange";
        } else if (text == "terminé") {
            text.style.Color = "green";
        } else {
            text.style.Color = "red";
        }
    } -->