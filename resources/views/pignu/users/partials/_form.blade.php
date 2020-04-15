<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 24/03/2020
 * Time: 06:37 PM
 */?>

<div class="widget-content widget-content-area">
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <i class="icon fas fa-user"></i> Datos generales
                    <hr>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">Nombre completo @mandatory</label>
                        <div class="col-sm-7">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre completo']) }}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">Correo electrónico @mandatory</label>
                        <div class="col-sm-8">
                            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Correo electrónico']) }}
                        </div>
                    </div>
                    <i class="icon fas fa-key"></i> Seguridad
                    <hr>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">Rol de usuario @mandatory</label>
                        <div class="col-sm-8">
                            {{ Form::select('rol_id', ['' => 'Seleccione...'] + $roles->toArray(), null,  ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">Contraseña @if(@!$user) @mandatory @endif</label>
                        <div class="col-sm-8">
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) }}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">Confirmar contra. @if(@!$user) @mandatory @endif</label>
                        <div class="col-sm-8">
                            {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmar contraseña']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <i class="icon fas fa-image"></i> Imagen de perfil
                    <hr>
                    <div class="upload mt-4">
                        <input type="file" name="avatar" class="dropify" data-allowed-file-extensions="jpg jpeg"
                               @if(@$user->avatar) data-default-file="{{ asset('images/usuarios/' . $user->avatar) }}" @endif>
                    </div>
                    <p class="text-center">La imagen debe estar en formato JPG.</p>
                </div>
            </div>
        <div class="row pt-5">
            <div class="col-12 text-center">
                    <p> @mandatory Son campos obligatorios</p>
                @if(@$user)
                    <p><span class="fa fa-exclamation-triangle text-danger"></span>
                        Complete los campos de contraseña únicamente si desea cambiarla.
                    </p>
                @endif
                <button type="submit" class="btn btn-secondary btn-lg ld-ext-right">
                    Guardar <span class="ld fas fa-spinner fa-spin">
                </button>
            </div>
        </div>
    </div>
</div>
@section('after-styles')
    <link rel="stylesheet" href="{{ asset('css/pignu/dropify.min.css') }}">
@stop
@section('after-scripts')
    <script src="{{ asset('js/pignu/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Arrastra la imagen aquí o click para insertar',
                    'replace': 'Arrastra o click para modificar',
                    'remove':  'Eliminar',
                    'error':   'Ha ocurrido un error.'
                }
            });
        });
    </script>
@stop
