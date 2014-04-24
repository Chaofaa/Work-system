<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
      	<a href="<?= base_url(); ?>users" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Atpakaļ</span></a>
      </div>
      <div class="table-responsive">
      	<form role="form" class="add_user" method="post" action="<?= base_url(); ?>users/change/<?= $this->uri->segment(3); ?>">
            <div class="alert alert-danger <?= ((isset($error))?'show':'hidden'); ?>"><?= $error; ?></div>
            <div class="alert alert-success <?= ((isset($success))?'show':'hidden'); ?>"><?= $success ?></div>
      		<div class="form-group">
      			<label for="email">Email*</label>
      			<input type="email" class="form-control" name="email" id="email" placeholder="Ievadi Email" value="<?= $user_data->email; ?>" required />
      		</div>
      		<div class="form-group">
      			<label for="username">Username*</label>
      			<input type="text" class="form-control" name="username" id="username" placeholder="Ievadi Username" value="<?= $user_data->username; ?>" required />
      		</div>
      		<div class="form-group">
			  <label>
			    <input type="radio" name="active" id="optionsRadios1" value="1" <?= (($user_data->active == 1)?'checked':''); ?>>
			    Activs
			  </label>
			</div>
			<div class="form-group">
			  <label>
			    <input type="radio" name="active" id="optionsRadios2" value="0" <?= (($user_data->active == 0)?'checked':''); ?>>
			    Ne aktivs
			  </label>
			</div>
      		<div class="form-group">
      			<label for="name">Vards</label>
      			<input type="text" class="form-control" name="first_name" id="name" value="<?= $user_data->first_name; ?>" placeholder="Ievadi Vards" />
      		</div>
      		<div class="form-group">
      			<label for="last_name">Uzvards</label>
      			<input type="text" class="form-control" name="last_name" id="last_name" value="<?= $user_data->last_name; ?>" placeholder="Ievadi Uzvards" />
      		</div>
      		<div class="form-group">
      			<label for="talrunis">Talrunis</label>
      			<input type="text" class="form-control" name="phone" id="talrunis" value="<?= $user_data->phone; ?>" placeholder="Ievadi Talrunis" />
      		</div>
      		<div class="form-group">
      			<label for="group">Group</label>
      			<select class="form-control" name="group">

      				<option>Izvelies Grupu</option>
      				<? foreach($groups as $v){ ?>
      				<option value="<?= $v->id; ?>" <?= (($user_group->id == $v->id)?'selected':''); ?>><?= $v->name; ?> - <?= $v->description; ?></option>
      				<? } ?>
      			</select>
      		</div>
      		<button type="submit" class="btn btn-default">Saglabat</button>
      	</form>
      </div>
    </div>

  </div>
</div>