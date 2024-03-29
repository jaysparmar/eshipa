<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT, PATCH, DELETE");
header("Access-Control-Allow-Methods: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method , Authorization');
header("Content-Type: application/json");
// header("Expires: 0");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

/*

    ---------------------------------------------------------------------------
    Defined Methods:-
    ---------------------------------------------------------------------------

    1. login
    2. update_fcm
    3. reset_password
    4. get_login_identity
    5. verify_user
    6. register_user
    7. update_user
    8. is_city_deliverable
    9. get_slider_images
    10. get_offer_images
    11. get_categories
    12. get_cities
    13. get_products
    14. validate_promo_code
    15. get_partners
    16. add_address
    17. update_address
    18. get_address
    19. delete_address
    20. get_settings
    21. place_order
    22. get_orders
    23. set_product_rating
    24. delete_product_rating
    25. get_product_rating
    26. manage_cart(Add/Update)
    27. get_user_cart
    28. add_to_favorites
    29. remove_from_favorites
    30. get_favorites
    31. get_notifications
    32. update_order_status
    33. add_transaction
    34. get_sections
    35. transactions
    36. delete_order
    37. get_ticket_types
    38. add_ticket
    39. edit_ticket
    40. send_message
    41. get_tickets
    42. get_messages
    43. set_rider_rating
    44. get_rider_rating
    45. delete_rider_rating
    46. get_promo_codes
    47. remove_from_cart

    Payment Method APIs
        48. make_payments
            -get_paypal_link
            -paypal_transaction_webview
            -app_payment_status
            -ipn
        49. stripe_webhook
        50. generate_paytm_checksum
        51. generate_paytm_txn_token
        52. validate_paytm_checksum
        53. validate_refer_code
        54. flutterwave_webview
        55. flutterwave_payment_response

    56. get_live_tracking_details
    57. delete_my_account
    58. payment_intent
    58. get_languages
    59. set_order_rating
    60. delete_order_rating
    61. get_order_rating
    62. get_partner_ratings
    63. re_order
    64. get_customers
    65. share_wallet_balance
    66. update_partner - To register as a partner from customer APP
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------

*/
class Api extends CI_Controller
{

    /**
     *   @var array $excluded_routes is an array of uri strings which we want to exclude from jwt verification.
     */
    protected $excluded_routes =
    [
        "app/v1/api/index",
        "app/v1/api",
        "app/v1/api/login",
        // "app/v1/api/reset_password",
        // "app/v1/api/get_login_identity",
        // "app/v1/api/verify_user",
        "app/v1/api/register_user",
        "app/v1/api/is_city_deliverable",
        "app/v1/api/get_slider_images",
        "app/v1/api/get_offer_images",
        "app/v1/api/get_categories",
        "app/v1/api/get_products",
        "app/v1/api/get_partners",
        "app/v1/api/get_settings",
        "app/v1/api/is_order_deliverable",
        // "app/v1/api/update_fcm",
        "app/v1/api/get_product_rating",
        // "app/v1/api/validate_promo_code",
        "app/v1/api/get_notifications",
        "app/v1/api/get_sections",
        // "app/v1/api/get_ticket_types",
        "app/v1/api/stripe_webhook",
        // "app/v1/api/get_promo_codes",
        // "app/v1/api/search_places",
        // "app/v1/api/get_address",
        // "app/v1/api/add_address",
        // "app/v1/api/update_address",
        // "app/v1/api/delete_address",
        // "app/v1/api/update_user",
        "app/v1/api/validate_refer_code",
        "app/v1/api/manage_cart",
        // "app/v1/api/get_user_cart",
        // "app/v1/api/add_ticket",
        // "app/v1/api/edit_ticket",
        // "app/v1/api/send_message",
        // "app/v1/api/get_tickets",
        // "app/v1/api/remove_from_cart",
        // "app/v1/api/get_favorites",
        // "app/v1/api/add_to_favorites",
        // "app/v1/api/remove_from_favorites",
        // "app/v1/api/payment_intent",
        "app/v1/api/get_languages",
        // "app/v1/api/get_orders",
        // "app/v1/api/razorpay_webhook",
        // "app/v1/api/add_transaction",
        // "app/v1/api/update_order_status",
        // "app/v1/api/transactions",
        "app/v1/api/place_order",
        "app/v1/api/sign_up",
        "app/v1/api/get_cities",
        "app/v1/api/get_faqs",
        // "app/v1/api/get_withdrawal_request",
        // "app/v1/api/send_withdrawal_request",
        // "app/v1/api/get_delivery_charges",
        // "app/v1/api/set_product_rating",
        // "app/v1/api/set_order_rating",
        // "app/v1/api/delete_product_rating",
        // "app/v1/api/delete_order_rating",
        // "app/v1/api/get_messages",
        // "app/v1/api/set_rider_rating",
        // "app/v1/api/delete_rider_rating",
        // "app/v1/api/payment_intent",
        // "app/v1/api/generate_paytm_checksum",
        // "app/v1/api/generate_paytm_txn_token",
        // "app/v1/api/validate_paytm_checksum",
        // "app/v1/api/flutterwave_webview",
        // "app/v1/api/flutterwave_payment_response",
        // "app/v1/api/get_paypal_link",
        // "app/v1/api/paypal_transaction_webview",
        // "app/v1/api/app_payment_status",
        // "app/v1/api/get_live_tracking_details",
        // "app/v1/api/ipn",
        // "app/v1/api/delete_my_account",
        // "app/v1/api/get_partner_ratings",
        // "app/v1/api/razorpay_create_order",
        // "app/v1/api/get_rider_rating",
        // "app/v1/api/get_order_rating",
        // "app/v1/api/delete_order",
        // "app/v1/api/create_midtrans_transaction",
        // "app/v1/api/get_midtrans_transaction_status",
        "app/v1/api/midtrans_payment_process",
        // "app/v1/api/midtrans_wallet_transaction",
        "app/v1/api/midtrans_webhook",
        // "app/v1/api/re_order",
        "app/v1/api/update_partner",
        // "app/v1/api/test",
    ];
    private  $user_details = [];
    private  $allowed_settings = ["general_settings", "terms_conditions", "privacy_policy", "about_us", 'payment_gateways_settings'];
    private  $user_data = [
        'id', 'username', 'mobile', 'email', 'fcm_id', 'image', 'latitude', 'longitude', 'friends_code', 'referral_code',
        'city', 'serviceable_city', 'country_code', 'cash_received', 'commission', 'commission_method', 'active', 'no_of_ratings', 'rating', 'balance'
    ];



    public function __construct()
    {
        parent::__construct();
        header("Content-Type: application/json");
        header("Expires: 0");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $this->load->library(['upload', 'ion_auth', 'form_validation', 'paypal_lib']);
        $this->load->model(['Customer_model', 'category_model', 'order_model', 'rating_model', 'Area_model', 'cart_model', 'address_model', 'Transaction_model', 'ticket_model', 'Order_model', 'notification_model', 'faq_model', 'Partner_model', 'Promo_code_model', 'Rider_model']);
        $this->load->helper(['language', 'string', 'function']);
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');

        // date_default_timezone_set('America/New_York');
        $response = $temp = $bulkdata = array();
        $this->identity_column = $this->config->item('identity', 'ion_auth');

        // initialize db tables data
        $this->tables = $this->config->item('tables', 'ion_auth');

        $this->_check_cors();

        $current_uri =  uri_string();
        if (!in_array($current_uri, $this->excluded_routes)) {
            $token = verify_app_request();
            if ($token['error']) {
                header('Content-Type: application/json');
                http_response_code($token['status']);
                print_r(json_encode($token));
                die();
            }
            $this->user_details = $token['data'];
        }
    }

    /**
     * Checks allowed domains, and adds appropriate headers for HTTP access control (CORS)
     *
     * @access protected
     * @return void
     */
    protected function _check_cors()
    {

        /*
        |--------------------------------------------------------------------------
        | CORS Allowable Headers
        |--------------------------------------------------------------------------
        |
        | If using CORS checks, set the allowable headers here
        |
        */
        $allowed_cors_origins = [];
        $allowed_cors_headers = [
            'Origin',
            'X-Requested-With',
            'Content-Type',
            'Accept',
            'Access-Control-Request-Method',
            'Authorization',
        ];

        /*
        |--------------------------------------------------------------------------
        | CORS Allowable Methods
        |--------------------------------------------------------------------------
        |
        | If using CORS checks, you can set the methods you want to be allowed
        |
        */
        $allowed_cors_methods = [
            'GET',
            'POST',
            'OPTIONS',
            'PUT',
            'PATCH',
            'DELETE'
        ];
        // Convert the config items into strings
        $allowed_headers = implode(' ,', $allowed_cors_headers);
        $allowed_methods = implode(' ,', $allowed_cors_methods);

        // If we want to allow any domain to access the API
        if ($this->config->item('allow_any_cors_domain') === TRUE) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: ' . $allowed_headers);
            header('Access-Control-Allow-Methods: ' . $allowed_methods);
        } else {
            // We're going to allow only certain domains access
            // Store the HTTP Origin header
            $origin = $this->input->server('HTTP_ORIGIN');
            if ($origin === NULL) {
                $origin = '';
            }

            // If the origin domain is in the allowed_cors_origins list, then add the Access Control headers
            if (in_array($origin, $allowed_cors_origins)) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Headers: ' . $allowed_headers);
                header('Access-Control-Allow-Methods: ' . $allowed_methods);
            }
        }

        // If the request HTTP method is 'OPTIONS', kill the response and send it to the client
        if ($this->input->method() === 'options') {
            exit;
        }
    }


    public function index()
    {
        $this->load->helper('file');
        $this->output->set_content_type(get_mime_by_extension(base_url('api-doc.txt')));
        $this->output->set_output(file_get_contents(base_url('api-doc.txt')));
    }

    public function login()
    {
        /* Parameters to be passed
            mobile: 9874565478
            fcm_id: FCM_ID
        */
        $identity_column = $this->config->item('identity', 'ion_auth');
        if ($identity_column == 'mobile') {
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|required|xss_clean');
        } elseif ($identity_column == 'email') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        } else {
            $this->form_validation->set_rules('identity', 'Identity', 'trim|required|xss_clean');
        }

        $this->form_validation->set_rules('fcm_id', 'FCM ID', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            print_r(json_encode($this->response));
            return false;
        }

        if (is_exist(['mobile' => $this->input->post('mobile')], 'users')) {
            if (isset($_POST['fcm_id']) && !empty($_POST['fcm_id'])) {
                update_details(['fcm_id' => $_POST['fcm_id']], ['mobile' => $_POST['mobile']], 'users');
            }

            /** set user jwt token  */
            $token = generate_tokens($this->input->post('mobile'));
            update_details(['apikey' => $token], ['mobile' => $this->input->post('mobile')], "users");

            $data = fetch_details(['mobile' => $this->input->post('mobile', true)], 'users');
            unset($data[0]['password']);
            unset($data[0]['apikey']);

            if (empty($data[0]['image']) || file_exists(FCPATH . USER_IMG_PATH . $data[0]['image']) == FALSE) {
                $data[0]['image'] = base_url() . NO_IMAGE;
            } else {
                $data[0]['image'] = base_url() . USER_IMG_PATH . $data[0]['image'];
            }
            $data = array_map(function ($value) {
                return $value === NULL ? "" : $value;
            }, $data[0]);
            //if the login is successful
            $response['error'] = false;
            $response['token'] = $token;
            $response['message'] = "User login successfully";
            $response['data'] = $data;
            echo json_encode($response);
            return false;
        } else {
            $response['error'] = true;
            $response['message'] = 'User does not exists !';
            $response['data'] = array();
            echo json_encode($response);
            return false;
        }
    }

    public function update_fcm()
    {
        /* Parameters to be passed
            user_id:12
            fcm_id: FCM_ID
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', ' User Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('fcm_id', 'Fcm Id', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            print_r(json_encode($this->response));
            return false;
        }

        if (isset($_POST['fcm_id']) && $_POST['fcm_id'] != NULL && !empty($_POST['fcm_id'])) {
            $user_res = update_details(['fcm_id' => $_POST['fcm_id']], ['id' => $_POST['user_id']], 'users');
            if ($user_res) {
                $response['error'] = false;
                $response['message'] = 'Updated Successfully';
                $response['data'] = array();
                echo json_encode($response);
                return false;
            } else {
                $response['error'] = true;
                $response['message'] = 'Updation Failed !';
                $response['data'] = array();
                echo json_encode($response);
                return false;
            }
        }
    }


    public function get_login_identity()
    {
        if (!verify_tokens()) {
            return false;
        }
        $response['error'] = false;
        $response['message'] = 'Data Retrieved Successfully';
        $response['data'] = array('identity' => $this->config->item('identity', 'ion_auth'));
        echo json_encode($response);
        return false;
    }

    public function verify_user()
    {

        /* Parameters to be passed
            mobile: 9874565478
            email: test@gmail.com 
        */
        if (!verify_tokens()) {
            return false;
        }
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            if (isset($_POST['mobile']) && is_exist(['mobile' => $_POST['mobile']], 'users')) {
                $this->response['error'] = true;
                $this->response['message'] = 'Mobile is already registered.Please login again !';
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return;
            }
            if (isset($_POST['email']) && is_exist(['email' => $_POST['email']], 'users')) {
                $this->response['error'] = true;
                $this->response['message'] = 'Email is already registered.Please login again !';
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return;
            }

            $this->response['error'] = false;
            $this->response['message'] = 'Ready to sent OTP request!';
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        }
    }

    public function register_user()
    {
        // if (!verify_tokens()) {
        //     return false;
        // }

        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Mail', 'trim|required|xss_clean|valid_email|is_unique[users.email]', array('is_unique' => ' The email is already registered . Please login'));
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|max_length[16]|numeric|is_unique[users.mobile]', array('is_unique' => ' The mobile number is already registered . Please login'));
        $this->form_validation->set_rules('country_code', 'Country Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fcm_id', 'Fcm Id', 'trim|xss_clean');
        $this->form_validation->set_rules('referral_code', 'Referral code', 'trim|required|is_unique[users.referral_code]|xss_clean');
        $this->form_validation->set_rules('friends_code', 'Friends code', 'trim|xss_clean');
        $this->form_validation->set_rules('latitude', 'Latitude', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('longitude', 'Longitude', 'trim|xss_clean|numeric');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            if (isset($_POST['friends_code']) && !empty($_POST['friends_code'])) {
                $friends_code = $_POST['friends_code'];
                $friend = fetch_details(['referral_code' => $friends_code], 'users', '*');
                if (empty($friend)) {
                    $response["error"]   = true;
                    $response["message"] = "Invalid friends code! Please pass the valid referral code of the inviter";
                    $response["data"] = [];
                    echo json_encode($response);
                    return false;
                }
            }

            $identity_column = $this->config->item('identity', 'ion_auth');

            $email = strtolower($this->input->post('email'));
            $mobile = $this->input->post('mobile');
            $identity = ($identity_column == 'mobile') ? $mobile : $email;
            // $password = $this->input->post('password');

            $additional_data = [
                'username' => $this->input->post('name'),
                'mobile' => $this->input->post('mobile'),
                'country_code' => $this->input->post('country_code'),
                'fcm_id' => $this->input->post('fcm_id'),
                'referral_code' => $this->input->post('referral_code', true),
                'friends_code' => $this->input->post('friends_code', true),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'active' => 1
            ];

            $res = $this->ion_auth->register($identity, '123@123$123', $email, $additional_data, ['2']);
            if ($res != FALSE) {
                /** set user jwt token  */
                $token = generate_tokens($this->input->post('mobile'));
                update_details(['apikey' => $token], ['mobile' => $this->input->post('mobile')], "users");

                update_details(['active' => 1], [$identity_column => $identity], 'users');

                $data = fetch_details([$identity_column => $identity], 'users');
                unset($data[0]['password']);
                unset($data[0]['apikey']);

                $data = array_map(function ($value) {
                    return $value === NULL ? "" : $value;
                }, $data[0]);

                $this->response['error'] = false;
                $this->response['token'] = $token;
                $this->response['message'] = 'Registered Successfully';
                $this->response['data'] = $data;
            } else {
                $this->response['error'] = true;
                $this->response['message'] = 'Registered Faild';
                $this->response['data'] = array();
            }
        }
        print_r(json_encode($this->response));
    }

    public function update_user()
    {
        /*
            user_id:34
            username:hiten                 {optional}
            mobile:7852347890              {optional}
            email:amangoswami@gmail.com	   {optional}
            image:[]                       {optional}
            referral_code:Userscode        {optional}
        */
        if (!verify_tokens()) {
            return false;
        }
        if (defined('ALLOW_MODIFICATION') && ALLOW_MODIFICATION == 0 && $_POST['user_id'] == "1") {
            $this->response['error'] = true;
            $this->response['message'] = DEMO_VERSION_MSG;
            echo json_encode($this->response);
            return false;
            exit();
        }

        $identity_column = $this->config->item('identity', 'ion_auth');

        $this->form_validation->set_rules('user_id', 'Id', 'required|xss_clean|numeric|trim');
        $this->form_validation->set_rules('email', 'Email', 'xss_clean|trim|valid_email|edit_unique[users.id.' . $this->input->post('user_id', true) . ']');
        $this->form_validation->set_rules('username', 'Username', 'xss_clean|trim');
        $this->form_validation->set_rules('referral_code', 'Referral code', 'trim|xss_clean');
        $this->form_validation->set_rules('image', 'Profile Image', 'trim|xss_clean');

        // if (!empty($_POST['old']) || !empty($_POST['new'])) {
        //     $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        //     $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[6]');
        // }

        $tables = $this->config->item('tables', 'ion_auth');
        if (!$this->form_validation->run()) {
            if (validation_errors()) {
                $response['error'] = true;
                $response['message'] = validation_errors();
                echo json_encode($response);
                return false;
                exit();
            }
        } else {
            if ((isset($_POST['email']) && !empty($_POST['email'])) || (isset($_POST['mobile']) && !empty($_POST['mobile']))) {
                if (!edit_unique($this->input->post('email', true), 'users.email.' . $this->input->post('user_id', true) . '') || !edit_unique($this->input->post('mobile', true), 'users.mobile.' . $this->input->post('user_id', true) . '')) {
                    $response["error"]   = true;
                    $response["message"] = "Email or mobile already exists !";
                    $response["data"] = array();
                    echo json_encode($response);
                    return false;
                }
            }
            // if (!empty($_POST['old']) || !empty($_POST['new'])) {
            //     $identity = ($identity_column == 'mobile') ? 'mobile' : 'email';
            //     $res = fetch_details(['id' => $_POST['user_id']], 'users', $identity);
            //     if (!empty($res)) {
            //         if (!$this->ion_auth->change_password($res[0][$identity], $this->input->post('old'), $this->input->post('new'))) {

            //             // if the login was un-successful
            //             $response['error'] = true;
            //             $response['message'] = strip_tags($this->ion_auth->errors());
            //             echo json_encode($response);
            //             return;
            //         } else {
            //             $user_details = fetch_details(['id' => $_POST['user_id']], 'users', "*");

            //             if (empty($user_details[0]['image']) || file_exists(FCPATH . USER_IMG_PATH . $user_details[0]['image']) == FALSE) {
            //                 $user_details[0]['image'] = base_url() . NO_IMAGE;
            //             } else {
            //                 $user_details[0]['image'] = base_url() . USER_IMG_PATH . $user_details[0]['image'];
            //             }
            //             $user_details[0]['image_sm'] = get_image_url(base_url() . USER_IMG_PATH . $user_details[0]['image'], 'thumb', 'sm');
            //             $user_details = array_map(function ($value) {
            //                 return $value === NULL ? "" : $value;
            //             }, $user_details[0]);

            //             $response['error'] = false;
            //             $response['message'] = 'Password Update Succesfully';
            //             $response['data'] = $user_details;
            //             echo json_encode($response);
            //             return;
            //         }
            //     } else {
            //         $response['error'] = true;
            //         $response['message'] = 'User not exists';
            //         echo json_encode($response);
            //         return;
            //     }
            // }

            $is_updated = false;
            /* update referral_code if it is empty in user's database */
            if (isset($_POST['referral_code']) && !empty($_POST['referral_code'])) {
                $user = fetch_details(['id' => $_POST['user_id']], 'users', "referral_code");
                if (empty($user[0]['referral_code'])) {
                    update_details(['referral_code' => $_POST['referral_code']], ['id' => $_POST['user_id']], "users");
                    $is_updated = true;
                }
            }

            if (!file_exists(FCPATH . USER_IMG_PATH)) {
                mkdir(FCPATH . USER_IMG_PATH);
            }

            $config = [
                'upload_path' =>  FCPATH . USER_IMG_PATH,
                'allowed_types' => 'jpeg|gif|jpg|png',
            ];

            $image_new_name = '';
            $image_info_error = '';

            if (!empty($_FILES['image']['name']) && isset($_FILES['image']['name'])) {
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {
                    $image_data = $this->upload->data();
                    $image_new_name = $image_data['file_name'];
                    resize_image($image_data, FCPATH . USER_IMG_PATH);
                } else {
                    $image_info_error = 'Profile Image :' . $this->upload->display_errors();
                }

                if ($image_info_error != NULL || !$this->form_validation->run()) {
                    if (isset($image_new_name) && $image_new_name != NULL) {
                        unlink(FCPATH . USER_IMG_PATH . $image_new_name);
                    }
                }
            }

            if (isset($image_info_error) && !empty($image_info_error)) {
                $response['error'] = true;
                $response['message'] = $image_info_error;
                echo json_encode($response);
                return;
            }

            $set = [];
            if (isset($_POST['username']) && !empty($_POST['username'])) {
                $set['username'] = $this->input->post('username', true);
            }
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $set['email'] = $this->input->post('email', true);
            }
            if (isset($_POST['mobile']) && !empty($_POST['mobile'])) {
                $set['mobile'] = $this->input->post('mobile', true);
            }

            if (!empty($_FILES['image']['name']) && isset($_FILES['image']['name'])) {
                $set['image'] = $image_new_name;
            }

            if (!empty($set)) {
                $set = escape_array($set);
                $this->db->set($set)->where('id', $_POST['user_id'])->update($tables['login_users']);
                $user_details = fetch_details(['id' => $_POST['user_id']], 'users', "*");
                if (empty($user_details[0]['image']) || file_exists(FCPATH . USER_IMG_PATH . $user_details[0]['image']) == FALSE) {
                    $user_details[0]['image'] = base_url() . NO_IMAGE;
                    $user_details[0]['image_sm'] = base_url() . NO_IMAGE;
                } else {
                    $user_details[0]['image'] = base_url() . USER_IMG_PATH . $user_details[0]['image'];
                    $user_details[0]['image_sm'] = get_image_url(base_url() . USER_IMG_PATH . $user_details[0]['image'], 'thumb', 'sm');
                }

                $user_details = array_map(function ($value) {
                    return $value === NULL ? "" : $value;
                }, $user_details[0]);
                $response['error'] = false;
                $response['message'] = 'Profile Update Succesfully';
                $response['data'] = $user_details;
                echo json_encode($response);
                return;
            } else if ($is_updated == true) {
                $user_details = fetch_details(['id' => $_POST['user_id']], 'users', "*");
                if (empty($user_details[0]['image']) || file_exists(FCPATH . USER_IMG_PATH . $user_details[0]['image']) == FALSE) {
                    $user_details[0]['image'] = base_url() . NO_IMAGE;
                    $user_details[0]['image_sm'] = base_url() . NO_IMAGE;
                } else {
                    $user_details[0]['image'] = base_url() . USER_IMG_PATH . $user_details[0]['image'];
                    $user_details[0]['image_sm'] = get_image_url(base_url() . USER_IMG_PATH . $user_details[0]['image'], 'thumb', 'sm');
                }

                $user_details = array_map(function ($value) {
                    return $value === NULL ? "" : $value;
                }, $user_details[0]);
                $response['error'] = false;
                $response['message'] = 'Referel Code Update Succesfully';
                $response['data'] = $user_details;
                echo json_encode($response);
                return;
            }
        }
    }

    // is_city_deliverable
    public function is_city_deliverable()
    {
        /*
        32. is_city_deliverable
            id:1    // {optional} 
            name:bhuj  // {optional}
        */
        $this->form_validation->set_rules('id', 'Id', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');

        // if (!verify_tokens()) {
        //     return false;
        // }

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = validation_errors();
            $this->response['data'] = array();
            echo json_encode($this->response);
            return false;
        } else {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $type = "id";
                $value = $this->input->post('id', true);
            }
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $type = "name";
                $value = $this->input->post('name', true);
            }

            if (!is_exist([$type => $value], 'cities')) {
                $this->response['error'] = true;
                $this->response['message'] = "Sorry! We do not delivery food at the selected city!";
                $this->response['data'] = array();
                echo json_encode($this->response);
                return false;
            } else {
                /** check if it has sub city to deliver */

                $city = fetch_details([$type => $value], "cities", "id");
                $this->response['error'] = false;
                $this->response['message'] = 'City is delivarable.';
                $this->response['city_id'] = $city[0]['id'];
                $this->response['data'] = array();
                echo json_encode($this->response);
                return false;
            }
        }
    }

    public function get_slider_images()
    {
        // if (!verify_tokens()) {
        //     return false;
        // }

        $res = fetch_details('', 'sliders');
        $i = 0;
        foreach ($res as $row) {
            $res[$i]['image'] = base_url($res[$i]['image']);

            if (strtolower($res[$i]['type']) == 'categories') {
                $id = (!empty($res[$i]['type_id']) && isset($res[$i]['type_id'])) ? $res[$i]['type_id'] : '';
                $cat_res = $this->category_model->get_categories($id);
                $res[$i]['data']  =  $cat_res;
            } else if (strtolower($res[$i]['type']) == 'products') {
                $id = (!empty($res[$i]['type_id']) && isset($res[$i]['type_id'])) ? $res[$i]['type_id'] : '';
                $pro_res = fetch_product(NULL, NULL, $id);
                $res[$i]['data']  =  $pro_res['product'];
            } else {
                $res[$i]['data']  =  [];
            }

            $i++;
        }
        $this->response['error'] = false;
        $this->response['data'] = $res;
        print_r(json_encode($this->response));
    }

    public function get_offer_images()
    {
        // if (!verify_tokens()) {
        //     return false;
        // }
        $res = fetch_details('', 'offers');
        $i = 0;
        foreach ($res as $row) {
            $res[$i]['image'] = base_url($res[$i]['image']);
            $res[$i]['banner_image'] = isset($res[$i]['banner']) && !empty($res[$i]['banner']) ? base_url($res[$i]['banner']) : "";

            if (strtolower($res[$i]['type']) == 'categories') {
                $id = (!empty($res[$i]['type_id']) && isset($res[$i]['type_id'])) ? $res[$i]['type_id'] : '';
                $cat_res = $this->category_model->get_categories($id);
                $res[$i]['data']  =  $cat_res;
            } else if (strtolower($res[$i]['type']) == 'products') {
                $id = (!empty($res[$i]['type_id']) && isset($res[$i]['type_id'])) ? $res[$i]['type_id'] : '';
                $pro_res = fetch_product(NULL, NULL, $id);
                $res[$i]['data']  =  $pro_res['product'];
            } else {
                $res[$i]['data']  =  [];
            }

            $i++;
        }
        $this->response['error'] = false;
        $this->response['data'] = $res;
        print_r(json_encode($this->response));
    }

    public function get_categories()
    {
        /*
            id:15               // optional
            limit:25            // { default - 25 } optional
            offset:0            // { default - 0 } optional
            sort:               id / name
                                // { default -row_id } optional
            order:DESC/ASC      // { default - ASC } optional
            search:value        // { optional }
        */
        // if (!verify_tokens()) {
        //     return false;
        // }

        $this->form_validation->set_rules('id', 'Category Id', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        $this->form_validation->set_rules('search', 'search', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        }
        $limit = (isset($_POST['limit'])  && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
        $offset = (isset($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
        $sort = (isset($_POST['sort(array)']) && !empty(trim($_POST['sort']))) ? $this->input->post('sort', true) : 'row_order';
        $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $this->input->post('order', true) : 'ASC';
        $search = (isset($_POST['search']) && !empty(trim($_POST['search']))) ? $this->input->post('search', true) : null;
        $partner_slug = (isset($_POST['partner_slug']) && !empty(trim($_POST['partner_slug']))) ? $this->input->post('partner_slug', true) : null;
        $this->response['message'] = "Cateogry(s) retrieved successfully!";
        $id = (!empty($_POST['id']) && isset($_POST['id'])) ? $_POST['id'] : '';
        $cat_res = $this->category_model->get_categories($id, "", "", "", $order, "false", "", "", $search, $partner_slug);
        $popular_categories = $this->category_model->get_categories(NULL, "", "", 'clicks', 'DESC', 'false', "", "", "");

        $this->response['error'] = (empty($cat_res)) ? true : false;
        $this->response['total'] = !empty($cat_res) ? $cat_res[0]['total'] : 0;
        $this->response['message'] = (empty($cat_res)) ? 'Category does not exist' : 'Category retrieved successfully';
        $this->response['data'] = $cat_res;
        $this->response['popular_categories'] = $popular_categories;

        print_r(json_encode($this->response));
    }

    //3.get_cities
    public function get_cities()
    {
        /*
           sort:               // { c.name / c.id } optional
           order:DESC/ASC      // { default - ASC } optional
           search:value        // {optional} 
           limit:10            // {pass default limit for city list}{default : 25}
           offset:0            // {optional default :0}
       */
        // if (!verify_tokens()) {
        //     return false;
        // }
        $this->form_validation->set_rules('sort', 'sort', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        $this->form_validation->set_rules('search', 'search', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $this->input->post('sort', true) : 'c.name';
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $this->input->post('order', true) : 'ASC';
            $search = (isset($_POST['search']) && !empty(trim($_POST['search']))) ? $this->input->post('search', true) : "";
            $limit = (isset($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
            $offset = (isset($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;

            $result = $this->Area_model->get_cities($sort, $order, $search, $limit, $offset);
            print_r(json_encode($result));
        }
    }

    /* 4.get_products

        id:101              // optional
        category_id:29      // optional
        user_id:15          // optional
        search:keyword      // optional   // search by product name and highlights
        tags:multiword tag1, tag2, another tag      // optional {search by restro and product tags}
        highlights:multiword tag1, tag2, another tag      // optional
        attribute_value_ids : 34,23,12 // { Use only for filteration } optional
        limit:25            // { default - 25 } optional
        offset:0            // { default - 0 } optional
        sort:p.id / p.date_added / pv.price
                            { default - p.id } optional
        order:DESC/ASC      // { default - DESC } optional
        top_rated_foods: 1 // { default - 0 } optional
        discount: 5             // optional
        min_price:10000          // optional
        max_price:50000          // optional
        partner_id:1255           //{optional}
        product_ids: 19,20             // optional
        product_variant_ids: 44,45,40             // optional
        vegetarian:1|2|3             //{optional -> 1 - veg | 2 - non-veg | 3 - Both}
        filter_by:p.id|sd.user_id       // {p.id = product list | sd.user_id = partner list}            
                             { default - sd.user_id } optional      
        latitude:123                 // {optional}
        longitude:123                // {optional}
    */

    public function get_products()
    {
        // if (!verify_tokens()) {
        //     return false;
        // }

        $this->form_validation->set_rules('id', 'Product ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('vegetarian', 'vegetarian', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('search', 'Search', 'trim|xss_clean');
        $this->form_validation->set_rules('category_id', 'Category id', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('barcode', 'Barcode', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('partner_id', 'partner id', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('attribute_value_ids', 'Attr Ids', 'trim|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean|alpha');
        $this->form_validation->set_rules('top_rated_foods', ' Top Rated Foods ', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('min_price', ' Min Price ', 'trim|xss_clean|numeric|less_than_equal_to[' . $this->input->post('max_price') . ']');
        $this->form_validation->set_rules('max_price', ' Max Price ', 'trim|xss_clean|numeric|greater_than_equal_to[' . $this->input->post('min_price') . ']');
        $this->form_validation->set_rules('discount', ' Discount ', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('filter_by', ' filter_by ', 'trim|xss_clean');
        $this->form_validation->set_rules('latitude', 'latitude', 'trim|xss_clean');
        $this->form_validation->set_rules('longitude', 'longitude', 'trim|xss_clean');
        $this->form_validation->set_rules('city_id', 'city_id', 'trim|xss_clean');
        $this->form_validation->set_rules('slug', 'slug', 'trim|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            if (isset($_POST['latitude']) && !empty($_POST['latitude']) && empty($_POST['longitude'])) {
                $this->response['error'] = true;
                $this->response['message'] = "The Longitude Field is Required";
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return;
            }
            if (isset($_POST['longitude']) && !empty($_POST['longitude']) && empty($_POST['latitude'])) {
                $this->response['error'] = true;
                $this->response['message'] = "The Latitude Field is Required";
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return;
            }
            $filters['longitude'] = (isset($_POST['longitude']) && !empty($_POST['longitude'])) ? $this->input->post("longitude", true) : 0;
            $filters['latitude'] = (isset($_POST['latitude']) && !empty($_POST['latitude'])) ? $this->input->post("latitude", true) : 0;
            $filters['city_id'] = (isset($_POST['city_id']) && !empty($_POST['city_id'])) ? $this->input->post("city_id", true) : 0;
            $filters['partner_slug'] = (isset($_POST['partner_slug']) && !empty($_POST['partner_slug'])) ? $this->input->post("partner_slug", true) : "";
            $filters['category_slug'] = (isset($_POST['category_slug']) && !empty($_POST['category_slug'])) ? $this->input->post("category_slug", true) : "";
            $limit = (isset($_POST['limit'])) ? $this->input->post('limit', true) : 40;
            $offset = (isset($_POST['offset'])) ? $this->input->post('offset', true) : 0;
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $_POST['order'] : 'ASC';
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $_POST['sort'] : 'p.row_order';
            $partner_id = (isset($_POST['partner_id']) && !empty(trim($_POST['partner_id']))) ?  $this->input->post('partner_id', true) : NULL;
            $filters['search'] =  (isset($_POST['search'])) ? $_POST['search'] : null;
            $filters['tags'] =  (isset($_POST['tags'])) ? $_POST['tags'] : "";
            $filters['highlights'] =  (isset($_POST['highlights'])) ? $_POST['highlights'] : "";
            $filters['attribute_value_ids'] = (isset($_POST['attribute_value_ids'])) ? $_POST['attribute_value_ids'] : null;
            $filters['is_similar_products'] = (isset($_POST['is_similar_products'])) ? $_POST['is_similar_products'] : null;
            $filters['vegetarian'] = (isset($_POST['vegetarian'])) ? $this->input->post("vegetarian", true) : null;
            $filters['discount'] = (isset($_POST['discount'])) ? $_POST['discount'] : 0;
            $filters['product_type'] = (isset($_POST['top_rated_foods']) && $_POST['top_rated_foods'] == 1) ? 'top_rated_foods_including_all_foods' : null;
            $filters['min_price'] = (isset($_POST['min_price']) && !empty($_POST['min_price'])) ? $this->input->post("min_price", true) : 0;
            $filters['max_price'] = (isset($_POST['max_price']) && !empty($_POST['max_price'])) ? $this->input->post("max_price", true) : 0;
            $filter_by = (isset($_POST['filter_by']) && !empty($_POST['filter_by'])) ? $this->input->post("filter_by", true) : 'sd.user_id';

            $category_id = (isset($_POST['category_id'])) ? $_POST['category_id'] : null;
            $barcode = (isset($_POST['barcode'])) ?  $this->input->post('barcode', true)  : null;
            $product_id = (isset($_POST['id'])) ? $_POST['id'] : null;
            $product_ids = (isset($_POST['product_ids'])) ? $_POST['product_ids'] : null;
            $product_variant_ids = (isset($_POST['product_variant_ids']) && !empty($_POST['product_variant_ids'])) ? $this->input->post("product_variant_ids", true) : null;
            if ($product_ids != null) {
                $product_id = explode(",", $product_ids);
            }
            if ($product_variant_ids != null) {
                $filters['product_variant_ids'] = explode(",", $product_variant_ids);
            }
            $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : null;

            $products = fetch_product($user_id, (isset($filters)) ? $filters : null, $product_id, $category_id, $limit, $offset, $sort, $order, null, null, $partner_id, $filter_by, $barcode);

            $final_total = "0";
            if (isset($filters['discount']) && !empty($filters['discount'])) {
                $final_total = (isset($products['product'][0]['total']) && !empty($products['product'][0]['total'])) ? $products['product'][0]['total'] : "";
            } else {
                $final_total = (isset($products['total'])) ? strval($products['total']) : '';
            }

            if (!empty($products['product'])) {

                $this->response['error'] = false;
                $this->response['message'] = "Products retrieved successfully !";
                $this->response['min_price'] = (isset($products['min_price']) && !empty($products['min_price'])) ? strval($products['min_price']) : 0;
                $this->response['max_price'] = (isset($products['max_price']) && !empty($products['max_price'])) ? strval($products['max_price']) : 0;
                $this->response['search'] = (isset($_POST['search'])) ? $this->input->post("search", true) : "";
                $this->response['filters'] = (isset($products['filters']) && !empty($products['filters'])) ? $products['filters'] : [];
                $this->response['categories'] = (isset($products['categories']) && !empty($products['categories'])) ? $products['categories'] : [];
                $this->response['product_tags'] = (isset($products['product_tags']) && !empty($products['product_tags'])) ? $products['product_tags'] : [];
                $this->response['partner_tags'] = (isset($products['partner_tags']) && !empty($products['partner_tags'])) ? $products['partner_tags'] : [];
                $this->response['total'] = $final_total;
                $this->response['offset'] = (isset($_POST['offset']) && !empty($_POST['offset'])) ? $this->input->post("offset", true) : '0';
                $this->response['data'] = $products['product'];
            } else {
                $this->response['error'] = true;
                $this->response['message'] = "Products Not Found !";
                $this->response['data'] = array();
            }
        }
        print_r(json_encode($this->response));
    }

    //7.validate_promo_code
    public function validate_promo_code()
    {
        /*
            promo_code:'NEWOFF10'
            user_id:28
            final_total:'300'

        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('promo_code', 'Promo Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('final_total', 'Final Total', 'trim|required|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            print_r(json_encode(validate_promo_code($_POST['promo_code'], $_POST['user_id'], $_POST['final_total'])));
        }
    }

    public function get_partners()
    {
        /*
            id:1      //{optional}
            slug:partner-slug  // {optional}
            city_id:1  //{optional}
            user_id:1  //{optional}
            limit:25            // { default - 25 } optional
            offset:0            // { default - 0 } optional
            sort:p.id / p.date_added / pv.price
                                { default - p.id } optional
            order:DESC/ASC      // { default - DESC } optional
            top_rated_partner: 1 // { default - 0 } optional
            only_opened_partners: 1 // { default - 0 } optional
            vegetarian:1|2|3             //{optional -> 1 - veg | 2 - non-veg | 3 - both}
            latitude:123                 // {optional}
            longitude:123                // {optional}
        */

        // if (!verify_tokens()) {
        //     return false;
        // }

        $this->form_validation->set_rules('city_id', 'City ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('id', 'ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('vegetarian', 'Vegetarian', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('latitude', 'latitude', 'trim|xss_clean');
        $this->form_validation->set_rules('longitude', 'longitude', 'trim|xss_clean');
        $this->form_validation->set_rules('top_rated_partner', 'top_rated_partner', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('only_opened_partners', 'only_opened_partners', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('search', 'search', 'trim|xss_clean');
        $this->form_validation->set_rules('slug', 'slug', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            if (isset($_POST['latitude']) && !empty($_POST['latitude']) && empty($_POST['longitude'])) {
                $this->response['error'] = true;
                $this->response['message'] = "The Longitude Field is Required";
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return;
            }
            if (isset($_POST['longitude']) && !empty($_POST['longitude']) && empty($_POST['latitude'])) {
                $this->response['error'] = true;
                $this->response['message'] = "The Latitude Field is Required";
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return;
            }

            $filters['city_id'] = (isset($_POST['city_id']) && !empty($_POST['city_id'])) ? $this->input->post("city_id", true) : "";
            $filters['longitude'] = (isset($_POST['longitude']) && !empty($_POST['longitude'])) ? $this->input->post("longitude", true) : 0;
            $filters['latitude'] = (isset($_POST['latitude']) && !empty($_POST['latitude'])) ? $this->input->post("latitude", true) : 0;
            $filters['id'] = (isset($_POST['id']) && !empty($_POST['id'])) ? $this->input->post("id", true) : "";
            $filters['slug'] = (isset($_POST['slug']) && !empty($_POST['slug'])) ? $this->input->post("slug", true) : "";
            $filters['vegetarian'] = (isset($_POST['vegetarian']) && !empty($_POST['vegetarian'])) ? $this->input->post("vegetarian", true) : "";
            $filters['top_rated_partner'] = (isset($_POST['top_rated_partner']) && !empty($_POST['top_rated_partner'])) ? $this->input->post("top_rated_partner", true) : 0;
            $filters['only_opened_partners'] = (isset($_POST['only_opened_partners']) && !empty($_POST['only_opened_partners'])) ? $this->input->post("only_opened_partners", true) : 0;
            $limit = (isset($_POST['limit'])) ? $this->input->post('limit', true) : 25;
            $offset = (isset($_POST['offset'])) ? $this->input->post('offset', true) : 0;
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $this->input->post('order', true) : 'DESC';
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $this->input->post('sort', true) : 'u.id';
            $search = (isset($_POST['search']) && !empty(trim($_POST['search']))) ? $this->input->post('search', true) : '';
            $user_id = (isset($_POST['user_id']) && !empty(trim($_POST['user_id']))) ? $this->input->post('user_id', true) : null;

            if (isset($filters['city_id']) && !empty($filters['city_id'])) {
                if (!is_exist(['id' => $filters['city_id']], 'cities')) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'City Not Deliverable!';
                    $this->response['data'] =  array();
                    echo json_encode($this->response);
                    return false;
                }
            }
            if (isset($filters['id']) && !empty($filters['id'])) {
                if (!is_exist(['user_id' => $filters['id'], 'status' => 1], 'partner_data')) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'Partner Not Found or Deactivated!';
                    $this->response['data'] =  array();
                    echo json_encode($this->response);
                    return false;
                }
            }

            $data = fetch_partners((isset($filters)) ? $filters : null, $user_id, $limit, $offset, $sort, $order, $search);
            if (!empty($data['data'])) {
                for ($i = 0; $i < count($data['data']); $i++) {
                    $working_time = fetch_details(["partner_id" => $data['data'][$i]['partner_id']], "partner_timings");
                    $data['data'][$i]['partner_working_time'] = $working_time;
                }
            }
            print_r(json_encode($data));
        }
    }

    //13. add_address
    public function add_address()
    {

        /* 
            user_id:1
            mobile:9727800638
            address:#123,Time Square Empire,bhuj 
            city_id:1
            latitude:1234
            longitude:1234
            area:umiya nagar
            type:Home | Office | Others      {optional}
            name:John Smith              {optional}
            country_code:+91             {optional}
            alternate_mobile:9876543210  {optional}
            landmark:prince hotel        {optional}
            pincode:370001               {optional}
            state:Gujarat                {optional}
            country:India                {optional}
            is_default:1                 {optional}{default - 0}
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('alternate_mobile', 'Alternative Mobile', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('landmark', 'Landmark', 'trim|xss_clean');
        $this->form_validation->set_rules('area', 'Area', 'trim|required|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pincode', 'Pincode', 'trim|xss_clean');
        $this->form_validation->set_rules('country_code', 'Country Code', 'trim|xss_clean');
        $this->form_validation->set_rules('alternate_country_code', 'Alternate Country Code', 'trim|xss_clean');
        $this->form_validation->set_rules('state', 'State', 'trim|xss_clean');
        $this->form_validation->set_rules('country', 'Country', 'trim|xss_clean');
        $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|xss_clean');
        $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $city = (isset($_POST['city']) && !empty($_POST['city'])) ? $this->input->post("city", true) : "";
            $user_id = (isset($_POST['user_id']) && !empty($_POST['user_id'])) ? $this->input->post("user_id", true) : "";
            if (isset($user_id) && !empty($user_id)) {
                if (!is_exist(['id' => $user_id], 'users')) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'User Not Found!';
                    $this->response['data'] =  array();
                    echo json_encode($this->response);
                    return false;
                }
            }
            if (isset($city) && !empty($city)) {
                if (!is_exist(['name' => $city], 'cities')) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'City Not Found or We are not delivering in this city !';
                    $this->response['data'] =  array();
                    echo json_encode($this->response);
                    return false;
                }
            }
            $city_id = fetch_details(['name' => $city], "cities", "id");
            $_POST['city_id'] = $city_id[0]['id'];
            $this->address_model->set_address($_POST);
            $res = $this->address_model->get_address($user_id, false, true);
            $this->response['error'] = false;
            $this->response['message'] = 'Address Added Successfully';
            $this->response['data'] = $res;
        }
        print_r(json_encode($this->response));
    }

    //update_address
    public function update_address()
    {
        /*
            id:1
            user_id:1                    {optional}
            mobile:9727800638            {optional}
            address:#123,Time Square,bhuj    {optional} 
            city:1                    {optional}
            type:Home | Office | Others      {optional}
            name:John Smith              {optional}
            country_code:+91             {optional}
            alternate_mobile:9876543210  {optional}
            landmark:prince hotel        {optional}
            area:umiya nagar             {optional}
            pincode:370001               {optional}
            state:Gujarat                {optional}
            country:India                {optional}
            latitude:1234                {optional}
            longitude:1234               {optional}
            is_default:1                 {optional}{default - 0}
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('id', 'Id', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean');
        $this->form_validation->set_rules('country_code', 'Country Code', 'trim|xss_clean');
        $this->form_validation->set_rules('alternate_country_code', 'Alternate Country Code', 'trim|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('alternate_mobile', 'Alternative Mobile', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');
        $this->form_validation->set_rules('landmark', 'Landmark', 'trim|xss_clean');
        $this->form_validation->set_rules('area_id', 'Area', 'trim|xss_clean');
        $this->form_validation->set_rules('latitude', 'Latitude', 'trim|xss_clean');
        $this->form_validation->set_rules('longitude', 'Longitude', 'trim|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'trim|xss_clean');
        $this->form_validation->set_rules('pincode', 'Pincode', 'trim|xss_clean');
        $this->form_validation->set_rules('state', 'State', 'trim|xss_clean');
        $this->form_validation->set_rules('country', 'Country', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $id = (isset($_POST['id']) && !empty($_POST['id'])) ? $this->input->post("id", true) : "";
            $city = (isset($_POST['city']) && !empty($_POST['city'])) ? $this->input->post("city", true) : "";

            if (isset($id) && !empty($id)) {
                if (!is_exist(['id' => $id], 'addresses')) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'Address Not Found!';
                    $this->response['data'] =  array();
                    echo json_encode($this->response);
                    return false;
                }
            }

            if (isset($city) && !empty($city)) {
                if (!is_exist(['name' => $city], 'cities')) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'City Not Found or We are not delivering in this city !';
                    $this->response['data'] =  array();
                    echo json_encode($this->response);
                    return false;
                }
            }
            $city_id = fetch_details(['name' => $city], "cities", "id");
            $_POST['city_id'] = $city_id[0]['id'];
            $this->address_model->set_address($_POST);
            $res = $this->address_model->get_address(null, $_POST['id'], true);
            $this->response['error'] = false;
            $this->response['message'] = 'Address updated Successfully';
            $this->response['data'] = $res;
        }
        print_r(json_encode($this->response));
    }

    //get_address
    public function get_address()
    {
        /*
            user_id:3    
            address_id:bhuj         {optional}  {if want to get only one address by id}
            partner_id:1234     {optional}  {for delivery check}
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User id', 'trim|numeric|xss_clean|required');
        $this->form_validation->set_rules('address_id', 'Address Id', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('partner_id', 'partner Id', 'trim|xss_clean|numeric');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $user_id = (isset($_POST['user_id']) && !empty($_POST['user_id'])) ? $this->input->post("user_id", true) : "";
            $address_id = (isset($_POST['address_id']) && !empty($_POST['address_id'])) ? $this->input->post("address_id", true) : "";
            $partner_id = (isset($_POST['partner_id']) && !empty($_POST['partner_id'])) ? $this->input->post("partner_id", true) : "";

            if (isset($user_id) && !empty($user_id)) {
                if (!is_exist(['id' => $user_id], 'users')) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'User Not Found!';
                    $this->response['data'] =  array();
                    echo json_encode($this->response);
                    return false;
                }
            }

            $res = $this->address_model->get_address($user_id, $address_id, false, false, $partner_id);
            $is_default_counter = array_count_values(array_column($res, 'is_default'));

            if (!isset($is_default_counter['1']) && !empty($res)) {
                update_details(['is_default' => '1'], ['id' => $res[0]['id']], 'addresses');
                $res = $this->address_model->get_address($user_id, $address_id, false, false, $partner_id);
            }
            if (!empty($res)) {
                $this->response['error'] = false;
                $this->response['message'] = 'Address Retrieved Successfully';
                $this->response['data'] = $res;
            } else {
                $this->response['error'] = true;
                $this->response['message'] = "No Details Found!";
                $this->response['data'] = array();
            }
        }
        print_r(json_encode($this->response));
    }

    //delete_address
    public function delete_address()
    {
        /*
            id:3
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('id', 'Id', 'trim|required|numeric|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $id = (isset($_POST['id']) && !empty($_POST['id'])) ? $this->input->post("id", true) : "";
            if (isset($id) && !empty($id)) {
                if (!is_exist(['id' => $id], 'addresses')) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'Address Not Found!';
                    $this->response['data'] =  array();
                    echo json_encode($this->response);
                    return false;
                }
            }
            $this->address_model->delete_address($_POST);
            $this->response['error'] = false;
            $this->response['message'] = 'Address Deleted Successfully';
            $this->response['data'] = array();
        }
        print_r(json_encode($this->response));
    }

    //5.get_settings
    public function get_settings()
    {
        /*
            type : payment_method | all // { default : all  } optional            
            user_id:  15 { optional }
        */
        // if (!verify_tokens()) {
        //     return false;
        // }
        $type = (isset($_POST['type']) && $_POST['type'] == 'payment_method') ? 'payment_method' : 'all';
        $this->form_validation->set_rules('type', 'Setting Type', 'trim|xss_clean');
        $this->form_validation->set_rules('user_id', 'User id', 'trim|numeric|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
        } else {
            $tags = $city = $general_settings = array();
            $ALLOW_MODIFICATION = ALLOW_MODIFICATION;
            if ($type == 'all' || $type == 'payment_method') {

                $limit = (isset($_POST['limit'])) ? $this->input->post('limit', true) : 30;
                $offset = (isset($_POST['offset'])) ? $this->input->post('offset', true) : 0;
                $filter = array('tags' => "a");
                $products = fetch_product(null, $filter, null, null, $limit, $offset, 'p.id', 'DESC', null);
                for ($i = 0; $i < count($products); $i++) {
                    if (isset($products['partner_tags']) && !empty($products['partner_tags'])) {
                        $tags = $products['partner_tags'];
                    }
                }
                $settings = [
                    'logo' => 0,
                    'privacy_policy' => 0,
                    'terms_conditions' => 0,
                    'fcm_server_key' => 0,
                    'contact_us' => 0,
                    'spaza_contact_us' => 0,
                    'payment_method' => 1,
                    'about_us' => 0,
                    'currency' => 0,
                    'user_data' => 0,
                    'system_settings' => 1,
                    'web_settings' => 1,
                    'firebase_settings' => 1,
                ];

                if ($type == 'payment_method') {

                    $settings_res['payment_method'] = get_settings($type, $settings[$_POST['type']]);

                    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                        $cart_total_response = get_cart_total($_POST['user_id'], false, 0);
                        $cod_allowed = isset($cart_total_response[0]['is_cod_allowed']) ? $cart_total_response[0]['is_cod_allowed'] : 1;
                        $settings_res['is_cod_allowed'] = $cod_allowed;
                    } else {
                        $settings_res['is_cod_allowed'] = 1;
                    }

                    $general_settings = $settings_res;
                } else {
                    foreach ($settings as $type => $isjson) {
                        if ($type == 'payment_method') {
                            continue;
                        }
                        $general_settings[$type] = [];
                        $settings_res = get_settings($type, $isjson);
                        if ($type == 'logo') {
                            $settings_res = base_url() . $settings_res;
                        }
                        if ($type == 'user_data') {
                            if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                                $cart_total_response = get_cart_total($_POST['user_id'], false, 0);
                                $settings_res = fetch_users($_POST['user_id']);
                                $settings_res['cart_total_items'] = (isset($cart_total_response[0]['cart_count']) && $cart_total_response[0]['cart_count'] > 0) ? $cart_total_response[0]['cart_count'] : '0';
                                $settings_res = $settings_res;
                            } else {
                                $settings_res = "";
                            }
                        }
                        if ($type == 'system_settings') {
                            unset($settings_res['google_map_api_key']);
                            unset($settings_res['google_map_javascript_api_key']);
                        }
                        array_push($general_settings[$type], $settings_res);
                    }
                }
                $general_settings['web_settings'][0]['logo'] = base_url() . $general_settings['web_settings'][0]['logo'];
                $general_settings['web_settings'][0]['favicon'] = base_url() . $general_settings['web_settings'][0]['favicon'];
                $general_settings['web_settings'][0]['light_logo'] = base_url() . $general_settings['web_settings'][0]['light_logo'];

                $this->response['error'] = false;
                $this->response['allow_modification'] = $ALLOW_MODIFICATION;
                $this->response['message'] = 'Settings retrieved successfully';
                $this->response['data'] = $general_settings;
                $this->response['data']['tags'] = $tags;
            } else {
                $this->response['error'] = true;
                $this->response['allow_modification'] = $ALLOW_MODIFICATION;
                $this->response['message'] = 'Settings Not Found';
                $this->response['data'] = array();
            }
            print_r(json_encode($this->response));
        }
    }

    //8.place_order
    public function place_order()
    {

        /*
            user_id:5
            mobile:9974692496
            product_variant_id: 1,2,3
            quantity: 3,3,1
            total:60.0
            delivery_charge:20.0
            tax_amount:10
            tax_percentage:10
            final_total:55
            latitude:40.1451
            longitude:-45.4545
            promo_code:NEW20                        {optional}
            payment_method: Paypal / Payumoney / COD / PAYTM
            address_id:17
            is_wallet_used:1 {By default 0}
            wallet_balance_used:1
            is_epoints_used:1 {By default 0}
            epoints_used:10
            active_status:awaiting {optional}
            order_note:text      //{optional}
            delivery_tip:text      //{optional}
            is_self_pick_up:0|1    //{default will be zero}{required when its self pickup}
        */

        // if (!verify_tokens()) {
        //     return false;
        // }

        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile Id', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('product_variant_id', 'Product Variant Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Quantities', 'trim|required|xss_clean');
        $this->form_validation->set_rules('final_total', 'Final Total', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('promo_code', 'Promo Code', 'trim|xss_clean');
        $this->form_validation->set_rules('order_note', 'Order Note', 'trim|xss_clean');
        $this->form_validation->set_rules('txn_id', 'Transaction ID', 'trim|xss_clean');
        $this->form_validation->set_rules('is_pos', 'Is POS', 'trim|xss_clean');
        $this->form_validation->set_rules('delivery_tip', 'Delivery Tip', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('is_self_pick_up', 'Is Self Pick Up', 'trim|numeric|xss_clean');

        /*
        ------------------------------
        If Wallet Balance Is Used
        ------------------------------
        */
        $this->form_validation->set_rules('is_wallet_used', ' Wallet Balance Used', 'trim|required|numeric|xss_clean');
        if (isset($_POST['is_wallet_used']) && $_POST['is_wallet_used'] == '1') {
            $this->form_validation->set_rules('wallet_balance_used', ' Wallet Balance ', 'trim|required|numeric|xss_clean');
        }
        $this->form_validation->set_rules('is_epoints_used', 'is ePoints used', 'trim|required|numeric|xss_clean');
        if (isset($_POST['is_epoints_used']) && $_POST['is_epoints_used'] == '1') {
            $this->form_validation->set_rules('epoints_used', ' ePoints used ', 'trim|required|numeric|xss_clean');
        }
        $this->form_validation->set_rules('latitude', 'Latitude', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('longitude', 'Longitude', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('payment_method', 'Payment Method', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_id', 'Address id', 'trim|numeric|xss_clean');

        $settings = get_settings('system_settings', true);
        $currency = isset($settings['currency']) && !empty($settings['currency']) ? $settings['currency'] : '';
        if (isset($settings['minimum_cart_amt']) && !empty($settings['minimum_cart_amt'])) {
            $this->form_validation->set_rules('total', 'Total', 'trim|xss_clean|greater_than_equal_to[' . $settings['minimum_cart_amt'] . ']', array('greater_than_equal_to' => 'Total amount should be greater or equal to ' . $currency . $settings['minimum_cart_amt'] . ' total is ' . $currency . $_POST['total'] . ''));
        }
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            // print_r($_POST);
            $_POST['order_note'] = (isset($_POST['order_note']) && !empty($_POST['order_note'])) ? $this->input->post("order_note", true) : NULL;
            $_POST['delivery_tip'] = (isset($_POST['delivery_tip']) && !empty($_POST['delivery_tip'])) ? $this->input->post("delivery_tip", true) : 0;
            $_POST['is_self_pick_up'] = (isset($_POST['is_self_pick_up']) && !empty($_POST['is_self_pick_up']) && $_POST['is_self_pick_up'] != "") ? $this->input->post("is_self_pick_up", true) : 0;
            $_POST['tax_amount'] = (isset($_POST['tax_amount']) && !empty($_POST['tax_amount'])) ? $this->input->post("tax_amount", true) : 0;
            $_POST['tax_percentage'] = (isset($_POST['tax_percentage']) && !empty($_POST['tax_percentage'])) ? $this->input->post("tax_percentage", true) : 0;
            $_POST['is_delivery_charge_returnable'] = (isset($_POST['delivery_charge']) && !empty($_POST['delivery_charge']) && $_POST['delivery_charge'] != '' && $_POST['delivery_charge'] > 0) ? 1 : 0;
            $res = $this->Order_model->place_order($_POST);
            print_r(json_encode($res));

            if ($_POST['payment_method'] !== 'midtrans') {

                /* notify all system users, partner and user by email and push notification */
                $fcm_admin_msg = 'New order placed for ' . $settings['app_name'] . ' please confirm it.';
                $fcm_admin_subject = 'New order placed ID #' . $res['order_id'];
                send_notifications("", "admins", $fcm_admin_subject, $fcm_admin_msg, "place_order");

                $fcm_restro_subject = 'New order placed ID #' . $res['order_id'];
                send_notifications($res['order_item_data'][0]['partner_id'], "partner", $fcm_restro_subject, "", "place_order");

                $fcm_user_subject = 'Wait for Order Confirmation';
                $fcm_user_msg = 'Thanks for your order ID #' . $res['order_id'] . '. We will let you know once your order confirm by partner on this email ID.';
                send_notifications($res['order_item_data'][0]['user_id'], "user", $fcm_user_subject, $fcm_user_msg, "place_order", $res['order_id']);
            }
        }
    }

    //get_orders
    public function get_orders()
    {
        // user_id:101
        // id:101              // {optional}
        // active_status: confirmed  {pending,confirmed,preparing,out_for_delivery,delivered,cancelled}     // optional
        // limit:25            // { default - 25 } optional
        // offset:0            // { default - 0 } optional
        // sort: o.id / date_added // { default - o.id } optional
        // order:DESC/ASC      // { default - DESC } optional        
        // download_invoice:0 // { default - 0 } optional       

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('id', 'Id', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('active_status', 'status', 'trim|xss_clean');
        $this->form_validation->set_rules('is_self_pickup', 'is_self_pickup', 'trim|xss_clean');
        $this->form_validation->set_rules('download_invoice', 'Invoice', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('download_thermal_invoice', 'Thermal Invoice', 'trim|numeric|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
            $offset = (isset($_POST['offset']) && is_numeric($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $this->input->post('sort', true) : 'o.id';
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $this->input->post('order', true) : 'DESC';
            $search = (isset($_POST['search']) && !empty(trim($_POST['search']))) ? $this->input->post('search', true) : '';
            $multiple_status =   (isset($_POST['active_status']) && !empty($_POST['active_status'])) ? explode(',', $_POST['active_status']) : false;
            $download_invoice =   (isset($_POST['download_invoice']) && $_POST['download_invoice'] != null) ? $this->input->post('download_invoice', true) : 1;
            $download_thermal_invoice =   (isset($_POST['download_thermal_invoice']) && $_POST['download_thermal_invoice'] != null) ? $this->input->post('download_thermal_invoice', true) : 1;
            $id =   (isset($_POST['id']) && !empty($_POST['id'])) ? $this->input->post('id', true) : null;
            $order_details = fetch_orders($id, $_POST['user_id'], $multiple_status, false, $limit, $offset, $sort, $order, $download_invoice, $download_thermal_invoice, false, false, $search);
            // print_r($order_details);
            if (!empty($order_details['order_data'])) {

                $this->response['error'] = false;
                $this->response['message'] = 'Data retrieved successfully';
                $this->response['total'] = $order_details['total'];
                $this->response['data'] = $order_details['order_data'];
            } else {
                $this->response['error'] = true;
                $this->response['message'] = 'No Order(s) Found !';
                $this->response['data'] = array();
            }
        }
        print_r(json_encode($this->response));
    }

    //set_product_rating
    public function set_product_rating()
    {
        /*
            user_id: 21
            product_id: 33
            rating: 4
            comment: 'Done' {optional}
            images[]:[]
        */
        if (!verify_tokens()) {
            return false;
        }
        // print_r($_FILES);

        $this->form_validation->set_rules('user_id', 'User Id', 'trim|numeric|required|xss_clean');
        // $this->form_validation->set_rules('product_id', 'Product Id', 'trim|numeric|xss_clean|required');
        // $this->form_validation->set_rules('rating', 'Rating', 'trim|numeric|xss_clean|greater_than[0]|less_than[6]');
        // $this->form_validation->set_rules('comment', 'Comment', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $response['error'] = true;
            $response['message'] = strip_tags(validation_errors());
            $response['data'] = array();
            echo json_encode($response);
        } else {
            if (!file_exists(FCPATH . REVIEW_IMG_PATH)) {
                mkdir(FCPATH . REVIEW_IMG_PATH, 0777);
            }

            $temp_array = array();
            $files = $_FILES;
            $images_new_name_arr = array();
            $images_info_error = "";
            $config = [
                'upload_path' =>  FCPATH . REVIEW_IMG_PATH,
                'allowed_types' => 'jpg|png|jpeg|gif',
                'max_size' => 8000,
            ];




            $user_id = $this->input->post("user_id", true);
            $f = 0;
            foreach ($_POST['product_rating_data']  as $pro_data) {
                $pro_data['user_id'] = $user_id;
                $res = $this->db->select('*')->join('product_variants pv', 'pv.id=oi.product_variant_id')
                    ->join('products p', 'p.id=pv.product_id')
                    ->join('orders o', 'o.id=oi.order_id')
                    ->where(['pv.product_id' => $pro_data['product_id'], 'oi.user_id' => $user_id, "o.active_status" => "delivered"])->limit(1)->get('order_items oi')->result_array();

                if (empty($res)) {
                    $response['error'] = true;
                    $response['message'] = 'You cannot review as the product is not purchased yet!';
                    $response['data'] = array();
                    echo json_encode($response);
                    return;
                }

                // process images for rating

                if (!empty($_FILES['product_rating_data']['name'][$f]) && isset($_FILES['product_rating_data']['name'])) {
                    $other_image_cnt = count($_FILES['product_rating_data']['name'][$f]['images']);
                    $other_img = $this->upload;
                    $other_img->initialize($config);

                    for ($i = 0; $i < $other_image_cnt; $i++) {


                        if (!empty($_FILES['product_rating_data']['name'][$f]['images'][$i])) {

                            $_FILES['temp_image']['name'] = $files['product_rating_data']['name'][$f]['images'][$i];
                            $_FILES['temp_image']['type'] = $files['product_rating_data']['type'][$f]['images'][$i];
                            $_FILES['temp_image']['tmp_name'] = $files['product_rating_data']['tmp_name'][$f]['images'][$i];
                            $_FILES['temp_image']['error'] = $files['product_rating_data']['error'][$f]['images'][$i];
                            $_FILES['temp_image']['size'] = $files['product_rating_data']['size'][$f]['images'][$i];
                            if (!$other_img->do_upload('temp_image')) {
                                $images_info_error = 'Images :' . $images_info_error . ' ' . $other_img->display_errors();
                            } else {
                                $temp_array = $other_img->data();
                                resize_review_images($temp_array, FCPATH . REVIEW_IMG_PATH);
                                $images_new_name_arr[$i] = REVIEW_IMG_PATH . $temp_array['file_name'];
                            }
                        } else {
                            $_FILES['temp_image']['name'] = $files['product_rating_data']['name'][$f]['images'][$i];
                            $_FILES['temp_image']['type'] = $files['product_rating_data']['type'][$f]['images'][$i];
                            $_FILES['temp_image']['tmp_name'] = $files['product_rating_data']['tmp_name'][$f]['images'][$i];
                            $_FILES['temp_image']['error'] = $files['product_rating_data']['error'][$f]['images'][$i];
                            $_FILES['temp_image']['size'] = $files['product_rating_data']['size'][$f]['images'][$i];
                            if (!$other_img->do_upload('temp_image')) {
                                $images_info_error = $other_img->display_errors();
                            }
                        }
                    }
                    //Deleting Uploaded Images if any overall error occured
                    if ($images_info_error != NULL || !$this->form_validation->run()) {
                        if (isset($images_new_name_arr) && !empty($images_new_name_arr || !$this->form_validation->run())) {
                            foreach ($images_new_name_arr as $key => $val) {
                                unlink(FCPATH . REVIEW_IMG_PATH . $images_new_name_arr[$key]);
                            }
                        }
                    }
                }
                if ($images_info_error != NULL) {
                    $this->response['error'] = true;
                    $this->response['message'] =  $images_info_error;
                    print_r(json_encode($this->response));
                    return;
                }
                $rating_data = fetch_details(['user_id' => $user_id, 'product_id' => $pro_data['product_id']], 'product_rating', 'images');
                $rating_images = $images_new_name_arr;
                // if (isset($rating_data[0]['images']) && isset($rating_data) && !empty($rating_data[0]['images'])) {
                //     $existing_images = json_decode($rating_data[0]['images']);
                //     $rating_images = array_merge($existing_images, $images_new_name_arr);
                // }
                $pro_data['images'] = $rating_images;
                $this->rating_model->set_rating($pro_data);
                $f++;
            }

            $rating_data = [];
            foreach ($_POST['product_rating_data']  as $pro_data) {
                $tmp_rating_data = $this->rating_model->fetch_rating((isset($pro_data['product_id'])) ? $pro_data['product_id'] : '', '', '', '25', '0', 'id', 'DESC');
                $rating_data[] =  $tmp_rating_data;
            }
            $rating['product_rating'] = (isset($rating_data) && !empty($rating_data)) ? $rating_data[0]['product_rating'] : [];
            $rating['no_of_rating'] = (isset($rating_data) && isset($rating_data[0]['no_of_rating']) && !empty($rating_data[0]['no_of_rating'])) ? $rating_data[0]['no_of_rating'] : "0";
            $response['error'] = false;
            $response['message'] = 'Product Rated Successfully';
            // $response['data'] = $rating;
            echo json_encode($response);
            return;
        }
    }


    //set_product_rating
    public function set_order_rating()
    {
        /*
        user_id: 21
        order_id: 33
        rating: 4.2
        comment: 'Done' {optional}
        images[]:[]
    // */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('order_id', 'Order Id', 'trim|numeric|xss_clean|required');
        $this->form_validation->set_rules('rating', 'Rating', 'trim|numeric|xss_clean|greater_than[0]|less_than[6]');
        $this->form_validation->set_rules('comment', 'Comment', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $response['error'] = true;
            $response['message'] = strip_tags(validation_errors());
            $response['data'] = array();
            echo json_encode($response);
        } else {
            if (!file_exists(FCPATH . REVIEW_IMG_PATH)) {
                mkdir(FCPATH . REVIEW_IMG_PATH, 0777);
            }

            $temp_array = array();
            $files = $_FILES;
            $images_new_name_arr = array();
            $images_info_error = "";
            $config = [
                'upload_path' =>  FCPATH . REVIEW_IMG_PATH,
                'allowed_types' => 'jpg|png|jpeg|gif',
                'max_size' => 8000,
            ];

            if (!empty($_FILES['images']['name'][0]) && isset($_FILES['images']['name'])) {
                $other_image_cnt = count($_FILES['images']['name']);
                $other_img = $this->upload;
                $other_img->initialize($config);

                for ($i = 0; $i < $other_image_cnt; $i++) {

                    if (!empty($_FILES['images']['name'][$i])) {

                        $_FILES['temp_image']['name'] = $files['images']['name'][$i];
                        $_FILES['temp_image']['type'] = $files['images']['type'][$i];
                        $_FILES['temp_image']['tmp_name'] = $files['images']['tmp_name'][$i];
                        $_FILES['temp_image']['error'] = $files['images']['error'][$i];
                        $_FILES['temp_image']['size'] = $files['images']['size'][$i];
                        if (!$other_img->do_upload('temp_image')) {
                            $images_info_error = 'Images :' . $images_info_error . ' ' . $other_img->display_errors();
                        } else {
                            $temp_array = $other_img->data();
                            resize_review_images($temp_array, FCPATH . REVIEW_IMG_PATH);
                            $images_new_name_arr[$i] = REVIEW_IMG_PATH . $temp_array['file_name'];
                        }
                    } else {
                        $_FILES['temp_image']['name'] = $files['images']['name'][$i];
                        $_FILES['temp_image']['type'] = $files['images']['type'][$i];
                        $_FILES['temp_image']['tmp_name'] = $files['images']['tmp_name'][$i];
                        $_FILES['temp_image']['error'] = $files['images']['error'][$i];
                        $_FILES['temp_image']['size'] = $files['images']['size'][$i];
                        if (!$other_img->do_upload('temp_image')) {
                            $images_info_error = $other_img->display_errors();
                        }
                    }
                }

                //Deleting Uploaded Images if any overall error occured
                if ($images_info_error != NULL || !$this->form_validation->run()) {
                    if (isset($images_new_name_arr) && !empty($images_new_name_arr || !$this->form_validation->run())) {
                        foreach ($images_new_name_arr as $key => $val) {
                            unlink(FCPATH . REVIEW_IMG_PATH . $images_new_name_arr[$key]);
                        }
                    }
                }
            }
            if ($images_info_error != NULL) {
                $this->response['error'] = true;
                $this->response['csrfName'] = $this->security->get_csrf_token_name();
                $this->response['csrfHash'] = $this->security->get_csrf_hash();
                $this->response['message'] =  $images_info_error;
                print_r(json_encode($this->response));
                return;
            }

            $user_id = $this->input->post("user_id", true);
            $order_id = $this->input->post("order_id", true);

            $res = $this->db->select('*')
                ->where(['o.id' => $order_id, 'o.user_id' => $user_id, "o.active_status" => "delivered"])
                ->limit(1)->get('orders o')->result_array();

            if (empty($res)) {
                $response['error'] = true;
                $response['message'] = 'You cannot review as the order is not delivered yet!';
                $response['data'] = array();
                echo json_encode($response);
                return;
            }

            $rating_data = fetch_details(['user_id' => $_POST['user_id'], 'order_id' => $_POST['order_id']], 'order_rating', '*');

            $rating_images = $images_new_name_arr;
            // if (isset($rating_data[0]['images']) && isset($rating_data) && !empty($rating_data[0]['images'])) {
            //     $existing_images = json_decode($rating_data[0]['images']);
            //     $rating_images = array_merge($existing_images, $images_new_name_arr);
            // }

            $_POST['images'] = $rating_images;
            $this->rating_model->set_rating($_POST);
            $rating_data = $this->rating_model->fetch_rating('', (isset($_POST['order_id'])) ? $_POST['order_id'] : '');
            $rating['order_rating'] = $rating_data['order_rating'];
            $rating['no_of_rating'] = (isset($rating_data['no_of_rating']) && !empty($rating_data['no_of_rating'])) ? $rating_data['no_of_rating'] : "0";
            $response['error'] = false;
            $response['message'] = 'Order Rated Successfully';
            $response['data'] = $rating;
            echo json_encode($response);
            return;
        }
    }


    //  delete_product_rating
    public function delete_product_rating()
    {
        /*
        rating_id:32
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('rating_id', 'Rating Id', 'trim|numeric|required|xss_clean');

        if (!$this->form_validation->run()) {
            $response['error'] = true;
            $response['message'] = strip_tags(validation_errors());
            $response['data'] = array();
            echo json_encode($response);
        } else {
            $this->rating_model->delete_rating($_POST['rating_id']);
            $response['error'] = false;
            $response['message'] = 'Deleted Rating Successfully';
            $response['data'] = array();
            echo json_encode($response);
        }
    }


    //  delete_order_rating
    public function delete_order_rating()
    {
        /*
        rating_id:32
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('rating_id', 'Rating Id', 'trim|numeric|required|xss_clean');

        if (!$this->form_validation->run()) {
            $response['error'] = true;
            $response['message'] = strip_tags(validation_errors());
            $response['data'] = array();
            echo json_encode($response);
        } else {
            $this->rating_model->delete_rating('', $_POST['rating_id']);
            $response['error'] = false;
            $response['message'] = 'Deleted Rating Successfully';
            $response['data'] = array();
            echo json_encode($response);
        }
    }
    // get_product_rating
    /*
        product_id : 12
        user_id : 1 		{optional}
        limit:25                // { default - 25 } optional
        offset:0                // { default - 0 } optional
        sort: type   			// { default - type } optional
        order:DESC/ASC          // { default - DESC } optional
    */
    public function get_product_rating()
    {
        // if (!verify_tokens()) {
        //     return false;
        // }

        $this->form_validation->set_rules('product_id', 'Product Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        }
        $limit = (isset($_POST['limit'])  && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
        $offset = (isset($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
        $sort = (isset($_POST['sort(array)']) && !empty(trim($_POST['sort']))) ? $this->input->post('sort', true) : 'pr.id';
        $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $this->input->post('order', true) : 'DESC';
        $has_images = (isset($_POST['has_images']) && !empty(trim($_POST['has_images']))) ? 1 : 0;

        // update category clicks
        $category_id = fetch_details(['id' => $this->input->post('product_id', true)], 'products', 'category_id');
        $this->db->set('clicks', 'clicks+1', FALSE);
        $this->db->where('id', $category_id[0]['category_id']);
        $this->db->update('categories');

        $pr_rating = fetch_details(['id' => $this->input->post('product_id', true)], 'products', 'rating');

        $rating = $this->rating_model->fetch_rating((isset($_POST['product_id'])) ? $_POST['product_id'] : '', '', (isset($_POST['user_id'])) ? $_POST['user_id'] : '', $limit, $offset, $sort, $order, '', $has_images);
        if (!empty($rating)) {
            $response['error'] = false;
            $response['message'] = 'Rating retrieved successfully';
            $response['no_of_rating'] = (!empty($rating['no_of_rating'])) ? $rating['no_of_rating'] : 0;
            $response['total'] = $rating['total_reviews'];
            $response['star_1'] = $rating['star_1'];
            $response['star_2'] = $rating['star_2'];
            $response['star_3'] = $rating['star_3'];
            $response['star_4'] = $rating['star_4'];
            $response['star_5'] = $rating['star_5'];
            $response['total_images'] = (isset($rating['total_images']) && !empty($rating['total_images'])) ? $rating['total_images'] : "";
            $response['product_rating'] = (!empty($pr_rating)) ? $pr_rating[0]['rating'] : "0";
            $response['data'] = $rating['product_rating'];
        } else {
            $response['error'] = true;
            $response['message'] = 'No ratings found !';
            $response['no_of_rating'] = array();
            $response['data'] = array();
        }
        echo json_encode($response);
    }

    // get_order_rating
    /*
        order_id : 12
        user_id : 1 		{optional}
        limit:25                // { default - 25 } optional
        offset:0                // { default - 0 } optional
        sort: type   			// { default - type } optional
        order:DESC/ASC          // { default - DESC } optional
    */
    public function get_order_rating()
    {
        if (!verify_tokens()) {
            return false;
        }
        $this->form_validation->set_rules('order_id', 'Order Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        }
        $limit = (isset($_POST['limit'])  && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
        $offset = (isset($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
        $sort = (isset($_POST['sort(array)']) && !empty(trim($_POST['sort']))) ? $this->input->post('sort', true) : 'or.id';
        $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $this->input->post('order', true) : 'DESC';
        $has_images = (isset($_POST['has_images']) && !empty(trim($_POST['has_images']))) ? 1 : 0;

        $order_rating = fetch_details(['id' => $this->input->post('order_id', true)], 'orders', 'rating');
        $rating = $this->rating_model->fetch_rating('', (isset($_POST['order_id'])) ? $_POST['order_id'] : '', (isset($_POST['user_id'])) ? $_POST['user_id'] : '', $limit, $offset, $sort, $order, '', $has_images);

        if (!empty($rating)) {
            $response['error'] = false;
            $response['message'] = 'Rating retrieved successfully';
            $response['no_of_rating'] = (!empty($rating['no_of_rating'])) ? $rating['no_of_rating'] : 0;
            $response['total'] = $rating['total_reviews'];
            $response['star_1'] = $rating['star_1'];
            $response['star_2'] = $rating['star_2'];
            $response['star_3'] = $rating['star_3'];
            $response['star_4'] = $rating['star_4'];
            $response['star_5'] = $rating['star_5'];
            $response['total_images'] = (isset($rating['total_images']) && !empty($rating['total_images'])) ? $rating['total_images'] : "";
            $response['order_rating'] = (!empty($order_rating)) ? $order_rating[0]['rating'] : "0";
            $response['data'] = $rating['order_rating'];
        } else {
            $response['error'] = true;
            $response['message'] = 'No ratings found !';
            $response['no_of_rating'] = array();
            $response['data'] = array();
        }
        echo json_encode($response);
    }


    // manage_cart
    public function manage_cart()
    {
        /*
        Add/Update
        user_id:2
        product_variant_id:23
        clear_cart:1|0 {1 => clear cart | 0 => default, optional}
        is_saved_for_later: 1 { default:0 }
        qty:2 // pass 0 to remove qty
        add_on_id:1           {optional}
        add_on_qty:1          {required when passing add on id}
        */
        // if (!verify_tokens()) {
        //     return false;
        // }
        $_POST['qty'] = isset($_POST['qty']) && $_POST['qty'] != '' ? $_POST['qty'] : 1;
        $buy_stock = isset($_POST['buy_stock']) && $_POST['buy_stock'] != '' ? 1 : 0;
        $_POST['user_id'] = isset($_POST['user_id']) && $_POST['user_id'] != '' ? $_POST['user_id'] : ($this->ion_auth->logged_in() ? $this->session->userdata('user_id') : '');
        $this->form_validation->set_rules('user_id', 'User', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('product_variant_id', 'Product Variant', 'trim|required|xss_clean');
        $this->form_validation->set_rules('qty', 'Quantity', 'trim|required|xss_clean');
        $this->form_validation->set_rules('is_saved_for_later', 'Saved For Later', 'trim|xss_clean');
        $this->form_validation->set_rules('add_on_id', 'Add On Id', 'trim|xss_clean');
        $this->form_validation->set_rules('clear_cart', 'Clear Cart', 'trim|xss_clean');

        if (isset($_POST['add_on_id']) && !empty($_POST['add_on_id'])) {
            $this->form_validation->set_rules('add_on_qty', 'Add On QTY', 'trim|xss_clean|required');
        }

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $product_variant_id = $this->input->post('product_variant_id', true);
            $user_id = $this->input->post('user_id', true);
            if (!is_exist(['id' => $product_variant_id], "product_variants")) {
                $this->response['error'] = true;
                $this->response['message'] = 'Product Varient not available.';
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            }

            // clear cart if user has multi restro items
            $clear_cart = (isset($_POST['clear_cart']) && $_POST['clear_cart'] != "") ? $this->input->post('clear_cart', true) : 0;
            if ($clear_cart == true) {
                if (!$this->cart_model->remove_from_cart(['user_id' => $user_id])) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'Not able to remove existing restaurant items please try agian later.';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                }
            }

            if (!is_single_seller($product_variant_id, $user_id) && !$buy_stock) {
                $this->response['error'] = true;
                $this->response['message'] = 'Only single partner items are allow in cart.You can remove privious item(s) and add this item.';
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            }
            $qty = $this->input->post('qty', true);
            $saved_for_later = (isset($_POST['is_saved_for_later']) && $_POST['is_saved_for_later'] != "") ? $this->input->post('is_saved_for_later', true) : 0;
            $check_status = ($qty == 0 || $saved_for_later == 1) ? false : true;
            $settings = get_settings('system_settings', true);
            $cart_count = get_cart_count($_POST['user_id']);
            $is_variant_available_in_cart = is_variant_available_in_cart($this->input->post('product_variant_id', true),  $this->input->post('user_id', true));
            if (!$is_variant_available_in_cart) {
                if ($cart_count[0]['total'] >= $settings['max_items_cart']) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'Maximum ' . $settings['max_items_cart'] . ' Item(s) Can Be Added Only!';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return;
                }
            }
            if ($is_variant_available_in_cart && $buy_stock == 1) {
                $current_qty = is_variant_available_in_cart($this->input->post('product_variant_id', true),  $this->input->post('user_id', true), 1);
                $_POST['qty'] = $current_qty + 1;
            }
            if (!$this->cart_model->add_to_cart($_POST, $check_status)) {
                $response = get_cart_total($_POST['user_id'], false); // we will calculate add ons in this function
                $cart_user_data = $this->cart_model->get_user_cart($_POST['user_id'], 0);
                $tmp_cart_user_data = $cart_user_data;
                // if (!empty($tmp_cart_user_data)) {
                //     for ($i = 0; $i < count($tmp_cart_user_data); $i++) {
                //         $product_data = fetch_details(['id' => $tmp_cart_user_data[$i]['product_variant_id']], 'product_variants', 'product_id,availability');
                //         if (!empty($product_data[0]['product_id'])) {
                //             $pro_details = fetch_product($_POST['user_id'], null, $product_data[0]['product_id']);
                //             if (!empty($pro_details['product'])) {
                //                 if (trim($pro_details['product'][0]['availability']) == 0 && $pro_details['product'][0]['availability'] != null) {
                //                     update_details(['is_saved_for_later' => '1'], $cart_user_data[$i]['id'], 'cart');
                //                     unset($cart_user_data[$i]);
                //                 }

                //                 if (!empty($pro_details['product'])) {
                //                     $cart_user_data[$i]['product_details'] = $pro_details['product'];
                //                 } else {
                //                     delete_details(['id' => $cart_user_data[$i]['id']], 'cart');
                //                     unset($cart_user_data[$i]);
                //                     continue;
                //                 }
                //             } else {
                //                 delete_details(['id' => $cart_user_data[$i]['id']], 'cart');
                //                 unset($cart_user_data[$i]);
                //                 continue;
                //             }
                //         } else {
                //             delete_details(['id' => $cart_user_data[$i]['id']], 'cart');
                //             unset($cart_user_data[$i]);
                //             continue;
                //         }
                //     }
                // }

                $this->response['error'] = false;
                $this->response['message'] = 'Cart Updated !';
                $this->response['cart'] = (isset($cart_user_data) && !empty($cart_user_data)) ? $cart_user_data : [];
                $this->response['data'] = [
                    'total_quantity' => ($_POST['qty'] == 0) ? '0' : strval($_POST['qty']),
                    'sub_total' => strval($response['sub_total'] + $response['tax_amount']),
                    'total_items' =>  isset($this->response['cart']) ? strval(count($this->response['cart'])) : "0",
                    'tax_percentage' => (isset($response['tax_percentage'])) ? strval($response['tax_percentage']) : "0",
                    'tax_amount' => (isset($response['tax_amount'])) ? strval($response['tax_amount']) : "0",
                    'cart_count' => (isset($response[0]['cart_count'])) ? strval($response[0]['cart_count']) : "0",
                    'max_items_cart' => $settings['max_items_cart'],
                    'overall_amount' => $response['overall_amount'],
                ];
                print_r(json_encode($this->response));
                return;
            }
        }
    }

    //10. get_user_cart
    public function get_user_cart()
    {
        /*
            user_id:1
            is_saved_for_later: 1 { default:0 }
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('is_saved_for_later', 'Saved for later', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('search', 'Search keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $is_saved_for_later = (isset($_POST['is_saved_for_later']) && $_POST['is_saved_for_later'] == 1) ? $_POST['is_saved_for_later'] : 0;
            $user_id = (isset($_POST['user_id']) && !empty($_POST['user_id'])) ? $this->input->post("user_id", true) : "";

            $cart_user_data = $this->cart_model->get_user_cart($user_id, $is_saved_for_later);
            $cart_total_response = get_cart_total($user_id, '', $is_saved_for_later);
            $tmp_cart_user_data = $cart_user_data;
            if (!empty($tmp_cart_user_data)) {
                for ($i = 0; $i < count($tmp_cart_user_data); $i++) {
                    $product_data = fetch_details(['id' => $tmp_cart_user_data[$i]['product_variant_id']], 'product_variants', 'product_id,availability');
                    if (!empty($product_data[0]['product_id'])) {
                        $pro_details = fetch_product($user_id, null, $product_data[0]['product_id']);
                        if (!empty($pro_details['product'])) {
                            if (trim($pro_details['product'][0]['availability']) == 0 && $pro_details['product'][0]['availability'] != null) {
                                update_details(['is_saved_for_later' => '1'], $cart_user_data[$i]['id'], 'cart');
                                unset($cart_user_data[$i]);
                            }

                            if (!empty($pro_details['product'])) {
                                $cart_user_data[$i]['product_details'] = $pro_details['product'];
                            } else {
                                delete_details(['id' => $cart_user_data[$i]['id']], 'cart');
                                unset($cart_user_data[$i]);
                                continue;
                            }
                        } else {
                            delete_details(['id' => $cart_user_data[$i]['id']], 'cart');
                            unset($cart_user_data[$i]);
                            continue;
                        }
                    } else {
                        delete_details(['id' => $cart_user_data[$i]['id']], 'cart');
                        unset($cart_user_data[$i]);
                        continue;
                    }
                }
            }

            if (empty($cart_user_data)) {
                $this->response['error'] = true;
                $this->response['message'] = 'Cart Is Empty !';
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return;
            }
            $this->response['error'] = false;
            $this->response['message'] = 'Data Retrieved From Cart !';
            $this->response['total_quantity'] = $cart_total_response['quantity'];
            $this->response['sub_total'] = $cart_total_response['overall_amount'];
            $this->response['tax_percentage'] = (isset($cart_total_response['tax_percentage'])) ? $cart_total_response['tax_percentage'] : "0";
            $this->response['tax_amount'] = (isset($cart_total_response['tax_amount'])) ? $cart_total_response['tax_amount'] : "0";
            $this->response['overall_amount'] = round($cart_total_response['overall_amount']);
            $this->response['total_arr'] =  round($cart_total_response['total_arr']);
            $this->response['variant_id'] =  $cart_total_response['variant_id'];
            $this->response['data'] = array_values($cart_user_data);
            print_r(json_encode($this->response));
            return;
        }
    }

    //12. add_to_favorites
    public function add_to_favorites()
    {
        /*
            user_id:15
            type:partners | products
            type_id:60
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean|in_list[partners,products]');
        $this->form_validation->set_rules('type_id', 'Type ID', 'trim|numeric|required|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $user_id = $this->input->post('user_id', true);
            $type = $this->input->post('type', true);
            $type_id = $this->input->post('type_id', true);
            if (is_exist(['user_id' => $user_id, 'type' => $type, 'type_id' => $type_id], 'favorites')) {
                $response["error"]   = true;
                $response["message"] = "Already added to favorite !";
                $response["data"] = array();
                echo json_encode($response);
                return false;
            }
            $data = [
                'user_id' => $user_id,
                'type' => $type,
                'type_id' => $type_id,
            ];
            insert_details($data, "favorites");
            $this->response['error'] = false;
            $this->response['message'] = 'Added to favorite';
            $this->response['data'] = array();
        }
        print_r(json_encode($this->response));
    }

    //remove_from_favorites
    public function remove_from_favorites()
    {
        /*
            user_id:15
            type:partners | products  {optional}
            type_id:60                   {optional}
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean|in_list[partners,products]');
        if (isset($_POST['type']) && !empty($_POST['type']) && (!isset($_POST['type_id']) || empty($_POST['type_id']))) {
            $this->form_validation->set_rules('type_id', 'Type ID', 'trim|required|numeric|xss_clean');
        } else {
            $this->form_validation->set_rules('type_id', 'Type ID', 'trim|numeric|xss_clean');
        }

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $data = ['user_id' => $this->input->post('user_id', true)];
            if (isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['type_id']) && !empty($_POST['type_id'])) {
                $data['type'] = $this->input->post('type', true);
                $data['type_id'] = $this->input->post('type_id', true);
                if (!is_exist(['user_id' => $data['user_id'], 'type' => $data['type'], 'type_id' => $data['type_id']], 'favorites')) {
                    $response["error"]   = true;
                    $response["message"] = "partner or Product not added as favorite !";
                    $response["data"] = array();
                    echo json_encode($response);
                    return false;
                }
            }
            delete_details($data, 'favorites');
            $this->response['error'] = false;
            $this->response['message'] = 'Removed from favorite';
            $this->response['data'] = array();
        }
        print_r(json_encode($this->response));
    }

    //get_favorites
    public function get_favorites()
    {
        /*
            user_id:12
            type:partners | products 
            limit : 10 {optional}
            offset: 0 {optional}
        */
        if (!verify_tokens()) {
            return false;
        }
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean|required|in_list[partners,products]');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $limit = (isset($_POST['limit'])  && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
            $offset = (isset($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $type = (isset($_POST['type']) && !empty(trim($_POST['type']))) ? $this->input->post('type', true) : 'products';

            $result = get_favorites($this->input->post('user_id', true), $type, $limit, $offset);
            if (isset($result) && !empty($result) && isset($result['data']) && !empty($result['data'])) {
                $this->response['error'] = false;
                $this->response['message'] = 'Data Retrieved Successfully';
                $this->response['total'] = (isset($result['total']) && !empty($result['total'])) ? $result['total'] : [];
                $this->response['data'] = (isset($result['data']) && !empty($result['data'])) ? $result['data'] : [];
                print_r(json_encode($this->response));
                return;
            } else {
                $this->response['error'] = true;
                $this->response['message'] = 'No Favourite(s) Product or partner Were Added.';
                $this->response['total'] = [];
                $this->response['data'] = [];
                print_r(json_encode($this->response));
                return;
            }
        }
        print_r(json_encode($this->response));
    }

    //get_notifications()
    public function get_notifications()
    {
        /* 
            sort: id / date_added // { default - id } optional
            order:DESC/ASC      // { default - DESC } optional    
            limit:10            // { default - 25 } {optional}
            offset:0            // { default - 0 } {optional}
        */
        // if (!verify_tokens()) {
        //     return false;
        // }

        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
            $offset = (isset($_POST['offset']) && is_numeric($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $_POST['order'] : 'DESC';
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $_POST['sort'] : 'id';
            $res = $this->notification_model->get_notifications($offset, $limit, $sort, $order);
            $this->response['error'] = false;
            $this->response['message'] = 'Notification Retrieved Successfully';
            $this->response['total'] = $res['total'];
            $this->response['data'] = $res['data'];
        }
        print_r(json_encode($this->response));
    }

    /*
        status: cancelled
        order_id:1201
        reason:test
    */
    public function update_order_status()
    {
        if (!verify_tokens()) {
            return false;
        }
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('order_id', 'Order id', 'trim|required|xss_clean');
        if (isset($_POST['status']) && !empty($_POST['status']) && $_POST['status'] == 'cancelled') {
            $this->form_validation->set_rules('reason', 'reason', 'trim|required|xss_clean');
        }

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return false;
        } else {
            $status = $this->input->post("status", true);
            $order_id = $this->input->post("order_id", true);
            $reason = (isset($_POST['reason']) && !empty($_POST['reason'])) ? $this->input->post('reason', true) : "";


            $res = validate_order_status($order_id, $status, 'orders');
            if ($res['error']) {
                $this->response['error'] = (isset($res['return_request_flag'])) ? false : true;
                $this->response['message'] = $res['message'];
                $this->response['data'] = $res['data'];
                print_r(json_encode($this->response));
                return false;
            }
            $users = fetch_details(['id' => $order_id], "orders", "user_id");

            if ($this->order_model->update_order(['status' => $status, "reason" => $reason, "cancel_by" => $users[0]['user_id']], ['id' => $order_id], true)) {
                $this->order_model->update_order(['active_status' => $status], ['id' => $order_id], false);
                process_refund($order_id, $status, 'orders');
                $data = fetch_details(['order_id' => $order_id], 'order_items', 'product_variant_id,quantity');
                $product_variant_ids = $qtns = [];
                foreach ($data as $d) {
                    array_push($product_variant_ids, $d['product_variant_id']);
                    array_push($qtns, $d['quantity']);
                }

                update_stock($product_variant_ids, $qtns, 'plus');
                $this->response['error'] = false;
                $this->response['message'] = 'Status Updated Successfully';
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            } else {
                $this->response['error'] = true;
                $this->response['message'] = 'Something went wrong! Please try again after some time.';
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            }
        }
    }

    public function add_transaction()
    {
        /*
            transaction_type : transaction / wallet  // { optional - default is transaction }
            user_id : 15 
            order_id:  23
            type : COD / stripe / razorpay / paypal / paystack / flutterwave - for transaction | credit / debit - for wallet
            payment_method:razorpay / paystack / flutterwave        // used for waller credit option, required when transaction_type - wallet and type - credit
            txn_id : 201567892154 
            amount : 450
            status : success / failure
            message : Done 
            skip_verify_transaction:false/true  {if stripe\paypal method then set true here}
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('transaction_type', 'Transaction Type', 'trim|xss_clean');
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('order_id', 'order id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('txn_id', 'Txn', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'message', 'trim|required|xss_clean');
        $this->form_validation->set_rules('skip_verify_transaction', 'skip_verify_transaction', 'trim|xss_clean');
        if (isset($_POST['transaction_type']) && $_POST['transaction_type'] == "wallet" && $_POST['type'] == "credit") {
            $this->form_validation->set_rules('payment_method', 'Payment method', 'trim|required|xss_clean');
        }

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {

            /* if it's a wallet credit transaction then verify the payment with the help of txn_id */
            if (isset($_POST['transaction_type']) && $_POST['transaction_type'] == "wallet" && $_POST['type'] == "credit") {
                $payment_method = $this->input->post('payment_method', true);
                $payment_method = strtolower($payment_method);
                $txn_id = $this->input->post('txn_id', true);
                $user_id = $this->input->post('user_id', true);
                $user = fetch_users($user_id);
                if (empty($user)) {
                    $this->response['error'] = true;
                    $this->response['message'] = "User not found!";
                    $this->response['data'] = [];
                    print_r(json_encode($this->response));
                    return false;
                }
                $old_balance = $user[0]['balance'];
                $skip_verify_transaction = (isset($_POST['skip_verify_transaction'])) ? $_POST['skip_verify_transaction'] : false;

                /* check if this transaction has already been added or not in transactions table */
                $transaction = fetch_details(['txn_id' => $txn_id], 'transactions');
                if (empty($transaction) || (isset($transaction[0]['status']) && strtolower($transaction[0]['status']) != 'success')) {
                    if ($skip_verify_transaction == false) {
                        $payment = verify_payment_transaction($txn_id, $payment_method); /* calling all in one verify payment transaction function */
                        if ($payment['error'] == false) {
                            $this->load->model('customer_model');
                            if (!$this->customer_model->update_balance($payment['amount'], $user_id, 'add')) {
                                $this->response['error'] = true;
                                $this->response['message'] = "Wallet could not be recharged due to database operation failure";
                                $this->response['amount'] = $payment['amount'];
                                $this->response['old_balance'] = "$old_balance";
                                $this->response['new_balance'] = "$old_balance";
                                $this->response['data'] = $payment['data'];
                                print_r(json_encode($this->response));
                                return false;
                            }
                            $new_balance = $old_balance + $payment['amount'];

                            $this->response['amount'] = $payment['amount'];
                            $this->response['old_balance'] = "$old_balance";
                            $this->response['new_balance'] = "$new_balance";
                            $_POST['message'] = "$payment_method - Wallet credited on successful payment confirmation.";
                            $_POST['amount'] = $payment['amount'];
                        } else {
                            $new_balance = $old_balance + $payment['amount'];
                            $this->response['error'] = true;
                            $this->response['message'] = "Wallet could not be recharged! " . $payment['message'];
                            $this->response['amount'] = $payment['amount'];
                            $this->response['old_balance'] = "$old_balance";
                            $this->response['new_balance'] = "$new_balance";
                            $this->response['data'] = [];
                            print_r(json_encode($this->response));
                            return false;
                        }
                    } else {
                        $this->response['error'] = false;
                        $this->response['message'] = "Wallet credited on successful payment confirmation.";
                        $this->response['data'] = [];
                        print_r(json_encode($this->response));
                        return false;
                    }
                } else {
                    $this->response['error'] = true;
                    $this->response['message'] = "Wallet could not be recharged! Transaction has already been added before";
                    $this->response['amount'] = 0;
                    $this->response['old_balance'] = "$old_balance";
                    $this->response['new_balance'] = "$old_balance";
                    $this->response['data'] = [];
                    print_r(json_encode($this->response));
                    return false;
                }
            }

            $transaction_type = (isset($_POST['transaction_type']) && !empty($_POST['transaction_type'])) ? $_POST['transaction_type'] : "transaction";
            $this->Transaction_model->add_transaction($_POST);
            $this->response['error'] = false;
            $this->response['message'] = ($transaction_type == "wallet") ? 'Wallet Transaction Added Successfully' : 'Transaction Added Successfully';
            $this->response['data'] = (!empty($this->response['data'])) ? $this->response['data'] : [];
        }
        print_r(json_encode($this->response));
    }

    //13 get_sections
    public function get_sections()
    {
        /*
                limit:10            // { default - 25 } {optional}
                offset:0            // { default - 0 } {optional}
                user_id:12              {optional}
                section_id:4            {optional}
                top_rated_foods: 1 // { default - 0 } optional
                p_limit:10          // { default - 10 } {optional}
                p_offset:10         // { default - 0 } {optional}    
                p_sort:pv.price      // { default - pid } {optional}
                p_order:asc         // { default - desc } {optional}
                filter_by:p.id|sd.user_id       // {p.id = product list | sd.user_id = partner list}            
                             { default - p.id } optional
                latitude:123                 // {optional}
                longitude:123                // {optional}

            */
        // if (!verify_tokens()) {
        //     return false;
        // }

        $this->form_validation->set_rules('limit', 'Limit', 'trim|xss_clean');
        $this->form_validation->set_rules('offset', 'Offset', 'trim|xss_clean');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section Id', 'trim|xss_clean');
        $this->form_validation->set_rules('p_limit', 'Product Limit', 'trim|xss_clean');
        $this->form_validation->set_rules('p_offset', 'Product Offset', 'trim|xss_clean');
        $this->form_validation->set_rules('p_sort', 'Product Sort', 'trim|xss_clean');
        $this->form_validation->set_rules('p_order', 'Product Order', 'trim|xss_clean');
        $this->form_validation->set_rules('filter_by', ' filter_by ', 'trim|xss_clean');
        $this->form_validation->set_rules('city_id', ' City Id ', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        }
        if (isset($_POST['latitude']) && !empty($_POST['latitude']) && empty($_POST['longitude'])) {
            $this->response['error'] = true;
            $this->response['message'] = "The Longitude Field is Required";
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        }
        if (isset($_POST['longitude']) && !empty($_POST['longitude']) && empty($_POST['latitude'])) {
            $this->response['error'] = true;
            $this->response['message'] = "The Latitude Field is Required";
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        }

        $limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
        $offset = (isset($_POST['offset']) && is_numeric($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
        $user_id = (isset($_POST['user_id']) && !empty(trim($_POST['user_id']))) ? $this->input->post('user_id', true) : 0;
        $section_id = (isset($_POST['section_id']) && !empty(trim($_POST['section_id']))) ? $this->input->post('section_id', true) : 0;
        $filters['product_type'] = (isset($_POST['top_rated_foods']) && $_POST['top_rated_foods'] == 1) ? 'top_rated_foods_including_all_foods' : null;
        $p_limit = (isset($_POST['p_limit']) && !empty(trim($_POST['p_limit']))) ? $this->input->post('p_limit', true) : 10;
        $p_offset = (isset($_POST['p_offset']) && !empty(trim($_POST['p_offset']))) ? $this->input->post('p_offset', true) : 0;
        $p_order = (isset($_POST['p_order']) && !empty(trim($_POST['p_order']))) ? $_POST['p_order'] : 'DESC';
        $p_sort = (isset($_POST['p_sort']) && !empty(trim($_POST['p_sort']))) ? $_POST['p_sort'] : 'p.id';
        $filter_by = (isset($_POST['filter_by']) && !empty($_POST['filter_by'])) ? $this->input->post("filter_by", true) : 'p.id';

        $this->db->select('*');
        if (isset($_POST['section_id']) && !empty($_POST['section_id'])) {
            $this->db->where('id', $section_id);
        }
        $this->db->limit($limit, $offset);
        $sections = $this->db->order_by('row_order')->get('sections')->result_array();

        if (!empty($sections)) {
            for ($i = 0; $i < count($sections); $i++) {
                $product_ids = explode(',', $sections[$i]['product_ids']);
                $product_ids = array_filter($product_ids);
                $filters['show_only_active_products'] = 1;
                if (isset($_POST['top_rated_foods']) && !empty($_POST['top_rated_foods'])) {
                    $filters['product_type'] = (isset($_POST['top_rated_foods']) && $_POST['top_rated_foods'] == 1) ? 'top_rated_foods_including_all_foods' : null;
                } else {
                    if (isset($sections[$i]['product_type']) && !empty($sections[$i]['product_type'])) {
                        $filters['product_type'] = (isset($sections[$i]['product_type'])) ? $sections[$i]['product_type'] : null;
                    }
                }
                $filters['longitude'] = (isset($_POST['longitude']) && !empty($_POST['longitude'])) ? $this->input->post("longitude", true) : 0;
                $filters['latitude'] = (isset($_POST['latitude']) && !empty($_POST['latitude'])) ? $this->input->post("latitude", true) : 0;
                $filters['city_id'] = (isset($_POST['city_id']) && !empty($_POST['city_id'])) ? $this->input->post("city_id", true) : 0;
                $categories = (isset($sections[$i]['categories']) && !empty($sections[$i]['categories']) && $sections[$i]['categories'] != NULL) ? explode(',', $sections[$i]['categories']) : null;

                $products = fetch_product($user_id, (isset($filters)) ? $filters : null, (isset($product_ids) && !empty($product_ids)) ? $product_ids : null, $categories, $p_limit, $p_offset, $p_sort, $p_order, null, null, null, $filter_by);
                if (!empty($products['product'])) {
                    $this->response['error'] = false;
                    $this->response['message'] = "Sections retrived successfully";
                    $sections[$i]['title'] =  output_escaping($sections[$i]['title']);
                    $sections[$i]['short_description'] =  output_escaping($sections[$i]['short_description']);
                    $sections[$i]['categories'] =  (isset($sections[$i]['categories']) && !empty($sections[$i]['categories'])) ? $sections[$i]['categories'] : "";
                    $sections[$i]['product_ids'] =  (isset($sections[$i]['product_ids']) && !empty($sections[$i]['product_ids'])) ? $sections[$i]['product_ids'] : "";
                    $sections[$i]['total'] =  strval(count($products['product']));
                    $sections[$i]['filters'] = (isset($products['filters'])) ? $products['filters'] : [];
                    $sections[$i]['product_tags'] = (isset($products['product_tags']) && !empty($products['product_tags'])) ? $products['product_tags'] : [];
                    $sections[$i]['partner_tags'] = (isset($products['partner_tags']) && !empty($products['partner_tags'])) ? $products['partner_tags'] : [];
                    $sections[$i]['product_details'] =  $products['product'];
                    unset($sections[$i]['product_details'][0]['total']);
                } else {
                    $this->response['error'] = false;
                    $this->response['message'] = "Sections retrived successfully";
                    $sections[$i]['total'] = "0";
                    $sections[$i]['filters'] = [];
                    $sections[$i]['product_details'] =  [];
                }
            }
            $this->response['data'] = $sections;
        } else {
            $this->response['error'] = true;
            $this->response['message'] = "No sections are available";
            $this->response['data'] = array();
        }
        print_r(json_encode($this->response));
    }

    //17. get_faqs
    public function get_faqs()
    {
        // if (!verify_tokens()) {
        //     return false;
        // }

        /*
            limit:25                // { default - 25 } optional
            offset:0                // { default - 0 } optional
            sort: id   			    // { default - id } optional
            order:DESC/ASC          // { default - DESC } optional
        */

        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
            $offset = (isset($_POST['offset']) && is_numeric($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $_POST['order'] : 'DESC';
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $_POST['sort'] : 'id';
            $res = $this->faq_model->get_faqs($offset, $limit, $sort, $order);
            $this->response['error'] = false;
            $this->response['message'] = 'FAQ(s) Retrieved Successfully';
            $this->response['total'] = $res['total'];
            $this->response['data'] = $res['data'];
        }

        print_r(json_encode($this->response));
    }

    public function transactions()
    {
        /*
            user_id:73 
            id: 1001                // { optional}
            transaction_type:transaction / wallet / epoints { default - transaction } optional
            type : COD / stripe / razorpay / paypal / paystack / flutterwave - for transaction | credit / debit - for wallet // { optional }
            search : Search keyword // { optional }
            limit:25                // { default - 25 } optional
            offset:0                // { default - 0 } optional
            sort: id / date_created // { default - id } optional
            order:DESC/ASC          // { default - DESC } optional
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('transaction_type', 'Transaction Type', 'trim|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean');
        $this->form_validation->set_rules('search', 'Search keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $user_id = (isset($_POST['user_id']) && is_numeric($_POST['user_id']) && !empty(trim($_POST['user_id']))) ? $this->input->post('user_id', true) : "";
            $id = (isset($_POST['id']) && is_numeric($_POST['id']) && !empty(trim($_POST['id']))) ? $this->input->post('id', true) : "";
            $transaction_type = (isset($_POST['transaction_type']) && !empty(trim($_POST['transaction_type']))) ? $this->input->post('transaction_type', true) : "transaction";
            $type = (isset($_POST['type']) && !empty(trim($_POST['type']))) ? $this->input->post('type', true) : "";
            $search = (isset($_POST['search']) && !empty(trim($_POST['search']))) ? $this->input->post('search', true) : "";
            $limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
            $offset = (isset($_POST['offset']) && is_numeric($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $_POST['order'] : 'DESC';
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $_POST['sort'] : 'id';
            $res = $this->Transaction_model->get_transactions($id, $user_id, $transaction_type, $type, $search, $offset, $limit, $sort, $order);
            $field = $transaction_type == 'epoints' ? 'epoints' : 'balance';
            $this->response['error'] = false;
            $this->response['message'] = 'Transactions Retrieved Successfully';
            $this->response['total'] = $res['total'];
            $this->response['balance'] = get_user_balance($user_id, $field);
            $this->response['data'] = $res['data'];
        }

        print_r(json_encode($this->response));
    }

    public function delete_order()
    {
        /*
            order_id:1
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $order_id = $_POST['order_id'];
            delete_details(['id' => $order_id], 'orders');
            delete_details(['order_id' => $order_id], 'order_items');

            $this->response['error'] = false;
            $this->response['message'] = 'Order deleted successfully';
            $this->response['data'] = array();
        }
        print_r(json_encode($this->response));
    }

    public function get_ticket_types()
    {
        if (!verify_tokens()) {
            return false;
        }

        $this->db->select('*');
        $types = $this->db->get('ticket_types')->result_array();
        if (!empty($types)) {
            for ($i = 0; $i < count($types); $i++) {
                $types[$i] = output_escaping($types[$i]);
            }
        }
        $this->response['error'] = false;
        $this->response['message'] = 'Ticket types fetched successfully';
        $this->response['data'] = $types;
        print_r(json_encode($this->response));
    }

    public function add_ticket()
    {
        /*
            ticket_type_id:1
            subject:product_image not displying
            email:test@gmail.com
            description:its not showing images of products in web
            user_id:1
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('ticket_type_id', 'Ticket Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');


        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $ticket_type_id = $this->input->post('ticket_type_id', true);
            $user_id = $this->input->post('user_id', true);
            $subject = $this->input->post('subject', true);
            $email = $this->input->post('email', true);
            $description = $this->input->post('description', true);
            $user = fetch_users($user_id);
            if (empty($user)) {
                $this->response['error'] = true;
                $this->response['message'] = "User not found!";
                $this->response['data'] = [];
                print_r(json_encode($this->response));
                return false;
            }
            $data = array(
                'ticket_type_id' => $ticket_type_id,
                'user_id' => $user_id,
                'subject' => $subject,
                'email' => $email,
                'description' => $description,
                'status' => PENDING,
            );
            $insert_id = $this->ticket_model->add_ticket($data);
            if (!empty($insert_id)) {
                $result = $this->ticket_model->get_tickets($insert_id, $ticket_type_id, $user_id);
                $this->response['error'] = false;
                $this->response['message'] =  'Ticket Added Successfully';
                $this->response['data'] = $result['data'];
            } else {
                $this->response['error'] = true;
                $this->response['message'] =  'Ticket Not Added';
                $this->response['data'] = (!empty($this->response['data'])) ? $this->response['data'] : [];
            }
        }
        print_r(json_encode($this->response));
    }
    //29. edit_ticket
    public function edit_ticket()
    {
        /*
            ticket_id:1
            ticket_type_id:1
            subject:product_image not displying
            email:test@gmail.com
            description:its not showing attachments of products in web
            user_id:1
            status:3 or 5 [3 -> resolved, 5 -> reopened]
            [1 -> pending, 2 -> opened, 3 -> resolved, 4 -> closed, 5 -> reopened]
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('ticket_type_id', 'Ticket Type Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ticket_id', 'Ticket Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');


        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $status = $this->input->post('status', true);
            $ticket_id = $this->input->post('ticket_id', true);
            $user_id = $this->input->post('user_id', true);
            $res = fetch_details('id=' . $ticket_id . ' and user_id=' . $user_id, 'tickets', '*');
            if (empty($res)) {
                $this->response['error'] = true;
                $this->response['message'] = "User id is changed you can not udpate the ticket.";
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            }
            if ($status == RESOLVED && $res[0]['status'] == CLOSED) {
                $this->response['error'] = true;
                $this->response['message'] = "Current status is closed.";
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            }
            if ($status == REOPEN && ($res[0]['status'] == PENDING || $res[0]['status'] == OPENED)) {
                $this->response['error'] = true;
                $this->response['message'] = "Current status is pending or opened.";
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            }
            $ticket_type_id = $this->input->post('ticket_type_id', true);
            $user_id = $this->input->post('user_id', true);
            $subject = $this->input->post('subject', true);
            $email = $this->input->post('email', true);
            $description = $this->input->post('description', true);
            $user = fetch_users($user_id);
            if (empty($user)) {
                $this->response['error'] = true;
                $this->response['message'] = "User not found!";
                $this->response['data'] = [];
                print_r(json_encode($this->response));
                return false;
            }
            $data = array(
                'ticket_type_id' => $ticket_type_id,
                'user_id' => $user_id,
                'subject' => $subject,
                'email' => $email,
                'description' => $description,
                'status' => $status,
                'ticket_id' => $ticket_id,
                'edit_ticket' => $ticket_id
            );
            if (!$this->ticket_model->add_ticket($data)) {
                $result = $this->ticket_model->get_tickets($ticket_id, $ticket_type_id, $user_id);
                $this->response['error'] = false;
                $this->response['message'] =  'Ticket updated Successfully';
                $this->response['data'] = $result['data'];
            } else {
                $this->response['error'] = true;
                $this->response['message'] =  'Ticket Not Added';
                $this->response['data'] = (!empty($this->response['data'])) ? $this->response['data'] : [];
            }
        }
        print_r(json_encode($this->response));
    }

    //40. send_message
    public function send_message()
    {
        /*
            user_type:user
            user_id:1
            ticket_id:1	
            message:test	
            attachments[]:files  {optional} {type allowed -> image,video,document,spreadsheet,archive}
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_type', 'User Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('ticket_id', 'Ticket id', 'trim|required|numeric|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $user_type = $this->input->post('user_type', true);
            $user_id = $this->input->post('user_id', true);
            $ticket_id = $this->input->post('ticket_id', true);
            $message = (isset($_POST['message']) && !empty(trim($_POST['message']))) ? $this->input->post('message', true) : "";


            $user = fetch_users($user_id);
            if (empty($user)) {
                $this->response['error'] = true;
                $this->response['message'] = "User not found!";
                $this->response['data'] = [];
                print_r(json_encode($this->response));
                return false;
            }
            if (!file_exists(FCPATH . TICKET_IMG_PATH)) {
                mkdir(FCPATH . TICKET_IMG_PATH, 0777);
            }

            $temp_array = array();
            $files = $_FILES;
            $images_new_name_arr = array();
            $images_info_error = "";
            $allowed_media_types = implode('|', allowed_media_types());
            $config = [
                'upload_path' =>  FCPATH . TICKET_IMG_PATH,
                'allowed_types' => $allowed_media_types,
                'max_size' => 8000,
            ];


            if (!empty($_FILES['attachments']['name'][0]) && isset($_FILES['attachments']['name'])) {
                $other_image_cnt = count($_FILES['attachments']['name']);
                $other_img = $this->upload;
                $other_img->initialize($config);

                for ($i = 0; $i < $other_image_cnt; $i++) {

                    if (!empty($_FILES['attachments']['name'][$i])) {

                        $_FILES['temp_image']['name'] = $files['attachments']['name'][$i];
                        $_FILES['temp_image']['type'] = $files['attachments']['type'][$i];
                        $_FILES['temp_image']['tmp_name'] = $files['attachments']['tmp_name'][$i];
                        $_FILES['temp_image']['error'] = $files['attachments']['error'][$i];
                        $_FILES['temp_image']['size'] = $files['attachments']['size'][$i];
                        if (!$other_img->do_upload('temp_image')) {
                            $images_info_error = 'attachments :' . $images_info_error . ' ' . $other_img->display_errors();
                        } else {
                            $temp_array = $other_img->data();
                            resize_review_images($temp_array, FCPATH . TICKET_IMG_PATH);
                            $images_new_name_arr[$i] = TICKET_IMG_PATH . $temp_array['file_name'];
                        }
                    } else {
                        $_FILES['temp_image']['name'] = $files['attachments']['name'][$i];
                        $_FILES['temp_image']['type'] = $files['attachments']['type'][$i];
                        $_FILES['temp_image']['tmp_name'] = $files['attachments']['tmp_name'][$i];
                        $_FILES['temp_image']['error'] = $files['attachments']['error'][$i];
                        $_FILES['temp_image']['size'] = $files['attachments']['size'][$i];
                        if (!$other_img->do_upload('temp_image')) {
                            $images_info_error = $other_img->display_errors();
                        }
                    }
                }

                //Deleting Uploaded attachments if any overall error occured
                if ($images_info_error != NULL || !$this->form_validation->run()) {
                    if (isset($images_new_name_arr) && !empty($images_new_name_arr || !$this->form_validation->run())) {
                        foreach ($images_new_name_arr as $key => $val) {
                            unlink(FCPATH . TICKET_IMG_PATH . $images_new_name_arr[$key]);
                        }
                    }
                }
            }
            if ($images_info_error != NULL) {
                $this->response['error'] = true;
                $this->response['message'] =  $images_info_error;
                print_r(json_encode($this->response));
                return false;
            }
            $data = array(
                'user_type' => $user_type,
                'user_id' => $user_id,
                'ticket_id' => $ticket_id,
                'message' => $message
            );
            if (!empty($_FILES['attachments']['name'][0]) && isset($_FILES['attachments']['name'])) {
                $data['attachments'] = $images_new_name_arr;
            }
            $insert_id = $this->ticket_model->add_ticket_message($data);
            if (!empty($insert_id)) {
                $data1 = $this->config->item('type');
                $result = $this->ticket_model->get_messages($ticket_id, $user_id, "", "", "1", "", "", $data1, $insert_id);
                if (!empty($result)) {
                    /* Send notification */
                    $user_roles = fetch_details("", "user_permissions", '*', '',  '', '', '');
                    foreach ($user_roles as $user) {
                        $user_res = fetch_details(['id' => $user['user_id']], 'users', 'fcm_id');
                        $fcm_ids[0][] = $user_res[0]['fcm_id'];
                    }
                    $fcm_admin_msg = (!empty($result['data'][0]['message'])) ? $result['data'][0]['message'] : "Attachments";
                    $fcm_admin_subject = (!empty($result['data'][0]['subject'])) ? $result['data'][0]['subject'] : "Ticket Message";
                    if (!empty($fcm_ids)) {
                        $fcmMsg = array(
                            'title' => $fcm_admin_subject,
                            'body' => $fcm_admin_msg,
                            'type' => "ticket_message",
                            'type_id' => $ticket_id,
                            'chat' => json_encode($result['data']),
                            'content_available' => true
                        );
                        send_notification($fcmMsg, $fcm_ids);
                    }
                }
                $this->response['error'] = false;
                $this->response['message'] =  'Ticket Message Added Successfully!';
                $this->response['data'] = $result['data'][0];
            } else {
                $this->response['error'] = true;
                $this->response['message'] =  'Ticket Message Not Added';
                $this->response['data'] = (!empty($this->response['data'])) ? $this->response['data'] : [];
            }
        }
        print_r(json_encode($this->response));
    }

    //41. get_tickets
    public function get_tickets()
    {
        /*
        31. get_tickets
            ticket_id: 1001                // { optional}
            ticket_type_id: 1001                // { optional}
            user_id: 1001                // { optional}
            status:   [1 -> pending, 2 -> opened, 3 -> resolved, 4 -> closed, 5 -> reopened]// { optional}
            search : Search keyword // { optional }
            limit:25                // { default - 25 } optional
            offset:0                // { default - 0 } optional
            sort: id | date_created | last_updated                // { default - id } optional
            order:DESC/ASC          // { default - DESC } optional
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('ticket_id', 'Ticket ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('ticket_type_id', 'Ticket Type ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('status', 'User ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('search', 'Search keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $ticket_id = (isset($_POST['ticket_id']) && is_numeric($_POST['ticket_id']) && !empty(trim($_POST['ticket_id']))) ? $this->input->post('ticket_id', true) : "";
            $ticket_type_id = (isset($_POST['ticket_type_id']) && is_numeric($_POST['ticket_type_id']) && !empty(trim($_POST['ticket_type_id']))) ? $this->input->post('ticket_type_id', true) : "";
            $user_id = (isset($_POST['user_id']) && is_numeric($_POST['user_id']) && !empty(trim($_POST['user_id']))) ? $this->input->post('user_id', true) : "";
            $status = (isset($_POST['status']) && is_numeric($_POST['status']) && !empty(trim($_POST['status']))) ? $this->input->post('status', true) : "";
            $search = (isset($_POST['search']) && !empty(trim($_POST['search']))) ? $this->input->post('search', true) : "";
            $limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 10;
            $offset = (isset($_POST['offset']) && is_numeric($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $_POST['order'] : 'DESC';
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $_POST['sort'] : 'id';
            $result = $this->ticket_model->get_tickets($ticket_id, $ticket_type_id, $user_id, $status, $search, $offset, $limit, $sort, $order);
            print_r(json_encode($result));
        }
    }

    //42. get_messages
    public function get_messages()
    {
        /*
        42. get_messages
        ticket_id: 1001            
        user_type: 1001                // { optional}
        user_id: 1001                // { optional}
        search : Search keyword // { optional }
        limit:25                // { default - 25 } optional
        offset:0                // { default - 0 } optional
        sort: id | date_created | last_updated                // { default - id } optional
        order:DESC/ASC          // { default - DESC } optional
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('ticket_id', 'Ticket ID', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('status', 'User ID', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('search', 'Search keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $ticket_id = (isset($_POST['ticket_id']) && is_numeric($_POST['ticket_id']) && !empty(trim($_POST['ticket_id']))) ? $this->input->post('ticket_id', true) : "";
            $user_id = (isset($_POST['user_id']) && is_numeric($_POST['user_id']) && !empty(trim($_POST['user_id']))) ? $this->input->post('user_id', true) : "";
            $search = (isset($_POST['search']) && !empty(trim($_POST['search']))) ? $this->input->post('search', true) : "";
            $limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 10;
            $offset = (isset($_POST['offset']) && is_numeric($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $_POST['order'] : 'DESC';
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $_POST['sort'] : 'id';
            $data = $this->config->item('type');
            $result = $this->ticket_model->get_messages($ticket_id, $user_id, $search, $offset, $limit, $sort, $order, $data, "");
            print_r(json_encode($result));
        }
    }

    public function set_rider_rating()
    {
        /*
            user_id: 21
            rider_id: 33
            rating: 4.2
            comment: Done {optional}
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('rider_id', 'Rider Id', 'trim|numeric|xss_clean|required');
        $this->form_validation->set_rules('rating', 'Rating', 'trim|numeric|xss_clean|greater_than[0]|less_than[6]');
        $this->form_validation->set_rules('comment', 'Comment', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $response['error'] = true;
            $response['message'] = strip_tags(validation_errors());
            $response['data'] = array();
            echo json_encode($response);
        } else {

            $user_id = $this->input->post("user_id", true);
            $rider_id = $this->input->post("rider_id", true);
            $res = $this->db->select('id')
                ->where(['rider_id' => $rider_id, 'user_id' => $user_id, "active_status" => "delivered"])->order_by('id', "DESC")->limit(1)->get('orders')->result_array();
            if (empty($res)) {
                $response['error'] = true;
                $response['message'] = 'You cannot review as the Rider is not Delivere yet or this delviery boy were not delivered your order!';
                $response['data'] = array();
                echo json_encode($response);
                return;
            }

            $this->rating_model->set_rider_rating($_POST);
            $rating_data = $this->rating_model->fetch_rider_rating((isset($_POST['rider_id'])) ? $_POST['rider_id'] : '', '', '25', '0', 'id', 'DESC');
            $rating['no_of_rating'] = (isset($rating_data['no_of_rating']) && !empty($rating_data['no_of_rating'])) ? $rating_data['no_of_rating'] : "0";
            $rating['rider_rating'] = (isset($rating_data['rating']) && !empty($rating_data['rating'])) ? $rating_data['rating'] : "0";
            $rating['product_rating'] = $rating_data['rider_rating'];
            $response['error'] = false;
            $response['message'] = 'Product Rated Successfully';
            $response['data'] = $rating;
            echo json_encode($response);
            return;
        }
    }

    // get_rider_rating
    /*
        rider_id : 12
        user_id : 1 		{optional}
        limit:25                // { default - 25 } optional
        offset:0                // { default - 0 } optional
        sort: u.id   			// { default - u.id } optional
        order:DESC/ASC          // { default - DESC } optional
    */
    public function get_rider_rating()
    {
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('rider_id', 'Rider Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        }
        $limit = (isset($_POST['limit'])  && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
        $offset = (isset($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
        $sort = (isset($_POST['sort(array)']) && !empty(trim($_POST['sort']))) ? $this->input->post('sort', true) : 'u.id';
        $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $this->input->post('order', true) : 'DESC';

        $rating = $this->rating_model->fetch_rider_rating((isset($_POST['rider_id'])) ? $this->input->post('rider_id', true) : '', (isset($_POST['user_id'])) ? $this->input->post('user_id', true) : '', $limit, $offset, $sort, $order, '');
        if (!empty($rating)) {
            $response['error'] = false;
            $response['message'] = 'Rating retrieved successfully';
            $response['no_of_rating'] = (!empty($rating['no_of_rating'])) ? $rating['no_of_rating'] : "0";
            $response['total'] = $rating['total_reviews'];
            $response['star_1'] = $rating['star_1'];
            $response['star_2'] = $rating['star_2'];
            $response['star_3'] = $rating['star_3'];
            $response['star_4'] = $rating['star_4'];
            $response['star_5'] = $rating['star_5'];
            $response['rider_rating'] = (!empty($rating['rating'])) ? $rating['rating'] : "0";
            $response['data'] = $rating['rider_rating'];
        } else {
            $response['error'] = true;
            $response['message'] = 'No ratings found !';
            $response['no_of_rating'] = array();
            $response['data'] = array();
        }
        echo json_encode($response);
    }

    //  delete_rider_rating
    public function delete_rider_rating()
    {
        /*
        rating_id:32
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('rating_id', 'Rating Id', 'trim|numeric|required|xss_clean');

        if (!$this->form_validation->run()) {
            $response['error'] = true;
            $response['message'] = strip_tags(validation_errors());
            $response['data'] = array();
            echo json_encode($response);
        } else {
            $this->rating_model->delete_rider_rating($_POST['rating_id']);
            $response['error'] = false;
            $response['message'] = 'Deleted Rating Successfully';
            $response['data'] = array();
            echo json_encode($response);
        }
    }

    public function stripe_webhook()
    {
        $this->load->library(['stripe']);
        $credentials = $this->stripe->get_credentials();

        $request_body = file_get_contents('php://input');
        $event = json_decode($request_body, FALSE);
        log_message('error', 'Stripe Webhook --> ' . var_export($event, true));
        log_message('error', 'Stripe Webhook SERVER Variable --> ' . var_export($_SERVER, true));

        if (!empty($event->data->object->payment_intent)) {
            $txn_id = (isset($event->data->object->payment_intent)) ? $event->data->object->payment_intent : "";

            // $txn_id = "pi_1IEZnFBpktnZYCfOuAquYdTv";
            if (!empty($txn_id)) {
                $transaction = fetch_details(['txn_id' => $txn_id], 'transactions', '*');
                if (!empty($transaction)) {
                    $order_id = $transaction[0]['order_id'];
                    $user_id = $transaction[0]['user_id'];
                } else {
                    $order_id = $event->data->metadata->order_id;
                    $order_data = fetch_orders($order_id);
                    $user_id = $order_data['order_data'][0]['user_id'];
                }
            }
            $amount = $event->data->object->amount;
            $currency = $event->data->object->currency;
            $balance_transaction = $event->data->object->balance_transaction;
        } else {
            $order_id = 0;
            $amount = 0;
            $currency = (isset($event->data->object->currency)) ? $event->data->object->currency : "";
            $balance_transaction = 0;
        }

        /* Wallet refill has unique format for order ID - wallet-refill-user-{user_id}-{system_time}-{3 random_number}  */
        if (empty($order_id)) {
            $order_id = (!empty($event->data->object->metadata) && isset($event->data->object->metadata->order_id)) ? $event->data->object->metadata->order_id : 0;
        }

        if (!is_numeric($order_id) && strpos($order_id, "wallet-refill-user") !== false) {
            $temp = explode("-", $order_id);
            if (isset($temp[3]) && is_numeric($temp[3]) && !empty($temp[3] && $temp[3] != '')) {
                $user_id = $temp[3];
            } else {
                $user_id = 0;
            }
        }

        $http_stripe_signature = isset($_SERVER['HTTP_STRIPE_SIGNATURE']) ? $_SERVER['HTTP_STRIPE_SIGNATURE'] : "";
        $result = $this->stripe->construct_event($request_body, $http_stripe_signature, $credentials['webhook_key']);

        if ($result == "Matched") {
            if ($event->type == 'charge.succeeded') {
                if (!empty($order_id)) {
                    /* To do the wallet recharge if the order id is set in the patter */
                    if (strpos($order_id, "wallet-refill-user") !== false) {
                        $data['transaction_type'] = "wallet";
                        $data['user_id'] = $user_id;
                        $data['order_id'] = $order_id;
                        $data['type'] = "credit";
                        $data['txn_id'] = $txn_id;
                        $data['amount'] = $amount / 100;
                        $data['status'] = "success";
                        $data['message'] = "Wallet refill successful";
                        $this->transaction_model->add_transaction($data);

                        $this->load->model('customer_model');
                        if ($this->customer_model->update_balance($amount / 100, $user_id, 'add')) {
                            $response['error'] = false;
                            $response['transaction_status'] = $event->type;
                            $response['message'] = "Wallet recharged successfully!";
                        } else {
                            $response['error'] = true;
                            $response['transaction_status'] = $event->type;
                            $response['message'] = "Wallet could not be recharged!";
                            log_message('error', 'Stripe Webhook | wallet recharge failure --> ' . var_export($event, true));
                        }
                        echo json_encode($response);
                        return false;
                    } else {

                        /* process the order and mark it as received */
                        $order = fetch_orders($order_id, false, false, false, false, false, false, false);
                        // log_message('error', 'Stripe Webhook | order --> ' . var_export($order, true));
                        if (isset($order['order_data'][0]['user_id'])) {
                            $user = fetch_details(['id' => $order['order_data'][0]['user_id']], 'users');

                            if (isset($user[0]['email']) && !empty($user[0]['email'])) {
                                send_mail($user[0]['email'], 'Wait for Order Confirmation', 'Thanks for your order. We will let you know once your order confirm by partner on this email ID.');
                            }
                            /* No need to add because the transaction is already added just update the transaction status */
                            if (!empty($transaction)) {
                                $transaction_id = $transaction[0]['id'];
                                update_details(['status' => 'success'], ['id' => $transaction_id], 'transactions');
                            } else {
                                /* add transaction of the payment */
                                $amount = ($event->data->object->amount / 100);
                                $data = [
                                    'transaction_type' => 'transaction',
                                    'user_id' => $user_id,
                                    'order_id' => $order_id,
                                    'type' => 'stripe',
                                    'txn_id' => $txn_id,
                                    'amount' => $amount,
                                    'status' => 'success',
                                    'message' => 'order placed successfully',
                                ];
                                $this->transaction_model->add_transaction($data);
                            }

                            /* add transaction of the payment */

                            update_details(['active_status' => 'pending'], ['id' => $order_id], 'orders');
                            $status = json_encode(array(array('pending', date("d-m-Y h:i:sa"))));
                            update_details(['status' => $status], ['id' => $order_id], 'orders', false);
                        }
                    }
                } else {
                    /* No order ID found */
                    // log_message('error', 'Stripe Webhook | No Order ID found --> ' . var_export($event, true));
                }

                $response['error'] = false;
                $response['transaction_status'] = $event->type;
                $response['message'] = "Transaction successfully done";
                echo json_encode($response);
                return false;
            } elseif ($event->type == 'charge.failed') {
                if (!empty($order_id)) {
                    update_details(['active_status' => 'cancelled'], ['id' => $order_id], 'orders');
                }
                /* No need to add because the transaction is already added just update the transaction status */
                if (!empty($transaction)) {
                    $transaction_id = $transaction[0]['id'];
                    update_details(['status' => 'failed'], ['id' => $transaction_id], 'transactions');
                }
                $response['error'] = true;
                $response['transaction_status'] = $event->type;
                $response['message'] = "Transaction is failed. ";
                // log_message('error', 'Stripe Webhook | Transaction is failed --> ' . var_export($event, true));
                echo json_encode($response);
                return false;
            } elseif ($event->type == 'charge.pending') {
                $response['error'] = false;
                $response['transaction_status'] = $event->type;
                $response['message'] = "Waiting customer to finish transaction ";
                // log_message('error', 'Stripe Webhook | Waiting customer to finish transaction --> ' . var_export($event, true));
                echo json_encode($response);
                return false;
            } elseif ($event->type == 'charge.expired') {
                if (!empty($order_id)) {
                    update_details(['active_status' => 'cancelled'], ['id' => $order_id], 'orders');
                }
                /* No need to add because the transaction is already added just update the transaction status */
                if (!empty($transaction)) {
                    $transaction_id = $transaction[0]['id'];
                    update_details(['status' => 'expired'], ['id' => $transaction_id], 'transactions');
                }
                $response['error'] = true;
                $response['transaction_status'] = $event->type;
                $response['message'] = "Transaction is expired.";
                // log_message('error', 'Stripe Webhook | Transaction is expired --> ' . var_export($event, true));
                echo json_encode($response);
                return false;
            } elseif ($event->type == 'charge.refunded') {
                if (!empty($order_id)) {
                    update_details(['active_status' => 'cancelled'], ['id' => $order_id], 'orders');
                }
                /* No need to add because the transaction is already added just update the transaction status */
                if (!empty($transaction)) {
                    $transaction_id = $transaction[0]['id'];
                    update_details(['status' => 'refunded'], ['id' => $transaction_id], 'transactions');
                }
                $response['error'] = true;
                $response['transaction_status'] = $event->type;
                $response['message'] = "Transaction is refunded.";
                // log_message('error', 'Stripe Webhook | Transaction is refunded --> ' . var_export($event, true));
                echo json_encode($response);
                return false;
            } else {
                $response['error'] = true;
                $response['transaction_status'] = $event->type;
                $response['message'] = "Transaction could not be detected.";
                // log_message('error', 'Stripe Webhook | Transaction could not be detected --> ' . var_export($event, true));
                echo json_encode($response);
                return false;
            }
        } else {
            log_message('error', 'Stripe Webhook | Invalid Server Signature  --> ' . var_export($result, true));
            return false;
        }
    }

    public function payment_intent()

    {

        $this->load->library(['stripe']);

        $this->load->library(['razorpay']);

        $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required|xss_clean');

        $this->form_validation->set_rules('type', 'type', 'trim|required|xss_clean');



        if (!$this->form_validation->run()) {

            $this->response['error'] = true;

            $this->response['message'] = strip_tags(validation_errors());

            $this->response['data'] = array();

            print_r(json_encode($this->response));

            return false;
        } else {

            $order_id = $_POST['order_id'];

            $order_details = fetch_details(['id' => $order_id], 'orders', 'final_total,user_id');

            if ($_POST['type'] == 'stripe') {

                $data =   $this->stripe->create_payment_intent([

                    'amount' => round($order_details[0]['final_total']),

                ]);

                $this->response['error'] = true;

                $this->response['message'] = "Details fetched successfuly";

                $this->response['data'] = $data;

                print_r(json_encode($this->response));
            } else if ($_POST['type'] == 'razorpay') {

                $this->razorpay->create_order([

                    'amount' => $order_details[0]['final_total'],



                ]);
            } else {

                $this->response['error'] = true;

                $this->response['message'] = "please select type";

                $this->response['data'] = array();

                print_r(json_encode($this->response));

                return false;
            }
        }
    }
    public function generate_paytm_checksum()
    {
        /*
            order_id:1001
            amount:1099
            user_id:73              //{ optional } 
            industry_type:Industry  //{ optional } 
            channel_id:WAP          //{ optional }
            website:website link    //{ optional }
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->load->library(['paytm']);
        $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|xss_clean');
        $this->form_validation->set_rules('industry_type', 'Industry Type', 'trim|xss_clean');
        $this->form_validation->set_rules('channel_id', 'Channel ID', 'trim|xss_clean');
        $this->form_validation->set_rules('website', 'Website', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return false;
        } else {
            $settings = get_settings('payment_method', true);
            $credentials = $this->paytm->get_credentials();

            $paytm_params["MID"] = $settings['paytm_merchant_id'];

            $paytm_params["ORDER_ID"] = $this->input->post('order_id', true);
            $paytm_params["TXN_AMOUNT"] = $this->input->post('amount', true);
            $paytm_params["CUST_ID"] = $this->input->post('user_id', true);
            // $paytm_params["INDUSTRY_TYPE_ID"] = $this->input->post('industry_type', true);
            // $paytm_params["CHANNEL_ID"] = $this->input->post('channel_id', true);
            $paytm_params["WEBSITE"] = $this->input->post('website', true);
            $paytm_params["CALLBACK_URL"] = $credentials['url'] . "theia/paytmCallback?ORDER_ID=" . $paytm_params["ORDER_ID"];

            /**
             * Generate checksum by parameters we have
             * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
             */
            $paytm_checksum = $this->paytm->generateSignature($paytm_params, $settings['paytm_merchant_key']);

            // echo sprintf("generateSignature Returns: %s\n", $paytm_checksum);
            if (!empty($paytm_checksum)) {
                $response['error'] = false;
                $response['message'] = "Checksum created successfully";
                $response['order id'] = $paytm_params["ORDER_ID"];
                $response['data'] = $paytm_params;
                $response['signature'] = $paytm_checksum;
                print_r(json_encode($response));
                return false;
            } else {
                $response['error'] = true;
                $response['message'] = "Data not found!";
                print_r(json_encode($response));
                return false;
            }
        }
    }

    public function generate_paytm_txn_token()
    {
        /*
            amount:100.00
            order_id:102
            user_id:73
            industry_type:      //{optional}
            channel_id:      //{optional}
            website:      //{optional}
        */

        $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('industry_type', 'Industry Type', 'trim|xss_clean');
        $this->form_validation->set_rules('channel_id', 'Channel ID', 'trim|xss_clean');
        $this->form_validation->set_rules('website', 'Website', 'trim|xss_clean');

        if (!verify_tokens()) {
            return false;
        }


        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return false;
        } else {
            $this->load->library('paytm');
            $credentials = $this->paytm->get_credentials();
            $order_id = $_POST['order_id'];
            $amount = $_POST['amount'];
            $user_id = $_POST['user_id'];
            $paytmParams = array();

            $paytmParams["body"] = array(
                "requestType"   => "Payment",
                "mid"           => $credentials['paytm_merchant_id'],
                "websiteName"   => "WEBSTAGING",
                "orderId"       => $order_id,
                "callbackUrl"   => $credentials['url'] . "theia/paytmCallback?ORDER_ID=" . $order_id,
                "txnAmount"     => array(
                    "value"     => $amount,
                    "currency"  => "INR",
                ),
                "userInfo"      => array(
                    "custId"    => $user_id,
                ),
            );

            /*
            * Generate checksum by parameters we have in body
            * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
            */
            $checksum = $this->paytm->generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $credentials['paytm_merchant_key']);

            $paytmParams["head"] = array(
                "signature"    => $checksum
            );

            $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

            /* for Staging */
            $url = $credentials['url'] . "/theia/api/v1/initiateTransaction?mid=" . $credentials['paytm_merchant_id'] . "&orderId=" . $order_id;

            /* for Production */
            // $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=YOUR_MID_HERE&orderId=ORDERID_98765";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $paytm_response = curl_exec($ch);

            if (!empty($paytm_response)) {
                $paytm_response = json_decode($paytm_response, true);
                if (isset($paytm_response['body']['resultInfo']['resultMsg']) && ($paytm_response['body']['resultInfo']['resultMsg'] == "Success" || $paytm_response['body']['resultInfo']['resultMsg'] == "Success Idempotent")) {
                    $response['error'] = false;
                    $response['message'] = "Transaction token generated successfully";
                    $response['txn_token'] = $paytm_response['body']['txnToken'];
                    $response['paytm_response'] = $paytm_response;
                } else {
                    $response['error'] = true;
                    $response['message'] = $paytm_response['body']['resultInfo']['resultMsg'];
                    $response['txn_token'] = "";
                    $response['paytm_response'] = $paytm_response;
                }
            } else {
                $response['error'] = true;
                $response['message'] = "Could not generate transaction token. Try again!";
                $response['txn_token'] = "";
                $response['paytm_response'] = $paytm_response;
            }
            print_r(json_encode($response));
        }
    }
    public function validate_paytm_checksum()
    {
        /*
            paytm_checksum:PAYTM_CHECKSUM
            order_id:1001
            amount:1099
            user_id:73              //{ optional } 
            industry_type:Industry  //{ optional } 
            channel_id:WAP          //{ optional }
            website:website link    //{ optional }
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->load->library(['paytm']);
        $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|xss_clean');
        $this->form_validation->set_rules('industry_type', 'Industry Type', 'trim|xss_clean');
        $this->form_validation->set_rules('channel_id', 'Channel ID', 'trim|xss_clean');
        $this->form_validation->set_rules('website', 'Website', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return false;
        } else {
            $settings = get_settings('payment_method', true);
            $credentials = $this->paytm->get_credentials();

            $paytm_checksum = $this->input->post('paytm_checksum', true);

            $paytm_params["MID"] = $settings['paytm_merchant_id'];
            $paytm_params["ORDER_ID"] = $this->input->post('order_id', true);
            $paytm_params["TXN_AMOUNT"] = $this->input->post('amount', true);
            // $paytm_params["CUST_ID"] = $this->input->post('user_id', true);
            // $paytm_params["INDUSTRY_TYPE_ID"] = $this->input->post('industry_type', true);
            // $paytm_params["CHANNEL_ID"] = $this->input->post('channel_id', true);;
            // $paytm_params["WEBSITE"] = $this->input->post('website', true);
            // $paytm_params["CALLBACK_URL"] = $credentials['url'] . "/theia/paytmCallback?ORDER_ID=" . $paytm_params["ORDER_ID"];

            $isVerifySignature = $this->paytm->verifySignature($paytm_params, $settings['paytm_merchant_key'], $paytm_checksum);
            if ($isVerifySignature) {
                $this->response['error'] = false;
                $this->response['message'] = "Checksum Matched";
                print_r(json_encode($this->response));
                return false;
            } else {
                $this->response['error'] = true;
                $this->response['message'] = "Checksum Mismatched";
                print_r(json_encode($this->response));
                return false;
            }
        }
    }

    // validate_refer_code
    public function validate_refer_code()
    {
        /* 
            referral_code:USERS_CODE_TO_BE_VALIDATED
        */
        // if (!verify_tokens()) {
        //     return false;
        // }

        $this->form_validation->set_rules('referral_code', 'Referral code', 'trim|required|is_unique[users.referral_code]|xss_clean');
        $this->form_validation->set_message('is_unique', 'This %s is already used by some other user.');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
        } else {
            $this->response['error'] = false;

            $this->response['message'] = "Referral Code is available to be used";
        }
        print_r(json_encode($this->response));
        return false;
    }

    public function flutterwave_webview()
    {
        /* 
            amount:100
            user_id:73
            reference:eShop-165232013-400  // { optional }
        */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('reference', 'Reference', 'trim|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            print_r(json_encode($this->response));
            return false;
        } else {
            $this->load->library('flutterwave');

            $app_settings = get_settings('system_settings', true);
            $payment_settings = get_settings('payment_method', true);
            $logo = base_url() . get_settings('favicon');
            $user_id = $this->input->post('user_id', true);
            $user = fetch_users($user_id);
            if (empty($user) || !isset($user['mobile'])) {
                $response['error'] = true;
                $response['message'] = "User not found!";
                print_r(json_encode($response));
                return false;
            }

            $data['tx_ref'] = (isset($_POST['reference']) && !empty($_POST['reference'])) ? $_POST['reference'] : $app_settings['app_name'] . "-" . time() . "-" . rand(1000, 9999);
            $data['amount'] = $this->input->post('amount', true);
            $data['currency'] = (isset($payment_settings['flutterwave_currency_code']) && !empty($payment_settings['flutterwave_currency_code'])) ? $payment_settings['flutterwave_currency_code'] : "NGN";
            $data['redirect_url'] = base_url('app/v1/api/flutterwave-payment-response');
            $data['payment_options'] = "card";
            $data['meta']['user_id'] = $user_id;
            $data['customer']['email'] = (!empty($user['email'])) ? $user['email'] : $app_settings['support_email'];
            $data['customer']['phonenumber'] = $user['mobile'];
            $data['customer']['name'] = $user['username'];
            $data['customizations']['title'] = $app_settings['app_name'] . " Payments ";
            $data['customizations']['description'] = "Online payments on " . $app_settings['app_name'];
            $data['customizations']['logo'] = (!empty($logo)) ? $logo : "";
            $payment = $this->flutterwave->create_payment($data);
            if (!empty($payment)) {
                $payment = json_decode($payment, true);
                if (isset($payment['status']) && $payment['status'] == 'success' && isset($payment['data']['link'])) {
                    $response['error'] = false;
                    $response['message'] = "Payment link generated. Follow the link to make the payment!";
                    $response['link'] = $payment['data']['link'];
                    print_r(json_encode($response));
                } else {
                    $response['error'] = true;
                    $response['message'] = "Could not initiate payment. " . $payment['message'];
                    $response['link'] = "";
                    print_r(json_encode($response));
                }
            } else {
                $response['error'] = true;
                $response['message'] = "Could not initiate payment. Try again later! ";
                $response['link'] = "";
                print_r($response);
            }
        }
    }
    public function flutterwave_payment_response()
    {
        if (isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])) {
            $this->load->library('flutterwave');
            $transaction_id = $_GET['transaction_id'];
            $transaction = $this->flutterwave->verify_transaction($transaction_id);
            if (!empty($transaction)) {
                $transaction = json_decode($transaction, true);
                if ($transaction['status'] == 'error') {
                    $response['error'] = true;
                    $response['message'] = $transaction['message'];
                    $response['amount'] = 0;
                    $response['status'] = "failed";
                    $response['currency'] = "NGN";
                    $response['transaction_id'] = $transaction_id;
                    $response['reference'] = "";
                    print_r(json_encode($response));
                    return false;
                }

                if ($transaction['status'] == 'success' && $transaction['data']['status'] == 'successful') {
                    $response['error'] = false;
                    $response['message'] = "Payment has been completed successfully";
                    $response['amount'] = $transaction['data']['amount'];
                    $response['currency'] = $transaction['data']['currency'];
                    $response['status'] = $transaction['data']['status'];
                    $response['transaction_id'] = $transaction['data']['id'];
                    $response['reference'] = $transaction['data']['tx_ref'];
                    print_r(json_encode($response));
                    return false;
                } else if ($transaction['status'] == 'success' && $transaction['data']['status'] != 'successful') {
                    $response['error'] = true;
                    $response['message'] = "Payment is " . $transaction['data']['status'];
                    $response['amount'] = $transaction['data']['amount'];
                    $response['currency'] = $transaction['data']['currency'];
                    $response['status'] = $transaction['data']['status'];
                    $response['transaction_id'] = $transaction['data']['id'];
                    $response['reference'] = $transaction['data']['tx_ref'];
                    print_r(json_encode($response));
                    return false;
                }
            } else {
                $response['error'] = true;
                $response['message'] = "Transaction not found";
                print_r(json_encode($response));
            }
        } else {
            $response['error'] = true;
            $response['message'] = "Invalid request!";
            print_r(json_encode($response));
            return false;
        }
    }

    public function get_paypal_link()
    {
        /*
            user_id : 2
            order_id : 1
            amount : 150
        */

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $user_id = $_POST['user_id'];
            $order_id = $_POST['order_id'];
            $amount = $_POST['amount'];
            if (!is_numeric($order_id)) {
                $this->response['error'] = false;
                $this->response['message'] = 'Order created for wallet!';
                $this->response['data'] = base_url('app/v1/api/paypal_transaction_webview?' . 'user_id=' . $user_id . '&order_id=' . $order_id . '&amount=' . $amount);
                print_r(json_encode($this->response));
                return false;
            }
            $this->response['error'] = false;
            $this->response['message'] = 'Order Detail Founded !';
            $this->response['data'] = base_url('app/v1/api/paypal_transaction_webview?' . 'user_id=' . $user_id . '&order_id=' . $order_id . '&amount=' . $amount);
        }
        print_r(json_encode($this->response));
    }

    //paypal_transaction_webview()
    public function paypal_transaction_webview()
    {
        /*
            user_id : 2
            order_id : 1
        */

        header("Content-Type: html");

        $this->form_validation->set_data($_GET);

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return false;
        }

        $user_id = $this->input->get('user_id', true);
        $order_id = $this->input->get('order_id', true);
        $amount = $this->input->get('amount', true);

        $q = $this->db->where('id', $user_id)->get('users')->result_array();
        if (empty($q) && !isset($q)) {
            echo "user error update";
            return false;
        }

        $order_res = $this->db->where('id', $order_id)->get('orders')->result_array();
        if (!empty($order_res)) {

            $data['user'] = $q[0];
            $data['order'] = $order_res[0];
            $data['payment_type'] = "paypal";
            // Set variables for paypal form
            $returnURL = base_url() . 'app/v1/api/app_payment_status';
            $cancelURL = base_url() . 'app/v1/api/app_payment_status';
            $notifyURL = base_url() . 'app/v1/api/ipn';
            $txn_id = time() . "-" . rand();
            // Get current user ID from the session
            $userID = $data['user']['id'];
            $order_id = $data['order']['id'];
            $payeremail = $data['user']['email'];
            // $userID = $data['user']->id;
            // Add fields to paypal form
            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', 'Test');
            $this->paypal_lib->add_field('custom', $userID . '|' . $payeremail);
            $this->paypal_lib->add_field('item_number', $order_id);
            $this->paypal_lib->add_field('amount', $amount);
            // Render paypal form
            $this->paypal_lib->paypal_auto_form();
        } else {
            $data['user'] = $q[0];
            $data['payment_type'] = "paypal";
            // Set variables for paypal form
            $returnURL = base_url() . 'app/v1/api/app_payment_status';
            $cancelURL = base_url() . 'app/v1/api/app_payment_status';
            $notifyURL = base_url() . 'app/v1/api/ipn';
            $txn_id = time() . "-" . rand();
            // Get current user ID from the session
            $userID = $data['user']['id'];
            $order_id = $order_id;
            $payeremail = $data['user']['email'];

            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', 'Online shopping');
            $this->paypal_lib->add_field('custom', $userID . '|' . $payeremail);
            $this->paypal_lib->add_field('item_number', $order_id);
            $this->paypal_lib->add_field('amount', $amount);
            // Render paypal form
            $this->paypal_lib->paypal_auto_form();
        }
    }

    public function app_payment_status()
    {
        $paypalInfo = $this->input->get();

        if (!empty($paypalInfo) && isset($_GET['st']) && strtolower($_GET['st']) == "completed") {
            $response['error'] = false;
            $response['message'] = "Payment Completed Successfully";
            $response['data'] = $paypalInfo;
        } elseif (!empty($paypalInfo) && isset($_GET['st']) && strtolower($_GET['st']) == "authorized") {
            $response['error'] = false;
            $response['message'] = "Your payment is has been Authorized successfully. We will capture your transaction within 30 minutes, once we process your order. After successful capture coins wil be credited automatically.";
            $response['data'] = $paypalInfo;
        } elseif (!empty($paypalInfo) && isset($_GET['st']) && strtolower($_GET['st']) == "Pending") {
            $response['error'] = false;
            $response['message'] = "Your payment is pending and is under process. We will notify you once the status is updated.";
            $response['data'] = $paypalInfo;
        } else {
            $response['error'] = true;
            $response['message'] = "Payment Cancelled / Declined ";
            $response['data'] = (isset($_GET)) ? $this->input->get() : "";
        }
        print_r(json_encode($response));
    }

    public function ipn()
    {
        // Paypal posts the transaction data
        $paypalInfo = $this->input->post();
        // log_message('error', 'Paypal IPN POST --> ' . var_export($paypalInfo, true));

        if (!empty($paypalInfo)) {
            // Validate and get the ipn response
            $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
            if ($ipnCheck) {

                $order_id = $paypalInfo["item_number"];
                /* if its not numeric then it is for the wallet recharge */
                if (
                    $paypalInfo["payment_status"] == 'Completed' &&
                    !is_numeric($order_id) && strpos($order_id, "wallet-refill-user") !== false
                ) {
                    $temp = explode("-", $order_id);   /* Order ID format for wallet refill >> wallet-refill-user-{user_id}-{system_time}-{3 random_number}  */
                    if (isset($temp[3]) && is_numeric($temp[3]) && !empty($temp[3] && $temp[3] != '')) {
                        $user_id = $temp[3];
                    } else {
                        $user_id = 0;
                    }
                    $amount = $paypalInfo["mc_gross"];
                    /* IPN for user wallet recharge */
                    $data['transaction_type'] = "wallet";
                    $data['user_id'] = $user_id;
                    $data['order_id'] = $order_id;
                    $data['type'] = "credit";
                    $data['txn_id'] = $paypalInfo["txn_id"];
                    $data['amount'] = $amount;
                    $data['status'] = "success";
                    $data['message'] = "Wallet refill successful";
                    $this->transaction_model->add_transaction($data);

                    $this->load->model('customer_model');
                    if ($this->customer_model->update_balance($amount, $user_id, 'add')) {
                        $response['error'] = false;
                        $response['transaction_status'] = "success";
                        $response['message'] = "Wallet recharged successfully!";
                    } else {
                        $response['error'] = true;
                        $response['transaction_status'] = "success";
                        $response['message'] = "Wallet could not be recharged!";
                        log_message('error', 'Paypal IPN | wallet recharge failure --> ' . var_export($paypalInfo, true));
                    }
                    echo json_encode($response);
                    return false;
                } else {
                    /* IPN for normal Order  */
                    // Insert the transaction data in the database
                    $userData = explode('|', $paypalInfo['custom']);

                    $data['transaction_type'] = 'Transaction';
                    $data['user_id'] = $userData[0];
                    $data['payer_email']  = $userData[1];
                    $data['order_id'] = $paypalInfo["item_number"];
                    $data['type'] = 'paypal';
                    $data['txn_id'] = $paypalInfo["txn_id"];
                    $data['amount'] = $paypalInfo["mc_gross"];
                    $data['currency_code'] = $paypalInfo["mc_currency"];
                    $data['status'] = 'success';
                    $data['message'] = 'Payment Verified';
                    if ($paypalInfo["payment_status"] == 'Completed') {
                        send_mail($userData[1], 'Wait for Order Confirmation', 'Thanks for your order. We will let you know once your order confirm by partner on this email ID.');

                        // log_message('error', 'Paypal IPN POST --> ' . var_export($overall_order_data, true));
                        $this->transaction_model->add_transaction($data);

                        update_details(['active_status' => 'pending'], ['id' => $data['order_id']], 'orders');

                        $status = json_encode(array(array('pending', date("d-m-Y h:i:sa"))));
                        update_details(['status' => $status], ['id' => $data['order_id']], 'orders', false);
                    } else if (
                        $paypalInfo["payment_status"] == 'Expired' || $paypalInfo["payment_status"] == 'Failed'
                        || $paypalInfo["payment_status"] == 'Refunded' || $paypalInfo["payment_status"] == 'Reversed'
                    ) {
                        /* if transaction wasn't completed successfully then cancel the order and transaction */
                        $data['transaction_type'] = 'Transaction';
                        $data['user_id'] = $userData[0];
                        $data['payer_email']  = $userData[1];
                        $data['order_id'] = $paypalInfo["item_number"];
                        $data['type'] = 'paypal';
                        $data['txn_id'] = $paypalInfo["txn_id"];
                        $data['amount'] = $paypalInfo["mc_gross"];
                        $data['currency_code'] = $paypalInfo["mc_currency"];
                        $data['status'] = $paypalInfo["payment_status"];
                        $data['message'] = 'Payment could not be completed due to one or more reasons!';
                        $this->transaction_model->add_transaction($data);

                        update_details(['active_status' => 'cancelled'], ['id' => $data['order_id']], 'orders');
                        $status = json_encode(array(array('cancelled', date("d-m-Y h:i:sa"))));
                        update_details(['status' => $status], ['id' => $data['order_id']], 'orders', false);
                    }
                }
            }
        }
    }

    //41. get_promo_codes
    public function get_promo_codes()
    {
        /*
         31. get_promo_codes
             search : Search keyword // { optional }
             limit:25                // { default - 25 } optional
             offset:0                // { default - 0 } optional
             sort: id | date_created | last_updated                // { default - id } optional
             order:DESC/ASC          // { default - DESC } optional
         */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('search', 'Search keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $search = (isset($_POST['search']) && !empty(trim($_POST['search']))) ? $this->input->post('search', true) : "";
            $limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 10;
            $offset = (isset($_POST['offset']) && is_numeric($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $_POST['order'] : 'DESC';
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $_POST['sort'] : 'id';
            $promo_code = $this->Promo_code_model->get_promo_codes($limit, $offset, $sort, $order, $search);
            print_r(json_encode($promo_code));
            return false;
        }
    }

    public function remove_from_cart()
    {
        /*
            user_id:2           
            product_variant_id:23 {optional} //if not passed all items in the cart will be removed.    
      */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('product_variant_id', 'Product Variant', 'trim|numeric|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            //Fetching cart items to check wheather cart is empty or not
            $cart_total_response = get_cart_total($_POST['user_id']);
            $settings = get_settings('system_settings', true);
            if (!isset($cart_total_response[0]['total_items'])) {
                $this->response['error'] = true;
                $this->response['message'] = 'Cart Is Already Empty !';
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return;
            }

            $this->cart_model->remove_from_cart($_POST);

            //Fetching cart items to send the details to api after the item is removed
            $cart_total_response = get_cart_total($_POST['user_id']);
            $this->response['error'] = false;
            $this->response['message'] = 'Removed From Cart !';
            if (!empty($cart_total_response) && isset($cart_total_response)) {
                $this->response['data'] = [
                    'total_quantity' => strval($cart_total_response['quantity']),
                    'sub_total' => strval($cart_total_response['sub_total']),
                    'total_items' => (isset($cart_total_response[0]['total_items'])) ? strval($cart_total_response[0]['total_items']) : "0",
                    'max_items_cart' => $settings['max_items_cart']
                ];
            } else {
                $this->response['data'] = [];
            }

            print_r(json_encode($this->response));
            return;
        }
    }

    public function get_delivery_charges()
    {
        /*
            user_id:1
            address_id:1
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User Id', 'trim|xss_clean|required|numeric');
        $this->form_validation->set_rules('address_id', 'Address Id', 'trim|xss_clean|required|numeric');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $user_id = $this->input->post('user_id', true);
            $address_id = $this->input->post('address_id', true);

            $result = get_delivery_charge($address_id, $user_id);
            if (isset($result) && !empty($result)) {
                $this->response['error'] = $result['error'];
                $this->response['message'] = $result['message'];
                $this->response['delivery_charge'] = strval($result['charge']);
                $this->response['distance'] = $result['distance'];
                $this->response['duration'] = $result['duration'];
                print_r(json_encode($this->response));
                return false;
            } else {
                $this->response['error'] = true;
                $this->response['message'] = 'Somthing went wrong. Please try again later.';
                $this->response['delivery_charge'] = "0";
                $this->response['distance'] = "0";
                $this->response['duration'] = "0";
                print_r(json_encode($this->response));
                return false;
            }
        }
    }

    public function search_places()
    {
        /*
            input:string     {user typed input}
        */

        if (!verify_tokens()) {
            return false;
        }
        $this->load->library(['google_maps']);
        $this->form_validation->set_rules('input', 'Input', 'trim|xss_clean|required');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $input = $this->input->post('input', true);
            $result = $this->google_maps->search_places($input);

            if (isset($result['http_code']) && $result['http_code'] != "200") {
                $this->response['error'] = true;
                $this->response['message'] = 'The provided API key is invalid.';
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            }
            if (isset($result['body']) && !empty($result['body'])) {
                if (isset($result['body']['status']) && $result['body']['status'] == "REQUEST_DENIED") {
                    /* The request is missing an API key */
                    $this->response['error'] = true;
                    $this->response['message'] = 'The provided API key is invalid.';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                } else if (isset($result['body']['status']) && $result['body']['status'] == "OK") {
                    // indicating the API request was successful
                    $this->response['error'] = false;
                    $this->response['message'] = 'Data fetched successfully.';
                    $this->response['data'] = (isset($result['body']['candidates']) && !empty($result['body']['candidates'])) ? $result['body']['candidates'] : [];
                    print_r(json_encode($this->response));
                    return false;
                } else if (isset($result['body']['status']) && $result['body']['status'] == "OVER_QUERY_LIMIT") {
                    // You have exceeded the QPS limits. Billing has not been enabled on your account
                    $this->response['error'] = true;
                    $this->response['message'] = 'You have exceeded the QPS limits or billing not enabled may be.';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                } else if (isset($result['body']['status']) && $result['body']['status'] == "INVALID_REQUEST") {
                    // indicating the API request was malformed, generally due to the missing input parameter
                    $this->response['error'] = true;
                    $this->response['message'] = 'Indicating the API request was malformed.';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                } else if (isset($result['body']['status']) && $result['body']['status'] == "UNKNOWN_ERROR") {
                    // indicating an unknown error
                    $this->response['error'] = true;
                    $this->response['message'] = 'An unknown error occure.';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                } else if (isset($result['body']['status']) && $result['body']['status'] == "ZERO_RESULTS") {
                    // indicating that the search was successful but returned no results. This may occur if the search was passed a bounds in a remote location.
                    $this->response['error'] = true;
                    $this->response['message'] = 'Data not found or invalid.Please check!';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                } else {
                    $this->response['error'] = true;
                    $this->response['message'] = 'Something went wrong.';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                }
            }
        }
    }

    public function get_live_tracking_details()
    {
        /*
            order_id:1
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('order_id', 'order_id', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $order_id = $this->input->post('order_id', true);
            $data = fetch_details(['order_id' => $order_id], 'live_tracking', "*", "", "", 'id', "desc");
            if (!empty($data)) {
                $this->response['error'] = false;
                $this->response['message'] = "Live Tracking Detail fetched succesfully.";
                $this->response['data'] = $data;
                print_r(json_encode($this->response));
                return false;
            } else {
                $this->response['error'] = true;
                $this->response['message'] = "Live Tracking Not available.";
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            }
        }
    }
    public function delete_my_account()
    {
        /*
            user_id:1
        */

        if (!verify_tokens()) {
            return false;
        }
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $user_id = $this->input->post('user_id', true);
            if (is_exist(['id' => $this->input->post('user_id')], 'users')) {
                if ($this->ion_auth->in_group('members', $user_id)) {
                    /** delete data from addresses if exist */
                    if (is_exist(['user_id' => $user_id], 'addresses')) {
                        delete_details(['user_id' => $user_id], 'addresses');
                    }
                    /** delete data from cart if exist */
                    if (is_exist(['user_id' => $user_id], 'cart')) {
                        delete_details(['user_id' => $user_id], 'cart');
                    }
                    /** delete data from cart_add_ons if exist */
                    if (is_exist(['user_id' => $user_id], 'cart_add_ons')) {
                        delete_details(['user_id' => $user_id], 'cart_add_ons');
                    }
                    /** delete data from favorites if exist */
                    if (is_exist(['user_id' => $user_id], 'favorites')) {
                        delete_details(['user_id' => $user_id], 'favorites');
                    }
                    /** delete data from tickets if exist */
                    if (is_exist(['user_id' => $user_id], 'tickets')) {
                        delete_details(['user_id' => $user_id], 'tickets');
                    }
                    /** delete data from ticket_messages if exist */
                    if (is_exist(['user_id' => $user_id], 'ticket_messages')) {
                        delete_details(['user_id' => $user_id], 'ticket_messages');
                    }
                    /** delete product rating */
                    if (is_exist(['user_id' => $user_id], 'product_rating')) {
                        $ratings = fetch_details(['user_id' => $user_id], "product_rating", "id");
                        foreach ($ratings as $rating) {
                            $this->rating_model->delete_rating($rating['id']);
                        }
                    }
                    /** delete rider rating */
                    if (is_exist(['user_id' => $user_id], 'rider_rating')) {
                        $ratings = fetch_details(['user_id' => $user_id], "rider_rating", "id");
                        foreach ($ratings as $rating) {
                            $this->rating_model->delete_rider_rating($rating['id']);
                        }
                    }


                    /** delete the user */
                    if ($this->ion_auth->delete_user($user_id)) {
                        $this->response['error'] = false;
                        $this->response['message'] = "User deleted successfully.";
                        $this->response['data'] = array();
                        print_r(json_encode($this->response));
                        return false;
                    } else {
                        $this->response['error'] = true;
                        $this->response['message'] = "User not deleted.";
                        $this->response['data'] = array();
                        print_r(json_encode($this->response));
                        return false;
                    }
                } else {
                    $this->response['error'] = true;
                    $this->response['message'] = "This user is not allowed to delete account.";
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                }
            } else {
                $this->response['error'] = true;
                $this->response['message'] = "User does not exist.";
                $this->response['data'] = array();
                print_r(json_encode($this->response));
                return false;
            }
        }
    }

    public function send_withdrawal_request()
    {
        /* 
            user_id:15
            payment_address: 12343535
            amount: 560           
        */

        if (!verify_tokens()) {
            return false;
        }
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('payment_address', 'Payment Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|numeric|greater_than[0]');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
        } else {
            $user_id = $this->input->post('user_id', true);
            $amount = $this->input->post('amount', true);
            $payment_address = $this->input->post('payment_address', true);
            $amount = $this->input->post('amount', true);
            $userData = fetch_details(['id' => $user_id], 'users', 'balance');

            if (!empty($userData)) {

                if ($amount <= $userData[0]['balance']) {

                    $data = [
                        'user_id' => $user_id,
                        'payment_address' => $payment_address,
                        'payment_type' => 'customer',
                        'amount_requested' => $amount,
                    ];

                    if (insert_details($data, 'payment_requests')) {
                        $this->Rider_model->update_balance($amount, $user_id, 'deduct');
                        $userData = fetch_details(['id' => $_POST['user_id']], 'users', 'balance');
                        $this->response['error'] = false;
                        $this->response['message'] = 'Withdrawal Request Sent Successfully';
                        $this->response['data'] = $userData[0]['balance'];
                    } else {
                        $this->response['error'] = true;
                        $this->response['message'] = 'Cannot sent Withdrawal Request.Please Try again later.';
                        $this->response['data'] = array();
                    }
                } else {
                    $this->response['error'] = true;
                    $this->response['message'] = 'You don\'t have enough balance to sent the withdraw request.';
                    $this->response['data'] = array();
                }

                print_r(json_encode($this->response));
            }
        }
    }

    //13.get_withdrawal_request
    public function get_withdrawal_request()
    {
        /* 
            user_id:15
            limit:10
            offset:10
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('user_id', 'User Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('limit', 'Limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'Offset', 'trim|numeric|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
        } else {

            $limit = ($this->input->post('limit', true)) ? $this->input->post('limit', true) : null;
            $offset = ($this->input->post('offset', true)) ? $this->input->post('offset', true) : null;
            $userData = fetch_details(['user_id' => $_POST['user_id']], 'payment_requests', '*', $limit, $offset);
            $rows = $tmpRow = array();
            foreach ($userData as $data) {
                $tmpRow['id'] = $data['id'];
                $tmpRow['user_id'] = $data['user_id'];
                $tmpRow['payment_type'] = $data['payment_type'];
                $tmpRow['payment_address'] = $data['payment_address'];
                $tmpRow['amount_requested'] = $data['amount_requested'];
                $tmpRow['remarks'] = (isset($data['remarks']) && !empty($data['remarks'])) ? $data['remarks'] : "";
                $tmpRow['status'] = $data['status'];
                $tmpRow['date_created'] = $data['date_created'];
                $rows[] = $tmpRow;
            }
            $this->response['error'] = false;
            $this->response['message'] = 'Withdrawal Request Retrieved Successfully';
            $this->response['total'] = strval(count($userData));
            $this->response['data'] = $rows;
            print_r(json_encode($this->response));
        }
    }
    public function get_languages()
    {
        $languages = get_languages();
        $this->response['error'] = false;
        $this->response['message'] = 'Languages Retrieved Successfully';
        $this->response['total'] = strval(count($languages));
        $this->response['data'] = $languages;
        print_r(json_encode($this->response));
    }
    public function razorpay_webhook()
    {
        //Debug in server first
        if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') || !array_key_exists('HTTP_X_RAZORPAY_SIGNATURE', $_SERVER))
            exit();


        $this->load->library(['razorpay']);
        $system_settings = get_settings('system_settings', true);
        $credentials = $this->razorpay->get_credentials();

        $request = file_get_contents('php://input');
        if ($request === false || empty($request)) {
        }
        $request = json_decode($request, true);

        define('RAZORPAY_SECRET_KEY', $credentials['secret_hash']);
        log_message('error', 'Razorpay IPN POST --> ' . var_export($request, true));

        $http_razorpay_signature = isset($_SERVER['HTTP_X_RAZORPAY_SIGNATURE']) ? $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'] : "";

        $txn_id = (isset($request['payload']['payment']['entity']['id'])) ? $request['payload']['payment']['entity']['id'] : "";

        if (!empty($request['payload']['payment']['entity']['id'])) {
            if (!empty($txn_id)) {
                $transaction = fetch_details(['txn_id' => $txn_id], 'transactions', '*');
            }
            $amount = $request['payload']['payment']['entity']['amount'];
            $amount = ($amount / 100);
        } else {
            $amount = 0;
            $currency = (isset($request['payload']['payment']['entity']['currency'])) ? $request['payload']['payment']['entity']['currency'] : "";
        }


        if (!empty($transaction)) {

            $order_id = $transaction[0]['order_id'];
            $user_id = $transaction[0]['user_id'];
        } else {
            $order_id = 0;
            $order_id = (isset($request['payload']['order']['entity']['notes']['order_id'])) ? $request['payload']['order']['entity']['notes']['order_id'] : $request['payload']['payment']['entity']['notes']['order_id'];
        }

        $this->load->model('transaction_model');
        if ($http_razorpay_signature) {
            if ($request['event'] == 'payment.authorized') {
                $currency = (isset($request['payload']['payment']['entity']['currency'])) ? $request['payload']['payment']['entity']['currency'] : "INR";
                $this->load->library("razorpay");
                $response = $this->razorpay->capture_payment($amount * 100, $txn_id, $currency);
                return;
            }
            if ($request['event'] == 'payment.captured' || $request['event'] == 'order.paid') {

                if ($request['event'] == 'order.paid') {
                    $order_id = $request['payload']['order']['entity']['receipt'];
                    $order_data = fetch_orders($order_id);
                    $user_id = (isset($order_data['order_data'][0]['user_id'])) ? $order_data['order_data'][0]['user_id'] : "";
                }
                // echo "here";
                // return;
                if (!empty($order_id)) {
                    /* To do the wallet recharge if the order id is set in the patter */
                    if (strpos($order_id, "wallet-refill-user") !== false) {
                        $data['transaction_type'] = "wallet";
                        $data['user_id'] = $user_id;
                        $data['order_id'] = $order_id;
                        $data['type'] = "credit";
                        $data['txn_id'] = $txn_id;
                        $data['amount'] = $amount / 100;
                        $data['status'] = "success";
                        $data['message'] = "Wallet refill successful";
                        $this->transaction_model->add_transaction($data);

                        $this->load->model('customer_model');
                        if ($this->customer_model->update_balance($amount / 100, $user_id, 'add')) {
                            $response['error'] = false;
                            $response['transaction_status'] = $request['event'];
                            $response['message'] = "Wallet recharged successfully!";
                        } else {
                            $response['error'] = true;
                            $response['transaction_status'] = $request['event'];
                            $response['message'] = "Wallet could not be recharged!";
                            log_message('error', 'razorpay Webhook | wallet recharge failure --> ' . var_export($request['event'], true));
                        }
                        echo json_encode($response);
                        return false;
                    } else {
                        /* process the order and mark it as received */
                        $order = fetch_orders($order_id, false, false, false, false, false, false, false);
                        //  print_r($order);
                        if (isset($order['order_data'][0]['user_id'])) {
                            $user = fetch_details(['id' => $order['order_data'][0]['user_id']], 'users');
                            $overall_total = array(
                                'total_amount' => $order['order_data'][0]['total'],
                                'delivery_charge' => $order['order_data'][0]['delivery_charge'],
                                'tax_amount' => $order['order_data'][0]['total_tax_amount'],
                                'tax_percentage' => $order['order_data'][0]['total_tax_percent'],
                                'discount' =>  $order['order_data'][0]['promo_discount'],
                                'wallet' =>  $order['order_data'][0]['wallet_balance'],
                                'final_total' =>  $order['order_data'][0]['final_total'],
                                'otp' => $order['order_data'][0]['otp'],
                                'address' =>  $order['order_data'][0]['address'],
                                'payment_method' => $order['order_data'][0]['payment_method']
                            );

                            $overall_order_data = array(
                                'cart_data' => $order['order_data'][0]['order_items'],
                                'order_data' => $overall_total,
                                'subject' => 'Order received successfully',
                                'user_data' => $user[0],
                                'system_settings' => $system_settings,
                                'user_msg' => 'Hello, Dear ' . ucfirst($user[0]['username']) . ', We have received your order successfully. Your order summaries are as followed',
                                'otp_msg' => 'Here is your OTP. Please, give it to delivery boy only while getting your order.',
                            );
                            if (isset($user[0]['email']) && !empty($user[0]['email'])) {
                                send_mail($user[0]['email'], 'Order received successfully', $this->load->view('admin/pages/view/email-template.php', $overall_order_data, TRUE));
                            }
                            /* No need to add because the transaction is already added just update the transaction status */
                            if (!empty($transaction)) {
                                $transaction_id = $transaction[0]['id'];
                                update_details(['status' => 'success'], ['id' => $transaction_id], 'transactions');
                            } else {
                                /* add transaction of the payment */
                                $amount = ($request['payload']['payment']['entity']['amount'] / 100);
                                $data = [
                                    'transaction_type' => 'transaction',
                                    'user_id' => $user_id,
                                    'order_id' => $order_id,
                                    'type' => 'razorpay',
                                    'txn_id' => $txn_id,
                                    'amount' => $amount,
                                    'status' => 'success',
                                    'message' => 'order placed successfully',
                                ];
                                $this->transaction_model->add_transaction($data);
                            }
                            /* add transaction of the payment */

                            update_details(['active_status' => 'pending'], ['id' => $order_id], 'orders');
                            $status = json_encode(array(array('pending', date("d-m-Y h:i:sa"))));
                            update_details(['status' => $status], ['id' => $order_id], 'orders', false);
                        }
                    }
                } else {
                    log_message('error', 'Razorpay NO ORDER ID IPN POST --> ' . var_export($request, true));
                    /* No order ID found */
                }
                $response['error'] = false;
                $response['transaction_status'] = $request['event'];
                $response['message'] = "Transaction successfully done";
                echo json_encode($response);
                return false;
            } elseif ($request['event'] == 'payment.failed') {
                if (!empty($order_id)) {
                    update_details(['active_status' => 'cancelled'], ['id' => $order_id], 'orders');
                }
                /* No need to add because the transaction is already added just update the transaction status */
                if (!empty($transaction)) {
                    $transaction_id = $transaction[0]['id'];
                    update_details(['status' => 'failed'], ['id' => $transaction_id], 'transactions');
                }
                $response['error'] = true;
                $response['transaction_status'] = $request['event'];
                $response['message'] = "Transaction is failed. ";
                log_message('error', 'Razorpay Webhook | Transaction is failed --> ' . var_export($request['event'], true));
                echo json_encode($response);
                return false;
            } elseif ($request['event'] == 'payment.authorized') {
                if (!empty($order_id)) {
                    update_details(['active_status' => 'pending'], ['id' => $order_id], 'orders');
                }
            } elseif ($request['event'] == "refund.processed") {
                //Refund Successfully
                $transaction = fetch_details('transactions', ['txn_id' => $request['payload']['refund']['entity']['payment_id']]);
                if (empty($transaction)) {
                    return false;
                }
                process_refund($transaction[0]['id'], $transaction[0]['status']);
                $response['error'] = false;
                $response['transaction_status'] = $request['event'];
                $response['message'] = "Refund successfully done. ";
                log_message('error', 'Razorpay Webhook | Payment refund done --> ' . var_export($request['event'], true));
                echo json_encode($response);
                return false;
            } elseif ($request['event'] == "refund.failed") {
                $response['error'] = true;
                $response['transaction_status'] = $request['event'];
                $response['message'] = "Refund is failed. ";
                log_message('error', 'Razorpay Webhook | Payment refund failed --> ' . var_export($request['event'], true));
                echo json_encode($response);
                return false;
            } else {
                $response['error'] = true;
                $response['transaction_status'] = $request['event'];
                $response['message'] = "Transaction could not be detected.";
                log_message('error', 'Razorpay Webhook | Transaction could not be detected --> ' . var_export($request['event'], true));
                echo json_encode($response);
                return false;
            }
        } else {
            log_message('error', 'razorpay Webhook | Invalid Server Signature  --> ' . var_export($request['event'], true));
            return false;
        }
    }

    public function get_partner_ratings()
    {
        if (!verify_tokens()) {
            return false;
        }
        $this->form_validation->set_rules('partner_id', 'Partner  Id', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
        } else {
            $limit = (isset($_POST['limit'])  && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 25;
            $offset = (isset($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $sort = (isset($_POST['sort(array)']) && !empty(trim($_POST['sort']))) ? $this->input->post('sort', true) : 'or.id';
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $this->input->post('order', true) : 'DESC';
            $partner_id = (isset($_POST['partner_id']) && !empty(trim($_POST['partner_id']))) ? $this->input->post('partner_id', true) : "";
            $orders = fetch_details(['partner_id' => $_POST['partner_id']], 'order_items', 'order_id');
            $order_id = array_column($orders, 'order_id');
            $rating = $this->rating_model->fetch_partner_rating($order_id, $partner_id, $limit, $offset, $sort, $order);
            $this->response['error'] = false;
            $this->response['message'] = "Data retrive successfully";
            $this->response['total'] = count($rating['order_rating']);
            $this->response['data'] = $rating;
            print_r(json_encode($this->response));
        }
    }

    // social login
    public function sign_up()
    {
        // if (!verify_tokens()) {
        //     return false;
        // }
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email');
        $this->form_validation->set_rules('fcm_id', 'FCM ID', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            print_r(json_encode($this->response));
            return false;
        }
        $email = (isset($_POST['email']) && (trim($_POST['email'])) != "") ? $this->input->post('email', true) : '';
        $mobile = (isset($_POST['mobile']) && (trim($_POST['mobile'])) != "") ? $this->input->post('mobile', true) : '';
        $res = $this->db->select("id,mobile,email")
            ->where("mobile ='$mobile' and email = '$email'")
            ->where_not_in('type', 'phone')
            ->get('`users`')->result_array();
        if (!empty($res)) {
            $is_exist = (!empty($mobile)) ? ['mobile' => $mobile] : ['email' => $email];
            $where = (!empty($mobile)) ? ['mobile' => $mobile] : ['email' => $email];
            $token = (!empty($mobile)) ? generate_tokens($mobile) : generate_tokens('', $email);
            // $token = generate_tokens('', $this->input->post('email'));

            if (is_exist($is_exist, 'users')) {
                if (isset($_POST['fcm_id']) && !empty(($_POST['fcm_id']))) {
                    update_details(['fcm_id' => $this->input->post('fcm_id', true)], $where, 'users');
                }
                /** set user jwt token  */
                update_details(['apikey' => $token], $where, "users");

                $data = fetch_details($where, 'users');
                unset($data[0]['password']);
                unset($data[0]['apikey']);

                if (empty($data[0]['image']) || file_exists(FCPATH . USER_IMG_PATH . $data[0]['image']) == FALSE) {
                    $data[0]['image'] = base_url() . NO_PROFILE_IMAGE;
                } else {
                    $data[0]['image'] = base_url() . USER_IMG_PATH . $data[0]['image'];
                }
                $data = array_map(function ($value) {
                    return $value === NULL ? "" : $value;
                }, $data[0]);
                //if the login is successful
                $response['error'] = false;
                $response['token'] = $token;
                $response['message'] = "User login successfully";
                $response['data'] = $data;
                echo json_encode($response);
                return false;
            } else {
                $response['error'] = true;
                $response['message'] = 'User does not exists !';
                $response['data'] = array();
                echo json_encode($response);
                return false;
            }
        } else {
            //register

            $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Mail', 'trim|xss_clean|valid_email');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|xss_clean|max_length[16]|numeric|is_unique[users.mobile]', array('is_unique' => ' The mobile number is already registered . Please login'));
            $this->form_validation->set_rules('country_code', 'Country Code', 'trim|xss_clean');
            $this->form_validation->set_rules('fcm_id', 'Fcm Id', 'trim|xss_clean');
            $this->form_validation->set_rules('referral_code', 'Referral code', 'trim|is_unique[users.referral_code]|xss_clean');
            $this->form_validation->set_rules('friends_code', 'Friends code', 'trim|xss_clean');
            $this->form_validation->set_rules('latitude', 'Latitude', 'trim|xss_clean|numeric');
            $this->form_validation->set_rules('longitude', 'Longitude', 'trim|xss_clean|numeric');

            if (!$this->form_validation->run()) {
                $this->response['error'] = true;
                $this->response['message'] = strip_tags(validation_errors());
                $this->response['data'] = array();
            } else {
                if (isset($_POST['friends_code']) && !empty($_POST['friends_code'])) {
                    $friends_code = $this->input->post('friends_code', true);
                    $friend = fetch_details(['referral_code' => $friends_code], 'users', '*');
                    if (empty($friend)) {
                        $response["error"]   = true;
                        $response["message"] = "Invalid friends code! Please pass the valid referral code of the inviter";
                        $response["data"] = [];
                        echo json_encode($response);
                        return false;
                    }
                }
                $additional_data = [
                    'username' => $this->input->post('name', true),
                    'mobile' => $mobile,
                    'email' => $email,
                    'type' => $this->input->post('type', true),
                    'country_code' => $this->input->post('country_code', true),
                    'fcm_id' => $this->input->post('fcm_id', true),
                    'referral_code' => $this->input->post('referral_code', true),
                    'friends_code' => $this->input->post('friends_code', true),
                    'latitude' => $this->input->post('latitude', true),
                    'longitude' => $this->input->post('longitude', true),
                    'active' => 1
                ];
                $res =  insert_details($additional_data, "users");
                $user_id = $this->db->insert_id();
                $user_details = [
                    'user_id' => $user_id,
                    'group_id' => 2,
                ];
                insert_details($user_details, "users_groups");
                if ($res != FALSE) {
                    $where = (!empty($mobile)) ? ['mobile' => $mobile] : ['email' => $email];
                    // $token = (!empty($mobile)) ? generate_tokens($mobile) : generate_tokens($email);
                    $token = generate_tokens('', $this->input->post('email'));
                    update_details(['apikey' => $token], $where, "users");
                    update_details(['active' => 1], $where, 'users');
                    $data = fetch_details($where, 'users');

                    unset($data[0]['password']);
                    unset($data[0]['apikey']);

                    $data = array_map(function ($value) {
                        return $value === NULL ? "" : $value;
                    }, $data[0]);

                    $this->response['error'] = false;
                    $this->response['token'] = $token;
                    $this->response['message'] = 'Registered Successfully';
                    $this->response['data'] = $data;
                } else {
                    $this->response['error'] = true;
                    $this->response['message'] = 'Registered Faild';
                    $this->response['data'] = array();
                }
            }
            print_r(json_encode($this->response));
        }
    }

    public function razorpay_create_order()
    {
        /*
             order_id:15
         */
        if (!verify_tokens()) {
            return false;
        }
        $this->form_validation->set_rules('order_id', 'Order ID', 'required|trim|numeric|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $order_id = (isset($_POST['order_id'])) ? $_POST['order_id'] : null;
            $order = fetch_orders($order_id, false, false, false, false, false, false, false);
            $settings = get_settings('system_settings', true);
            if (!empty($order) && !empty($settings)) {
                $currency = $settings['supported_locals'];
                $price = $order['order_data'][0]['final_total'];
                $amount = intval($price * 100);
                $this->load->library(['razorpay']);
                $create_order = $this->razorpay->create_order($amount, $order_id, $currency);
                if (!empty($create_order)) {
                    $this->response['error'] = false;
                    $this->response['message'] = "razorpay order created";
                    $this->response['data'] = $create_order;
                } else {
                    $this->response['error'] = true;
                    $this->response['message'] = "razorpay order not created";
                    $this->response['data'] = array();
                }
            } else {
                $this->response['error'] = true;
                $this->response['message'] = "details not found";
                $this->response['data'] = array();
            }
            print_r(json_encode($this->response));
            return;
        }
    }
    public function is_order_deliverable()
    {
        $this->form_validation->set_rules('address_id', 'Address ID', 'required|trim|numeric|xss_clean');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required|trim|numeric|xss_clean');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required|trim|numeric|xss_clean');
        $this->form_validation->set_rules('partner_id', 'Partner ID', 'required|trim|numeric|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $address_id = $this->input->post('address_id', true);
            $latitude = $this->input->post('latitude', true);
            $longitude = $this->input->post('longitude', true);
            $partner_id = $this->input->post('partner_id', true);

            if (!is_order_deliverable($address_id, $latitude, $longitude, $partner_id)) {
                $this->response['error'] = true;
                $this->response['message'] = "Sorry, We are not delivering on selected address!";
                print_r(json_encode($this->response));
                return;
            } else {
                $this->response['error'] = false;
                $this->response['message'] = "We are delivering on selected address!";
                print_r(json_encode($this->response));
                return;
            }
        }
    }

    /**      APIs */

    public function create_midtrans_transaction()
    {
        if (!verify_tokens()) {
            return false;
        }
        // if (!$this->verify_token()) {
        //     return false;
        // }
        // $this->load->library(['Midtrans']);
        $this->form_validation->set_rules('order_id', 'Order id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
        $order_id = $_POST['order_id'];
        $amount = $_POST['amount'];
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {
            $this->load->library(['Midtrans']);
            $transaction = $this->midtrans->create_transaction($order_id, $amount);
            if (!empty($transaction)) {
                $this->response['error'] = false;
                $this->response['message'] = "Token generate successfully";
                $this->response['data'] = json_decode($transaction['body'], 1);
            } else {
                $this->response['error'] = true;
                $this->response['message'] = "Token generation Failed";
                $this->response['data'] = array();
            }
        }
        print_r(json_encode($this->response));
    }


    public function get_midtrans_transaction_status()
    {
        if (!verify_tokens()) {
            return false;
        }
        // if (!$this->verify_token()) {
        //     return false;
        // }
        $this->form_validation->set_rules('order_id', 'Order id', 'trim|required|xss_clean');
        $order_id = $this->input->post('order_id', true);

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
        } else {

            $this->load->library(['midtrans']);
            $create_order = $this->midtrans->get_transaction_status($order_id);
            $order_id = $_POST['order_id'];

            if ($create_order['status_code'] == '200' || $create_order['status_code'] == '201') {

                // $order_id = $_POST['order_id'];
                // update_details(['active_status' => 'confirmed'], ['id' => $order_id], 'orders');
                $user_id = fetch_details(['id' => $order_id], 'orders', 'user_id');
                // print_r($user_id[0]['user_id']);
                $fcm_user_subject = 'Wait for Order Confirmation';
                $fcm_user_msg = 'Thanks for your order ID #' . $order_id . '. We will let you know once your order confirm by partner on this email ID.';
                send_notifications($user_id[0]['user_id'], "user", $fcm_user_subject, $fcm_user_msg, "place_order", $order_id);
            } else {
                $order_item = fetch_details(['order_id' => $order_id], 'order_items', 'user_id,product_variant_id,quantity');
                $order = fetch_orders($order_id, false, false, false, false, false, false, false);
                if ($order['order_data'][0]['order_items'][0]['status'][0][0] == 'awaiting') {
                    update_stock($order['order_data'][0]['order_items'][0]['product_variant_id'], $order['order_data'][0]['order_items'][0]['quantity'], 'plus');
                }
                foreach ($order_item as $row) {
                    $cart_data = [
                        'user_id' => $row['user_id'],
                        'product_variant_id' => $row['product_variant_id'],
                        'qty' => $row['quantity'],
                        'is_saved_for_later' => 0,
                    ];
                    $this->db->insert('cart', $cart_data);
                }
                $cart_add_ons = fetch_details(['order_id' => $order_id], 'order_items', 'add_ons');

                $test = $temp = array();
                if (!empty($cart_add_ons['add_ons'])) {
                    for ($i = 0; $i < count($cart_add_ons); $i++) {

                        $add_ons = json_decode($cart_add_ons[$i]['add_ons'], true);

                        $cart_addons = [
                            'add_on_id' => $add_ons[0]['add_on_id'],
                            'product_variant_id' => $add_ons[0]['product_variant_id'],
                            'qty' => $add_ons[0]['qty'],
                            'product_id' => $add_ons[0]['product_id'],
                            'user_id' => $add_ons[0]['user_id'],
                        ];

                        $this->db->insert('cart_add_ons', $cart_addons);
                    }
                }

                delete_details(['id' => $order_id], 'orders');
                delete_details(['order_id' => $order_id], 'order_items');
            }


            // printr($create_order);
            if (!empty($create_order)) {
                $this->response['error'] = false;
                $this->response['message'] = "Transaction Retrived Successfully";
                $this->response['data'] = $create_order;
            } else {
                $this->response['error'] = true;
                $this->response['message'] = "Transaction Not Retrived";
                $this->response['data'] = array();
            }
        }
        print_r(json_encode($this->response));
    }

    public function midtrans_payment_process()
    {


        $midtransInfo = $this->input->get();
        // print_r($midtransInfo);

        if (!empty($midtransInfo) && isset($_GET['status_code']) && ($_GET['status_code']) == 200 && isset($_GET['transaction_status']) && strtolower($_GET['transaction_status']) == 'capture') {
            $response['error'] = false;
            $response['message'] = "Success, Credit card transaction is successful";
            $response['data'] = $midtransInfo;
        } elseif (!empty($midtransInfo) && isset($_GET['transaction_status']) && strtolower($_GET['transaction_status']) == "pending") {
            $response['error'] = false;
            $response['message'] = "Waiting customer to finish transaction order_id: " . $_GET['order_id'];
            $response['data'] = $midtransInfo;
        } elseif (!empty($midtransInfo) && isset($_GET['transaction_status']) && strtolower($_GET['transaction_status']) == "deny") {
            $response['error'] = false;
            $response['message'] = "Your payment of order_id: " . $_GET['order_id'] . " is denied";
            $response['data'] = $midtransInfo;
        } else {
            $response['error'] = true;
            $response['message'] = "Payment Cancelled / Declined ";
            $response['data'] = (isset($_GET)) ? $this->input->get() : "";
        }
        print_r(json_encode($response));
    }

    public function midtrans_wallet_transaction()
    {

        if (!verify_tokens()) {
            return false;
        }
        $system_settings = get_settings('system_settings', true);
        $this->form_validation->set_rules('order_id', 'Order id', 'trim|required|xss_clean');
        $order_id = $this->input->post('order_id', true);

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
        } else {
            $this->load->library(['midtrans']);
            $transaction_response = $this->midtrans->get_transaction_status($order_id);

            $txn_order_id = ($transaction_response['order_id']) ? $transaction_response['order_id'] : "";
            if (!empty($txn_order_id)) {
                $transaction = fetch_details(['order_id' => $txn_order_id], 'transactions', '*');
                if (isset($transaction) && !empty($transaction)) {
                    $order_id = $transaction[0]['order_id'];
                    $user_id = $transaction[0]['user_id'];
                } else {
                    $order_id = $transaction_response['order_id'];
                    $order_data = fetch_orders($order_id);
                    $user_id = $order_data['order_data'][0]['user_id'];
                }
            }

            if ($order_id != $transaction_response['order_id']) {
                $response['error'] = true;
                $response['message'] = "Order id is not matched with transaction order id.";
                echo json_encode($response);
                return false;
            }
            $res = fetch_details(['id' => $order_id], 'orders', 'id');

            if (!empty($res) && isset($res[0]['id']) && is_numeric($res[0]['id'])) {
                $db_order_id = $res[0]['id'];
                if ($transaction_response['order_id'] != $db_order_id) {
                    $response['error'] = true;
                    $response['message'] = "Order id is not matched with orders.";
                    echo json_encode($response);
                    return false;
                } else {
                    $item_id = fetch_details(['order_id' => $order_id], 'order_items', 'id');
                    $order_item_ids = array_column($item_id, "id");
                }
            }
            $type = $transaction_response['payment_type'];
            $gross_amount = $transaction_response['gross_amount'];
            if ($transaction_response['transaction_status'] == 'capture') {

                if ($transaction_response['fraud_status'] == 'challenge') {
                    $response['error'] = false;
                    $response['transaction_status'] = $transaction_response['fraud_status'];
                    $response['message'] = "Transaction order_id: " . $order_id . " is challenged by FDS";
                    log_message('error', "Transaction order_id: " . $order_id . " is challenged by FDS");
                    return false;
                } else {
                    if (strpos($order_id, "wallet-refill-user") !== false) {

                        if (!is_numeric($order_id) && strpos($order_id, "wallet-refill-user") !== false) {
                            $temp = explode("-", $order_id);
                            if (isset($temp[3]) && is_numeric($temp[3]) && !empty($temp[3] && $temp[3] != '')) {
                                $user_id = $temp[3];
                            } else {
                                $user_id = 0;
                            }
                        }
                        $data['transaction_type'] = "wallet";
                        $data['user_id'] = $user_id;
                        $data['order_id'] = $order_id;
                        $data['type'] = "credit";
                        $data['txn_id'] = '';
                        $data['amount'] = $gross_amount;
                        $data['status'] = "success";
                        $data['message'] = "Wallet refill successful";

                        log_message('error', 'Midtrans user ID -  transaction data--> ' . var_export($data, true));
                        $this->Transaction_model->add_transaction($data);
                        log_message('error', 'Midtrans user ID - Add transaction ');

                        $this->load->model('customer_model');
                        if ($this->customer_model->update_balance($gross_amount, $user_id, 'add')) {
                            $response['error'] = false;
                            $response['transaction_status'] = $transaction_response['transaction_status'];
                            $response['message'] = "Wallet recharged successfully!";
                            log_message('error', 'Midtrans user ID - Wallet recharged successfully --> ' . var_export($order_id, true));
                        } else {
                            $response['error'] = true;
                            $response['transaction_status'] = $transaction_response['transaction_status'];
                            $response['message'] = "Wallet could not be recharged!";
                            log_message('error', 'Midtrans Webhook | wallet recharge failure --> ' . var_export($transaction_response['transaction_status'], true));
                        }
                        echo json_encode($response);
                        return false;
                    } else {
                        //update order and mark it as receive
                        $order = fetch_orders($order_id, false, false, false, false, false, false, false);
                        if (isset($order['order_data'][0]['user_id'])) {
                            $user = fetch_details(['id' => $order['order_data'][0]['user_id']], 'users');

                            $overall_total = array(
                                'total_amount' => $order['order_data'][0]['total'],
                                'delivery_charge' => $order['order_data'][0]['delivery_charge'],
                                'tax_amount' => $order['order_data'][0]['total_tax_amount'],
                                'tax_percentage' => $order['order_data'][0]['total_tax_percent'],
                                'discount' =>  $order['order_data'][0]['promo_discount'],
                                'wallet' =>  $order['order_data'][0]['wallet_balance'],
                                'final_total' =>  $order['order_data'][0]['final_total'],
                                'otp' => $order['order_data'][0]['otp'],
                                'address' =>  $order['order_data'][0]['address'],
                                'payment_method' => $order['order_data'][0]['payment_method']
                            );
                            $overall_order_data = array(
                                'cart_data' => $order['order_data'][0]['order_items'],
                                'order_data' => $overall_total,
                                'subject' => 'Order received successfully',
                                'user_data' => $user[0],
                                'system_settings' => $system_settings,
                                'user_msg' => 'Hello, Dear ' . ucfirst($user[0]['username']) . ', We have received your order successfully. Your order summaries are as followed',
                                'otp_msg' => 'Here is your OTP. Please, give it to delivery boy only while getting your order.',
                            );

                            if (isset($user[0]['email']) && !empty($user[0]['email'])) {
                                send_mail($user[0]['email'], 'Order received successfully', $this->load->view('admin/pages/view/email-template.php', $overall_order_data, TRUE));
                            }

                            /* No need to add because the transaction is already added just update the transaction status */

                            if (!empty($transaction)) {

                                $transaction_id = $transaction[0]['id'];
                                update_details(['status' => 'success'], ['id' => $transaction_id], 'transactions');
                            } else {

                                /* add transaction of the payment */
                                $amount = ($transaction_response['gross_amount']);
                                $data = [
                                    'transaction_type' => 'transaction',
                                    'user_id' => $user_id,
                                    'order_id' => $order_id,
                                    'type' => 'midtrans',
                                    'txn_id' => '',
                                    'amount' => $amount,
                                    'status' => 'success',
                                    'message' => 'order placed successfully',
                                ];

                                $this->Transaction_model->add_transaction($data);
                            }
                            update_details(['active_status' => 'pending'], ['id' => $order_id], 'orders');

                            $status = json_encode(array(array('pending', date("d-m-Y h:i:sa"))));
                            if (update_details(['status' => $status], ['id' => $order_id], 'orders', false)) {
                                // $fcm_admin_msg = 'New order placed for ' . $settings['app_name'] . ' please confirm it.';
                                // $fcm_admin_subject = 'New order placed ID #' . $order_id;
                                // send_notifications("", "admins", $fcm_admin_subject, $fcm_admin_msg, "place_order");

                                // // $fcm_restro_subject = 'New order placed ID #' . $order_id;
                                // // send_notifications($res['order_item_data'][0]['partner_id'], "partner", $fcm_restro_subject, "", "place_order");

                                // $fcm_user_subject = 'Wait for Order Confirmation';
                                // $fcm_user_msg = 'Thanks for your order ID #' . $order_id . '. We will let you know once your order confirm by partner on this email ID.';
                                // send_notifications($user_id, "user", $fcm_user_subject, $fcm_user_msg, "place_order", $order_id);
                            }

                            // // place order custome notification on payment success
                            //     $custom_notification = fetch_details(['type' => "place_order"], 'custom_notifications', '');
                            //     $hashtag_order_id = '< order_id >';
                            //     $string = json_encode($custom_notification[0]['title'], JSON_UNESCAPED_UNICODE);
                            //     $hashtag = html_entity_decode($string);
                            //     $data1 = str_replace($hashtag_order_id, $order_id, $hashtag);
                            //     $title = output_escaping(trim($data1, '"'));
                            //     $hashtag_application_name = '< application_name >';
                            //     $string = json_encode($custom_notification[0]['message'], JSON_UNESCAPED_UNICODE);
                            //     $hashtag = html_entity_decode($string);
                            //     $data2 = str_replace($hashtag_application_name, $system_settings['app_name'], $hashtag);
                            //     $message = output_escaping(trim($data2, '"'));

                            //     $fcm_admin_subject = (!empty($custom_notification)) ? $title : 'New order placed ID #' . $order_id;
                            //     $fcm_admin_msg = (!empty($custom_notification)) ? $message : 'New order received for  ' . $system_settings['app_name'] . ' please process it.';
                            //     $user_fcm = fetch_details(['id' => $user_id], 'users', 'fcm_id');
                            //     $user_fcm_id[0][] = $user_fcm[0]['fcm_id'];
                            //     if (!empty($user_fcm_id)) {
                            //         $fcmMsg = array(
                            //             'title' => $fcm_admin_subject,
                            //             'body' => $fcm_admin_msg,
                            //             'type' => "place_order",
                            //             'content_available' => true
                            //         );
                            //         send_notification($fcmMsg, $user_fcm_id);
                        }
                        // } else {
                        //     log_message('error', 'Order id not found');
                        //     /* No order ID found */
                        // }
                        $response['error'] = false;
                        $response['transaction_status'] = $transaction_response['transaction_status'];
                        $response['message'] = "Transaction successfully done using " . $type;
                        log_message('error', "Transaction successfully done using: " . $type);
                        echo json_encode($response);
                        return false;
                    }
                }
            } else if ($transaction_response['transaction_status'] == 'pending') {
                $response['error'] = false;
                $response['transaction_status'] = $transaction_response['transaction_status'];
                $response['message'] = "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
                log_message('error', "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type);
                echo json_encode($response);
                return false;
            } else if ($transaction_response['transaction_status'] == 'deny') {

                $response['error'] = true;
                $response['transaction_status'] = $transaction_response['transaction_status'];
                $response['message'] = "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied. And" . $transaction_response['status_message'];
                log_message('error', "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied. And" . $transaction_response['status_message']);
                echo json_encode($response);
                return false;
            } else if ($transaction_response['transaction_status'] == 'expire') {
                $response['error'] = true;
                $response['transaction_status'] = $transaction_response['transaction_status'];
                $response['message'] = "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
                log_message('error', "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.");
                echo json_encode($response);
                return false;
            } else if ($transaction_response['transaction_status'] == 'cancel') {

                update_details(['active_status' => 'cancelled'], ['id' => $order_id], 'orders');
                $response['error'] = true;
                $response['transaction_status'] = $transaction_response['transaction_status'];
                $response['message'] = "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
                log_message('error', "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.");
                echo json_encode($response);
                return false;
            }
        }
    }

    public function midtrans_webhook()
    {
        $this->load->library(['midtrans']);

        $notification = json_decode(file_get_contents("php://input"), true);
        $order_id = (isset($notification['order_id'])) ? $notification['order_id'] : "";
        $status_code = (isset($notification['status_code'])) ? $notification['status_code'] : "";
        $gross_amount = (isset($notification['gross_amount'])) ? $notification['gross_amount'] : "";
        $transaction_status =  (isset($notification['transaction_status'])) ? $notification['transaction_status'] : "";
        $fraud_status = (isset($notification['fraud_status'])) ? $notification['fraud_status'] : "";
        $credentials = $this->midtrans->get_credentials();
        $server_key = $credentials['server_key'];
        $type = $notification['payment_type'];

        // log_message('error', "midtrans responce :" . $notification);
        log_message('error', 'Midtrans Webhook --> ' . var_export($notification, true));

        if ($transaction_status == 'cancel') {

            $response['error'] = true;
            $response['transaction_status'] = $transaction->transaction_status;
            $response['message'] = "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
            update_details(['active_status' => 'cancelled'], ['id' => $order_id], 'orders');
            update_details(['status' => 'cancelled'], ['order_id' => $order_id], 'transactions');
            $user_id = fetch_details(['id' => $order_id], 'orders', 'user_id');
            $fcm_user_subject = 'Transaction cancelled';
            $fcm_user_msg = 'Your transaction is cancelled for order ID #' . $order_id;
            send_notifications($user_id[0]['user_id'], "user", $fcm_user_subject, $fcm_user_msg, "transaction cancelled", $order_id);
            file_put_contents('data.txt', "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.", FILE_APPEND);
            echo json_encode($response);
            return false;
        } else if ($transaction_status == 'expire') {
            // The transaction is not available for processing, because the payment was delayed.
            $response['error'] = true;
            $response['message'] = "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
            $response['transaction_status'] = $transaction->transaction_status;
            update_details(['active_status' => 'cancelled'], ['id' => $order_id], 'orders');
            update_details(['status' => 'cancelled'], ['order_id' => $order_id], 'transactions');
            $user_id = fetch_details(['id' => $order_id], 'orders', 'user_id');
            $fcm_user_subject = 'Transaction expired';
            $fcm_user_msg = "Payment using " . $type . " for transaction order ID #" . $order_id . " is expired.";
            send_notifications($user_id[0]['user_id'], "user", $fcm_user_subject, $fcm_user_msg, "is expired", $order_id);
            file_put_contents('data.txt', "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.", FILE_APPEND);
            echo json_encode($response);
            return false;
        } else if ($transaction_status == 'deny') {
            // The credentials used for payment are rejected by the payment provider or Midtrans Fraud Detection System (FDS).
            $response['error'] = true;
            $response['message'] = "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied. And" . $notification['status_message'];
            $response['transaction_status'] = $transaction->transaction_status;
            update_details(['active_status' => 'cancelled'], ['id' => $order_id], 'orders');
            update_details(['status' => 'cancelled'], ['order_id' => $order_id], 'transactions');
            $user_id = fetch_details(['id' => $order_id], 'orders', 'user_id');
            $fcm_user_subject = 'Transaction denied';
            $fcm_user_msg = "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied. And" . $notification['status_message'];
            send_notifications($user_id[0]['user_id'], "user", $fcm_user_subject, $fcm_user_msg, "transaction is denied", $order_id);
            file_put_contents('data.txt',  "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.", FILE_APPEND);
            echo json_encode($response);
            return false;
        } else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $response['error'] = false;
            $response['message'] = "Waiting customer to finish transaction using " . $type;
            $response['transaction_status'] = $transaction->transaction_status;
            // update_details(['active_status' => 'cancelled'], ['id' => $order_id], 'orders');
            $user_id = fetch_details(['id' => $order_id], 'orders', 'user_id');
            $fcm_user_subject = 'Transaction Pending';
            $fcm_user_msg = "Waiting customer to finish transaction using " . $type . " for transaction order_id: " . $order_id;
            send_notifications($user_id[0]['user_id'], "user", $fcm_user_subject, $fcm_user_msg, "transaction is pending", $order_id);
            file_put_contents('data.txt', "Waiting customer to finish transaction order_id: using " . $type, FILE_APPEND);
            echo json_encode($response);
            return false;
        }
    }

    public function re_order()
    {
        /*
        order_id:2
        */

        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('order_id', 'Order Id', 'trim|numeric|required|xss_clean');
        $order_detail = fetch_orders($_POST['order_id']);

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            for ($i = 0; $i < count($order_detail['order_data'][0]['order_items']); $i++) {

                $product_variant_id = $order_detail['order_data'][0]['order_items'][$i]['product_variant_id'];
                $user_id = $order_detail['order_data'][0]['user_id'];

                if (!is_exist(['id' => $product_variant_id], "product_variants")) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'Product Varient not available.';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                }

                // clear cart if user has multi restro items
                // $clear_cart = (isset($_POST['clear_cart']) && $_POST['clear_cart'] != "") ? $this->input->post('clear_cart', true) : 0;
                // if ($clear_cart == true) {
                //     if (!$this->cart_model->remove_from_cart(['user_id' => $user_id])) {
                //         $this->response['error'] = true;
                //         $this->response['message'] = 'Not able to remove existing restaurant items please try agian later.';
                //         $this->response['data'] = array();
                //         print_r(json_encode($this->response));
                //         return false;
                //     }
                // }

                if (!is_single_seller($product_variant_id, $user_id)) {
                    $this->response['error'] = true;
                    $this->response['message'] = 'Only single partner items are allow in cart.You can remove privious item(s) and add this item.';
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                }
                $qty = $order_detail['order_data'][0]['order_items'][$i]['quantity'];
                $saved_for_later = (isset($_POST['is_saved_for_later']) && $_POST['is_saved_for_later'] != "") ? $this->input->post('is_saved_for_later', true) : 0;
                $check_status = ($qty == 0 || $saved_for_later == 1) ? false : true;
                $settings = get_settings('system_settings', true);
                $cart_count = get_cart_count($order_detail['order_data'][0]['user_id']);
                $is_variant_available_in_cart = is_variant_available_in_cart($order_detail['order_data'][0]['order_items'][$i]['product_variant_id'],  $order_detail['order_data'][0]['user_id']);
                if (!$is_variant_available_in_cart) {
                    if ($cart_count[0]['total'] >= $settings['max_items_cart']) {
                        $this->response['error'] = true;
                        $this->response['message'] = 'Maximum ' . $settings['max_items_cart'] . ' Item(s) Can Be Added Only!';
                        $this->response['data'] = array();
                        print_r(json_encode($this->response));
                        return;
                    }
                }
            }

            if (!$this->cart_model->re_order_cart($_POST, $check_status)) {
                $response = get_cart_total($order_detail['order_data'][0]['user_id'], false); // we will calculate add ons in this function
                $cart_user_data = $this->cart_model->get_user_cart($order_detail['order_data'][0]['user_id'], 0);
                $tmp_cart_user_data = $cart_user_data;
                if (!empty($tmp_cart_user_data)) {
                    for ($i = 0; $i < count($tmp_cart_user_data); $i++) {
                        $product_data = fetch_details(['id' => $tmp_cart_user_data[$i]['product_variant_id']], 'product_variants', 'product_id,availability');
                        if (!empty($product_data[0]['product_id'])) {
                            $pro_details = fetch_product($order_detail['order_data'][0]['user_id'], null, $product_data[0]['product_id']);
                            if (!empty($pro_details['product'])) {
                                if (trim($pro_details['product'][0]['availability']) == 0 && $pro_details['product'][0]['availability'] != null) {
                                    update_details(['is_saved_for_later' => '1'], $cart_user_data[$i]['id'], 'cart');
                                    unset($cart_user_data[$i]);
                                }

                                if (!empty($pro_details['product'])) {
                                    $cart_user_data[$i]['product_details'] = $pro_details['product'];
                                } else {
                                    delete_details(['id' => $cart_user_data[$i]['id']], 'cart');
                                    unset($cart_user_data[$i]);
                                    continue;
                                }
                            } else {
                                delete_details(['id' => $cart_user_data[$i]['id']], 'cart');
                                unset($cart_user_data[$i]);
                                continue;
                            }
                        } else {
                            delete_details(['id' => $cart_user_data[$i]['id']], 'cart');
                            unset($cart_user_data[$i]);
                            continue;
                        }
                    }
                }


                $this->response['error'] = false;
                $this->response['message'] = 'Cart Updated !';
                $this->response['cart'] = (isset($cart_user_data) && !empty($cart_user_data)) ? $cart_user_data : [];
                $this->response['data'] = [
                    'total_quantity' => ($_POST['qty'] == 0) ? '0' : strval($_POST['qty']),
                    'sub_total' => strval($response['sub_total'] + $response['tax_amount']),
                    'total_items' =>  isset($this->response['cart']) ? strval(count($this->response['cart'])) : "0",
                    'tax_percentage' => (isset($response['tax_percentage'])) ? strval($response['tax_percentage']) : "0",
                    'tax_amount' => (isset($response['tax_amount'])) ? strval($response['tax_amount']) : "0",
                    'cart_count' => (isset($response[0]['cart_count'])) ? strval($response[0]['cart_count']) : "0",
                    'max_items_cart' => $settings['max_items_cart'],
                    'overall_amount' => $response['overall_amount'],
                ];
                print_r(json_encode($this->response));
                return;
            }
        }
    }

    public function get_customers()
    {
        /*
          get_customers
            mobile:9876543210 // { optional }
            search : Search keyword // { optional }
            limit:25                // { default - 25 } optional
            offset:0                // { default - 0 } optional
         */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|xss_clean');
        $this->form_validation->set_rules('search', 'Search keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('sort', 'sort', 'trim|xss_clean');
        $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('order', 'order', 'trim|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $mobile = (isset($_POST['mobile']) && !empty(trim($_POST['mobile']))) ? $this->input->post('mobile', true) : "";
            $search = (isset($_POST['search']) && !empty(trim($_POST['search']))) ? $this->input->post('search', true) : "";
            $limit = (isset($_POST['limit']) && is_numeric($_POST['limit']) && !empty(trim($_POST['limit']))) ? $this->input->post('limit', true) : 10;
            $offset = (isset($_POST['offset']) && is_numeric($_POST['offset']) && !empty(trim($_POST['offset']))) ? $this->input->post('offset', true) : 0;
            $order = (isset($_POST['order']) && !empty(trim($_POST['order']))) ? $_POST['order'] : 'DESC';
            $sort = (isset($_POST['sort']) && !empty(trim($_POST['sort']))) ? $_POST['sort'] : 'id';
            $customers = $this->Customer_model->get_customers(NULL, $search, $offset, $limit, $sort, $order, 1, $mobile);
            $customers['data'][0]['user_name'] = $customers['data'][0]['name'];
            unset($customers['data'][0]['name']);
            print_r(json_encode($customers));
            return false;
        }
    }



    public function share_wallet_balance()
    {
        /*
          share_wallet_balance
             from : 269 {required}
             to:25 {required}
             amount:100 {required}
         */
        if (!verify_tokens()) {
            return false;
        }

        $this->form_validation->set_rules('from', 'From', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('to', 'To', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            $this->response['data'] = array();
            print_r(json_encode($this->response));
            return;
        } else {
            $from = $this->input->post('from', true);
            $to = $this->input->post('to', true);
            $amount = $this->input->post('amount', true);
            if (!is_exist(['id' => $from], 'users')) {
                $this->response['error'] = true;
                $this->response['message'] = 'From user not found!';
                echo json_encode($this->response);
                return false;
            }
            if (!is_exist(['id' => $to], 'users')) {
                $this->response['error'] = true;
                $this->response['message'] = 'To user not found!';
                echo json_encode($this->response);
                return false;
            }
            if ($from == $to) {
                $this->response['error'] = true;
                $this->response['message'] = 'From and to users should not be the same!';
                echo json_encode($this->response);
                return false;
            }
            $from_user = fetch_details(['id' => $from], 'users');
            $to_user = fetch_details(['id' => $to], 'users');
            if ($from_user[0]['balance'] >= $amount) {
                $this->db->set('balance', '`balance` - ' . $amount, false)->where('id', $from)->update('users');
                $this->db->set('balance', '`balance` + ' . $amount, false)->where('id', $to)->update('users');
                $data = [
                    'transaction_type' => 'wallet',
                    'user_id' => $from,
                    'type' => 'debit',
                    'amount' => $amount,
                    'status' => 'success',
                    'message' => 'Wallet balance shared with ' . $to_user[0]['username'] . ' - ' . $to_user[0]['mobile'],
                ];
                $this->db->insert('transactions', $data);
                $data = [
                    'transaction_type' => 'wallet',
                    'user_id' => $to,
                    'type' => 'credit',
                    'amount' => $amount,
                    'status' => 'success',
                    'message' => 'Wallet balance received from ' . $from_user[0]['username'] . ' - ' . $from_user[0]['mobile'],
                ];
                $this->db->insert('transactions', $data);
                $this->response['error'] = false;
                $this->response['message'] = 'Wallet balance shared successfully.';
                $this->response['remaining_balance'] = strval($from_user[0]['balance'] - $amount);
                echo json_encode($this->response);
                return false;
            } else {
                $this->response['error'] = true;
                $this->response['message'] = 'Amount exceeded available balance!';
                echo json_encode($this->response);
                return false;
            }
        }
    }


    // To register as a partner from customer APP
    public function update_partner()
    {
        /*
            id:34                                 {partner_id}(pass when update profile)
        restro details:
            partner_name:asd   
            type:1                                {1:veg | 2:non-Veg | 3:Both}
            profile:file                          // {pass if want to change}
            status:1                              {1:active | 0: deactive} (when register -> pass status:2 ( Not-Approved))
            city_id:1  
            cooking_time:20                       {in minutes}   
            working_time:[{"day":"Sunday","opening_time":"11:02:00","closing_time":"22:04:00","is_open":1},{"day":"Tuesday","opening_time":"19:20","closing_time":"18:21","is_open":1}]
            address: restro address
            address_proof:file                    // {pass if want to change}
            latitude:123464
            longitude:234535
            gallary:multiple images from media    {optional}  
            description:asd                       {optional}
            restro_tags:1,2,3                     {optional}  {tag_ids comma saprated}

            delivery_orders:1|0     
            restro_profile:1|0

        restro owner details
            name:asd
            mobile:123456789
            email:asd@gmail.com
            password:password               // {pass if restro register}
            old:12345                       //{if want to change password}
            new:345234                      //{if want to change password}
            national_identity_card:file     // {pass if want to change}
            tax_name:GST
            tax_number:GSTIN4565
            account_number:sdfv             {optional}
            account_name:asd                {optional}
            bank_code:ASD                   {optional}
            bank_name:sdf                   {optional}
            pan_number:ad                   {optional}       

        */
        if (isset($_POST['id'])) {
            if (!verify_tokens()) {
                return false;
            }
        }
        // print_R($_POST);
        $identity_column = $this->config->item('identity', 'ion_auth');
        $identity = $this->session->userdata('identity');
        if ($identity_column == 'email') {
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim|valid_email');
        } else {
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean|trim|numeric');
        }
        // validate owner details
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Mail', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|min_length[5]');
        if (!isset($_POST['id'])) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        }
        if (!empty($_POST['old']) || !empty($_POST['new'])) {
            $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
            $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']');
        }
        $this->form_validation->set_rules('working_time', 'Working Days', 'trim|xss_clean');
        $this->form_validation->set_rules('id_passport_number', 'ID/Passport Number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cooking_time', 'cooking_time', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('restro_tags', 'Restro Tags', 'trim|xss_clean');

        // validate restro details
        $this->form_validation->set_rules('partner_name', 'partner Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Pickup Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|xss_clean');
        $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|xss_clean');
        $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tax_name', 'Tax Name', 'trim|xss_clean');
        $this->form_validation->set_rules('tax_number', 'Tax Number', 'trim|xss_clean');
        $this->form_validation->set_rules('self_pickup', 'Self Pickup', 'trim|xss_clean');
        $this->form_validation->set_rules('delivery_orders', 'Delivery Orders', 'trim|xss_clean');

        // bank details
        $this->form_validation->set_rules('account_number', 'Account Number', 'trim|xss_clean');
        $this->form_validation->set_rules('account_name', 'Account Name', 'trim|xss_clean');
        $this->form_validation->set_rules('bank_code', 'Bank Code', 'trim|xss_clean');
        $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|xss_clean');
        $this->form_validation->set_rules('pan_number', 'Pan Number', 'trim|xss_clean');

        // licence details
        $this->form_validation->set_rules('licence_name', 'Company Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('licence_code', 'Registration number', 'trim|xss_clean');

        if (!$this->form_validation->run()) {
            $this->response['error'] = true;
            $this->response['message'] = strip_tags(validation_errors());
            print_r(json_encode($this->response));
            return false;
        } else {
            $id = $this->input->post('id', true);
            $seller_data_id = fetch_details(['user_id' => $id], 'partner_data', 'id,address_proof,id_passport_number,profile,licence_proof,id_passport_number_status,licence_code_status');
            if ((empty($_POST['delivery_orders']) || $_POST['delivery_orders'] == "") && (empty($_POST['self_pickup']) || $_POST['self_pickup'] == "")) {
                $this->response['error'] = true;
                $this->response['message'] = "Both order receive type should not be disable.";
                print_r(json_encode($this->response));
                return;
                exit();
            }
            if (!file_exists(FCPATH . RESTRO_DOCUMENTS_PATH)) {
                mkdir(FCPATH . RESTRO_DOCUMENTS_PATH, 0777);
            }

            //process licence proof

            $temp_licence_proof = $licence_doc = array();
            $licence_files = $_FILES;
            $licence_error = "";
            $config = [
                'upload_path' =>  FCPATH . RESTRO_DOCUMENTS_PATH,
                'allowed_types' => 'jpg|png|jpeg|gif',
                'max_size' => 8000,
            ];
            if (isset($licence_files['licence_proof']) && !empty($licence_files['licence_proof']['name']) && isset($licence_files['licence_proof']['name'])) {
                $other_image_cnt = count($_FILES['licence_proof']['name']);
                $other_img = $this->upload;
                $other_img->initialize($config);

                for ($i = 0; $i < $other_image_cnt; $i++) {
                    if (!empty($licence_files['licence_proof']['name'][$i])) {
                        $_FILES['temp_image']['name'] = $licence_files['licence_proof']['name'][$i];
                        $_FILES['temp_image']['type'] = $licence_files['licence_proof']['type'][$i];
                        $_FILES['temp_image']['tmp_name'] = $licence_files['licence_proof']['tmp_name'][$i];
                        $_FILES['temp_image']['error'] = $licence_files['licence_proof']['error'][$i];
                        $_FILES['temp_image']['size'] = $licence_files['licence_proof']['size'][$i];
                        if (!$other_img->do_upload('temp_image')) {
                            $licence_error = 'Images :' . $licence_error . ' ' . $other_img->display_errors();
                        } else {
                            $temp_licence_proof = $other_img->data();
                            resize_review_images($temp_licence_proof, FCPATH . RESTRO_DOCUMENTS_PATH);
                            $licence_doc[$i]  = RESTRO_DOCUMENTS_PATH . $temp_licence_proof['file_name'];
                        }
                    } else {
                        $_FILES['temp_image']['name'] = $licence_files['licence_proof']['name'][$i];
                        $_FILES['temp_image']['type'] = $licence_files['licence_proof']['type'][$i];
                        $_FILES['temp_image']['tmp_name'] = $licence_files['licence_proof']['tmp_name'][$i];
                        $_FILES['temp_image']['error'] = $licence_files['licence_proof']['error'][$i];
                        $_FILES['temp_image']['size'] = $licence_files['licence_proof']['size'][$i];
                        if (!$other_img->do_upload('temp_image')) {
                            $licence_error = $other_img->display_errors();
                        }
                    }
                }
                //Deleting Uploaded Images if any overall error occured
                if ($licence_error != NULL || !$this->form_validation->run()) {
                    if (isset($licence_doc) && !empty($licence_doc || !$this->form_validation->run())) {
                        foreach ($licence_doc as $key => $val) {
                            unlink(FCPATH . RESTRO_DOCUMENTS_PATH . $licence_doc[$key]);
                        }
                    }
                }
            }

            if ($licence_error != NULL) {
                $this->response['error'] = true;
                $this->response['csrfName'] = $this->security->get_csrf_token_name();
                $this->response['csrfHash'] = $this->security->get_csrf_hash();
                $this->response['message'] =  $licence_error;
                print_r(json_encode($this->response));
                return;
            }

            //process store logo
            $temp_array_logo = $profile_doc = array();
            $logo_files = $_FILES;
            $profile_error = "";
            $config = [
                'upload_path' =>  FCPATH . RESTRO_DOCUMENTS_PATH,
                'allowed_types' => 'jpg|png|jpeg|gif',
                'max_size' => 8000,
            ];
            if (isset($logo_files['profile']) && !empty($logo_files['profile']['name']) && isset($logo_files['profile']['name'])) {
                $other_img = $this->upload;
                $other_img->initialize($config);

                if (isset($_POST['id']) && !empty($_POST['id']) && isset($seller_data_id[0]['profile']) && !empty($seller_data_id[0]['profile'])) {
                    $old_logo = explode('/', $seller_data_id[0]['profile']);
                    delete_images(RESTRO_DOCUMENTS_PATH, $old_logo[2]);
                }

                if (!empty($logo_files['profile']['name'])) {

                    $_FILES['temp_image']['name'] = $logo_files['profile']['name'];
                    $_FILES['temp_image']['type'] = $logo_files['profile']['type'];
                    $_FILES['temp_image']['tmp_name'] = $logo_files['profile']['tmp_name'];
                    $_FILES['temp_image']['error'] = $logo_files['profile']['error'];
                    $_FILES['temp_image']['size'] = $logo_files['profile']['size'];
                    if (!$other_img->do_upload('temp_image')) {
                        $profile_error = 'Images :' . $profile_error . ' ' . $other_img->display_errors();
                    } else {
                        $temp_array_logo = $other_img->data();
                        resize_review_images($temp_array_logo, FCPATH . RESTRO_DOCUMENTS_PATH);
                        $profile_doc  = RESTRO_DOCUMENTS_PATH . $temp_array_logo['file_name'];
                    }
                } else {
                    $_FILES['temp_image']['name'] = $logo_files['profile']['name'];
                    $_FILES['temp_image']['type'] = $logo_files['profile']['type'];
                    $_FILES['temp_image']['tmp_name'] = $logo_files['profile']['tmp_name'];
                    $_FILES['temp_image']['error'] = $logo_files['profile']['error'];
                    $_FILES['temp_image']['size'] = $logo_files['profile']['size'];
                    if (!$other_img->do_upload('temp_image')) {
                        $profile_error = $other_img->display_errors();
                    }
                }
                //Deleting Uploaded Images if any overall error occured
                if ($profile_error != NULL || !$this->form_validation->run()) {
                    if (isset($profile_doc) && !empty($profile_doc || !$this->form_validation->run())) {
                        foreach ($profile_doc as $key => $val) {
                            unlink(FCPATH . RESTRO_DOCUMENTS_PATH . $profile_doc[$key]);
                        }
                    }
                }
            }

            if ($profile_error != NULL) {
                $this->response['error'] = true;
                $this->response['message'] =  $profile_error;
                print_r(json_encode($this->response));
                return;
            }

            //process national_identity_card
            $temp_array_id_card = $id_card_doc = array();
            $id_card_files = $_FILES;
            $id_card_error = "";
            $config = [
                'upload_path' =>  FCPATH . RESTRO_DOCUMENTS_PATH,
                'allowed_types' => 'jpg|png|jpeg|gif',
                'max_size' => 8000,
            ];
            if (isset($id_card_files['national_identity_card']) &&  !empty($id_card_files['national_identity_card']['name']) && isset($id_card_files['national_identity_card']['name'])) {
                $other_img = $this->upload;
                $other_img->initialize($config);

                if (isset($_POST['id']) && !empty($_POST['id']) && isset($seller_data_id[0]['national_identity_card']) && !empty($seller_data_id[0]['national_identity_card'])) {
                    $old_logo = explode('/', $seller_data_id[0]['national_identity_card']);
                    delete_images(RESTRO_DOCUMENTS_PATH, $old_logo[2]);
                }

                if (!empty($id_card_files['national_identity_card']['name'])) {

                    $_FILES['temp_image']['name'] = $id_card_files['national_identity_card']['name'];
                    $_FILES['temp_image']['type'] = $id_card_files['national_identity_card']['type'];
                    $_FILES['temp_image']['tmp_name'] = $id_card_files['national_identity_card']['tmp_name'];
                    $_FILES['temp_image']['error'] = $id_card_files['national_identity_card']['error'];
                    $_FILES['temp_image']['size'] = $id_card_files['national_identity_card']['size'];
                    if (!$other_img->do_upload('temp_image')) {
                        $id_card_error = 'Images :' . $id_card_error . ' ' . $other_img->display_errors();
                    } else {
                        $temp_array_id_card = $other_img->data();
                        resize_review_images($temp_array_id_card, FCPATH . RESTRO_DOCUMENTS_PATH);
                        $id_card_doc  = RESTRO_DOCUMENTS_PATH . $temp_array_id_card['file_name'];
                    }
                } else {
                    $_FILES['temp_image']['name'] = $id_card_files['national_identity_card']['name'];
                    $_FILES['temp_image']['type'] = $id_card_files['national_identity_card']['type'];
                    $_FILES['temp_image']['tmp_name'] = $id_card_files['national_identity_card']['tmp_name'];
                    $_FILES['temp_image']['error'] = $id_card_files['national_identity_card']['error'];
                    $_FILES['temp_image']['size'] = $id_card_files['national_identity_card']['size'];
                    if (!$other_img->do_upload('temp_image')) {
                        $id_card_error = $other_img->display_errors();
                    }
                }
                //Deleting Uploaded Images if any overall error occured
                if ($id_card_error != NULL || !$this->form_validation->run()) {
                    if (isset($id_card_doc) && !empty($id_card_doc || !$this->form_validation->run())) {
                        foreach ($id_card_doc as $key => $val) {
                            unlink(FCPATH . RESTRO_DOCUMENTS_PATH . $id_card_doc[$key]);
                        }
                    }
                }
            }

            if ($id_card_error != NULL) {
                $this->response['error'] = true;
                $this->response['message'] =  $id_card_error;
                print_r(json_encode($this->response));
                return;
            }

            //process address_proof
            $temp_array_proof = $proof_doc = array();
            $proof_files = $_FILES;
            $proof_error = "";
            $config = [
                'upload_path' =>  FCPATH . RESTRO_DOCUMENTS_PATH,
                'allowed_types' => 'jpg|png|jpeg|gif',
                'max_size' => 8000,
            ];
            if (isset($proof_files['address_proof']) && !empty($proof_files['address_proof']['name']) && isset($proof_files['address_proof']['name'])) {
                $other_img = $this->upload;
                $other_img->initialize($config);

                if (isset($_POST['id']) && !empty($_POST['id']) && isset($seller_data_id[0]['address_proof']) && !empty($seller_data_id[0]['address_proof'])) {
                    $old_logo = explode('/', $seller_data_id[0]['address_proof']);
                    delete_images(RESTRO_DOCUMENTS_PATH, $old_logo[2]);
                }

                if (!empty($proof_files['address_proof']['name'])) {

                    $_FILES['temp_image']['name'] = $proof_files['address_proof']['name'];
                    $_FILES['temp_image']['type'] = $proof_files['address_proof']['type'];
                    $_FILES['temp_image']['tmp_name'] = $proof_files['address_proof']['tmp_name'];
                    $_FILES['temp_image']['error'] = $proof_files['address_proof']['error'];
                    $_FILES['temp_image']['size'] = $proof_files['address_proof']['size'];
                    if (!$other_img->do_upload('temp_image')) {
                        $proof_error = 'Images :' . $proof_error . ' ' . $other_img->display_errors();
                    } else {
                        $temp_array_proof = $other_img->data();
                        resize_review_images($temp_array_proof, FCPATH . RESTRO_DOCUMENTS_PATH);
                        $proof_doc  = RESTRO_DOCUMENTS_PATH . $temp_array_proof['file_name'];
                    }
                } else {
                    $_FILES['temp_image']['name'] = $proof_files['address_proof']['name'];
                    $_FILES['temp_image']['type'] = $proof_files['address_proof']['type'];
                    $_FILES['temp_image']['tmp_name'] = $proof_files['address_proof']['tmp_name'];
                    $_FILES['temp_image']['error'] = $proof_files['address_proof']['error'];
                    $_FILES['temp_image']['size'] = $proof_files['address_proof']['size'];
                    if (!$other_img->do_upload('temp_image')) {
                        $proof_error = $other_img->display_errors();
                    }
                }
                //Deleting Uploaded Images if any overall error occured
                if ($proof_error != NULL || !$this->form_validation->run()) {
                    if (isset($proof_doc) && !empty($proof_doc || !$this->form_validation->run())) {
                        foreach ($proof_doc as $key => $val) {
                            unlink(FCPATH . RESTRO_DOCUMENTS_PATH . $proof_doc[$key]);
                        }
                    }
                }
            }

            if ($proof_error != NULL) {
                $this->response['error'] = true;
                $this->response['message'] =  $proof_error;
                print_r(json_encode($this->response));
                return;
            }

            // process working hours for restro
            $work_time = $gallary = [];
            if (isset($_POST['working_time']) && !empty($_POST['working_time'])) {
                $working_time = $this->input->post('working_time', true);
                $work_time = json_decode($working_time, true);
            }
            if (isset($_POST['gallary']) && !empty($_POST['gallary'])) {
                $gallary = explode(",", $this->input->post('gallary', true));
            }

            if (isset($_POST['id'])) {
                // if (!edit_unique($this->input->post('email', true), 'users.email.' . $this->input->post('id', true) . '') || !edit_unique($this->input->post('mobile', true), 'users.mobile.' . $this->input->post('id', true) . '')) {
                //     $response["error"]   = true;
                //     $response["message"] = "Email or mobile already exists !";
                //     $response["data"] = array();
                //     echo json_encode($response);
                //     return false;
                // }
                // process permissions of sellers
                $permmissions = $permits = array();
                $permits = get_partner_permission($this->input->post('id', true));
                $permmissions['customer_privacy'] = (isset($permits->customer_privacy)) ? 1 : 0;
                $permmissions['view_order_otp'] = (isset($permits->view_order_otp)) ? 1 : 0;
                $permmissions['assign_rider'] = (isset($permits->assign_rider)) ? 1 : 0;
                $permmissions['is_email_setting_on'] = (isset($permits->is_email_setting_on)) ? 1 : 0;
                $permmissions['delivery_orders'] = (isset($_POST['delivery_orders']) && !empty($_POST['delivery_orders'])) ? 1 : 0;
                $permmissions['self_pickup'] = (isset($_POST['self_pickup']) && !empty($_POST['self_pickup'])) ? 1 : 0;

                $restro_data = array(
                    'user_id' => $this->input->post('id', true),
                    'edit_restro_data_id' => $seller_data_id[0]['id'],
                    'id_passport_number_status' => $seller_data_id[0]['id_passport_number_status'],
                    'licence_code_status' => $seller_data_id[0]['licence_code_status'],
                    'address_proof' => (!empty($proof_doc)) ? $proof_doc : $seller_data_id[0]['address_proof'],
                    'id_passport_number' => $this->input->post('id_passport_number', true),
                    'profile' => (!empty($profile_doc)) ? $profile_doc : $seller_data_id[0]['profile'],
                    'global_commission' => (isset($_POST['global_commission']) && !empty($_POST['global_commission'])) ? $this->input->post('global_commission', true) : 0,
                    'partner_name' => $this->input->post('partner_name', true),
                    'description' => $this->input->post('description', true),
                    'address' => $this->input->post('address', true),
                    'type' => $this->input->post('type', true),
                    'tax_name' => $this->input->post('tax_name', true),
                    'tax_number' => $this->input->post('tax_number', true),
                    'account_number' => $this->input->post('account_number', true),
                    'account_name' => $this->input->post('account_name', true),
                    'bank_code' => $this->input->post('bank_code', true),
                    'bank_name' => $this->input->post('bank_name', true),
                    'bank_code' => $this->input->post('bank_code', true),
                    'licence_name' => $this->input->post('licence_name', true), // Company name
                    'licence_code' => $this->input->post('licence_code', true), // // Company registration number
                    'licence_proof' => (!empty($licence_doc)) ?  $licence_doc : [],
                    // 'cooking_time' => $this->input->post('cooking_time', true),
                    'bank_name' => $this->input->post('bank_name', true),
                    'pan_number' => $this->input->post('pan_number', true),
                    'gallery' => (isset($gallary) && !empty($gallary)) ? $gallary : NULL,
                    'status' => $this->input->post('status', true),
                    'permissions' => $permmissions,
                    'slug' => create_unique_slug($this->input->post('partner_name', true), 'partner_data')
                );

                if (!empty($_POST['old']) || !empty($_POST['new'])) {
                    $identity = ($identity_column == 'mobile') ? 'mobile' : 'email';
                    $res = fetch_details(['id' => $id], 'users', $identity);
                    if (!empty($res)) {
                        if (!$this->ion_auth->change_password($res[0][$identity], $this->input->post('old'), $this->input->post('new'))) {

                            // if the login was un-successful
                            $response['error'] = true;
                            $response['message'] = strip_tags($this->ion_auth->errors());
                            echo json_encode($response);
                            return;
                        } else {
                            $restro_filter['id'] = $id;
                            $restro_filter['ignore_status'] = true;
                            $restro_data = fetch_partners($restro_filter);
                            unset($restro_data['data'][0]['partner_cook_time']);

                            $response['error'] = false;
                            $response['message'] = 'Password Update Succesfully';
                            $response['data'] = $restro_data['data'];
                            echo json_encode($response);
                            return;
                        }
                    } else {
                        $response['error'] = true;
                        $response['message'] = 'User not exists';
                        echo json_encode($response);
                        return;
                    }
                }
                $profile = array(
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'mobile' => $this->input->post('mobile', true),
                    'password' => $this->input->post('password', true),
                    'latitude' => $this->input->post('latitude', true),
                    'longitude' => $this->input->post('longitude', true),
                    'city' => $this->input->post('city_id', true)
                );

                // process updated tags
                $tags = array();
                if (isset($_POST['restro_tags']) && !empty($_POST['restro_tags'])) {
                    $restro_tags = explode(',', $this->input->post('restro_tags', true));
                    foreach ($restro_tags as $row) {
                        $tempRow['partner_id'] = $this->input->post('id', true);
                        $tempRow['tag_id'] = $row;
                        $tags[] = $tempRow;
                    }
                }

                if ($this->Partner_model->add_partner($restro_data, $profile, $work_time, $tags)) {
                    $id = $this->input->post('id', true);
                    $restro_filter['id'] = $id;
                    $restro_filter['ignore_status'] = true;
                    $restro_data = fetch_partners($restro_filter);
                    unset($restro_data['data'][0]['partner_cook_time']);

                    $response['error'] = false;
                    $response['message'] = 'Partner Update Successfully';
                    $response['data'] = $restro_data['data'];
                    echo json_encode($response);
                    return false;
                } else {
                    $this->response['error'] = true;
                    $this->response['message'] = "Somehting went wrong.Please try again later.";
                    $this->response['data'] = array();
                    print_r(json_encode($this->response));
                    return false;
                }
            } else {

                if (!$this->form_validation->is_unique($_POST['mobile'], 'users.mobile') || !$this->form_validation->is_unique($_POST['email'], 'users.email')) {
                    $response["error"]   = true;
                    $response["message"] = "Email or mobile already exists !";
                    $response["data"] = array();
                    echo json_encode($response);
                    return false;
                }

                $identity_column = $this->config->item('identity', 'ion_auth');
                $email = strtolower($this->input->post('email'));
                $mobile = $this->input->post('mobile');
                $identity = ($identity_column == 'mobile') ? $mobile : $email;
                $password = $this->input->post('password');

                $additional_data = [
                    'username' => $this->input->post('name', true),
                    'latitude' => $this->input->post('latitude', true),
                    'longitude' => $this->input->post('longitude', true),
                    'city' => $this->input->post('city_id', true)
                ];
                // process tags if any
                $tags = array();
                if (isset($_POST['restro_tags']) && !empty($_POST['restro_tags'])) {
                    $restro_tags = explode(',', $this->input->post('restro_tags', true));
                    $tags = array_map(function ($value) {
                        $tmp_tag["partner_id"] =  $this->input->post('id', true);
                        $tmp_tag["tag_id"] = $value;
                        return $tmp_tag;
                    }, $restro_tags);
                }

                $tags = array();
                $this->ion_auth->register($identity, $password, $email, $additional_data, ['4']);
                if (update_details(['active' => 1], [$identity_column => $identity], 'users')) {
                    $user_id = fetch_details(['mobile' => $mobile], 'users', 'id');
                    if (isset($_POST['gallary']) && !empty($_POST['gallary'])) {
                        $gallary = explode(",", $this->input->post('gallary', true));
                    }

                    $data = array(
                        'user_id' => $user_id[0]['id'],
                        'address_proof' => (!empty($proof_doc)) ? $proof_doc : null,
                        'id_passport_number' => $this->input->post('id_passport_number', true),
                        'profile' => (!empty($profile_doc)) ? $profile_doc : null,
                        'global_commission' => (isset($_POST['global_commission']) && !empty($_POST['global_commission'])) ? $this->input->post('global_commission', true) : 0,
                        'partner_name' => $this->input->post('partner_name', true),
                        'licence_name' => $this->input->post('licence_name', true), // Company name
                        'licence_code' => $this->input->post('licence_code', true), // Company registration number
                        'licence_proof' => (!empty($licence_doc)) ?  $licence_doc : [],
                        'description' => $this->input->post('description', true),
                        'address' => $this->input->post('address', true),
                        'type' => $this->input->post('type', true),
                        'tax_name' => $this->input->post('tax_name', true),
                        'tax_number' => $this->input->post('tax_number', true),
                        'account_number' => $this->input->post('account_number', true),
                        'account_name' => $this->input->post('account_name', true),
                        'bank_code' => $this->input->post('bank_code', true),
                        'bank_name' => $this->input->post('bank_name', true),
                        'pan_number' => $this->input->post('pan_number', true),
                        // 'cooking_time' => $this->input->post('cooking_time', true),
                        'gallery' => (isset($_POST['gallery']) && !empty($_POST['gallery'])) ? $this->input->post('gallery', true) : NULL,
                        'status' => $this->input->post('status', true),
                        'licence_status' => 1,
                        'permissions' => $permmissions,
                        'slug' => create_unique_slug($this->input->post('partner_name', true), 'partner_data')
                    );
                    $insert_id = $this->Partner_model->add_partner($data, [], $work_time, $tags);
                    if (!empty($insert_id)) {
                        $this->response['error'] = false;
                        $this->response['message'] = 'Partner Registered Successfully';
                        print_r(json_encode($this->response));
                    } else {
                        $this->response['error'] = true;
                        $this->response['message'] = "partner data was not Registered";
                        print_r(json_encode($this->response));
                    }
                } else {
                    $this->response['error'] = true;
                    $message = (isset($_POST['id'])) ? 'partner not Updated' : 'partner not Registered.';
                    $this->response['message'] = $message;
                    print_r(json_encode($this->response));
                }
            }
        }
    }

    public function test()
    {
        $result = find_google_map_distance(23.24114205388701, 69.66720847135304, 23.235700208395272, 69.7287490771754);
        print_r(json_encode($result));
    }
}
