<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if ($this->session->userdata('user_image') != null) { ?>
                <img src="<?php echo upload_url().'/users/'.$this->session->userdata('user_image'); ?>" class="img-responsive">
                <?php } else { ?>
                <img src="<?php echo media_url() ?>img/user.png" class="img-responsive">
                <?php } ?>
            </div>
            <div class="pull-left info">
                <p><?php echo ucfirst($this->session->userdata('ufullname')); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header main-menu">MENU</li>

            <li class="<?php echo ($this->uri->segment(2) == 'dashboard' OR $this->uri->segment(2) == NULL) ? 'active' : '' ?>">
                <a href="<?php echo site_url('manage'); ?>">
                    <i class="fa fa-th"></i> <span>Dashboard</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li class="<?php echo ($this->uri->segment(2) == 'posts') ? 'active' : '' ?>">
                <a href="<?php echo site_url('manage/posts'); ?>">
                    <i class="fa fa-file-text-o"></i> <span>Posting</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li class="<?php echo ($this->uri->segment(2) == 'logs') ? 'active' : '' ?>">
                <a href="<?php echo site_url('manage/logs'); ?>">
                    <i class="fa fa-history"></i> <span>Logs</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <?php if ($this->session->userdata('uroleid') == SUPERUSER) { ?>
            <li class="<?php echo ($this->uri->segment(2) == 'users') ? 'active' : '' ?>">
                <a href="<?php echo site_url('manage/users'); ?>">
                    <i class="fa fa-users"></i> <span>Manage Users</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            <?php } ?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>