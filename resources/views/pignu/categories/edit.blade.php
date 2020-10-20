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
                                    <span class='fas fa-angle-right'></span> Editar categoría: <b>{{ $category->name }}</b>
                                    <div class="float-right">
                                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm"><span class="fas fa-chevron-left"></span> Regresar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT']) }}
                    
                        @include('pignu.categories.partials._form')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop