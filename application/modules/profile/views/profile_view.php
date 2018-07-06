<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="col-md-12 col-sm-12 col-xs-12 pull-left">
							<br>
							<div class="row">
								<div class="col-md-2">
									<?php if (!empty($user['user_image'])) { ?>
										<img src="<?php echo upload_url('users/'.$user['user_image']) ?>" class="profile-user-img img-responsive">
									<?php } else { ?>
										<img src="<?php echo media_url('img/user.png') ?>" class="profile-user-img img-responsive img-circle">
									<?php } ?>
								</div>
								<div class="col-md-10">
									<table class="table table-hover">
										<tbody>
											<tr>
												<td>Nama Lengkap</td>
												<td>:</td>
												<td><?php echo $user['user_full_name'] ?></td>
											</tr>
											<tr>
												<td>Email</td>
												<td>:</td>
												<td><?php echo $user['user_email'] ?></td>
											</tr>
											<tr>
												<td>Jenis Kelamin</td>
												<td>:</td>
												<td><?php echo ($user['user_gender']=='L')? 'Laki-laki' : 'Perempuan' ?></td>
											</tr>
											<tr>
												<td>Tempat, Tanggal Lahir</td>
												<td>:</td>
												<td><?php echo $user['user_pob'].', '. pretty_date($user['user_dob'],'d F Y',false) ?></td>
											</tr>
											<tr>
												<td>No. Handphone</td>
												<td>:</td>
												<td><?php echo $user['user_phone'] ?></td>
											</tr>
											<tr>
												<td>Alamat</td>
												<td>:</td>
												<td><?php echo $user['user_address'] ?></td>
											</tr>
											<tr>
												<td>Status</td>
												<td>:</td>
												<td><?php echo ($user['user_status']=='active') ? 'Aktif' : 'Tidak Aktif' ?></td>
											</tr>
											
										</tbody>
									</table>

								</div>
								<a href="<?php echo site_url('manage') ?>" class="btn btn-primary">Kembali</a>
								<a href="<?php echo site_url('manage/profile/edit') ?>" class="btn btn-success">Edit</a>
								<a href="<?php echo site_url('manage/profile/cpw') ?>" class="btn btn-warning">Ubah Password</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>