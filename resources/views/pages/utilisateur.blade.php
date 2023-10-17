@extends('master')
@section('title', 'Utilisateur')

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Utilisateur</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Utilisateur</li>
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
                                        data-target="#addUtilisateur">
                                        <i class="fas fa-plus mr-2"></i>Nouveaux utilisateur
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Nom d'utilisateur</th>
                                            <th>Poste</th>
                                            <th>E-mail</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($users) > 0)
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->immatriculation }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->nom_prof }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td class="text-center">
                                                        <button class="text-danger btn-xs ml-1 suppUser"
                                                            data-id="{{ $user->id }}" title="Supprimer"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Aucune utilisateur</td>
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

    <div class="modal fade" id="addUtilisateur" tabindex="-1" role="dialog" aria-labelledby="addUtilisateurTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-5 mb-2">AJOUTER NOUVEAUX UTILISATEUR</h3>
                <div class="modal-body p-4">
                    @csrf
                    <div class="form-group">
                        <label for="employee">Immatriculation</label>
                        <select class="form-control" name="employee" id="employee">
                            <option hidden>Sélectionnez l'immatriculation</option>
                            @if (count($employees) > 0)
                                @foreach ($employees as $employee)
                                    @php
                                        $employeeIsUsed = false;
                                        foreach ($users as $user) {
                                            if ($user->employees_id == $employee->id) {
                                                $employeeIsUsed = true;
                                                break;
                                            }
                                        }
                                    @endphp

                                    @if (!$employeeIsUsed)
                                        <option value="{{ $employee->id }}">{{ $employee->immatriculation }}</option>
                                    @endif
                                @endforeach
                            @else
                                <option disabled>Aucune immatriculation</option>
                            @endif
                        </select>
                    </div>
                    <label>Nom d'utilisateur <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nom d'utilisateur" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label>E-mail <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" disabled placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <label>Mot de passe <span class="text-danger">*</span></label>
                    <div class="input-group mb-5">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Entrer le mot de passe">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-between mb-0">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                class="fas fa-times mr-2"></i>Annuler</button>
                        <button type="button" class="btn btn-primary btn-sm" id="ajoutUtilisateur"><i
                                class="fas fa-save mr-2"></i>Créer un compte</button>
                    </div>
                </div>
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
                            $('#email').val(data.email);
                        },
                        error: function() {
                            console.log('Une erreur s\'est produite lors de la récupération du nom de l\'employé.');
                        }
                    });
                } else {
                    $('#email').val('');
                }
            });

            $("#ajoutUtilisateur").click(function(e) {
                e.preventDefault();

                $('#ajoutUtilisateur').attr('disabled', 'disabled')
                var employee = $('#employee').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();

                console.log(employee, name, email, password)

                $.ajax({
                    url: "{{ route('utilisateurs.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        employee: employee,
                        name: name,
                        email: email,
                        password: password,
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutUtilisateur').removeAttr('disabled', 'disabled')
                        console.log("Error: " + error);
                    }
                });
            })

            $('.suppUser').on('click', function(e) {
                e.preventDefault();
                $('.suppUser').attr('disabled', 'disabled')
                var id_user = $(this).data('id');
                $.ajax({
                    type: 'DELETE',
                    url: '/utilisateurs/' + id_user,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(response) {
                        $('.suppUser').removeAttr('disabled', 'disabled')
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
