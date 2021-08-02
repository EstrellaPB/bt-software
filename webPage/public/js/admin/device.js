$(document).ready(function(){
    Device.LoadDeviceTable();
    Device.EditBox.Disabled();
});

var Device = {
    vars: {
        DeviceTable: "#devices_dataTable",
        tbodyDeviceTable: "#devices_dataTable tbody",
        DeviceTableLoader: ".table-responsive",
        EditBoxClass: ".edit-box",
        ViewModalClass: "#viewModal",
        token: $('input[name="_token"]').val(),
        urls:{
            getDevices: '/admin/getDevices',
            editDevice: function (id) { return '/admin/device/' + id + '/edit' },
            showDevice: function (id) { return '/admin/device/' + id },
            validateUnique: '/admin/device/validateMacUnique'
        }
    },
    LoadDeviceTable: function () {
        Base.Ajax(Device.vars.urls.getDevices, 'GET', null, true,
            function(xhr, settings){
                Base.Loader.show(Device.vars.DeviceTableLoader);
            },
            function(resp){
                $(Device.vars.tbodyDeviceTable).html(resp.html);
                var table = $(Device.vars.DeviceTable).DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
            },
            function(){
                Base.Loader.hide(Device.vars.DeviceTableLoader);
            });

        var validatorAdd = $("#addForm").validate({
            rules: {
                mac: {
                  required: true,
                  macFormat: true,
                  minlength: 17,
                  remote: {
                    url: Device.vars.urls.validateUnique,
                    headers: {'X-CSRF-TOKEN': Device.vars.token},
                    type: 'POST',
                    dataType: 'json',
                    data: {mac: function(){ return $('#addForm').find("input[name=mac]").val() }},
                    
                  }
                  
                }
            },
            'messages': {
                'mac': {
                    'required': "El campo es requerido",
                    'minlength': "La MAC no puede tener menos de 17 caracteres",

                    'remote': "La MAC ya está siendo usada por otro dispositivo"
                }
            }
        });

        validatorAdd.resetForm();

        $("#addForm input").keyup(function(){
            $("#addForm").valid();
        })

    },
    OnTbodyDeviceTable: function(row){
        //Device.addValidatorUnique();
        
        var validator = $("#editForm").validate({
            rules: {
                mac: {
                  required: true,
                  macFormat: true,
                  minlength: 17,
                  remote: {
                    url: Device.vars.urls.validateUnique,
                    headers: {'X-CSRF-TOKEN': Device.vars.token},
                    type: 'POST',
                    dataType: 'json',
                    data: {id: function(){ return $("#editForm").find('input[name=id]').val() }, mac: function(){ return $("#editForm").find("input[name=mac]").val() }},
                    
                  }
                  
                }
            },
            'messages': {
                'mac': {
                    'required': "El campo es requerido",
                    'minlength': "La MAC no puede tener menos de 17 caracteres",
                    'remote': "La MAC ya está siendo usada por otro dispositivo"
                }
            }
        });
        validator.resetForm();

        $("#editForm input").keyup(function(){
            $("#editForm").valid();
        })

        // $("#editForm input").change(function(){
        //     $("#editForm").valid();
        //     console.log('change' + $("#editForm").valid());
        // })
        var table = $(Device.vars.DeviceTable).DataTable();
        
        if ( $(row).hasClass('tr-selected') ) {
            $(row).removeClass('tr-selected');
            Device.EditBox.Disabled();
        }
        else {
            table.$('tr.tr-selected').removeClass('tr-selected');
            $(row).addClass('tr-selected');

            var id = $(row).find('td').first().text();

            var lastIndex = $("#editForm").attr("action").lastIndexOf('/');
            var action = $("#editForm").attr("action").substr(0, lastIndex) + "/" + id;
            $("#editForm").attr("action", action);


            Base.Ajax(Device.vars.urls.editDevice(id), 'GET', null, true,
                function () {
                    Device.EditBox.Disabled();
                    Base.Loader.show(Device.vars.EditBoxClass);
                },
                function (jqXHR) {
                    console.log(jqXHR);
                    if(jqXHR.response === "success"){
                        Device.EditBox.Enabled();
                        var data = jqXHR.data;
                        $("#relatedTable").html(data.table);
                        if(data.status){
                            
                            $("#editForm input[name='status']").prop('checked', true);
                        }
                        else{
                            
                            $("#editForm input[name='status']").prop('checked', false);
                        }
                        
                        $("#editForm input[name='mac']").val(data.mac);
                        $("#editForm input[name='id']").val(data.id);


                    }
                    else{
                        Device.EditBox.Disabled();
                       
                    }
                },
                function(jqXHR){
                    Base.Loader.hide(Device.vars.EditBoxClass);
                },
                function(){
                   
                    Device.EditBox.Disabled();
                }
            );
        }
    },
    EditBox: {
        Disabled: function(cssClass = Device.vars.EditBoxClass){
            $(cssClass + " :input").attr('disabled', true);
        },
        Enabled: function (cssClass = Device.vars.EditBoxClass) {
            $(cssClass + " :input").attr('disabled', false);
        }
    },
    CancelEdit: function(){
        var table = $(Device.vars.DeviceTable).DataTable();
        table.$('tr.tr-selected').removeClass('tr-selected');
        Device.EditBox.Disabled();
        
    },
    ViewModal: function (row) {
        var id = $(row).find('td').first().text();

        Base.Ajax(Device.vars.urls.showDevice(id), 'GET', null, true,
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
    DeleteDevice: function(form) {
        Base.ConfirmDelete("¿Está seguro que desea eliminar el dispositivo?",
            "Se eliminará todos los datos relacionados de forma permanente",
            function(){
            $(form).submit();
        });
    },
    upperCaseF : function (a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }
    
};