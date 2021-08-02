var Base = {
	GetDayOfWeek: function(index) {
		let days = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
		return days[index] === undefined ? null : days[index]; 
	},
	swalStyle: {
		btn_primary: '#1ab394',
		btn_danger: '#ed5565',
		btn_warning: '#f8ac59',
		btn_success: '#1c84c6',
		btn_info: '#23c6c8'
	},
	vars: { 
		flag: true,/*para leaflet-sidebar.js: 170*/
		canCreate:false,
        canDelete:false,
        canEdit:false,
		itemClass: 'bg-primary',
		confirm: null,
		beforePanel: null,
		rowColor: 'bg-danger',
		OnOpenSidebar : null
	},
	Loader: {
		hide: function(cssClass = '.with-loader') {
			$(cssClass).removeClass('sk-loading');
		},
		show: function(cssClass = '.with-loader') {
			$(cssClass).addClass('sk-loading');
		}
	},
	host: window.location.origin,
	url: {
		logoPath: '../src/logos/',
		dt_language: '/src/json/language_dt.json'
	},
	CreateTable: function(tableId,dom,ajaxUrl,buttons,columns,columnsDefault,onDrawCallback,onDrawRowCallback,onInitComplete = () => {}) {
		var table = $(tableId).DataTable({
			pageLength: 10,
			responsive: true,
			dom: dom,
			buttons: buttons,
			processing: true,
			serverSide: true,
			language: {
				url: Base.url.dt_language
			},
        	ajax: {
        		url: ajaxUrl,
        		method: 'GET'
        	},
        	columns: columns,
        	columnDefs: columnsDefault,
		    fnDrawCallback: function( oSettings ) {
		    	onDrawCallback();
    		},
		    fnRowCallback: function(row,data,index) {
		    	onDrawRowCallback(row,data,index);
		    },
		    initComplete: function(settings, json) {
		    	var lengthBtn = table.buttons().length
		    	var lengthCol = table.columns()[0].length
		    	if(!Base.vars.canDelete){
		    		table.buttons(lengthBtn-1).remove();
		    		table.columns(lengthCol-1).visible(false);
		    	}
		    	if(!Base.vars.canCreate)
		    		table.buttons(lengthBtn-2).remove();
		    	
		    	if(!Base.vars.canEdit)
		    		table.columns(lengthCol-2).visible(false);
		    	table.buttons().enable()
		    	onInitComplete(settings, json);
		  	},
		});
		return table;
	},
	TableEvents: function(tableId,event,selector,callback) {
		$(tableId).on(event,selector, function(e) {
			e.preventDefault();
			callback($(this));
		});
	},
	Ajax: function(url,method,_data,async,beforesend, onsuccess,oncomplete,onerror=null) {
		var oncomplete = oncomplete || function() {};
		try {
			$.ajax({
				url: url,
			  	type: method,
			  	dataType: 'json',
			  	data: _data,
			  	async: async,
				beforeSend: function(xhr, settings){
                    beforesend(xhr);
				},
			  	complete: function(xhr, textStatus) {
			    	oncomplete(xhr);
			  	},
			  	success: function(data, textStatus, xhr) {
			    	onsuccess(data);
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
		}catch(ex) {
			Base.Loader.hide('.ibox-content, .with-loader');
			console.log(ex.message);
		}
	},
	ButtonCancelEdit: function(buttonId,urlToRedirect,title = 'Desea cancelar la edición?',message = 'No se guardarán los cambios hechos') {
		$(buttonId).click(function(e) {
			e.preventDefault();
			swal({
				title: title,
				text: message,
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: swalStyle.btn_warning,//btn-primary
				confirmButtonText: 'Continuar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true,
				closeOnCancel: true
    		},
    		function(){
    			window.location.href = urlToRedirect; 
    		});
		});
	},
	ModalFormCancel: function(buttonId, redirectUrl) {
		$(buttonId).click(function(e) {
			e.preventDefault();
			swal({
				title: '¿Desea cancelar la operación?',
				text: 'No se guardarán los cambios hechos',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: swalStyle.btn_warning,//btn-primary
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true,
				closeOnCancel: true
    		},
    		function(){
    			window.location.href = redirectUrl; 
    		});
		});
	},
	BasicModal: function(type,title,message,txtbtnConfirm,txtbtnCancel,onconfirmCallback) {
		var onconfirmCallback = onconfirmCallback || function() {};
		swal({
			title: title,
			text: message,
			type: type,
			showCancelButton: true,
			confirmButtonColor: swalStyle.btn_warning,//btn-primary
			confirmButtonText: txtbtnConfirm,
			cancelButtonText: txtbtnCancel,
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function(){
			onconfirmCallback(this); 
		});
	},
	ModalSelectARow: function() {
		swal({
			title: 'Seleccion',
			text: message,
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: swalStyle.btn_warning,//btn-primary
			confirmButtonText: 'Continuar',
			cancelButtonText: 'Cancelar',
			closeOnConfirm: true,
			closeOnCancel: true
		});
	},
	AddToDeleteArray: function($obj,isChecked, idsArray, toDeleteArray) {
		var index = $obj.data('index'),
		businessIds = idsArray,
		toDeleteArray = toDeleteArray,
		businessId = businessIds[index];
		if ( isChecked ) {
			if ( businessId !== undefined )
				toDeleteArray[index] = businessId;
		} else {
			if ( toDeleteArray.length !== 0 )
				toDeleteArray.length = 0;
		}
	},
	FilterOptionsForSelectInput: function($obj,dataIdProperty, optionsSelector, callback) {
		var callback = callback || function() {},
		id = $obj.val(),
		$selector = $(optionsSelector),
		optionElement = null,
		idToFilter = null;
		$selector.parents('select').val(null);
		callback();
		$.each($selector, function(index, item) {
			optionElement = $(item);
			idToFilter = optionElement.data(dataIdProperty);
			if (idToFilter == id)
				optionElement.prop('hidden', false);
			else
				optionElement.prop('hidden', true);
			
		});
	},
	ObjectsToArray: function($objs,callback) {
		return $.map($objs, function( obj, index ) {
			return callback( $(obj),index );
		});
	},
	FindObject: function(objects,key,value) {
		let result = null;
		if ( objects.length > 0 )
			objects.forEach((obj,i) => {
			    if( obj[key] == value ) 
			         result = obj;
			});
		return result;
	}, 
	RemoveObject: function(objects,key,value) {
		let result = null;
		if ( objects.length > 0 )
			$.each(objects, function(index, obj) {
			    if( obj[key] == value ){
			    	result = index;
			    	return false;
			    } 
			});
		objects.splice(result,1);
	},
	Toast: function(title, message, options = {timeOut: 3000, progressBar: true, closeButton: true, newestOnTop: true}) {
		toastr.success(message, title, options);
	},
	ToastInfo: function(title, message, options = {timeOut: 4000, progressBar: true, closeButton: true, newestOnTop: true}) {
		toastr.info(message, title, options);
	},
	ToastWarning: function(title, message, options = {timeOut: 4000, progressBar: true, closeButton: true, newestOnTop: true}) {
		toastr.warning(message, title, options);
	},
	ToastError: function(title, message, options = {timeOut: 4000, progressBar: true, closeButton: true, newestOnTop: true}) {
		toastr.error(message, title, options);
	},
    DateFormat: function(date, format = 'DD/MM/YY') {
    	let dateFormat = date !== null && date != '' ? moment(date).format(format) : '-';
    	return dateFormat;
    },
    ConfirmDelete: function(titleText, messageText, onconfirmCallback) {
    	swal({
			title: titleText,
			text: messageText,
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: swalStyle.btn_warning,//btn-primary
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar',
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function(){
			onconfirmCallback(this); 
		});
    },
    ConfirmRemoveImage: function(callback) {
		swal({
			title: '¿Desea eliminar la imagen de perfil?',
			text: 'La imagen se eliminará permanentemente',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: swalStyle.btn_warning,//btn-primary
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar',
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function(){
			callback();
		});
    },
    GetRandomHexColor: function(hash = '#') { // regresa string color hexa
    	var letters = '0123456789ABCDEF';
	  	var color = hash;
	  	for (var i = 0; i < 6; i++) {
	    	color += letters[Math.floor(Math.random() * 16)];
	  	}
	  	return color;
    },
    FormReset: function($form) {
    	$form[0].reset();
    },
    Search: function($button,$input,$containers,$items,callback = () => {}) {
    	$input.off('keypress');
    	$input.keypress(function(e) {
    		if ( e.which === 13 && $input.val() != '' )
    			Base.SearchFilter($containers,$items,$input.val(),callback);
    	});
    	$input.off('input');
    	$input.on('input',function(e) {
    		let value = $(this).val();
    		if ( value == '' || value === null )
    			Base.SearchFilter($containers,$items,value,callback);
    	});
    	$button.off('click');
		$button.click(function(e) {
			let text = $input.val().trim().toLowerCase();
			Base.SearchFilter($containers,$items,text,callback);
		});
	},
};