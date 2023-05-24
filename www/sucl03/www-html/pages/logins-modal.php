<?php
// crossmile @ LXSX file:www-html/pages/logins-modal.php
?>
	<!-- Modal showing logins -->
	<div id="modal-logins" class="modal fade" tabindex="-1" aria-labelledby="modal-logins-title" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal-logins-title">Poslední přihlášení</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-sm table-condensed table-striped table-hover">
									<thead>
										<tr>
											<th>Datum a čas</th>
											<th>Typ</th>
											<th>Uživatel</th>
											<th>Hostitel</th>
											<!-- <th>IP : Port</th> -->
											<th>Země</th>
										</tr>
									</thead>
									<tbody id="modal-logins-table-body"></tbody>
								</table>
							</div>
						</div>
					</div><!-- /.row -->
				</div>
				<!--
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
				</div>
				-->
			</div>
		</div>
	</div>