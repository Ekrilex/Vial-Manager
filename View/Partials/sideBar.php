<!-- Sidebar -->
<div class="classic-grid">
	<div class="sidebar sidebar-style-2" data-background-color="dark2">			
		<div class="sidebar-wrapper scrollbar scrollbar-inner">
			<div class="sidebar-content">
				<div class="user">
					<div class="avatar-sm float-left mr-2">
						<img src="assets/img/iconos/sena.png" alt="..." class="avatar-img rounded-circle">
					</div>
					<div class="info">
						<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<span>
								<?php 
								echo "<span class='user-level text-light'>". $_SESSION['nombre']." ".$_SESSION['apellido']. "</span>";
								?>
								<span class="user-level text-light"><?php echo $_SESSION['nombreRol'];?></span>
								<!-- <span class="caret"></span> -->
							</span>
						</a>
						<div class="clearfix"></div>

						<!--<div class="collapse in" id="collapseExample">
							<ul class="nav">
								<li>
									<a href="#profile">
										<span class="link-collapse">My Profile</span>
									</a>
								</li>
								<li>
									<a href="#edit">
										<span class="link-collapse">Edit Profile</span>
									</a>
								</li>
								<li>
									<a href="#settings">
										<span class="link-collapse">Settings</span>
									</a>
								</li>
							</ul>
						</div>-->
					</div>
				</div>
				<ul class="nav nav-primary">
					<li class="nav-item active">
						<a href="index.php" class="collapsed" aria-expanded="false">
							<i class="fas fa-home"></i>
							<p>Inicio</p>
						</a>
						
					</li>
					
					<li class="nav-section">
						<span class="sidebar-mini-icon">
							<i class="fa fa-ellipsis-h"></i>
						</span>
						<h4 class="text-section">Modulos</h4>
					</li>
					
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Informacion Vial (Casos)</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
								<?php 
									if($_SESSION['rol'] != 3 && $_SESSION['rol'] != 2){

								?>
									<li>
										<a href="<?php echo getUrl("Caso","Caso","getCreate");?>">
											<span class="sub-item">Registrar Caso</span>
										</a>
									</li>
								<?php } ?>
									<li>
										<a href="<?php echo getUrl("Caso","Caso","index");?>">
											<span class="sub-item">Consultar Caso</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					
					<li class="nav-item">
						<a class="btn btn-warning" href="<?php echo getUrl("Visor","Visor","getMap")?>">
							<i class="icon-location-pin font-weight-bold text-dark"></i>
							<p class="font-weight-bold text-dark">Geo-Visor</p>
							<!-- <span class="caret"></span> -->
						</a>
						<!--<div class="collapse" id="maps">
							<ul class="nav nav-collapse">
								<li>
									<a href="maps/jqvmap.html">
										<span class="sub-item">Ver Mapa</span>
									</a>
								</li>
							</ul>
						</div>-->
					</li>
				    
					<li class="nav-item">
						<a data-toggle="collapse" href="#sidebarLayouts">
							<i class="fas fa-clipboard-list"></i>
							<p>Gestion Vial (Ordenes)</p>
							<span class="caret"></span>
						</a>
						<div class="collapse" id="sidebarLayouts">
							<ul class="nav nav-collapse">
							<?php 
								if($_SESSION['rol'] != 4){

							?>	
									<li>
										<a href="<?php echo getUrl("Orden","Orden", "getCreate");?>">
											<span class="sub-item">Registrar Orden</span>
										</a>
									</li>
							<?php }?>	
								<li>
									<a href="<?php echo getUrl("Orden","Orden", "index");?>">
										<span class="sub-item">Consultar Orden</span>
									</a>
								</li>
								
							
							</ul>
						</div>
                	</li>
					
					<?php 
						if($_SESSION['rol'] == 1){

					?>
						<li class="nav-item">
							<a data-toggle="collapse" href="#forms">
								<i class="icon-directions"></i>
								<p>Tramos</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="forms">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?php echo getUrl("Tramo","Tramo", "getCreate");?>">
											<span class="sub-item">Registrar Tramo</span>
										</a>
									</li>
									<li>
										<a href="<?php echo getUrl("Tramo","Tramo", "index");?>">
											<span class="sub-item">Consultar Tramo</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					<?php 
						}
					?>
					<?php 
						if($_SESSION['rol'] == 1){

					?>
						<li class="nav-item">
							<a data-toggle="collapse" href="#tables">
								<i class="fas fa-user-cog"></i>
								<p>Usuario</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="tables">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?php echo getUrl("Usuario","Usuario","getCreate"); ?>">
											<span class="sub-item">Registrar Usuario</span>
										</a>
									</li>
									<li>
										<a href="<?php echo getUrl("Usuario","Usuario","index")?>">
											<span class="sub-item">Consultar Usuario</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					<?php }?>
					<!--<li class="nav-item">
						<a data-toggle="collapse" href="#charts">
							<i class="far fa-chart-bar"></i>
							<p>Charts</p>
							<span class="caret"></span>
						</a>
						<div class="collapse" id="charts">
							<ul class="nav nav-collapse">
								<li>
									<a href="charts/charts.html">
										<span class="sub-item">Chart Js</span>
									</a>
								</li>
								<li>
									<a href="charts/sparkline.html">
										<span class="sub-item">Sparkline</span>
									</a>
								</li>
							</ul>
						</div>
					</li> 
					<li class="nav-item">
						<a href="widgets.html">
							<i class="fas fa-desktop"></i>
							<p>Widgets</p>
							<span class="badge badge-success">4</span>
						</a>
					</li>-->
					<?php 
						if($_SESSION['rol'] == 1){

					?>
						<li class="nav-item">
							<a data-toggle="collapse" href="#submenu">
								<i class="fas fa-bars"></i>
								<p>Catalogo</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="submenu">
								<ul class="nav nav-collapse">
									<li>
										<a data-toggle="collapse" href="#subnav1">
											<span class="sub-item">Barrio</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav1">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="<?php echo getUrl("Barrio","Barrio","index")?>">
														<span class="sub-item">Consultar Barrio</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									
									
									<li>
										<a data-toggle="collapse" href="#subnav3">
											<span class="sub-item">Deterioro</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav3">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="<?php echo getUrl("Deterioro","Deterioro","index");?>">
														<span class="sub-item">Consultar Deterioro</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<!--<li>
										<a data-toggle="collapse" href="#subnav4">
											<span class="sub-item">Elemento Ctario</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav4">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Registrar Elemento</span>
													</a>
												</li>
												<li>
													<a href="#">
														<span class="sub-item">Consultar Elemento</span>
													</a>
												</li>
											</ul>
										</div>
									</li>-->
									<!--<li>
										<a data-toggle="collapse" href="#subnav4">
											<span class="sub-item">Rol</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav4">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Registrar Rol</span>
													</a>
												</li>
												<li>
													<a href="#">
														<span class="sub-item">Consultar Rol</span>
													</a>
												</li>
											</ul>
										</div>
									</li>-->
								</ul>
							</div>
						</li>
					<?php } ?>
					<li class="nav-item">
						<a href="<?php echo getUrl("Reportes","Reportes","index"); ?>">
							<i class="flaticon-interface-6"></i>
							<p>Reporte</p>
						</a>
						<div class="collapse" id="reporte">
							<ul class="nav nav-collapse">
								<li>
									<a href="tables/tables.html">
										<span class="sub-item">Caso</span>
									</a>
								</li>
								<li>
									<a href="tables/datatables.html">
										<span class="sub-item">Orden Mto</span>
									</a>
								</li>
								<li>
									<a href="tables/datatables.html">
										<span class="sub-item">Tramo</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<!--<li class="mx-4 mt-2">
						<a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a> 
					</li>-->
				</ul>
			</div>
		</div>
	</div>
	