    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
      	<a href="<?= base_url(); ?>users" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Atpakaļ</span></a>
      </div>
      <div class="table-responsive">
      	<form role="form" class="add_user" method="post" action="<?= base_url(); ?>users/add">
            <div class="alert alert-danger <?= ((isset($error))?'show':'hidden'); ?>"><?= $error; ?></div>
      		<div class="form-group">
      			<label for="email">Email*</label>
      			<input type="email" class="form-control" name="email" id="email" placeholder="Ievadi Email" required />
      		</div>
      		<div class="form-group">
      			<label for="username">Username*</label>
      			<input type="text" class="form-control" name="username" id="username" placeholder="Ievadi Username" required />
      		</div>
      		<div class="form-group">
      			<label for="password">Password*</label>
      			<input type="password" class="form-control" name="password" id="password" placeholder="Ievadi Password" required />
      		</div>
      		<div class="form-group" id="r_p">
      			<label for="rep_password">Rep. Password*</label>
      			<input type="password" class="form-control" oninput="check(this)" name="rep_password" id="rep_password" placeholder="Ievadi Rep. Password" required />
      		</div>
      		<div class="form-group">
			  <label>
			    <input type="radio" name="active" id="optionsRadios1" value="1" checked>
			    Aktivs
			  </label>
			</div>
			<div class="form-group">
			  <label>
			    <input type="radio" name="active" id="optionsRadios2" value="0">
			    Ne aktivs
			  </label>
			</div>
      		<div class="form-group">
      			<label for="name">Vards</label>
      			<input type="text" class="form-control" name="first_name" id="name" placeholder="Ievadi Vards" />
      		</div>
      		<div class="form-group">
      			<label for="last_name">Uzvards</label>
      			<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Ievadi Uzvards" />
      		</div>
      		<div class="form-group">
      			<label for="talrunis">Talrunis</label>
      			<input type="text" class="form-control" name="phone" id="talrunis" placeholder="Ievadi Talrunis" />
      		</div>
      		<div class="form-group">
      			<label for="group">Grupa</label>
      			<select class="form-control" name="group">
      				<option>Izvelies Grupu</option>
      				<? foreach($groups as $v){ ?>
      				<option value="<?= $v->id; ?>"><?= $v->name; ?> - <?= $v->description; ?></option>
      				<? } ?>
      			</select>
      		</div>
      		<button type="submit" class="btn btn-default">Saglabat</button>
      	</form>
      </div>
    </div>
    <script language='javascript' type='text/javascript'>
      function check(input) {
          if (input.value != document.getElementById('password').value) {
            $("#r_p").addClass(' has-error');             
          } else {
              // input is valid -- reset the error message
            $("#r_p").removeClass(' has-error');
            $("#r_p").addClass(' has-success');
         }
      }
      </script>


  </div>
</div>