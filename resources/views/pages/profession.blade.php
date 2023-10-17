@extends('master')
@section('title', 'Profession')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profession</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Profession</li>
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
                                        data-target="#addProfession">
                                        <i class="fas fa-plus mr-2"></i>Nouveaux profession
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code profession</th>
                                            <th>Nom profession</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($professions) > 0)
                                            @foreach ($professions as $profession)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $profession->code_prof }}</td>
                                                    <td>{{ $profession->nom_prof }}</td>
                                                    <td class="text-center">
                                                        <button data-id="{{ $profession->id }}"
                                                            class="text-success btn-xs mr-1 edit_profession" title="Modifier"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-pen"></i>
                                                        </button>

                                                        <button class="text-danger btn-xs ml-1 suppProfession"
                                                            data-id="{{ $profession->id }}" title="Supprimer"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Aucune profession</td>
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

    <div class="modal fade" id="addProfession" tabindex="-1" role="dialog" aria-labelledby="addProfessionTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER NOUVEAUX PROFESSION</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="code_prof">Code profession</label>
                            <input type="text" id="code_prof" class="form-control"
                                placeholder="Entrer le code profession">
                        </div>
                        <div class="form-group mb-5">
                            <label for="nom_prof">Nom profession</label>
                            <input type="text" id="nom_prof" class="form-control" placeholder="Entrer le nom profession">
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-primary btn-sm" id="ajoutProfession"><i
                                    class="fas fa-save mr-2"></i>Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfession" tabindex="-1" role="dialog" aria-labelledby="editProfessionTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">MODIFIER UN PROFESSION</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <input type="hidden" id="id_mod" name="id_mod">
                        <div class="form-group mb-2">
                            <label for="code_prof_mod">Code profession</label>
                            <input type="text" id="code_prof_mod" class="form-control">
                        </div>
                        <div class="form-group mb-5">
                            <label for="nom_prof_mod">Nom profession</label>
                            <input type="text" id="nom_prof_mod" class="form-control">
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-success btn-sm" id="modifieProfession"><i
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
            $("#ajoutProfession").click(function(e) {
                e.preventDefault();

                $('#ajoutProfession').attr('disabled', 'disabled')
                var codeProf = $('#code_prof').val();
                var nomProf = $('#nom_prof').val();

                $.ajax({
                    url: "{{ route('professions.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code_prof: codeProf,
                        nom_prof: nomProf
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutProfession').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })
        })

        $('.edit_profession').click(function(e) {
            e.preventDefault();
            const idProfession = $(this).data('id');

            $.get('/professions/' + idProfession + '/edit', function(data) {
                $('#id_mod').val(data.id);
                $('#code_prof_mod').val(data.code_prof);
                $('#nom_prof_mod').val(data.nom_prof);

                $('#editProfession').modal('show');
            });
        });

        $('#modifieProfession').click(function(e) {
            e.preventDefault();

            $('#modifieProfession').attr('disabled', 'disabled')
            var idProf = $('#id_mod').val();
            var codeProf = $('#code_prof_mod').val();
            var nomProf = $('#nom_prof_mod').val();

            $.ajax({
                type: 'PUT',
                url: '/professions/' + idProf,
                data: {
                    _token: "{{ csrf_token() }}",
                    code_prof: codeProf,
                    nom_prof: nomProf
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                }
            });
        });

        $('.suppProfession').on('click', function(e) {
            e.preventDefault();
            $('.suppProfession').attr('disabled', 'disabled')
            var id_prof = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: '/professions/' + id_prof,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                },
                error: function(response) {
                    $('.suppDirection').removeAttr('disabled', 'disabled')
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
