$(document).ready(function(){
	$('#change_pass').change(function(){
		if( $(this).prop('checked') ) {
		    $('input[name="pass"]').removeAttr("disabled");
		}else{
			$('input[name="pass"]').attr("disabled", "disabled");
		}
	})
})