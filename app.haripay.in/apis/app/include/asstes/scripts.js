$(document).ready(function() {
	$(".fixed_menu li a").click(function(){
      	$(".fixed_menu li a").removeClass("active");
      	$(this).addClass("active");
      })
	
	$(".lsignup_btn").click(function(){
		$(".signup_page").addClass("signup_active");
	})
	$(".slogin_btn").click(function(){
		$(".signup_page").removeClass("signup_active");
	})

	$("#login").click(function(){
		$(".main_conatiner").addClass("fixed_active");
		$(".main_wrapper").addClass("loader_active");

		setTimeout(function() {
	       	$(".main_conatiner").removeClass("fixed_active");
			$(".main_wrapper").removeClass("loader_active");
   		}, 1200);
	})
});