@extends('master')
@section('title', 'Mission')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mission des employées</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Mission des employée</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header px-lg-3 px-xs-1">
                        <div class="card-title">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                data-target="#addMission">
                                <i class="fas fa-plus mr-2"></i>Nouveaux missions
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titre de la mission</th>
                                    <th>Description</th>
                                    <th>Date départ</th>
                                    <th>Date fin</th>
                                    <th>Employée</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($missions) > 0)
                                    @foreach ($missions as $mission)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mission->titre }}</td>
                                            <td>{{ $mission->description }}</td>
                                            <td>{{ date('d/m/Y', strtotime($mission->date_debut)) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($mission->date_fin)) }}</td>
                                            <td>{{ $mission->nom }} {{ $mission->prenom }}</td>
                                            <td class="text-center">
                                                <button data-id="{{ $mission->id }}"
                                                    class="text-success btn-xs mr-1 edit_mission" title="Modifier"
                                                    style="border: none; background-color: white">
                                                    <i class="fas fa-pen"></i>
                                                </button>

                                                <button class="text-danger btn-xs ml-1 suppMission"
                                                    data-id="{{ $mission->id }}" title="Supprimer"
                                                    style="border: none; background-color: white">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune données enregistrer</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <div class="modal fade" id="addMission" tabindex="-1" role="dialog" aria-labelledby="addMissionTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER NOUVEAUX MISSION</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="titre">Titre</label>
                            <input type="text" id="titre" class="form-control"
                                placeholder="Entrer le titre de la mission">
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" rows="3" id="description" placeholder="Entrer la description"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="lieu_mission">Lieu</label>
                            <input type="text" id="lieu_mission" class="form-control"
                                placeholder="Entrer le lieu">
                        </div>
                        <div class="form-group mb-2">
                            <label>Date de début</label>
                            <input type="date" id="date_debut" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label>Date de fin</label>
                            <input type="date" id="date_fin" class="form-control">
                        </div>
                        <div class="form-group mb-5">
                            <label for="employee">Employée</label>
                            <select class="form-control" id="employee">
                                <option hidden>Séléctionnez l'employée</option>
                                @if (count($employees) > 0)
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->immatriculation }}</option>
                                    @endforeach
                                @else
                                    <option disabled>Aucune employée</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-primary btn-sm" id="ajoutMission"><i
                                    class="fas fa-save mr-2"></i>Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editMission" tabindex="-1" role="dialog" aria-labelledby="editeditMissionTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">MODIFIER UN INFORMATION</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <input type="hidden" id="id_mod" name="id_mod">
                        <div class="form-group mb-2">
                            <label for="titre_mod">Titre</label>
                            <input type="text" id="titre_mod" class="form-control"
                                placeholder="Entrer le titre de la mission">
                        </div>
                        <div class="form-group mb-2">
                            <label for="description_mod">Description</label>
                            <textarea class="form-control" rows="3" id="description_mod" placeholder="Entrer la description"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="lieu_mission_mod">Lieu</label>
                            <input type="text" id="lieu_mission_mod" class="form-control"
                                placeholder="Entrer le lieu">
                        </div>
                        <div class="form-group mb-2">
                            <label>Date de début</label>
                            <input type="date" id="date_debut_mod" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label>Date de fin</label>
                            <input type="date" id="date_fin_mod" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="employee_mod">Employée</label>
                            <select class="form-control" id="employee_mod">
                                <option hidden>Séléctionnez l'employée</option>
                                @if (count($employees) > 0)
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->immatriculation }}</option>
                                    @endforeach
                                @else
                                    <option disabled>Aucune employée</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-success btn-sm" id="modifieMission"><i
                                    class="fas fa-save mr-2"></i>Changer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('page-script')
    <script>
        $(document).ready(function() {
            $("#ajoutMission").click(function(e) {
                e.preventDefault();

                $('#ajoutMission').attr('disabled', 'disabled')
                var titre = $('#titre').val();
                var description = $('#description').val();
                var lieu_mission = $('#lieu_mission').val();
                var employee = $('#employee').val();
                var date_debut = $('#date_debut').val();
                var date_fin = $('#date_fin').val();

                $.ajax({
                    url: "{{ route('missions.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        titre: titre,
                        description: description,
                        lieu_mission: lieu_mission,
                        employee: employee,
                        date_debut: date_debut,
                        date_fin: date_fin,
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutMission').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })
        })

        $('.edit_mission').click(function(e) {
            e.preventDefault();
            const idMission = $(this).data('id');

            $.get('/missions/' + idMission + '/edit', function(data) {
                $('#id_mod').val(data.mission.id);
                $('#titre_mod').val(data.mission.titre);
                $('#description_mod').val(data.mission.description);
                $('#lieu_mission_mod').val(data.mission.lieu);
                $('#employee_mod').val(data.mission.employees_id);
                $('#date_debut_mod').val(data.mission.date_debut);
                $('#date_fin_mod').val(data.mission.date_fin);

                $('#editMission').modal('show');
            });
        });

        $('#modifieMission').click(function(e) {
            e.preventDefault();

            $('#modifieMission').attr('disabled', 'disabled')
            var idMission = $('#id_mod').val();
            var titre = $('#titre_mod').val();
            var description = $('#description_mod').val();
            var lieu_mission = $('#lieu_mission_mod').val();
            var employee = $('#employee_mod').val();
            var date_debut = $('#date_debut_mod').val();
            var date_fin = $('#date_fin_mod').val();

            $.ajax({
                type: 'PUT',
                url: '/missions/' + idMission,
                data: {
                    _token: "{{ csrf_token() }}",
                    titre: titre,
                    description: description,
                    lieu_mission: lieu_mission,
                    employee: employee,
                    date_debut: date_debut,
                    date_fin: date_fin,
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                }
            });
        });

        $('.suppMission').on('click', function(e) {
            e.preventDefault();
            $('.suppMission').attr('disabled', 'disabled')
            var idMission = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: '/missions/' + idMission,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                },
                error: function(response) {
                    $('.suppMission').removeAttr('disabled', 'disabled')
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
