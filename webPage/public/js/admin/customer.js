$(document).ready(function(){
    Customer.LoadCustomerTable();
    Customer.EditBox.Disabled();
});

var Customer = {
    vars: {
        CustomerTable: "#customers_dataTable",
        tbodyCustomerTable: "#customers_dataTable tbody",
        CustomerTableLoader: ".table-responsive",
        CustomerCouponsTableLoader: "#customerCouponsLoad",
        EditBoxClass: ".edit-box",
        ViewModalClass: "#viewModal",
        CustomerCouponsTable: "#customerCoupons_dataTable",
        tbodyCustomerCouponTable: "#customerCoupons_dataTable tbody",
        EditImageDiv: "#editImage",
        AddImageDiv: "#addImage",
        ImageHtml: function (url) { return '<img class="img-fluid" src="' + url + '" style="max-width: 100%; height: auto;">'; },
        NoImageHtml: '<div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;"><p>Sin imagen</p></div><br>',
        urls:{
            getCustomers: '/admin/getCustomers',
            editCustomer: function (id) { return '/admin/customer/' + id + '/edit' },
            showCustomer: function (id) { return '/admin/customer/' + id },
            getCustomerCoupons: function (id) { return '/admin/getCustomerCoupons/' + id}
        }
    },
    LoadCustomerTable: function () {
        Base.Ajax(Customer.vars.urls.getCustomers, 'GET', null, true,
            function(xhr, settings){
                Base.Loader.show(Customer.vars.CustomerTableLoader);
            },
            function(resp){
                $(Customer.vars.tbodyCustomerTable).html(resp.html);
                var table = $(Customer.vars.CustomerTable).DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
            },
            function(){
                Base.Loader.hide(Customer.vars.CustomerTableLoader);
            });
    },
    LoadCustomerCouponsTable: function(id){
        Base.Ajax(Customer.vars.urls.getCustomerCoupons(id), 'GET', null, true,
            function(xhr, settings){
                Base.Loader.show(Customer.vars.CustomerCouponsTableLoader);
            },
            function(resp){
                $(Customer.vars.tbodyCustomerCouponTable).html(resp.html);
                var table = $(Customer.vars.CustomerCouponsTable).DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
            },
            function(){
                Base.Loader.hide(Customer.vars.CustomerCouponsTableLoader);
                
            } );
    },
    OnTbodyCustomerTable: function(row){
        var table = $(Customer.vars.CustomerTable).DataTable();
        $("#editForm input[name='deleteImage']").val(0);
        if ( $(row).hasClass('tr-selected') ) {
            $(row).removeClass('tr-selected');
            Customer.EditBox.Disabled();
        }
        else {
            table.$('tr.tr-selected').removeClass('tr-selected');
            $(row).addClass('tr-selected');

            var id = $(row).find('td').first().text();

            var lastIndex = $("#editForm").attr("action").lastIndexOf('/');
            var action = $("#editForm").attr("action").substr(0, lastIndex) + "/" + id;
            $("#editForm").attr("action", action);


            Base.Ajax(Customer.vars.urls.editCustomer(id), 'GET', null, true,
                function () {
                    Customer.EditBox.Disabled();
                    Base.Loader.show(Customer.vars.EditBoxClass);
                },
                function (jqXHR) {
                    console.log(jqXHR);
                    if(jqXHR.response === "success"){
                        Customer.EditBox.Enabled();
                        var data = jqXHR.data;
                        
                        $("#relatedTable").html(data.table);

                        $("#editForm input[name='email']").val(data.email);
                        $("#editForm input[name='name']").val(data.name);
                        $("#editForm input[name='first_name']").val(data.first_name);
                        $("#editForm input[name='last_name']").val(data.last_name);
                        $("#editForm input[name='address']").val(data.address);
                        $("#editForm input[name='tel']").val(data.tel);
                        $("#editForm input[name='city']").val(data.city);
                        $("#editForm input[name='state']").val(data.state);

                    }
                    else{
                        Customer.EditBox.Disabled();
                       
                    }
                },
                function(jqXHR){
                    Base.Loader.hide(Customer.vars.EditBoxClass);
                },
                function(){
                   
                    Customer.EditBox.Disabled();
                }
            );
        }
    },
    EditBox: {
        Disabled: function(cssClass = Customer.vars.EditBoxClass){
            $(cssClass + " :input").attr('disabled', true);
        },
        Enabled: function (cssClass = Customer.vars.EditBoxClass) {
            $(cssClass + " :input").attr('disabled', false);
        }
    },
    CancelEdit: function(){
        var table = $(Customer.vars.CustomerTable).DataTable();
        table.$('tr.tr-selected').removeClass('tr-selected');
        Customer.EditBox.Disabled();
       
    },
    ViewModal: function (row) {
        var id = $(row).find('td').first().text();

        Base.Ajax(Customer.vars.urls.showCustomer(id), 'GET', null, true,
            function () {
                $('#viewBody').empty();
                Base.Loader.show();
                $('#viewModal').modal('toggle');
            },
            function (jqXHR) {
                console.log(jqXHR);
                var data = jqXHR.data;
                $("#viewBody").html(data.view);
                Customer.LoadCustomerCouponsTable(id);

            },
            function(jqXHR){
                Base.Loader.hide();
            }
        );
    },
    DeleteCustomer: function(form) {
        Base.ConfirmDelete("¿Está seguro que desea eliminar el usuario?",
            "Se eliminarán todos los datos relacionados de forma permanente",
            function(){
            $(form).submit();
        });
    },
    DeleteCustomerCoupon: function(form) {
        Base.ConfirmDelete("¿Está seguro que desea eliminar el cupón?",
            "Se eliminarán todos los datos relacionados de forma permanente",
            function(){
            //$(form).submit();
            //console.log($(form).parent().parent());
            Base.Ajax($(form).attr('action'), 'GET', null, true,
                function(xhr, settings){
                    Base.Loader.show(Customer.vars.CustomerCouponsTableLoader);
                },
                function(resp){
                    if(resp.response == 'success'){
                       var tableCoupons = $(Customer.vars.CustomerCouponsTable).DataTable();
                        tableCoupons
                            .row($(form).parent().parent())
                            .remove()
                            .draw();
                        Base.ToastInfo("Usuario", resp.message); 
                    }else{
                        Base.ToastError("Usuario", resp.message); 
                    }
                        
                    
                },
                function(){
                    Base.Loader.hide(Customer.vars.CustomerCouponsTableLoader);
                });
                    

        });
    }
    
};