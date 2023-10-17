<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/' . $employee->photo) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $username }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">MENU PRINCIPAL</li>
                <li class="nav-item">
                    <a href="{{ url('tableau_de_bord') }}" class="nav-link">
                        <p>
                            Tableau de bord
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('utilisateurs.index')}}" class="nav-link">
                        <p>
                            Utilisateur
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('directions.index')}}" class="nav-link">
                        <p>
                            Direction
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('services.index')}}" class="nav-link">
                        <p>
                            Service
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('professions.index')}}" class="nav-link">
                        <p>
                            Profession
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('employees.index')}}" class="nav-link">
                        <p>
                            Employée
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('contrats.index')}}" class="nav-link">
                        <p>
                            Contrat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            Absences
                            <i class="right fas fa-angle-left"></i>
                            @if (count($absences) > 0)
                                <span class="badge badge-danger right">{{ count($absences) }}</span>
                            @endif
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('boite-receptions-absences')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>
                                    Boîte de récéption
                                    @if (count($absences) > 0)
                                        <span class="badge badge-danger right">{{ count($absences) }}</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('demande_accepter_absences')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Demande accepter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('demande_refuser_absences')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Demande refuser</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            Congés
                            <i class="right fas fa-angle-left"></i>
                            @if (count($conges) > 0)
                                <span class="badge badge-danger right">{{ count($conges) }}</span>
                            @endif
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('boite-receptions-conges')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>
                                    Boîte de récéption
                                    @if (count($conges) > 0)
                                        <span class="badge badge-danger right">{{ count($conges) }}</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('demande_accepter_conges')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Demande accepter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('demande_refuser_conges')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Demande refuser</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            Info formations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('formations.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Formations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('formation_employee.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Employée conserver</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('missions.index')}}" class="nav-link">
                        <p>
                            Mission
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            LISTES DES EMPLOYEES
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('liste_toute_employee')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Toutes employées</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('liste_employee_cdd')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Avoir contrat CDD</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('liste_employee_cdi')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Avoir contrat CDI</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{url('liste_employee_cinq_ans_service')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>À l'âge 50 ans de plus</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{url('liste_employee_cinq_ans_service')}}" class="nav-link">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Plus de 5 ans de service</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
