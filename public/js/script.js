

//Funkcija za onemogućavanje klika na ostale checkbox-ove
// prilikom klika na With Category ili Without Category

function disableOthers($item){

	var $checkboxes = $('.category-checkbox'); 
	if($($item).is(':checked')){  // <-- check if clicked box is currently checked
	   $checkboxes.not($item).prop('checked', false);
	   $checkboxes.not($item).prop('disabled',true); // <-- disable all but checked checkbox
	}else{  //<-- if checkbox was unchecked
	   $checkboxes.prop('disabled',false); // <-- enable all checkboxes
	}
}


