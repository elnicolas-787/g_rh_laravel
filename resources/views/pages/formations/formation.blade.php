@extends('master')
@section('title', 'Formation')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Formation</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Formation</li>
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
                                data-target="#addFormation">
                                <i class="fas fa-plus mr-2"></i>Nouveaux formation
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-head-fixed text-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thème de la formation</th>
                                    <th>Objectif de la formation</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Lieu de la formation</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($formations) > 0)
                                    @foreach ($formations as $formation)
                                        @php
                                            $date_debut = new DateTime($formation->date_debut);
                                            $date_fin = new DateTime($formation->date_fin);
                                            $date_now = new DateTime();
                                            $diff = $date_fin->diff($date_now);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $formation->theme_formation }}</td>
                                            <td>{{ date('d/m/Y', strtotime($formation->date_debut)) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($formation->date_fin)) }}</td>
                                            <td>{{ $formation->specialite }}</td>
                                            <td>{{ $formation->lieu_formation }}</td>
                                            <td>
                                                @if ($date_now >= $date_debut && $date_now <= $date_fin)
                                                    <span class="right badge badge-warning">En cours</span>
                                                @elseif ($date_now > $date_fin)
                                                    <span class="right badge badge-success">Terminé</span>
                                                @else
                                                    <span class="right badge badge-primary">Non commencé</span>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                <button data-id="{{ $formation->id }}"
                                                    class="text-success btn-xs mr-1 edit_formation" title="Modifier"
                                                    style="border: none; background-color: white">
                                                    <i class="fas fa-pen"></i>
                                                </button>

                                                <button class="text-danger btn-xs ml-1 suppFormation"
                                                    data-id="{{ $formation->id }}" title="Supprimer"
                                                    style="border: none; background-color: white">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune formation</td>
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

    <div class="modal fade" id="addFormation" tabindex="-1" role="dialog" aria-labelledby="addFormationTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER NOUVEAUX FORMATION</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="theme_formation">Thème de formation</label>
                            <input type="text" id="theme_formation" class="form-control"
                                placeholder="Entrer le thème de formation">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label>Date de début</label>
                                    <input type="date" id="date_debut" class="form-control"
                                        placeholder="Entrer le lieu de formation">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label>Date de fin</label>
                                    <input type="date" id="date_fin" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="lieu_formation">Lieu de formation</label>
                            <input type="text" id="lieu_formation" class="form-control"
                                placeholder="Entrer le thème de formation">
                        </div>
                        <div class="form-group mb-5">
                            <label for="specialite">Objectif</label>
                            <textarea class="form-control" rows="3" id="specialite" placeholder="Entrer l'objectif de la formation"></textarea>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-primary btn-sm" id="ajoutFormation"><i
                                    class="fas fa-save mr-2"></i>Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editFormation" tabindex="-1" role="dialog" aria-labelledby="editFormationTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">MODIFIER UN FORMATION</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <input type="hidden" id="id_mod" name="id_mod">
                        <div class="form-group mb-2">
                            <label for="theme_formation_mod">Thème de formation</label>
                            <input type="text" id="theme_formation_mod" class="form-control"
                                placeholder="Entrer le thème de formation">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label>Date de début</label>
                                    <input type="date" id="date_debut_mod" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label>Date de fin</label>
                                    <input type="date" id="date_fin_mod" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="specialite_mod">Lieu de formation</label>
                            <input type="text" id="lieu_formation_mod" class="form-control"
                                placeholder="Entrer le lieu de formation">
                        </div>
                        <div class="form-group mb-2">
                            <label for="specialite_mod">Spécialité</label>
                            <textarea class="form-control" rows="3" id="specialite_mod" placeholder="Entrer l'objectif de la formation"></textarea>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-success btn-sm" id="modifieFormation"><i
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
            $("#ajoutFormation").click(function(e) {
                e.preventDefault();

                $('#ajoutFormation').attr('disabled', 'disabled')
                var t_formation = $('#theme_formation').val();
                var date_debut = $('#date_debut').val();
                var date_fin = $('#date_fin').val();
                var specialite = $('#specialite').val();
                var lieu_formation = $('#lieu_formation').val();

                $.ajax({
                    url: "{{ route('formations.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        theme_formation: t_formation,
                        date_debut: date_debut,
                        date_fin: date_fin,
                        specialite: specialite,
                        lieu_formation: lieu_formation,
                    },
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

        $('.edit_formation').click(function(e){
            e.preventDefault();
            const idFormation = $(this).data('id');

            $.get('/formations/' + idFormation + '/edit', function(data) {
                $('#id_mod').val(data.id);
                $('#theme_formation_mod').val(data.theme_formation);
                $('#date_debut_mod').val(data.date_debut);
                $('#date_fin_mod').val(data.date_fin);
                $('#specialite_mod').val(data.specialite);
                $('#lieu_formation_mod').val(data.lieu_formation);

                $('#editFormation').modal('show');
            });
        })

        $('#modifieFormation').click(function(e) {
            e.preventDefault();

            $('#modifieFormation').attr('disabled', 'disabled')
            var idFormation = $('#id_mod').val();
            var t_formation = $('#theme_formation_mod').val();
            var date_debut = $('#date_debut_mod').val();
            var date_fin = $('#date_fin_mod').val();
            var specialite = $('#specialite_mod').val();
            var lieu_formation = $('#lieu_formation_mod').val();

            $.ajax({
                type: 'PUT',
                url: '/formations/' + idFormation,
                data: {
                    _token: "{{ csrf_token() }}",
                    theme_formation: t_formation,
                    date_debut: date_debut,
                    date_fin: date_fin,
                    specialite: specialite,
                    lieu_formation: lieu_formation,
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
            var id_formation = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: '/formations/' + id_formation,
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
