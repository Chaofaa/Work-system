    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
      	<a href="<?= base_url(); ?>tasks" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Atpakaļ</span></a>
      </div>
      <div class="table-responsive">
      	<form role="form" class="add_user" method="post" action="<?= base_url(); ?>tasks/change/<?= $this->uri->segment(3); ?>">
            <? if(isset($error)){ ?>
              <div class="alert alert-danger"><?= $error; ?></div>
            <? } ?>
            <? if(isset($success)){ ?>  
      		  <div class="alert alert-success"><?= $success ?></div>
            <? } ?>
          <div class="form-group">
            <label>Nosaukums*</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Ievadi Nosaukums" value="<?= $task->name; ?>" require />
          </div>
          <div class="form-group">
            <label>Galvenais Darbinieks*</label>
            <select name="main_user" class="form-control" require>
              <? foreach($users as $v){ ?>
              <option value="<?= $v->id; ?>" <?= ((($main_user) && $main_user->user_id == $v->id)?'selected="selected"':''); ?> ><?= $v->first_name; ?>&nbsp;<?= $v->last_name; ?></option>
              <? } ?>
            </select>
          </div>  
          <div class="form-group">
            <label>Darbinieki*</label>
            <select id="users" name="users[]" multiple="multiple" data-placeholder="Select Users" require>
              <? foreach($users as $users_row){ ?>
              <option value="<?= $users_row->id; ?>" <?= ((isset($task_users) && in_array($users_row->id, $task_users))?'selected="selected"':''); ?> ><?= $users_row->first_name ?>&nbsp;<?= $users_row->last_name; ?></option>
              <? } ?>
            </select>
          </div>  
          <div class="form-group">
      			<label for="sadala">Sadaļa*</label>
      			<select name="sadala" id="sadala" class="form-control" require>
              <option>Izvelies Sadaļu</option>
              <? foreach($sadala as $sadala_row){ ?>
              <option value="<?= $sadala_row->id; ?>" <?= (($task->sadala == $sadala_row->id)?'selected="selected"':''); ?> ><?= $sadala_row->name; ?></option>
              <? } ?>   
            </select>
      		</div>
          <div class="form-group">
            <label for="klients">Klients*</label>
            <select name="klients" id="klients" class="form-control" require>
              <option>Izvelies Klientu</option>
              <? foreach($clients as $clients_row){ ?>
              <option value="<?= $clients_row->id; ?>" <?= (($task->klients == $clients_row->id)?'selected="selected"':''); ?> ><?= $clients_row->name; ?></option>
              <? } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="lieta">Lieta*</label>
            <select name="lieta" id="lieta" class="form-control" require>
              <option>Izvelies Lietu</option>
              <? foreach($lieta as $lieta_row){ ?>
              <option value="<?= $lieta_row->id; ?>" <?= (($task->lieta == $lieta_row->id)?'selected="selected"':''); ?>><?= $lieta_row->name; ?></option>
              <? } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="uzdevums">Uzdevums*</label>
            <textarea id="editor" name="uzdevums" require><?= (($task->uzdevums)?$task->uzdevums:''); ?></textarea>
          </div>
          <div class="form-group">
            <label for="status">Status*</label>
            <select name="status" id="status" class="form-control" require>
              <option>Izvelies Status</option>
              <? foreach($status as $status_row){ ?>
              <option value="<?= $status_row->id; ?>" <?= (($task->status == $status_row->id)?'selected="selected"':''); ?>><?= $status_row->name; ?></option>
              <? } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="prioritate">Prioritate*</label>
            <select name="prioritate" id="prioritate" class="form-control" require>
              <option>Izvelies Prioritate</option>
              <? foreach($prioritate as $prioritate_row){ ?>
              <option value="<?= $prioritate_row->id; ?>" <?= (($task->prioritate == $prioritate_row->id)?'selected="selected"':''); ?> ><?= $prioritate_row->name; ?></option>
              <? } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="privats">Privats*</label>
            <select name="privats" id="privats" class="form-control" require>
              <option>Izvelies Privats</option>
              <option value="Yes" <?= (($task->privats == 'Yes')?'selected="selected"':''); ?>>Yes</option>
              <option value="No" <?= (($task->privats == 'No')?'selected="selected"':''); ?>>No</option>
            </select>
          </div>
            <div class="form-group">
                    <label for="termins">Termiņš</label>
                    <input type="text" class="form-control date-time-picker" name="termins" id="termins" placeholder="Izvelies Termiņš" value="<?= (($task->termins)?$task->termins:''); ?>" />
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