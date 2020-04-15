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
                                    <span class='fas fa-angle-right'></span> Toda la actividad
                                    @if(@$searchQuery)
                                       <b>|</b> resultados de: <b>{{ $searchQuery }}</b>
                                        <a href="{{ route('activity-log') }}" class="bs-tooltip" title="Remover filtro" data-placement="right"><span class="fa fa-times-circle text-secondary"></span></a>
                                    @endif
                                    <div class="float-right d-none d-sm-block">
                                        <a href="{{ route('activity-log.cleanup') }}" class="btn btn-sm btn-secondary bs-tooltip"
                                        title="Eliminar todos los registros anteriores a 30 días" data-placement="left">
                                                <span class="fas fa-eraser"></span> Limpieza de registros</a>
                                    </div>
                                    <div class="text-center d-md-none pt-4">
                                        <a href="{{ route('activity-log.cleanup') }}" class="btn btn-sm btn-secondary bs-tooltip"
                                        title="Eliminar todos los registros anteriores a 30 días" data-placement="left">
                                                <span class="fas fa-eraser"></span> Limpieza de registros</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="">
                            <p><small><strong class="text-danger">NOTA:</strong> En el <strong>Registro de actividades</strong> se almacena todos los cambios realizados en los módulos de la aplicación. Cada modificación, creacion o eliminación de un registro en el sistema generará un evento que se guardará en base de datos con el usuario, el antes y despues del proceso. Se recomienda realizar una limpieza, lo que mantendrá solamente los registros de los útimos 30 días.</small></p>
                            <table class="table table-striped table-borderless mb-4">
                                <thead>
                                <tr>
                                    <th class="d-none d-sm-table-cell">ID</th>
                                    <th class="d-none d-sm-table-cell">Tipo</th>
                                    <th>Evento</th>
                                    <th>Modelo</th>
                                    <th class="d-none d-sm-table-cell">Usuario</th>
                                    <th class="d-none d-sm-table-cell">Creado el</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($logs as $log)
                                <tr>
                                    <td class="d-none d-sm-table-cell">{{ $log->id }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $log->log_name }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->subject_type }} (RowID: {{ $log->subject_id }})</td>
                                    {{-- <td class="d-none d-sm-table-cell">{{ \App\Libraries\UserLibrary::userName($log->causer_id)->name }}</td> --}}
                                    <td class="d-none d-sm-table-cell">{{ $log->userCauser->name }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $log->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('activity-log.detail', $log->id) }}" class="btn btn-teraadmin btn-sm bs-tooltip" title="Ver detalles del registro" data-placement="left">
                                            <span class="fas fa-search"></span> Ver detalles
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center"><h4>Lo sentimos, se encontraron registros :(</h4></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{ $logs->render() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop