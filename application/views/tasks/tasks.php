    <div class="main">
      <h1><?= $page['title']; ?></h1>
      <div class="row"> 
        <a class="btn btn-default link-button-left" href="<?= base_url(); ?>tasks/add" role="button">Uzdevumu pievienošana</a>
      </div>
      <div class="row">
        <form action="<?= base_url(); ?>tasks/filter" class="form-inline left-margin" method="post" >
            <div class="form-group">
                <select name="status" class="form-control">
                    <option value="0">Status</option>
                    <? foreach($filter['status'] as $status){ ?>
                    <option value="<?= $status->id; ?>" <?= (($filter_data['status'] == $status->id)?'selected="selected"':''); ?> ><?= $status->name; ?></option>
                    <? } ?>
                </select>
                <select name="prioritate" class="form-control">
                    <option value="0">Prioritate</option>
                    <? foreach($filter['prioritate'] as $prioritate) { ?>
                    <option value="<?= $prioritate->id; ?>" <?= (($filter_data['prioritate'] == $prioritate->id)?'selected="selected"':'') ?> ><?= $prioritate->name; ?></option>
                    <? } ?>
                </select>
                <select name="lieta" class="form-control">
                    <option value="0">Lieta</option>
                    <? foreach($filter['lieta'] as $lieta){ ?>
                    <option value="<?= $lieta->id; ?>" <?= (($filter_data['lieta'] == $lieta->id)?'selected="selected"':'') ?> ><?= $lieta->name; ?></option>
                    <? } ?>
                </select>
                <select name="klients" class="form-control">
                    <option value="0">Klients</option>
                    <? foreach($filter['clients'] as $clients){ ?>
                    <option value="<?= $clients->id; ?>" <?= (($filter_data['klients'] == $clients->id)?'selected="selected"':'') ?> ><?= $clients->name; ?></option>
                    <? } ?>
                </select>
                <select name="sadala" class="form-control">
                    <option value="0">Sadaļa</option>
                    <? foreach($filter['sadala'] as $sadala){ ?>
                    <option value="<?= $sadala->id; ?>" <?= (($filter_data['sadala'] == $sadala->id)?'selected="selected"':'') ?> ><?= $sadala->name; ?></option>
                    <? } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="no-datums" placeholder="Pievienošanas datums" class="form-control date-time-picker" value="<?= (($filter_data['no-datums'])?$filter_data['no-datums']:''); ?>" />
                <input type="text" name="lidz-datums" placeholder="Termiņš" class="form-control date-time-picker" value="<?= (($filter_data['lidz-datums'])?$filter_data['lidz-datums']:''); ?>" />
                <input type="submit" class="btn btn-default" value="Filtret" />
                <a href="<?= base_url() ?>tasks/filter_reset" class="btn btn-default link-button-left">Reset filter</a>
            </div>
        </form>
      </div>	
      <div class="table-responsive">
        <table class="table table-hover tablesorter table-bordered">
        	<thead>
        		<tr>
        			<th>Nr.</th>
        			<th>Nosaukums</th>
                    <th>Galv. Darbinieks</th>
        			<th>Darbinieks(-ki)</th>
        			<th>Sadaļa</th>
        			<th>Klients</th>
        			<th>Lieta</th>
        			<th>Status</th>
        			<th>Prioritate</th>
        			<th>Termiņs</th>
                    <th>Pievienošanas datums</th>
                    <td></td>
        		</tr>
        	</thead>
        	<tbody>
                <? if(!empty($tasks)){ ?>
                    <? $i = 0; ?>
            		<? foreach($tasks as $row){ ?>
            		<tr class="select" rel="<?= $row->id; ?>">
            			<td><?= ++$i; ?></td>
            			<td><?= $row->name; ?></td>
                        <td>
                            <span class="label label-default">
                                <?= $this->tasks_model->task_users($row->id, 2)->first_name; ?>
                                &nbsp;
                                <?= $this->tasks_model->task_users($row->id, 2)->last_name; ?>
                            </span>
                        </td>
            			<td>
                        <?
                        if($this->tasks_model->task_users($row->id)){ 
                            foreach($this->tasks_model->task_users($row->id) as $k=>$v){
                                echo '<span class="label label-default">'.$v['first_name'].' '.$v['last_name'].'</span><br />';   
                            }
                        }else{
                            echo 'Nav pievienots lietotajs';
                        }    
                        ?>
                        </td>
                        <td><?= $row->sadala_name; ?></td>
                        <td><?= $row->clients_name; ?></td>
                        <td><?= $row->lieta_name; ?></td>
                        <td><?= $row->status_name; ?></td>
                        <td><?= $row->pr_name; ?></td>
                        <td><?= $this->main->Date($row->termins); ?></td>
                        <td><?= $this->main->Date($row->add_date); ?></td>
                                    
                        <td>
                        <a href="<?= base_url(); ?>tasks/change/<?= $row->id; ?>" class="tip_link" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Rediģet"><span class="glyphicon glyphicon-pencil" ></span></a>
                            <a href="javascript:;" class="tip_link delete" onclick="check('<?= base_url(); ?>tasks/delete/<?= $row->id; ?>')" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Dzest"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
            		</tr>
            		<? } ?>
                <? }else{ ?>
                    <tr>
                        <td colspan="10">Nekas nav.</td>
                    </tr>
                <? } ?>    
        	</tbody>
        </table>
      </div>
    </div>
    <script>
        $(document).ready(function()
        {
            $(".tablesorter").tablesorter(); 
        });

        function check(data) {
            var answer = confirm('Tiešam dziest šo ierakstu?');
            if (answer) {
                window.location = data;
            } 
        }

        $('.date-time-picker').datepicker(
            {
               dateFormat: 'yy-mm-dd',
               firstDay: 1
            }
        );         

        $('.tip_link').tooltip('hide');

        $(".select").on('dblclick', function() {
            var id = $(this).attr('rel');

            if (id)
                location.href = 'tasks/view/' + id + '/';
        });
    </script>

  </div>
</div>