    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
            <a href="<?= base_url(); ?>users" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Atpakaļ</span></a>
      </div>
      <div class="table-responsive">
            <form role="form" class="add_user" method="post" action="<?= base_url(); ?>users/password/<?= $this->uri->segment(3); ?>">
            <div class="alert alert-danger <?= ((isset($error))?'show':'hidden'); ?>"><?= $error; ?></div>
            <div class="alert alert-success <?= ((isset($success))?'show':'hidden'); ?>"><?= $success ?></div>
                  <div class="form-group">
                        <label for="password">New Password*</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Ievadi New Password" required />
                  </div>
                  <div class="form-group" id="r_p">
                        <label for="rep_password">Rep. Password*</label>
                        <input type="password" class="form-control" oninput="check(this)" name="rep_password" id="rep_password" placeholder="Ievadi Rep. Password" required />
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