@extends('master')
@section('title', 'Direction')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Direction</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Direction</li>
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
                                        data-target="#addDirection">
                                        <i class="fas fa-plus mr-2"></i>Nouveaux direction
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code direction</th>
                                            <th>Nom direction</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($directions) > 0)
                                            @foreach ($directions as $direction)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $direction->code_dir }}</td>
                                                    <td>{{ $direction->nom_dir }}</td>
                                                    <td class="text-center">
                                                        <button data-id="{{ $direction->id }}"
                                                            class="text-success btn-xs mr-1 edit_direction" title="Modifier"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-pen"></i>
                                                        </button>

                                                        <button class="text-danger btn-xs ml-1 suppDirection"
                                                            data-id="{{ $direction->id }}" title="Supprimer"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Aucune direction</td>
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

    <div class="modal fade" id="addDirection" tabindex="-1" role="dialog" aria-labelledby="addDirectionTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER NOUVEAUX DIRECTION</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="code_dir">Code direction</label>
                            <input type="text" id="code_dir" class="form-control" maxlength="5"
                                placeholder="Entrer le code direction">
                            <span class="error-message" style="color: red; display: none;">La limite de caractères est de 5.</span>
                        </div>
                        <div class="form-group mb-5">
                            <label for="nom_dir">Nom direction</label>
                            <input type="text" id="nom_dir" class="form-control" placeholder="Entrer le nom direction">
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-primary btn-sm" id="ajoutDirection"><i
                                    class="fas fa-save mr-2"></i>Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editDirection" tabindex="-1" role="dialog" aria-labelledby="editDirectionTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">MODIFIER UN DIRECTION</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <input type="hidden" id="id_mod" name="id_mod">
                        <div class="form-group mb-2">
                            <label for="code_dir_mod">Code direction</label>
                            <input type="text" id="code_dir_mod" class="form-control">
                        </div>
                        <div class="form-group mb-5">
                            <label for="nom_dir_mod">Nom direction</label>
                            <input type="text" id="nom_dir_mod" class="form-control">
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-success btn-sm" id="modifieDirection"><i
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
            $('#code_dir').on('input', function () {
                var inputValue = $(this).val();
                var length = 5;

                if (inputValue.length == length) {
                    $('.error-message').hide(1000);
                } else {
                    $('.error-message').fadeIn(1000);;
                }
            });

            $("#ajoutDirection").click(function(e) {
                e.preventDefault();

                $('#ajoutDirection').attr('disabled', 'disabled')
                var codeDir = $('#code_dir').val();
                var nomDir = $('#nom_dir').val();

                $.ajax({
                    url: "{{ route('directions.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code_dir: codeDir,
                        nom_dir: nomDir
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutDirection').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })
        })

        $('.edit_direction').click(function(e) {
            e.preventDefault();
            const idDirection = $(this).data('id');

            $.get('/directions/' + idDirection + '/edit', function(data) {
                $('#id_mod').val(data.id);
                $('#code_dir_mod').val(data.code_dir);
                $('#nom_dir_mod').val(data.nom_dir);

                $('#editDirection').modal('show');
            });
        });

        $('#modifieDirection').click(function(e) {
            e.preventDefault();

            $('#modifieDirection').attr('disabled', 'disabled')
            var idDir = $('#id_mod').val();
            var codeDir = $('#code_dir_mod').val();
            var nomDir = $('#nom_dir_mod').val();

            $.ajax({
                type: 'PUT',
                url: '/directions/' + idDir,
                data: {
                    _token: "{{ csrf_token() }}",
                    code_dir: codeDir,
                    nom_dir: nomDir
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                }
            });
        });

        $('.suppDirection').on('click', function(e) {
            e.preventDefault();
            $('.suppDirection').attr('disabled', 'disabled')
            var id_dir = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: '/directions/' + id_dir,
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
