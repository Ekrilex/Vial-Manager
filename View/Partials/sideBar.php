<!-- Sidebar -->
<div class="classic-grid">
	<div class="sidebar sidebar-style-2" data-background-color="dark2">			
		<div class="sidebar-wrapper scrollbar scrollbar-inner">
			<div class="sidebar-content">
				<div class="user">
					<div class="avatar-sm float-left mr-2">
						<img src="assets/img/iconos/avatardefault_92824.ico" alt="..." class="avatar-img rounded-circle">
					</div>
					<div class="info">
						<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<span>
								Juan Castellar
								<span class="user-level">Administrator</span>
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
								<li>
									<a href="components/avatars.html">
										<span class="sub-item">Registrar Caso</span>
									</a>
								</li>
								<li>
									<a href="components/buttons.html">
										<span class="sub-item">Consultar Caso</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a data-toggle="collapse" href="#maps" class="btn btn-info">
							<i class="icon-location-pin text-white"></i>
							<p class="text-light">Geo-Visor</p>
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
								<li>
									<a href="sidebar-style-1.html">
										<span class="sub-item">Registrar Orden</span>
									</a>
								</li>
								<li>
									<a href="overlay-sidebar.html">
										<span class="sub-item">Consultar Orden</span>
									</a>
								</li>
								
							</ul>
						</div>
                	</li>
					
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
												<a href="#">
													<span class="sub-item">Registrar Barrio</span>
												</a>
											</li>
											<li>
												<a href="#">
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
												<a href="<?php echo getUrl("Deterioro","Deterioro","getCreate");?>">
													<span class="sub-item">Registrar Deterioro</span>
												</a>
											</li>
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
					<li class="nav-item">
						<a data-toggle="collapse" href="#reporte">
							<i class="flaticon-interface-6"></i>
							<p>Reporte</p>
							<span class="caret"></span>
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
	