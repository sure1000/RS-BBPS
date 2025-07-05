//l = (v, v1 = "") => console.log(v, v1);
$('#loading').show();
sucMsg = (v) => {
    $("#master_alert").show();
    $("#alert_text").text(v);
};
errMsg = (v) => {
    $("#master_alert").show();
    $("#alert_text").text(v);
};
const URL = "https://partner.abhipay.in/";
const APP_NAME = "ABHI PAY";
dateFormat = (v, chk = 0) => {
    if (v) {
        if (chk == 0) var today = new Date(v);
        else var today = v;
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = "0" + dd;
        }
        if (mm < 10) {
            mm = "0" + mm;
        }
        if (chk == 1) return yyyy + "-" + mm + "-" + dd;
        else return mm + "/" + dd + "/" + yyyy;
    }
};
function dispute_id(id) {
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	var remark = prompt("Dispute Reasion");
	 var r = confirm("Are you sure ?");
	  if (r == true) {
		$('#loading').show();
	    $.ajax({
            url: URL + "android_apis/dispute_recharge.php",
			type: "post",
			data: {dispute_updte:1,ref_number:id,remark:remark,username:username,password:password},
					success: function(response) {
						$('#loading').hide();
					console.log(response);	
					 alert(response.error_msg);
			},
		});
	  } else {
		alert("Dispute Cancel");
	  }
	
		
	};

if (PAGE == "HOME") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	var role = localStorage.getItem("role");
	if(role=="Retailer"){
		$("#rb").show();
		$("#bank").show();
	}else{
		$("#userm").show();
	}
	///balance
	    $.ajax({
            url: URL + "android_apis/user_info.php",
			type: "post",
			data: {username:username,password:password},
					success: function(response) {
					console.log(response);
					var result = response;
					balance = "Balance : " + result.amount_balance;
					$('#balance').text(balance);
					$('#news').text(result.welcome);
					
			},
	});
	///get_benner_list
	    $.ajax({
            url: URL + "android_apis/get_benner_list.php",
			type: "post",
			data: {username:username,password:password},
					success: function(response) {
					console.log(response);
					var result = JSON.parse(JSON.stringify(response));
					jQuery.each(result.banner_pic, function (j, v) {
					html ='<img  class="mySlides" src="'+v.banner_pic+'" style="width:100%">'
							$('#banner').append(html);
					});
					carousel();
					//balance = "Balance : " + result.amount_balance;
					//$('#balance').text(balance);
					//$('#news').text(result.welcome);
					
			},
	});
	var myIndex = 0;
