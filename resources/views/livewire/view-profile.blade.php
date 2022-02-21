<div>
    <div class="w-100 img-portada position-relative" style="background-image: linear-gradient(130deg, #0000002c,#0c0c0f56),url('{{asset($user->img_portada()->img)}}')">
        <div class="text-center position-absolute w-100" style="top:35%">
            <div>
                @foreach ($user_networks as $item)
                    <a href="{{$item->url}}" target="_blank" rel="noopener noreferrer" class="text-white">
                        <i class="text-white h3 mdi mdi-{{strtolower($item->network->network)}}"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="position-relative">
        <div class="text-center d-flex position-absolute w-100" style="top:-60%;flex-direction:column;align-items: center">
            <div class="mb-3 position-relative" style="height:8rem;width:8rem;clip-path:circle()">
                <img src="{{empty($user->img_profile()->img_url) ? asset("images_user/default.png") : asset($user->img_profile()->img_url)}}" alt="" style="height:8rem;width:8rem;clip-path:circle()">
            </div>
            <h3 clas="fw-bold">
                <strong>{{$user->name}}</strong>
            </h3>
            <div>
                <span class="badge badge-primary text-dark">Vistas {{$user->views_posts->views}}</span>
                <span class="badge badge-primary text-dark">Publicaciones {{$user->views_posts->posts}}</span>
            </div>
        </div>
        <br><br><br><br><br>
    </div>
    <div class="d-flex justify-content-center">
        <div class="m-0 mt-4 row w-md-75">
            <div class="mb-3 col-md-6 col-12">
                <h6 clas="fw-bold"><strong>Profesión</strong></h6>
                {{$user->profile->profession}}
            </div>
            <div class="mb-3 col-md-6 col-12">
                <h6 clas="fw-bold"><strong>Portafolio</strong></h6>
                <a href="{{$user->profile->url_portfolio}}" target="_blank" rel="noopener noreferrer">{{$user->profile->url_portfolio}}</a>
            </div>
            <div class="col-12">
                <h6 clas="fw-bold"><strong>Sobre mi</strong></h6>
                <p class="text-justify">
                    @if (Str::length($user->profile->description) > 300)
                        @if($view_details)
                            {{Str::limit($user->profile->description, 300)}}
                        @else
                            {{$user->profile->description}}
                        @endif
                        <div class="mt-3">
                            <button type="button" class="btn btn-text-primary" wire:click="view">
                                {{$view_details ? "Ver más" : "Ver menos"}}
                            </button>
                            @auth
                                @if (auth()->user()->profile->role_id == 1)
                                    <button type="button" wire:click='blockUser({{$user->id}})' class="ms-0 card-link btn btn-text-dark">Bloquear</button>
                                @endif
                            @endauth
                        </div>
                    @else
                        {{$user->profile->description}}
                        @auth
                            @if (auth()->user()->profile->role_id == 1)
                                <button type="button" wire:click='blockUser({{$user->id}})' class="ms-0 card-link btn btn-text-dark">Bloquear</button>
                            @endif
                        @endauth
                    @endif
                </p>
            </div>
            <div>

            </div>
        </div>
    </div>
</div>
