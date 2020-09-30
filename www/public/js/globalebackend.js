$(document).ready(function(){
	//start  setup token for the whole laravel app to send data or retrive data
	$.ajaxSetup({
		headers: {
		  	'X-CSRF-TOKEN': $('meta[name="_token"]').attr("content")
		}
	});
	//end  setup token for the whole app to send data or retrive data

	//start turn off auto complet for all app
	$("input").attr('autocomplete', 'off');
	//endturn off auto complet for all app

	//select2 dropdown for the whole app
	$(".select").select2();
	//select2 dropdown for the whole app

	//date for the whole app
	$('.date').daterangepicker({
		singleDatePicker: true,
		locale: {
			format: 'YYYY-MM-DD'
		} 
	});
	//date for the whole app
	
	// start  confirm before delete
	$('#delete').click(function(){
		event.preventDefault();// prevent  the defalut
		return Swal.fire({
			title: '!هل تريد حذف',
			text: "لن تكون قادر علي استرجاع البيانات مرة اخري",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'نعم اريد الحذف!'
		  }).then((result) => {
			
			if (result.value) {
			$('#deletefrom').unbind('submit').submit();// to resume the default
			  Swal.fire(
				'تم الحذف!',
				'تم حذف الملف',
				'success'
			  )
			}
		  });
		
	});
	$('.delete').click(function(){
		event.preventDefault();// prevent  the defalut
		return Swal.fire({
			title: '!هل تريد حذف',
			text: "لن تكون قادر علي استرجاع البيانات مرة اخري",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'نعم اريد الحذف!'
		  }).then((result) => {
			
			if (result.value) {
			$('#deletefrom').unbind('submit').submit();// to resume the default
			  Swal.fire(
				'تم الحذف!',
				'تم حذف الملف',
				'success'
			  )
			}
		  });
		
	});
	// end  confirm before delete
	// sidebar links
	// $('.side-bar-link').click(function(){
	// 	$('.side-bar-link').removeClass('active');
	// 	$(this).addClass('active');
	// })
	// sidebar links
});