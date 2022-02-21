<div x-data="data()">
    {{-- The Master doesn't talk, he acts. --}}
    <div class="d-flex justify-content-center">
        <div class="p-4 bg-white rounded shadow-sm w-95 w-sm-85 w-md-60">
            <div class="d-flex">
                <div class="form-group me-auto">
                    <form action="" wire:submit.prevent='searching' method="get">
                        <input type="text" name="search" wire:model="search" class="form-control" placeholder="Buscar..." aria-describedby="helpId">
                    <small id="helpId" class="text-danger">{{$errors->first("search") ? $errors->first("search") : null}}</small>
                  </form>
                </div>
                <div class="ms-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary me-auto" data-mdb-toggle="modal" data-mdb-target="#exampleModal" x-on:click="reset_category">
                        Nueva Categoria
                    </button>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" wire:ignore id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"
                            ></button>
                        </div>
                        <form action="" wire:submit.prevent='save_category' method="get">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Categoria</label>
                                    <input type="text" name="category" id="category" wire:model="category" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small id="helpId" class="text-danger">{{$errors->first("category") ? $errors->first("category") : null}}</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-text-dark" data-mdb-dismiss="modal">
                                    Cerrar
                                </button>
                                <button type="submit" class="btn btn-text-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="o-x-auto">
                @empty($categories)
                    <h4 class="pt-5 pb-4 text-center">No hay categorias creadas</h4>
                @else
                    <table class="table mt-4 table-md-responsive">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Categoria</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key => $category)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$category->category}}</td>
                                    <td>
                                        <button type="button" class="btn btn-text-warning" data-mdb-toggle="modal"
                                        data-mdb-target="#modalEdit" wire:click="edit_category('{{$category->category}}',{{$category->id}})">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-text-danger" wire:click="delete_category({{$category->id}})">Eliminar</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"><h5 class="text-center">No hay resultados en tu busqueda</h5></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$categories->links()}}
                    <div class="modal fade" wire:ignore id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Categoria</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"
                                    ></button>
                                </div>
                                <form action="" wire:submit.prevent='update_category' method="get">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Categoria</label>
                                            <input type="text" name="category" wire:model="category" class="form-control" placeholder="" aria-describedby="helpId">
                                            <small id="helpId" class="text-danger">{{$errors->first("category") ? $errors->first("category") : null}}</small>
                                        </div>
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
                @endempty
            </div>
        </div>
    </div>
    <div wire:loading.class="d-flex" wire:target="save_category,edit_category,update_category,delete_category" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>
<script>
    function data(){
        return {
            reset_category(){
                document.getElementById("category").value="";
                @this.set('category', '');
            }
        }
    }
</script>
