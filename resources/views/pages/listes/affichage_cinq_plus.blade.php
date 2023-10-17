@extends('master')
@section('title','Demande accepter')

@section('contenu')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste des employées plus de 5 ans de service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">listes</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary btn-sm" id="btnExport" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Export Report</button>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>IM</th>
                                            <th>CIN</th>
                                            <th>Nom</th>
                                            <th>Profession</th>
                                            <th>Type de contrat</th>
                                            <th>Date de début</th>
                                            <th>Date de fin</th>
                                            <th>Salaire de base</th>
                                            <th>Téléphone</th>
                                            <th>Email</th>
                                            <th>Adresse</th>
                                            <th>Date naissance</th>
                                            <th>Lieu de naissance</th>
                                            <th>Sexe</th>
                                            <th>Situation familiale</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($contrats) > 0)
                                            @foreach ($contrats as $contrat)
                                                <tr>
                                                    <td class="text"><img src="{{ asset('images/' . $contrat->photo) }}"
                                                            alt="Photo de l'employé" width="40" height="40"
                                                            style="border-radius:50%"></td>
                                                    <td class="text">{{ $contrat->immatriculation }}</td>
                                                    <td class="text">{{ $contrat->cin }}</td>
                                                    <td class="text">{{ $contrat->nom }} {{ $contrat->prenom }}</td>
                                                    <td class="text">{{ $contrat->nom_prof }}</td>
                                                    <td class="text">{{ $contrat->type_contrat }}</td>
                                                    <td class="text">{{ date('d/m/Y', strtotime($contrat->date_debut)) }}</td>
                                                    <td class="text">
                                                        @if ($contrat->date_fin != '')
                                                            {{ date('d/m/Y', strtotime($contrat->date_fin)) }}
                                                        @else
                                                            <span class="right badge badge-success">Indétérminé</span>
                                                        @endif
                                                    </td>
                                                    <td class="text">{{ $contrat->salaire }} Ar</td>
                                                    <td class="text">{{ $contrat->telephone }}</td>
                                                    <td class="text">{{ $contrat->email }}</td>
                                                    <td class="text">{{ $contrat->adresse }}</td>
                                                    <td class="text">{{ date('d/m/Y', strtotime($contrat->date_naiss)) }}</td>
                                                    <td class="text">{{ $contrat->lieu_naiss }}</td>
                                                    <td class="text">{{ $contrat->sexe }}</td>
                                                    <td class="text">{{ $contrat->situation_f }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Aucune employée</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('page-script')
    <script src="{{ asset('dist/js/jszip.min.js') }}"></script>
    <script src="{{ asset('dist/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dist/js/tableToExcel.js') }}"></script>
    <script src="{{ asset('dist/js/jspdf.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#example1").dataTable({
                retrieve: true,
            });

            $("#btnExport").click(function () {
                let table = document.getElementsByTagName("table");
                console.log(table);
                debugger;
                TableToExcel.convert(table[0], {
                    name: `employee_cinq_plus.xlsx`,
                    sheet: {
                        name: 'employee_cinq_plus'
                    }
                });
            });

            {{-- $("#btnExport").click(function () {
                var pdf = new jsPDF('p', 'pt', 'letter');
                source = $('#example1')[0];

                specialElementHandlers = {
                    '#bypassme': function (element, renderer) {
                        return true
                    }
                };
                margins = {
                    top: 80,
                    bottom: 60,
                    left: 10,
                    width: 700
                };

                pdf.fromHTML(
                source,
                margins.left,
                margins.top, {
                    'width': margins.width,
                    'elementHandlers': specialElementHandlers
                },

                function (dispose) {
                    pdf.save('Test.pdf');
                }, margins);
            }) --}}
        })
    </script>
@endpush
