<?php

    include_once '../Model/Reportes/ReportesModel.php';
    
    class ReportesController {

        public function index(){

            $obj = new ReportesModel();

            date_default_timezone_set('UTF');
            
            $casosToday    = "SELECT bit_fecha_modificacion FROM tbl_bitacora WHERE bit_accion = 'Insercion_caso'";
            $ordenToday    = "SELECT bit_fecha_modificacion FROM tbl_bitacora WHERE bit_accion = 'Insercion_orden'";
            $usersToday    = "SELECT bit_fecha_modificacion FROM tbl_bitacora WHERE bit_accion = 'Insercion_usu'";
            $CasesPenQuery = "SELECT * FROM tbl_caso WHERE estado_id = 3";
            $CasesFinQuery = "SELECT * FROM tbl_caso WHERE estado_id = 5";
            $ordenFinQuery = "SELECT * FROM tbl_orden_mantenimiento WHERE estado_id = 5";
            $ordenPenQuery = "SELECT * FROM tbl_orden_mantenimiento WHERE estado_id = 3";

            $ejeTotalCasesPen = $obj->consultar($CasesPenQuery);
            $ejeTotalCasesFin = $obj->consultar($CasesFinQuery);
            $totalCasesPen    = pg_numrows($ejeTotalCasesPen);
            $totalCasesFin    = pg_numrows($ejeTotalCasesFin);
            
            $arrayStatsToday      = $this->getStasToday($casosToday,$ordenToday,$usersToday,$obj);
            $arrayStastWeek       = $this->getStatsWeek($casosToday,$obj);
            $arrayStastMonthCase  = $this->getStatsPerMonthCases($casosToday,$obj);
            $arrayStastMonthOrden = $this->getStatsPerMonthOrden($ordenToday,$obj);
            $arrayStastMonthUser  = $this->getStatsPerMonthUsers($usersToday,$obj);
            $arrayStatsTotalOrden = $this->getTotalOrdePerMonth($ordenPenQuery,$ordenFinQuery,$obj);

            include_once '../View/Reportes/index.php';
            
        }

        private function getStasToday($queryCaso, $queryOrden, $queryUsers, $object){
            $obj        = $object;
            $ejeCaso    = $obj->consultar($queryCaso);
            $ejeOrden   = $obj->consultar($queryOrden);
            $ejeUser    = $obj->consultar($queryUsers);
            $countCaso  = 0;
            $countOrden = 0;
            $countUser  = 0;
            $arrayCount = array();

            while ($caso= pg_fetch_assoc($ejeCaso)) {
                if ( substr(strval( $caso['bit_fecha_modificacion'] ), 0, 10) == strval( date( 'Y-m-d' ) ) ) { $countCaso++; }
            }

            while ($orden = pg_fetch_assoc($ejeOrden)) {
                if ( substr(strval( $orden['bit_fecha_modificacion'] ), 0, 10) == strval( date( 'Y-m-d' ) ) ) { $countOrden++; }
            }
            
            while ($user = pg_fetch_assoc($ejeUser)) {
                if ( substr(strval( $user['bit_fecha_modificacion'] ), 0, 10) == strval( date( 'Y-m-d' ) ) ) { $countUser++; }
            }

            $arrayCount = array($countCaso,$countOrden,$countUser);

            return $arrayCount;
        }

        private function getStatsWeek($queryCaso, $object){
            $obj       = $object;
            $casosWeek = $queryCaso;
            $monday    = 0;
            $tuesday   = 0;
            $wednesday = 0;
            $thursday  = 0;
            $friday    = 0;
            $saturday  = 0;
            $sunday    = 0;
            $temporary = "";
            $temporary = "";
            $arrayDays = array();

            $ejeCase = $obj->consultar($casosWeek);

            while ( $caso= pg_fetch_assoc($ejeCase) ) {
               $temporary = substr(strval($caso['bit_fecha_modificacion']), 0 ,10);
               if (strftime("%W",strtotime($temporary))+1 == date("W") ) {
                  $temporary  = strtotime($temporary);
                  $temporary2 = strftime("%w", $temporary);
                  $temporary2 = intval($temporary2);

                  switch ($temporary2) {
                      case 0:
                          $sunday++;
                          break;
                      case 1:
                          $monday++;
                          break;
                      case 2:
                          $tuesday++;
                          break;
                      case 3:
                          $wednesday++;
                          break;
                      case 4:
                          $thursday++;
                          break;
                      case 5:
                          $friday++;
                          break;
                      case 6:
                          $saturday++;
                          break;
                      
                      default:
                          # code...
                          break;
                  }
               }
            }

            $arrayDays = array($sunday,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday);

            return $arrayDays;

            

        }
        
        private function getStatsPerMonthCases($queryCaso, $object){

            $obj      = $object;
            $ejeCaso  = $obj->consultar($queryCaso);

            $months = array(0,0,0,0,0,0,0,0,0,0,0,0);
            
            while($case = pg_fetch_assoc($ejeCaso)){
                $date = $case['bit_fecha_modificacion'];
                $date = substr( strval( $date ), 0, 10 );
                $date = strtotime($date);
                $date = strftime("%m", $date);
                $date = intval($date);

                switch ($date) {
                    case 1:
                        $months[0] = $months[0]+1;
                        break;
                    case 2:
                        $months[1] = $months[1]+1;
                        break;
                    case 3:
                        $months[2] = $months[2]+1;
                        break;
                    case 4:
                        $months[3] = $months[3]+1;
                        break;
                    case 5:
                        $months[4] = $months[4]+1;
                        break;
                    case 6:
                        $months[5] = $months[5]+1;
                        break;
                    case 7:
                        $months[6] = $months[6]+1;
                        break;
                    case 8:
                        $months[7] = $months[7]+1;
                        break;
                    case 9:
                        $months[8] = $months[8]+1;
                        break;
                    case 10:
                        $months[9] = $months[9]+1;
                        break;
                    case 11:
                        $months[10] = $months[10]+1;
                        break;
                    case 12:
                        $months[11] = $months[11]+1;
                        break;
                    
                    default:
                        # code...
                        break;
                }
            
            }

            return $months;

            
        }

        private function getStatsPerMonthOrden($queryOrden, $object){
            $obj       = $object;
            $ejeOrden  = $obj->consultar($queryOrden);

            $months = array(0,0,0,0,0,0,0,0,0,0,0,0);

            while ($orden = pg_fetch_assoc($ejeOrden)) {
                $date = $orden['bit_fecha_modificacion'];
                $date = substr( strval( $date ), 0, 10 );
                $date = strtotime($date);
                $date = strftime("%m", $date);
                $date = intval($date);

                switch ($date) {
                    case 1:
                        $months[0] = $months[0]+1;
                        break;
                    case 2:
                        $months[1] = $months[1]+1;
                        break;
                    case 3:
                        $months[2] = $months[2]+1;
                        break;
                    case 4:
                        $months[3] = $months[3]+1;
                        break;
                    case 5:
                        $months[4] = $months[4]+1;
                        break;
                    case 6:
                        $months[5] = $months[5]+1;
                        break;
                    case 7:
                        $months[6] = $months[6]+1;
                        break;
                    case 8:
                        $months[7] = $months[7]+1;
                        break;
                    case 9:
                        $months[8] = $months[8]+1;
                        break;
                    case 10:
                        $months[9] = $months[9]+1;
                        break;
                    case 11:
                        $months[10] = $months[10]+1;
                        break;
                    case 12:
                        $months[11] = $months[11]+1;
                        break;
                    
                    default:
                        # code...
                        break;
                }                
                
            }

            return $months;
        }
        
        private function getStatsPerMonthUsers($queryUsers, $object){
            
            $obj      = $object;
            $ejeUsers = $object->consultar($queryUsers);

            $months = array(0,0,0,0,0,0,0,0,0,0,0,0);

            while ($user = pg_fetch_assoc($ejeUsers)) {
                $date = $user['bit_fecha_modificacion'];
                $date = substr( strval( $date ), 0, 10 );
                $date = strtotime($date);
                $date = strftime("%m", $date);
                $date = intval($date);

                switch ($date) {
                    case 1:
                        $months[0] = $months[0]+1;
                        break;
                    case 2:
                        $months[1] = $months[1]+1;
                        break;
                    case 3:
                        $months[2] = $months[2]+1;
                        break;
                    case 4:
                        $months[3] = $months[3]+1;
                        break;
                    case 5:
                        $months[4] = $months[4]+1;
                        break;
                    case 6:
                        $months[5] = $months[5]+1;
                        break;
                    case 7:
                        $months[6] = $months[6]+1;
                        break;
                    case 8:
                        $months[7] = $months[7]+1;
                        break;
                    case 9:
                        $months[8] = $months[8]+1;
                        break;
                    case 10:
                        $months[9] = $months[9]+1;
                        break;
                    case 11:
                        $months[10] = $months[10]+1;
                        break;
                    case 12:
                        $months[11] = $months[11]+1;
                        break;
                    
                    default:
                        # code...
                        break;
                }                
                
            }

            return $months;
            
        }

        private function getTotalOrdePerMonth($queryPen, $queryFin, $object){

            $obj    = $object;
            $ejeFin = $obj->consultar($queryFin);
            $ejePen = $obj->consultar($queryPen);

            $count  = pg_numrows($ejePen);
            $count2 = pg_numrows($ejeFin);

            $arrayCount = array($count,$count2);

            return $arrayCount;

        }
        
    }
?>