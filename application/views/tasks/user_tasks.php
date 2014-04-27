        <div class="main">
          <h1><?= $page['title']; ?></h1>
          <form class="form-inline" method="post" action="<?= base_url(); ?>tasks/u_filter">
              <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" onchange="form.submit()">
                      <option value="0">Visi</option>
                      <? foreach($status as $st){ ?>
                      <option value="<?= $st->id; ?>" <?= (($filter['status'] == $st->id)?'selected="selected"':''); ?> ><?= $st->name; ?></option>
                      <? } ?>
                  </select>
              </div>
          </form>
          <div class="table-responsive">
              
                  <h3><a href=""></a></h3>
                    <div class="list-group">
                    <? if($tasks){ ?>    
                      <? foreach($tasks as $row){ ?>	
                          <a href="<?= base_url(); ?>tasks/open/<?= $row->id; ?>" class="list-group-item">
                              <span class="badge"><?= $row->status_name; ?></span>
                              <span class="badge"><?= $this->main->Date($row->termins); ?></span>
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


      </div>
    </div>