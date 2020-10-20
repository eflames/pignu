<div class="modal fade" id="languagesModal" tabindex="-1" role="dialog" aria-labelledby="languagesModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ Form::open(['route' => 'configuration.storeLanguage', 'method' => 'post']) }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un idioma al sitio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">
                        <div class="form-group">
                            {{ Form::select('language_iso', ['' => 'Seleccione idioma...'] + $languages->toArray(), null, ['class' => 'form-control']) }}
                        </div>
                    </p>
                    <p class="text-center">El idioma <strong>Español</strong> es el predeterminado, no se necesita agregar nuevamente.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary ld-ext-right"><span class="fas fa-plus-circle"></span> Agregar <span class="ld fas fa-spinner fa-spin"></button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>