<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Disable Veteran Digital Engagements Portal Admin MARKETING</title>

    <!-- Global stylesheets -->
<!--    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
    <link href="<?=base_url(GLOBAL_URL)?>css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/colors.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url(ADMIN_URL)?>css/custom.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?=base_url(GLOBAL_URL)?>js/main/jquery.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/main/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/forms/validation/validate.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/forms/selects/select2.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/ui/moment/moment.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/daterangepicker.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/anytime.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/pickadate/picker.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/extensions/jquery_ui/interactions.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/notifications/pnotify.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/forms/styling/switchery.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/forms/styling/switch.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/editors/ckeditor/ckeditor.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/uploaders/fileinput/fileinput.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/editors/summernote/summernote.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/forms/styling/uniform.min.js"></script>

    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/daterangepicker.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/anytime.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/pickadate/picker.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/pickers/pickadate/legacy.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/notifications/jgrowl.min.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/plugins/media/fancybox.min.js"></script>
    <script src="<?=base_url(ADMIN_URL)?>js/app.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/demo_pages/form_select2.js"></script>
    <script src="<?=base_url(GLOBAL_URL)?>js/demo_pages/picker_date.js"></script>

    <!-- /theme JS files -->

</head>

<script>
    var base_url = '<?= base_url() ?>';
</script>
<style>
    .card{
        border-style: solid;
        border-color: #9bbeea;
    }

	.navbar-dark{
		background-color:#bb3e03!important;
	}
	.sidebar-dark {
		background-color: #ca6702;
		color: #fff;
	}
	.sidebar-dark .nav-sidebar>.nav-item-open>.nav-link:not(.disabled), .sidebar-dark .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light .card[class*=bg-]:not(.bg-light):not(.bg-white):not(.bg-transparent) .nav-sidebar>.nav-item-open>.nav-link:not(.disabled), .sidebar-light .card[class*=bg-]:not(.bg-light):not(.bg-white):not(.bg-transparent) .nav-sidebar>.nav-item>.nav-link.active {
		background-color: #fb8500;
		color: #fff;
	}
	.table-bordered>thead {
		background-color: #bb3e03!important;
		color: white;
	}
	.bg-primary {
		background-color: #bb3e03!important;
	}
	.btn-primary {
		color: #fff;
		background-color: #bb3e03;
	}
	.btn-primary:hover {
		color: #fff;
		background-color: #bb3e03;
	}
	.btn-dark {
		color: #fff;
		background-color: #9b2226;
	}
	.bg-teal-400 {
		background-color: #9b2226;
	}
	.font-size-lg{
		font-size:20px;
	}
	.input_error{
		border: 1px solid #ff0000;
	}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css" integrity="sha512-FEQLazq9ecqLN5T6wWq26hCZf7kPqUbFC9vsHNbXMJtSZZWAcbJspT+/NEAQkBfFReZ8r9QlA9JHaAuo28MTJA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>
<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="<?=base_url()?>" class="d-inline-block">
            <img src="<?=base_url(GLOBAL_URL)?>images/logo_light_marketing.png" style="height: 2rem;" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">


        <span class="navbar-text ml-md-3 mr-md-auto" style="position: absolute; right: 10px;">
			Total Visitor: <?php echo get_counter();?>
        </span>

        <ul class="navbar-nav">
            <?php $user = $this->session->userdata('user');?>
            <li class="nav-item dropdown dropdown-user">


                <div class="dropdown-menu dropdown-menu-right">

                    <a href="<?=base_url().'auth/logout'?>" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigation
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->

        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- Main navigation -->
            <div class="card card-sidebar-mobile">
                <?php
                $menus = array(
                    array(
                        'name' => 'Manage User',
                        'url' => 'user',
                        'icon' => 'icon-users',
                        'id' => 'user',
                        'sub_menus' => array(
                            array(
                                'name' => 'User Lists',
                                'url' => 'marketing/user',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'user',
                            )
                        )
                    )
				);
					?>

				<ul class="nav nav-sidebar" data-nav-type="accordion">
					<li class="nav-item">
						<a href="<?=base_url().'customer'?>" class="nav-link" target="_blank">
							<i class="icon-home"></i><span>Go to website</span>
						</a>
					</li>
					<?php foreach ($menus as $menu) : ?>
						<li class="nav-item nav-item-submenu <?= $menu['id'] == $id ? 'nav-item-expanded nav-item-open' : ''; ?>">
							<a href="<?=($menu['id'] == 'logout')?base_url().'auth/logout':'#'?>" class="nav-link">
								<i class="<?=isset($menu['icon']) ? $menu['icon'] : ''?>"></i><span><?= $menu['name'] ?></span>
							</a>
							<?php if (isset($menu['sub_menus'])) : ?>
								<ul id="<?=$menu['id']?>" class="nav nav-group-sub">
									<?php foreach ($menu['sub_menus'] as $item) : ?>
										<li <?= isset($sub_id) && $item['id'] == $sub_id ? 'class="nav-item"' : '' ?>>
											<a href="<?= base_url($item['url']) ?>" class="nav-link  <?= isset($sub_id) && $item['id'] == $sub_id ? 'active' : '' ?>"><i class="    <?=isset($item['icon']) ? $item['icon'] : ''?>"></i><?= $item['name'] ?></a></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
					<li class="nav-item">
						<a href="<?=base_url().'marketing/package'?>" class="nav-link">
							<i class="icon-color-sampler"></i><span>Package management</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?=base_url().'marketing/transaction'?>" class="nav-link">
							<i class="icon-piggy-bank"></i><span>Transaction</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?=base_url().'marketing/EmailTemplate'?>" class="nav-link">
							<i class="icon-library2"></i><span>Email Template</span>
						</a>
					</li>
                    <li class="nav-item">
                        <a href="<?=base_url().'auth/logout'?>" class="nav-link">
                            <i class="icon-align-left"></i><span>Logout</span>
                        </a>

                    </li>

                </ul>
            </div>
            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /main sidebar -->

    <!-- Main content -->
    <div class="content-wrapper">	
	<?php $message = $this->session->flashdata("message");		 
		if($message){
			?>
			<div class="alert alert-success" style="margin:20px" role="alert">
			  <?php  echo $message;?>
			</div>
			<?php
		}	
	?>
	<?php $error = $this->session->flashdata("error");
		 
		if($error){
			?>
			<div class="alert alert-danger" style="margin:20px" role="alert">
			  <?php  echo $error;?>
			</div>
			<?php
		}
	
	?>
