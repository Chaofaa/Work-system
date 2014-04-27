<div class="<? if($this->ion_auth->is_admin()){ ?>col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 <? } ?>main">
      <h1><?= $page['title']; ?></h1>
      <div class="table-responsive">
          <form class="add_user" method="post" auction="<?= base_url(); ?>users/personal">
              <? if(isset($error)){ ?>
                <div class="alert alert-danger"><?= $error; ?></div>
              <? } ?>
              <? if(isset($success)){ ?>  
                    <div class="alert alert-success"><?= $success ?></div>
              <? } ?>
              <div class="form-group">
                  <label>Username*</label>
                  <input type="text" name="username" class="form-control" placeholder="Ievadi Username" value="<?= (($user->username)?$user->username:''); ?>" required />
              </div>
              <div class="form-group">
                  <label>Email*</label>
                  <input type="email" name="email" class="form-control" placeholder="Ievadi Email" value="<?= (($user->email)?$user->email:''); ?>" required />
              </div>
              <div class="form-group">
                  <label>Vards</label>
                  <input type="text" name="first_name" class="form-control" placeholder="Ievadi Vards" value="<?= (($user->first_name)?$user->first_name:''); ?>" />
              </div>
              <div class="form-group">
                  <label>Uzvards</label>
                  <input type="text" name="last_name" class="form-control" placeholder="Ievadi Uzvards" value="<?= (($user->last_name)?$user->last_name:''); ?>" />
              </div>
              <div class="form-group">
                  <label>Talrunis</label>
                  <input type="text" name="phone" class="form-control" placeholder="Ievadi Talrunis" value="<?= (($user->phone)?$user->phone:''); ?>" />
              </div>    
              <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Ja vajag nomainit parole!</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Ievadi new password" />
                    </div>
                    <div class="form-group" id="r_p">
                        <label>Rep. password</label>
                        <input type="password" name="rep_password" oninput="check(this)" class="form-control" placeholder="Ievadi Rep. password" />
                    </div>
                </div>
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-default">Saglabat</button> 
              </div>
          </form>
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