<?php

session_start();
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    unset($_SESSION['user_account']);
}
echo '<script>
  window.location.href = "../login.php";
  </script>';
?>