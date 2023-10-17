@extends('master')
@section('title', 'Conservation')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Employée conserver</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Employée conserver</li>
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
                                data-target="#addFormationEmployee">
                                <i class="fas fa-plus mr-2"></i>Employée conserver
                            </button>
                        </div>
                        <div class="card-tools" style="margin-top: 5px;">
                            <div class="input-group input-group-sm" style="width: 160px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Rechercher">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap" id="data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thème de la formation</th>
                                    <th>Date debut de la formation</th>
                                    <th>Date fin de la formation</th>
                                    <th>Employée</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($formation_employees) > 0)
                                    @foreach ($formation_employees as $formation_employee)
                                        @php
                                            $date_debut = new DateTime($formation_employee->date_debut);
                                            $date_fin = new DateTime($formation_employee->date_fin);
                                            $date_now = new DateTime();
                                            $diff = $date_fin->diff($date_now);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $formation_employee->theme_formation }}</td>
                                            <td>{{ date('d/m/Y', strtotime($formation_employee->date_debut)) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($formation_employee->date_fin)) }}</td>
                                            <td>{{ $formation_employee->nom }} {{ $formation_employee->prenom }}</td>
                                            <td>
                                                @if ($date_now >= $date_debut && $date_now <= $date_fin)
                                                    <span class="right badge badge-warning">En cours {{ $diff->days }}</span>
                                                @elseif ($date_now > $date_fin)
                                                    <span class="right badge badge-success">Terminé</span>
                                                @else
                                                    <span class="right badge badge-primary">Non commencé</span>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                <button class="text-danger btn-xs ml-1 suppFormationEmployee"
                                                    data-id="{{ $formation_employee->id }}" title="Supprimer"
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

    <div class="modal fade" id="addFormationEmployee" tabindex="-1" role="dialog" aria-labelledby="addFormationEmployeeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER EMPLOYEE CONSERVER</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="formation">Thème de formation</label>
                            <select class="form-control" id="formation">
                                <option hidden>Séléctionnez le formation</option>
                                @if (count($formations) > 0)
                                    @foreach ($formations as $formation)
                                        <option value="{{ $formation->id }}">{{ $formation->theme_formation }}</option>
                                    @endforeach
                                @else
                                    <option disabled>Aucune formation</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="employee">Immatriculation</label>
                            <select class="form-control" id="employee">
                                <option hidden>Séléctionnez l'immatriculation</option>
                                @if (count($employees) > 0)
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->immatriculation }}</option>
                                    @endforeach
                                @else
                                    <option disabled>Aucune immatriculation</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-5">
                            <label for="nom_employee">Nom d'employée <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nom_employee" disabled placeholder="Nom d'employée"/>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-primary btn-sm" id="ajoutFormationEmployee"><i
                                    class="fas fa-save mr-2"></i>Enregistrer</button>
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

            $('#employee_mod').on('change', function() {
                var selectedEmployeeId = $(this).val();

                if (selectedEmployeeId !== '') {
                    $.ajax({
                        url: '/get_employee/' + selectedEmployeeId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#nom_employee_mod').val(data.nom+' '+data.prenom);
                        },
                        error: function() {
                            console.log('Une erreur s\'est produite lors de la récupération du nom de l\'employé.');
                        }
                    });
                } else {
                    $('#nom_employee').val('');
                }
            });

            $("#ajoutFormationEmployee").click(function(e) {
                e.preventDefault();

                $('#ajoutFormationEmployee').attr('disabled', 'disabled')
                var formation = $('#formation').val();
                var employee = $('#employee').val();
                var date_debut = $('#date_debut').val();
                var date_fin = $('#date_fin').val();

                $.ajax({
                    url: "{{ route('formation_employee.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        formation: formation,
                        employee: employee,
                        date_debut: date_debut,
                        date_fin: date_fin,
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutFormationEmployee').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })
        })

        $('.suppFormationEmployee').on('click', function(e) {
            e.preventDefault();
            $('.suppFormationEmployee').attr('disabled', 'disabled')
            var id_formation_employee = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: '/formation_employee/' + id_formation_employee,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                },
                error: function(response) {
                    $('.suppFormationEmployee').removeAttr('disabled', 'disabled')
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
