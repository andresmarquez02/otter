import Base64UploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/base64uploadadapter';
ClassicEditor
.create(document.querySelector("#body"),{
    // plugins: [ Base64UploadAdapter],
})
.catch( error => {
    console.log(error);
});
