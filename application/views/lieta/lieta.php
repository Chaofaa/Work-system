    <div class="main">
      <h1><?= $page['title']; ?></h1>
      <div class="row"> 
		<a class="btn btn-default link-button-left" href="<?= base_url(); ?>lieta/add" role="button">Pievienot Lietu</a>
      </div>	
      <div class="table-responsive">
      	<table class="table table-hover tablesorter table-bordered">
      		<thead>
      			<th>Nr.</th>
      			<th>Nosaukums</th>
      			<th>Info</th>
      			<td></td>
      		</thead>
      		<tbody>
            <? if(!empty($lieta)){ ?>
        			<? $k=0; ?>
        			<? foreach($lieta as $row){ ?>
        			<tr class="select" rel="<?= $row->id; ?>">
        				<td><?= ++$k; ?></td>
        				<td><?= $row->name; ?></td>
        				<td><?= $row->info; ?></td>
        				<td>
          				<a href="<?= base_url(); ?>lieta/change/<?= $row->id; ?>" class="tip_link" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Edit"><span class="glyphicon glyphicon-pencil" ></span></a>
          				<a href="javascript:;" class="tip_link delete" onclick="check('<?= base_url(); ?>lieta/delete/<?= $row->id; ?>')" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
          			</td>
        			</tr>
        			<? } ?>
            <? }else{ ?>
              <tr>
                <td colspan="4">Nekas nav pievinots.</td>
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
                location.href = 'lieta/change/' + id + '/';
        });
    </script>

  </div>
</div>