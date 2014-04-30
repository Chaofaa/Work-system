    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
      	<a href="<?= base_url(); ?>tasks" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Atpakaļ</span></a>
        <a href="<?= base_url(); ?>tasks/change/<?= $this->uri->segment(3); ?>" class="link-button-left btn btn-default">Rediģet uzdevums</a>
        <a href="<?= base_url(); ?>tasks/delete/<?= $this->uri->segment(3); ?>" class="link-button-left btn btn-default">Dzest uzdevums</a>
      </div>
      <div class="table-responsive">
      	<div class="add_user">
          <div class="form-group">
            <label>Nosaukums</label>
            <div class="well well-sm"><?= $task->name; ?></div>
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
              <? if($task_users){ ?>
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
            <div class="well well-sm"><?= $task->izpildes_gaita; ?></div>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <div class="well well-sm"><?= $task->status_name; ?></div>
          </div>
          <div class="form-group">
            <label for="prioritate">Prioritate</label>
            <div class="well well-sm"><?= $task->pr_name; ?></div>
          </div>
          <div class="form-group">
            <label for="privats">Privats</label>
              <? if($task->privats == 'Yes'){ ?><div class="well well-sm">Yes</div><? } ?>
              <? if($task->privats == 'No'){ ?><div class="well well-sm">No</div><? } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="termins">Termiņš</label>
            <div class="well well-sm"><?= (($task->termins)?$this->main->Date($task->termins):''); ?></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>