function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000); // Change image every 2 seconds
}
	//logout
	$("#logout").on("click", function () {
		var r = confirm("Are you sure you want Logout");
		if (r == true) {
		  localStorage.clear();
		  location.href = "login.html";
		}
		
	});

} else if (PAGE == "MOBILE_RECHARGE") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
$("#aeps_back").on("click", function () {
	$('#mobile_recharge_form').show();
	$('#mobile_result').hide();
});	
$('#aeps_back_home').click(function(){
	location.href = "home.html";
});
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
///Get Mobile Operator
	    $.ajax({
            url: URL + "android_apis/get_provider.php",
			type: "post",
			data: {recharge_service:1,username:username,password:password},
					success: function(result) {
					console.log(result);	
					var result = JSON.parse(JSON.stringify(result));
					var opt = "";
					jQuery.each(result.providers, function (j, v) {
						opt += '<option value="' + v.provider_id +'">' + v.name + "</option>";
					});
					$("#provider").append(opt);
					
			},
	});
	$.ajax({
            url: URL + "android_apis/get_circle.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
						$('#loading').hide();
					console.log(result);	
					var result = JSON.parse(JSON.stringify(result));
					var opt = "";
					jQuery.each(result.circle_name, function (j, v) {
						opt += '<option value="' + v.circle_name +'">' + v.circle_name + "</option>";
					});
					$("#circle").append(opt);
			},
	});
	$('#number').on('keyup',function(){
	var mobile = $(this).val();
	if(mobile.length==10){
	    $('#loading').show();
		var service ="Prepaid";
		$.ajax({
        url: URL + "android_apis/mobile_number.php",
        type: "post",
        data: {mobile:mobile,service:service,username:username,password:password},
        success: function (response) {
            $('#loading').hide();
            var result = response;
			$('#provider').val(result.provider_id);
			$('#circle').val(result.circle);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	}
});

	///Get Mobile Recharge
	$("#mobile_recharge").on("click", function () {
			var provider = $("#provider").val();
            var number = $("#number").val();
			var amount = $("#amount").val();
			var circle = $("#circle").val();
			var pin = $("#pin").val();
		if(number ==''){
			alert("Please Enter Mobile Number");
		} else if(amount ==''){	
		alert("Please Enter Amount");
		} else if(pin ==''){	
		alert("Please Enter Pin");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/recharge.php",
			type: "post",
			data: {number:number,provider:provider,amount:amount,circle:circle,pin:pin,username:username,password:password},
					success: function(result) {
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
					 if(result.status=="Success"){
						 if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/green-tick.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.opid_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					 }else if(result.status=="Failed"){
						 if(result.opid_id==" "){
							result.opid_id = "Not Available";
						}
						$('#icon_status').attr('src','img/red-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.opid_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					}else if(result.status=="Pending"){
						if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/pending-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.opid_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();	
					}else{
						alert(result.status);
					}
					}else{
						alert(result.error_msg);
					}
					
			},
	});
		}
	});
	$("#roffer").on("click", function () {
		var provider = $("#provider").val();
        var number = $("#number").val();
		if(number ==''){
			alert("Please Enter Mobile Number");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/roffers.php",
			type: "post",
			data: {mobile:number,provider:provider,service:1,username:username,password:password},
					success: function(result) {
						var html="";
						$('#result').show();
						$('#plan_result_tab').hide();
						$('#plan_result').hide();
						$("#result").html("");
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
					if(result.plans.RDATA.length !=1){
					$.each(result.plans.RDATA, function(i, item){
						var html='<div class="card discount-coupon-card border-0" onclick="add_amount('+item.price+')"> ' +
						  '<div class="card-body">' +
							'<div class="coupon-text-wrap d-flex align-items-center">' +
							  '<h5 class="text-white pe-3 mb-0" >₹&nbsp;'+item.price+'</h5>' +
							  '<p class="text-white ps-3 mb-0">'+item.ofrtext+'</p>' +
							'</div>' +
						  '</div>' +
						'</div><br>';
						$('#result').append(html);
								});
						}else{
							var html='<div class="card discount-coupon-card border-0"> ' +
						  '<div class="card-body">' +
							'<div class="coupon-text-wrap d-flex align-items-center">' +
							  '<h5 class="text-white pe-3 mb-0" ></h5>' +
							  '<p class="text-white ps-3 mb-0">Plan Not Available</p>' +
							'</div>' +
						  '</div>' +
						'</div><br>';
						$('#result').append(html);
						}
					}else{
						alert(result.error_msg);
					}
					
			},
		});
		}
	});
		$("#plan_info").on("click", function () {
		var provider = $("#provider").val();
        var circle = $("#circle").val();
		if(number ==''){
			alert("Please Enter Mobile Number");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/plans_mobile.php",
			type: "post",
			data: {circle:circle,operator:provider,service:1,username:username,password:password},
					success: function(result) {
						$('#result').hide();
						$('#plan_result_tab').show();
						$('#plan_result').show();
						$("#plan_result_tab").html("");
						$("#plan_result").html("");
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
					$.each(result.plan.RDATA, function(i, item){
						var cl = i.replace(/[^A-Z]+/g,"");
						var html='<span id="'+cl+'"class="badge badge-primary">'+i+'</span>&nbsp;';
						
						$('#plan_result_tab').append(html);
					});
					$.each(result.plan.RDATA, function(i, item){
						var cl = i.replace(/[^A-Z]+/g,"");
					$.each(item, function(i, item){
						var html='<div class="card discount-coupon-card border-0 '+cl+'" id="'+cl+'" onclick="add_amount('+item.rs+')"> ' +
						  '<div class="card-body">' +
							'<div class="coupon-text-wrap d-flex align-items-center">' +
							  '<h5 class="text-white pe-3 mb-0 " >₹&nbsp;'+item.rs+'</h5>' +
							  '<p class="text-white ps-3 mb-0">'+item.desc+'</p>' +
							'</div>' +
						  '</div>' +
						'</div>';
						$('#plan_result').append(html);
						});
					});
					}else{
						alert(result.error_msg);
					}
					
			},
		});
		}
	});
	$("#plan_result_tab").on("click",'.badge-primary',function () {
		var cid = $(this).attr('id');
		$('.amountpic').hide();
		$('.card').hide();
		$('.discount-coupon-card border-0').hide();
		$('.'+cid).show();
	//alert(cid);
	});	
	function add_amount(amount){
		//alert(amount);
		document.getElementById("amount").value = amount;
	}
} else if (PAGE == "POSTPAID_RECHARGE") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
$("#aeps_back").on("click", function () {
	$('#mobile_recharge_form').show();
	$('#mobile_result').hide();
});	
$('#aeps_back_home').click(function(){
	location.href = "home.html";
});
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
///Get Mobile Operator
	    $.ajax({
            url: URL + "android_apis/get_provider.php",
			type: "post",
			data: {recharge_service:10,username:username,password:password},
					success: function(result) {
					console.log(result);	
					var result = JSON.parse(JSON.stringify(result));
					var opt = "";
					jQuery.each(result.providers, function (j, v) {
						opt += '<option value="' + v.provider_id +'">' + v.name + "</option>";
					});
					$("#provider").append(opt);
					
			},
	});
	$.ajax({
            url: URL + "android_apis/get_circle.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
						$('#loading').hide();
					console.log(result);	
					var result = JSON.parse(JSON.stringify(result));
					var opt = "";
					jQuery.each(result.circle_name, function (j, v) {
						opt += '<option value="' + v.circle_name +'">' + v.circle_name + "</option>";
					});
					$("#circle").append(opt);
			},
	});
	/*$('#number').on('keyup',function(){
	var mobile = $(this).val();
	if(mobile.length==10){
	    $('#loading').show();
		var service ="Prepaid";
		$.ajax({
        url: URL + "android_apis/mobile_number.php",
        type: "post",
        data: {mobile:mobile,service:service,username:username,password:password},
        success: function (response) {
            $('#loading').hide();
            var result = response;
			$('#provider').val(result.provider_id);
			$('#circle').val(result.circle);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
	}
});*/

	///Get Postpaid Recharge
	$("#mobile_recharge").on("click", function () {
			var provider = $("#provider").val();
            var number = $("#number").val();
			var amount = $("#amount").val();
			var circle = $("#circle").val();
			var pin = $("#pin").val();
		if(number ==''){
			alert("Please Enter Postpaid Number");
		} else if(amount ==''){	
		alert("Please Enter Amount");
		} else if(pin ==''){	
		alert("Please Enter Pin");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/recharge.php",
			type: "post",
			data: {number:number,service_id:10,provider:provider,amount:amount,circle:circle,pin:pin,username:username,password:password},
					success: function(result) {
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
					 if(result.status=="Success"){
						 if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/green-tick.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.opid_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					 }else if(result.status=="Failed"){
						 if(result.opid_id==" "){
							result.opid_id = "Not Available";
						}
						$('#icon_status').attr('src','img/red-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.opid_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					}else if(result.status=="Pending"){
						if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/pending-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.opid_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();	
					}else{
						alert(result.status);
					}
					}else{
						alert(result.error_msg);
					}
					
			},
	});
		}
	});
	$("#roffer").on("click", function () {
		var provider = $("#provider").val();
        var number = $("#number").val();
		if(number ==''){
			alert("Please Enter Mobile Number");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/roffers.php",
			type: "post",
			data: {mobile:number,provider:provider,service:1,username:username,password:password},
					success: function(result) {
						var html="";
						$('#result').show();
						$('#plan_result_tab').hide();
						$('#plan_result').hide();
						$("#result").html("");
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
					if(result.plans.RDATA.length !=1){
					$.each(result.plans.RDATA, function(i, item){
						var html='<div class="card discount-coupon-card border-0" onclick="add_amount('+item.price+')"> ' +
						  '<div class="card-body">' +
							'<div class="coupon-text-wrap d-flex align-items-center">' +
							  '<h5 class="text-white pe-3 mb-0" >₹&nbsp;'+item.price+'</h5>' +
							  '<p class="text-white ps-3 mb-0">'+item.ofrtext+'</p>' +
							'</div>' +
						  '</div>' +
						'</div><br>';
						$('#result').append(html);
								});
						}else{
							var html='<div class="card discount-coupon-card border-0"> ' +
						  '<div class="card-body">' +
							'<div class="coupon-text-wrap d-flex align-items-center">' +
							  '<h5 class="text-white pe-3 mb-0" ></h5>' +
							  '<p class="text-white ps-3 mb-0">Plan Not Available</p>' +
							'</div>' +
						  '</div>' +
						'</div><br>';
						$('#result').append(html);
						}
					}else{
						alert(result.error_msg);
					}
					
			},
		});
		}
	});
		$("#plan_info").on("click", function () {
		var provider = $("#provider").val();
        var circle = $("#circle").val();
		if(number ==''){
			alert("Please Enter Mobile Number");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/plans_mobile.php",
			type: "post",
			data: {circle:circle,operator:provider,service:1,username:username,password:password},
					success: function(result) {
						$('#result').hide();
						$('#plan_result_tab').show();
						$('#plan_result').show();
						$("#plan_result_tab").html("");
						$("#plan_result").html("");
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
					$.each(result.plan.RDATA, function(i, item){
						var cl = i.replace(/[^A-Z]+/g,"");
						var html='<span id="'+cl+'"class="badge badge-primary">'+i+'</span>&nbsp;';
						
						$('#plan_result_tab').append(html);
					});
					$.each(result.plan.RDATA, function(i, item){
						var cl = i.replace(/[^A-Z]+/g,"");
					$.each(item, function(i, item){
						var html='<div class="card discount-coupon-card border-0 '+cl+'" id="'+cl+'" onclick="add_amount('+item.rs+')"> ' +
						  '<div class="card-body">' +
							'<div class="coupon-text-wrap d-flex align-items-center">' +
							  '<h5 class="text-white pe-3 mb-0 " >₹&nbsp;'+item.rs+'</h5>' +
							  '<p class="text-white ps-3 mb-0">'+item.desc+'</p>' +
							'</div>' +
						  '</div>' +
						'</div>';
						$('#plan_result').append(html);
						});
					});
					}else{
						alert(result.error_msg);
					}
					
			},
		});
		}
	});
	$("#plan_result_tab").on("click",'.badge-primary',function () {
		var cid = $(this).attr('id');
		$('.amountpic').hide();
		$('.card').hide();
		$('.discount-coupon-card border-0').hide();
		$('.'+cid).show();
	//alert(cid);
	});	
	function add_amount(amount){
		//alert(amount);
		document.getElementById("amount").value = amount;
	}	
} else if (PAGE == "DTH_RECHARGE") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
$("#aeps_back").on("click", function () {
	$('#mobile_recharge_form').show();
	$('#mobile_result').hide();
});	
$('#aeps_back_home').click(function(){
	location.href = "home.html";
});
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
///Get Mobile Operator
	    $.ajax({
            url: URL + "android_apis/get_provider.php",
			type: "post",
			data: {recharge_service:4,username:username,password:password},
					success: function(result) {
					console.log(result);	
					var result = JSON.parse(JSON.stringify(result));
					var opt = "";
					jQuery.each(result.providers, function (j, v) {
						opt += '<option value="' + v.provider_id +'">' + v.name + "</option>";
					});
					$("#provider").append(opt);
					
			},
	});
	$.ajax({
            url: URL + "android_apis/get_circle.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
						$('#loading').hide();
					console.log(result);	
					var result = JSON.parse(JSON.stringify(result));
					var opt = "";
					jQuery.each(result.circle_name, function (j, v) {
						opt += '<option value="' + v.circle_name +'">' + v.circle_name + "</option>";
					});
					$("#circle").append(opt);
			},
	});
	
	///Get DTH Recharge
	$("#mobile_recharge").on("click", function () {
			var provider = $("#provider").val();
            var number = $("#number").val();
			var amount = $("#amount").val();
			var circle = "Odisha";//$("#circle").val();
			var pin = $("#pin").val();
		if(number ==''){
			alert("Please Enter DTH Number");
		} else if(amount ==''){	
		alert("Please Enter Amount");
		} else if(pin ==''){	
		alert("Please Enter Pin");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/recharge.php",
			type: "post",
			data: {number:number,provider:provider,amount:amount,circle:circle,pin:pin,username:username,password:password},
					success: function(result) {
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
					 if(result.status=="Success"){
						 if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/green-tick.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.opid_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					 }else if(result.status=="Failed"){
						 if(result.opid_id==" "){
							result.opid_id = "Not Available";
						}
						$('#icon_status').attr('src','img/red-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.opid_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					}else if(result.status=="Pending"){
						if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/pending-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.opid_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();	
					}else{
						alert(result.status);
					}
					}else{
						alert(result.error_msg);
					}
					
			},
	});
		}
	});
	$("#roffer").on("click", function () {
		var provider = $("#provider").val();
        var number = $("#number").val();
		if(number ==''){
			alert("Please Enter DTH Number");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/roffers.php",
			type: "post",
			data: {mobile:number,provider:provider,service:1,username:username,password:password},
					success: function(result) {
						var html="";
						$('#result').show();
						$('#plan_result_tab').hide();
						$('#plan_result').hide();
						$("#result").html("");
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
					if(result.plans.records.length !=1){
					$.each(result.plans.records, function(i, item){
						var html='<div class="card discount-coupon-card border-0" onclick="add_amount('+item.rs+')"> ' +
						  '<div class="card-body">' +
							'<div class="coupon-text-wrap d-flex align-items-center">' +
							  '<h5 class="text-white pe-3 mb-0" >₹&nbsp;'+item.rs+'</h5>' +
							  '<p class="text-white ps-3 mb-0">'+item.desc+'</p>' +
							'</div>' +
						  '</div>' +
						'</div><br>';
						$('#result').append(html);
								});
						}else{
							var html='<div class="card discount-coupon-card border-0"> ' +
						  '<div class="card-body">' +
							'<div class="coupon-text-wrap d-flex align-items-center">' +
							  '<h5 class="text-white pe-3 mb-0" ></h5>' +
							  '<p class="text-white ps-3 mb-0">Plan Not Available</p>' +
							'</div>' +
						  '</div>' +
						'</div><br>';
						$('#result').append(html);
						}
					}else{
						alert(result.error_msg);
					}
					
			},
		});
		}
	});
	
		$("#plan_info").on("click", function () {
		var provider = $("#provider").val();
        var number = $("#number").val();
		if(number ==''){
			alert("Please Enter DTH Number");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/plans_dth.php",
			type: "post",
			data: {mobile:number,operator:provider,service:1,username:username,password:password},
					success: function(result) {
						$('#result').hide();
						$('#plan_result_tab').show();
						$('#plan_result').show();
						$("#plan_result_tab").html("");
						$("#plan_result").html("");
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
					$.each(result.plan.records, function(i, item){
						var cl = i;
						var html='<span id="'+cl+'"class="badge badge-primary">'+i+'</span>&nbsp;';
						
						$('#plan_result_tab').append(html);
					});
					$.each(result.plan.records, function(i, item){
						var cl = i;
					$.each(item, function(i, item){
						var html='<div class="card discount-coupon-card border-0 '+cl+'" id="'+cl+'" onclick="add_amount('+item.rs+')"> ' +
						  '<div class="card-body">' +
							'<div class="coupon-text-wrap d-flex align-items-center">' +
							  '<h5 class="text-white pe-3 mb-0 " >'+item.rs+'</h5>' +
							  '<p class="text-white ps-3 mb-0">'+item.desc+'</p>' +
							'</div>' +
						  '</div>' +
						'</div>';
						$('#plan_result').append(html);
						});
					});
					}else{
						alert(result.error_msg);
					}
					
			},
		});
		}
	});
	
	$("#plan_result_tab").on("click",'.badge-primary',function () {
		var cid = $(this).attr('id');
		$('.amountpic').hide();
		$('.card').hide();
		$('.discount-coupon-card border-0').hide();
		$('.'+cid).show();
	//alert(cid);
	});	
	function add_amount(amount){
		//alert(amount);
		document.getElementById("amount").value = amount;
	}
