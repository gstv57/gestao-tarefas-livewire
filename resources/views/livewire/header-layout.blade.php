<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <nav class="p-0 navbar navbar-header-left navbar-expand-lg navbar-form nav-search d-none d-lg-flex">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control" />
            </div>
        </nav>

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                   aria-expanded="false" aria-haspopup="true">
                    <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                        <div class="input-group">
                            <input type="text" placeholder="Search ..." class="form-control" />
                        </div>
                    </form>
                </ul>
            </li>
            <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-envelope"></i>
                </a>
                <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                    <li>
                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                            Messages
                            <a href="#" class="small">Mark all as read</a>
                        </div>
                    </li>
                    <li>
                        <div class="message-notif-scroll scrollbar-outer">
                            <div class="notif-center">
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="/assets/img/jm_denis.jpg" alt="Img Profile" />
                                    </div>
                                    <div class="notif-content">
                                        <span class="subject">Jimmy Denis</span>
                                        <span class="block"> How are you ? </span>
                                        <span class="time">5 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="/assets/img/chadengle.jpg" alt="Img Profile" />
                                    </div>
                                    <div class="notif-content">
                                        <span class="subject">Chad</span>
                                        <span class="block"> Ok, Thanks ! </span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="/assets/img/mlane.jpg" alt="Img Profile" />
                                    </div>
                                    <div class="notif-content">
                                        <span class="subject">Jhon Doe</span>
                                        <span class="block">
                              Ready for the meeting today...
                            </span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="/assets/img/talha.jpg" alt="Img Profile" />
                                    </div>
                                    <div class="notif-content">
                                        <span class="subject">Talha</span>
                                        <span class="block"> Hi, Apa Kabar ? </span>
                                        <span class="time">17 minutes ago</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="notification">{{ $total_unread_notifications }}</span>
                </a>
                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                    <li>
                        <div class="dropdown-title">
                            Você tem {{ $total_unread_notifications }} novas notificações!
                        </div>
                    </li>
                    <li>
                        <div class="notif-scroll scrollbar-outer">
                            <div class="notif-center">
{{--                                <a href="#">--}}
{{--                                    <div class="notif-icon notif-primary">--}}
{{--                                        <i class="fa fa-user-plus"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="notif-content">--}}
{{--                                        <span class="block"> New user registered </span>--}}
{{--                                        <span class="time">5 minutes ago</span>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a href="#">--}}
{{--                                    <div class="notif-icon notif-success">--}}
{{--                                        <i class="fa fa-comment"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="notif-content">--}}
{{--                                        <span class="block">--}}
{{--                                          Rahmad commented on Admin--}}
{{--                                        </span>--}}
{{--                                        <span class="time">12 minutes ago</span>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
                                @foreach($all_notifications as $notification)
                                    @switch($notification['type'])
                                        @case('sent')
                                            @if(isset($notification['sender']))
                                                <a href="{{ route('inbox.message.between.users', $notification['sender']['id']) }}" wire:navigate>
                                                    <div class="notif-img">
                                                        <img src="/assets/img/profile2.jpg" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            {{ $notification['sender']['name'] }} te enviou uma mensagem
                                                            {{ \Illuminate\Support\Carbon::parse($notification['created_at'])->diffForHumans() }}
                                                        </span>
                                                        <span class="time">{{ \Illuminate\Support\Carbon::parse($notification['created_at'])->diffForHumans() }}</span>
                                                    </div>
                                                </a>
                                            @endif
                                            @break

                                        @case(App\Models\Notification::PROJETO_NOTIFICATION_TYPE)
                                            <a href="#">
                                                <div class="notif-icon notif-success">
                                                    <i class="fa fa-project-diagram"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        {{ $notification['title'] ?? 'Notificação de Projeto' }}
                                                    </span>
                                                                                    <span class="time">
                                                        {{ \Illuminate\Support\Carbon::parse($notification['created_at'])->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </a>
                                            @break
                                        @default
                                            <div>Tipo de notificação não reconhecido</div>
                                    @endswitch
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="see-all" href="javascript:void(0);">Ver todas as notificações<i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fas fa-layer-group"></i>
                </a>
                <div class="dropdown-menu quick-actions animated fadeIn">
                    <div class="quick-actions-header">
                        <span class="mb-1 title">Ações Rápidas</span>
                        <span class="subtitle op-7">Atalhos</span>
                    </div>
                    <div class="quick-actions-scroll scrollbar-outer">
                        <div class="quick-actions-items">
                            <div class="m-0 row">
{{--                                <a class="p-0 col-6 col-md-4" href="#">--}}
{{--                                    <div class="quick-actions-item">--}}
{{--                                        <div class="avatar-item bg-danger rounded-circle">--}}
{{--                                            <i class="far fa-calendar-alt"></i>--}}
{{--                                        </div>--}}
{{--                                        <span class="text">Reuniões</span>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a class="p-0 col-6 col-md-4" href="#">--}}
{{--                                    <div class="quick-actions-item">--}}
{{--                                        <div class="avatar-item bg-warning rounded-circle">--}}
{{--                                            <i class="fas fa-map"></i>--}}
{{--                                        </div>--}}
{{--                                        <span class="text">Mapas</span>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
                                <a class="p-0 col-6 col-md-4" href="{{ route('projeto.index') }}" wire:navigate>
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-info rounded-circle">
                                            <i class="fas fa-file-excel"></i>
                                        </div>
                                        <span class="text">Projetos</span>
                                    </div>
                                </a>
                                <a class="p-0 col-6 col-md-4" href="{{route('inbox.index')}}" wire:navigate>
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-success rounded-circle">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <span class="text">Inbox</span>
                                    </div>
                                </a>
{{--                                <a class="p-0 col-6 col-md-4" href="#">--}}
{{--                                    <div class="quick-actions-item">--}}
{{--                                        <div class="avatar-item bg-primary rounded-circle">--}}
{{--                                            <i class="fas fa-file-invoice-dollar"></i>--}}
{{--                                        </div>--}}
{{--                                        <span class="text">Invoice</span>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a class="p-0 col-6 col-md-4" href="#">--}}
{{--                                    <div class="quick-actions-item">--}}
{{--                                        <div class="avatar-item bg-secondary rounded-circle">--}}
{{--                                            <i class="fas fa-credit-card"></i>--}}
{{--                                        </div>--}}
{{--                                        <span class="text">Payments</span>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                    </div>
                    <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">{{ Auth::user()->name }}</span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img src="/assets/img/profile.jpg" alt="image profile" class="rounded avatar-img" />
                                </div>
                                <div class="u-text">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Meu perfil</a>
                            <a class="dropdown-item" href="{{ route('inbox.index') }}" wire:navigate>Caixa de Entrada</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Configurações da Conta</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sair
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
