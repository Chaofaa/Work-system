
        <div class="main">
          <h1><?= $page['title']; ?></h1>
          <div class="table-responsive">
              <div class="col-xs-6">
                  <h3><a href="<?= base_url(); ?>tasks/all">Uzdevumi</a></h3>
                    <div class="list-group">
                    <? if(!empty($task_for_me)){ ?>
                      <? foreach($task_for_me as $task_for_me_row){ ?>	
                          <a href="<?= base_url(); ?>tasks/open/<?= $task_for_me_row->id; ?>" class="list-group-item">
                              <span class="badge">Termiņš: <?= $this->main->Date($task_for_me_row->termins); ?></span>
                              <span class="badge"><?= $task_for_me_row->clients_name; ?></span>
                              <span class="badge"><?= $task_for_me_row->sadala_name; ?></span>
                            <h4 class="list-group-item-heading"><?= $task_for_me_row->name; ?></h4>
                            <p class="list-group-item-text"><?= $task_for_me_row->uzdevums; ?></p>
                          </a>
                      <? } ?>
                    <? }else{ ?>
                      <div class="list-group-item">
                        <b>Nekas nav.</b>
                      </div>
                    <? } ?> 
                    </div>
              </div>
              <div class="col-xs-6">
                  <h3><a href="<?= base_url(); ?>atskaite">Laiku uzskaite</a></h3>
                    <div class="list-group">
                    <? if(!empty($atskaite_for_me)){ ?>
                      <? foreach($atskaite_for_me as $atskaite_for_me_row){ ?>	
                          <a href="<?= base_url(); ?>atskaite/update/<?= $atskaite_for_me_row->id; ?>" class="list-group-item">
                              <span class="badge">Datums: <?= $this->main->Date($atskaite_for_me_row->datums); ?></span>
                              <span class="badge"><?= $atskaite_for_me_row->sadala_name; ?></span>
                              <span class="badge"><?= $atskaite_for_me_row->clients_name; ?></span>
                            <h4 class="list-group-item-heading"><?= $atskaite_for_me_row->lieta_name; ?></h4>
                            <p class="list-group-item-text">
                              <b>Apraksts: </b><?= $atskaite_for_me_row->apraksts; ?><br />
                              <b>Piezimes: </b><?= $atskaite_for_me_row->piezimes; ?><br />
                              <b>Laiks: </b><?= $atskaite_for_me_row->time; ?> h<br />
                              <b>Papildus izmaksas: </b><?= $atskaite_for_me_row->papildus_izmaksas; ?> Eur<br />
                            </p>
                          </a>
                      <? } ?>
                    <? }else{ ?>
                      <div class="list-group-item">
                        <b>Nekas nav.</b>
                      </div>
                    <? } ?>  
                    </div>
              </div>
          </div>
        </div>


      </div>
    </div>