$("#dth_info").on("click", function () {
	var provider = $("#provider").val();
        var number = $("#number").val();
		if(number ==''){
			alert("Please Enter DTH Number");
		}else{
			$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/dth_info.php",
			type: "post",
			data: {mobile:number,provider:provider,service:1,username:username,password:password},
					success: function(result) {
						
						console.log(result.info.DATA[0]);
					$('#loading').hide();	
					if(result.info.DATA!=""){
					//alert(result.info.records[0]['customerName']);
						var Status_dth_info = "Not Found";
					document.getElementById("Status_dth_info").text = Status_dth_info;
					document.getElementById("name_dth_info").text = result.info.DATA.Name;
					document.getElementById("balance_dth_info").text = result.info.DATA.Balance;
					document.getElementById("recharge_date_dth_info").text = result.info.DATA.NextRechargeDate;
					document.getElementById("recharge_dth_info").text = result.info.DATA.Monthly;
					document.getElementById("plan_details_dth_info").text = result.info.DATA.Plan;
					$('#dth_info_div').show();
					}else{
						alert("Somthing went wrong");
					}
					
			},
		});
		}
	});	
} else if (PAGE == "ELECTRICITY") {
	$("#aeps_back").on("click", function () {
	$('#mobile_recharge_form').show();
	$('#mobile_result').hide();
});	
$('#aeps_back_home').click(function(){
	location.href = "home.html";
});
		$("#bill_recharge").hide();
		$("#billinfo").hide();
	if ("username" in localStorage) {
		
	} else {
	location.href = "login.html";
	}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	$.ajax({
            url: URL + "android_apis/get_provider.php",
			type: "post",
			data: {recharge_service:6,username:username,password:password},
					success: function(result) {
					$('#loading').hide();
					console.log(result);	
					var result = JSON.parse(JSON.stringify(result));
					var opt = "";
					jQuery.each(result.providers, function (j, v) {
						opt += '<option value="' + v.provider_id +'">' + v.name + "</option>";
					});
					$("#opertor").append(opt);
					
			},
	});
	///end operator
		
$('#fatch_bill').click(function(){
		var opertor = $('#opertor').val();
		var number = $('#number').val();
		console.log(amount,number);
		
		if(number==''){
		alert("Please fiil the Consumer Number");
		}else{	
		$('#loading').show();
		$.ajax({
        url: URL + "android_apis/electricity_fatch.php",
        type: "post",
        data: {provider:opertor,number:number,username:username,password:password},
        success: function (response) {
            $('#loading').hide();
            var result = response;
            console.log(result.records[0].CustomerName);

			     document.getElementById("customerName").value = result.records[0].CustomerName;
					document.getElementById("billDate").value = result.records[0].Billdate;
					document.getElementById("billNumber").value = result.records[0].BillNumber;
					document.getElementById("dueDate").value = result.records[0].Duedate;
					document.getElementById("amount").value = result.records[0].Billamount;
					document.getElementById('number').readOnly = true;
					document.getElementById('opertor').readOnly = true;	
					$("#billinfo").show();
					 $("#bill_recharge").show();
					 $("#fatch_bill").hide();
               
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
		}
});

$('#bill_recharge').click(function(){

		var amount = $('#amount').val();
		var opertor = $('#opertor').val();
		var number = $('#number').val();
		var pin = $('#pin').val();
		$('#loading').show();
		$.ajax({
        url: URL + "android_apis/recharge_electricity.php",
        type: "post",
        data: {electricity_updte:1,electricity_amount:amount,electricity_provider:opertor,electricity_account_number:number,pin:pin,username:username,password:password},
        success: function (response) {
            $('#loading').hide();
            var result = response;
            console.log(result);
            if(result.error==0){
					 if(result.status=="Success"){
						 if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/green-tick.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.tnx_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					 }else if(result.status=="Failed"){
						 if(result.opid_id==" "){
							result.opid_id = "Not Available";
						}
						$('#icon_status').attr('src','img/red-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.tnx_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					}else if(result.status=="Pending"){
						if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/pending-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.tnx_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();	
					}else{
						alert(result.status);
					}
					}else{
						alert(result.error_msg);
					}
	

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});

} else if (PAGE == "INSURANCE") {
	$("#aeps_back").on("click", function () {
	$('#mobile_recharge_form').show();
	$('#mobile_result').hide();
});	
$('#aeps_back_home').click(function(){
	location.href = "home.html";
});
		$("#bill_recharge").hide();
		$("#billinfo").hide();
	if ("username" in localStorage) {
		
	} else {
	location.href = "login.html";
	}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	$.ajax({
            url: URL + "android_apis/get_provider.php",
			type: "post",
			data: {recharge_service:11,username:username,password:password},
					success: function(result) {
					$('#loading').hide();
					console.log(result);	
					var result = JSON.parse(JSON.stringify(result));
					var opt = "";
					jQuery.each(result.providers, function (j, v) {
						opt += '<option value="' + v.provider_id +'">' + v.name + "</option>";
					});
					$("#opertor").append(opt);
					
			},
	});
	///end operator
		
$('#fatch_bill').click(function(){
		var opertor = $('#opertor').val();
		var number = $('#number').val();
		console.log(amount,number);
		
		if(number==''){
		alert("Please fiil the Consumer Number");
		}else{	
		$('#loading').show();
		$.ajax({
        url: URL + "android_apis/insurance_fatch.php",
        type: "post",
        data: {provider:opertor,number:number,username:username,password:password},
        success: function (response) {
            $('#loading').hide();
            var result = response;
            console.log(result.records[0].CustomerName);
			     document.getElementById("customerName").value = result.records[0].CustomerName;
					document.getElementById("billDate").value = result.records[0].Duedatefromto;
					document.getElementById("amount").value = result.records[0].Netamount;
					document.getElementById('number').readOnly = true;
					document.getElementById('opertor').readOnly = true;
					$("#billinfo").show();
					 $("#bill_recharge").show();
					 $("#fatch_bill").hide();
               
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
		}
});

$('#bill_recharge').click(function(){

		var amount = $('#amount').val();
		var opertor = $('#opertor').val();
		var number = $('#number').val();
		var pin = $('#pin').val();
		$('#loading').show();
		$.ajax({
        url: URL + "android_apis/recharge_electricity.php",
        type: "post",
        data: {electricity_updte:1,electricity_amount:amount,electricity_provider:opertor,electricity_account_number:number,pin:pin,username:username,password:password},
        success: function (response) {
            $('#loading').hide();
            var result = response;
            console.log(result);
            if(result.error==0){
					 if(result.status=="Success"){
						 if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/green-tick.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.tnx_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					 }else if(result.status=="Failed"){
						 if(result.opid_id==" "){
							result.opid_id = "Not Available";
						}
						$('#icon_status').attr('src','img/red-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.tnx_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();
					}else if(result.status=="Pending"){
						if(result.opid_id==" "){
							result.opid_id = "Processing";
						}
						$('#icon_status').attr('src','img/pending-icon.png');
						$('#t_status').html(result.status);
						$('#t_amount').html(result.amount);
						$('#t_opid').html(result.tnx_id);
						$('#mobile_recharge_form').hide();
						$('#mobile_result').show();	
					}else{
						alert(result.status);
					}
					}else{
						alert(result.error_msg);
					}
	

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});

	
} else if (PAGE == "UPI_ADD_MONEY") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	$.ajax({
            url: URL + "android_apis/get_upi_details.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
					console.log(result);	
					//$('#loading').hide();
					$('#payeeVPA').val(result.payeeVPA);
					$('#payeeName').val(result.payeeName);
					$('#payeeMerchantCode').val(result.payeeMerchantCode);
					$('#minimumAmount').val(result.minimumAmount);
					$('#transactionRefUrl').val(result.transactionRefUrl);
					$('#aid').val(result.aid);
					
			},
	});
	
	$.ajax({
            url: URL + "android_apis/get_upi_option.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
					$('#loading').hide();	
					console.log(result);	
					var result = JSON.parse(JSON.stringify(result));
					var opt = "";
					jQuery.each(result.upi, function (j, v) {
						opt += '<option value="' + v.app_id +'">' + v.app_name + "</option>";
					});
					$("#app_id").append(opt);
					
			},
	});
	$("#upi_pay").on("click", function () {
		var payeeVPA = $("#payeeVPA").val();
		var payeeName = $("#payeeName").val();
		var payeeMerchantCode = $("#payeeMerchantCode").val();
		var minimumAmount = $("#minimumAmount").val();
		var transactionRefUrl = $("#transactionRefUrl").val();
		var aid = $("#aid").val();
		var amount = $("#amount").val();
		var app_id = $("#app_id").val();
		if(amount==""){
			alert("Please Enter Amount");
		}else if(app_id==""){
			alert("Please Select App");
		}else{
		var tid = Math.floor(Math.random() * 110000000000);
let config = {
        "pa": payeeVPA, // VPA no from UPI payment acc
        "pn": payeeName, // Merchant Name registered in UPI payment acc
        "mc": payeeMerchantCode, // Merchant Code from UPI payment acc
        "tid": tid, // Unique transaction id for merchant's reference
        "tr": tid, // Unique transaction id for merchant's reference
        "aid": aid, // Note that will displayed in payment app during transaction
        "am": amount, // Amount 
        "mam": minimumAmount, // its optional. Minimum amount that has to be transferred 
        "cu": "INR", // Currency of amount
		"tn": "Pay Via Upi",
        //"url": transactionRefUrl, // URL for the order
};
var request = JSON.stringify(config);
//alert(JSON.stringify(config));
	$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/upi_request_money.php",
			type: "post",
			data: {ref_number:tid,request_money:amount,username:username,password:password},
					success: function(result) {
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					
					
			},
	});
let successCallback = function (result) { 
    var result_err = JSON.stringify(result);
	$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/upi_status.php",
			type: "post",
			//datatype : "text",
			//contentType: "text",
			data: "status="+result.status+"&ref_number="+tid+"&request="+request+"&json_data="+result_err+"&username="+username+"&password=" + password,
					error: function(data) {
					$('#loading').hide();	
					var str = data.responseText;
					console.log(str);
					alert(str);
			},
	});
}
let failureCallback = function (err) {
    //console.log("Issue in interaction and completion of payment with UPI", err);
	
	var result_err = JSON.stringify(err);
	$('#loading').show();
	    $.ajax({
			url: URL + "android_apis/upi_status.php",
			type: "post",
			//datatype : "text",
			//contentType: "text",
			data: "status="+err.status+"&ref_number="+tid+"&request="+request+"&json_data="+result_err+"&username="+username+"&password=" + password,
					error: function(data) {
					$('#loading').hide();	
					var str = data.responseText;
					console.log(str);
					alert(str);
			},
	});
}
let app = app_id;
window["UPI"].acceptPayment(config, app, successCallback, failureCallback);
}
});
	


} else if (PAGE == "RECHARGE_REPORTS") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	$("#date_from").val(dateFormat(new Date(), 1));
    $("#date_to").val(dateFormat(new Date(), 1));
	///////today Reports start
	var from = $("#date_from").val();
	var to = $("#date_to").val();
	//$('#loading').hide();
				$.ajax({
            url: URL + "android_apis/recharge_history_list_all.php",
			type: "post",
			data: {from_date:from,to_date:to,username:username,password:password},
					success: function(response) {
					$('#loading').hide();
					console.log(response);
					var result = JSON.parse(JSON.stringify(response));
					if (result.all_history.length) {
						jQuery.each(result.all_history, function (j, value) {
						var Commision = value.my_inc;
						var dis = '<td data-label="Dispute"><button onclick="dispute_id('+ value.wallet_id +')" style="color: #f8f8ff;background-color: #0d6efd;border size: 5px; padding: 0.001rem 0.7rem;">Send</button></td>';
						if (value.status === "Failed" || value.status == "Refund"){ 
							btn = "red";
						    Commision = "0";
                        }if (value.status === "Success") {
                            btn = "green";
						}if (value.status === "Pending") 
							btn = "#ffaf00";
						if(value.opid ==""){
							value.opid = 0;
							
						}
                        html ='<div style="padding-left: 20px;"><table style="width: 95%;"><tbody><tr>' + 
						'<td data-label="Status" style="color: ' + btn +';">' + value.status +'</td>' +
						'<td data-label="Mobile">' + value.mobile_number +'</td>' +
						'<td data-label="Amount">' + value.amount +'</td>' +
						'<td data-label="Operator ID">' + value.opid +'</td>' +
						'<td data-label="Ref No.">' + value.ref_number +'</td>' +
						'<td data-label="Commision">' + Commision +'</td>' +
						'<td data-label="Operator">' + value.provider_name +'</td>' +
						'<td data-label="Type">' + value.provider_type +'</td>' + dis +'<td data-label="Message">' + value.transaction_type +'</td>' +
						'<td data-label="Date">' + value.transaction_date +'</td>' +
						'<td data-label="Opening Bal">' + value.user_old_balance +'</td>' +
						'<td data-label="Closing Bal">' + value.user_new_balance +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
						});
					} else {
							alert(result.error_msg);
						}
					//document.getElementById("img1").style.background-image = Images1;
			},
	});
	///////today Reports end

	$("#date_submit").on("click", function () {
		$("#results").empty();
		 var from = $("#date_from").val();
		 var to = $("#date_to").val();
		 $('#loading').show();
			$.ajax({
            url: URL + "android_apis/recharge_history_list_all.php",
			type: "post",
			data: {from_date:from,to_date:to,username:username,password:password},
					success: function(response) {
					$('#loading').hide();
					console.log(response);
					var result = JSON.parse(JSON.stringify(response));
					if (result.all_history.length) {
						jQuery.each(result.all_history, function (j, value) {
						var Commision = value.my_inc;
						var dis = '<td data-label="Dispute"><button onclick="dispute_id('+ value.wallet_id +')" style="color: #f8f8ff;background-color: #0d6efd;border size: 5px; padding: 0.001rem 0.7rem;">Send</button></td>';
						if (value.status === "Failed" || value.status == "Refund"){ 
							btn = "red";
						    Commision = "0";
                        }if (value.status === "Success") {
                            btn = "green";
						}if (value.status === "Pending") 
							btn = "#ffaf00";
						if(value.opid ==""){
							value.opid = 0;
							
						}
                        html ='<div style="padding-left: 20px;"><table style="width: 95%;"><tbody><tr>' + 
						'<td data-label="Status" style="color: ' + btn +';">' + value.status +'</td>' +
						'<td data-label="Mobile">' + value.mobile_number +'</td>' +
						'<td data-label="Amount">' + value.amount +'</td>' +
						'<td data-label="Operator ID">' + value.opid +'</td>' +
						'<td data-label="Ref No.">' + value.ref_number +'</td>' +
						'<td data-label="Commision">' + Commision +'</td>' +
						'<td data-label="Operator">' + value.provider_name +'</td>' +
						'<td data-label="Type">' + value.provider_type +'</td>' + dis +'<td data-label="Message">' + value.transaction_type +'</td>' +
						'<td data-label="Date">' + value.transaction_date +'</td>' +
						'<td data-label="Opening Bal">' + value.user_old_balance +'</td>' +
						'<td data-label="Closing Bal">' + value.user_new_balance +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
						});
					} else {
							alert(result.error_msg);
						}
					//document.getElementById("img1").style.background-image = Images1;
			},
	});
	
	
		
  });
} else if (PAGE == "PAYMENT_REQUEST_HISTORY") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	$("#date_from").val(dateFormat(new Date(), 1));
    $("#date_to").val(dateFormat(new Date(), 1));
	//$('#loading').hide();
	var from = $("#date_from").val();
	var to = $("#date_to").val();
			$.ajax({
            url: URL + "android_apis/report_request_money.php",
			type: "post",
			data: {from_date:from,to_date:to,username:username,password:password},
					success: function(result) {
						$('#loading').hide();
					console.log(result);
					if (result.request_list.length) {
                    jQuery.each(result.request_list, function (j, value) {
						if (value.status === "Rejected"){ 
							btn = "red";
                        }else if (value.status === "Transferred") {
                            btn = "green";
						} else if (value.status === "Pending") 
							btn = "#ffaf00";
						if (value.decision === ""){ 
							value.decision = "Under Process"
						}
                        html ='<div style="padding-left: 20px;"><table style="width: 95%;"><tbody><tr>' + 
						'<td data-label="Status" style="color: ' + btn +';">' + value.status +'</td>' +
						'<td data-label="Amount">' + value.amount +'</td>' +
						'<td data-label="Payment Mode">' + value.transfer_mode +'</td>' +
						'<td data-label="Request Date">' + value.request_date +'</td>' +
						'<td data-label="Tran No">' + value.transaction_number +'</td>' +
						'<td data-label="Decision Date">' + value.decision_date +'</td>' +
						'<td data-label="Remark">' + value.decision +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
                    });
                } else {
					alert(result.error_msg);
                    
                }
					//document.getElementById("img1").style.background-image = Images1;
			},
	});
	var utype = localStorage.getItem("role");
	$("#date_submit").on("click", function () {
		$("#results").empty();
		 var from = $("#date_from").val();
		 var to = $("#date_to").val();
		 $('#loading').show();
		$.ajax({
            url: URL + "android_apis/report_request_money.php",
			type: "post",
			data: {from_date:from,to_date:to,username:username,password:password},
					success: function(result) {
						$('#loading').hide();
					console.log(result);
					if (result.request_list.length) {
                    jQuery.each(result.request_list, function (j, value) {
						if (value.status === "Rejected"){ 
							btn = "red";
                        }else if (value.status === "Transferred") {
                            btn = "green";
						} else if (value.status === "Pending") 
							btn = "#ffaf00";
						if (value.decision === ""){ 
							value.decision = "Under Process"
						}
                        html ='<div style="padding-left: 20px;"><table style="width: 95%;"><tbody><tr>' + 
						'<td data-label="Status" style="color: ' + btn +';">' + value.status +'</td>' +
						'<td data-label="Amount">' + value.amount +'</td>' +
						'<td data-label="Payment Mode">' + value.transfer_mode +'</td>' +
						'<td data-label="Request Date">' + value.request_date +'</td>' +
						'<td data-label="Tran No">' + value.transaction_number +'</td>' +
						'<td data-label="Decision Date">' + value.decision_date +'</td>' +
						'<td data-label="Remark">' + value.decision +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
                    });
                } else {
					alert(result.error_msg);
                    
                }
					//document.getElementById("img1").style.background-image = Images1;
			},
	});
		
    });	
} else if (PAGE == "DISPUTES_HISTORY") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	$("#date_from").val(dateFormat(new Date(), 1));
    $("#date_to").val(dateFormat(new Date(), 1));
	//$('#loading').hide();
	var from = $("#date_from").val();
	var to = $("#date_to").val();
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	$.ajax({
            url: URL + "android_apis/list_dispute_report.php",
			type: "post",
			data: {from_date:from,to_date:to,username:username,password:password},
					success: function(response) {
					$('#loading').hide();
					console.log(response);
					var result = JSON.parse(JSON.stringify(response));
					if (result.Dispute_report.length) {

                    jQuery.each(result.Dispute_report, function (j, value) {
						if(value.dispute_resolution == ""){
							value.dispute_resolution = "Pending"
						}
                        html ='<div style="padding-left: 20px;"><table style="width: 95%;"><tbody><tr>' +
						'<td data-label="Send Message">' + value.dispute +'</td>' +						
						'<td data-label="Recived Message">' + value.dispute_resolution +'</td>' +
						'<td data-label="Number">' + value.mobile_number +'</td>' +
						'<td data-label="Ref No.">' + value.reference_number +'</td>' +
						'<td data-label="Debit Amount">' + value.amount +'</td>' +
						'<td data-label="Total Amount">' + value.total_amount +'</td>' +
						'<td data-label="Send Date">' + value.dispute_date +'</td>' +
						'<td data-label="Recived Date">' + value.resolution_date +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
                    });
                } else {
                   alert(result.error_msg);
                }
					//document.getElementById("img1").style.background-image = Images1;
			},
	});
	var utype = localStorage.getItem("role");
	$("#date_submit").on("click", function () {
		$("#results").empty();
		 var from = $("#date_from").val();
		 var to = $("#date_to").val();
		 $('#loading').show();
		$.ajax({
            url: URL + "android_apis/list_dispute_report.php",
			type: "post",
			data: {from_date:from,to_date:to,username:username,password:password},
					success: function(response) {
					$('#loading').hide();
					console.log(response);
					var result = JSON.parse(JSON.stringify(response));
					if (result.Dispute_report.length) {

                    jQuery.each(result.Dispute_report, function (j, value) {
						if(value.dispute_resolution == ""){
							value.dispute_resolution = "Pending"
						}
                        html ='<div style="padding-left: 20px;"><table style="width: 95%;"><tbody><tr>' +
						'<td data-label="Send Message">' + value.dispute +'</td>' +						
						'<td data-label="Recived Message">' + value.dispute_resolution +'</td>' +
						'<td data-label="Number">' + value.mobile_number +'</td>' +
						'<td data-label="Ref No.">' + value.reference_number +'</td>' +
						'<td data-label="Debit Amount">' + value.amount +'</td>' +
						'<td data-label="Total Amount">' + value.total_amount +'</td>' +
						'<td data-label="Send Date">' + value.dispute_date +'</td>' +
						'<td data-label="Recived Date">' + value.resolution_date +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
                    });
                } else {
                   alert(result.error_msg);
                }
					//document.getElementById("img1").style.background-image = Images1;
			},
	});
		
    });	
	
} else if (PAGE == "MY_COMMISSION") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
		$("#results").empty();
		$.ajax({
            url: URL + "android_apis/commission_structure.php",
			type: "post",
			data: {username:username,password:password},
					success: function(response) {
					console.log(response);
					var result = JSON.parse(JSON.stringify(response));
					if (result.slab.length) {
                    jQuery.each(result.slab, function (j, value) {
                        html ='<div class="card cart-amount-area">' + 
						'<div class="card-body d-flex align-items-center justify-content-between">' + 
						'<h5 class="total-price mb-0" style="font-size: 14px;">' + value.provider_name +' (' + value.service +')</h5>' +
						'<h5 class="total-price mb-0" style="font-size: 14px;">' + value.type +'</h5>' +
						'<a class="btn btn-warning">' + value.commission_amount +'</a>' + 
						'</div>' + 
						'</div><br>';
                        $("#results").append(html);
						$('#loading').hide();
                    });
                } else {
                    html = '<div class="card"><div class="card-header bg-none"><div class="row"><div class="col">No Results</div></div></div></div>';
                    $("#results").append(html);
					$('#loading').hide();
                }
			},
	});
} else if (PAGE == "PROFILE") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
		$.ajax({
            url: URL + "android_apis/get_profile.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
					console.log(result);
					var result = JSON.parse(JSON.stringify(result));
					$('#loading').hide();
					document.getElementById("name").value = result.user.name;
					document.getElementById("mobile").value = result.user.mobile;
					document.getElementById("email").value = result.user.email;
					document.getElementById("address").value = result.user.user_address;
			},
	});	
	$("#profile_submit").on("click", function () {
		$('#loading').show();
		var name = $("#name").val();
		var mobile = $("#mobile").val();
		var email = $("#email").val();
		var address = $("#address").val();
		$.ajax({
            url: URL + "android_apis/update_profile.php",
			type: "post",
			data: {name:name,email:email,mobile:mobile,user_address:address,username:username,password:password},
					success: function(result) {
					$('#loading').hide();
					if(result.error==0){
						location.reload();
						alert(result.error_msg);
					}else{
						alert(result.error_msg);
					}
			},
	});	
	});
} else if (PAGE == "CHANGE_PASSWORD") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	$('#loading').hide();
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	$("#password_submit").on("click", function () {
		
		var opassword = $("#opassword").val();
		var npassword = $("#npassword").val();
		var cpassword = $("#cpassword").val();
		if(opassword == ""){
			alert("Please Enter Old Password");
		}else{
		if(npassword != cpassword){
			alert("New & Confirm Password do not match.");
		}else{
			$('#loading').show();
		$.ajax({
            url: URL + "android_apis/change_password.php",
			type: "post",
			data: {change_passowrd_updte:1,old_password:opassword,new_password:npassword,confirm_password:cpassword,username:username,password:password},
					success: function(result) {
					$('#loading').hide();	
					if(result.error==0){
						localStorage.setItem("password", cpassword);
						location.reload();
						alert(result.error_msg);
					}else{
						alert(result.error_msg);
					}
					
			},
	});	}
		}
	
	});
} else if (PAGE == "CHANGE_PIN") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	$('#loading').hide();
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	$("#password_submit").on("click", function () {
		
		var opassword = $("#opassword").val();
		var npassword = $("#npassword").val();
		var cpassword = $("#cpassword").val();
		if(opassword == ""){
			alert("Please Enter Old Pin");
		}else{
		if(npassword != cpassword){
			alert("New & Confirm Pin do not match.");
		}else{
		$('#loading').show();
		$.ajax({
            url: URL + "android_apis/change_pin.php",
			type: "post",
			data: {old_pin:opassword,new_pin:cpassword,username:username,password:password},
					success: function(result) {
					$('#loading').hide();	
					if(result.error==0){
						location.reload();
						alert(result.error_msg);
					}else{
						alert(result.error_msg);
					}
					
			},
	});	}
		}
	
	});		
} else if (PAGE == "BANK_DETAILS") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
		$("#results").empty();
		$.ajax({
            url: URL + "android_apis/get_bank.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
					$('#loading').hide();
					console.log(result);
					var result = JSON.parse(JSON.stringify(result));
					if (result.bank_details.length) {
                    jQuery.each(result.bank_details, function (j, value) {
                       html ='<div ><table style="width: 100%;"><tbody><tr>' + 
						'<td data-label="Account Name">' + value.account_holder_name +'</td>' +
						'<td data-label="Account Number">' + value.account_no +'</td>' +
						'<td data-label="Bank Name">' + value.bank_name +'</td>' +
						'<td data-label="Ifsc Code">' + value.ifsc_code +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
						
                    });
                } else {
                    html = '<div class="card"><div class="card-header bg-none"><div class="row"><div class="col">No Results</div></div></div></div>';
                    $("#results").append(html);
					$('#loading').hide();
                }
			},
	});	
} else if (PAGE == "ADD_USER") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	//alert("hii");
	$('#loading').hide();
	$("#add_user_submit").on("click", function () {
		var name = $("#name").val();
		var company_name = $("#company_name").val();
		var mobile = $("#mobile").val();
		var email = $("#email").val();
		var user_address = $("#user_address").val();
		if(name=="" ||company_name=="" ||mobile=="" ||email=="" ||user_address==""){
			alert("Please Fill All Details");
		}else{
			$('#loading').show();
			var data = $('#add_user').serialize() + "&username="+ username +"&password="+ password +"&add_user_id=1";
			$.ajax({
            url: URL + "android_apis/add_team.php",
			type: "post",
			data: data,
					success: function(result) {
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
						location.reload();
						alert(result.error_msg);
					}else{
						alert(result.error_msg);
					}
					
			},
			});
		}
		
	});	
} else if (PAGE == "USER_LIST") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
		$("#results").empty();
		$.ajax({
            url: URL + "android_apis/get_users_listing.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
					$('#loading').hide();
					console.log(result);
	//				var result = JSON.parse(JSON.stringify(result));
					if (result.user_list.length) {
                    jQuery.each(result.user_list, function (j, value) {
						if(value.user_name==""){
							value.user_name="0";
						}
                       html ='<div ><table id="table" style="width: 100%;"><tbody><tr>' + 
						'<td data-label="Name">' + value.name +'</td>' +
						'<td data-label="User Name">' + value.user_name +'</td>' +
						'<td data-label="Mobile">' + value.mobile +'</td>' +
						'<td data-label="Company Name">' + value.company_name +'</td>' +
						'<td data-label="Balance">' + value.current_balance +'</td>' +
						'<td data-label="Transfer Balance"><a onclick="transfer_balance(' + value.user_id +')"><i class="lni lni-arrow-right" style="font-size: 20px;background: darkcyan;color: #e9ecef;"></i></a></i></td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
						
                    });
                } else {
                    html = '<div class="card"><div class="card-header bg-none"><div class="row"><div class="col">No Results</div></div></div></div>';
                    $("#results").append(html);
					$('#loading').hide();
                }
			},
	});
