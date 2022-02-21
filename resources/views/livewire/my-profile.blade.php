<div x-data="data()">
    <div class="w-100 img-portada position-relative" style="background-image: linear-gradient(130deg, #0000002c,#0c0c0f56),url('{{asset("$img_portada")}}')">
        <div class="position-absolute" style="top:4%;left:2%;">
            @foreach ($portadas as $portada)
                <label class="form-check-label" for="portada{{$portada->id}}">
                    <input type="radio" class="form-check-input" wire:click="change_portada('{{$portada->img}}',{{$portada->id}})" hidden name="img_portada" id="portada{{$portada->id}}" value="checkedValue">
                    <img src="{{asset("$portada->img")}}" style="height:3rem;width:3rem;clip-path:circle()">
                </label>
            @endforeach
        </div>
    </div>
    <div class="position-relative">
        <div class="text-center position-absolute w-100" style="top:-180%">
            <div>
                <i class="text-white h3 mdi mdi-facebook"></i>
                <i class="text-white ms-5 h3 mdi mdi-instagram"></i>
                <i class="text-white ms-5 h3 mdi mdi-twitter"></i>
                <i class="text-white ms-5 h3 mdi mdi-linkedin"></i>
                <div class="mt-2">
                    <button class="btn btn-text-warning btn-water-warning" data-mdb-toggle="modal"
                    data-mdb-target="#exampleModal"
                    >Agregar / Editar Red</button>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center position-absolute w-100" style="top:-60%">
            <div class="position-relative" style="height:8rem;width:8rem;clip-path:circle()">
                <img src="{{empty($img_profile) ? asset("images_user/default.png") : asset(auth()->user()->img_profile()->img_url)}}" alt="" style="height:8rem;width:8rem;clip-path:circle()">
                <div class="position-absolute d-flex justify-content-center align-items-center bg-black-50" style="top:0;left:0;width:100%;height:100%">
                    <button type="button" class="btn btn-text-info btn-sm" data-mdb-toggle="modal"
                    data-mdb-target="#ModalFoto">Actualizar</button>
                </div>
            </div>
        </div>
        <br><br><br><br>
    </div>
    <!-- Modal -->
    <div class="modal fade" wire:ignore id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Redes Sociales</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-mdb-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form action="" method="get" id="form_network" wire:submit.prevent='update_network'>
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($networks as $key => $network)
                                <div class="pb-3 col-md-6">
                                    <div class="form-group">
                                      <label for="">{{$network->network}} <small>(Opcional)</small></label>
                                      <input type="url" name="network" id="network" class="form-control" placeholder="Url de tu perfil" aria-describedby="helpId" value="{{$user_networks->where("network_id",$network->id)->count() > 0 ? $user_networks->where("network_id",$network->id)->first()->url : ""}}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <small id="helpId" class="text-danger">{{$errors->first("url_network") ? $errors->first("url_network") : null}}</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-text-dark" data-mdb-dismiss="modal">
                            Cerrar
                        </button>
                        <button type="submit" id="guardar" class="btn btn-text-primary d-none">Guardar</button>
                        <button type="button" class="btn btn-text-primary" x-on:click="save_network({{$networks->pluck("id")}})">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore id="ModalFoto" tabindex="-1" aria-labelledby="ModalFotoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Foto de Perfil</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-mdb-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    @empty($img_profile)
                        <input type="file" id="input-file-now" class="dropify" wire:model="img_profile_new" name="imagen" accept="image/png, .jpeg, .jpg, image/gif"/>
                    @else
                        <input type="file" id="input-file-now" class="dropify" wire:model="img_profile_new" name="imagen" accept="image/png, .jpeg, .jpg, image/gif" data-default-file="{{asset("$img_profile")}}"/>
                    @endempty
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-text-dark" data-mdb-dismiss="modal">
                        Cerrar
                    </button>
                    <button type="button" class="btn btn-text-primary" wire:click="change_profile" wire:loading.class="disabled">
                        <div wire:loading.class="d-inline-block" style="display:none">
                            <span class="spinner-border spinner-border-sm" role="status"  aria-hidden="true"
                            ></span>
                        </div>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="px-2 mb-5 px-sm-0">
        <form action="" wire:submit.prevent='update_info' method="get">
            <div class="container">
                <div class="px-2 py-4 bg-white rounded shadow-sm row p-md-4">
                    <div class="pb-4 form-group col-md-6">
                        <label for="">Nombre</label>
                        <input type="text" name="name" x-model="name" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-danger">{{$errors->first("name") ? $errors->first("name") : null}}</small>
                    </div>
                    <div class="pb-4 form-group col-md-6">
                        <label for="">Correo</label>
                        <input type="text" name="email" x-model="email" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-danger">{{$errors->first("email") ? $errors->first("email") : null}}</small>
                    </div>
                    <div class="pb-4 form-group col-md-6">
                        <label for="">Profesion</label>
                        <input type="text" name="profession" x-model="profession" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-danger">{{$errors->first("profession") ? $errors->first("profession") : null}}</small>
                    </div>
                    <div class="pb-4 form-group col-md-6">
                        <label for="">Url de mi portafolio</label>
                        <input type="text" name="url_portfolio" x-model="url_portfolio" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-danger">{{$errors->first("url_portfolio") ? $errors->first("url_portfolio") : null}}</small>
                    </div>
                    <div class="pb-4 form-group col-12">
                        <label for="">Sobre Mi</label>
                        <textarea name="description" x-model="description" class="form-control" cols="30" rows="5"></textarea>
                        <small id="helpId" class="text-danger">{{$errors->first("description") ? $errors->first("description") : null}}</small>
                    </div>
                    <div class="mt-1 form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div wire:loading.class="d-flex" wire:target="change_profile,change_portada,update_info,update_network" class="spiner-wire">
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
            name: @entangle("name").defer,
            email: @entangle("email").defer,
            profession: @entangle("profession").defer,
            url_portfolio: @entangle("url_portfolio").defer,
            description: @entangle("description").defer,
            url_network: @entangle('url_network').defer,
            save_network(id_networks){
                this.url_network = [];
                network = document.querySelectorAll("#network");
                network.forEach((element,i) => {
                    this.url_network.push([{'network_url': element.value, 'network_id': id_networks[i]}]);
                });
                document.getElementById("guardar").click();
            }
        }
    }
</script>
