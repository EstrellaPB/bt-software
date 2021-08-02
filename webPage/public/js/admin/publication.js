$(document).ready(function(){
    Publication.LoadPublicationTable();
    Publication.EditBox.Disabled();
});

var Publication = {
    vars: {
        PublicationTable: "#publications_dataTable",
        tbodyPublicationTable: "#publications_dataTable tbody",
        PublicationTableLoader: ".table-responsive",
        EditBoxClass: ".edit-box",
        ViewModalClass: "#viewModal",
        EditImageDiv: "#editImage",
        AddImageDiv: "#addImage",
        ImageHtml: function (url) { return '<img class="img-fluid" src="' + url + '" style="max-width: 100%; height: auto;">'; },
        NoImageHtml: '<div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;"><p>Sin imagen</p></div><br>',
        urls:{
            getPublications: '/admin/getPublications',
            editPublication: function (id) { return '/admin/publication/' + id + '/edit' },
            showPublication: function (id) { return '/admin/publication/' + id },
        }
    },
    LoadPublicationTable: function () {
        Base.Ajax(Publication.vars.urls.getPublications, 'GET', null, true,
            function(xhr, settings){
                Base.Loader.show(Publication.vars.PublicationTableLoader);
            },
            function(resp){
                $(Publication.vars.tbodyPublicationTable).html(resp.html);
                var table = $(Publication.vars.PublicationTable).DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
            },
            function(){
                Base.Loader.hide(Publication.vars.PublicationTableLoader);
            });
    },
    OnTbodyPublicationTable: function(row){
        var table = $(Publication.vars.PublicationTable).DataTable();
        $("#editForm input[name='deleteImage']").val(0);
        if ( $(row).hasClass('tr-selected') ) {
            $(row).removeClass('tr-selected');
            Publication.EditBox.Disabled();
        }
        else {
            table.$('tr.tr-selected').removeClass('tr-selected');
            $(row).addClass('tr-selected');

            var id = $(row).find('td').first().text();

            var lastIndex = $("#editForm").attr("action").lastIndexOf('/');
            var action = $("#editForm").attr("action").substr(0, lastIndex) + "/" + id;
            $("#editForm").attr("action", action);


            Base.Ajax(Publication.vars.urls.editPublication(id), 'GET', null, true,
                function () {
                    Publication.EditBox.Disabled();
                    Base.Loader.show(Publication.vars.EditBoxClass);
                },
                function (jqXHR) {
                    console.log(jqXHR);
                    if(jqXHR.response === "success"){
                        Publication.EditBox.Enabled();
                        var data = jqXHR.data;
                        if(data.is_coupon){
                            $("#couponTable").html(data.table);
                            $("#editForm input[name='is_coupon']").prop('checked', true);
                        }
                        else{
                            $("#couponTable").html("<h2>La publicación no es cupón</h2>");
                            $("#editForm input[name='is_coupon']").prop('checked', false);
                        }

                        if(data.imageExists){
                            $(Publication.vars.EditImageDiv).html(Publication.vars.ImageHtml(data.urlImage));
                        }
                        else{
                            $(Publication.vars.EditImageDiv).html(Publication.vars.NoImageHtml);
                        }
                        $("#editForm select[name='category']").val(data.id_category);
                        $("#editForm select[name='company']").val(data.id_company);
                        $("#editForm textarea[name='description']").text(data.description);
                        $("#editForm input[name='title']").val(data.title);

                    }
                    else{
                        Publication.EditBox.Disabled();
                        $(Publication.vars.EditImageDiv).html(Publication.vars.NoImageHtml);
                    }
                },
                function(jqXHR){
                    Base.Loader.hide(Publication.vars.EditBoxClass);
                },
                function(){
                    $(Publication.vars.EditImageDiv).html(Publication.vars.NoImageHtml);
                    Publication.EditBox.Disabled();
                }
            );
        }
    },
    EditBox: {
        Disabled: function(cssClass = Publication.vars.EditBoxClass){
            $(cssClass + " :input").attr('disabled', true);
        },
        Enabled: function (cssClass = Publication.vars.EditBoxClass) {
            $(cssClass + " :input").attr('disabled', false);
        }
    },
    CancelEdit: function(){
        var table = $(Publication.vars.PublicationTable).DataTable();
        table.$('tr.tr-selected').removeClass('tr-selected');
        Publication.EditBox.Disabled();
        $("#editForm input[name='deleteImage']").val(0);
    },
    ViewModal: function (row) {
        var id = $(row).find('td').first().text();

        Base.Ajax(Publication.vars.urls.showPublication(id), 'GET', null, true,
            function () {
                $('#viewBody').empty();
                Base.Loader.show();
                $('#viewModal').modal('toggle');
            },
            function (jqXHR) {
                console.log(jqXHR);
                var data = jqXHR.data;
                $("#viewBody").html(data.view);
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
                $(id).html(Publication.vars.ImageHtml(e.target.result));
            }

            reader.readAsDataURL(input.files[0]);
        }
    },
    DeletePublication: function(form) {
        Base.ConfirmDelete("¿Está seguro que desea eliminar la publicación?",
            "Se eliminará todos los datos relacionados de forma permanente",
            function(){
            $(form).submit();
        });
    },
    DeleteImage: function (e, button) {
        e.preventDefault();
        var input = $(button).next();
        $(input).val(1);
        $(Publication.vars.EditImageDiv).html(Publication.vars.NoImageHtml);
    }
};