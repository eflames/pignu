<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Iniciar sesion - Pignu</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/pignu/favicon.ico') }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('css/pignu/pignu-login-styles.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="form">
    

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <p class="text-center"><img src="{{ asset('images/pignu/pignu_texto.png') }}" alt="Pignu"></a></p>
                        <h2 class="text-center">Iniciar sesión</h1>
                            <form method="POST" action="{{ route('login') }}" class="text-left">
                                @csrf
                            <div class="form">
                                @error('email')
                                    <div class="alert alert-danger text-center">{{ $message }}</div>
                                @enderror
                                @error('password')
                                    <div class="alert alert-danger text-center">{{ $message }}</div>
                                @enderror
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="email" name="email" type="text" class="form-control" placeholder="Correo electrónico">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña">
                                </div>
                                <div class="d-sm-flex justify-content-center">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Mostrar contraseña</p>
                                        <label class="switch s-secondary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    
                                    
                                </div>
                                <div class="field-wrapper text-center mt-3">
                                    <button type="submit" class="btn btn-secondary ld-ext-right">
                                        Ingresar <span class="ld fas fa-spinner fa-spin">
                                    </button>
                                </div>

                                <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                        
                                        
                                        <label class="new-control new-checkbox checkbox-outline-secondary">
                                          <input type="checkbox" name="remember" class="new-control-input">
                                          <span class="new-control-indicator"></span>Recordar en este equipo
                                        </label>
                                    </div>
                                </div>

                                {{-- <div class="field-wrapper">
                                    <a href="auth_pass_recovery.html" class="forgot-pass-link">Recuperar contraseña</a>
                                </div> --}}

                            </div>
                        </form>                        
                        <p class="terms-conditions text-center">Pignu. Todos los derechos reservados © {{ date('Y') }}. <br>  Desarrollado por <a href="http://www.ernestoflames.com" target="_blank">Ernesto Flames</a></p>

                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>

    <script src="{{ asset('js/pignu/pignu-login-scripts.min.js') }}"></script>

</body>
</html>