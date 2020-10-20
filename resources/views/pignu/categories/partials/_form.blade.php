<?php
/**
 * Creado por: Ernesto Flames
 */?>


    <div class="widget-content widget-content-area">
        <div class="container-fluid">
            @foreach ($appLanguages as $languageSwitch)
            <div style="@if(!$loop->first) display:none @endif" id="langForm-{{ $languageSwitch->iso }}">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group row mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Nombre @if($config['multi_lang'] == 1) <strong>({{ strtoupper($languageSwitch->iso) }})</strong> @endif @mandatory</label>
                            <div class="col-sm-7">
                                {{ Form::text('name_' . $languageSwitch->iso, @$category ? $category->getTranslation('name', $languageSwitch->iso) : null, ['class' => 'form-control', 'placeholder' => 'Nombre de la categoría']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Tipo de categoría @mandatory</label>
                        <div class="col-sm-7">
                            {{ Form::select('category_type_id', $categoryTypes, null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo de categoría']) }}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Codigo del icono de la galería de iconos de <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank"><strong>Font Awesome</strong></a></label>
                        <div class="col-sm-6">
                            {{ Form::text('fa_icon', null, ['class' => 'form-control', 'placeholder' => 'Icono de Font Awesome ej: fa-search']) }}
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

@section('after-scripts')
<script>
    $('.langSwitch').click(function(){
            let lang = $(this).data("lang");
            console.log('#langForm-' + lang);
            $('[id^=langForm]').hide();
            $('#langForm-' + lang).fadeIn();
        });
</script>
@endsection