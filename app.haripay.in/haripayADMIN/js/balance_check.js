function cyrus_balance(){
$.ajax({
    url:"api_balance_check.php",
    type:'post',
    data:{"id":"5"},
    success:function(response){
          var result = jQuery.parseJSON(response);
            console.log(result);

            if(result['Balance'] > 0){
                 $('#balance_cyrus').html(result['Balance']);
             }else{
                 $('#balance_cyrus').html(0);
             }

    },
    error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }


});
 setTimeout(function () {cyrus_balance();}, 5000);
}

setTimeout(function () {cyrus_balance();}, 5000);

function rech_balance(){
$.ajax({
    url:"api_balance_check.php",
    type:'post',
    data:{"id":"6"},
    success:function(response){
          var result = jQuery.parseJSON(response);
            console.log(result);

            if(result['Balance'] > 0){
                 $('#balance_rech').html(result['Balance']);
             }else{
                 $('#balance_rech').html(0);
             }

    },
    error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }


});
 setTimeout(function () {rech_balance();}, 5000);
}

setTimeout(function () {rech_balance();}, 5000);




function ezulix_balance(){
$.ajax({
    url:"api_balance_check.php",
    type:'post',
    data:{"id":"4"},
    success:function(response){
          var result = jQuery.parseJSON(response);
            console.log(result);
            if(result['Balance'] > 0){
                 $('#balance_ezulix').html(result['Balance']);
             }else{
                 $('#balance_ezulix').html(0);
             }

    },
    error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }


});
 setTimeout(function () {ezulix_balance();}, 5000);
}

setTimeout(function () {ezulix_balance();}, 5000);

function roundpay_balance(){
$.ajax({
    url:"api_balance_check.php",
    type:'post',
    data:{"id":"2"},
    success:function(response){
          var result = jQuery.parseJSON(response);
            console.log(result);
            if(result['Balance'] > 0){
                 $('#balance_roundpay').html(result['Balance']);
             }else{
                 $('#balance_roundpay').html(0);
             }

    },
    error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }


});
 setTimeout(function () {roundpay_balance();}, 5000);
}

setTimeout(function () {roundpay_balance();}, 5000);