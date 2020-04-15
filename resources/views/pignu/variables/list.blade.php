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
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <div class="text-muted p-3">
                                    <span class='fas fa-angle-right'></span> Lista de variables 
                                    @if(@$searchQuery)
                                       <b>|</b> resultados de: <b>{{ $searchQuery }}</b>
                                        <a href="{{ route('variables.index') }}" class="bs-tooltip" title="Remover filtro" data-placement="right"><span class="fa fa-times-circle text-secondary"></span></a>
                                    @endif
                                    <div class="float-right d-none d-sm-block">
                                    <a href="{{ route('variables.create') }}" class="btn btn-sm btn-secondary">
                                            <span class="fas fa-plus-circle"></span> Nueva variable</a>
                                    </div>
                                </div>
                                <div class="text-center d-md-none">
                                    <a href="{{ route('variables.create') }}" class="btn btn-sm btn-secondary">
                                        <span class="fas fa-plus-circle"></span> Nueva variable</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="">
                            <table class="table table-striped table-borderless mb-4">
                                <p><small><strong class="text-danger">IMPORTANTE:</strong> No edite ninguna de estas opciones si no está seguro de su funcionamiento. Puede afectar el desempeño del sitio.</small></p>
                                <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th class="d-none d-sm-table-cell">Valor</th>
                                    <th class="d-none d-sm-table-cell">Descripción</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($configs as $config)
                                <tr>
                                    <td>{{ $config->key }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $config->value }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $config->description }}</td>
                                    <td class="text-center">
                                        <div class="dropdown custom-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2" style="will-change: transform;">
                                                {{ Form::open(['route' => ['variables.destroy', $config->id], 'method' => 'DELETE', 'class' => 'form-horizontal', 'id' => 'formelim-' . $config->id]) }}
                                                    <a class="dropdown-item" href="{{ route('variables.edit', $config->id) }}"><span class="fas fa-pen pl-3 pr-2"></span> Editar</a>
                                                    <button type="button" onclick="alertElim('{{ $config->id }}')" class="dropdown-item" href="#"><span class="fas fa-times pl-3 pr-2 text-danger"></span> Eliminar</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center"><h4>Lo sentimos, se encontraron registros :(</h4></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{ $configs->render() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop