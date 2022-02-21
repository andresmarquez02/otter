<div x-data="data()" x-init="init()">
    <div class="w-100">
        <div class="d-flex justify-content-center">
            <div class="px-4 py-5 bg-white rounded shadow-sm w-95 w-md-85">
                <form class="row g-3" id="sub" wire:submit.prevent='updatePost' action="" method="GET">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="title" class="form-label {{ ! empty($errors->first('title')) ? "text-danger" : ""}}">Title</label>
                            <input type="text" class="form-control {{ ! empty($errors->first('title')) ? "is-invalid input-error" : ""}}" name="title" id="title" x-model="title" required>
                            <small id="helpId" class="text-danger">{{$errors->first("title") ? $errors->first("title") : null}}</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="category" class="form-label {{ ! empty($errors->first('category')) ? "text-danger" : ""}}">Category</label>
                            <select name="" id="" class="form-control {{ ! empty($errors->first('category')) ? "is-invalid input-error" : ""}}" name="category" id="category" wire:model="category" required>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}"
                                        {{$category == $item->id ? "selected" : ''}}
                                    >{{$item->category}}</option>
                                @endforeach
                            </select>
                            <small id="helpId" class="text-danger">{{$errors->first("category") ? $errors->first("category") : null}}</small>
                        </div>
                    </div>
                    <div class="co-12">
                        <div class="form-group">
                            <label for="tags" class="form-label {{ ! empty($errors->first('tags')) ? "text-danger" : ""}}">Tags</label>
                            <div>
                                @foreach ($tags_all as $tag)
                                    <label for="tag{{$tag->id}}" class="me-3">
                                        <input type="checkbox" name="tags[]" x-model="tags" value="{{$tag->id}}" id="tag{{$tag->id}}">
                                        {{$tag->tag}}
                                    </label>
                                @endforeach
                            </div>
                            <small id="helpId" class="text-danger">{{$errors->first("tags") ? $errors->first("tags") : null}}</small>
                        </div>
                    </div>
                    <div class="co-12">
                        <div class="form-group" x-on:keyup="description_add">
                            <label for="description" class="form-label {{ ! empty($errors->first('description')) ? "text-danger" : ""}}">Description</label>
                            <textarea class="form-control {{ ! empty($errors->first('description')) ? "is-invalid input-error" : ""}}" name="description" id="description" required cols="30" rows="2" id="description">{{$description}}</textarea>
                            <small id="helpId" class="text-danger">{{$errors->first("description") ? $errors->first("description") : "La descripcion no puede ser mayor a 400 caracteres"}}</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" wire:ignore>
                            <label for="body" class="form-label d-block {{ ! empty($errors->first('body')) ? "text-danger" : ""}}">Body</label>
                            <textarea name="body" class="form-control" cols="30" rows="2" id="body">{{$body}}</textarea>
                            <small id="helpId" class="text-danger">{{$errors->first("body") ? $errors->first("body") : null}}</small>
                        </div>
                    </div>
                    <div class="mt-5 col-12 d-flex justify-content-center">
                        <button class="btn btn-info" type="submit" wire:loading.class="disabled">
                            <div wire:loading.class="d-inline-block" style="display:none">
                                <span class="spinner-border spinner-border-sm" role="status"  aria-hidden="true"
                                ></span>
                            </div>
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>
    <div wire:loading.class="d-flex" wire:target="updatePost" class="spiner-wire">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    </div>
</div>
<script>
    function data(){
        return {
            body: @entangle('body').defer,
            title: @entangle("title").defer,
            tags: @entangle("tags").defer,
            description: @entangle('description').defer,
            init(){
                tinymce.init({
                    selector: '#body',
                    toolbar: 'undo redo | image code',
                    height: 300,
                    plugins: [
                        'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                        'searchreplace wordcount visualblocks code insertdatetime media nonbreaking',
                        'table emoticons template paste help image code'
                    ],
                    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | link image | print preview media | ' +
                        'forecolor backcolor emoticons | help',
                    menu: {
                        favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
                    },
                    menubar: 'favs file edit view insert format tools table help',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                    // without images_upload_url set, Upload tab won't show up
                    images_upload_url: '{{url("/save/photo")}}',

                    // override default upload handler to simulate successful upload
                    images_upload_handler: function (blobInfo, success, failure) {
                        var xhr, formData;

                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', '{{url("/save/photo")}}');

                        xhr.onload = function() {
                            var json;

                            if (xhr.status != 200) {
                                failure('HTTP Error: ' + xhr.status);
                                return;
                            }
                            json = JSON.parse(xhr.responseText);

                            if (!json || typeof json.location != 'string') {
                                failure('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                            success(json.location);
                        };
                        formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        formData.append('_token', '{{csrf_token()}}');

                        xhr.send(formData);
                    },
                    language: 'es',
                    forced_root_block: false,
                    setup: function (editor) {
                        editor.on('init change', function () {
                            editor.save();
                        });
                        editor.on('change', function (e) {
                            @this.set('body', editor.getContent());
                        });
                    },
                });
            },
            description_add(){
                description = document.querySelector("#description").value;
                if(description.length <= 400){
                    this.description = description;
                }
                else{
                    this.description = description.slice(0,400);
                    document.querySelector("#description").value = description.slice(0,400)
                }
            }
        }
    }
</script>
