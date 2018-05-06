 
 function check_info(str, time, num){
    $('#checkup_equipment').val(str) ;
    $('#checkup_time').val(time) ;
    $('#checkup_num').val(num) ;

    return false;
 }

  function check_set(name, cost){
	var equip = $('#checkup_equipment').val() ;
    var time = $('#checkup_time').val() ;
    $('#cost_amount').val(cost) ;
    $('#checkup_item').val('CT') ;
    $('#checkup_type').val(name) ;
    if (equip=='') {
    	alert ('请设置检查设备！');
    	return false;
    }

    var html = '<tr><td>CT</td><td>'+name+'</td><td>'+equip+'</td><td>'+time+'</td><td>'+cost+'</td></tr>';   

	$("table#check_view tbody").html(html);

	return false;
 }

 function reload(){
 	document.location = "booking_checkup";
 	
 }

 function form_submit(){
    patient_form.submit();
 }