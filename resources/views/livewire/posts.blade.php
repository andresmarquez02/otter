<div>
    <div class="m-0 row px-xl-4 px-lg-2">
        <div class="px-0 col-md-8">
            <div class="m-0 row ">
                @forelse ($posts_all as $post)
                    @if ($post->user()->status == 1)
                        <div class="mb-3 col-12">
                            <div class="shadow-sm card">
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
                                    <a href="{{url("view/post/$post->id")}}" class="ms-0 card-link btn btn-text-primary">Ver</a>
                                    @auth
                                        @if ($post->user_id == auth()->user()->id && !empty($user_id))
                                            <a href="{{url("/edit/post/$post->id")}}" class="ms-0 card-link btn btn-text-warning">Editar</a>
                                            <span wire:click='destroyPost({{$post->id}})' class="ms-0 card-link btn btn-text-danger">Eliminar</span>
                                        @endif
                                        @if (auth()->user()->profile->role_id == 1)
                                            <button type="button" wire:click='blockPost({{$post->id}})' class="ms-0 card-link btn btn-text-dark">Bloquear</button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center col-12 h1 font-weight-bold">
                        @if (!empty($this->user_id))
                            No has creado un post
                        @elseif (!empty($this->search))
                            No hay resultados de tu busqueda...
                        @elseif (!empty($this->search_category))
                            No hay resultados de tu busqueda...
                        @else
                            No se ha agregado ningun post
                        @endif
                    </div>
                @endforelse
                {{ $posts_all->links() }}
            </div>
        </div>
        <div class="mt-5 col-md-4 mt-md-0">
            <div class="position-relative">
                @include("livewire.views.bar_data")
            </div>
        </div>
    </div>
    <div wire:loading.class="d-flex" wire:target="destroyPost,blockPost" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    </div>
</div>
