@extends('master')
@section('title','Demande accepter')

@section('contenu')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Demande accepter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Demande accepter</li>
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
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Nom</th>
                                            <th>Profession</th>
                                            <th>Type de congé</th>
                                            <th>Date de début</th>
                                            <th>Date de fin</th>
                                            <th>Durée</th>
                                            <th>Motif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($conges_data) > 0)
                                            @foreach ($conges_data as $conge)
                                                <tr>
                                                    <td>{{ $conge->immatriculation }}</td>
                                                    <td>{{ $conge->nom }} {{ $conge->prenom }}</td>
                                                    <td>{{ $conge->nom_prof }}</td>
                                                    <td>{{ $conge->type_conge }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($conge->date_debut)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($conge->date_fin)) }}</td>
                                                    <td>{{ $conge->duree_conge }} jours</td>
                                                    <td>{{ $conge->motif }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Aucune demande accepter</td>
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
