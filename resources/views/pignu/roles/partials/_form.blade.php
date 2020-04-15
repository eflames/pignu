<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 24/03/2020
 * Time: 06:37 PM
 */?>

<div class="widget-content widget-content-area">
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xs-12">
               
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Nombre del rol @mandatory</label>
                        <div class="col-sm-7">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del rol']) }}
                        </div>
                    </div>
                    <i class="icon fas fa-lock"></i> Permisología
                    <hr>
                    <div class="form-group row mb-4 justify-content-center">
                        <div class="col-md-4 col-xs-12">
                            <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                        <input name="admin" value="1" @if(@$role->admin) checked @endif type="checkbox" class="new-control-input">
                                        <span class="new-control-indicator"></span><span class="new-chk-content">Acceso a <strong>Tera Admin</strong></span>
                                    </label>
                                </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                    <input name="p_blog" value="1" @if(@$role->p_blog) checked @endif type="checkbox" class="new-control-input">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Administrar <strong>Blog</strong></span>
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                    <input name="p_products" value="1" @if(@$role->p_products) checked @endif type="checkbox" class="new-control-input">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Administrar <strong>Productos</strong></span>
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                    <input name="p_galleries" value="1" @if(@$role->p_galleries) checked @endif type="checkbox" class="new-control-input">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Adminstrar <strong>Galerías</strong></span>
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                    <input name="p_pages" value="1" @if(@$role->p_pages) checked @endif type="checkbox" class="new-control-input">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Administrar <strong>Páginas</strong></span>
                                </label>
                            </div>
                            
                        </div>
                        <div class="col-md-4 col-xs-12">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                        <input name="p_users" value="1" @if(@$role->p_users) checked @endif type="checkbox" class="new-control-input">
                                        <span class="new-control-indicator"></span><span class="new-chk-content">Administrar <strong>Usuarios y permisologías</strong></span>
                                    </label>
                                </div>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                        <input name="p_categories" value="1" @if(@$role->p_categories) checked @endif type="checkbox" class="new-control-input">
                                        <span class="new-control-indicator"></span><span class="new-chk-content">Administrar <strong>Categorías del contenido</strong></span>
                                    </label>
                                </div>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                        <input name="p_configs" value="1" @if(@$role->p_configs) checked @endif type="checkbox" class="new-control-input">
                                        <span class="new-control-indicator"></span><span class="new-chk-content">Administrar <strong>Configuración del sistema</strong></span>
                                    </label>
                                </div>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                        <input name="p_log" value="1" @if(@$role->p_log) checked @endif type="checkbox" class="new-control-input">
                                        <span class="new-control-indicator"></span><span class="new-chk-content">Ver <strong>Registro de actividad</strong></span>
                                    </label>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-12 text-center">
                <p> @mandatory Son campos obligatorios</p>
                <button type="submit" class="btn btn-secondary btn-lg ld-ext-right">
                    Guardar <span class="ld fas fa-spinner fa-spin">
                </button>
            </div>
        </div>
    </div>
</div>
