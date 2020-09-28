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
	//start navigate in all inputs using enter
	$(".vertical").keypress(function(event) {
        if(event.keyCode == 13) { 
        textboxes = $("input.vertical");
        
        currentBoxNumber = textboxes.index(this);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1]
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false 
            }
        }
    });
	//end navigate in all inputs using enter
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
});