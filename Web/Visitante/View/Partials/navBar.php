<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">
    <img src="assets/img/sena.png" width="8%">
      <h1 class="logo"><a href="index.php">Vial-Manager</a></h1>
   
      <nav class="nav nav-tabs d-lg-block">
        <ul>
          <li class="active otro" data-url="<?php echo getUrl("Sena","Sena","getSena");?>"><a href="index.php">Inicio</a></li>
          <li class="otro" data-url="<?php echo getUrl("Sena","Sena","getSena");?>"><a href="<?php echo getUrl("Mapa","Mapa","getMapa");?>">Mapa</a></li>
          <li><a href="<?php echo getUrl("Acerca","Acerca","getAcerca");?>" class="otro" data-url="<?php echo getUrl("Sena","Sena","getSena");?>">Acerca</a></li>
          <?php

            if (@$_SESSION['menu']=="1") {
          ?> 
          <li class="drop-down sena"><a href="#">Sena</a>          
            <ul class="sena" data-url="<?php echo getUrl("Sena","Sena","getSena");?>">
            <li class="drop-down"><a href="<?php echo getUrl("Sena","Sena","getSena");?>">Organización</a>
                <ul>
                  <li><a href="#Quienes">¿Quiénes son?</a></li>
                  <li><a href="#Historia">Historia</a></li>
                  <li><a href="#logo">Logosímbolo</a></li>
                </ul>
              </li>
              <li><a href="#mv">Misión y Visión</a></li>
              <li><a href="#vc">Valores y Compromisos</a></li>
              <li><a href="#fb">Funciones y Deberes</a></li>
            </ul>
          </li>
          <?php
           }else{
          ?>

          <li class="sena" data-url="<?php echo getUrl("Sena","Sena","getSena");?>"><a href="<?php echo getUrl("Sena","Sena","getSena");?>">Sena</a></li>          

          <?php
           }
          ?>

          </li>
          <li class="drop-down"><a href="#">Cali</a>
            <ul class="otro" data-url="<?php echo getUrl("Sena","Sena","getSena");?>">
              <li class="drop-down"><a href="#">Información</a>
                <ul>
                  <li><a href="<?php echo getUrl("Cali","Cali","getHistoria");?>">Historia</a></li>
                  <li><a href="<?php echo getUrl("Cali","Cali","getBe");?>">Bandera y Escudo</a></li>
                  <li><a href="<?php echo getUrl("Cali","Cali","getIg");?>">Información Geografica</a></li>
                </ul>
              </li>
              <li><a href="<?php echo getUrl("Cali","Cali","getIv");?>">Infrastructura Vial</a></li>
              <li><a href="<?php echo getUrl("Cali","Cali","getMa");?>">Mantenimiento y Ampliacion</a></li>
              <li><a href="<?php echo getUrl("Cali","Cali","getCv");?>">Clasificación de las Vias</a></li>
              <li><a href="<?php echo getUrl("Cali","Cali","getBc");?>">Barrios y Comunas</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contacto</a></li>
          <li><a href="#"></a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="../../login.php" class="get-started-btn scrollto">&nbsp;&nbsp;Login&nbsp;&nbsp;</a>

    </div>
  </header><!-- End Header -->