<?php

session_start();

include "include.php";
include "session.php";

if ($_POST['updte'] == '1') {

    if ($_POST['wid'] > 0) {
        $wallet_id = $_POST['wid'];
    } else {
        $wallet_id = 0;
    }if ($wallet_id > 0) {

        $o1 = $factory->get_object($wallet_id, "wallet", "wallet_id");
    }


    $string = "<table class='table table-bordered'>
        <tbody>
    <tr><td><b>Transaction Details :</b> </td> <td>" . $o1->transaction_type . " - " . $o1->api_number . " - " . $o1->ref_number . " - " . $o1->opid . "</td>  </tr>
    <tr><td><b>Mobile :</b></td> <td>" . $o1->amount . " - " . $o1->mobile_number . " - " . $o1->provider_name . " - " . $o1->provider_type . "- " . $o1->circle_name . "</td>  </tr>
    <tr><td><b>Date:</b></td> <td>" . $o1->transaction_date . "-" . $o1->transaction_details . " </td> </tr>
        </tbody>
                </table>
       <div class='col-md-12' >
        <div class='row'>
         <div class='col-md-12'>
       <div class='x_content bs-example-popovers'     style='word-break: break-all;'>";

    if ($o1->status == "Success") {
        $string .= "<div class='alert alert-success alert-dismissible ' role='alert'>
                     <strong>" . $o1->api_name . " - " . $o1->status . "</strong><br/>" . $o1->recharge_url . " <br/>" . $o1->api_response . "
    </div>";
    } else if ($o1->status == "Pending") {
        $string .= "<div class='alert alert-info alert-dismissible ' role='alert'>
                     <strong>" . $o1->api_name . " - " . $o1->status . "</strong> <br/>" . $o1->recharge_url . "<br/>" . $o1->api_response . "
    </div>";
    } else if ($o1->status == "Failed") {
        $string .= "<div class='alert alert-danger  alert-dismissible ' role='alert'>
                     <strong>" . $o1->api_name . " - " . $o1->status . "</strong> <br/>" . $o1->recharge_url . "<br/>" . $o1->api_response . "
    </div>";
    }
    
    if($o1->response_url != ""){
           $string .= "<div class='alert alert-success  alert-dismissible ' role='alert'>
                    <strong>Response Url :</strong> ". $o1->response_url."
    </div>";
    }
    
    $string .= "</div>
         </div>
 </div>
</div>
       <div class='col-md-12'>
        <label>Response</label>
        <div class='row'>
         <div class='col-md-12'>
            <textarea type='text' value='' class='form-control' id='response' name='response'> </textarea>
        </div>

    </div>

</div>";

    $string .= "<div class='col-md-12' >
    
    <div class='row'>";
    if ($o1->status == "Pending") {
        $string .= "<div class='col-md-4'>
        <label>Operator id</label>
        <input type='text' value='" . $o1->opid . "' class='form-control' id='opid' name='opid'>
    </div>
    <div class='col-md-4'>
        <label>Status</label>
        <select class='form-control' name='status_opid' id='status_opid'>
            <option value='0'> Status </option>
            <option value='Success'>Success</option>
            <option value='Failed'>Failed</option>
           

        </select>
    </div>";
    }
    if ($o1->status == "Failed"  && $o1->opid != "Retry") {
        $string .= "<div class='col-md-4'>
     <label>Retry (Api)</label>
     <select  class='form-control' name='api_id' id='api_id'  >
        <option value='0'>Select Api</option>" . api_list($o1->api_id) . "</select>
 </div>";
    }
    $string .= "</div>

</div> <br/>";

    $string .= "</div> <br/> <div class='modal-footer'>";
    $string .= "<input  type='hidden' id='wallet_id' name='wallet_id' value='" . $o1->wallet_id . "'/>";

    if ($o1->status == "Success") {
        $string .= "<button class='btn btn-red' type='button' onclick=\"refund_success_amount('Failed')\">Force Refund</button>";
    }
    if ($o1->status == "Failed") {
        $string .= "<button class='btn btn-primary' type='button' onclick=\"refund_success_amount('Success')\">Force Success</button>";
    }
    $string .= "<button class='btn btn-orng' type='button' onclick=\"check_response()\">Response</button>";
 if($o1->status == "Failed" && $o1->opid != "Retry"){
       $string .= "<button class='btn btn-primary' type='button' onclick='retry_api()'>Resend</button>";
 }
    if ($o1->status == "Pending") {
      
        $string .= "<button class='btn btn-lightblue' type='button' onclick='update_opid()'>Update Status</button>";
    }



    $string .= "</div>";
    $result['modal_body'] = $string;
    $result['modal_head'] = $o1->user_name . " - " . $o1->recharge_path . "  -  " . $o1->ip_address . " ";
}
echo json_encode($result);
?>
