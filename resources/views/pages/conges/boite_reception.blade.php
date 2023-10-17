@extends('master')
@section('title','Boîte de récéption')

@section('contenu')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Boîte de réception(Congé)</h1>
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
                                            <th>Date</th>
                                            <th>Heure de départ</th>
                                            <th>Heure d'arrivé</th>
                                            <th>Durée</th>
                                            <th>Décision</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($conges) > 0)
                                            @foreach ($conges as $conge)
                                                <tr>
                                                    <td>{{ $conge->nom }} {{ $conge->prenom }}</td>
                                                    <td>{{ $conge->nom_prof }}</td>
                                                    <td>{{ $conge->type_conge }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($conge->date_debut)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($conge->date_fin)) }}</td>
                                                    <td>{{ $conge->duree_conge }} jours</td>
                                                    <td>
                                                        @if ($conge->decision  == "En attente")
                                                            <span class="right badge badge-warning">{{ $conge->decision }}</span>
                                                        @elseif ($conge->decision == "Accepter")
                                                            <span class="right badge badge-success">{{ $conge->decision }}</span>
                                                        @else
                                                            <span class="right badge badge-danger">{{ $conge->decision }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <button data-id="{{ $conge->id }}"
                                                            class="text-danger btn-xs mr-1 refuse_conge" title="Refuser"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-times"></i>
                                                        </button>

                                                        <button data-id="{{ $conge->id }}"
                                                            class="text-success btn-xs mr-1 accepte_conge" title="Accepter"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Aucune contrat</td>
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
            $('.refuse_conge').click(function(e) {
                e.preventDefault();

                $('.refuse_conge').attr('disabled', 'disabled')
                const idConge = $(this).data('id');
                var decision = "Refuser"

                $.ajax({
                    type: 'PUT',
                    url: '/decision_conge/' + idConge,
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

            $('.accepte_conge').click(function(e) {
                e.preventDefault();

                $('.accepte_conge').attr('disabled', 'disabled')
                const idConge = $(this).data('id');
                var decision = "Accepter"

                $.ajax({
                    type: 'PUT',
                    url: '/decision_conge/' + idConge,
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
