$(document).ready(function(){
    Client.LoadClientTable();
    Client.EditBox.Disabled();
});

var Client = {
    vars: {
        ClientTable: "#clients_dataTable",
        tbodyClientTable: "#clients_dataTable tbody",
        ClientTableLoader: ".table-responsive",
        ClientPublicationsTableLoader: "#clientPublicationsLoad", 
        ClientPublicationsTable: "#clientPublications_dataTable",
        tbodyClientPublicationsTable: "#clientPublications_dataTable tbody",
        EditBoxClass: ".edit-box",
        ViewModalClass: "#viewModal",
        EditImageDiv: "#editImage",
        AddImageDiv: "#addImage",
        ImageHtml: function (url) { return '<img class="img-fluid" src="' + url + '" style="max-width: 100%; height: auto;">'; },
        NoImageHtml: '<div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;"><p>Sin imagen</p></div><br>',
        urls:{
            getClients: '/admin/getClients',
            editClient: function (id) { return '/admin/client/' + id + '/edit' },
            showClient: function (id) { return '/admin/client/' + id },
            getClientPublications: function (id) { return '/admin/getClientPublications/' + id}
        }
    },
    LoadClientTable: function () {
        Base.Ajax(Client.vars.urls.getClients, 'GET', null, true,
            function(xhr, settings){
                Base.Loader.show(Client.vars.ClientTableLoader);
            },
            function(resp){
                $(Client.vars.tbodyClientTable).html(resp.html);
                var table = $(Client.vars.ClientTable).DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
            },
            function(){
                Base.Loader.hide(Client.vars.ClientTableLoader);
            });
    },
    LoadClientPublicationsTable: function(id){
        Base.Ajax(Client.vars.urls.getClientPublications(id), 'GET', null, true,
            function(xhr, settings){
                Base.Loader.show(Client.vars.ClientPublicationsTableLoader);
            },
            function(resp){
                $(Client.vars.tbodyClientPublicationsTable).html(resp.html);
                var table = $(Client.vars.ClientPublicationsTable).DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
            },
            function(){
                Base.Loader.hide(Client.vars.ClientPublicationsTableLoader);
                
            } );
    },
    OnTbodyClientTable: function(row){
        var table = $(Client.vars.ClientTable).DataTable();
        $("#editForm input[name='deleteImage']").val(0);
        if ( $(row).hasClass('tr-selected') ) {
            $(row).removeClass('tr-selected');
            Client.EditBox.Disabled();
        }
        else {
            table.$('tr.tr-selected').removeClass('tr-selected');
            $(row).addClass('tr-selected');

            var id = $(row).find('td').first().text();

            var lastIndex = $("#editForm").attr("action").lastIndexOf('/');
            var action = $("#editForm").attr("action").substr(0, lastIndex) + "/" + id;
            $("#editForm").attr("action", action);


            Base.Ajax(Client.vars.urls.editClient(id), 'GET', null, true,
                function () {
                    Client.EditBox.Disabled();
                    Base.Loader.show(Client.vars.EditBoxClass);
                },
                function (jqXHR) {
                    console.log(jqXHR);
                    if(jqXHR.response === "success"){
                        Client.EditBox.Enabled();
                        var data = jqXHR.data;

                        $("#relatedTable").html(data.table);
                        
                        if(data.imageExists){
                            $(Client.vars.EditImageDiv).html(Client.vars.ImageHtml(data.companyDetail.urlImage));
                        }
                        else{
                            $(Client.vars.EditImageDiv).html(Client.vars.NoImageHtml);
                        }
                        
                        
                        $("#editForm input[name='name']").val(data.name);
                        $("#editForm input[name='rfc']").val(data.rfc);
                        $("#editForm input[name='city']").val(data.city);
                        $("#editForm input[name='state']").val(data.state);
                        $("#editForm input[name='latitude']").val(data.companyDetail.latitude);
                        $("#editForm input[name='longitude']").val(data.companyDetail.longitude);
                        if(data.companyDetail.is_premium)
                        {
                            $("#editForm input[name='is_premium']").prop('checked', true);

                        }
                        else
                        {
                            $("#editForm input[name='is_premium']").prop('checked', false);

                        }
                        if(data.companyDetail.is_active)
                        {
                            $("#editForm input[name='is_active']").prop('checked', true);

                        }
                        else
                        {
                            $("#editForm input[name='is_active']").prop('checked', false);

                        }


                    }
                    else{
                        Client.EditBox.Disabled();
                        $(Client.vars.EditImageDiv).html(Client.vars.NoImageHtml);
                    }
                },
                function(jqXHR){
                    Base.Loader.hide(Client.vars.EditBoxClass);
                },
                function(){
                    $(Client.vars.EditImageDiv).html(Client.vars.NoImageHtml);
                    Client.EditBox.Disabled();
                }
            );
        }
    },
    EditBox: {
        Disabled: function(cssClass = Client.vars.EditBoxClass){
            $(cssClass + " :input").attr('disabled', true);
        },
        Enabled: function (cssClass = Client.vars.EditBoxClass) {
            $(cssClass + " :input").attr('disabled', false);
        }
    },
    CancelEdit: function(){
        var table = $(Client.vars.ClientTable).DataTable();
        table.$('tr.tr-selected').removeClass('tr-selected');
        Client.EditBox.Disabled();
        $("#editForm input[name='deleteImage']").val(0);
    },
    ViewModal: function (row) {
        var id = $(row).find('td').first().text();

        Base.Ajax(Client.vars.urls.showClient(id), 'GET', null, true,
            function () {
                $('#viewBody').empty();
                Base.Loader.show();
                $('#viewModal').modal('toggle');
            },
            function (jqXHR) {
                console.log(jqXHR);
                var data = jqXHR.data;
                $("#viewBody").html(data.view);
                Client.LoadClientPublicationsTable(id);
            },
            function(jqXHR){
                Base.Loader.hide();
            }
        );
    },
    PreviewImage: function(input, id){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id).html(Client.vars.ImageHtml(e.target.result));
            }

            reader.readAsDataURL(input.files[0]);
        }
    },
    DeleteClient: function(form) {
        Base.ConfirmDelete("¿Está seguro que desea eliminar el cliente?",
            "Se eliminarán todos los datos relacionados de forma permanente",
            function(){
            $(form).submit();
        });
    },
    DeleteImage: function (e, button) {
        e.preventDefault();
        var input = $(button).next();
        $(input).val(1);
        $(Client.vars.EditImageDiv).html(Client.vars.NoImageHtml);
    }
};