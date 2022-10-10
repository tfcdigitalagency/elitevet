<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Disable Veteran Digital Engagements Portal Admin Dashboard</title>

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
</style>

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="<?=base_url()?>" class="d-inline-block">
            <img src="<?=base_url(GLOBAL_URL)?>images/logo_light.png" style="height: 2rem;" alt="">
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
<!--                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">-->
<!--                    <img src="--><?//= empty($user['avatar'])?base_url(GLOBAL_URL).'images/placeholders/placeholder.jpg':base_url().$user['avatar'];?><!--" class="rounded-circle" alt="">-->
<!--                    <span>--><?//=!empty($user['name'])?$user['name']:'Admin Dashboard';?><!--</span>-->
<!--                </a>-->

                <div class="dropdown-menu dropdown-menu-right">
<!--                    <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>-->
<!--                    <div class="dropdown-divider"></div>-->
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
                        'name' => 'User',
                        'url' => 'user',
                        'icon' => 'icon-users',
                        'id' => 'user',
                        'sub_menus' => array(
                            array(
                                'name' => 'View All',
                                'url' => 'admin/user/user',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'user',
                            ),
                            array(
                                'name' => 'Contact',
                                'url' => 'admin/user/contact',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'contact',
                            )
                        )
                    ),array(
                        'name' => 'Training',
                        'url' => 'training',
                        'icon' => 'icon-color-sampler',
                        'id' => 'training',
                        'sub_menus' => array(
                            array(
                                'name' => 'View All',
                                'url' => 'admin/training/view',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'view',
                            ),
                            array(
                                'name' => 'New',
                                'url' => 'admin/training/add',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'add',
                            )
                        )
                    ),array(
                        'name' => 'Event',
                        'url' => 'event',
                        'icon' => 'icon-tree6',
                        'id' => 'event',
                        'sub_menus' => array(
                            array(
                                'name' => 'View All',
                                'url' => 'admin/event/view',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'view',
                            ),
                            array(
                                'name' => 'New',
                                'url' => 'admin/event/add',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'add',
                            )
                        )
                    ),array(
                        'name' => 'Survey',
                        'url' => 'survey',
                        'icon' => 'icon-sun3',
                        'id' => 'survey',
                        'sub_menus' => array(
                            array(
                                'name' => 'Questions',
                                'url' => 'admin/survey/list',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'view',
                            ),
                            array(
                                'name' => 'Results',
                                'url' => 'admin/survey/result',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'add',
                            )
                        )
                    ),array(
                        'name' => 'Webinar',
                        'url' => 'webinar',
                        'icon' => 'icon-list2',
                        'id' => 'webinar',
                        'sub_menus' => array(
                            array(
                                'name' => 'Gallery & Music',
                                'url' => 'admin/webinar/gallery_music',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'gallery_music',
                            ),
                            array(
                                'name' => 'Ads Image & Handout',
                                'url' => 'admin/webinar/image_handout',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'image_handout',
                            ),
                            array(
                                'name' => 'Control',
                                'url' => 'admin/webinar/control',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'webinar_control',
                            ),
                            array(
                                'name' => 'Post bids',
                                'url' => 'admin/webinar/postbids',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'postbids',
                            ),
                            array(
                                'name' => 'MailChimp',
                                'url' => 'admin/webinar/mailchimp',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'mailchimp',
                            ),
                            array(
                                'name' => 'Remind Email Template',
                                'url' => 'admin/webinar/remindemail',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'remindemail',
                            ),
                            array(
                                'name' => 'Create a webinar email',
                                'url' => 'admin/webinar/createemail',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'createemail',
                            ),
                            array(
                                'name' => 'SMTP Email config',
                                'url' => 'admin/webinar/smtp_config',
                                'icon' => 'icon-arrow-right5',
                                'id' => 'smtp_config',
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
					<?php if(get_admin_level() == 1):?>
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
                        <a href="<?=base_url().'admin/membership'?>" class="nav-link">
                            <i class="icon-puzzle2"></i><span>Membership</span>
                        </a>
                    </li>
					<li class="nav-item  nav-item-submenu <?= $id =='page' ? 'nav-item-expanded nav-item-open' : ''; ?>">
						<a href="<?=base_url().'admin/ads'?>" class="nav-link">
							<i class="icon-puzzle"></i><span>Pages</span>
						</a>
						<ul class="nav nav-group-sub">

								<li class="nav-item">
									<a href="<?=base_url().'admin/page?page=SDVOSB'?>" class="nav-link">
										<i class="icon-arrow-right5"></i>SDVOSB & DVBE Programs</a>
								</li>

						</ul>
					</li>
                    <li class="nav-item">
                        <a href="<?=base_url().'admin/ads'?>" class="nav-link">
                            <i class="icon-image-compare"></i><span>Ads</span>
                        </a>
                    </li>
					<li class="nav-item">
						<a href="<?=base_url().'admin/news/list'?>" class="nav-link">
							<i class="icon-newspaper"></i><span>Articles Management</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?=base_url().'admin/dig/list'?>" class="nav-link">
							<i class="icon-newspaper"></i><span>Dig Mag</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?=base_url().'admin/landads'?>" class="nav-link">
							<i class="icon-newspaper"></i><span>Land-Ads</span>
						</a>
					</li>

					<li class="nav-item">
                        <a href="<?=base_url().'admin/sponsors'?>" class="nav-link">
                            <i class="icon-book2"></i><span>Sponsors</span>
                        </a>
                    </li>
					<li class="nav-item">
                        <a href="<?=base_url().'admin/email/view'?>" class="nav-link">
                            <i class="icon-stack2"></i><span>Email Logs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-pencil3"></i><span>Emails Management</span>
                        </a>
                    </li>
					<li class="nav-item">
						<a href="<?=base_url().'admin/contactus'?>" class="nav-link">
							<i class="icon-cabinet"></i><span>Contact Us</span>
						</a>
					</li>

					<?php endif;?>
					<?php if(get_admin_level() == 3):?>
						<li class="nav-item nav-item-submenu <?php echo (in_array($sub_id,array('mailchimp','remindemail','createemail'))?'nav-item-expanded nav-item-open':'')?>">
							<a href="<?=base_url().'auth/logout'?>" class="nav-link">
								<i class="icon-feed"></i><span>Email Management</span>
							</a>
							<ul id="webinar" class="nav nav-group-sub" style="display: block;">
								<li class="nav-item">
									<a href="<?php echo site_url('admin/webinar/mailchimp')?>" class="<?php echo ($sub_id == 'mailchimp')?'nav-link  active':'nav-link'?>"><i class="icon-arrow-right5"></i>MailChimp</a></li>
								<li class="nav-item">
									<a href="<?php echo site_url('admin/webinar/remindemail')?>" class="<?php echo ($sub_id == 'remindemail')?'nav-link  active':'nav-link'?>"><i class="icon-arrow-right5"></i>Remind Email Template</a></li>
								<li class="nav-item">
									<a href="<?php echo site_url('admin/webinar/createemail')?>" class="<?php echo ($sub_id == 'createemail')?'nav-link  active':'nav-link'?>"><i class="icon-arrow-right5"></i>Create a webinar email</a></li>
							</ul>
						</li>
					<?php endif;?>
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
