<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 19/03/2020
 */?>

@if (count($errors) > 0)
    <div style="position: absolute; top: 10px; right: 10px; z-index: 9999;">
    {{--<div style="position: absolute; top: 10px; right: 40%; z-index: 9999;">--}}
        <div class="toast fade hide" role="alert" data-delay="6000" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger">
                <strong class="mr-auto">Ha ocurrido un error.&nbsp;&nbsp;&nbsp;</strong>
                <small class="meta-time">Justo ahora</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body bg-light-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>
    </div>
@section('after-scripts')
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>
@stop
@endif

@if(@$message)
    <div style="position: absolute; top: 10px; right: 10px; z-index: 9999;">
        <div class="toast fade hide" role="alert" data-delay="6000" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success">
                <strong class="mr-auto">Actualizado.&nbsp;&nbsp;&nbsp;</strong>
                <small class="meta-time">Justo ahora</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body bg-light-success">
                {{$message}}
            </div>
        </div>
    </div>
@section('after-scripts')
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>
@stop
@endif

@if(session()->has('message'))
    <div style="position: absolute; top: 10px; right: 10px; z-index: 9999;">
        <div class="toast fade hide" role="alert" data-delay="6000" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success">
                <strong class="mr-auto">Actualizado.&nbsp;&nbsp;&nbsp;</strong>
                <small class="meta-time">Justo ahora</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body bg-light-success">
                {!! session()->pull('message') !!}
            </div>
        </div>
    </div>
@section('after-scripts')
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>
@stop
@endif
@if(session()->has('error'))
    <div style="position: absolute; top: 10px; right: 40%; z-index: 9999;">
        <div class="toast fade hide" role="alert" data-delay="6000" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger">
                <strong class="mr-auto">Ha ocurrido un error.&nbsp;&nbsp;&nbsp;</strong>
                <small class="meta-time">Justo ahora</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body bg-light-danger">
                {{ session()->pull('error') }}
            </div>
        </div>
    </div>
@section('after-scripts')
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>
@stop
@endif