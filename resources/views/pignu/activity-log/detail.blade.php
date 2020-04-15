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
                                    <span class='fas fa-angle-right'></span> Detalle de la actividad: <strong>  #{{ $log->id }}</strong>
                                    <div class="float-right">
                                        <a href="{{ route('activity-log') }}" class="btn btn-outline-secondary btn-sm"><span class="fas fa-chevron-left"></span> Regresar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Evento</th>
                                        <th>Modelo</th>
                                        <th>Usuario</th>
                                        <th>Creado el</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $log->log_name }}</td>
                                        <td>{{ $log->description }}</td>
                                        <td>{{ $log->subject_type }} (RowID: {{ $log->subject_id }})</td>
                                        <td>{{ $log->userCauser->name }}</td>
                                        <td>{{ $log->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <p><span class="fas fa-arrow-down"></span> Datos originales</p>
                            <div class="alert alert-light-danger mb-4" role="alert">
                                @if($old_data)
                                    @foreach ($old_data as $key => $value)
                                        <b>{{ $key }}</b>: {{ $value }}
                                    @endforeach
                                @else
                                    <b>NO DATA</b>
                                @endif
                                
                            </div>
                            <p><span class="fas fa-arrow-up"></span> Datos actualizados</p>
                            <div class="alert alert-light-success mb-4" role="alert">
                                @if($new_data)
                                    @foreach ($new_data as $key => $value)
                                        <b>{{ $key }}</b>: {{ $value }}
                                    @endforeach
                                @else
                                    <b>NO DATA</b>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop