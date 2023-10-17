@extends('master')
@section('title','Absence')
@push('page-style')
    <style>
        .error{
            color: #D8000C;
         }
    </style>
@endpush

@section('contenu')
    <div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <h3 class="text-center mt-4" style="font-weight:bold">DEMANDE D'ABSENCE</h3>
                <div class="row justify-content-center mt-4">
                    <div class="col-12 p-3">
                        <div class="card">
                            <div class="card-header px-lg-3 px-xs-1">
                                <div class="card-title">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                        data-target="#addDemande">
                                        <i class="fas fa-plus mr-2"></i>Demande d'absence
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Date de départ</th>
                                            <th>Date d'arrivé</th>
                                            <th>Motif</th>
                                            <th>Statut</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($absences) > 0)
                                            @foreach ($absences as $absence)
                                                <tr>
                                                    <td>{{ $absence->immatriculation }}</td>
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
                                                        @if ($absence->decision  == "En attente")
                                                            <button data-id="{{ $absence->id }}"
                                                                class="text-success btn-xs mr-1 editAbsence" title="Modifier"
                                                                style="border: none; background-color: white">
                                                                <i class="fas fa-pen"></i>
                                                            </button>
                                                            <button class="text-danger btn-xs ml-1 suppAbsence"
                                                                data-id="{{ $absence->id }}" title="Supprimer"
                                                                style="border: none; background-color: white">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @else
                                                            <button data-id="{{ $absence->id }}"
                                                                class="text-success btn-xs mr-1 editAbsence" title="Modifier" disabled
                                                                style="border: none; background-color: white">
                                                                <i class="fas fa-pen"></i>
                                                            </button>
                                                            <button class="text-danger btn-xs ml-1 suppAbsence"
                                                                data-id="{{ $absence->id }}" title="Supprimer" disabled
                                                                style="border: none; background-color: white">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">Aucune demande</td>
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
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <div class="modal fade" id="addDemande" tabindex="-1" role="dialog" aria-labelledby="addDemandeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">CREER UNE NOUVELLE DEMANDE</h3>
                <div class="modal-body p-4">
                    <div class="row mb-4">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date de debut <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_debut"/>
                            </div>
                            <div class="form-group">
                                <label>Heure de départ <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="heure_depart"/>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date de fin <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_fin"/>
                            </div>
                            <div class="form-group">
                                <label>Heure d'arrivé <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="heure_arrive"/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="motif">Motif(optionnelle) <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="3" id="motif" placeholder="Entrer le motif"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between mb-0">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                class="fas fa-times mr-2"></i>Annuler</button>
                        <button type="button" class="btn btn-primary btn-sm" id="ajoutDemande"><i
                                class="fas fa-save mr-2"></i>Demander</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAbsence" tabindex="-1" role="dialog" aria-labelledby="editAbsenceTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">MODIFICATION D'UN DEMANDE</h3>
                <div class="modal-body p-4">
                    <div class="row mb-4">
                        @csrf
                        <input type="number" class="form-control" id="id_mod" name="id_mod" hidden>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date de debut <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_debut_mod"/>
                            </div>
                            <div class="form-group">
                                <label>Heure de départ <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="heure_depart_mod"/>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date de fin <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_fin_mod"/>
                            </div>
                            <div class="form-group">
                                <label>Heure d'arrivé <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="heure_arrive_mod"/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="motif">Motif(optionnelle) <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="3" id="motif_mod" placeholder="Entrer le motif"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between mb-0">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                class="fas fa-times mr-2"></i>Annuler</button>
                        <button type="button" class="btn btn-primary btn-sm" id="modifieDemande"><i
                                class="fas fa-save mr-2"></i>Changer le demande</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script>
        $(document).ready(function() {
            const date = new Date().toJSON().slice(0,10);
            $('#date_debut').val(date);
            $('#date_fin').val(date);
            document.getElementById("date_debut").min = date;
            document.getElementById("date_fin").min = date;
            document.getElementById("date_debut_mod").min = date;
            document.getElementById("date_fin_mod").min = date;

            $("#ajoutDemande").click(function(e) {
                e.preventDefault();

                $('#ajoutDemande').attr('disabled', 'disabled')
                var date_debut = $('#date_debut').val();
                var date_fin = $('#date_fin').val();
                var heure_depart = $('#heure_depart').val();
                var heure_arrive = $('#heure_arrive').val();
                var motif = $('#motif').val();

                $.ajax({
                    url: "{{ route('absences.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        date_debut: date_debut,
                        date_fin: date_fin,
                        heure_depart: heure_depart,
                        heure_arrive: heure_arrive,
                        motif: motif,
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutDemande').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })

            $('.editAbsence').click(function(e) {
                e.preventDefault();
                const idAbsence = $(this).data('id');

                $.get('/absences/' + idAbsence + '/edit', function(data) {
                    $('#id_mod').val(data.id);
                    $('#date_debut_mod').val(data.date_debut);
                    $('#date_fin_mod').val(data.date_fin);
                    $('#heure_depart_mod').val(data.heure_depart);
                    $('#heure_arrive_mod').val(data.heure_arrive);
                    $('#motif_mod').val(data.motif);

                    $('#editAbsence').modal('show');
                });
            });

            $("#modifieDemande").click(function(e) {
                e.preventDefault();

                $('#modifieDemande').attr('disabled', 'disabled')
                var idAbsence = $('#id_mod').val();
                var date_debut = $('#date_debut_mod').val();
                var date_fin = $('#date_fin_mod').val();
                var heure_depart = $('#heure_depart_mod').val();
                var heure_arrive = $('#heure_arrive_mod').val();
                var motif = $('#motif_mod').val();

                $.ajax({
                    type: 'PUT',
                    url: '/absences/' + idAbsence,
                    data: {
                        _token: "{{ csrf_token() }}",
                        date_debut: date_debut,
                        date_fin: date_fin,
                        heure_depart: heure_depart,
                        heure_arrive: heure_arrive,
                        motif: motif,
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#modifieDemande').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })

            $('.suppAbsence').on('click', function(e) {
                e.preventDefault();
                $('.suppAbsence').attr('disabled', 'disabled')
                var id_absence = $(this).data('id');
                $.ajax({
                    type: 'DELETE',
                    url: '/absences/' + id_absence,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(response) {
                        $('.suppAbsence').removeAttr('disabled', 'disabled')
                    }
                });
            });
        })

        function verifie_pageReload() {
            const actualiser = localStorage.getItem('actualiser');
            const message = localStorage.getItem('message');

            if (performance.navigation.type === 1 && message) {
                const response = JSON.parse(message);
                toastr.success(response.message);

                localStorage.removeItem('message');
            }

        }

        verifie_pageReload();
    </script>
@endpush
