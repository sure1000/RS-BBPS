<div id="master_alert" class="w3-modal" style="display:none;">
    <div class="w3-modal-content">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('master_alert').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2 style="text-align:center">Alert</h2>
      </header>
      <div class="w3-container" id="master_result" style="padding: 20px;text-align: center;">
       
      </div>
      <footer class="w3-container w3-teal" style="text-align: center;">
        <input type="button" value="OK" onclick="document.getElementById('master_alert').style.display='none'" style="color: #f1f1f1;background: #dd5555;padding: 5px 50px;border: 0px;">
      </footer>
    </div>
  </div>
  
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script src="include/asstes/scripts.js"></script>
<script src="include/asstes/datepicker.js"></script>
<script>
<?php if($page =='forget'){ ?>
$('#login_forget').on('click',function(){
    $(".main_conatiner").addClass("fixed_active");
    $(".main_wrapper").addClass("loader_active");
	$('#master_alert').hide();
	var number = $('#number').val();
	if(number=='' || number.length<=9)
	{
		$('#master_alert').show();
		$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter valid number</p>');
	} else {
		$.ajax({
        url: "script/forget.php",
        type: "post",
        data: {mobile:number,login:1},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			 if(1) 
			 {
				$('#master_alert').show();
				$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">'+result.error_msg+'</p>');
			 }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
		});
	}	
});


<?php } else if($page =='home'){ ?>
(function home(){
$(".main_conatiner").addClass("fixed_active");
		$(".main_wrapper").addClass("loader_active");
  $.ajax({
        url: "script/home.php",
        type: "post",
        data: {1:1},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			 if(1) 
			 {
				$('#amount_balance').html('र '+result.amount_balance);
				$('#user_type').html(result.user_type);
				$('#name1,#name2').html(result.company_name);
			 }
           
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}()); 
<?php }else if($page == 'prepaid'){ ?>
(function prepaid(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");

  $.ajax({
        url: "script/get_provider.php",
        type: "post",
        data: {recharge_service:1},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='';
			result.providers.map((value,index) => (
			html+='<option value="'+value.provider_id+'">'+value.name+'</option>'
           ));
		   $('#opertor').append(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

 $.ajax({
        url: "script/get_circle.php",
        type: "post",
        data: {1:1},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='';
			result.circle_name.map((value,index) => (
			html+='<option value="'+value.circle_name+'">'+value.circle_name+'</option>'
           ));
		   $('#circle').append(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	
}()); 
$(document).on('keypress','#number',function(e){
if($(e.target).prop('value').length>=10){
if(e.keyCode!=32)
{return false} 
}})

$('#number').on('keyup',function(){
	var mobile = $(this).val();
	if(mobile.length==10){
	    $(".main_conatiner").addClass("fixed_active");
		$(".main_wrapper").addClass("loader_active");
		$.ajax({
        url: "script/mobile_number.php",
        type: "post",
        data: {mobile:mobile},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			$('#opertor').val(result.provider_id);
			$('#circle').val(result.circle);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	}
});

$('#roffer').click(function(){
	var number = $('#number').val();
	var opertor = $('#opertor').val();
	if(number!='' && opertor!='')
	{	
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
	$.ajax({
        url: "script/roffers.php",
        type: "post",
        data: {mobile:number,provider:opertor},
        success: function (response) {
			$(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			$('#roffer_result').html(result.plans);
			$('#roffer_div').show();
			
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	}
	
});	

$('#roffer_div').on('click','.offer_amount',function(){
	let amt = $(this).data('amount');
	$('#amount').val(amt);
	$('#roffer_div').hide();
});	
$('#plan_div').on('click','.offer_amount',function(){
	let amt = $(this).data('amount');
	$('#amount').val(amt);
	$('#plan_div').hide();
});	
$('#plan').click(function(){
	var opertor = $('#opertor option:selected').text();
	var circle = $('#circle').val();
	if(number!='' && circle!='')
	{	
	$(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
	$('#plan_div').hide();
	$.ajax({
        url: "script/plans_mobile.php",
        type: "post",
        data: {opertor:opertor,circle:circle},
        success: function (response) {
			$(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			if(result.error==0)
			{
			$('#plan_result').html(result.plans);
			$('#plan_div').show();
			} else{
				$('#master_alert').show();
				$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Something went wrong</p>');
			}
			
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	} else 
		$('#master_alert').show();
		$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please select operator and circle</p>');
		//alert('Please select operator and circle');
	
});	
$('#input_submit').click(function(){
	
		var amount = $('#amount').val();
		var opertor = $('#opertor').val();
		var circle = $('#circle').val();
		var number = $('#number').val();
		var pin = $('#pin').val();
		console.log(amount,number);
		
		if(amount=='' || number=='' || pin=='')
		{
			$('#master_alert').show();
		    $('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please fiil the Mobile Number,Amount and Pin</p>');
			//alert("Please fiil the Mobile Number,Amount and Pin");
		}
		else if(Number(amount)<5 || Number(amount)>3000)
		{
		$('#master_alert').show();
		    $('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter valid amount</p>');
				
			//alert("Please enter valid amount");
		}
		else{	
		var status ='',colur='';
		$(".main_conatiner").addClass("fixed_active");
		$(".main_wrapper").addClass("loader_active");
		$.ajax({
        url: "script/recharge.php",
        type: "post",
        data: {amount:amount,opertor:opertor,circle:circle,number:number,service:'Prepaid',pin:pin},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
             if(result.error==0) 
			 {
				 $('#prepaid')[0].reset();
				 //alert('Recharge submit successfully');
				 //location.href="home";
				 status = result.status;
				var opid_id = result.opid_id;
				var tnx_id = result.tnx_id;
				
			 $('#res_status').html(status);
			 $('#res_amount').html(amount);
			 $('#res_opid').html(opid_id);
			 $('#res_trid').html(tnx_id);
			 $('.msg1').show();
			 $('.msg2').hide();
			 }else
			 {
				 status ='Failed';
				//$('#win_footer').html(' The Recharge has failed. And no amount has been charged.');	
				//$('#master_alert').show(); 			$('#master_result').html('<p>'+result.error_msg+'</p>');
				$('.msg1').hide();
				$('#res_msg').html(result.error_msg);
			 }
			 if(status == 'Failed')
				 colur ='Red';
			 else if(status == 'Pending')
				 colur ='Yellow';
			 else if(status == 'Success')
				 colur ='#009688';
			 $('.w3-teal').css({ backgroundColor: colur });
			 $('#id01').show();

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
		}
});
<?php }else if($page == 'pin'){ ?>
$('#submit').click(function(){
    $(".main_conatiner").addClass("fixed_active");
    $(".main_wrapper").addClass("loader_active");
    var oldp = $('#oldp').val();	
    var oldn = $('#oldn').val();	
    var oldc = $('#oldc').val();	
    $.ajax({        url: "script/change_pin.php",     
    type: "post",      
    data: {oldp:oldp,oldn:oldn,oldc:oldc},    
    success: function (response) {          
   $(".main_conatiner").removeClass("fixed_active");	
   $(".main_wrapper").removeClass("loader_active");     
   var result = jQuery.parseJSON(response);         
   if(result.error==0) 			 {		
       location.href="home";		
       }else $('#master_alert').show(); 			
	         $('#master_result').html('<p>'+result.error_msg+'</p>');          
       },     
       error: function (jqXHR, textStatus, errorThrown) {    
           console.log(textStatus, errorThrown);     
           }  
           });
});
<?php }else if($page == 'password'){ ?>
$('#c_submit').click(function(){
    $(".main_conatiner").addClass("fixed_active");	
    $(".main_wrapper").addClass("loader_active");	
    var oldp = $('#oldp').val();	
    var oldn = $('#oldn').val();	
    var oldc = $('#oldc').val();	
    $.ajax({        url: "script/change_password.php",  
    type: "post",    
    data: {oldp:oldp,oldn:oldn,oldc:oldc},    
    success: function (response) {       
        $(".main_conatiner").removeClass("fixed_active");	
        $(".main_wrapper").removeClass("loader_active");     
        var result = jQuery.parseJSON(response);       
        if(result.error==0) 	
        {			
            location.href="home";		
            }else $('#master_alert').show(); 			$('#master_result').html('<p>'+result.error_msg+'</p>');        
            },  
            error: function (jqXHR, textStatus, errorThrown) {     
                console.log(textStatus, errorThrown);    
                }  
                });
    
});
<?php }else if($page == 'dth'){ ?>
(function dth(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
  $.ajax({
        url: "script/get_provider.php",
        type: "post",
        data: {recharge_service:4},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='';
			result.providers.map((value,index) => (
			html+='<option value="'+value.provider_id+'">'+value.name+'</option>'
           ));
		   $('#opertor').append(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}()); 

$('#number').on('keyup',function(){
	var v=$(this).val();
	if(v.length>8)
	{
		$.ajax({
        url: "script/dth_operator.php",
        type: "post",
        data: {number:v},
        success: function (response) {
            //$(".main_conatiner").removeClass("fixed_active");
			//$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			if(result.error==0)
			{
				$('#opertor').val(result.data);

			}else{

			}
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	}
});
$('#dth_info').click(function(){
	var mobile = $('#number').val();
	var provider = $('#opertor').val();
	if(mobile!='' && opertor!='')
	{
		$(".main_conatiner").addClass("fixed_active");
		$(".main_wrapper").addClass("loader_active");
		
	  $.ajax({
        url: "script/dth_info.php",
        type: "post",
        data: {mobile:mobile,provider:provider},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			//let error = result.data.error;
			if(result.error==0)
			{
				$('#dth_status').text(result.data.status);
				$('#dth_cust').text(result.data.customerName);
				$('#res_montly').text(result.data.MonthlyRecharge);
				$('#dth_balance').text(result.data.Balance);
				$('#dth_next').text(result.data.NextRechargeDate);
				$('#dth_last_amt').text(result.data.lastrechargeamount);
				$('#dth_last_date').text(result.data.lastrechargedate);
				$('#dth_planname').text(result.data.planname);
				$('#dth_error').hide();
				$('#dth_active').show();
				$('#dth_div').show();
			}else{
				$('#dth_active').hide();
				$('#dth_error').show();
				$('#dth_div').show();
			}
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	}
});	

$('#plan_div').on('click','.offer_amount',function(){
	let amt = $(this).data('amount');
	$('#amount').val(amt);
	$('#plan_div').hide();
});	
$('#plan').click(function(){
	var opertor = $('#opertor').val();
	var circle ='';
	if(number!='')
	{	
	$(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
	$('#plan_div').hide();
	$.ajax({
        url: "script/plans_dth.php",
        type: "post",
        data: {opertor:opertor,circle:circle},
        success: function (response) {
			$(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			if(result.error==0)
			{
			$('#plan_result').html(result.plans);
			$('#plan_div').show();
			} else{
				$('#master_alert').show();
				$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Something went wrong</p>');
			}
			
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	} else
		$('#master_alert').show();
$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please select operator and circle</p>');
		//alert('Please select operator and circle');
	
});	

$('#input_submit').click(function(){
		var amount = $('#amount').val();
		var opertor = $('#opertor').val();
		var number = $('#number').val();
		var pin = $('#pin').val();
		console.log(amount,number);
		
		if(amount=='' || number=='' || pin=='')
		{
				$('#master_alert').show();
$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please fiil the Mobile Number,Amount and Pin</p>');
			//alert("Please fiil the Mobile Number,Amount and Pin");
		}
		else if(Number(amount)<5 || Number(amount)>3000)
		{
			$('#master_alert').show();
$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter valid amount</p>');
			//alert("Please enter valid amount");
		}
		else{	
		var status ='',colur='';
		$(".main_conatiner").addClass("fixed_active");
		$(".main_wrapper").addClass("loader_active");
		$.ajax({
        url: "script/recharge.php",
        type: "post",
        data: {amount:amount,opertor:opertor,number:number,service:'DTH',pin:pin},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
             if(result.error==0) 
			 {
				 $('#prepaid')[0].reset();
				 //alert('Recharge submit successfully');
				 //location.href="home";
				 status = result.status;
				var opid_id = result.opid_id;
				var tnx_id = result.tnx_id;
				
			 $('#res_status').html(status);
			 $('#res_amount').html(amount);
			 $('#res_opid').html(opid_id);
			 $('#res_trid').html(tnx_id);
			 $('.msg1').show();
			 $('.msg2').hide();
			 }else
			 {
				 status ='Failed';
				//$('#win_footer').html(' The Recharge has failed. And no amount has been charged.');	
				//$('#master_alert').show(); 			$('#master_result').html('<p>'+result.error_msg+'</p>');
				$('.msg1').hide();
				$('#res_msg').html(result.error_msg);
			 }
			 if(status == 'Failed')
				 colur ='Red';
			 else if(status == 'Pending')
				 colur ='Yellow';
			 else if(status == 'Success')
				 colur ='#009688';
			 $('.w3-teal').css({ backgroundColor: colur });
			 $('#id01').show();

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
		}
});
<?php }else if($page == 'comm_display'){ ?>
(function commission(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");

  $.ajax({
        url: "script/get_commission.php",
        type: "post",
        data: {recharge_service:3},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='';
			var pert ='',color='';
			jQuery.each(result.slab ,function(j,value){
			if(value.type === 'Commission Percentage' || value.type === 'Surcharge Percentage') pert ='%'; else pert='';			
			if(value.type === 'Surcharge Flat' || value.type === 'Surcharge Percentage') color ='red'; 
			else if(value.type === 'Commission Percentage' || value.type === 'Commission Flat') color ='green';
			else color='black';			
			$('#results').append('<div class="history_item"><div class="hi_left"><div class="hi_info"><div class="info"><p class="head">'+value.provider_name+'('+value.service+')</p><p class="head_name">'+value.type+'</p></div></div></div><div class="hi_right"><div class="money"><p style="color:'+color+'">'+value.commission_amount+pert+'</p></div></div></div>')
			});
		  // $('#results').html(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}()); 
<?php }else if($page == 't_history'){ ?>
var search = (function history(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
$('#results').html(' ');
let service = $('#service').val();
let provider = $('#provider').val();
let status = $('#status').val();
let trtype = $('#trtype').val();
let date_from = $('#date_from').val();
let date_to = $('#date_to').val();
let mobile = $('#mobile').val();
  $.ajax({
        url: "script/recharge_history_list_all.php",
        type: "post",
        data: {service:service,provider_id:provider,status:status,transaction_type:trtype,date_from:date_from,date_to:date_to,mobile:mobile},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='',type='',mobile='',dt,amt=0,st='',btn='',margin,bt='';
			
			jQuery.each(result.all_history ,function(j,value){
				bt='';
				type = value.transaction_type;
				mobile = value.mobile_number;
				dt = value.transaction_date;
				amt = value.total_amount;
				st = value.status;
			    margin =value.margin;
				if(margin<0) margin = "<span style='color:red'>"+margin+"</span>";
				if(st === 'Failed') btn ='failure';
				else if(st === 'Success'){ 
					btn ='success';
					bt='<br> <a target="_blank" href="print.php?ref_number='+value.ref_number+'" class="btn btn-pending" style="background: #6c32f9;font-size: 18px;">Print</a>';
					bt+='<br> <br><br><a class="btn btn-pending" id="dispute_'+value.ref_number+'" onclick="dispute_recharge('+value.ref_number+')" style="background: #6c32f9;font-size: 18px;">Dispute</a>';
				}
				else if(st === 'Pending') btn ='pending';
				else if(st === 'Refund') btn ='failure';
				
				html ='<div class="history_item"><div class="hi_left"><div class="hi_info">'
				+'<div class="icon_holder_new" style="width: 85px;">'
				+'<img style="width: 80px;" src="https://'+value.provider_image+'"></div>'
				+'<div class="info"><P class="head">'+type+' ('+value.provider_type+')</P>'
				+'<p class="head_name">'
				+'<p style="font-weight: bold;font-size: 20px;">'+value.mobile_number+'</p>'
				/*+'<p style="font-weight: bold;"> Service: '+value.provider_type+'</p>'
				+'<p style="font-weight: bold;"> Provider: '+value.provider_name+'</p>'*/
				+'<p style="font-weight: bold;"> Source: '+value.recharge_path+'</p>'
				+'<p style="font-weight: bold;"> Ref No: '+value.ref_number+'</p>'
				+'<span style="font-weight: bold;">TXN ID: '+value.opid+'</span><br>'
				+'<span style="font-weight: bold;">Debit: र '+value.amount+'</span><br>'
				+'<span style="font-weight: bold;">Comm: '+margin+'</span><br>'
				+'<span style="font-weight: bold;">Balance: र '+value.user_new_balance+'</span>'
				+'</p></div></div>'
				+'<div style="font-weight: bold;" class="hi_date"><p>'+dt+'</p>	</div></div>'
				+'<div class="hi_right"><div class="money"><p style="font-size: 20px;">र '+amt+'</p>	</div>'
				+'<div class="btn btn_'+btn+'"><p>'+st+'</p></div>'
				+'<div><p>'+bt+'</p></div>'
				+'</div></div>';		
			$('#results').append(html);
			});
		  // $('#results').html(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	return history;
}()); 
	
	$('#input_submit').on('click',function(){
		search();
	});	
	//get provider list	
	$('#service').on('change',function(){
	 $.ajax({
        url: "script/get_provider.php",
        type: "post",
        data: {recharge_service:$(this).val()},
        success: function (response) {
            var result = jQuery.parseJSON(response);
			var html='';
			$('#provider').text('<option value="0">Select Provider</option>');
			result.providers.map((value,index) => (
			html+='<option value="'+value.provider_id+'">'+value.name+'</option>'
           ));
		   $('#provider').append(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
    });
	

<?php }else if($page == 'ledger_reports'){ ?>
var search = (function history(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
$('#results').html(' ');
let date_from = $('#date_from').val();
let date_to = $('#date_to').val();
let mobile = $('#mobile').val();
  $.ajax({
        url: "script/ledger_reports.php",
        type: "post",
        data: {date_from:date_from,date_to:date_to,mobile:mobile},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='',type='',mobile='',dt,amt=0,st='',btn='',margin,bt='';
			
			jQuery.each(result.Ledger_report ,function(j,value){
				bt='';
				type = value.transaction_type;
				mobile = value.transaction_detail;
				dt = value.transaction_date;
				amt = value.actual_amount;
				st = value.status;
			    margin =value.margin;
				
				
				html ='<div class="history_item"><div class="hi_left"><div class="hi_info">'
				+'<div class="icon_holder_new" style="width: 85px;">'
				+'<div class="icon_holder"><span class="material-icons">account_balance</span></div></div>'
				
				+'<div class="info"><P class="head">'+type+'</P>'
				+'<p class="head_name">'
				+'<p style="font-weight: bold;"> Ref: '+value.ref_numer+'</p>'
				+'<p style="font-weight: bold;"> Credit: '+value.credit_amount+'</p>'
				+'<p style="font-weight: bold;"> Debit: '+value.debit_amount+'</p>'
				+'<span style="font-weight: bold;">Balance: र '+value.user_new_balance+'</span><br>'
				+'<span style="font-weight: bold;">Date: '+value.transaction_date+'</span>'
				+'</p></div></div>'
				+'</div></div>';		
			$('#results').append(html);
			});
		  // $('#results').html(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	return history;
}());
$('#input_submit').on('click', function(){
	search();
});

<?php } elseif($w_history){ ?>
var search = (function whistory(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
$('#results').html('');
let trtype = $('#trtype').val();
let date_from = $('#date_from').val();
let date_to = $('#date_to').val();
let mobile = $('#mobile').val();
  $.ajax({
        url: "script/wallet_history.php",
        type: "post",
        data: {transaction_type:trtype,date_from:date_from,date_to:date_to,mobile:mobile},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='',type='',mobile='',dt,amt=0,st='',btn='',margin,bt='';
		
			jQuery.each(result.all_transactions ,function(j,value){
			    st = value.payment_mode;
			     if(st === 'Credit'){ 
					btn ='success';
				}
			
				else if(st === 'Debit') btn ='failure';
				html ='<div class="history_item"><div class="hi_left"><div class="hi_info">'
				+'<div class="icon_holder"><span class="material-icons">account_balance</span></div>'
				+'<div class="info"><P class="head">'+type+'</P>'
				+'<p class="head_name">'
				+'<p style="font-weight: bold;"> Order No: '+value.ref_number+'</p>'
				+'<p style="font-weight: bold;"> By: '+value.by+'</p>'
				+'<span style="font-weight: bold;">Old Balance: र '+value.user_old_balance+'</span><br>'
				+'<span style="font-weight: bold;">New Balance: र '+value.user_new_balance+'</span>'
				+'</p></div></div>'
				+'<div style="font-weight: bold;" class="hi_date"><p>'+value.transaction_date+'</p>	</div></div>'
				+'<div class="hi_right"><div class="money"><p>र '+value.amount+'</p>	</div>'
				+'<div class="btn btn_'+btn+'"><p>'+st+'</p></div>'
				+'<div><p>'+bt+'</p></div>'
				+'</div></div>';		
			$('#results').append(html);
			});
		  // $('#results').html(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	return whistory;
}()); 
	
	$('#input_submit').on('click',function(){
		search();
	});	
	//get provider list	
	$('#service').on('change',function(){
	 $.ajax({
        url: "script/get_provider.php",
        type: "post",
        data: {recharge_service:$(this).val()},
        success: function (response) {
            var result = jQuery.parseJSON(response);
			var html='';
			$('#provider').text('<option value="0">Select Provider</option>');
			result.providers.map((value,index) => (
			html+='<option value="'+value.provider_id+'">'+value.name+'</option>'
           ));
		   $('#provider').append(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
    });
	
<?php }else if($page == 'w_history2'){ ?>
var searchWallet = (function searchWallet(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
$('#results').html('');
let trtype = $('#trtype').val();
let date_from = $('#date_from').val();
let date_to = $('#date_to').val();
let mobile = $('#mobile').val();
  $.ajax({
        url: "script/wallet_history.php",
        type: "post",
        data: {transaction_type:trtype,date_from:date_from,date_to:date_to,mobile:mobile},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='',type='',mobile='',dt,amt=0,st='',btn='',margin,bt='';
		
			jQuery.each(result.all_transactions ,function(j,value){
			    st = value.payment_mode;
			    if(st === 'Credit'){ 
					btn ='success';
				}
				else if(st === 'Debit') btn ='failure';
				html ='<div class="history_item"><div class="hi_left"><div class="hi_info">'
				+'<div class="icon_holder"><span class="material-icons">account_balance</span></div>'
				+'<div class="info"><P class="head">'+value.transaction_type+'</P>'
				+'<p class="head_name">'
				+'<p style="font-weight: bold;"> Order No: '+value.ref_number+'</p>'
				+'<p style="font-weight: bold;"> By: '+value.by+'</p>'
				+'<span style="font-weight: bold;">Old Balance: र '+value.user_old_balance+'</span><br>'
				+'<span style="font-weight: bold;">New Balance: र '+value.user_new_balance+'</span>'
				+'</p></div></div>'
				+'<div style="font-weight: bold;" class="hi_date"><p>'+value.transaction_date+'</p>	</div></div>'
				+'<div class="hi_right"><div class="money"><p>र '+value.amount+'</p>	</div>'
				+'<div class="btn btn_'+btn+'"><p>'+st+'</p></div>'
				+'<div><p>'+bt+'</p></div>'
				+'</div></div>';		
			$('#results').append(html);
			});
		  // $('#results').html(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	return searchWallet;
}()); 
	
	$('#input_submit').on('click',function(){
		searchWallet();
	});	
<?php }else if($page == 'r_money'){ ?>	
var requestMoney = (function requestMoney(){
$('#results').html('');
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
  $.ajax({
        url: "script/report_request_money.php",
        type: "post",
        data: {1:1},
        success: function (response) {
			$(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='',type='',mobile='',dt,amt=0,st='',btn='',margin,bt='';

			jQuery.each(result.request_list,function(j,value){
			    st = value.status;
			     if(st === 'Transferred') btn ='success';
				else if(st === 'Rejected') btn ='failure';
				else if(st === 'Pending') btn ='pending';
				
				html ='<div class="history_item"><div class="hi_left"><div class="hi_info">'
				+'<div class="icon_holder"><span class="material-icons">account_balance</span></div>'
				+'<div class="info"><P class="head">'+value.transfer_mode+'</P>'
				+'<p class="head_name">'
				+'<p style="font-weight: bold;"> Order No: '+value.ref_number+'</p>'
				+'<p style="font-weight: bold;"> By: '+value.transaction_number+'</p>'
				+'<span style="font-weight: bold;">Decision: '+value.decision+'</span><br>'
				//+'<span style="font-weight: bold;">New Balance: र '+value.user_new_balance+'</span>'
				+'</p></div></div>'
				+'<div style="font-weight: bold;" class="hi_date"><p>'+value.request_date+'</p>	</div></div>'
				+'<div class="hi_right"><div class="money"><p>र '+value.amount+'</p>	</div>'
				+'<div class="btn btn_'+btn+'"><p>'+st+'</p></div>'
				//+'<div><p>'+value.decision+'</p></div>'
				+'</div></div>';		
			$('#results').append(html);
			});
		  // $('#results').html(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	return requestMoney;
}()); 

$('#payment_mode').on('change',function(){
	 $.ajax({
        url: "script/get_banklist.php",
        type: "post",
        data: {payment_mode:$(this).val()},
        success: function (response) {
            var result = jQuery.parseJSON(response);
			var html='';
			$('#bank_list').text('<option value="">Select Bank</option>');
			result.bank_details.map((value,index) => (
			html+='<option value="'+value.account_no+'">'+value.account_no+'</option>'
           ));
		   $('#bank_list').append(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
    });
	$('#submit').on('click',function(){
		 var user = $('#request_user').val();
		 var payment_mode = $('#payment_mode').val();
		var bank_list = $('#bank_list').val();
		 var request_money = $('#request_money').val();
		 var transaction_number = $('#transaction_number').val();
		if(!user)
		{
			$('#master_alert').show();
$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please select user</p>');
			//alert("Please select user");
		}
		else if(!payment_mode)
		{
			$('#master_alert').show();
$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please select payment mode</p>');
			//alert("Please select payment mode");
		}	
		else if(!bank_list)
		{
			$('#master_alert').show();
$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please select bank account number</p>');
			//alert("Please select bank account number");
		}
		else if(!request_money)
		{
			$('#master_alert').show();
$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter remark</p>');
			//alert("Please enter request amount");
		}else if(!transaction_number)
		{
			$('#master_alert').show();
$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter remark</p>');
			//alert("Please enter remark");
		}		
		 else
		 {
		 $.ajax({
        url: "script/request_money.php",
        type: "post",
        data: $('#prepaid').serialize(),
        success: function (response) {
            var result = jQuery.parseJSON(response);
			$('#master_alert').show(); 			$('#master_result').html('<p>'+result.error_msg+'</p>');
			location.href ='/apis/app/home';
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
		 }
	});
	
<?php }else if($page == 'profile'){ ?>	
var profile = (function profileUser(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
  $.ajax({
        url: "script/get_profile.php",
        type: "post",
        data: {1:1},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			result = result.user;
			$('#name').val(result.name);
			$('#mobile').val(result.mobile);
			$('#email').val(result.email);
			$('#user_address').val(result.user_address);
			
			$('#company_name').val(result.company_name);
			$('#gst_no').val(result.gst_no);
			$('#pancard').val(result.pancard);
			$('#adhaar_card').val(result.adhaar_card);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	return profileUser;
}()); 
$('#Update').click(function(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
	$.ajax({
        url: "script/set_profile.php",
        type: "post",
        data: $('#loginform').serialize(),
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			$('#master_alert').show();
			$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">'+result.error_msg+'</p>');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});
<?php }else if($page == 'support'){ ?>
var support = (function supportDetails(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
  $.ajax({
        url: "script/get_banklist.php",
        type: "post",
        data: {payment_mode:''},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='';
			result.bank_details.map((value,index) => (
			html+='<hr><div class="hi_info"><div class="icon_holder">'
			+'<span class="material-icons">support</span></div>'
			+'<div class="info"><P class="head">'
			+'Account No: '+value.account_no+'</P>'
			+'<P class="head">Account Holder Name: '+value.account_holder_name+'</P>'
			+'<P class="head">IFSC Code: '+value.ifsc_code+'</P>'
			+'</div></div>'
           ));
		   $('#results').append(html);
			
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	return supportDetails;
}()); 
<?php } else if($page == 'my_team'){ ?>
var myteamList = (function myTeam(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
  $.ajax({
        url: "script/get_user_list.php",
        type: "post",
        data: {payment_mode:''},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			var html='';
			result.user_list.map((value,index) => (
			html+='<div class="history_item"><div class="hi_info"><div class="icon_holder">'
			+'<span class="material-icons">account_circle</span></div>'
			+'<div class="info">'
			+'<P class="head">Name : '+value.name+'</P>'
			//+'<P class="head">User Name : '+value.user_name+'</P>'
			+'<P class="head">Mobile : '+value.mobile+'</P>'
			+'<P class="head">Company : '+value.company_name+'</P>'
			//+'<P class="head">District : '+value.District+'</P>'
			//+'<P class="head">State : '+value.State+'</P>'
			+'<P class="head">Balance : '+value.current_balance+'</P>'
			+'</div></div></div>'
           ));
		 
		   $('#results').append(html);
			
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	return myTeam;
}()); 
<?php } else if($page == 'fund'){ ?>
var myUserList = (function myUser(){
$(".main_conatiner").addClass("fixed_active");
$(".main_wrapper").addClass("loader_active");
   $.ajax({
        url: "script/get_user_list.php",
        type: "post",
        data: {1:1},
        success: function (response) {
			 $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
			
            var result = jQuery.parseJSON(response);
			var html='';
			result.user_list.map((value,index) => (
			html+='<option value="'+value.user_id+'">'+value.name+'('+value.current_balance+')</option>'
           ));
		   $('#user_list').append('<option value="">Select User</option>'+html);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	return myUser;
}());
$('#input_submit').click(function(){
		
		var user = $('#user_list').val();
		 var amount = $('#amount').val();
		 console.log(amount);
		var pin = $('#pin').val();
		if(!user)
		{
			$('#master_alert').show();
			$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please select user</p>');
			//alert("Please select user");
		}
		else if(amount== '' || parseFloat(amount)<=0)
		{
			$('#master_alert').show();
			$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter amount</p>');
			//alert("Please enter amount");
		}	
		else if(!pin)
		{
            $('#master_alert').show();
			$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter Pin</p>');			
			//alert("Please enter Pin");
		}else
		 {
			 $(".main_conatiner").addClass("fixed_active");
		$(".main_wrapper").addClass("loader_active");
			$.ajax({
				url: "script/send_money.php",
				type: "post",
				data: {pin:pin,amount:amount,user:user},
				success: function (response) {
					$(".main_conatiner").removeClass("fixed_active");
					$(".main_wrapper").removeClass("loader_active");
					var result = jQuery.parseJSON(response);
					$('#master_alert').show();
					$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">'+result.error_msg+'</p>');
					if(result.error==1) location.href="home";
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		 }
});
<?php } else if($page == 'add_member'){ ?>
	$('#Update').click(function(){
		$('#master_alert').hide();
		var name = $('#name').val();
		var mobile = $('#mobile').val();
		var email = $('#email').val();
		
	if(name == '')
	{
		$('#master_alert').show();
		$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter name</p>');
	} else if(mobile == '')
	{
		$('#master_alert').show();
		$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter mobile no</p>');
	}
	 else if(email == '')
	{
		$('#master_alert').show();
		$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">Please enter email id</p>');
	} else {
		$(".main_conatiner").addClass("fixed_active");
		$(".main_wrapper").addClass("loader_active");
	$.ajax({
        url: "script/add_member.php",
        type: "post",
        data: $('#loginform').serialize(),
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
			$('#master_alert').show();
			$('#master_result').html('<p style="margin-top: 20px;margin-bottom: 20px;text-align: center;">'+result.error_msg+'</p>');
			
			if(result.error == 0){
				$('#loginform')[0].reset();
				location.href="home";
			}
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	}
});
	
<?php } ?>
    $(document).ready(function(){
		$('[type=text]').attr('autocomplete', 'off');  	
		
		$('#login').on('click',function(){ 
		$(".main_conatiner").addClass("fixed_active");
		$(".main_wrapper").addClass("loader_active");
		var password = $('#password').val();
		var username = $('#username').val();
		var rem_me = $('#rem_me:checked').val();
		$.ajax({
        url: "script/login.php",
        type: "post",
        data: {username:username,password:password,rem_me:rem_me,login:1},
        success: function (response) {
            $(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
            var result = jQuery.parseJSON(response);
             if(result.error==0) 
			 {
				 location.href="home";
			 }else { $('#master_alert').show(); 			$('#master_result').html('<p>'+result.error_msg+'</p>');}
           
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	});
	
      $('.slider').bxSlider({
      	auto: true
      });
    });
  </script>
  	<script>
$('#r1').click(function () {
    $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'prepaid';
});
$('#r2').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'dth';
});
$('#r3').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'comming';
});
$('#r4').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'comming';
});
$('#r5').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'comming';
});
$('#r6').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'comming';
});
$('#r7').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'request_money';
});
$('#r8').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'wallet_history';
});
$('#r9').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'support_bank';
});
$('#r10').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'change_pin';
});
$('#r11').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'change_password';
});
$('#r12').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'logout';
});
$('#rs1').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'prepaid';
});
$('#rs2').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'dth';
});
$('#rs3').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'comming';
});
$('#rs4').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'comming';
});
$('#d1').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'add_member';
});
$('#d2').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'my_team';
});
$('#d3').click(function () {
     $(".main_conatiner").addClass("fixed_active");
	$(".main_wrapper").addClass("loader_active");
    window.location = 'fund_transfer';
});
</script>
<link rel="stylesheet" href="include/asstes/datepicker.css">
<link rel="stylesheet" href="include/asstes/w3.css">
</body>
</html>