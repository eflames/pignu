<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 3/16/2020
 * Time: 5:29 PM
 */?>

<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row text-center">
            <li class="nav-item theme-logo" style="display: none;">
                <a href="{{ url('/admin') }}">
                    &nbsp;<img src="{{ asset('images/pignu/pignu_icon.png') }}" alt="Pignu">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="{{ url('/admin') }}" class="nav-link">
                    <img src="{{ asset('images/pignu/pignu_texto.png') }}" class="bs-tooltip" title="v{{ config('pignu.VERSION') }}" data-placement="bottom">
                </a>
            </li>
            <li class="nav-item toggle-sidebar">
                {{--<span class="fas fa-chevron-left"></span>--}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left sidebarCollapse"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </li>
        </ul>

        {{--<div class="shadow-bottom"></div>--}}
        <ul class="list-unstyled menu-categories" id="accordionNavbar" aria-expanded="true">
            <li class="menu @if(Request::is('pignu')) active @endif">
                <a href="{{ route('dashboard') }}" class="dropdown-toggle">
                    <div class="">
                        <span class="fas fa-desktop fa-lg pt-2 pb-2 pr-2"></span>
                        <span> Dashboard</span>
                    </div>
                </a>
            </li>
            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>CONTENIDO</span>
                </div>
            </li>
            <li class="menu">
                <a href="#" class="dropdown-toggle">
                    <div class="">
                        <span class="fas fa-book fa-lg pt-1 pt-2 pb-2 pr-2"></span>
                        <span> Blog</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="#" class="dropdown-toggle">
                    <div class="">
                        <span class="fas fa-store fa-lg pt-1 pt-2 pb-2 pr-2"></span>
                        <span> Catálogo de productos</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="#" class="dropdown-toggle">
                    <div class="">
                        <span class="fas fa-images fa-lg pt-1 pt-2 pb-2 pr-2"></span>
                        <span> Galerías de imágenes</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="#" class="dropdown-toggle">
                    <div class="">
                        <span class="fas fa-copy fa-lg pt-2 pb-2 pr-2"></span>
                        <span> Páginas estáticas</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="#" class="dropdown-toggle">
                    <div class="">
                        <span class="fas fa-download fa-lg pt-2 pb-2 pr-2"></span>
                        <span> Descargas</span>
                    </div>
                </a>
            </li>
            @can('categories',\App\User::class)
            <li class="menu @if(Request::is('pignu/categor*')) active @endif">
                <a href="{{ route('categories.index') }}" class="dropdown-toggle">
                    <div class="">
                        <span class="fas fa-list fa-lg pt-2 pb-2 pr-2"></span>
                        <span> Categorías de contenido</span>
                    </div>
                </a>
            </li>
            @endcan
            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>ADMINISTRACIÓN</span>
                </div>
            </li>
            @can('users',\App\User::class)
                <li class="menu @if(Request::is('pignu/users*') || Request::is('pignu/roles*')) active @endif">
                    <a href="#access" data-toggle="collapse" aria-expanded="@if(Request::is('pignu/users*') || Request::is('pignu/roles*')) true @else false @endif" class="dropdown-toggle">
                        <div class="">
                            <span class="fas fa-user-shield fa-lg pt-2 pb-2 pr-2"></span>
                            <span>Accesos</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled @if(Request::is('pignu/users*') || Request::is('pignu/roles*')) show @endif" id="access" data-parent="#accordionNavbar">
                        <li class="@if(Request::is('pignu/users*')) active @endif"><a href="{{ route('users.index') }}"> Usuarios </a></li>
                        <li class="@if(Request::is('pignu/roles*')) active @endif"><a href="{{ route('roles.index') }}"> Roles y permisos </a></li>
                    </ul>
                </li>
            @endcan
            @can('configs',\App\User::class)
            <li class="menu @if(Request::is('pignu/variables*') || Request::is('pignu/configuration*') || Request::is('pignu/plugins*')) active @endif">
                <a href="#system" data-toggle="collapse" aria-expanded="@if(Request::is('pignu/variables*') || Request::is('pignu/configuration*') || Request::is('pignu/plugins*')) true @else false @endif" class="dropdown-toggle">
                    <div class="">
                        <span class="fas fa-wrench fa-lg pt-2 pb-2 pr-2"></span>
                        <span>Sistema</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if(Request::is('pignu/variables*') || Request::is('pignu/configuration*') || Request::is('pignu/plugins*')) show @endif" id="system" data-parent="#accordionNavbar">
                    <li class="@if(Request::is('pignu/configuration*')) active @endif"><a href="{{ route('configuration.index') }}"> Configuración </a></li>
                    <li class="@if(Request::is('pignu/variables*')) active @endif"><a href="{{ route('variables.index') }}"> Variables (avanzado) </a></li>
                    <li class="@if(Request::is('pignu/plugin*')) active @endif"><a href="{{ route('plugins.index') }}"> Plugins </a></li>
                </ul>
            </li>
            @endcan
            @can('log',\App\User::class)
                <li class="menu @if(Request::is('pignu/activity-log*')) active @endif">
                    <a href="{{ route('activity-log') }}" class="dropdown-toggle">
                        <div class="">
                            <span class="fas fa-fingerprint fa-lg pt-2 pb-2 pr-2"></span>
                            <span> Registro de actividad</span>
                        </div>
                    </a>
                </li>
            @endcan


        </ul>
    </nav>

</div>
