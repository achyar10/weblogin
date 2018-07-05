<script type="text/javascript">
	var token_name = "<?php echo $this->security->get_csrf_token_name() ?>";
	var csrf_hash = "<?php echo $this->security->get_csrf_hash() ?>";
</script>
<script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
<?php $this->load->view('posts/add_js'); ?>
<?php $this->load->view('manage/tinymce_init'); ?>
<?php
if (isset($posts)) {
	$inputPublishValue = $posts['posts_published_date'];
	$inputJudulValue = $posts['posts_title'];
	$inputRingkasanValue = $posts['posts_description'];
	$inputStatus = $posts['posts_is_published'];
	$inputCategory = $posts['posts_category_category_id'];
} else {
	$inputPublishValue = set_value('posts_published_date');
	$inputJudulValue = set_value('posts_title');
	$inputRingkasanValue = set_value('posts_description');
	$inputStatus = set_value('posts_is_published');
	$inputCategory = set_value('category_id');
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
			<li><a href="<?php echo site_url('manage/users') ?>">Manage Users</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<?php if (!isset($posts)) echo validation_errors(); ?>
	<?php echo form_open_multipart(current_url()); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-9">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<?php if (isset($posts)): ?>
							<input type="hidden" name="posts_id" value="<?php echo $posts['posts_id']; ?>" />
						<?php endif; ?>
						<label>Judul Posting <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
						<input name="posts_title" placeholder="Judul Posting" type="text" class="form-control" value="<?php echo $inputJudulValue; ?>"><br>
						<div class="form-group">
							<label >Deskripsi Posting *</label>
							<textarea name="posts_description" rows="10" class="mce-init"><?php echo $inputRingkasanValue; ?></textarea>
						</div>
						<br/>
						<p style="color:#9C9C9C;margin-top: 5px"><i>*) Field Wajib Diisi</i></p>
						<div class="form-group">
							<div class="box4">
								<label for="image">Unggah File Gambar</label>
								<a href="#" class="thumbnail">
									<?php if (isset($user) AND $user['posts_image'] != NULL) { ?>
									<img src="<?php echo upload_url('posts/' . $posts['posts_image']) ?>" class="img-responsive avatar">
									<?php } else { ?>
									<img id="target" alt="Choose image to upload">
									<?php } ?>
								</a>
								<input type='file' id="posts_image" name="posts_image">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Status Publikasi</label>
							<div class="radio">
								<label>
									<input type="radio" name="posts_is_published" value="0" <?php echo ($inputStatus == 0) ? 'checked' : ''; ?>> Draft
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="posts_is_published" value="1" <?php echo ($inputStatus == 1) ? 'checked' : ''; ?>> Terbit
								</label>
							</div>
							
							<div class="form-group">
								<label>Tanggal Publikasi </label>
								<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
									<input class="form-control" type="text" name="posts_published_date" readonly="readonly" placeholder="Tanggal" value="<?php echo $inputPublishValue; ?>">
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>

						<div class="form-group" ng-controller="CategoriesCtrl">
							<label>Kategori</label>
							<div class=" input-group">
								<select name="category_id" class="form-control" style="position:initial;" id="selectCat">
									<option ng-repeat="category in categories" ng-selected="category_data.index == category.category_id" value="{{category.category_id}}">{{category.category_name}}</option>
								</select>
								<div class="input-group-btn">
									<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#category" aria-expanded="false">
										<span class="fa fa-plus"></span>
									</button>
								</div>
							</div>
							<div class="collapse" id="category">
								<div class="input-group">
									<input class="form-control" placeholder="Tambah Baru" id="appendedInputButton" type="text" ng-model="categoryText">
									<div class="input-group-btn">
										<button class="btn btn-default simpan" type="button" ng-click="addCategory()" ng-disabled="!(!!categoryText)">Simpan</button>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
							<a href="<?php echo site_url('manage/posts'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
							<?php if (isset($posts)): ?>
								<a href="<?php echo site_url('manage/posts/delete/' . $posts['posts_id']); ?>" class="btn btn-danger btn-form" ><i class="fa fa-trash"></i> Hapus</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
</section>
</div>
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

	$("#posts_image").change(function() {
		readURL(this);
	});
</script>
