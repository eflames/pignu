<?php
/**
 * Created by PhpStorm.
 * User: eflames
 * Date: 07/12/2016
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
                                    <span class='fas fa-angle-right'></span> Crear nuevo plugin
                                    <div class="float-right">
                                        <a href="{{ route('plugins.index') }}" class="btn btn-outline-secondary btn-sm"><span class="fas fa-chevron-left"></span> Regresar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::open(['route' => 'plugins.store', 'method' => 'POST']) }}
                    
                        @include('pignu.plugins.partials._form')

                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
@stop