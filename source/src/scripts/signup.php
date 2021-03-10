<?php

//setup session
session_start();

//json data set
$success = false;
$message = 'server_messages =>';
$response = array();

try {

//Document Root Path
    $document_root = realpath($_SERVER["DOCUMENT_ROOT"]);
//main inclued files
    //online
//require_once $document_root . '/__rootaccess_prams.php';
//local host
    require_once $document_root . '/webbasedinventorysystem/__rootaccess_prams.php';
//sub inclued files
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/connection/db_conn.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserProfile.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserProfileDAO.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserAccount.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserAccountDAO.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Contacts.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/ContactsDAO.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserAddress.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserAddressDAO.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserRole.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserRoleDAO.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/Status.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/StatusDAO.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/pojos/UserGender.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/logic/UserGenderDAO.php';
    require_once $document_root . __rootaccess_prams::$__home_dir . '/src/common/Times.php';



//databace object
    $connection_db = new db_conn();



//proccess from data
//user profile
    $iduser_profile;

    $fname;
    $lname;
    $nic = 0;
    $dob;
    $email;
    $idgender = 1;


//address
    $no;
    $line1;
    $line2;
    $line3;
    $line4 = 'adds';
    $zipcode;
    $status_address;

//contacts
    $number_1;
    $number_2;

//useraccount
    $passowrd;
    $verifedcode;
    $status = 0;
    $idstatus = 0;
    $max_login_attempt = 0;
    $account_verified = false;
    $idrole = 1;




    if (isset($_POST['dataquery'])) {
        //basic details
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob = $_POST['dob_year'] . '-' . $_POST['dob_month'] . '-' . $_POST['dob_days'];
        $idgender = $_POST['gender'];
        $email = $_POST['email'];
        $passowrd = $_POST['password'];

        //address
        $no = $_POST['address_no'];
        $line1 = $_POST['address_no'];
        $line2 = $_POST['address_line1'];
        $line3 = $_POST['address_line2'];
        $line4 = $_POST['address_line3'];
//        $line4 = $_POST['address_line4'];
        $zipcode = $_POST['postcode'];

        //contacts
        $number_1 = $_POST['mobile_phone'];


        //check user alreday created by email
        $user_profile = UserProfileDAO::getByQuery($connection_db, " email='{$email}'", null);
        if ($user_profile != null) {
            $message .= " This email alreday used!";
        } else {
            $datetime = Times::getFullTime();
            if (UserProfileDAO::save($connection_db, $fname, $lname, $nic, $email, $dob, $idgender, $datetime)) {
                $user_profile = UserProfileDAO::getByQuery($connection_db, " email='{$email}'", null);
                if ($user_profile != null) {
                    $flag_contact = true;
                    $flag_useraddress = true;
                    $flag_useraccount = true;

                    $contact_obj;
                    $addres_obj;
                    $account_obj;
//                    save contacts
                    if (isset($number_1)) {
                        if (ContactsDAO::save($connection_db, $number_1, 3, true, $user_profile->getId())) {
                            //success
                            $contact_obj = ContactsDAO::getByQuery($connection_db, " user_profile_iduser_profile='{$user_profile->getId()}'", null);
                        } else {
                            $flag_contact = false;
                            $message .= " _can not create contact mobile!";
                        }
                    }
                    //create user adddress
                    if (UserAddressDAO::save($connection_db, $no, $line1, $line2, $line3, $line4, $zipcode, 1, $user_profile->getId())) {
                        //success
                        $addres_obj = UserAddressDAO::getByQuery($connection_db, " user_profile_iduser_profile='{$user_profile->getId()}'", null);
                    } else {
                        $flag_useraccount = false;
                        $message .= " _can not create user address!";
                    }
//                    creating user account
                    $md5_password = md5($passowrd);
                    $verified_code = md5($user_profile->getId() . Times::getFullTime());

                    if (UserAccountDAO::save($connection_db, $md5_password, 0, 0, 3, 0, $verified_code, $user_profile->getId(), 1)) {
                        //save success
                        $account_obj = UserAccountDAO::getByQuery($connection_db, " user_profile_iduser_profile='{$user_profile->getId()}'", null);
                    } else {
                        $flag_useraccount = false;
                        $message .= " _can not create user account!";
                    }
//
                    //roleback data if error occured!
                    if ($flag_useraccount && $flag_contact && $flag_useraddress) {
                        $success = true;
                        $message .= " _Your profile successfuly created! please checkyour email for confirmation!";
                    } else {
                        //delete if saved data!
                        ////delelete user account if saved!
                        if (isset($account_obj)) {
                            if (UserAccountDAO::delete($connection_db, $account_obj->getId())) {
                                $message .= " user account deleted!";
                            }
                        }
                        //delete user contacts if saved!
                        if (isset($contact_obj)) {
                            if (ContactsDAO::delete($db, $contact_obj->getId())) {
                                $message .= " user contact deleted!";
                            }
                        }
                        //delete user address if saved!
                        if (isset($addres_obj)) {
                            if (UserAddressDAO::delete($db, $addres_obj->getId())) {
                                $message .= " user address deleted!";
                            }
                        }
                        //delete user profile if saved!
                        if (isset($user_profile)) {
                            if (UserProfileDAO::delete($db, $user_profile->getId())) {
                                $message .= " user profile deleted!";
                            }
                        }
                        $message .= " _error occured";
                    }
                } else {
                    $message .= " _no user profile found!";
                }
            } else {
                $message .= "_can not create user profile!";
            }
        }
    } else {
        $message .= " _no data recived! ";
    }
} catch (Exception $ex) {
    $message = $ex;
    $success = false;

    //json responce

    $response["data"] = array("success" => $success, "message" => $message);
    $json = json_encode($response, JSON_FORCE_OBJECT);
    echo $json;
}

//json responce
$response["data"] = array("success" => $success, "message" => $message);
$json = json_encode($response, JSON_FORCE_OBJECT);
echo $json;
?>

