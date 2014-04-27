    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
      	<a href="<?= base_url(); ?>clients" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Atpakaļ</span></a>
      </div>
      <div class="table-responsive">
      	<form role="form" class="add_user" method="post" action="<?= base_url(); ?>clients/change/<?= $this->uri->segment(3); ?>">
            <div class="alert alert-danger <?= ((isset($error))?'show':'hidden'); ?>"><?= $error; ?></div>
      		  <div class="alert alert-success <?= ((isset($success))?'show':'hidden'); ?>"><?= $success ?></div>
          <div class="form-group">
      			<label for="client">Client*</label>
      			<input type="text" class="form-control" name="client" id="client" placeholder="Ievadi Client" value="<?= $client_data->name; ?>" required />
      		</div>
      		<div class="form-group">
      			<label for="reg_nr">Reģ. nr.</label>
      			<input type="text" class="form-control" name="reg_nr" id="reg_nr" placeholder="Ievadi Reģ. Nr." value="<?= $client_data->reg_nr; ?>" />
      		</div>
      		<div class="form-group">
      			<label for="adress">Adress</label>
      			<input type="text" class="form-control" name="adress" id="adress" placeholder="Ievadi Adress" value="<?= $client_data->adress; ?>" />
      		</div>
      		<div class="form-group" id="r_p">
      			<label for="phone">Talrunis</label>
      			<input type="text" class="form-control" name="phone" id="phone" placeholder="Ievadi Talrunis" value="<?= $client_data->phone; ?>" />
      		</div>
      		<div class="form-group">
      			<label for="persona">Kontakta Persona</label>
      			<input type="text" class="form-control" name="persona" id="persona" placeholder="Ievadi Kontakta Persona" value="<?= $client_data->person; ?>" />
      		</div>
      		<div class="form-group">
      			<label for="email">Email</label>
      			<input type="text" class="form-control" name="email" id="email" placeholder="Ievadi Email" value="<?= $client_data->email; ?>" />
      		</div>
      		<button type="submit" class="btn btn-default">Saglabat</button>
      	</form>
      </div>
    </div>

  </div>
</div>