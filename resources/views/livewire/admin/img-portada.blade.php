<div>
    <div class="d-flex justify-content-center">
        <div class="p-4 bg-white rounded shadow-sm w-95">
            <div class="d-flex">
                <button type="button" class="btn btn-primary ms-auto" data-mdb-toggle="modal" data-mdb-target="#exampleModal">Agregar Imagen</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" wire:ignore id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Foto</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="" method="get" wire:submit.prevent='save_img'>
                            <div class="modal-body">
                                <input type="file" id="input-file-now" wire:model='img' class="dropify" name="imagen" accept="image/png, .jpeg, .jpg, image/gif"/>
                                <small id="helpId" class="text-danger">{{$errors->first("img") ? $errors->first("img") : null}}</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-text-dark" data-mdb-dismiss="modal">
                                    Cerrar
                                </button>
                                <button type="submit" class="btn btn-text-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pt-5 m-0 row">
                @forelse ($images as $image)
                    <div class="mb-2 col-md-4 col-sm-6">
                        <div class="position-relative hover:opacity">
                            <img src="{{ asset($image->img) }}" class="rounded img-fluid w-100" style="height:15rem"
                                alt="">
                            <div class="rounded opacity-0 position-absolute w-100 h-100 bg-black-50 d-flex justify-content-center align-items-center"
                                style="top:0;left:0">
                                <div>
                                    <button type="button" class="btn btn-text-warning me-2" data-mdb-toggle="modal" data-mdb-target="#modalEdit{{$image->id}}">Editar</button>
                                    <button type="button" class="btn btn-text-danger" wire:click="destroyImg({{$image->id}})">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" wire:ignore id="modalEdit{{$image->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Foto</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" method="get" wire:submit.prevent='update_img({{$image->id}})'>
                                    <div class="modal-body">
                                        <input type="file" id="input-file-now" wire:model='img' class="dropify" name="imagen" accept="image/png, .jpeg, .jpg, image/gif" data-default-file="{{ asset($image->img) }}"/>
                                        <small id="helpId" class="text-danger">{{$errors->first("img") ? $errors->first("img") : null}}</small>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-text-dark" data-mdb-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button type="submit" class="btn btn-text-warning">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <h4 class="pt-5 pb-4 text-center">No hay imagenes agregadas </h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div wire:loading.class="d-flex" wire:target="destroyImg,save_img" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>
