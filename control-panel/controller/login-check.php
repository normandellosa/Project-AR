<?php session_start(); ?>

<?php 

require_once('../dao/accountDao.php');

$account_username = $_POST['username'];
$account_password = sha1($_POST['password']);

$account = accountDao::checkLogin($account_username, $account_password);

if($account) {


	$_SESSION['account_id'] = $account['account_id'];
	$_SESSION['account_type'] = $account['account_type'];
	$_SESSION['account_display_name'] = $account['account_display_name'];

	require_once('../dao/logDao.php');
	date_default_timezone_set('Asia/Manila');
	$log_date = date('Y-m-d H:i A');
	$log_description = "Login Successful";
	$log_account_id = $_SESSION['account_id'];
	logDao::addLog($log_date, $log_description, $log_account_id);


	echo "<script> location.href='pages/manage-carousel.php'; </script>";


} else {

	echo "<script> alert('Please check your username/password.'); </script>";
}

 ?>