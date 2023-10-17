@extends('master')
@section('title', 'Catégorie')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catégorie</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Catégorie</li>
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
                                        data-target="#addCategorie">
                                        <i class="fas fa-plus mr-2"></i>Nouveaux catégorie
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
                                            <th>Code catégorie</th>
                                            <th>Classe catégorie</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($categories) > 0)
                                            @foreach ($categories as $categorie)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $categorie->code_cat }}</td>
                                                    <td>{{ $categorie->classe_cat }}</td>
                                                    <td class="text-center">
                                                        <button data-id="{{ $categorie->id }}"
                                                            class="text-success btn-xs mr-1 edit_categorie" title="Modifier"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-pen"></i>
                                                        </button>

                                                        <button class="text-danger btn-xs ml-1 suppCategorie"
                                                            data-id="{{ $categorie->id }}" title="Supprimer"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Aucune catégorie</td>
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

    <div class="modal fade" id="addCategorie" tabindex="-1" role="dialog" aria-labelledby="addCategorieTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER NOUVEAUX CATEGORIE</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="code_cat">Code catégorie</label>
                            <input type="text" id="code_cat" class="form-control"
                                placeholder="Entrer le code catégorie">
                        </div>
                        <div class="form-group mb-5">
                            <label for="classe_cat">Classe catégorie</label>
                            <input type="text" id="classe_cat" class="form-control" placeholder="Entrer le classe catégorie">
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-primary btn-sm" id="ajoutCategorie"><i
                                    class="fas fa-save mr-2"></i>Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategorie" tabindex="-1" role="dialog" aria-labelledby="editCategorieTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">MODIFIER UN CATEGORIE</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <input type="hidden" id="id_mod" name="id_mod">
                        <div class="form-group mb-2">
                            <label for="code_cat_mod">Code catégorie</label>
                            <input type="text" id="code_cat_mod" class="form-control">
                        </div>
                        <div class="form-group mb-5">
                            <label for="classe_cat_mod">Classe catégorie</label>
                            <input type="text" id="classe_cat_mod" class="form-control">
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-success btn-sm" id="modifieCategorie"><i
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
            $("#ajoutCategorie").click(function(e) {
                e.preventDefault();

                $('#ajoutCategorie').attr('disabled', 'disabled')
                var codeCat = $('#code_cat').val();
                var classeCat = $('#classe_cat').val();

                $.ajax({
                    url: "{{ route('categories.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code_cat: codeCat,
                        classe_cat: classeCat
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutCategorie').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })
        })

        $('.edit_categorie').click(function(e) {
            e.preventDefault();
            const idCategorie = $(this).data('id');

            $.get('/categories/' + idCategorie + '/edit', function(data) {
                $('#id_mod').val(data.id);
                $('#code_cat_mod').val(data.code_cat);
                $('#classe_cat_mod').val(data.classe_cat);

                $('#editCategorie').modal('show');
            });
        });

        $('#modifieCategorie').click(function(e) {
            e.preventDefault();

            $('#modifieCategorie').attr('disabled', 'disabled')
            var idCat = $('#id_mod').val();
            var codeCat = $('#code_cat_mod').val();
            var classeCat = $('#classe_cat_mod').val();

            $.ajax({
                type: 'PUT',
                url: '/categories/' + idCat,
                data: {
                    _token: "{{ csrf_token() }}",
                    code_cat: codeCat,
                    classe_cat: classeCat
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                }
            });
        });

        $('.suppCategorie').on('click', function(e) {
            e.preventDefault();
            $('.suppCategorie').attr('disabled', 'disabled')
            var id_cat = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: '/categories/' + id_cat,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                },
                error: function(response) {
                    $('.suppCategorie').removeAttr('disabled', 'disabled')
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
