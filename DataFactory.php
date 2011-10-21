<?php 
require_once 'DAO_VO/TrafficDensityDao.php';
require_once 'DAO_VO/LocationDao.php';
require_once 'DAO_VO/RouteDao.php';
require_once 'DAO_VO/Datasource.php';

class DataFactory {


        function createLocationDAO() {
            return new LocationDao();
        }

        function createRouteDAO() {
            return new RouteDao();
        }

        function createTrafficDensityDAO() { 
            return new TrafficDensityDao();
        }

}

?>
