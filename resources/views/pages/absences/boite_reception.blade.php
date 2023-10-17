@extends('master')
@section('title','Boîte de récéption')

@section('contenu')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Boîte de réception(Absence)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Boîte réception</li>
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
                                            <th>Nom</th>
                                            <th>Profession</th>
                                            <th>Date de début</th>
                                            <th>Date de fin</th>
                                            <th>Décision</th>
                                            <th>Motif</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($absences) > 0)
                                            @foreach ($absences as $absence)
                                                <tr>
                                                    <td>{{ $absence->nom }} {{ $absence->prenom }}</td>
                                                    <td>{{ $absence->nom_prof }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($absence->date_debut)) }} à {{ $absence->heure_depart }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($absence->date_fin)) }} à {{ $absence->heure_arrive }}</td>
                                                    <td>{{ $absence->motif }}</td>
                                                    <td>
                                                        @if ($absence->decision  == "En attente")
                                                            <span class="right badge badge-warning">{{ $absence->decision }}</span>
                                                        @elseif ($absence->decision == "Accepter")
                                                            <span class="right badge badge-success">{{ $absence->decision }}</span>
                                                        @else
                                                            <span class="right badge badge-danger">{{ $absence->decision }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <button data-id="{{ $absence->id }}"
                                                            class="text-danger btn-xs mr-1 refuse_absence" title="Refuser"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-times"></i>
                                                        </button>

                                                        <button data-id="{{ $absence->id }}"
                                                            class="text-success btn-xs mr-1 accepte_absence" title="Accepter"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center">Aucune demande</td>
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
    <script>
        $(document).ready(function () {
            $('.refuse_absence').click(function(e) {
                e.preventDefault();

                $('.refuse_absence').attr('disabled', 'disabled')
                const idAbsence = $(this).data('id');
                var decision = "Refuser"

                $.ajax({
                    type: 'PUT',
                    url: '/decision_absence/' + idAbsence,
                    data: {
                        _token: "{{ csrf_token() }}",
                        decision: decision
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    }
                });
            });

            $('.accepte_absence').click(function(e) {
                e.preventDefault();

                $('.accepte_absence').attr('disabled', 'disabled')
                const idAbsence = $(this).data('id');
                var decision = "Accepter"

                $.ajax({
                    type: 'PUT',
                    url: '/decision_absence/' + idAbsence,
                    data: {
                        _token: "{{ csrf_token() }}",
                        decision: decision
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    }
                });
            });
        });
    </script>
@endpush
