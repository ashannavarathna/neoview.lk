<?php

session_start();
$document_root = realpath($_SERVER["DOCUMENT_ROOT"]);
//main inclued files
//echo $document_root . '/__rootaccess_prams.php';
//
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
//cehck for data

$success = false;
$message = '';
if (isset($_POST['dataset_'])) {
    $conn_db = new db_conn();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_profile = UserProfileDAO::getByQuery($conn_db, " email='{$email}'", null);
    if ($user_profile != null) {
        $user_account = UserAccountDAO::getByQuery($conn_db, " user_profile_iduser_profile='{$user_profile->getId()}'", null);
        if ($user_account != null) {
            if ($user_account->getUser_role_obj()->getId() == 2 || $user_account->getUser_role_obj()->getId() == 3) {
                if ($user_account->getAccount_verified()) {
                    // inactive account
                    if ($user_account->getStatus() == 0) {
                        // inactive account
                    } else if ($user_account->getStatus() == 1) {
                        //active account
                        //check login attemt
                        //chekc password
                        $upassword = $user_account->getPassword();
                        if ($upassword == md5($password)) {
                            //loging success
                            $_SESSION['user'] = array(
                                "_iduser_profile" => $user_profile->getId(),
                                "_user_name" => $user_profile->getFirstname() . ' ' . $user_profile->getLastname(),
                                "_user_email" => $user_profile->getEmail()
                            );
                            $_SESSION['user_account'] = array(
                                "_iduser_account" => $user_account->getId(),
                                "_iduser_role" => $user_account->getUser_role_obj()->getId(),
                            );
                            UserAccountDAO::update($conn_db, $user_account->getId(), null, null, 0, null, null, null, null, null);
                            $success = true;
                            header("Location: ../index.php");
                            exit();
                        } else {
                            $max_login_attempt = $user_account->getMax_login_attempt() + 1;
                            if ($max_login_attempt <= 3) {
                                UserAccountDAO::update($conn_db, $user_account->getId(), null, null, $max_login_attempt, null, null, null, null, null);
                            } else {
                                UserAccountDAO::update($conn_db, $user_account->getId(), null, 2, null, null, null, null, null, null);
                            }
                            $message = "user name or password invalid!";
                        }
                    } else if ($user_account->getStatus() == 2) {
                        //susped account
                        $message = "Your account is suspened!";
                    }
                } else {
                    // account not verified
                    $message = "Your account is not verifed!";
                }
            } else {
                //unathorized access
                $message = "unthorized access!";
            }
        } else {
            // no profile found => user name password invalid!
            $message = "no associate accoutn found for email!";
        }
    } else {
        // no profile found => user name password invalid!
        $message = "no associate accoutn found for email!";
    }
} else {
    $message = "access denied!";
}

if (!$success) {
    echo 'helooo';
    header("Location: ../login.php?msg={$message}");
    exit();
}
?>
