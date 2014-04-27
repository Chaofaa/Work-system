    <div class="main">
      <h1><?= $page['title']; ?></h1>
      <div class="row"> 
		<a class="btn btn-default link-button-left" href="<?= base_url(); ?>clients/add" role="button">Pievienot Clientu</a>
      </div>	
      <div class="table-responsive">
        <table class="table table-hover tablesorter table-bordered">
        	<thead>
        		<tr>
        			<th>Nr.</th>
        			<th>Clients</th>
        			<th>Reģ. nr.</th>
        			<th>Adress</th>
        			<th>Talrunis</th>
        			<th>Kontakta persona</th>
        			<th>Email</th>
        			<td></td>
        		</tr>
        	</thead>
        	<tbody>
                <? if(!empty($clients)){ ?>
            		<? $k=0; ?>
            		<? foreach($clients as $row){ ?>
            		<tr class="select" rel="<?= $row->id; ?>">
            			<td><?= ++$k; ?></td>
            			<td><?= $row->name; ?></td>
            			<td><?= $row->reg_nr; ?></td>
            			<td><?= $row->adress; ?></td>
            			<td><?= $row->phone; ?></td>
            			<td><?= $row->person; ?></td>
            			<td><?= $row->email; ?></td>
            			<td>
            				<a href="<?= base_url(); ?>clients/change/<?= $row->id; ?>" class="tip_link" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Rediģet"><span class="glyphicon glyphicon-pencil" ></span></a>
            				<a href="javascript:;" class="tip_link delete" onclick="check('<?= base_url(); ?>clients/delete/<?= $row->id; ?>')" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Dzest"><span class="glyphicon glyphicon-trash"></span></a>
            			</td>
            		</tr>
            		<? } ?>
                <? }else{ ?>
                    <tr>
                        <td colspan="8">Nekas nav pievienots.</td>
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
                location.href = 'clients/change/' + id + '/';
        });
    </script>

  </div>
</div>