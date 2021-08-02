$(document).ready(function() {
	InfoProfile.LoadStates();
	InfoProfile.LoadForm();
	
	//InfoProfile.LoadCities('31');
});

var InfoProfile = {
	vars:{
		mapLoader: "#map",
		EditBoxClass: ".edit-box",
		EditImageDiv: "#editImage",
        AddImageDiv: "#addImage",
        markersArray: [],
        ImageHtml: function (url) { return '<img class="img-fluid center-block" src="' + url + '" style="max-width: 100%; height: auto;">'; },
        NoImageHtml: '<div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;"><p>Sin imagen</p></div><br>',
		urls: {
			'getInfoProfile': '/admin/getInfoProfile'
		}
	},

	LoadForm: function(){
		Base.Ajax(InfoProfile.vars.urls.getInfoProfile, 'GET', null, true,
				function(){
					InfoProfile.EditBox.Disabled();
                    Base.Loader.show(InfoProfile.vars.EditBoxClass);
				},
				function(r){
					if(r.response == 'success'){
						// console.log(r);
						InfoProfile.EditBox.Enabled();
						var data = r.data;

						$("input[name=name]").val(data.company_info.name);
						$("input[name=slogan]").val(data.company_info.slogan);
						$("input[name=paginationElements]").val(data.paginationElements);
						$("input[name=suburb]").val(data.company_info.address.suburb);
						$("input[name=street]").val(data.company_info.address.street);
						$("input[name=crossing]").val(data.company_info.address.crossing);
						$("input[name=number]").val(data.company_info.address.number);
						
						$("select[name=state]").val(data.company_info.address.state.id);
						$("input[name=stateName]").val(data.company_info.address.state.name);

						var cities = InfoProfile.LoadCities(data.company_info.address.state.id);

						$("select[name=state]").change(function(){
							InfoProfile.LoadCities($(this).val());
						});

						$("select[name=city]").val(data.company_info.address.city.id);
						$("input[name=cityName]").val(data.company_info.address.city.name);

						if(r.imageExists){
                            $(InfoProfile.vars.EditImageDiv).html(InfoProfile.vars.ImageHtml(data.company_info.logo_url));
                        }
                        else{
                            $(InfoProfile.vars.EditImageDiv).html(InfoProfile.vars.NoImageHtml);
                        }

                        InfoProfile.LoadMap(InfoProfile.vars.mapLoader, data.company_info.address.location, data.company_info.name, data.company_info.logo_url);

					}else{
						Base.Loader.hide(InfoProfile.vars.EditBoxClass);
						InfoProfile.EditBox.Disabled();
					}
					
				},
                function(jqXHR){
                    Base.Loader.hide(InfoProfile.vars.EditBoxClass);
                },
                function(){
                   
                    InfoProfile.EditBox.Disabled();
                }
        );
	},

	EditBox: {
        Disabled: function(cssClass = InfoProfile.vars.EditBoxClass){
            $(cssClass + " :input").attr('disabled', true);
        },
        Enabled: function (cssClass = InfoProfile.vars.EditBoxClass) {
            $(cssClass + " :input").attr('disabled', false);
        }
    },

    LoadStates: function(){
    	Base.Ajax('http://api-catalogo.cre.gob.mx/api/utiles/entidadesfederativas', 'GET', null, true,
    		function(){
    			console.log('cargando estados');
    		},
    		function(r){
    			console.log(r);
    			$.each(r, function(index, state) {
    				 $("select[name=state]").append('<option value="'+state.EntidadFederativaId+'">'+state.Nombre+'</option>');
    			});
    		},
    		function(){
    			console.log('carga completa de estados');
    		}
    	);
    },
    LoadCities: function(stateId){
    	Base.Ajax('http://api-catalogo.cre.gob.mx/api/utiles/municipios?EntidadFederativaId='+stateId, 'GET', null, false,
    		function(){
    			console.log('cargando ciudades');
    		},
    		function(r){
    			$("select[name=city]").empty();
    			$("select[name=city]").append('<option value="">seleccione una ciudad</option>');
    			$.each(r, function(index, city) {
    				 $("select[name=city]").append('<option value="'+city.MunicipioId+'">'+city.Nombre+'</option>');
    			});
    		},
    		function(){
    			console.log('carga completa de ciudades');
    		}
    	);
    },
    PreviewImage: function(input, id){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id).html(InfoProfile.vars.ImageHtml(e.target.result));
            }

            reader.readAsDataURL(input.files[0]);
        }
    },
    LoadMap: function(mapLoader, location, nombre, logo_url){
    	var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: location
        });
        var geocoder = new google.maps.Geocoder();

        InfoProfile.geoCodeLocation(geocoder, map, location, nombre, logo_url);

        google.maps.event.addListener(map, 'click', function(event){
          InfoProfile.addMark(event.latLng, map, nombre, geocoder, logo_url);
        });

    },
    geoCodeLocation: function(geocoder, map, location, nombre, logo_url){
    	geocoder.geocode({'location': location}, function(results, status) {
          if (status === 'OK') {
            console.log(results);
            if(InfoProfile.vars.markersArray.length > 0){
              InfoProfile.deleteMarkers();
            }

            map.setCenter(results[0].geometry.location);
            map.fitBounds(results[0].geometry.viewport);

            var contenido = '<img style="max-width:100px;" class="center-block" src="'+logo_url+'"></img><h2> '+ nombre +' </h2>' + '<p> '+results[0].formatted_address+' </p>';

	    	var informacion = new google.maps.InfoWindow({
	        	content: contenido,
          		maxWidth: 200
	      	});

            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location,
              draggable: true,
              animation: google.maps.Animation.DROP,
              title: nombre
            });

            marker.addListener('mouseover', function(){
		    	informacion.open(map, marker);
		    });

            InfoProfile.vars.markersArray.push(marker);
            $("input[name=lat]").val(location.lat);
            $("input[name=lng]").val(location.lng);

          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
    },
    deleteMarkers: function(){
    	for(var i=0; i < InfoProfile.vars.markersArray.length; i++){
			InfoProfile.vars.markersArray[i].setMap(null);
		}
		InfoProfile.vars.markersArray = new Array();
    },
    addMark: function(location, map, nombre, geocoder, logo_url){
        geocoder.geocode({'location': location}, function(results, status) {
          

	        if(InfoProfile.vars.markersArray.length > 0){
	          InfoProfile.deleteMarkers();
	        }

	        var contenido = '<img style="max-width:100px;" class="center-block" src="'+logo_url+'"></img><h2> '+ nombre +' </h2>' + '<p> '+results[0].formatted_address+' </p>';

	    	var informacion = new google.maps.InfoWindow({
	        	content: contenido,
	      		maxWidth: 200
	      	});

	        var marker = new google.maps.Marker({
	            position: location,
	            map: map,
	            draggable:true,
	            animation: google.maps.Animation.DROP,
	            title: nombre
	        });

	        marker.addListener('mouseover', function(){
		    	informacion.open(map, marker);
		    });

	        InfoProfile.vars.markersArray.push(marker);
	        $("input[name=lat]").val(location.lat);
	        $("input[name=lng]").val(location.lng);

        });
    }
}