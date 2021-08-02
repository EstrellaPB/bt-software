$(document).ready(function(){
    Message.sortableInit();
    Message.onSortableAssignedDrop();
    Message.onSortableUnAssignedDrop();
});

var Message = {
    vars: {
        sortableMessages: "#sortableMessages",
        sortableMessagesDevice: "#sortableMessagesDevice",
        idDevice: "input[name=id_device]",
        token: $('input[name="_token"]').val(),
        urls: {
            'saveDeviceMessage': '/admin/device/saveDeviceMessage',
            'deleteDeviceMessage': '/admin/device/deleteDeviceMessage'
        }
    },

    sortableInit: function(){
       
            $(Message.vars.sortableMessages+','+Message.vars.sortableMessagesDevice).sortable({
              connectWith: ".connectedSortable",
              revert: true
            }).disableSelection();

    },

    onSortableAssignedDrop: function(){

        $(Message.vars.sortableMessagesDevice).on( "sortreceive", function( event, ui ) {
            console.log(ui.item.attr('data-idMessage'));
            var idMessage = ui.item.attr('data-idMessage');
            var idDevice = $(Message.vars.idDevice).val(); 

            $.ajax({
                headers: {'X-CSRF-TOKEN': Message.vars.token},
                url: Message.vars.urls.saveDeviceMessage,
                type: 'POST',
                dataType: 'json',
                data: {'idMessage': idMessage, 'idDevice': idDevice},
                success: function(r){
                    if(r.response == 'success'){
                        Base.Toast('Mensaje', r.message);
                    }else{
                       // $(Message.vars.sortableMessagesDevice).sortable( "option", "revert", true );

                        $(ui.sender).sortable( "cancel" );
                        
                        Base.ToastError('Mensaje', r.message);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    /*$('.with-loader').removeClass('sk-loading');
                    $('.ibox-content .sk-loading').removeClass('sk-loading')*/
                    Base.Loader.hide('.ibox-content, .with-loader');
                    if(onerror !== null)
                    {
                        onerror(xhr);
                        //return;
                    }
                    swal({
                        title: 'Opss',
                        text: 'Ha ocurrido un error inesperado',
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonColor: swalStyle.btn_danger,//btn-primary
                        confirmButtonText: 'Continuar',
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(){
                        
                    });
                    console.error("ERROR AJAX", errorThrown);
                }
            });
            

        } );

    },

    onSortableUnAssignedDrop: function(){
        $(Message.vars.sortableMessages).on( "sortreceive", function( event, ui ) {
            console.log(ui.item.attr('data-idMessage'));
            var idMessage = ui.item.attr('data-idMessage');
            var idDevice = $(Message.vars.idDevice).val(); 

            $.ajax({
                headers: {'X-CSRF-TOKEN': Message.vars.token},
                url: Message.vars.urls.deleteDeviceMessage,
                type: 'POST',
                dataType: 'json',
                data: {'idMessage': idMessage, 'idDevice': idDevice},
                success: function(r){
                    if(r.response == 'success'){
                        Base.Toast('Mensaje', r.message);
                    }else{
                        Base.ToastError('Mensaje', r.message);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    /*$('.with-loader').removeClass('sk-loading');
                    $('.ibox-content .sk-loading').removeClass('sk-loading')*/
                    Base.Loader.hide('.ibox-content, .with-loader');
                    if(onerror !== null)
                    {
                        onerror(xhr);
                        //return;
                    }
                    swal({
                        title: 'Opss',
                        text: 'Ha ocurrido un error inesperado',
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonColor: swalStyle.btn_danger,//btn-primary
                        confirmButtonText: 'Continuar',
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(){
                        
                    });
                    console.error("ERROR AJAX", errorThrown);
                }
            });
            

        } );
    },

    search: function(){
        var input, filter, ul, li, message, i;
        input = document.getElementById("searchMessages");
        filter = input.value.toUpperCase();
        ul = document.getElementById("sortableMessages");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            message = li[i].getElementsByTagName("h3")[0];
            publicationTitle = li[i].getElementsByClassName('pubTitle')[0];
            companyName = li[i].getElementsByClassName('companyName')[0];

            if (message.innerHTML.toUpperCase().indexOf(filter) > -1 || publicationTitle.innerHTML.toUpperCase().indexOf(filter) > -1 || companyName.value.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";

            }
        }
    }
    
};