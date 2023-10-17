@extends('master')
@section('title', 'Contrat')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contrat</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Contrat</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header px-lg-3 px-xs-1">
                                <div class="card-title">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                        data-target="#addContrat">
                                        <i class="fas fa-plus mr-2"></i>Nouveaux contrat
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>N° Contrat</th>
                                            <th>Immatriculation</th>
                                            <th>Nom</th>
                                            <th>Type de contrat</th>
                                            <th>Date de début</th>
                                            <th>Date de fin</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($contrats) > 0)
                                            @foreach ($contrats as $contrat)
                                                <tr>
                                                    <td>{{ $contrat->num_contrat }}</td>
                                                    <td>{{ $contrat->immatriculation }}</td>
                                                    <td>{{ $contrat->nom }} {{ $contrat->prenom }}</td>
                                                    <td>{{ $contrat->type_contrat }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($contrat->date_debut)) }}</td>
                                                    <td>
                                                        @if ($contrat->date_fin == '')
                                                            <span class="right badge badge-success">Indétérminé</span>
                                                        @else
                                                            {{ date('d/m/Y', strtotime($contrat->date_fin)) }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">

                                                        <button class="text-danger btn-xs ml-1 suppContrat"
                                                            data-id="{{ $contrat->id }}" title="Supprimer"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-trash"></i>
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
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <div class="modal fade" id="addContrat" tabindex="-1" role="dialog" aria-labelledby="addContratTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER NOUVEAUX CONTRAT</h3>
                <div class="modal-body p-4">
                    <div class="row mb-4">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="employee">Immatriculation</label>
                                <select class="form-control" id="employee">
                                    <option hidden>Séléctionnez l'immatriculation</option>
                                    @if (count($employees) > 0)
                                        @foreach ($employees as $employee)
                                            @php
                                                $employeeIsContrat = false;
                                                foreach ($contrats as $contrat) {
                                                    if ($contrat->employees_id == $employee->id) {
                                                        $employeeIsContrat = true;
                                                        break;
                                                    }
                                                }
                                            @endphp

                                            @if (!$employeeIsContrat)
                                                <option value="{{ $employee->id }}">{{ $employee->immatriculation }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option disabled>Aucune immatriculation</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="num_contrat">N° de contrat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="num_contrat" placeholder="Entrer le N° contrat"/>
                            </div>
                            <div class="form-group">
                                <label>Date de debut <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_debut"/>
                            </div>
                            <div class="form-group">
                                <label for="salaire">Salaire de base <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="salaire" placeholder="Entrer le responsabilité"/>
                            </div>
                            <div class="form-group">
                                <label for="heure_sem">heures/semaine <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="heure_sem" placeholder="Entrer le responsabilité"/>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom_employee">Nom d'employée <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom_employee" disabled placeholder="Nom d'employée"/>
                            </div>
                            <div class="form-group">
                                <label>Type contrat <span class="text-danger">*</span></label>
                                <select class="form-control" id="contrat">
                                    <option hidden>Séléctionnez le contrat</option>
                                    <option value="CDD">Contrat à Durée Déterminé</option>
                                    <option value="CDI">Contrat à Durée Indéterminé</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Date de fin <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_fin"/>
                            </div>
                            <div class="form-group">
                                <label for="jour_sem">jours/semaine <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="jour_sem" placeholder="Entrer le responsabilité"/>
                            </div>
                            <div class="form-group">
                                <label>Horaire <span class="text-danger">*</span></label>
                                <select class="form-control" id="horaire">
                                    <option hidden>Séléctionnez l'horaire</option>
                                    <option value="07:00 à 17:00">07:00 à 17:00</option>
                                    <option value="07:30 à 17:30">07:30 à 17:30</option>
                                    <option value="08:00 à 18:00">08:00 à 18:00</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="form-group d-flex justify-content-between mb-0">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                class="fas fa-times mr-2"></i>Annuler</button>
                        <button type="button" class="btn btn-primary btn-sm" id="ajoutContrat"><i
                                class="fas fa-save mr-2"></i>Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('page-script')
    <script>
        $(document).ready(function() {
            $('#num_contrat').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });

            $('#salaire').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
            $('#jour_sem').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
            $('#heure_sem').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });

            $('#employee').on('change', function() {
                var selectedEmployeeId = $(this).val();

                if (selectedEmployeeId !== '') {
                    $.ajax({
                        url: '/get_employee/' + selectedEmployeeId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#nom_employee').val(data.nom+' '+data.prenom);
                        },
                        error: function() {
                            console.log('Une erreur s\'est produite lors de la récupération du nom de l\'employé.');
                        }
                    });
                } else {
                    $('#nom_employee').val('');
                }
            });

            $('#contrat').on('change', function() {
                if($(this).val() == 'CDI') {
                    $('#date_fin').attr('disabled', 'disabled')
                }else{
                    $('#date_fin').removeAttr('disabled', 'disabled')
                }
            });

            $("#ajoutContrat").click(function(e) {
                e.preventDefault();

                $('#ajoutContrat').attr('disabled', 'disabled')
                var employee = $('#employee').val();
                var num_contrat = $('#num_contrat').val();
                var date_debut = $('#date_debut').val();
                var date_fin = $('#date_fin').val() !== '' ? $('#date_fin').val() : ''
                var salaire = $('#salaire').val();
                var heure_sem = $('#heure_sem').val();
                var jour_sem = $('#jour_sem').val();
                var type_contrat = $('#contrat').val();
                var horaire = $('#horaire').val();

                var data = {
                    _token: "{{ csrf_token() }}",
                    employee: employee,
                    num_contrat: num_contrat,
                    date_debut: date_debut,
                    salaire: salaire,
                    heure_sem: heure_sem,
                    jour_sem: jour_sem,
                    type_contrat: type_contrat,
                    horaire: horaire,
                };

                if (date_fin !== null) {
                    data.date_fin = date_fin;
                }

                $.ajax({
                    url: "{{ route('contrats.store') }}",
                    method: "POST",
                    data: data,
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutFormation').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })
        })

        $('.edit_formation').click(function(e) {
            e.preventDefault();
            const idFormation = $(this).data('id');

            $.get('/formations/' + idFormation + '/edit', function(data) {
                $('#id_mod').val(data.id);
                $('#theme_formation_mod').val(data.theme_formation);
                $('#specialite_mod').val(data.specialite);
                $('#date_debut_mod').val(data.date_debut);
                $('#date_fin_mod').val(data.date_fin);

                $('#editFormation').modal('show');
            });
        });

        $('#modifieFormation').click(function(e) {
            e.preventDefault();

            $('#modifieFormation').attr('disabled', 'disabled')
            var idFormation = $('#id_mod').val();
            var t_formation = $('#theme_formation_mod').val();
            var specialite = $('#specialite_mod').val();
            var date_debut = $('#date_debut_mod').val();
            var date_fin = $('#date_fin_mod').val();

            $.ajax({
                type: 'PUT',
                url: '/formations/' + idFormation,
                data: {
                    _token: "{{ csrf_token() }}",
                    theme_formation: t_formation,
                    specialite: specialite,
                    date_debut: date_debut,
                    date_fin: date_fin,
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                }
            });
        });

        $('.suppFormation').on('click', function(e) {
            e.preventDefault();
            $('.suppFormation').attr('disabled', 'disabled')
            var id_dir = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: '/formations/' + id_dir,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                },
                error: function(response) {
                    $('.suppFormation').removeAttr('disabled', 'disabled')
                }
            });
        });

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
