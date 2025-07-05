<?php

class api {
	public $api_id;
	public $api_type;
	public $api_name;
	public $api_username;
	public $api_password;
	public $api_key;
	public $api_domain;
	public $api_balance;
	public $security_key;
	public $corporate_id;
	public $md_key;
	public $is_active;
	public $user_id;
	public function api() {

	}
}

class api_circle_code {
	public $api_circle_code_id;
	public $api_id;
	public $api_name;
	public $service_circle_id;
	public $circle_name;
	public $circle_code;
	public $is_active;
	public function api_circle_code() {

	}
}

class api_ip_key {
	public $api_ip_key_id;
	public $user_id;
	public $ip_address;
	public $authorization_code;
	public $call_back_url;
	public $is_active;

	public function api_ip_key() {

	}
}

class api_provider {
	public $api_provider_id;
	public $api_id;
	public $api_name;
	public $provider_id;
	public $provider;
	public $commission_amount;
	public $commission_percentage;
	public $is_active;
	public function api_provider() {

	}
}

class api_provider_code {
	public $api_provider_code_id;
	public $api_id;
	public $api_name;
	public $provider_id;
	public $provider;
	public $provider_code;
	public $is_active;
	public function api_provider_code() {

	}
}

class upi_setup {
	public $upi_setup_id;
	public $payeeVPA;
	public $payeeName;
	public $payeeMerchantCode;
	public $minimumAmount;
	public $transactionRefUrl;
	public $aid;
	public function upi_setup() {

	}
}

class benner_set {
	public $benner_set_id;
	public $banner_pic;
	public $is_active;
	public $update_pic;
	public function benner_set() {

	}
}

class api_wallet {
	public $api_wallet_id;
	public $api_id;
	public $payment_mode;
	public $cash_credit;
	public $amount;
	public $transaction_date;
	public $transaction_details;
	public $update_wallet;
	public $is_active;
	public function api_wallet() {

	}
}

class blocked_transactions {
	public $blocked_transaction_id;
	public $provider_id;
	public $provider;
	public $amount;
	public $is_active;
	public function blocked_transactions() {

	}
}

class disputes {
	public $dispute_id;
	public $wallet_id;
	public $user_id;
	public $resolved_by;
	public $dispute;
	public $dispute_date;
	public $dispute_resolution;
	public $resolution_date;
	public $is_active;
	public function disputes() {

	}
}
class ipay_state {
	public $ipay_state_id;
	public $state_name;
	public $state_ID;
	public $is_active;
	public function ipay_state() {

	}
}
class ipay_proof {
	public $ipay_proof_id;
	public $proof_id;
	public $proof_name;
	public $proof_type;
	public $is_active;
	public function ipay_proof() {

	}
}
class ipay_bank {
	public $ipay_bank_id;
	public $bankID;
	public $bank_name;
	public $ifsC_Code;
	public $status;
	public $is_active;
	public function ipay_bank() {

	}
}
class ipay_beneficiary {
	public $ipay_beneficiary_id ;
	public $user_id ;
	public $ipay_user_id ;
	public $beneficiary_ID;
	public $beneficiary_Code ;
	public $beneficiaryName ;
	public $beneficiaryAddress ;
	public $mobileNo ;
	public $accountType ;
	public $ifscType ;
	public $bank_ID ;
	public $bank_name ;
	public $ifscCode ;
	public $accountNo ;
	public $MMID ;
	public $created_at ;
	public $updated_at ;
	public $balance ;
	public $other;
	public $status;
	public $is_active;
	public function ipay_beneficiary() {

	}
}
class ipay_user {
	public $ipay_user_id;
	public $user_id;
	public $merchantUserID;
	public $senderCode;
	public $sender_id;
	public $first_Name;
	public $last_Name;
	public $kyc_Flag;
	public $kyc_status;
	public $mobileNo;
	public $address;
	public $cityName;
	public $stateID;
	public $state_name;
	public $pincode;
	public $addressProofNo;
	public $addressProof;
	public $addressProofUrl;
	public $idProofNo;
	public $idProof;
	public $idProofUrl;
	public $status;
	public $PIN_user;
	public $created_at;
	public $updated_at;
	public $balance;
	public $balance_limit;
	public $other;
	public $is_active;
	public function ipay_user() {

	}
}

class kyc {
	public $kyc_id;
	public $user_id;
	public $document_type;
	public $document_name;
	public $upload_date;
	public $is_active;
	public function kyc() {

	}
}

