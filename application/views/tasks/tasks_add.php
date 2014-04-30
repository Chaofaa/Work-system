    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
      	<a href="<?= base_url(); ?>tasks" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Atpakaļ</span></a>
      </div>
      <div class="table-responsive">
      	<form role="form" class="add_user" method="post" action="<?= base_url(); ?>tasks/add">
            <div class="alert alert-danger <?= ((isset($error))?'show':'hidden'); ?>"><?= $error; ?></div>
      		  <div class="alert alert-success <?= ((isset($success))?'show':'hidden'); ?>"><?= $success ?></div>
          <div class="form-group">
            <label>Nosaukums*</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Ievadi Nosaukums" value="<?= $this->input->post('name'); ?>" require />
          </div>
          <div class="form-group">
            <label>Galvenais Darbinieks*</label>
            <select name="main_user" class="form-control" require>
              <? foreach($users as $v){ ?>
              <option value="<?= $v->id; ?>" <?= (($this->input->post('main_user') == $v->id)?'selected="selected"':''); ?>><?= $v->first_name; ?>&nbsp;<?= $v->last_name; ?></option>
              <? } ?>
            </select>
          </div>  
          <div class="form-group">
            <label>Darbinieki*</label>
            <select id="users" name="users[]" multiple="multiple" data-placeholder="Select Users" require>
              <? foreach($users as $users_row){ ?>
              <option value="<?= $users_row->id; ?>" ><?= $users_row->first_name ?>&nbsp;<?= $users_row->last_name; ?></option>
              <? } ?>
            </select>
          </div>  
          <div class="form-group">
      			<label for="sadala">Sadaļa*</label>
      			<select name="sadala" id="sadala" class="form-control" require>
              <option>Izvelies Sadaļu</option>
              <? foreach($sadala as $sadala_row){ ?>
              <option value="<?= $sadala_row->id; ?>" <?= (($this->input->post('sadala') == $sadala_row->id)?'selected="selected"':''); ?>><?= $sadala_row->name; ?></option>
              <? } ?>   
            </select>
      		</div>
          <div class="form-group">
            <label for="klients">Klients*</label>
            <select name="klients" id="klients" class="form-control" require>
              <option>Izvelies Klientu</option>
              <? foreach($clients as $clients_row){ ?>
              <option value="<?= $clients_row->id; ?>" <?= (($this->input->post('klients') == $clients_row->id)?'selected="selected"':''); ?> ><?= $clients_row->name; ?></option>
              <? } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="lieta">Lieta*</label>
            <select name="lieta" id="lieta" class="form-control" require>
              <option>Izvelies Lietu</option>
              <? foreach($lieta as $lieta_row){ ?>
              <option value="<?= $lieta_row->id; ?>" <?= (($this->input->post('lieta') == $lieta_row->id)?'selected="selected"':''); ?> ><?= $lieta_row->name; ?></option>
              <? } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="uzdevums">Uzdevums*</label>
            <textarea id="editor" name="uzdevums" require><?= $this->input->post('uzdevums'); ?></textarea>
          </div>
          <!--<div class="form-group">
            <label for="file">file</label>
            <input type="file" name="file" id="file" />
          </div>-->
          <div class="form-group">
            <label for="status">Status*</label>
            <select name="status" id="status" class="form-control" require>
              <option>Izvelies Status</option>
              <? foreach($status as $status_row){ ?>
              <option value="<?= $status_row->id; ?>" <?= (($this->input->post('status') == $status_row->id)?'selected="selected"':''); ?> ><?= $status_row->name; ?></option>
              <? } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="prioritate">Prioritate*</label>
            <select name="prioritate" id="prioritate" class="form-control" require>
              <option>Izvelies Prioritate</option>
              <? foreach($prioritate as $prioritate_row){ ?>
              <option value="<?= $prioritate_row->id; ?>" <?= (($this->input->post('prioritate') == $prioritate_row->id)?'selected="selected"':''); ?> ><?= $prioritate_row->name; ?></option>
              <? } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="privats">Privats*</label>
            <select name="privats" id="privats" class="form-control" require>
              <option>Izvelies Privats</option>
              <option value="Yes" <?= (($this->input->post('privats') == 'Yes')?'selected="selected"':''); ?>>Yes</option>
              <option value="No" <?= (($this->input->post('privats') == 'No')?'selected="selected"':''); ?>>No</option>
            </select>
          </div>
      		<div class="form-group">
      			<label for="termins">Termiņš</label>
      			<input type="text" class="form-control date-time-picker" name="termins" id="termins" placeholder="Ievadi Termiņš" value="<?= $this->input->post('termins'); ?>" />
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
    </script>  
  </div>
</div>