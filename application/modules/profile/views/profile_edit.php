<?php

if (isset($user)) {
	$id = $user['user_id'];
	$inputFullnameValue = $user['user_full_name'];
	$inputGenderValue = $user['user_gender'];
	$inputPobValue = $user['user_pob'];
	$inputDobValue = $user['user_dob'];
	$inputPhoneValue = $user['user_phone'];
	$inputAddressValue = $user['user_address'];
	$inputEmailValue = $user['user_email'];

} else {
	$inputGenderValue = set_value('user_gender');
	$inputPobValue = set_value('user_pob');
	$inputDobValue = set_value('user_dob');
	$inputPhoneValue = set_value('user_phone');
	$inputAddressValue = set_value('user_address');
	$inputEmailValue = set_value('user_email');

}
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li><a href="<?php echo site_url('manage/profile') ?>">Profile</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- Main content -->
	<section class="content">
		<?php echo form_open_multipart(current_url()); ?>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-9">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<?php echo validation_errors(); ?>
						<?php if (isset($user)) { ?>
							<input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
						<?php } ?>
						<div class="form-group">
							<label>Email <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="user_email" type="text" class="form-control" <?php echo (isset($user)) ? 'disabled' : ''; ?> value="<?php echo $inputEmailValue ?>" placeholder="email">
						</div> 

						<div class="form-group">
							<label>Nama lengkap <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="user_full_name" type="text" class="form-control" value="<?php echo $inputFullnameValue ?>" placeholder="Nama lengkap">
						</div>

						<div class="form-group">
							<label>Jenis Kelamin</label>
							<div class="radio">
								<label>
									<input type="radio" name="user_gender" value="L" <?php echo ($inputGenderValue == 'L') ? 'checked' : ''; ?>> Laki-laki
								</label>&nbsp;&nbsp;
								<label>
									<input type="radio" name="user_gender" value="P" <?php echo ($inputGenderValue == 'P') ? 'checked' : ''; ?>> Perempuan
								</label>
							</div>
						</div>

						<div class="form-group">
							<label>Tempat Lahir</label>
							<input type="text" class="form-control" name="user_pob" placeholder="Tempat Lahir" value="<?php echo $inputPobValue ?>">
						</div>

						<div class="form-group">
							<label>Tanggal Lahir </label>
							<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								<input class="form-control" type="text" name="user_dob" readonly="readonly" placeholder="Tanggal" value="<?php echo $inputDobValue; ?>">
							</div>
						</div>

						<div class="form-group">
							<label>No. Handphone</label>
							<input type="text" class="form-control" name="user_phone" placeholder="No. Handphone" value="<?php echo $inputPhoneValue ?>">
						</div>

						<div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" name="user_address" placeholder="Alamat Lengkap"><?php echo $inputAddressValue ?></textarea>
						</div>

						<p class="text-muted">*) Kolom wajib diisi.</p>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<label >Foto</label>
						<a href="#" class="thumbnail">
							<?php if (isset($user) AND $user['user_image'] != NULL) { ?>
								<img src="<?php echo upload_url('users/' . $user['user_image']) ?>" class="img-responsive avatar">
							<?php } else { ?>
								<img id="target" alt="Choose image to upload">
							<?php } ?>
						</a>
						<input type='file' id="user_image" name="user_image">
						<br>
						<button type="submit" class="btn btn-block btn-success">Simpan</button>
						<a href="<?php echo site_url('manage/profile'); ?>" class="btn btn-block btn-info">Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>
<script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#target').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#user_image").change(function() {
		readURL(this);
	});
</script>