@extends('master')
@section('title', 'Employée')

@push('page-style')
    <style>
        .image-container {
            width: 155px;
            height: 155px;
            overflow: hidden;
            border-radius: 50%;
            margin: auto
        }

        .image-container img {
            width: 100%;
            height: auto;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .center-start {
            vertical-align: middle;
        }

        .title-item {
            text-decoration: underline;
            font-weight: bold
        }

        .table_view td, .table_view th {
            border-top: 0;
            padding: 3px;
        }

        .table_view th {
            text-decoration: underline;
        }

        .error{
            color: #D8000C;
        }
    </style>
@endpush

@section('contenu')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Employée</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Employée</li>
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
                                    <a href="{{ route('employees.create') }}" type="button"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-plus mr-2"></i>Nouveaux employée
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Immatriculation</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>E-mail</th>
                                            <th>Téléphone</th>
                                            <th>Sexe</th>
                                            <th>Profession</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($employees) > 0)
                                            @foreach ($employees as $employee)
                                                <tr class="center-start">
                                                    <td>
                                                        <img src="{{ asset('images/' . $employee->photo) }}"
                                                            alt="Photo de l'employé" width="60" height="60"
                                                            style="border-radius:50%">
                                                    </td>
                                                    <td>{{ $employee->immatriculation }}</td>
                                                    <td>{{ $employee->nom }}</td>
                                                    <td>{{ $employee->prenom }}</td>
                                                    <td>{{ $employee->email }}</td>
                                                    <td>{{ $employee->telephone }}</td>
                                                    <td>{{ $employee->sexe }}</td>
                                                    <td>{{ $employee->nom_prof }}</td>
                                                    <td class="text-center">
                                                        <button data-id="{{ $employee->id }}"
                                                            class="text-secondary btn-xs mr-1 detail_employee"
                                                            title="Détail" style="border: none; background-color: white">
                                                            <i class="fas fa-eye"></i>
                                                        </button>

                                                        <button data-id="{{ $employee->id }}"
                                                            class="text-success btn-xs mr-1 edit_employee" title="Modifier"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-pen"></i>
                                                        </button>

                                                        <button class="text-danger btn-xs ml-1 supp_Employee"
                                                            data-id="{{ $employee->id }}" title="Supprimer"
                                                            style="border: none; background-color: white">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center">Aucune employée</td>
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

    <div class="modal fade" id="modifieEmployee" tabindex="-1" role="dialog" aria-labelledby="modifieEmployeeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-4 mb-1">MODIFICATION D'UN EMPLOYEE</h3>
                <div class="modal-body p-4">
                    <div class="card card-outline card-info">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-4 px-3 my-4">
                                    <input type="hidden" id="id_mod" name="id_mod">
                                    <div class="image-container">
                                        <img src="" id="editPhoto" alt="Votre Image">
                                    </div>
                                    <div class="custom-file mt-4">
                                        <input type="file" accept="image/png, image/jpeg" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choisir un image</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="immatriculation">Immatriculation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="immatriculation" disabled placeholder="Entrer le N° d'immatriculation" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nom">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nom" placeholder="Entrer le nom" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nom">Prenom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="prenom" placeholder="Entrer le prenom" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="adresse">Adresse <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="adresse" placeholder="Entrer l'adresse d'employée" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">E-mail <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" placeholder="Entrer l'adresse e-mail" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="telephone">Téléphone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" minlength="10" maxlength="10" id="telephone" placeholder="Entrer le N° téléphone" required>
                                            <span class="error" id="errorconge"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-3">
                                    <label>Date de naissance <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_naiss"/>
                                </div>
                                <div class="form-group col-md-4 col-sm-3">
                                    <label for="lieu_naiss">Lieu de naissance <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="lieu_naiss" placeholder="Entrer lieu de naissance" required>
                                </div>
                                <div class="form-group col-md-2 col-sm-3">
                                    <label>Sexe <span class="text-danger">*</span></label>
                                    <select class="form-control" id="sexe">
                                        <option hidden>Séléctionnez le sexe</option>
                                        <option value="Féminin">Féminin</option>
                                        <option value="Masculin">Masculin</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 col-sm-3">
                                    <label>Situation <span class="text-danger">*</span></label>
                                    <select class="form-control" id="situation">
                                        <option hidden>Séléctionnez le situation</option>
                                        <option value="Célibataire">Célibataire</option>
                                        <option value="Marié(e)">Marié(e)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Profession <span class="text-danger">*</span></label>
                                    <select class="form-control" id="profession">
                                        <option hidden>Séléctionnez la profession</option>
                                        @if (count($professions) > 0)
                                            @foreach ($professions as $profession)
                                                <option @selected(old('professions_id', isset($employee) && $employee->professions_id == $profession->id)) value="{{ $profession->id }}">{{ $profession->nom_prof }}</option>
                                            @endforeach
                                        @else
                                            <option disabled>Aucune profession</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-3">
                                    <label>Service <span class="text-danger">*</span></label>
                                    <select class="form-control" id="service">
                                        <option hidden>Séléctionnez la service</option>
                                        @if (count($services) > 0)
                                            @foreach ($services as $service)
                                                <option @selected(old('services_id', isset($employee) && $employee->services_id == $service->id)) value="{{ $service->id }}">{{ $service->nom_serv }}</option>
                                            @endforeach
                                        @else
                                            <option disabled>Aucune service</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cin">Carte d'Identité Nationale <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" minlength="12" maxlength="12" id="cin" placeholder="Entrer le N° Carte d'Identité Nationale"/>
                                    <span class="error" id="errorcin"></span>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-between mt-2 mb-0">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                class="fas fa-times mr-2"></i>Annuler</button>
                        <button type="button" class="btn btn-success btn-sm" id="modificationEmployee"><i
                                class="fas fa-save mr-2"></i>Changer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailEmployee" tabindex="-1" role="dialog" aria-labelledby="detailEmployeeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="text-center font-weight-bold mt-3 mb-3">PROFIL D'UN EMPLOYEE</h3>
                <div class="modal-body p-0">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-5 text-center">
                                    <div class="image-container">
                                        <img src="" alt="Photo employée" id="employeePhoto">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <table class="table table_view">
                                        <tbody>
                                            <tr>
                                                <th>Nom</th>
                                                <td>: <span class="nom_employee"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Prenom</th>
                                                <td>: <span class="prenom_employee"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Adresse</th>
                                                <td>: <span class="adresse"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>: <span class="email"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Téléphone</th>
                                                <td>: <span class="phone"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-5">
                                    <table class="table table_view">
                                        <tbody>
                                            <tr>
                                                <th style="width: 140px">Immatriculation</th>
                                                <td>: <span class="immatriculation"></span></td>
                                            </tr>
                                            <tr>
                                                <th>CIN</th>
                                                <td>: <span class="num_cin"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Situation</th>
                                                <td>: <span class="situation"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Sexe</th>
                                                <td>: <span class="sexe"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="col-7" style="border-left: 2px solid">
                                    <table class="table table_view">
                                        <tbody>
                                            <tr>
                                                <th style="width: 120px">Naissance</th>
                                                <td>: <span class="naissance"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Profession</th>
                                                <td>: <span class="profession"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Service</th>
                                                <td>: <span class="service"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Direction</th>
                                                <td>: <span class="direction"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary btn-block btn-md" data-dismiss="modal"><i
                                    class="fas fa-times mr-2"></i>Annuler</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-script')
    <script>
        $(document).ready(function() {
            $('#immatriculation').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });

            $('#nom').on('input', function() {
                $(this).val($(this).val().replace(/[^a-zA-Z\s]/g, ''));
            });

            $('#telephone').on('input', function() {
                var inputValue = $(this).val();

                var numericValue = inputValue.replace(/[^0-9]/g, '');

                $(this).val(numericValue);

                if (numericValue.length === 10) {
                    $('#errortelephone').text("");
                } else {
                    $('#errortelephone').text("Le numéro de téléphone doit avoir 10 chiffres.");
                }
            });

            $('#cin').on('input', function() {
                var inputValue1 = $(this).val();

                var numericValue1 = inputValue1.replace(/[^0-9]/g, '');

                $(this).val(numericValue1);

                if (numericValue1.length === 12) {
                    $('#errorcin').text("");
                } else {
                    $('#errorcin').text("Le numéro de téléphone doit avoir 12 chiffres.");
                }
            });

            $('input[type="file"]').on('change', (e) => {
                let that = e.currentTarget
                if (that.files && that.files[0]) {
                    $(that).next('.custom-file-label').html(that.files[0].name)
                    let reader = new FileReader()
                    reader.onload = (e) => {
                        $('#editPhoto').attr('src', e.target.result)
                    }
                    reader.readAsDataURL(that.files[0])
                }
            })

            $('.edit_employee').click(function(e) {
                e.preventDefault();
                const idEmployee = $(this).data('id');

                $.get('/employees/' + idEmployee + '/edit', function(data) {
                    $('#id_mod').val(data.employee.id);
                    $('#immatriculation').val(data.employee.immatriculation);
                    $('#nom').val(data.employee.nom);
                    $('#prenom').val(data.employee.prenom);
                    $('#adresse').val(data.employee.adresse);
                    $('#sexe').val(data.employee.sexe);
                    $('#situation').val(data.employee.situation_f);
                    $('#email').val(data.employee.email);
                    $('#cin').val(data.employee.cin);
                    $('#telephone').val(data.employee.telephone);
                    $('#date_naiss').val(data.employee.date_naiss);
                    $('#lieu_naiss').val(data.employee.lieu_naiss);

                    $('#editPhoto').attr('src', '/images/' + data.employee.photo);

                    var nomPhoto = data.employee.photo.split('/').pop();
                    $('#customFile').next('.custom-file-label').html(nomPhoto);

                    $('#modifieEmployee').modal('show');
                })
            });

            $("#modificationEmployee").click(function(e) {
                e.preventDefault();

                var photo_employee = $('#customFile')[0].files[0];

                {{-- if (!photo_employee) {
                    return;
                } --}}

                $('#modificationEmployee').attr('disabled', 'disabled');
                var idEmployee = $('#id_mod').val();
                var im = $('#immatriculation').val();
                var nom = $('#nom').val();
                var prenom = $('#prenom').val();
                var adresse = $('#adresse').val();
                var email = $('#email').val();
                var date_naiss = $('#date_naiss').val();
                var lieu_naiss = $('#lieu_naiss').val();
                var cin = $('#cin').val();
                var sexe = $('#sexe').val();
                var situation = $('#situation').val();
                var telephone = $('#telephone').val();
                var profession = $('#profession').val();
                var service = $('#service').val();

                var formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('photo', photo_employee);
                formData.append('immatriculation', im);
                formData.append('nom', nom);
                formData.append('prenom', prenom);
                formData.append('adresse', adresse);
                formData.append('email', email);
                formData.append('date_naiss', date_naiss);
                formData.append('lieu_naiss', lieu_naiss);
                formData.append('cin', cin);
                formData.append('sexe', sexe);
                formData.append('situation_f', situation);
                formData.append('telephone', telephone);
                formData.append('profession', profession);
                formData.append('service', service);

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                formData.append('_token', csrfToken);

                $.ajax({
                    url: '/employees/' + idEmployee,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = "{{ route('employees.index') }}";
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#modificationEmployee').removeAttr('disabled');
                    }
                });
            });

            $('.detail_employee').click(function(e) {
                e.preventDefault();
                const idEmployee = $(this).data('id');

                $.get('/employees/' + idEmployee + '/edit', function(data) {
                    $('span.nom_employee').text(data.employee.nom);
                    $('span.prenom_employee').text(data.employee.prenom);
                    $('span.immatriculation').text(data.employee.immatriculation);
                    $('span.num_cin').text(data.employee.cin);
                    $('span.email').text(data.employee.email);
                    $('span.adresse').text(data.employee.adresse);
                    $('span.phone').text(data.employee.telephone);
                    $('span.situation').text(data.employee.situation_f);
                    $('span.sexe').text(data.employee.sexe);
                    $('span.naissance').text(data.employee.date_naiss+' à '+data.employee.lieu_naiss);
                    $('span.profession').text(data.employee.nom_prof);
                    $('span.service').text(data.employee.nom_serv);
                    $('span.direction').text(data.employee.nom_dir);

                    $('#employeePhoto').attr('src', '/images/' + data.employee.photo);

                    $('#detailEmployee').modal('show');
                })
            });

            $('.supp_Employee').on('click', function(e) {
                e.preventDefault();
                $('.supp_Employee').attr('disabled', 'disabled')
                var id_employee = $(this).data('id');
                $.ajax({
                    type: 'DELETE',
                    url: '/employees/' + id_employee,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        location.reload();
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(response) {
                        $('.supp_Employee').removeAttr('disabled', 'disabled')
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
        })
    </script>
@endpush