class notice_board {
	public $notice_board_id;
	public $user_id;
	public $notice_type;
	public $notice_details;
	public $notice_date;
	public $is_active;

	function notice_board() {

	}
}

class notifications {
	public $notification_id;
	public $user_id;
	public $notification;
	public $notification_date;
	public $is_read;
	public $is_active;
	public function notifications() {

	}
}

class payment_mode {
	public $payment_mode_id;
	public $payment_mode;
	public $account_name;
	public $account_number;
	public $ifsc_code;
	public $logo;
	public $is_active;
	public function payment_mode() {

	}
}

class provider_plans {
	public $provider_plan_id;
	public $service_type;
	public $operator_id;
	public $operator;
	public $circle;
	public $plan_type;
	public $price;
	public $details;
	public $validity;
	public $last_update;
	public $is_active;
	public function provider_plans() {

	}
}

class providers {
	public $provider_id;
	public $service_id;
	public $provider;
	public $service;
	public $api_id;
	public $api_name;
	public $logo;
	public $commission_amount;
	public $commission_percentage;
	public $is_active;
	public $gst;
	public $tds;
	public function providers() {

	}
}

class request_money {
	public $request_money_id;
	public $user_id;
	public $cash_credit;
	public $amount;
	public $request_date;
	public $status;
	public $ref_number;
	public $transfer_mode;
	public $transaction_number;
	public $decision_by;
	public $request_to;
	public $decision;
	public $decision_date;
	public $is_active;
	public function request_money() {

	}
}

class route_details {
	public $route_detail_id;
	public $route_type;
	public $user_id;
	public $user_name;
	public $service_id;
	public $service_name;
	public $provider_id;
	public $provider;
	public $amount_check;
	public $amount_from;
	public $amount_to;
	public $plan_id;
	public $plan_name;
	public $api_id;
	public $api_name;
	public $priority;
	public $is_active;

	function route_details() {

	}

}

class routes {
	public $route_id;
	public $route_type;
	public $route_for;
	public $api_1;
	public $api_2;
	public $api_3;
	public $api_1_name;
	public $api_2_name;
	public $api_3_name;
	public $priority;
	public $is_active;

	public function routes() {

	}
}

class service_circles {
	public $service_circle_id;
	public $circle_name;
	public $tiptopmoney_code;
	public $is_active;
	public function service_circles() {

	}
}

class services {
	public $service_id;
	public $service_name;
	public $api_id;
	public $api_name;
	public $colors;
	public $is_active;
	public function services() {

	}
}
class sms_settings {
	public $sms_setting_id;
	public $category;
	public $user_id;
	public $master_distributor;
	public $distributor;
	public $retailer;
	public $api_user;
	public $content;
	public $is_active;
	public $created_at;
	public $updated_at;
	public function sms_settings() {

	}

}
class email_settings {
	public $email_setting_id;
	public $category;
	public $user_id;
	public $master_distributor;
	public $distributor;
	public $retailer;
	public $api_user;
	public $content;
	public $is_active;
	public $created_at;
	public $updated_at;
	public function email_settings() {

	}
}

class site_info {
	public $site_info_id;
	public $site_name;
	public $site_url;
	public $logo;
	public $email;
	public $mobile;
	public $is_active;
	public function site_info() {

	}
}

class template {
	public $template_id;
	public $template_name;
	public $template_photo;
	public $is_active;
	public function template() {

	}
}

class time_diff {
	public $time_diff_id;
	public $user_id;
	public $ctime;
	public $is_active;

	public function time_diff() {

	}
}

class user_mobiles {
	public $user_mobile_id;
	public $mobile_number;
	public $user_name;
	public $provider;
	public $provider_id;
	public $circle;
	public $is_active;
	public function user_mobiles() {

	}
}

class user_plan_service {
	public $user_plan_service_id;
	public $user_plan_id;
	public $service_id;
	public $service_name;
	public $provider_id;
	public $provider_name;
	public $type_dt;
	public $commission_amount_dt;
	public $type_rt;
	public $commission_amount_rt;
	public $is_active;
	public function user_plan_service() {

	}
}

class user_plans {
	public $user_plan_id;
	public $plan_name;
	public $plan_type;
	public $validity;
	public $amount;
	public $api_id;
	public $api_name;
	public $is_active;
	public function user_plans() {

	}
}

