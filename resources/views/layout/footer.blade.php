<div class="mt-5 mt-auto">
    <footer class="text-white bg-dark">
        @guest
            <div class="px-2 pt-5 m-0 px-md-3 px-lg-5 row">
                <div class="col-sm-4">
                    <h2>Otter</h2>
                    <p>Web de tutoriales sobre tecnología y programación.</p>
                    <p>Contáctanos: <span class="text-primary">andres03marquez@gmail.com</span></p>
                    <div>
                        <a href="https://github.com/andresmarquez02" class="p-2 btn btn-light me-2" style="clip-path:circle()">
                            <i class="fa-brands fa-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/andres-marquez-02/" class="p-2 btn btn-light me-2" style="clip-path:circle()">
                            <i class="fa-brands fa-linkedin" aria-hidden="true"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send/?phone=%2B584129298833&text&app_absent=0" class="p-2 btn btn-light me-2" style="clip-path:circle()">
                            <i class="fa-brands fa-whatsapp-square"></i>
                        </a>
                    </div>
                </div>
                <div class="text-md-center col-md-4">
                    <h5>Menú</h5>
                    <div>
                        <a class="text-white" href="{{url("/")}}">
                            <span>Inicio</span>
                        </a>
                    </div>
                    <div>
                        <a class="text-white" href="{{url("authors")}}">
                            <span>Autores</span>
                        </a>
                    </div>
                    @guest
                        <div>
                            <a class="text-white" href="{{url("login")}}">
                                <span>Login</span>
                            </a>
                        </div>
                        <div>
                            <a class="text-white" href="{{url("register")}}">
                                <span>Registro</span>
                            </a>
                        </div>
                    @endguest
                </div>
                <div class="col-md-4">
                    <h5>Únete a nosotros</h5>
                    <p>
                        Si tienes grandes ideas o has encontrado soluciones, te invitamos a que te unas
                        a este portal y compartas con nosotros tus solución
                    </p>
                    <div>
                        <a name="" id="" class="btn btn-primary" href="{{url("register")}}" role="button">Registrarme</a>
                    </div>
                </div>
            </div>
        @endguest
        <div class="py-4 text-center col-12 small"><span class="material-icons-outlined" style="font-size: 16px">
            <i class="fa-solid fa-copyright"></i>
            </span> Andres Marquez {{date("Y")}}</div>
    </footer>
</div>
