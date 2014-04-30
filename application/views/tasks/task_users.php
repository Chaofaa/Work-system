    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="table-responsive">
          <form class="add_user" role="form" method="post" action="<?= base_url(); ?>tasks/open/<?= $this->uri->segment(3); ?>">
              <? if(isset($error)){ ?>
                <div class="alert alert-danger"><?= $error; ?></div>
              <? } ?>
              <? if(isset($success)){ ?>  
                    <div class="alert alert-success"><?= $success ?></div>
              <? } ?>
              <div class="form-group"><label>Status</label>
                <? if($user->id == $main_user->id){ ?>
                  <select name="status" class="form-control">
                  <? foreach($status as $status_row){ ?>
                      <option value="<?= $status_row->id; ?>" <?= (($status_row->id == $task->status_id)?'selected="selected"':'') ?>><?= $status_row->name; ?></option>
                  <? } ?>
                  </select>
                <? }else{ ?>
                  <div class="well well-sm"><?= $task->status_name; ?></div>
                <? } ?>      
              </div>
              <div class="form-group">
                <label for="termins">Termiņš</label>
                <div class="well well-sm"><?= $this->main->Date($task->termins); ?></div>
              </div>
              <div class="form-group">
                <label for="prioritate">Prioritate</label>
                <div class="well well-sm"><?= $task->pr_name; ?></div>
              </div>
              <div class="form-group">
                <label>Galvenais Darbinieks</label>
                <div class="well well-sm">
                  <? if($main_user){ ?>
                    <?= $main_user->first_name; ?>&nbsp;<?= $main_user->last_name; ?>
                  <? }else{ ?>
                    Nāv izvelets gālv. darbinieks
                  <? } ?>
                </div>
              </div> 
              <div class="form-group">
                <label>Darbinieki</label>
                  <div class="well well-sm">
                  <? if(isset($task_users)){ ?>
                    <? foreach($users as $users_row){ ?>
                      <? if(in_array($users_row->id, $task_users)){ ?>
                        <? $users_number--; ?>
                        <?= $users_row->first_name ?>&nbsp;<?= $users_row->last_name; ?><?= (($users_number > 0)?',':''); ?>
                      <? } ?>  
                    <? } ?>
                  <? }else{ ?>
                    Nav pievienots Lietotajs
                  <? } ?>
                  </div>
              </div> 
              <div class="form-group">
                <label for="sadala">Sadaļa</label>
                <div class="well well-sm"><?= $task->sadala_name; ?></div> 
              </div>
              <div class="form-group">
                <label for="klients">Klients</label>
                <div class="well well-sm"><?= $task->clients_name; ?></div>
              </div>
              <div class="form-group">
                <label for="lieta">Lieta</label>
                <div class="well well-sm"><?= $task->lieta_name; ?></div>
              </div>
              <div class="form-group">
                <label for="uzdevums">Uzdevums</label>
                <div class="well well-sm"><?= $task->uzdevums; ?></div>
              </div>
              <div class="form-group">
                <label for="uzdevums">Izpildes gaita</label>
                <? if($user->id == $main_user->id){ ?>
                  <textarea id="editor" name="izpildes_gaita"><?= $task->izpildes_gaita; ?></textarea>
                <? }else{ ?>
                  <div class="well well-sm"><?= $task->izpildes_gaita; ?></div>
                <? } ?>
              </div>
              <? if($user->id == $main_user->id){ ?>
              <div class="form-group">
                <button type="submit" class="btn btn-default">Saglabat</button>
              </div>
              <? } ?>  
            </form>    
      </div>
    </div>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
  </div>
</div>