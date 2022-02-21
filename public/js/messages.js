window.addEventListener('error', event => {
    if(event.detail !== undefined){
        $.toast({
            heading: 'Error !',
            text: event.detail.error,
            position: 'top-right',
            loaderBg: '#f93154',
            icon: 'error',
            hideAfter: 6000,
            stack: 6
        });
    }
})
window.addEventListener('exito', event => {
   if(event.detail !== undefined){
        $.toast({
            heading: 'Exito !',
            text: event.detail.exito,
            position: 'top-right',
            loaderBg: '#07a346',
            icon: 'success',
            hideAfter: 6000,
            stack: 6
        })
   }
})
