<div>
    <!-- Sidenav -->
    <nav id="sidenav-1" class="sidenav" data-mdb-hidden="true" >
        <div class="d-flex" style="flex-direction: column;height:100vh">
            <div class="text-center">
                <h4 class="pt-4 pb-1">Otter</h4>
                <hr class="m-0 mb-2" />
            </div>
            <ul id="scroll-container2" class="mb-auto sidenav-menu" style="overflow-y: auto">
                @auth
                    @if(auth()->user()->profile->role_id == 1)
                        <li class="sidenav-item">
                            <div class="accordion" id="accordionExampleTwo">
                                <div class="border-0 accordion-item">
                                <span class="accordion-header" id="headingTwo">
                                    <a class="sidenav-link" class="accordion-button"
                                    type="button"
                                    data-mdb-toggle="collapse"
                                    data-mdb-target="#collapseTwo"
                                    aria-expanded="true"
                                    aria-controls="collapseTwo"><span>Admin</span></a>
                                </span>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-mdb-parent="#accordionExampleTwo">
                                    <div class="accordion-body">
                                        <ul class="sidenav-collapse scroll-section" style="display:block;">
                                            <li class="sidenav-item">
                                                <a class="sidenav-link ps-3" href="{{url("categories")}}">Categorias</a>
                                            </li>
                                            <li class="sidenav-item">
                                                <a class="sidenav-link ps-3" href="{{url("statistical")}}">Estadisticas</a>
                                            </li>
                                            <li class="sidenav-item">
                                                <a class="sidenav-link ps-3" href="{{url("tags")}}">Etiquetas</a>
                                            </li>
                                            <li class="sidenav-item">
                                                <a class="sidenav-link ps-3" href="{{url("images/portada")}}">Fotos de portada</a>
                                            </li>
                                            <li class="sidenav-item">
                                                <a class="sidenav-link ps-3" href="{{url("image/default")}}">Foto por defecto</a>
                                            </li>
                                            <li class="sidenav-item">
                                                <a class="sidenav-link ps-3" href="{{url("roles")}}">Roles</a>
                                            </li>
                                            <li class="sidenav-item">
                                                <a class="sidenav-link ps-3" href="{{url("users/block")}}">Usuarios Bloqueados</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endauth
                <li class="sidenav-item">
                    <a class="sidenav-link" href="{{url("/")}}">
                        <span>Inicio</span>
                    </a>
                </li>
                @auth
                    <li class="sidenav-item">
                        <a class="sidenav-link" href="{{url("create/post")}}">
                            <span>Crear Post</span>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a class="sidenav-link" href="{{url("historical")}}">
                            <span>Historial</span>
                        </a>
                    </li>
                @endauth
                <li class="sidenav-item">
                    <a class="sidenav-link" href="{{url("authors")}}">
                        <span>Autores</span>
                    </a>
                </li>
                <li class="sidenav-item">
                    <div class="accordion" id="accordionExample">
                        <div class="border-0 accordion-item">
                        <span class="accordion-header" id="headingOne">
                            <a class="sidenav-link" class="accordion-button"
                            type="button"
                            data-mdb-toggle="collapse"
                            data-mdb-target="#collapseOne"
                            aria-expanded="true"
                            aria-controls="collapseOne"><span>Categorias</span></a>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-mdb-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="sidenav-collapse scroll-section" style="display:block;">
                                    @foreach ($categories as $category)
                                        <li class="sidenav-item">
                                            <a class="sidenav-link" href="{{url("search/post/category/$category->id")}}">{{$category->category}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                @auth
                    <li class="sidenav-item">
                        <a class="sidenav-link" href="{{url("my/posts")}}">
                            <span>Mis Posts</span>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a class="sidenav-link" href="{{url("my/profile")}}">
                            <span>Mi Perfil</span>
                        </a>
                    </li>
                    @if ($notifications->count() > 0)
                        <a class="sidenav-link" href="{{url("notifications")}}">
                            Notificaciones
                            <span style="height: 8px;
                            margin-bottom: 8px;
                            clip-path: circle();" class="badge badge-danger d-inline-block"></span>
                        </a>
                    @endif
                    <li class="sidenav-item">
                        <a class="sidenav-link" href="{{url("logout")}}">
                            <span>Salir</span>
                        </a>
                    </li>
                @endauth
                @guest
                    <li class="sidenav-item">
                        <a class="sidenav-link" href="{{url("login")}}">
                            <span>Login</span>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a class="sidenav-link" href="{{url("register")}}">
                            <span>Registro</span>
                        </a>
                    </li>
                @endguest
            </ul>
            <div class="text-center" style="min-height: 3rem">
                <hr class="mt-0 mb-2" />
                <small>andresmarquez.herokuapp.com</small>
            </div>
        </div>
    </nav>
    <!-- Sidenav -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-o position-fixed">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Otter</a>
            {{-- <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button> --}}
            <div class="nav-link d-lg-none">
                <div class="d-flex ms-auto">
                    <div class="dropdown">
                        <h4 class="m-0 text-white-50 me-4 rounded-pill" aria-controls="#sidenav-1" aria-haspopup="true"  id="dropdownMenuButton"
                        data-mdb-toggle="dropdown"
                        aria-expanded="false">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </h4>
                        <ul class="dropdown-menu" style="  left: -13rem;right: 0;width: 15rem;" aria-labelledby="dropdownMenuButton">
                          <li class="px-1 py-2">
                            <form class="w-auto d-flex input-group" action="{{url("search/post")}}" method="GET">
                                <input
                                  type="search"
                                  class="form-control"
                                  name="query"
                                  placeholder="Buscar..."
                                  aria-label="Search"
                                />
                                <button class="btn btn-outline-primary" type="submit" data-ripple-color="dark">
                                  Buscar
                                </button>
                            </form>
                          </li>
                        </ul>
                    </div>
                    <h4 data-mdb-toggle="sidenav" id="toggle" data-mdb-target="#sidenav-1" class="m-0 text-muted rounded-pill" aria-controls="#sidenav-1" aria-haspopup="true" >
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </h4>
                </div>
            </div>
            <div class="collapse navbar-collapse d-lg-flex d-none" id="navbarText">
                <ul class="mb-2 navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{url("/")}}">Inicio</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{url("create/post")}}">Crear Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{url("historical")}}">Historial</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{url("authors")}}">Autores</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" id="dropdownMenuButton" data-mdb-toggle="dropdown"
                            aria-expanded="false">
                            Categorias
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item" href="{{url("search/post/category/$category->id")}}">{{$category->category}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @auth
                        @if (auth()->user()->profile->role_id == 1)
                            <li class="nav-item dropdown">
                                <div class="m-0 nav-link dropdown-toggle" aria-controls="#sidenav-1" aria-haspopup="true"  id="dropdownMenuButton"
                                data-mdb-toggle="dropdown"
                                aria-expanded="false">
                                    Admin
                                </div>
                                <ul class="dropdown-menu animate" style="  left: -6rem;right: 0;min-width:13rem;" aria-labelledby="dropdownMenuButton">
                                    <li class="px-1 py-2">
                                        <a class="dropdown-item" href="{{url("categories")}}">Categorias</a>
                                        <a class="dropdown-item" href="{{url("statistical")}}">Estadisticas</a>
                                        <a class="dropdown-item" href="{{url("tags")}}">Etiquetas</a>
                                        <a class="dropdown-item" href="{{url("images/portada")}}">Fotos de portada</a>
                                        <a class="dropdown-item" href="{{url("image/default")}}">Foto por defecto</a>
                                        <a class="dropdown-item" href="{{url("roles")}}">Roles</a>
                                        <a class="dropdown-item" href="{{url("users/block")}}">Usuarios Bloqueados</a>
                                        {{-- <a class="dropdown-item" href="{{url("my/posts")}}">Usuarios y Publicaciones</a> --}}
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item dropdown">
                        <h4 class="m-0 text-white-50 rounded-pill nav-link" aria-controls="#sidenav-1" aria-haspopup="true"  id="dropdownMenuButton"
                        data-mdb-toggle="dropdown"
                        aria-expanded="false">
                            <i class="fa fa-search pb-2" style="font-size:14px" aria-hidden="true"></i>
                        </h4>
                        <ul class="dropdown-menu" style="  left: -13rem;right: 0;width: 15rem;" aria-labelledby="dropdownMenuButton">
                            <li class="px-1 py-2">
                                <form class="w-auto d-flex input-group" action="{{url("search/post")}}" method="GET">
                                    <input
                                    type="search"
                                    class="form-control"
                                    name="query"
                                    placeholder="Buscar..."
                                    aria-label="Search"
                                    />
                                    <button class="btn btn-outline-primary" type="submit" data-ripple-color="dark">
                                    Buscar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <h4 class="m-0 text-white-50 rounded-pill nav-link" aria-controls="#sidenav-1" aria-haspopup="true"  id="dropdownMenuButton"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false">
                                <div class="m-0 chip">
                                    <img src="{{empty(auth()->user()->img_profile()->img_url  ) ? asset("images_user/default.png") : asset(auth()->user()->img_profile()->img_url)}}" alt="Perfil" style="clip-path: circle() !important;
                                    width: 2rem;" />
                                    <span class="dropdown-toggle"><span class="d-none d-xl-inline">{{Str::limit(auth()->user()->name,25)}}</span></span>
                                </div>
                            </h4>
                            <ul class="dropdown-menu animate" style="  left: -6rem;right: 0;width: 10rem;" aria-labelledby="dropdownMenuButton">
                                <li class="px-1 py-2">
                                    <a class="dropdown-item" href="{{url("my/profile")}}">Mi perfil</a>
                                    <a class="dropdown-item" href="{{url("my/posts")}}">Mis Posts</a>
                                    @if ($notifications->count() > 0)
                                        <a class="dropdown-item" href="{{url("notifications")}}">
                                            Notificaciones
                                            <span style="height: 8px;
                                            margin-bottom: 8px;
                                            clip-path: circle();" class="badge badge-danger d-inline-block"></span>
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{url("logout")}}">Salir</a>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
                @guest
                    <ul class="mb-2 navbar-nav mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("login")}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("register")}}">Registro</a>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </nav>
    <div style="margin-top:-.9rem">
        <br><br><br>
    </div>
</div>
