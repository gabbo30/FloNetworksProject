/* -- Comienzan las funciones de jQuery -- */
function like_post(id_post) {
	//var id_post = document.getElementById('id_post').value;
	//var user_id = document.getElementById('user_id').value;

	var data_send = 'id_post='+id_post;

	event.preventDefault();
	$.ajax({
		url: '?action=like_post',
		type: 'POST',
		data: data_send,
		success:function(resp){
			alertify.message('Te gusta este post');
			location.reload();
			/*$("#btn_like").prop('disabled', true);
			$("#btn_like").text('<i class="icon-heart"></i> &nbsp;  Te Gusta');*/
		}
	})
	return false;
}

function unlike_post(id_post, id_user) {
	var data_send = 'id_post='+id_post+'&user_id='+id_user;
	event.preventDefault();
	$.ajax({
		url: '?action=unlike_post',
		type: 'POST',
		data: data_send,
		success:function(resp){
			alertify.message('Ya no te gusta este post');
			location.reload();
		}
	})
	return false;
}

function save_location() {
	var lat = document.getElementById('lat').value;
	var lon = document.getElementById('lon').value;
	
	var data_send = 'lat='+lat+'&lon='+lon;
	event.preventDefault();
	$.ajax({
		url: '?action=save_location',
		type: 'POST',
		data: data_send,
		success:function(resp){
			$(location).attr('href',"./");
		}
	})
	return false;
}
/* Funciones de apoyo y ejemplos */

function seleccionar_id_cliente(modal_del_id_cliente) {
	document.getElementById('modal_del_id_cliente').value = modal_del_id_cliente;
}

function actualizar_cliente() {
	var id = document.getElementById('modal_id_cliente').value;
	var num_cliente = document.getElementById('modal_num_cliente').value;
	var nombre = document.getElementById('modal_nombre').value;
	var empresa = document.getElementById('modal_empresa').value;

	var data_send = 'modal_num_cliente='+num_cliente+'&modal_nombre='+nombre+'&modal_empresa='+empresa+'&modal_id_cliente='+id;

	event.preventDefault();
	$.ajax({
		url: '?action=actualizar_cliente',
		type: 'POST',
		data: data_send,
		success:function(resp){
			location.reload();
		}
	})
	return false;
}

function eliminar_cliente() {
	var modal_del_id_cliente = document.getElementById('modal_del_id_cliente').value;

	var data_send = 'modal_del_id_cliente='+modal_del_id_cliente;

	event.preventDefault();
	$.ajax({
		url: '?action=eliminar_cliente',
		type: 'POST',
		data: data_send,
		success:function(resp){
			location.reload();
		}
	})
	return false;
}