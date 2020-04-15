<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 23/03/2020
 * Time: 03:57 PM
 */?>

@extends('layouts.pignumaster')
@section('content')
@include('pignu.configuration.partials._languagesModal')
    <div class="">
        <div class="row layout-top-spacing">
            <div class="col-lg-8 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <div class="text-muted p-3">
                                    <span class='fas fa-angle-right'></span> Datos de la empresa
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {!! Form::open(['route' => 'configuration.storeCompanyData', 'method' => 'post']) !!}
                        <div class="">
                            <div class="form-group row mb-4">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-s text-md-right">Nombre</label>
                                <div class="col-sm-8">
                                    {{ Form::text('company', $config['company'], ['class' => 'form-control', 'placeholder' => 'Nombre de la empresa']) }}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-md-right">Teléfono</label>
                                <div class="col-sm-6">
                                    {{ Form::text('phone', $config['phone'], ['class' => 'form-control', 'placeholder' => 'Teléfono']) }}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-md-right">Dirección</label>
                                <div class="col-sm-10">
                                    {{ Form::text('address', $config['address'], ['class' => 'form-control', 'placeholder' => 'Dirección']) }}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-md-right">Instagram</label>
                                <div class="col-sm-8">
                                    {{ Form::text('instagram', $config['instagram'], ['class' => 'form-control', 'placeholder' => 'Ej: http://www.instagram.com/empresa']) }}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-md-right">Facebook</label>
                                <div class="col-sm-8">
                                    {{ Form::text('facebook', $config['facebook'], ['class' => 'form-control', 'placeholder' => 'Ej: http://www.facebook.com/empresa']) }}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-md-right">Twitter</label>
                                <div class="col-sm-8">
                                    {{ Form::text('twitter', $config['twitter'], ['class' => 'form-control', 'placeholder' => 'Ej: http://www.twitter.com/empresa']) }}
                                </div>
                            </div>
                            <p class="text-center">
                                <button type="submit" class="btn btn-secondary btn-lg ld-ext-right">
                                    Actualizar <span class="ld fas fa-spinner fa-spin">
                                </button>
                            </p>
                        </div> 
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="statbox widget box box-shadow mt-3">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <div class="text-muted p-3">
                                    <span class='fas fa-angle-right'></span> SEO - Datos iniciales de la página principal
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {!! Form::open(['route' => 'configuration.storeSEOData', 'method' => 'post']) !!}
                            @foreach ($appLanguages as $languageSwitch)
                                <div style="@if(!$loop->first) display:none @endif" id="langForm-{{ $languageSwitch->iso }}">
                                    <div class="form-group row mb-4">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-s text-md-right">Título @if($config['multi_lang'] == 1) <strong>({{ strtoupper($languageSwitch->iso) }})</strong> @endif</label>
                                        <div class="col-sm-8">
                                            {{ Form::text('home_title_' . $languageSwitch->iso, $home_title->getTranslation('value', $languageSwitch->iso), ['class' => 'form-control', 'placeholder' => 'Max. 60 caracteres', 'max' => 60]) }}
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-md-right">Descripción @if($config['multi_lang'] == 1) <strong>({{ strtoupper($languageSwitch->iso) }})</strong> @endif</label>
                                        <div class="col-sm-10">
                                            {{ Form::textarea('home_description_' . $languageSwitch->iso, $home_description->getTranslation('value', $languageSwitch->iso), ['class' => 'form-control', 'placeholder' => 'Max. 160 caracteres', 'rows' => 3, 'max' => 160]) }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        <p class="text-center">
                            <button type="submit" class="btn btn-secondary btn-lg ld-ext-right">
                                Actualizar <span class="ld fas fa-spinner fa-spin">
                            </button>
                        </p>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <div class="text-muted p-3">
                                    <span class='fas fa-angle-right'></span> Imagen general del sitio
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {!! Form::open(['route' => 'configuration.storeDefaultImage', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                            <div class="">
                                <p class="text-center">Esta es la imagen que aparecerá cuando se comparte el sitio en las redes sociales.</p>
                                <div class="upload">
                                    <input type="file" name="image" class="dropify" data-allowed-file-extensions="jpg jpeg"
                                    @if(@$config['default_image']) data-default-file="{{ asset($config['default_image']) }}" @endif >
                                </div>
                                <p class="text-center">La imagen debe estar en formato JPG.</p>
                                <p class="text-center">
                                    <button type="submit" class="btn btn-secondary btn-lg ld-ext-right">
                                        Actualizar <span class="ld fas fa-spinner fa-spin">
                                    </button>
                                </p>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="statbox widget box box-shadow mt-3">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <div class="text-muted p-3">
                                    <span class='fas fa-angle-right'></span> Multi idiomas
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('su', \App\User::class)
                    <div class="widget-content widget-content-area">
                        <div class="">
                            {!! Form::open(['route' => 'configuration.langOption', 'method' => 'post']) !!}
                            <div class="n-chk text-center">
                                <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                    <input name="multi_lang" value="1" @if($config['multi_lang']) checked @endif type="checkbox" class="new-control-input" onchange="javascript:this.form.submit();">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Compatibilidad multidiomas</span>
                                </label>
                            </div>
                            {!! Form::close() !!}
                            @if($config['multi_lang'])
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="bg-gray" colspan="2">Idiomas agregados</th>
                                            </tr>
                                            @foreach ($appLanguages as $applanguage)
                                                <tr>
                                                    <td>{{ $applanguage->name }}</td>
                                                    <td>
                                                        @if($applanguage->iso == 'es')
                                                            <span class="text-info">default</span>
                                                        @else
                                                            <a href="{{ route('configuration.deleteLanguage', $applanguage->id) }}" class="btn btn-link btn-sm"><span class="fas fa-times text-danger"></span> Eliminar</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#languagesModal">
                                            <span class="fas fa-plus-circle"></span> Agregar idioma
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div> 
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@stop
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
        $('.langSwitch').click(function(){
            let lang = $(this).data("lang");
            console.log('#langForm-' + lang);
            $('[id^=langForm]').hide();
            $('#langForm-' + lang).fadeIn();
        });
    </script>
@stop