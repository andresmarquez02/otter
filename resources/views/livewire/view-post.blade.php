<div>
    <div class="m-0 my-5 row px-xl-5 px-lg-2">
        <div class="col-md-8">
            <div class="px-3 py-3 shadow-sm card">
                <div class="display-4 font-weight-bold">
                    {{$post->title}}
                </div>
                <div class="py-4 text-justify">
                    {!!$post->description!!}
                </div>
                <div class="py-4">
                    {!!$post->body!!}
                </div>
                <div>
                    Posteado {{$post->created_at->diffForHumans()}}
                </div>
                <div class="mt-5 mb-3 d-flex">
                    <img src="{{!empty($post->user()->img_url) ? asset($post->user()->img_url) : asset("images_user/default.png")}}" alt="Image User" style="clip-path: circle();width:3rem;height:3rem">
                    <div class="ms-2">
                        <span  style="font-size: 14px">{{$post->user()->name}}</span>
                        <small class="d-block" style="font-size: 10px">Autor</small>
                    </div>
                </div>
                <div class="mt-3">
                    @auth
                    @if ($post->user_id == auth()->user()->id)
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
        <div class="mt-5 col-md-4 mt-md-0">
            <div class="position-relative">
                @include("livewire.views.bar_data")
            </div>
        </div>
    </div>
</div>
