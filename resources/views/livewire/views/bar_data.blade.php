<div class="mb-4">
    <div>Otros Articulos</div>
    <hr class="bg-info">
    @foreach ($populars as $popular)
        <div>
            <a class="text-dark" href="{{url("view/post/$popular->id")}}">
                <h6 class="font-weight-bold">{{$popular->title}}</h6>
            </a>
            <span class="badge badge-info">{{$popular->category->category}}</span>
            <small style="font-size: 12px">{{$popular->user()->name}}</small>
            <small style="font-size: 12px" class="text-muted">{{$popular->created_at->diffForHumans()}}</small>
            <hr class="bg-light-90">
        </div>
    @endforeach
</div>
<div class="mb-4">
    <div>Autores Destacados</div>
    <hr class="bg-info">
    @foreach ($popular_users as $popular_user)
        <div>
            <div class="mb-3 d-flex">
                <img src="{{!empty($popular_user->user()->img_url) ? asset($popular_user->user()->img_url) : asset("images_user/default.png")}}" alt="Image User" style="clip-path: circle();width:4rem;height:4rem">
                <div class="ms-2">
                    <span  style="font-size: 14px">{{$popular_user->user()->name}}</span>
                    <small class="d-block" style="font-size: 10px">{{$popular_user->posts}} Publicaciones</small>
                    <small class="d-block" style="font-size: 10px">{{$popular_user->views}} Vistas</small>
                </div>
            </div>
            <hr class="bg-light-90">
        </div>
    @endforeach
</div>
<div class="sticky-top">
    <div>Etiquetas</div>
    <hr class="bg-info">
    @foreach ($tags as $tag)
        <a href="" class="pe-3 text-dark text-decoration">{{$tag->tag}}</a>
    @endforeach
</div>
