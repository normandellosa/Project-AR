<?php 
	require_once('../dao/accountDao.php');
	$user_acc = accountDao::accountDetail($_SESSION['account_id']);
	$nameAcc = $user_acc['account_display_name'];
?>

<div id="menu-container">	

	<!-- MAIN MENU -->
	<div id="main-menu">
		<div class="admin-logo"><a href="dashboard.php"><img src="../../images/all-rewards-logo.png"></a></div>

		<div class="menu-sh">
			<p class="cms-title">Content Management System</p>
			<p>Logged-in as <span class="highlight"><?= $nameAcc ?></span><br/><a href="manage-accounts_edit.php?id=<?= $_SESSION['account_id'] ?>">Manage Account</a></p>
		</div>
		<input name="dname" type="hidden" value="<?= $nameAcc ?>" id="dname">

		<nav>
			<a href="manage-carousel.php" id="menu-carousel"><i class="fa fa-picture-o"></i>Featured Ads</a>
			<a href="manage-rewards.php" id="menu-updates"><i class="fa fa-gift"></i>Rewards</a>
			<a href="manage-partners.php" id="menu-partners"><i class="fa fa-handshake-o"></i>Partners</a>
			<a href="manage-newsevents.php" id="menu-news"><i class="fa fa-percent"></i>News &amp; Events</a>
			<a href="manage-hotline.php" id="menu-hotline"><i class="fa fa-phone"></i>Hotline</a>
			<div class="nav-divider"></div>
			
			<?php if ($_SESSION['account_type'] == 'Administrator') { ?>
				<?php if ($_SESSION['account_id'] == 1) { ?>
					<a href="manage-recipients.php" id="menu-email"><i class="fa fa-envelope"></i>Inquiry Recipients</a>
					<a href="manage-accounts.php" id="menu-accounts"><i class="fa fa-users"></i>Manage User Accounts</a>
				<?php } ?>
                <!-- <a href="view-activity.php" id="menu-log"><i class="fa fa-history"></i>Activity Log</a> -->
                <a href="data.php" target="_blank"><i class="fa fa-download"></i>Back-Up Database</a>
                <div class="nav-divider"></div>
			<?php } ?>

			<a href="javascript:void();" id="menu-logout"><i class="fa fa-sign-out"></i>Sign Out</a>
		</nav>
	</div>

</div>