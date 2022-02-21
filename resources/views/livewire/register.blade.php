<div>
    <div class="bg-light vh-100-min w-100" x-data="data()">
        <div class="px-2 pt-5 d-flex justify-content-center">
            <div class="px-4 py-5 bg-white rounded shadow-sm w-95 w-md-75">
                <div class="mb-4 text-center">
                    <h4>Registrate</h4>
                </div>
                <form class="row g-3" action="" wire:submit.prevent="register" method="POST">
                    @csrf
                    <div class="mt-3 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label {{ ! empty($errors->first('name')) ? "text-danger" : ""}}">Nombre completo</label>
                            <input type="text" class="form-control {{ ! empty($errors->first('name')) ? "is-invalid input-error" : ""}}" wire:model="name" required/>
                            <small id="helpId" class="text-danger">{{$errors->first("name") ? $errors->first("name") : null}}</small>
                        </div>
                    </div>
                    @guest
                        <div class="mt-3 col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label {{ ! empty($errors->first('email')) ? "text-danger" : ""}}">Correo</label>
                                <input type="text" class="form-control {{ ! empty($errors->first('email')) ? "is-invalid input-error" : ""}}" name="email" wire:model="email" required>
                                <small id="helpId" class="text-danger">{{$errors->first("email") ? $errors->first("email") : null}}</small>
                            </div>
                        </div>
                    @endguest
                    <div class="mt-3 col-md-6 col-12">
                        <label class="form-label {{ ! empty($errors->first('name')) ? "text-danger" : ""}}">Contraseña</label>
                        <div class="input-group">
                            <input x-bind:type="password" class="form-control {{ ! empty($errors->first('password')) ? "is-invalid input-error" : ""}}" name="password" {{auth()->user() ? "" : "required"}} wire:model='password'>
                            <span class="input-group-text" x-on:click="view" x-html="text_button"></span>
                        </div>
                        <small id="helpId" class="text-danger">{{$errors->first("password") ? $errors->first("password") : null}}</small>
                    </div>
                    <div class="mt-3 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label {{ ! empty($errors->first('password_confirmation')) ? "text-danger" : ""}}">Confirmar contraseña</label>
                            <input x-bind:type="password" class="form-control {{ ! empty($errors->first('password_confirmation')) ? "is-invalid input-error" : ""}}" name="password_confirmation" {{auth()->user() ? "" : "required"}} wire:model='password_confirmation'>
                            <small id="helpId" class="text-danger">{{$errors->first("password_confirmation") ? $errors->first("password_confirmation") : null}}</small>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input {{ ! empty($errors->first('term')) ? "input-error" : ""}}" type="checkbox" name="term" required value="1" wire:model="term">
                            <label class="form-check-label {{ ! empty($errors->first('term')) ? "text-danger" : ""}}">
                            Acepto termino y condiciones
                            </label>
                            <small id="helpId" class="text-danger">{{$errors->first("term") ? $errors->first("term") : null}}</small>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-info" type="submit"  wire:loading.class="disabled">
                            Registrarme
                        </button>
                    </div>
                </form>
                <br>
                <div class="d-flex justify-content-center">
                    <div>
                        Ya tienes una cuenta?
                        <a href="{{url('login')}}" class="link-info">Iniciar Sesion
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.class="d-flex" wire:target="register" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    </div>
    <script>
        function data() {
            return {
                password: "password",
                text_button: "view",
                view(){
                    if(this.password === "password") this.password = "text";
                    else this.password = "password";
                    if(this.text_button === "view") this.text_button = "secret";
                    else this.text_button = "view";
                }
            }
        }
    </script>
</div>
