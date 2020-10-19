<div class="panel-header bg-default-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Reportes</h2>
								<h5 class="text-white op-7 mb-2">Accede a la estadisticas del sistema</h5>
							</div>
							<!-- <div class="ml-md-auto py-2 py-md-0">
								<a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
								<a href="#" class="btn btn-secondary btn-round">Add Customer</a>
							</div> -->
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt-2">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Estadisticas de registros diaros</div>
									<div class="card-category">Informacion diaria de registros del sistemas</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1"></div>
											<h6 class="fw-bold mt-3 mb-0">Casos Registrados</h6>
											<input type="hidden" name="casosToday" id="casosToday" value="<?php echo $arrayStatsToday[0] ?>">
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-2"></div>
											<h6 class="fw-bold mt-3 mb-0">Ordenes Emitidas</h6>
											<input type="hidden" name="ordenToday" id="ordenToday" value="<?php echo $arrayStatsToday[1] ?>">
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3"></div>
											<h6 class="fw-bold mt-3 mb-0">Usuarios Registrados</h6>
											<input type="hidden" name="usersToday" id="usersToday" value="<?php echo $arrayStatsToday[2] ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Casos creados esta semana</div>
									<div class="row py-3">
										<div class="col-md-4 d-flex flex-column justify-content-around">
											<div>
												<h6 class="fw-bold text-uppercase text-success op-8">TOTAL FINALIZADOS</h6>
												<h3 class="fw-bold"><?php echo $totalCasesFin ?></h3>
											</div>
											<div>
												<h6 class="fw-bold text-uppercase text-danger op-8">TOTAL PENDIENTES</h6>
												<h3 class="fw-bold"><?php echo $totalCasesPen ?></h3>
											</div>
										</div>
										<div class="col-md-8">
											<div id="chart-container">
												<canvas id="totalIncomeChart"></canvas>
											</div>
										</div>
										<?php
											for ($i=0; $i < COUNT($arrayStastWeek) ; $i++) { 
												echo "<input type='hidden' class='days' name='days' value='$arrayStastWeek[$i]'>";
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Estadisticas del mes</div>
										<div class="card-tools">
											<a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
												<span class="btn-label">
													<i class="fa fa-pencil"></i>
												</span>
												Export
											</a>
											<a href="#" class="btn btn-info btn-border btn-round btn-sm">
												<span class="btn-label">
													<i class="fa fa-print"></i>
												</span>
												Print
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="chart-container" style="min-height: 375px">
										<canvas id="statisticsChart"></canvas>
									</div>
									<div id="myChartLegend"></div>
								</div>
							</div>
							<?php for ($i=0; $i < COUNT($arrayStastMonthCase) ; $i++) { 
								echo "<input type='hidden' class='mesesCaso' value='$arrayStastMonthCase[$i]'>";
								echo "<input type='hidden' class='mesesOrden' value='$arrayStastMonthOrden[$i]'>";
								echo "<input type='hidden' class='mesesUser' value='$arrayStastMonthUser[$i]'>";
							} ?>
						</div>
						<div class="col-md-4">
							<!-- <div class="card card-secondary">
								<div class="card-header">
									<div class="card-title">Daily Sales</div>
									<div class="card-category">March 25 - April 02</div>
								</div>
								<div class="card-body pb-0">
									<div class="mb-4 mt-2">
										<h1>$4,578.58</h1>
									</div>
									<div class="pull-in">
										<canvas id="dailySalesChart"></canvas>
									</div>
								</div>
							</div> -->
							<div class="card card-primary bg-primary-gradient">
								<div class="card-body">
									<h4 class="mb-1 fw-bold">Ordenes Progreso</h4>
									<div id="task-complete" class="chart-circle mt-4 mb-3"></div>
								</div>
								<?php  
									echo "<input type='hidden' id='totalOrdenFin' value='$arrayStatsTotalOrden[1]'>";
									echo "<input type='hidden' id='totalOrdenPen' value='$arrayStatsTotalOrden[0]'>";
								?>
							</div>
						</div>
					</div>
				</div>
			