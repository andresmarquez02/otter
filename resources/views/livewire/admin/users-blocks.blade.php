<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="d-flex justify-content-center">
        <div class="p-4 bg-white rounded shadow-sm w-95 w-sm-85 ">
            <div class="mb-4 row">
                <div class="col-md-4 col-sm-6">
                    <form action="" method="get" wire:submit.prevent='searching'>
                        <div class="form-group">
                          <input type="text" name="search" wire:model="search" class="form-control" placeholder="Buscar Usuario..." aria-describedby="helpId">
                          <small id="helpId" class="text-muted">{{$errors->first("search") ? $errors->first("search") : null}}</small>
                        </div>
                    </form>
                </div>
            </div>
            @if($users->count() == 0)
                <h4 class="my-3 text-center">
                    @if (!empty($search))
                        No hay resultados en su busqueda
                    @else
                        No hay usuarios bloqueados
                    @endif
                </h4>
            @else
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>Usuario</th>
                            <th>Publicaciones</th>
                            <th>Vistas</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <img src="{{!empty($user->img_profile()->img_url) ? asset($user->img_profile()->img_url) : asset("images_user/default.png")}}" alt="Image User" style="clip-path: circle();width:3rem;height:3rem" />
                                        <div class="ms-1 small">
                                            {{$user->name}}
                                            <br>
                                            {{$user->email}}
                                        </div>
                                    </div>
                                </td>
                                <td><div class="d-flex justify-content-end">{{$user->views_posts->posts}}</div></td>
                                <td><div class="d-flex justify-content-end">{{$user->views_posts->views}}</div></td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-text-primary" data-mdb-toggle="modal" data-mdb-target="#modalAblock{{$user->id}}">Desbloquear</button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" wire:ignore id="modalAblock{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Desbloquar Usuario</h5>
                                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"
                                                    ></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Esta seguro que desea desbloquear este usuario?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-dark" data-mdb-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-mdb-dismiss="modal" wire:click="ablock({{$user->id}})">
                                                        SI! Desbloquear
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            @endif
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
