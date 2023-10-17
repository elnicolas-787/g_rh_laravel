@extends('master')
@section('title', 'Insertion employée')

@push('page-style')

<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px);
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 5px !important
    }
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

    .error{
        color: #D8000C;
    }
</style>

@endpush
@section('contenu')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Insertion nouveaux employée</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employée</a></li>
                        <li class="breadcrumb-item active">Nouveaux employée</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title" style="font-weight:bold">
                            Information d'un employée
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-4 px-3 my-4">
                                <div class="image-container">
                                    <img src="{{asset('dist/img/avatar_fond.png')}}" id="preview" alt="Votre Image">
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
                                        <input type="text" class="form-control" id="immatriculation" placeholder="Entrer le N° d'immatriculation" required>
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
                                        <span class="error" id="errortelephone"></span>
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
                                            <option value="{{ $profession->id }}">{{ $profession->nom_prof }}</option>
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
                                            <option value="{{ $service->id }}">{{ $service->nom_serv }}</option>
                                        @endforeach
                                    @else
                                        <option disabled>Aucune service</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cin">N° Carte d'Identité Nationale <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" minlength="12" maxlength="12" id="cin" placeholder="Entrer le N° Carte d'Identité Nationale"/>
                                <span class="error" id="errorcin"></span>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title" style="font-weight:bold">
                            Contrat d'un employée
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="num_contrat">N° de contrat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="num_contrat" placeholder="Entrer le N° contrat"/>
                                </div>
                                <div class="form-group">
                                    <label>Date de debut <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_debut"/>
                                </div>
                                <div class="form-group">
                                    <label for="salaire">Salaire de base <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="salaire" placeholder="Entrer le responsabilité"/>
                                </div>
                                <div class="form-group">
                                    <label for="heure_sem">heures/semaine <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="heure_sem" placeholder="Entrer le responsabilité"/>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type contrat <span class="text-danger">*</span></label>
                                    <select class="form-control" id="contrat">
                                        <option hidden>Séléctionnez le contrat</option>
                                        <option value="CDD">Contrat à Durée Déterminé</option>
                                        <option value="CDI">Contrat à Durée Indéterminé</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Date de fin <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_fin"/>
                                </div>
                                <div class="form-group">
                                    <label for="jour_sem">jours/semaine <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="jour_sem" placeholder="Entrer le responsabilité"/>
                                </div>
                                <div class="form-group">
                                    <label>Horaire <span class="text-danger">*</span></label>
                                    <select class="form-control" id="horaire">
                                        <option hidden>Séléctionnez l'horaire</option>
                                        <option value="07:00 à 05:00">07:00 à 17:00</option>
                                        <option value="07:30 à 05:30">07:30 à 17:30</option>
                                        <option value="08:00 à 06:00">08:00 à 18:00</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group d-flex justify-content-between mb-0">
                    <a href="{{ route('employees.index') }}" class="btn btn-default btn-sm"><i
                            class="fas fa-times mr-2"></i>Annuler</a>
                    <button type="button" class="btn btn-primary btn-sm" id="ajoutEmployee"><i
                            class="fas fa-save mr-2"></i>Enregistrer</button>
                </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
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

            $('#num_contrat').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });

            $('#salaire').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
            $('#jour_sem').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
            $('#heure_sem').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });

            $('#contrat').on('change', function() {
                if($(this).val() == 'CDI') {
                    $('#date_fin').attr('disabled', 'disabled')
                }else{
                    $('#date_fin').removeAttr('disabled', 'disabled')
                }
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
                        $('#preview').attr('src', e.target.result)
                    }
                    reader.readAsDataURL(that.files[0])
                }
            })

            $("#ajoutEmployee").click(function(e) {
                e.preventDefault();

                // Vérifier si un fichier a été sélectionné
                var photo = $('input[type="file"]').val();
                {{-- if (!photo) {
                    alert("Veuillez sélectionner une photo.");
                    return;
                } --}}

                $('#ajoutEmployee').attr('disabled', 'disabled');
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
                var num_contrat = $('#num_contrat').val();
                var type_contrat = $('#contrat').val();
                var date_debut = $('#date_debut').val();
                var date_fin = $('#date_fin').val() !== '' ? $('#date_fin').val() : ''
                var salaire = $('#salaire').val();
                var jour_sem = $('#jour_sem').val();
                var heure_sem = $('#heure_sem').val();
                var horaire = $('#horaire').val();

                var data = new FormData();
                data.append('photo', $('input[type="file"]')[0].files[0]);
                data.append('_token', "{{ csrf_token() }}");
                data.append('immatriculation', im);
                data.append('nom', nom);
                data.append('prenom', prenom);
                data.append('adresse', adresse);
                data.append('email', email);
                data.append('date_naiss', date_naiss);
                data.append('lieu_naiss', lieu_naiss);
                data.append('cin', cin);
                data.append('sexe', sexe);
                data.append('situation_f', situation);
                data.append('telephone', telephone);
                data.append('service', service);
                data.append('profession', profession);
                data.append('num_contrat', num_contrat);
                data.append('type_contrat', type_contrat);
                data.append('date_debut', date_debut);
                data.append('salaire', salaire);
                data.append('jour_sem', jour_sem);
                data.append('heure_sem', heure_sem);
                data.append('horaire', horaire);

                if (date_fin !== null) {
                    data.append('date_fin', date_fin);
                }

                $.ajax({
                    url: "{{ route('employees.store') }}",
                    method: "POST",
                    data: data,
                    processData: false, // N'exécute pas de traitement automatique des données
                    contentType: false, // N'ajoute pas d'en-tête de type de contenu
                    success: function(response) {
                        window.location.href = "{{ route('employees.index') }}";
                        localStorage.setItem('message', JSON.stringify(response));
                    },
                    error: function(xhr, status, error) {
                        $('#ajoutEmployee').removeAttr('disabled');
                    }
                });
            });

        })
    </script>
@endpush
