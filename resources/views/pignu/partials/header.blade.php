<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 3/16/2020
 * Time: 5:29 PM
 */?>

<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-item flex-row">
            <li class="nav-item align-self-center page-heading">
                <div class="page-header">
                    {!! $headerTitle !!}
                </div>
            </li>
            @if($config['multi_lang'])
                @if(@$appLanguages)
                    @if(@$appLanguages->count() > 0)
                        <li class="nav-item align-self-center ml-2">
                            <div class="btn-group">
                                <button class="btn btn-link btn-sm dropdown-toggle bs-tooltip" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" data-title="Cambiar idioma" data-placement="right" style="padding: 0.3rem 0.5rem 0.17rem 0.5rem;">
                                <span class="fas fa-globe-americas text-secondary"></span>
                                </button>
                                <div class="dropdown-menu" style="will-change: transform;">
                                    @foreach ($appLanguages as $languageSwitch)
                                        <a href="javascript:void(0);" class="dropdown-item langSwitch" data-lang="{{ $languageSwitch->iso }}">{{ $languageSwitch->name }} ({{ strtoupper($languageSwitch->iso) }})</a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endif
                @endif
            @endif
            
        </ul>
        @if(@$searchRoute)
            <ul class="navbar-item flex-row search-ul">
                <li class="nav-item align-self-center search-animated">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    {{ Form::open(['route' => $searchRoute, 'method' => 'get', 'role' => 'search', 'class' => 'form-inline search-full form-inline search']) }}
                        <div class="search-bar">
                            <input type="text" name="t" class="form-control search-form-control  ml-lg-auto" placeholder="Buscar por {{ $searchProps }}">
                        </div>
                    {{ Form::close() }}
                </li>
            </ul>
        @endif

        <ul class="navbar-item flex-row navbar-dropdown">
            <li class="nav-item align-self-center page-heading">
                <a href="{{ url('/') }}" target="_blank" class="btn btn-success btn-sm">Ir al frontend <span class="fas fa-arrow-right"></span></a>
            </li>
            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="far fa-user pr-2 text-black-50"></span>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a class="" href="{{ route('profile.index') }}"><span class="fas fa-user-edit pr-2 text-black-50"></span> Mi perfil</a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="#"><span class="fas fa-question-circle pr-2 text-black-50"></span> Solicitar ayuda</a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="fas fa-sign-out-alt pr-2 text-black-50"></span> Cerrar sesión
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>