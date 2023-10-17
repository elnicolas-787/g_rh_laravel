@extends('master')
@section('title','Congé')
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
                <h3 class="text-center mt-4" style="font-weight:bold">DEMANDE DE CONGE</h3>
                <div class="row justify-content-center mt-4">
                    <div class="col-12 p-3">
                        <div class="card">
                            <div class="card-header px-lg-3 px-xs-1">
                                <div class="card-title">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                        data-target="#addDemande">
                                        <i class="fas fa-plus mr-2"></i>Demande de congé
                                    </button>
                                </div>
                                @if (count($conges) > 0)
                                    <?php
                                        $dureeTotaleConges = 0;
                                    ?>
                                    @foreach ($conges as $conge)
                                        @if ($conge->decision == "Accepter" && $conge->type_conge == "Congé payé")
                                            <?php
                                                $dureeTotaleConges += $conge->duree_conge;
                                            ?>
                                        @endif
                                    @endforeach
                                    <div class="card-tools mr-1">
                                        <h5>Vous avez encore {{ 30 - $dureeTotaleConges }} jours de congé</h5>
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Type de congé</th>
                                            <th>Date de début</th>
                                            <th>Date de fin</th>
                                            <th>Duree</th>
                                            <th>Motif</th>
                                            <th>Statut</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($conges) > 0)
                                            @foreach ($conges as $conge)
                                                <tr>
                                                    <td>{{ $conge->immatriculation }}</td>
                                                    <td>{{ $conge->type_conge }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($conge->date_debut)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($conge->date_fin)) }}</td>
                                                    <td>{{ $conge->duree_conge }} jour(s)</td>
                                                    <td>{{ $conge->motif }}</td>
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
                                                        @if ($conge->decision  == "En attente")
                                                            <button data-id="{{ $conge->id }}"
                                                                class="text-success btn-xs mr-1 editConge" title="Modifier"
                                                                style="border: none; background-color: white">
                                                                <i class="fas fa-pen"></i>
                                                            </button>
                                                            <button class="text-danger btn-xs ml-1 suppConge"
                                                                data-id="{{ $conge->id }}" title="Supprimer"
                                                                style="border: none; background-color: white">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @else
                                                            <button data-id="{{ $conge->id }}"
                                                                class="text-success btn-xs mr-1 editConge" title="Modifier" disabled
                                                                style="border: none; background-color: white">
                                                                <i class="fas fa-pen"></i>
                                                            </button>
                                                            <button class="text-danger btn-xs ml-1 suppConge"
                                                                data-id="{{ $conge->id }}" title="Supprimer" disabled
                                                                style="border: none; background-color: white">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
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
                                <label>Durée de congé <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="duree_conge" disabled/>
                                <span class="error" id="errorconge"></span>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date de fin <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_fin"/>
                            </div>
                            <div class="form-group">
                                <label>Type de congé <span class="text-danger">*</span></label>
                                <select class="form-control" id="type_conge">
                                    <option hidden>Séléctionnez le type de congé</option>
                                    <option value="Congé matérnité">Congé matérnité</option>
                                    <option value="Congé payé">Congé payé</option>
                                </select>
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

    <div class="modal fade" id="editConge" tabindex="-1" role="dialog" aria-labelledby="editCongeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">MODIFICATION D'UN DEMANDE</h3>
                <div class="modal-body p-4">
                    <div class="row mb-4">
                        @csrf
                        <input type="number" class="form-control" hidden id="id_mod"/>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date de debut <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_debut_mod"/>
                            </div>
                            <div class="form-group">
                                <label>Durée de congé <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="duree_conge_mod" disabled/>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date de fin <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_fin_mod"/>
                            </div>
                            <div class="form-group">
                                <label>Type de congé <span class="text-danger">*</span></label>
                                <select class="form-control" id="type_conge_mod">
                                    <option hidden>Séléctionnez le type de congé</option>
                                    <option value="Congé matérnité">Congé matérnité</option>
                                    <option value="Congé payé">Congé payé</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.col -->
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

            $('#date_fin').change(function() {
                @if (count($conges) >= 0)
                    var dureeTotaleConges = 0;

                    @foreach ($conges as $conge)
                        @if ($conge->decision == "Accepter")
                            dureeTotaleConges += {{ $conge->duree_conge }};
                        @endif
                    @endforeach

                    var joursRestants = 30 - dureeTotaleConges;

                    var date_debut_conge = $('#date_debut').val();
                    var date_fin_conge = $('#date_fin').val();

                    if (date_debut_conge && date_fin_conge) {
                        var date_debut = new Date(date_debut_conge);
                        var date_fin = new Date(date_fin_conge);
                        var diff = Math.floor((date_fin.getTime() - date_debut.getTime()) / (1000 * 60 * 60 * 24));

                        if(diff > joursRestants) {
                            $('#duree_conge').val(diff)
                            document.getElementById('errorconge').innerHTML="Il vous reste "+joursRestants+" jour(s) de congés";
                            $('#ajoutDemande').attr('disabled', 'disabled')
                            return false;
                        }else{
                            $('#duree_conge').val(diff)
                            document.getElementById('errorconge').innerHTML="";
                            $('#ajoutDemande').removeAttr('disabled', 'disabled')
                        }
                    }
                @endif
            });

            $('#date_fin_mod').change(function() {
                @if (count($conges) > 0)
                    var dureeTotaleConges = 0;

                    @foreach ($conges as $conge)
                        @if ($conge->decision == "Accepter")
                            dureeTotaleConges += {{ $conge->duree_conge }};
                        @endif
                    @endforeach

                    var joursRestants = 30 - dureeTotaleConges;

                    var date_debut_conge = $('#date_debut_mod').val();
                    var date_fin_conge = $('#date_fin_mod').val();

                    if (date_debut_conge && date_fin_conge) {
                        var date_debut = new Date(date_debut_conge);
                        var date_fin = new Date(date_fin_conge);
                        {{-- date_fin.setDate(date_fin.getDate() + 1) --}}
                        var diff = Math.floor((date_fin.getTime() - date_debut.getTime()) / (1000 * 60 * 60 * 24));

                        if(diff > joursRestants) {
                            $('#duree_conge_mod').val(diff)
                            document.getElementById('errorconge').innerHTML="Il vous reste "+joursRestants+" jour(s) de congés";
                            $('#modifieDemande').attr('disabled', 'disabled')
                            return false;
                        }else{
                            $('#duree_conge_mod').val(diff)
                            document.getElementById('errorconge').innerHTML="";
                            $('#modifieDemande').removeAttr('disabled', 'disabled')
                        }
                    }
                @endif
            });

            $("#ajoutDemande").click(function(e) {
                e.preventDefault();

                $('#ajoutDemande').attr('disabled', 'disabled')
                var date_debut = $('#date_debut').val();
                var date_fin = $('#date_fin').val();
                var type_conge = $('#type_conge').val();
                var duree_conge = $('#duree_conge').val();
                var motif = $('#motif').val();

                $.ajax({
                    url: "{{ route('conges.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        date_debut: date_debut,
                        date_fin: date_fin,
                        type_conge: type_conge,
                        duree_conge: duree_conge,
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

            $('.editConge').click(function(e) {
                e.preventDefault();
                const idConge = $(this).data('id');

                $.get('/conges/' + idConge + '/edit', function(data) {
                    $('#id_mod').val(data.id);
                    $('#date_debut_mod').val(data.date_debut);
                    $('#date_fin_mod').val(data.date_fin);
                    $('#type_conge_mod').val(data.type_conge);
                    $('#duree_conge_mod').val(data.duree_conge);
                    $('#motif_mod').val(data.motif);

                    $('#editConge').modal('show');
                });
            });

            $("#modifieDemande").click(function(e) {
                e.preventDefault();

                $('#modifieDemande').attr('disabled', 'disabled')
                var idConge = $('#id_mod').val();
                var date_debut = $('#date_debut_mod').val();
                var date_fin = $('#date_fin_mod').val();
                var type_conge = $('#type_conge_mod').val();
                var duree_conge = $('#duree_conge_mod').val();
                var motif = $('#motif_mod').val();

                $.ajax({
                    type: 'PUT',
                    url: '/conges/' + idConge,
                    data: {
                        _token: "{{ csrf_token() }}",
                        date_debut: date_debut,
                        date_fin: date_fin,
                        duree_conge: duree_conge,
                        type_conge: type_conge,
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

            $('.suppConge').on('click', function(e) {
                e.preventDefault();
                $('.suppConge').attr('disabled', 'disabled')
                var id_conge = $(this).data('id');
                $.ajax({
                    type: 'DELETE',
                    url: '/conges/' + id_conge,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(response) {
                        $('.suppConge').removeAttr('disabled', 'disabled')
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
