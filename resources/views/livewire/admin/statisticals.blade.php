<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="d-flex justify-content-center">
        <div class="w-95 w-sm-85 row">
            <div class="mb-3 col-md-4 col-sm-6">
                <div class="p-3 bg-white rounded shadow-sm">
                    <div>Usuarios Registrados</div>
                    <h5 class="fw-bold">{{$users->count()}}</h5>
                </div>
            </div>
            <div class="mb-3 col-md-4 col-sm-6">
                <div class="p-3 bg-white rounded shadow-sm">
                    Posts Creados
                    <h5 class="fw-bold">{{$posts->count()}}</h5>
                </div>
            </div>
            <div class="mb-3 col-12">
                <div class="p-3 bg-white rounded shadow-sm">
                    Autor con mas vistas
                    <div class="col-12">
                        <div>
                            <div class="p-3 card-body">
                                <div class="mb-3 d-flex">
                                    <img src="{{!empty($author_views->img_profile()->img_url) ? asset($author_views->img_profile()->img_url) : asset("images_user/default.png")}}" alt="Image User" style="clip-path: circle();width:3rem;height:3rem">
                                    <div class="ms-2">
                                        <span  style="font-size: 14px">{{$author_views->name}}</span>
                                        <small class="d-block" style="font-size: 10px">Autor</small>
                                    </div>
                                </div>
                                <p class="text-justify">{{!empty($author_views->description) ? Str::limit($author_views->description,150) : "Sin descripción"}}</p>
                                <div>
                                    <small style="font-size: 10px">{{$author_views->posts}} Publicaciones</small>
                                    <small class="ms-3" style="font-size: 10px">{{$author_views->views}} Vistas</small>
                                </div>
                                <a href="{{url("view/profile/$author_views->id")}}" class="card-link btn btn-text-primary">Perfil</a>
                                @if (auth()->user()->profile->role_id == 1)
                                    <button type="button" wire:click='blockUser({{$author_views->id}})' class="ms-0 card-link btn btn-text-dark">Bloquear</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-12">
                <div class="p-3 bg-white rounded shadow-sm">
                    Autor con mas publicaciones
                    <div class="col-12">
                        <div>
                            <div class="p-3 card-body">
                                <div class="mb-3 d-flex">
                                    <img src="{{!empty($author_posts->img_profile()->img_url) ? asset($author_posts->img_profile()->img_url) : asset("images_user/default.png")}}" alt="Image User" style="clip-path: circle();width:3rem;height:3rem">
                                    <div class="ms-2">
                                        <span  style="font-size: 14px">{{$author_posts->name}}</span>
                                        <small class="d-block" style="font-size: 10px">Autor</small>
                                    </div>
                                </div>
                                <p class="text-justify">{{!empty($author_posts->description) ? Str::limit($author_posts->description,150) : "Sin descripción"}}</p>
                                <div>
                                    <small style="font-size: 10px">{{$author_posts->posts}} Publicaciones</small>
                                    <small class="ms-3" style="font-size: 10px">{{$author_posts->views}} Vistas</small>
                                </div>
                                <a href="{{url("view/profile/$author_posts->id")}}" class="card-link btn btn-text-primary">Perfil</a>
                                @if (auth()->user()->profile->role_id == 1)
                                    <button type="button" wire:click='blockUser({{$author_posts->id}})' class="ms-0 card-link btn btn-text-dark">Bloquear</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-12">
                <div class="p-3 bg-white rounded shadow-sm">
                    Post con mas vistas en el mes
                    @if ($post_month->user()->status == 1)
                        <div class="col-12">
                            <div>
                                <div class="p-3 card-body">
                                    <div class="mb-3 d-flex">
                                        <img src="{{!empty($post_month->user()->img_url) ? asset($post_month->user()->img_url) : asset("images_user/default.png")}}" alt="Image User" style="clip-path: circle();width:3rem;height:3rem">
                                        <div class="ms-2">
                                            <span  style="font-size: 14px">{{$post_month->user()->name}}</span>
                                            <small class="d-block" style="font-size: 10px">Autor</small>
                                        </div>
                                    </div>
                                    <h5 class="card-title">{{$post_month->title}}</h5>
                                    <p class="text-justify">{{Str::limit($post_month->description,150)}}</p>
                                    <small class="mb-3 d-block">Publicado {{__($post_month->created_at->diffForHumans())}}</small>
                                    <a href="{{url("view/post/".$post_month->id)}}" class="ms-0 card-link btn btn-text-primary">Ver</a>
                                    @auth
                                        @if (auth()->user()->profile->role_id == 1)
                                            <button type="button" wire:click='blockPost({{$post_month->id}})' class="ms-0 card-link btn btn-text-dark">Bloquear</button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mb-3 col-12">
                <div class="p-3 bg-white rounded shadow-sm">
                    Post con mas vistas
                    @if ($post->user()->status == 1)
                        <div class="col-12">
                            <div>
                                <div class="p-3 card-body">
                                    <div class="mb-3 d-flex">
                                        <img src="{{!empty($post->user()->img_url) ? asset($post->user()->img_url) : asset("images_user/default.png")}}" alt="Image User" style="clip-path: circle();width:3rem;height:3rem">
                                        <div class="ms-2">
                                            <span  style="font-size: 14px">{{$post->user()->name}}</span>
                                            <small class="d-block" style="font-size: 10px">Autor</small>
                                        </div>
                                    </div>
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p class="text-justify">{{Str::limit($post->description,150)}}</p>
                                    <small class="mb-3 d-block">Publicado {{__($post->created_at->diffForHumans())}}</small>
                                    <a href="{{url("view/post/".$post->id)}}" class="ms-0 card-link btn btn-text-primary">Ver</a>
                                    @auth
                                        @if (auth()->user()->profile->role_id == 1)
                                            <button type="button" wire:click='blockPost({{$post->id}})' class="ms-0 card-link btn btn-text-dark">Bloquear</button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div wire:loading.class="d-flex" wire:target="ablock" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>
