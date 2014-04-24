    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
      	<a href="<?= base_url(); ?>lieta" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Atpakaļ</span></a>
      </div>
      <div class="table-responsive">
      	<form role="form" class="add_user" method="post" action="<?= base_url(); ?>lieta/change/<?= $this->uri->segment(3); ?>">
            <div class="alert alert-danger <?= ((isset($error))?'show':'hidden'); ?>"><?= $error; ?></div>
      		  <div class="alert alert-success <?= ((isset($success))?'show':'hidden'); ?>"><?= $success ?></div>
          <div class="form-group">
      			<label for="name">Nosaukums*</label>
      			<input type="text" class="form-control" name="name" id="client" placeholder="Ievadi Nosaukums" value="<?= $lieta->name; ?>" required />
      		</div>
      		<div class="form-group">
      			<label for="comment">Info</label>
      			<textarea name="comment" id="editor" class="form-control" placeholder="Ievadi Info"><?= $lieta->info; ?></textarea>
      		</div>
      		<button type="submit" class="btn btn-default">Saglabat</button>
      	</form>
      </div>
    </div>
    <script>
      CKEDITOR.replace( 'editor' );
    </script>
  </div>
</div>