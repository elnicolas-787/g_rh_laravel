@extends('master')
@section('title', 'Tableau de bord')

@push('page-style')
    <style>
        .fw-bold{
            font-weight:bold
        }
    </style>
@endpush
@section('contenu')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Effectif</span>
                <span class="info-box-number">
                  {{ $totalEmployee }} <small>Employées</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1 p-3"><img src="{{ asset('dist/img/diminuer.png') }}" /></span>

              <div class="info-box-content">
                <span class="info-box-text">Salaire minimum</span>
                <span class="info-box-number">{{ $minSalaire }} Ar</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1 p-3"><img src="{{ asset('dist/img/augmenter.png') }}" /></span>

              <div class="info-box-content">
                <span class="info-box-text">Salaire maximum</span>
                <span class="info-box-number">{{ $maxSalaire }} Ar</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>

        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                   </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-body">
                <div class="tab-content p-0 d-flex justify-content-center">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="myChart2" style="width:100%;max-width:300px"></canvas>
                   </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-body">
                <div class="tab-content p-0 d-flex justify-content-center">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="myChart4" style="width:100%;max-width:300px"></canvas>
                   </div>
                </div>
              </div><!-- /.card-body -->
            </div>
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">
            <div class="card">
              <div class="card-body">
                <div class="tab-content p-0 d-flex justify-content-center">
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="myChart1" style="width:100%;max-width:300px"></canvas>
                   </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <canvas id="myChart3" style="width:100%;max-width:600px"></canvas>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="tab-content p-0 d-flex justify-content-center">
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="myChart5" style="width:100%;max-width:300px"></canvas>
                   </div>
                </div>
              </div>
            </div>
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@php
    $service_titles = [];
    $nb_by_service = [];
    $salaire = [];
    $nb_by_salaire = [];
@endphp

@foreach($employeeByService as $service)
    @php
        $service_titles[] = $service['nom_serv'];
        $nb_by_service[] = $service['count'];
    @endphp
@endforeach

@foreach ($employeeSalaire as $nbCount)
    @php
        $salaire[] = $nbCount['salaire'];
        $nb_by_salaire[] = $nbCount['nbCount'];
    @endphp
@endforeach

@if (!empty($congeType))
    @php
        $typeConge = [];
        $nb_by_type = [];
    @endphp

    @foreach ($congeType as $conge)
        @php
            $typeConge[] = $conge['type_conge'];
            $nb_by_type[] = $conge['totalConge'];
        @endphp
    @endforeach
@else
    @php
        $typeConge = ['Aucun'];
        $nb_by_type = [$congeType[0]];
    @endphp
@endif

@push('page-script')
    <script src="{{ asset('dist/js/chart.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var contrat_title = ["Contrat Durée Déterminé", "Contrat Durée Indeterminé",];
            var nb_contrat = [{{ $employeeCDD}}, {{ $employeeCDD}}];
            var barColors = ["blue","orange"];

            var sexe_title = ["Féminin", "Masculin",];
            var nb_sexe = [{{ $feminin}}, {{ $masculin}}];

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: contrat_title,
                    datasets: [{
                        backgroundColor: barColors,
                        data: nb_contrat
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                    display: true,
                    text: "Répartition par type de contrat"
                    }
                }
            });

            new Chart("myChart1", {
                type: "pie",
                data: {
                    labels: sexe_title,
                    datasets: [{
                    backgroundColor: barColors,
                    data: nb_sexe
                    }]
                },
                options: {
                    title: {
                    display: true,
                    text: "Répartition par genre"
                    }
                }
            });

            const service_title = @json($service_titles);
            const nb_by_service = @json($nb_by_service);

            new Chart("myChart2", {
                type: "doughnut",
                data: {
                    labels: service_title,
                    datasets: [{
                    backgroundColor: barColors,
                    data: nb_by_service
                    }]
                },
                options: {
                    title: {
                    display: true,
                    text: "Effectif par service"
                    }
                }
            });

            const salaire = @json($salaire);
            const nb_by_salaire = @json($nb_by_salaire);

            new Chart("myChart3", {
                type: "bar",
                data: {
                    labels: salaire,
                    datasets: [{
                        backgroundColor: barColors,
                        data: nb_by_salaire
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Répartition par salaire de base"
                    }
                }
            });

            const typeConge = @json($typeConge);
            const nb_by_type = @json($nb_by_type);

            new Chart("myChart4", {
                type: "pie",
                data: {
                    labels: typeConge,
                    datasets: [{
                    backgroundColor: barColors,
                    data: nb_by_type
                    }]
                },
                options: {
                    title: {
                    display: true,
                    text: "Répartition par type de congé"
                    }
                }
            });

            const situation = ['Célibataire', 'Marié(e)'];
            const nb_situation = [{{ $celibataire }}, {{ $marie }}];

            new Chart("myChart5", {
                type: "doughnut",
                data: {
                    labels: situation,
                    datasets: [{
                    backgroundColor: barColors,
                    data: nb_situation
                    }]
                },
                options: {
                    title: {
                    display: true,
                    text: "Répartition par situation familiale"
                    }
                }
            });
        })
    </script>
@endpush
