    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
      	<a href="<?= base_url(); ?>atskaite" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Atpakaļ</span></a>
      </div>
      <div class="table-responsive">
      	<form role="form" class="add_user" method="post" action="<?= base_url(); ?>atskaite/add">
            <? if(isset($error)){ ?>
              <div class="alert alert-danger"><?= $error; ?></div>
            <? } ?>
            <? if(isset($success)){ ?>  
      		  <div class="alert alert-success"><?= $success ?></div>
            <? } ?>
          <div class="form-group">
            <label>Datums*</label>
            <input type="text" name="datums" class="form-control date-time-picker" placeholder="Ievadi Datums" value="<?= (($this->input->post('datums'))?$this->input->post('datums'):$datums->date); ?>" require />
          </div>  
          <div class="form-group">
            <label>Darbinieks*</label>
            <? if($this->ion_auth->is_admin()){ ?>
            <select name="darbinieks" class="form-control" required>
                    <option valuue="0">Izvelies Darbinieku</option>
                    <? foreach($users as $u){ ?>
                    <option value="<?= $u->id; ?>" <?= (($this->input->post('darbinieks') == $u->id)?'selected="selected"':''); ?> ><?= $u->first_name ?>&nbsp;<?= $u->last_name; ?></option>
                    <? } ?>
                </select>
            <? }else{ ?>
                <div class="well well-sm"><?= $user->first_name; ?>&nbsp;<?= $user->last_name; ?></div>
            <? } ?>
          </div>
          <div class="form-group">
              <label>Sadaļa*</label>
              <select name="sadala" class="form-control" require>
                  <option value="0">Izvelies Sadaļu</option>
                  <? foreach($sadala as $sa){ ?>
                  <option value="<?= $sa->id ?>" <?= (($this->input->post('sadala') == $sa->id)?'selected="selected"':''); ?> ><?= $sa->name; ?></option>
                  <? } ?>
              </select>
          </div>
          <div class="form-group">
              <label>Klients*</label>
              <select name="klients" class="form-control" require>
                  <option value="0">Izvelies Klientu</option>
                  <? foreach($klients as $kl){ ?>
                  <option value="<?= $kl->id; ?>" <?= (($this->input->post('klients') == $kl->id)?'selected="selected"':''); ?>><?= $kl->name; ?></option>
                  <? } ?>
              </select>
          </div>
          <div class="form-group">
              <label>Lieta*</label>
              <select name="lieta" class="form-control" require>
                  <option value="0">Izvelies Lietu</option>
                  <? foreach($lieta as $li){ ?>
                  <option value="<?= $li->id ?>" <?= (($this->input->post('lieta') == $li->id)?'selected="selected"':''); ?>><?= $li->name ?></option>
                  <? } ?>
              </select>
          </div>
          <div class="form-group">
              <label>Padarītā darba apraksts</label>
              <textarea class="form-control" name="apraksts"><?= $this->input->post('apraksts'); ?></textarea>
          </div>
          <div class="form-group">
              <label>Izpildes laiks*</label>
              <input type="text" name="time" class="form-control" placeholder="Ievadi izpildes laiku" value="<?= $this->input->post('time'); ?>" required />
          </div>
          <div class="form-group">
              <label>Piezīmes</label>
              <textarea class="form-control" name="piezimes"><?= $this->input->post('piezimes'); ?></textarea>
          </div>
          <div class="form-group">
              <label>Papīldus izmaksas EUR</label>
              <input type="text" name="izmaksas" class="form-control" value="<?= $this->input->post('izmaksas'); ?>" placeholder="Ievadi papildus izmaksas" />
          </div>
      
          <button type="submit" class="btn btn-default">Saglabat</button>
      	</form>
      </div>
    </div>
    <script>
      $('#users').multiSelect({ keepOrder: true });

      $('.date-time-picker').datepicker(
            {
               dateFormat: 'yy-mm-dd',
               firstDay: 1
            }
       );

      CKEDITOR.replace( 'editor' );
      CKEDITOR.replace( 'editor1' );
    </script>  
  </div>
</div>