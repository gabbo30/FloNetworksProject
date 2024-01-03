function llenartabla_por_id() {

	var num_parte = document.getElementById('num_parte').value;

	var data_send = 'num_parte='+num_parte;

	event.preventDefault();
	$.ajax({
		url: '?action=por_num_parte',
		type: 'POST',
		data: data_send,
		success:function(resp){
			location.reload();
		}
	})
	return false;
}

/******************************************************************/
/******************************************************************/
/******************************************************************/
/******************************************************************/

function llenar_datos_desc(resp){
	event.preventDefault();
	$.ajax({
		data:resp,
		url: '?action=por_descripcion',
		dataType: 'json',
		success:function(resp){
			event.preventDefault();
			var d = '<tr>'+
				'<th># Parte</th>'+
				'<th>Descripción</th>'+
				'<th>Precio</th>'+
			'</tr>';
			for (var i = 1; i < resp.length; i++)
			{
				d+= '<tr>'+
				'<td>'+ resp[i].Num_Parte+'</td>'+
				'<td>'+ resp[i].Descripcion+'</td>'+
				'<td>'+ resp[i].Precio+'</td>'+
				'</tr>';
			}
			$("#tabla tr:first").remove();
			$("#tabla tr:first").remove();
			$("#tabla").append(d);
		},
		error: function(){
			var err = '<p>ERROR!</p>';
			$("#tabla").append(err);
		}
	});
	return false;
}

function llenartabla_por_desc() {

	var descripcion = document.getElementById('descripcion').value;
	var data_send = 'descripcion='+descripcion;

	event.preventDefault();
	$.ajax({
		url: '?action=por_descripcion',
		type: 'POST',
		data: data_send,
		success:function(datos){
			llenar_datos_desc(datos);
		},
		//error: function(){
		//	var err = '<p>ERROR!</p>';
		//	$("#tabla").append(err);
		//}
	});
	return false;
}

/******************************************************************/
/******************************************************************/
/******************************************************************/
/******************************************************************/