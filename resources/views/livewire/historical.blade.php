<div>
    <div class="m-0 row px-xl-5 px-lg-2">
        <div class="col-12">
            <div class="m-0 row ">
                @forelse ($historical as $post)
                    @if (!empty($post->post()))
                        @if ($post->post()->status == 1 && !empty($post->post()->id))
                            <div class="mb-3 col-12">
                                <div class="shadow-sm card">
                                    <div class="p-3 card-body">
                                        <div class="mb-3 d-flex">
                                            <img src="{{!empty($post->post()->img_url) ? asset($post->post()->img_url) : asset("images_user/default.png")}}" alt="Image User" style="clip-path: circle();width:3rem;height:3rem">
                                            <div class="ms-2">
                                                <span  style="font-size: 14px">{{$post->post()->name}}</span>
                                                <small class="d-block" style="font-size: 10px">Autor</small>
                                            </div>
                                        </div>
                                        <h5 class="card-title">{{$post->post()->title}}</h5>
                                        <p class="text-justify">{{Str::limit($post->post()->description,150)}}</p>
                                        <small class="mb-3 d-block">Publicado hace {{Carbon\Carbon::parse($post->post()->created_at)->diffForHumans()}}</small>
                                        <a href="{{url("view/post/".$post->post()->id)}}" class="card-link">Ver</a>
                                        @auth
                                            @if ($post->user_id == auth()->user()->id && !empty($user_id))
                                                <a href="{{url("/edit/post/".$post->post()->id)}}" class="card-link">Edit</a>
                                                <span wire:click='destroyPost({{$post->post()->id}})' class="card-link">Delete</span>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @empty
                    <div class="text-center col-12 h1 font-weight-bold">
                        No hay ningun dato en  tu historial
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div wire:loading.class="d-flex" wire:target="destroyPost" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>
