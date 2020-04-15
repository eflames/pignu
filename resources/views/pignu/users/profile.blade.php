<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 23/03/2020
 * Time: 03:57 PM
 */?>

@extends('layouts.pignumaster')
@section('content')
    <div class="">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <div class="text-muted p-3">
                                    <span class='fas fa-angle-right'></span> Mi perfil de usuario
                                </div>

                            </div>
                        </div>
                    </div>
                    {{ Form::model($user, ['route' => ['profile.update'], 'method' => 'POST', 'enctype'=>'multipart/form-data']) }}
                    
                        @include('pignu.users.partials._formProfile')

                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
@stop