class user_types {
	public $user_type_id;
	public $user_type;
	public $is_active;
	public function user_types() {

	}
}

class users {
	public $user_id;
	public $parent_id;
        public $white_label_id;
	public $user_type;
	public $plan_id;
	public $user_name;
	public $name;
	public $gender;
	public $dob;
	public $email;
	public $mobile;
	public $mobile_1;
	public $otp;
	public $mobile_otp;
	public $email_otp;
	public $password;
	public $login_ip;
	public $last_login;
	public $pincode;
	public $district;
	public $state;
	public $user_address;
	public $amount_balance;
	public $commission_amount;
	public $credit_amount;
	public $credit_limit;
	public $profile_pic;
	public $kyc_id;
	public $gst_no;
	public $pancard;
	public $adhaar_card;
	public $company_name;
	public $company_type;
	public $approved_by;
	public $mobile_verified;
	public $email_verified;
	public $route;
	public $commission;
	public $force_logout;
	public $uuid;
	public $kyc_date;
	public $kyc_modal;
	public $multi_api;
	public $tds;
	public $gst;
	public $created_at;
	public $is_active;
	public function users() {

	}
}

class wallet {
	public $wallet_id;
	public $parent_id = 0;
	public $parent_user_id = 0;
	public $api_id = 0;
	public $api_name = "";
	public $user_id = 0;
	public $user_name;
	public $user_1_id = 0;
	public $user_1_name;
	public $transaction_type;
	public $wallet_type;
	public $cash_credit = 'Cash';
	public $api_old_balance = 0;
	public $api_amount = 0;
	public $api_new_balance = 0;
	public $user_old_balance = 0;
	public $total_amount = 0;
	public $amount = 0;
	public $user_new_balance = 0;
	public $transaction_details;
	public $transaction_date;
	public $month_year;
	public $provider_id = 0;
	public $provider_name;
	public $provider_type;
	public $circle_id = 0;
	public $circle_name;
	public $mobile_number;
	public $total_commission;
	public $commission_earned;
	public $profit_earned;
	public $status = 'Pending';
	public $disputed = 'No';
	public $created_at;
	public $updated_at;
	public $ref_number;
	public $api_number;
	public $opid;
	public $comment;
	public $api_response;
	public $gst = 0;
	public $tds = 0;
	public $recharge_path = 'Web';
	public $recharge_url = '';
	public $response_url = '';
	public $call_back_status = '0';
	public $api_call_back_response = '';
	public $ip_address;
	public $is_active = 1;
	public $send_type;
        public $white_label_user_id;
	public function wallet() {

	}
}
class rech_customer {

    public $rech_customer_id;
    public $user_id;
    public $customerMobile;
    public $customerName;
    public $customerPincode;
    public $creditUsed;
    public $other;
    public $otp_status;
    public $is_active;

    function rech_customer() {

    }
    }
class rech_beneficiary {

    public $rech_beneficiary_id;
    public $user_id;
    public $rech_customer_id;
    public $beneficiaryName;
    public $beneficiaryMobileNumber;
    public $beneficiaryAccountNumber;
    public $ifscCode;
    public $beneficiaryId;
    public $otp_status;
    public $other;
    public $is_active;

    function rech_beneficiary() {

    }
}
class dmr_commission{
	public $dmr_commission_id;
	public $start_amount;
	public $end_amount;
	public $dmr_type;
	public $commission_value;
	public $is_active;

	function dmr_commission(){

	}

}
class userServices {
	public $userService_id;
	public $user_id;
	public $prepaid_service;
	public $postpaid_service;
	public $landline_service;
	public $dth_service;
	public $electricity_service;
	public $dmr_service;
	public $other;
	public $created_on;
	public $is_active;
	public function userServices() {

	}
}
class sms_report {
	public $sms_report_id;
	public $api_id;
	public $api_name;
	public $mobile_no;
	public $message;
	public $response_sms_api;
	public $created_at;
	public $is_active;
	public function sms_report() {

	}
}

class white_label {

    public $white_label_user_id;
    public $user_id;
    public $user_name;
    public $website;
    public $web_url;
    public $color;
    public $address;
    public $email;
    public $mobile;
    public $created_at;
    public $is_active;
    public $img_logo;

    function white_label() {

    }
    }
    class color_combinations {
    public $color_id;
    public $color_combinations;
    public $css_field;
    public $is_active;

    function color_combinations() {

    }
    }


?>
