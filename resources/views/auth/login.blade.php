<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta charset="utf-8" />
            <!--favicon-->
        <link rel="icon" href="{{ asset('img/logo_unaaa.png') }}" type="image/png" />

        <title>Login | Universidad Nacional Autónoma de Alto Amazonas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SGC" name="description" />
        <meta content="Themesdesign" name="Universidad" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        <div class="home-btn d-none d-sm-block">
            <a href="index.html"><i class="mdi mdi-home-variant h2 text-white"></i></a>
        </div>
        <div>
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-4">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                                <div style="text-align: center;">
                                                    <img src="{{ asset('img/banner_unaaa.png') }}" style="width: 60%;">
                                                </div>
    
                                                <h4 class="font-size-18 mt-4">Sistema de Gestión de Calidad</h4>
                                                <p class="text-muted">Escriba su usuario y contraseña para ingresar.</p>
                                            </div>

                                            <div class="p-2 mt-5">
                                                <form method="POST" class="form-horizontal" action="{{ route('login') }}">
                                                @csrf
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                         <i class=" ri-user-line auti-custom-input-icon"></i>
                                                        <label for="email">Usuario</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                                    </div>
                            
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="password">Contraseña</label>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                                    </div>
                            


                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary btn-rounded waves-effect waves-light pr-4 pl-4" type="submit">Iniciar sesión</button>
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Olvidaste contraseña?</a>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="mt-5 text-center">
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="authentication-bg">
                            <div class="bg-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>

    </body>
</html>





                                                                


