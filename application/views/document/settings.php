    <div class="main">
      <h1><?= $page['title']; ?></h1>
      <div class="table-responsive"> 
        <div class="row">
          <div class="col-xs-6">
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">Status</div>
              <div class="panel-body">
                <button class="btn btn-default" data-toggle="modal" data-target="#status">
                  Pievienot jaunu Statusu
                </button>
              </div>

              <!-- List group -->
              <ul class="list-group">
                <? foreach($status as $st){ ?>
                <li class="list-group-item">
                  <?= $st->name; ?>
                  <a href="javascript:;" onclick="check('<?= base_url(); ?>settings/delete_status/<?= $st->id; ?>')" class="tip_link delete" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                </li>
                <? } ?>
              </ul>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">Prioritate</div>
              <div class="panel-body">
                <button class="btn btn-default" data-toggle="modal" data-target="#prioritate">
                  Pievienot jaunu Prioritate
                </button>
              </div>

              <!-- List group -->
              <ul class="list-group">
                <? foreach($prioritate as $pr){ ?>
                <li class="list-group-item">
                  <?= $pr->name; ?>
                  <a href="javascript:;" onclick="check('<?= base_url(); ?>settings/delete_prioritate/<?= $pr->id ?>')" class="tip_link delete" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                </li>
                <? } ?>
              </ul>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">Sadaļa</div>
              <div class="panel-body">
                <button class="btn btn-default" data-toggle="modal" data-target="#sadala">
                  Pievienot jaunu Sadaļu
                </button>
              </div>

              <!-- List group -->
              <ul class="list-group">
                <? foreach($sadala as $sa){ ?>
                <li class="list-group-item">
                  <?= $sa->name; ?>
                  <a href="javascript:;" onclick="check('<?= base_url(); ?>settings/delete_sadala/<?= $sa->id ?>')" class="tip_link delete" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                </li>
                <? } ?>
              </ul>
            </div>
          </div>

        </div>

      </div>
    </div>

    <div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Pievienot status</h4>
          </div>
          <div class="modal-body">
            <form method="post" id="status_form" action="<? base_url(); ?>settings/add_status">
              <div class="form-group">
                <label>Nosaukums*</label>
                <input type="text" name="name" class="form-control" placeholder="Ievadi Nosaukums" required />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Aizvert</button>
            <button type="button" id="status_save" class="btn btn-primary">Saglabat</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="prioritate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Pievienot prioritate</h4>
          </div>
          <div class="modal-body">
            <form method="post" id="prioritate_form" action="<?= base_url() ?>settings/add_prioritate">
              <div class="form-group">
                <label>Nosaukums*</label>
                <input type="text" name="name" class="form-control" placeholder="Ievadi Nosaukums" required />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Aizvert</button>
            <button type="button" id="prioritate_save" class="btn btn-primary">Saglabat</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="sadala" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Pievienot Sadaļu</h4>
          </div>
          <div class="modal-body">
            <form method="post" id="sadala_form" action="<?= base_url() ?>settings/add_sadala">
              <div class="form-group">
                <label>Nosaukums*</label>
                <input type="text" name="name" class="form-control" placeholder="Ievadi Nosaukums" required />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Aizvert</button>
            <button type="button" id="sadala_save" class="btn btn-primary">Saglabat</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      $("#prioritate_save").click(function(){
        $("#prioritate_form").submit();
      });

      $("#status_save").click(function(){
        $("#status_form").submit();
      });

      $("#sadala_save").click(function(){
        $("#sadala_form").submit();
      });

      function check(data) {
          var answer = confirm('Tiešam dziest šo ierakstu?');
          if (answer) {
              window.location = data;
          } 
      }         

      $('.tip_link').tooltip('hide');
    </script>
  </div>
</div>