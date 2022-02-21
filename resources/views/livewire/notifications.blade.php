<div>
    <div class="d-flex justify-content-center">
        @foreach ($notifications as $notification)
            <div class="p-4 bg-white rounded shadow-sm w-95 w-sm-85 w-md-60">
                <h4>Tu post "{{$notification->title_post}}" fue bloqueado y borrado por incumplir nuestros terminos y condiciones</h4>
            </div>
        @endforeach
    </div>
    <div wire:loading.class="d-flex" wire:target="" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>
