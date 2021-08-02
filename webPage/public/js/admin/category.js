$(document).ready(function(){
    Category.LoadCategoryTable();
    Category.EditBox.Disabled();
});

var Category = {
    vars: {
        CategoryTable: "#categories_dataTable",
        tbodyCategoryTable: "#categories_dataTable tbody",
        CategoryTableLoader: ".table-responsive",
        EditBoxClass: ".edit-box",
        ViewModalClass: "#viewModal",
        EditImageDiv: "#editImage",
        AddImageDiv: "#addImage",
        ImageHtml: function (url) { return '<img class="img-fluid" src="' + url + '" style="max-width: 100%; height: auto;">'; },
        NoImageHtml: '<div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;"><p>Sin imagen</p></div><br>',
        urls:{
            getCategories: '/admin/getCategories',
            editCategory: function (id) { return '/admin/category/' + id + '/edit' },
            showCategory: function (id) { return '/admin/category/' + id },
        }
    },
    LoadCategoryTable: function () {
        Base.Ajax(Category.vars.urls.getCategories, 'GET', null, true,
            function(xhr, settings){
                Base.Loader.show(Category.vars.CategoryTableLoader);
            },
            function(resp){
                $(Category.vars.tbodyCategoryTable).html(resp.html);
                var table = $(Category.vars.CategoryTable).DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
            },
            function(){
                Base.Loader.hide(Category.vars.CategoryTableLoader);
            });
    },
    OnTbodyCategoryTable: function(row){
        var table = $(Category.vars.CategoryTable).DataTable();
        $("#editForm input[name='deleteImage']").val(0);
        if ( $(row).hasClass('tr-selected') ) {
            $(row).removeClass('tr-selected');
            Category.EditBox.Disabled();
        }
        else {
            table.$('tr.tr-selected').removeClass('tr-selected');
            $(row).addClass('tr-selected');

            var id = $(row).find('td').first().text();

            var lastIndex = $("#editForm").attr("action").lastIndexOf('/');
            var action = $("#editForm").attr("action").substr(0, lastIndex) + "/" + id;
            $("#editForm").attr("action", action);


            Base.Ajax(Category.vars.urls.editCategory(id), 'GET', null, true,
                function () {
                    Category.EditBox.Disabled();
                    Base.Loader.show(Category.vars.EditBoxClass);
                },
                function (jqXHR) {
                    console.log(jqXHR);
                    if(jqXHR.response === "success"){
                        Category.EditBox.Enabled();
                        var data = jqXHR.data;

                        $("#relatedTable").html(data.table);
                        
                        if(data.imageExists){
                            $(Category.vars.EditImageDiv).html(Category.vars.ImageHtml(data.urlImage));
                        }
                        else{
                            $(Category.vars.EditImageDiv).html(Category.vars.NoImageHtml);
                        }
                        
                        $("#editForm textarea[name='longDescription']").text(data.longDescription);
                        $("#editForm input[name='shortDescription']").val(data.shortDescription);

                    }
                    else{
                        Category.EditBox.Disabled();
                        $(Category.vars.EditImageDiv).html(Category.vars.NoImageHtml);
                    }
                },
                function(jqXHR){
                    Base.Loader.hide(Category.vars.EditBoxClass);
                },
                function(){
                    $(Category.vars.EditImageDiv).html(Category.vars.NoImageHtml);
                    Category.EditBox.Disabled();
                }
            );
        }
    },
    EditBox: {
        Disabled: function(cssClass = Category.vars.EditBoxClass){
            $(cssClass + " :input").attr('disabled', true);
        },
        Enabled: function (cssClass = Category.vars.EditBoxClass) {
            $(cssClass + " :input").attr('disabled', false);
        }
    },
    CancelEdit: function(){
        var table = $(Category.vars.CategoryTable).DataTable();
        table.$('tr.tr-selected').removeClass('tr-selected');
        Category.EditBox.Disabled();
        $("#editForm input[name='deleteImage']").val(0);
    },
    ViewModal: function (row) {
        var id = $(row).find('td').first().text();

        Base.Ajax(Category.vars.urls.showCategory(id), 'GET', null, true,
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
                $(id).html(Category.vars.ImageHtml(e.target.result));
            }

            reader.readAsDataURL(input.files[0]);
        }
    },
    DeleteCategory: function(form) {
        Base.ConfirmDelete("¿Está seguro que desea eliminar la categoría?",
            "Se eliminará todos los datos relacionados de forma permanente",
            function(){
            $(form).submit();
        });
    },
    DeleteImage: function (e, button) {
        e.preventDefault();
        var input = $(button).next();
        $(input).val(1);
        $(Category.vars.EditImageDiv).html(Category.vars.NoImageHtml);
    }
};