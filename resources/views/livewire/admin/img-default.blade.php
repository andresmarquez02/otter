<div>
    <div class="d-flex justify-content-center">
        <div class="px-3 py-4 bg-white rounded shadow-sm w-95 w-md-50 px-md-4">
            <form action="" method="get" wire:submit.prevent='save_default' wire:ignore>
                <div class="form-group" >
                  <label for="">Imagen</label>
                  <input type="file" id="input-file-now" wire:model='img' class="dropify" name="imagen" accept="image/png" data-default-file="{{ asset("images_user/default.png") }}"/>
                  <small id="helpId" class="text-muted">{{$errors->first("img") ? $errors->first("img") : null}}</small>
                </div>
                <div class="mt-3 form-group">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
    <div wire:loading.class="d-flex" wire:target="save_default" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>
