        <div class="main">
          <h1><?= $page['title']; ?></h1>
          <form class="form-inline" method="post" action="<?= base_url(); ?>tasks/u_filter">
              <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                      <option value="0">Visi</option>
                      <? foreach($filter['status'] as $st){ ?>
                      <option value="<?= $st->id; ?>" <?= (($filter_data['status'] == $st->id)?'selected="selected"':''); ?> ><?= $st->name; ?></option>
                      <? } ?>
                  </select>
              </div>
              <div class="form-group">
                  <label>Klienti</label>
                  <select class="form-control" name="clients">
                      <option value="0">Visi</option>
                      <? foreach($filter['clients'] as $kl){ ?>
                      <option value="<?= $kl->id; ?>" <?= (($filter_data['clients'] == $kl->id)?'selected="selected"':'') ?>><?= $kl->name; ?></option>
                      <? } ?>
                  </select>  
              </div>
              <div class="form-group">
                  <label>Sadaļa</label>
                  <select class="form-control" name="sadala">
                      <option value="0">Visi</option>
                      <? foreach($filter['sadala'] as $sa){ ?>
                      <option value="<?= $sa->id; ?>" <?= (($filter_data['sadala'] == $sa->id)?'selected="selected"':''); ?>><?= $sa->name; ?></option>
                      <? } ?>
                  </select>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-default" value="Filtret" />
                <a href="<?= base_url() ?>tasks/filter_reset/all" class="btn btn-default link-button-left">Reset filter</a>
              </div>
          </form>
          <div class="table-responsive">
              
                  <h3><a href=""></a></h3>
                    <div class="list-group">
                    <? if($tasks){ ?>    
                      <? foreach($tasks as $row){ ?>	
                          <a href="<?= base_url(); ?>tasks/open/<?= $row->id; ?>" class="list-group-item">
                              <span class="badge">Datums: <?= $this->main->Date($row->add_date); ?></span>
                              <span class="badge"><?= $row->status_name; ?></span>
                              <span class="badge">Termiņš: <?= $this->main->Date($row->termins); ?></span>
                              <span class="badge"><?= $row->clients_name; ?></span>
                              <span class="badge"><?= $row->sadala_name; ?></span>
                            <h4 class="list-group-item-heading"><?= $row->name; ?></h4>
                            <p><b>Uzdevums: </b><?= $row->uzdevums; ?></p>
                            <? if($row->izpildes_gaita){ ?><p><b>Izpildes gaita: </b><?= $row->izpildes_gaita; ?></p><? } ?>
                          </a>
                          <? } ?>
                    <? }else{ ?>
                        <div class="list-group-item" >
                            <h3>Nekas nav.</h3>
                        </div>
                    <? } ?>
                    </div>
                  
          </div>
        </div>
        <script>
        $('.date-picker').datepicker(
              {
                 dateFormat: 'yy-mm-dd',
                 firstDay: 1
              }
          );  
        </script>
      </div>
    </div>