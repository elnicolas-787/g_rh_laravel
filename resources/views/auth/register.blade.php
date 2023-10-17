<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box" style="width:450px">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>Régistration</b></h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Créer un nouveau membre</p>

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="employee">Immatriculation</label>
                        <select class="form-control" name="employee" id="employee">
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
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email">
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

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Créer un compte</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    {{-- <script>
        $(document).ready(function() {
            $('#employee').on('change', function() {
                var selectedEmployeeId = $(this).val();

                if (selectedEmployeeId !== '') {
                    $.ajax({
                        url: '/get_employee/' + selectedEmployeeId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#name').val(data.nom+' '+data.prenom);
                            $('#email').val(data.email);
                        },
                        error: function() {
                            console.log('Une erreur s\'est produite lors de la récupération du nom de l\'employé.');
                        }
                    });
                } else {
                    $('#name').val('');
                    $('#email').val('');
                }
            });
        })
    </script> --}}
</body>

</html>

