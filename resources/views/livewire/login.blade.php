<div>
    <div class="bg-light vh-100-min w-100" x-data="data()">
        <div class="px-3 pt-5 d-flex justify-content-center">
            <div class="px-4 py-5 bg-white rounded shadow-sm w-95 w-sm-60 w-md-40">
                <div class="mb-4">
                    <h4 class="text-center">Iniciar Sesión</h4>
                </div>
                <form class="row g-3" id="sub" wire:submit.prevent="login" action="" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email" class="form-label {{ ! empty($errors->first('email')) ? "text-danger" : ""}}">Correo</label>
                            <input type="text" class="form-control {{ ! empty($errors->first('email')) ? "is-invalid input-error" : ""}}" name="email" id="email" wire:model="email" required>
                            <small id="helpId" class="text-danger">{{$errors->first("email") ? $errors->first("email") : null}}</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="password" class="form-label {{ ! empty($errors->first('password')) ? "text-danger" : ""}}">Contreña</label>
                        <div class="input-group">
                            <input x-bind:type="password" class="form-control {{ ! empty($errors->first('password')) ? "is-invalid input-error" : ""}}" id="password" name="password" wire:model="password" required>
                            <span class="input-group-text" x-on:click="view" x-html="text_button">ver</span>
                        </div>
                        <small id="helpId" class="text-danger">{{$errors->first("password") ? $errors->first("password") : null}}</small>
                    </div>
                    <div class="mt-5 col-12 d-flex justify-content-center">
                        <button class="btn btn-info btn-block" type="submit" wire:loading.class="disabled">
                            Login
                        </button>
                    </div>
                </form>
                <br>
                <div class="d-flex justify-content-center">
                    <div>
                        No tienes una cuenta?
                        <a href="{{url('register')}}" class="link-info">Registrarme
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.class="d-flex" wire:target="login" class="spiner-wire">
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
                text_button: "ver",
                view(){
                    if(this.password === "password") this.password = "text";
                    else this.password = "password";
                    if(this.text_button === "ver") this.text_button = "secreto";
                    else this.text_button = "ver";
                }
            }
        }
    </script>
</div>
