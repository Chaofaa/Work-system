    <div class="main">
      <h1><?= $page['title']; ?></h1>
      <div class="row"> 
		<a class="btn btn-default link-button-left" href="<?= base_url(); ?>users/add" role="button">Pievienot Lietotaju</a>
      </div>	
      <div class="table-responsive">
      <?// print_r($users); ?>
        <table class="table table-hover tablesorter table-bordered">
        	<thead>
        		<tr>
        			<th>Nr.</th>
        			<th>Status</th>
        			<th>Username</th>
        			<th>Email</th>
        			<th>Vards</th>
        			<th>Uzvards</th>
        			<th>Talrunis</th>
        			<th>Group</th>
        			<td></td>
        		</tr>
        	</thead>
        	<tbody>
                <? if(!empty($users)){ ?>
                	<? $k=0; ?>
                	<? foreach($users as $v){ ?>
                        <? $group = $this->ion_auth->get_users_groups($v->id)->row(); ?>
                		<tr class="select" rel="<?= $v->id; ?>">
                			<td><?= ++$k; ?></td>
                			<td><?= (($v->active == '1')?'Activs':'Ne aktivs'); ?></td>
                			<td><?= $v->username; ?></td>
                			<td><?= $v->email; ?></td>
                			<td><?= $v->first_name; ?></td>
                			<td><?= $v->last_name; ?></td>
                			<td><?= (($v->phone)?$v->phone:''); ?></td>
                			<td><?= $group->name; ?></td>
                			<td>
                                <a href="<?= base_url(); ?>users/password/<?= $v->id; ?>" class="tip_link" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Nomainit password"><span class="glyphicon glyphicon-lock" ></span></a>
                				<a href="<?= base_url(); ?>users/change/<?= $v->id; ?>" class="tip_link" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Rediģet"><span class="glyphicon glyphicon-pencil" ></span></a>
                				<a href="javascript:;" class="tip_link delete" onclick="check('<?= base_url(); ?>users/delete/<?= $v->id; ?>')" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Dzest"><span class="glyphicon glyphicon-trash"></span></a>
                			</td>
                		</tr>  		
                	<? } ?>
                <? }else{ ?>
                    <tr>
                        <td colspan="9">Nekas nav.</td>
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

        $('.tip_link').tooltip('hide');

        $(".select").on('dblclick', function() {
            var id = $(this).attr('rel');

            if (id)
                location.href = 'users/change/' + id + '/';
        });
    </script>
  </div>
</div>