function transfer_balance(user_id) {
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	var amount = parseInt(prompt("Transfer Amount"), 10);
	var pin = parseInt(prompt("Transfer Pin"), 10);
	 var r = confirm("Are you sure ?");
	  if (r == true) {
		$('#loading').show();
	    $.ajax({
            url: URL + "android_apis/send_money.php",
			type: "post",
			data: {updte:1,pin:pin,transfer_money:user_id,amount:amount,username:username,password:password},
					success: function(response) {
					$('#loading').hide();
					console.log(response);
						location.reload();
					 alert(response.error_msg);
			},
		});
	  } else {
		alert("Transfer Cancel");
	  }
}
$("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });	
} else if (PAGE == "LEDGER_REPORTS") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	$("#date_from").val(dateFormat(new Date(), 1));
    $("#date_to").val(dateFormat(new Date(), 1));
	//$('#loading').hide();
	var from = $("#date_from").val();
	var to = $("#date_to").val();
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
			$.ajax({
            url: URL + "android_apis/ledger_report.php",
			type: "post",
			data: {from_date:from,to_date:to,username:username,password:password},
					success: function(response) {
					$('#loading').hide();
					console.log(response);
					var result = JSON.parse(JSON.stringify(response));
					if (result.Ledger_report.length) {
                    jQuery.each(result.Ledger_report, function (j, value) {
						if(value.credit_amount ==""){
							value.credit_amount = 0;
						}
						if(value.debit_amount ==""){
							value.debit_amount = 0;
						}
                        html ='<div style="padding-left: 20px;"><table style="width: 95%;"><tbody><tr>' + 
						'<td data-label="Credit">' + value.credit_amount +'</td>' +
						'<td data-label="Debit">' + value.debit_amount +'</td>' +
						'<td data-label="Type">' + value.transaction_type +'</td>' +
						'<td data-label="Ref No.">' + value.ref_numer +'</td>' +
						'<td data-label="Opening Bal">' + value.user_old_balance +'</td>' +
						'<td data-label="Closing Bal">' + value.user_new_balance +'</td>' +
						'<td data-label="Date">' + value.transaction_date +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
                    });
                } else {
                    alert(result.error_msg);
                }
					//document.getElementById("img1").style.background-image = Images1;
			},
	});
	var utype = localStorage.getItem("role");
	$("#date_submit").on("click", function () {
		$("#results").empty();
		 var from = $("#date_from").val();
		 var to = $("#date_to").val();
		 $('#loading').show();
		$.ajax({
            url: URL + "android_apis/ledger_report.php",
			type: "post",
			data: {from_date:from,to_date:to,username:username,password:password},
					success: function(response) {
					$('#loading').hide();
					console.log(response);
					var result = JSON.parse(JSON.stringify(response));
					if (result.Ledger_report.length) {
                    jQuery.each(result.Ledger_report, function (j, value) {
						if(value.credit_amount ==""){
							value.credit_amount = 0;
						}
						if(value.debit_amount ==""){
							value.debit_amount = 0;
						}
                        html ='<div style="padding-left: 20px;"><table style="width: 95%;"><tbody><tr>' + 
						'<td data-label="Credit">' + value.credit_amount +'</td>' +
						'<td data-label="Debit">' + value.debit_amount +'</td>' +
						'<td data-label="Type">' + value.transaction_type +'</td>' +
						'<td data-label="Ref No.">' + value.ref_numer +'</td>' +
						'<td data-label="Opening Bal">' + value.user_old_balance +'</td>' +
						'<td data-label="Closing Bal">' + value.user_new_balance +'</td>' +
						'<td data-label="Date">' + value.transaction_date +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
                    });
                } else {
                    alert(result.error_msg);
                }
					//document.getElementById("img1").style.background-image = Images1;
			},
	});
		
    });
} else if (PAGE == "SEARCH_BY_NUMBER") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	var utype = localStorage.getItem("role");
	$("#search").on("click", function () {
		$("#results").empty();
		 var mobile = $("#number").val();
		$.ajax({
            url: URL + "android/RchMobSearch.php?username=" + username + "&password=" + password + "&utype=" + utype + "&mobile=" + mobile,
			type: "get",
					success: function(data) {
					console.log(data);
					var result = JSON.parse(JSON.stringify(data));
					if (result.length) {
                    jQuery.each(result, function (j, value) {
                        if (value.Status === "FAILURE" || value.Status == "REFUND"){ 
							btn = "red";
                        }else if (value.Status === "SUCCESS") {
                            btn = "green";
						} else if (value.Status === "PENDING") 
							btn = "#ffaf00";
                        html ='<div style="padding-left: 20px;"><table style="width: 95%;"><tbody><tr>' + 
						'<td data-label="Status" style="color: ' + btn +';">' + value.Status +'</td>' +
						'<td data-label="Mobile">' + value.Mobile +'</td>' +
						'<td data-label="Amount">' + value.Amount +'</td>' +
						'<td data-label="Operator ID">' + value.OperatorID +'</td>' +
						'<td data-label="Txid">' + value.Txid +'</td>' +
						'<td data-label="Operator">' + value.Operator +'</td>' +
						'<td data-label="Date">' + value.Date +'</td>' +
						'</tr></tbody></table></div></div>';
                        $("#results").append(html);
                    });
                } else {
                    html = '<div class="card"><div class="card-header bg-none"><div class="row"><div class="col">No Results</div></div></div></div>';
                    $("#results").append(html);
                }
					//document.getElementById("img1").style.background-image = Images1;
			},
	});
		
    });	
} else if (PAGE == "PAYMENT_REQUEST") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
		var username = localStorage.getItem("username");
		var password = localStorage.getItem("password");
		$.ajax({
            url: URL + "android_apis/get_bank.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
					$('#loading').hide();
					console.log(result);	
					//var result = jQuery.parseJSON(result);
					var html='';
					$('#account_type').text('<option value="">Select Bank</option>');
					result.bank_details.map((value,index) => (
					html+='<option value="'+value.id+'">'+value.bank_name+' ('+value.account_no+')</option>'
				   ));
				   $('#account_type').append(html);
					},
		});
		
		
		$("#payment_request").on("click", function () {
			var account_type = $("#account_type").val();
			var payment_mode = $("#payment_mode").val();
			var transaction_id = $("#transaction_id").val();
			var amount = $("#amount").val();
			if(transaction_id ==''){
				alert("Please Enter Transaction Id");
			} else if(amount ==''){	
			alert("Please Enter Amount");
			}else{
			$('#loading').show();
	    $.ajax({
            url: URL + "android_apis/request_money.php",
			type: "post",
			data: {amount:amount,ref_number:transaction_id,payment_mode:payment_mode,bank_id:account_type,username:username,password:password},
					success: function(result) {
						$('#loading').hide();
					console.log(result);
					if(result.error ==0){
						alert(result.error_msg);
						location.href = "home.html";
					}else{
						alert(result.error_msg);
					}
					
			},
	});
		}
	});
} else if (PAGE == "FORGET_PASSWORD") {
	$('#loading').hide();
	
	$("#forget_user").on("click", function () {
			var username = $("#username").val();
			if(username==""){
				alert("Please Enter Mobile Number");
			}else{
			$('#loading').show();
			$.ajax({
            url: URL + "android_apis/forget_password.php",
			type: "post",
			data: {forgot_email:username,updte1:1},
					success: function(result) {
						$('#loading').hide();
						console.log(result);
					$('#loading').hide();	
					if(result.error==0){
						location.reload();
						alert(result.error_msg);
					}else{
						alert(result.error_msg);
					}
					
			},
			});
			}
			
	});
} else if (PAGE == "LOGIN") {
	 $('#loading').hide();
	if (localStorage.getItem("islogin") != 1 && PAGE != "LOGIN") {
        location.href = "login.html";
    } else if (localStorage.getItem("islogin") == 1 && PAGE == "LOGIN") {
        location.href = "home.html";
    }
   $("#login_user").on("click", function () {
        var username = $("#username").val();
        var password = $("#password").val();
		
		if(username==''){
			alert("Please Enter Mobile Number");
		}else if (password==''){
			alert("Please Enter Password");
		}else{	
		//login
		$('#loading').show();
            $.ajax({
            url: URL + "android_apis/login_app.php",
			type: "post",
			data: {username:username,password:password},
					success: function(response) {
					$('#loading').hide();
					console.log(response);
					// var result = jQuery.parseJSON(response
					var result = response;
					if(result.error==0){
						localStorage.setItem("islogin", 1);
						localStorage.setItem("role", result.user_type);
						localStorage.setItem("parent_id", result.parent_id);
						localStorage.setItem("username", username);
						localStorage.setItem("password", password);						
					  window.location.href = "home.html";
					}else { 	
					 alert(result.error_msg);
					}
			},
		});
		}
	});
} else if (PAGE == "SUPPORTS") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	var username = localStorage.getItem("username");
	var password = localStorage.getItem("password");
	$.ajax({
            url: URL + "android_apis/get_support.php",
			type: "post",
			data: {username:username,password:password},
					success: function(result) {
					console.log(result);	
					$('#loading').hide();
					$('#mobile').text(result.mobile);
					$('#whatsapp').text(result.whatsapp);
					$('#email').text(result.email);
					$('#website').text(result.website);
					$('#address').text(result.address);
			},
	});
	
	
	$("#logout").on("click", function () {
		var r = confirm("Are you sure you want Logout ?");
		if (r == true) {
		  localStorage.clear();
		  location.href = "login.html";
		}
	});
} else if (PAGE == "DEFULT") {
		if ("username" in localStorage) {
} else {
    location.href = "login.html";
}
	//logout
	$("#logout").on("click", function () {
		var r = confirm("Are you sure you want Logout ?");
		if (r == true) {
		  localStorage.clear();
		  location.href = "login.html";
		}
		
	});
}