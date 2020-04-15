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
                        <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm text-right">Clave @mandatory</label>
                        <div class="col-sm-5">
                            {{ Form::text('key', null, ['class' => 'form-control', 'placeholder' => 'Clave', 'required' => true]) }}
                        </div>
                        <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm text-right">Valor @mandatory</label>
                        <div class="col-sm-5">
                            {{ Form::text('value', null, ['class' => 'form-control', 'placeholder' => 'Valor', 'required' => true]) }}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm text-right">Descripción</label>
                        <div class="col-sm-11">
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descripción', 'rows' => 3]) }}
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
