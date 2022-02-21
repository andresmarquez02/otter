<div>
    <div class="m-0 row px-xl-4 px-lg-2">
        <div class="col-md-8">
            <div class="m-0 row ">
                @forelse ($authors as $author)
                    <div class="mb-3 col-12">
                        <div class="shadow-sm card">
                            <div class="p-3 card-body">
                                <div class="mb-3 d-flex">
                                    <img src="{{!empty($author->img_profile()->img_url) ? asset($author->img_profile()->img_url) : asset("images_user/default.png")}}" alt="Image User" style="clip-path: circle();width:3rem;height:3rem">
                                    <div class="ms-2">
                                        <span  style="font-size: 14px">{{$author->name}}</span>
                                        <small class="d-block" style="font-size: 10px">Autor</small>
                                    </div>
                                </div>
                                <p class="text-justify">{{!empty($author->description) ? Str::limit($author->description,150) : "Sin descripción"}}</p>
                                <div>
                                    <small style="font-size: 10px">{{$author->posts}} Publicaciones</small>
                                    <small class="ms-3" style="font-size: 10px">{{$author->views}} Vistas</small>
                                </div>
                                <a href="{{url("view/profile/$author->id")}}" class="card-link btn btn-text-primary">Perfil</a>
                                @auth
                                    @if (auth()->user()->profile->role_id == 1)
                                        <button type="button" wire:click='blockUser({{$author->id}})' class="ms-0 card-link btn btn-text-dark">Bloquear</button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-12 h1 font-weight-bold">
                        No hay autores registrados.
                    </div>
                @endforelse
            </div>
        </div>
        <div class="mt-5 col-md-4 mt-md-0">
            @include("livewire.views.bar_data")
        </div>
    </div>
    <div wire:loading.class="d-flex" wire:target="destroyPost" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    </div>
</div>
