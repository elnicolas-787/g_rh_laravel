@extends('master')
@section('title','Demande refuser')

@section('contenu')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Demande refuser</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Demande refuser</li>
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
                                            <th>Heure de départ</th>
                                            <th>Date d'arrivé</th>
                                            <th>Motif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($absences_data) > 0)
                                            @foreach ($absences_data as $absence)
                                                <tr>
                                                    <td>{{ $absence->immatriculation }}</td>
                                                    <td>{{ $absence->nom }} {{ $absence->prenom }}</td>
                                                    <td>{{ $absence->nom_prof }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($absence->date_debut)) }} à {{ $absence->heure_depart }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($absence->date_fin)) }} à {{ $absence->heure_arrive }}</td>
                                                    <td>{{ $absence->motif }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">Aucune demande refuser</td>
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
