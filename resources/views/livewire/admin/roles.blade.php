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
                    <button type="button" class="btn btn-primary me-auto" data-mdb-toggle="modal" data-mdb-target="#exampleModal" x-on:click="reset_role">
                        Nuevo rol
                    </button>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" wire:ignore id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Crear Rol</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"
                            ></button>
                        </div>
                        <form action="" wire:submit.prevent='save_role' method="get">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Rol</label>
                                    <input type="text" name="role" id="role" wire:model="role" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small id="helpId" class="text-danger">{{$errors->first("role") ? $errors->first("role") : null}}</small>
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
                @empty($roles)
                    <h4 class="pt-5 pb-4 text-center">No hay roles creados</h4>
                @else
                    <table class="table mt-4 table-md-responsive">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Rol</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $key => $role)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$role->role}}</td>
                                    <td>
                                        <button type="button" class="btn btn-text-warning" data-mdb-toggle="modal"
                                        data-mdb-target="#modalEdit" wire:click="edit_role('{{$role->role}}',{{$role->id}})">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-text-danger" wire:click="delete_role({{$role->id}})">Eliminar</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"><h5 class="text-center">No hay resultados en tu busqueda</h5></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$roles->links()}}
                    <div class="modal fade" wire:ignore id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Rol</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"
                                    ></button>
                                </div>
                                <form action="" wire:submit.prevent='update_role' method="get">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Rol</label>
                                            <input type="text" name="role" wire:model="role" class="form-control" placeholder="" aria-describedby="helpId">
                                            <small id="helpId" class="text-danger">{{$errors->first("role") ? $errors->first("role") : null}}</small>
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
    <div wire:loading.class="d-flex" wire:target="save_role,edit_role,update_role,delete_role" class="spiner-wire">
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
            reset_role(){
                document.getElementById("role").value="";
                @this.set('role', '');
            }
        }
    }
</script>
