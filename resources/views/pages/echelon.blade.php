@extends('master')
@section('title', 'Echelon')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Echelon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Echelon</li>
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
                                        data-target="#addEchelon">
                                        <i class="fas fa-plus mr-2"></i>Nouveaux echelon
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
                                            <th>Code echelon</th>
                                            <th>catégorie</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($echelons) > 0)
                                            @foreach ($echelons as $echelon)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $echelon->code_echelon }}</td>
                                                    <td>{{ $echelon->code_cat }}</td>
                                                    <td class="text-center">
                                                        <button data-id="{{ $echelon->id }}"
                                                            class="text-success btn-xs mr-1 edit_echelon" title="Modifier"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-pen"></i>
                                                        </button>

                                                        <button class="text-danger btn-xs ml-1 suppEchelon"
                                                            data-id="{{ $echelon->id }}" title="Supprimer"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Aucune echelon</td>
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

    <div class="modal fade" id="addEchelon" tabindex="-1" role="dialog" aria-labelledby="addEchelonTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER NOUVEAUX ECHELON</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="code_echelon">Code echelon</label>
                            <input type="text" id="code_echelon" class="form-control"
                                placeholder="Entrer le code echelon">
                        </div>
                        <div class="form-group mb-5">
                            <label for="categorie">Catégorie</label>
                            <select class="form-control" id="categorie">
                                <option hidden>Séléctionnez la catégorie</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->code_cat }}</option>
                                    @endforeach
                                @else
                                    <option disabled>Aucune catégorie</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-primary btn-sm" id="ajoutEchelon"><i
                                    class="fas fa-save mr-2"></i>Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editEchelon" tabindex="-1" role="dialog" aria-labelledby="editEchelonTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">MODIFIER UN ECHELON</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <input type="hidden" id="id_mod" name="id_mod">
                        <div class="form-group mb-2">
                            <label for="code_echelon_mod">Code echelon</label>
                            <input type="text" id="code_echelon_mod" class="form-control">
                        </div>
                        <div class="form-group mb-5">
                            <label for="categorie_mod">Catégorie</label>
                            <select class="form-control" id="categorie_mod">
                                <option hidden>Séléctionnez la catégorie</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $categorie)
                                        <option @selected(old('categorie_id', isset($echelon) && $categorie->id == $echelon->categorie_id)) value="{{ $categorie->id }}">
                                            {{ $categorie->code_cat }}
                                        </option>
                                    @endforeach
                                @else
                                    <option disabled>Aucune catégorie</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-success btn-sm" id="modifieEchelon"><i
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
            $("#ajoutEchelon").click(function(e) {
                e.preventDefault();

                $('#ajoutEchelon').attr('disabled', 'disabled')
                var codeEchelon = $('#code_echelon').val();
                var categorie = $('#categorie').val();

                $.ajax({
                    url: "{{ route('echelons.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code_echelon: codeEchelon,
                        categorie_id: categorie
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutEchelon').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })
        })

        $('.edit_echelon').click(function(e) {
            e.preventDefault();
            const idEchelon = $(this).data('id');

            $.get('/echelons/' + idEchelon + '/edit', function(data) {
                $('#id_mod').val(data.echelon.id);
                $('#code_echelon_mod').val(data.echelon.code_echelon);
                $('#categorie_mod').val(data.echelon.categorie_id);

                $('#editEchelon').modal('show');
            });
        });

        $('#modifieEchelon').click(function(e) {
            e.preventDefault();

            $('#modifieEchelon').attr('disabled', 'disabled')
            var idEchelon = $('#id_mod').val();
            var codeEchelon = $('#code_echelon_mod').val();
            var categorie = $('#categorie_mod').val();

            $.ajax({
                type: 'PUT',
                url: '/echelons/' + idEchelon,
                data: {
                    _token: "{{ csrf_token() }}",
                    code_echelon: codeEchelon,
                    categorie_id: categorie
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                }
            });
        });

        $('.suppEchelon').on('click', function(e) {
            e.preventDefault();
            $('.suppEchelon').attr('disabled', 'disabled')
            var id_echelon = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: '/echelons/' + id_echelon,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                },
                error: function(response) {
                    $('.suppEchelon').removeAttr('disabled', 'disabled')
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
