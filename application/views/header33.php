
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<title>Tech Vyas Software</title>
<!-- Site favicon -->
<link rel='shortcut icon' type='image/x-icon' href='<?=base_url();?>assets/images/favicon.ico' />
<!-- /site favicon -->

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown-customer/semantic.js"></script>
<link type="text/css" href="<?php echo base_url();?>assets/dropdown-customer/semantic.css" rel="stylesheet" />


<!-- Entypo font stylesheet -->
<link href="<?=base_url();?>assets/css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="<?=base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->
<!------------------------report menu-------------------------->

<link href="<?php echo base_url();?>assets/report/report.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/report-js/jquery.min.js" type="text/javascript"></script>

<!------------------------report menu close-------------------------->
<!-- Integral core stylesheet -->
<link href="<?=base_url();?>assets/css/integral-core.css" rel="stylesheet">
<!-- /integral core stylesheet -->

<!--Jvector Map-->
<link href="<?=base_url();?>assets/plugins/jvectormap/css/jquery-jvectormap-2.0.3.css" rel="stylesheet">

<link href="<?=base_url();?>assets/css/integral-forms.css" rel="stylesheet">

<link href="<?=base_url();?>assets/css/invoice.css" rel="stylesheet">
 
<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/inv_css/css/style.css' />
<script src="<?=base_url();?>assets/paging-css/jquery.simplePagination.js"></script>

<!-- fancyBox -->
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/js/portfolio/source/jquery.fancybox.css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/js/portfolio/isotope.css">
<!-- fancyBox -->

</head>
<?php $this->load->view("javascriptPage.php");?>
<body <?php if($_GET['view']!=''){?> oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' <?php }?>>

<!-- Loader Backdrop -->
	<div class="loader-backdrop">           
	  <!-- Loader -->
		<div class="loader">
			<div class="bounce-1"></div>
			<div class="bounce-2"></div>
		</div>
	  <!-- /loader -->
	</div>
<!-- loader backgrop -->
	
<!-- Page container -->
<div class="page-container">
<?php if($_GET['popup']=='True'){} else {?>

<!-- Page Sidebar -->
<?php 
//require_once(APPPATH.'views/side.php');
$this->load->view("side.php");?>
<!-- /page sidebar -->

  <!-- Main container -->
<div class="main-container">

<!-- Main header -->
<div class="main-header row">

<div class="col-sm-6 col-xs-7"></div>

<div class="col-sm-6 col-xs-5" >
<div class="pull-right" >
<!-- User alerts -->
<ul class="user-info pull-left">
<!-- Notifications -->
<li class="notifications dropdown">
<a style="display:none" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-attention"></i><span class="badge badge-info">6</span></a>
<ul class="dropdown-menu pull-right">
<li class="first">
<div class="small"><a class="pull-right" href="#">Mark all Read</a> You have <strong>3</strong> new notifications.</div>
</li>
<li>
<ul class="dropdown-list">
<li class="unread notification-success"><a href="#"><i class="icon-user-add pull-right"></i><span class="block-line strong">New user registered</span><span class="block-line small">30 seconds ago</span></a></li>
<li class="unread notification-secondary"><a href="#"><i class="icon-heart pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
<li class="unread notification-primary"><a href="#"><i class="icon-user pull-right"></i><span class="block-line strong">Privacy settings have been changed</span><span class="block-line small">2 hours ago</span></a></li>
<li class="notification-danger"><a href="#"><i class="icon-cancel-circled pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
<li class="notification-info"><a href="#"><i class="icon-info pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
<li class="notification-warning"><a href="#"><i class="icon-rss pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
</ul>
</li>
<li class="external-last"> <a href="#">View all notifications</a> </li>
</ul>
</li>
<!-- /notifications -->

<!-- Messages -->
<li class="notifications dropdown">
<a style="display:none" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-mail"></i><span class="badge badge-secondary">12</span></a>
<ul class="dropdown-menu pull-right">
<li class="first">
<div class="dropdown-content-header"><i class="fa fa-pencil-square-o pull-right"></i> Messages</div>
</li>
<li>
<ul class="media-list">
<li class="media">
<div class="media-left"><img alt="" class="img-circle img-sm" src="images/domnic-brown.png"></div>
<div class="media-body">
<a class="media-heading" href="#">
<span class="text-semibold">Domnic Brown</span>
<span class="media-annotation pull-right">Tue</span>									
</a>
<span class="text-muted">Your product sounds interesting I would love to check this ne...</span>								
</div>
</li>
<li class="media">
<div class="media-left"><img alt="" class="img-circle img-sm" src="images/john-smith.png"></div>
<div class="media-body">
<a class="media-heading" href="#">
<span class="text-semibold">John Smith</span>
<span class="media-annotation pull-right">12:30</span>									
</a>
<span class="text-muted">Thank you for posting such a wonderful content. The writing was outstanding...</span>								
</div>
</li>
<li class="media">
<div class="media-left"><img alt="" class="img-circle img-sm" src="images/stella-johnson.png"></div>
<div class="media-body">
<a class="media-heading" href="#">
<span class="text-semibold">Stella Johnson</span>
<span class="media-annotation pull-right">2 days ago</span>									
</a>
<span class="text-muted">Thank you for trusting us to be your source for top quality sporting goods...</span>								
</div>
</li>
<li class="media">
<div class="media-left"><img alt="" class="img-circle img-sm" src="images/alex-dolgove.png"></div>
<div class="media-body">
<a class="media-heading" href="#">
<span class="text-semibold">Alex Dolgove</span>
<span class="media-annotation pull-right">10:45</span>									
</a>
<span class="text-muted">After our Friday meeting I was thinking about our business relationship and how fortunate...</span>								
</div>
</li>
<li class="media">
<div class="media-left"><img alt="" class="img-circle img-sm" src="images/domnic-brown.png"></div>
<div class="media-body">
<a class="media-heading" href="#">
<span class="text-semibold">Domnic Brown</span>
<span class="media-annotation pull-right">4:00</span>									
</a>
<span class="text-muted">I would like to take this opportunity to thank you for your cooperation in recently completing...</span>								
</div>
</li>
</ul>
</li>
<li class="external-last"> <a  href="#">All Messages</a> </li>
</ul>
</li><!-- /messages -->
</ul><!-- /user alerts -->

<ul class="user-info pull-left">         
<li class="profile-info dropdown"><a  data-toggle="dropdown" class="dropdown-toggle" href="<?php echo base_url(); ?>master/Item/dashboar" aria-expanded="false"> <img style="display:none" width="44" class="img-circle avatar" alt="" src="<?=base_url();?>assets/images/man-3.jpg"><strong>admin</strong><span class="caret"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<!-- User action menu -->
<ul class="dropdown-menu">
<li style="display:none"><a href="<?php echo base_url();?>master/Item/profile"><i class="icon-user" ></i>My profile</a></li>
<li><a href="<?php echo base_url();?>master/changePassword/changepwd"><i class="icon-cog"></i>Change Password</a></li>
<li><a href="<?php echo base_url();?>master/Item/logout"><i class="icon-logout"></i>Logout</a></li>
</ul>
<!-- /user action menu -->

</li>
</ul>


</div>
</div>
</div>
<?php }?>
<!-- /main header -->
