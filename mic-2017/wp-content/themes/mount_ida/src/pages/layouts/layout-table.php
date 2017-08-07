<?php

		$table_title                        = get_sub_field('table_title');
		$table_caption                      = get_sub_field('table_caption');
		$table 															= get_sub_field('table');
?>

<script>


$(document).ready(function(){
		$('#table').DataTable({
				"searching": false,
				"ordering": false,
				"pagingType": "full_numbers",
				"info": false,
				"pageLength": 10,
				"responsive": true,
				"lengthMenu": [ 10, 25, 50, 75, 100 ],
				"columnDefs": [
						{ "responsivePriority": 1, "targets": 0 },
						{ "responsivePriority": 2, "targets": -1 }
				],
				"dom": 't<"table-nav"lp>',
				"language": {
					"paginate": {
						"previous": "Prev"
					},
					"lengthMenu": "Show _MENU_ "
				}
		});
});
</script>

<div class="page-content">
	<section class="pb-section table-section">
	    <div class="container">

	<?php

			if ( $table ) {

				echo '<div class="facts-table">';
				echo '<div class="title">'. $table_title .'</div>';
				echo '<table id="table" class="table">';

				if ($table_caption) {
					echo '<caption>' . $table_caption . '</caption>';
				}

						if ( $table['header'] ) {

								echo '<thead>';

										echo '<tr class="tableRow header">';

												foreach ( $table['header'] as $th ) {

														echo '<th class="tableCell">';
																echo $th['c'];
														echo '</th>';
												}

										echo '</tr>';

								echo '</thead>';
						}

						echo '<tbody>';

								foreach ( $table['body'] as $tr ) {

										echo '<tr class="tableRow">';

												foreach ( $tr as $td ) {

														echo '<td class="tableCell">';
																echo $td['c'];
														echo '</td>';
												}

										echo '</tr>';
								}

						echo '</tbody>';

				echo '</table>';
				echo '</div>';
			}

			?>

		</div>
	</section>
</div>
