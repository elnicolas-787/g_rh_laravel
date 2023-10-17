@extends('master')
@section('title', 'Service')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Service</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Service</li>
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
                                        data-target="#addService">
                                        <i class="fas fa-plus mr-2"></i>Nouveaux service
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code service</th>
                                            <th>Nom service</th>
                                            <th>Direction</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($services) > 0)
                                            @foreach ($services as $service)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $service->code_serv }}</td>
                                                    <td>{{ $service->nom_serv }}</td>
                                                    <td>{{ $service->code_dir }}</td>
                                                    <td class="text-center">
                                                        <button data-id="{{ $service->id }}"
                                                            class="text-success btn-xs mr-1 edit_service" title="Modifier"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-pen"></i>
                                                        </button>

                                                        <button class="text-danger btn-xs ml-1 suppService"
                                                            data-id="{{ $service->id }}" title="Supprimer"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">Aucune direction</td>
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

    <div class="modal fade" id="addService" tabindex="-1" role="dialog" aria-labelledby="addServiceTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER NOUVEAUX SERVICE</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="code_serv">Code service</label>
                            <input type="text" id="code_serv" class="form-control" placeholder="Entrer le code service">
                        </div>
                        <div class="form-group mb-2">
                            <label for="nom_dir">Nom service</label>
                            <input type="text" id="nom_serv" class="form-control" placeholder="Entrer le nom service">
                        </div>
                        <div class="form-group mb-5">
                            <label for="direction">Direction</label>
                            <select class="form-control" id="direction">
                                <option hidden>Séléctionnez la direction</option>
                                @if (count($directions) > 0)
                                    @foreach ($directions as $direction)
                                        <option value="{{ $direction->id }}">{{ $direction->code_dir }}</option>
                                    @endforeach
                                @else
                                    <option disabled>Aucune direction</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-primary btn-sm" id="ajoutService"><i
                                    class="fas fa-save mr-2"></i>Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editService" tabindex="-1" role="dialog" aria-labelledby="editServiceTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">MODIFIER UN SERVICE</h3>
                <form class="modal-body p-4">
                    <div class="signup-form">
                        @csrf
                        <input type="hidden" id="id_mod" name="id_mod">
                        <div class="form-group mb-2">
                            <label for="code_serv_mod">Code service</label>
                            <input type="text" id="code_serv_mod" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="nom_serv_mod">Nom service</label>
                            <input type="text" id="nom_serv_mod" class="form-control">
                        </div>
                        <div class="form-group mb-5">
                            <label for="direction_mod">Direction</label>
                            <select class="form-control" id="direction_mod">
                                <option hidden>Séléctionnez la direction</option>
                                @if (count($directions) > 0)
                                    @foreach ($directions as $direction)
                                        <option @selected(old('direction_id', isset($service) && $service->direction_id == $direction->id))
                                            value="{{ $direction->id }}">{{ $direction->code_dir }}</option>
                                    @endforeach
                                @else
                                    <option disabled>Aucune direction</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-0">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                            <button type="button" class="btn btn-success btn-sm" id="modifieService"><i
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
            $("#ajoutService").click(function(e) {
                e.preventDefault();

                $('#ajoutService').attr('disabled', 'disabled')
                var codeServ = $('#code_serv').val();
                var nomServ = $('#nom_serv').val();
                var direction = $('#direction').val();

                $.ajax({
                    url: "{{ route('services.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code_serv: codeServ,
                        nom_serv: nomServ,
                        direction_id: direction,
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutService').removeAttr('disabled', 'disabled')
                    }
                });
            })
        })

        $('.edit_service').click(function(e) {
            e.preventDefault();
            const idService = $(this).data('id');

            $.get('/services/' + idService + '/edit', function(data) {
                $('#id_mod').val(data.service.id);
                $('#code_serv_mod').val(data.service.code_serv);
                $('#nom_serv_mod').val(data.service.nom_serv);
                $('#direction_mod').val(data.service.direction_id);

                $('#editService').modal('show');
            });
        });

        $('#modifieService').click(function(e) {
            e.preventDefault();
            $('#modifieService').attr('disabled', 'disabled')
            var idServ = $('#id_mod').val();
            var codeServ = $('#code_serv_mod').val();
            var nomServ = $('#nom_serv_mod').val();
            var direction = $('#direction_mod').val();

            $.ajax({
                type: 'PUT',
                url: '/services/' + idServ,
                data: {
                    _token: "{{ csrf_token() }}",
                    code_serv: codeServ,
                    nom_serv: nomServ,
                    direction_id: direction
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                }
            });
        });

        $('.suppService').on('click', function(e) {
            e.preventDefault();
            $('.suppService').attr('disabled', 'disabled')
            var id_serv = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: '/services/' + id_serv,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    location.reload();
                    localStorage.setItem('message', JSON.stringify(response));
                },
                error: function(response) {
                    $('.suppService').removeAttr('disabled', 'disabled')
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
