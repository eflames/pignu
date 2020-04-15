<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 3/16/2020
 * Time: 5:31 PM
 */?>
@extends('layouts.pignumaster')
@section('content')
    <div class="">
        <div class="row layout-top-spacing">

            <div id="dashboard" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4><img src="{{asset('images/pignu/ga-logo.png')}}"></h4>
                            </div>
                        </div>
                    </div>

                    <div class="widget-content widget-content-area">
                            <div class=""><span id="embed-api-auth-container"></span></div>
                            @include('pignu.dashboard.analytics-dashboard')
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop