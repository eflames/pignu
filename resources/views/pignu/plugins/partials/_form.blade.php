<?php
/**
 * Creado por: Ernesto Flames
 */?>

<div class="widget-content widget-content-area">
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Nombre del plugin @mandatory</label>
                        <div class="col-sm-5">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del plugin']) }}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Código CSS</label>
                        <div class="col-sm-10">
                            {{ Form::textarea('css_content', null, ['class' => 'form-control', 'placeholder' => 'Código CSS', 'rows' => 5]) }}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Código Javascript</label>
                        <div class="col-sm-10">
                            {{ Form::textarea('js_content', null, ['class' => 'form-control', 'placeholder' => 'Código Javascript', 'rows' => 5]) }}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Status</label>
                        <div class="col-sm-5 pt-1">
                            <div class="n-chk">
                                <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-secondary">
                                    <input name="status" value="1" @if(@$plugin->status) checked @endif type="checkbox" class="new-control-input">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Activar o desactivar plugin</span>
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
