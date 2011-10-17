<?php
require_once 'DAO_VO/TrafficDensityDao.php';
require_once 'DAO_VO/TrafficDensity.php';
require_once 'DAO_VO/LocationDao.php';
require_once 'DAO_VO/Location.php';
require_once 'DAO_VO/RouteDao.php';
require_once 'DAO_VO/Route.php';
require_once 'DAO_VO/Datasource.php';


class TrafficBrowseHandler
{

        function processRequest($requestContext) {

                $src = $requestContext["src_location"];
                $dest = $requestContext["dest_location"];
                $trafficDensity = $this->getTrafficDensity($src,$dest);
                return $trafficDensity;
        }

        function getTrafficDensity($src,$dest) {

                $conn = new Datasource('fa3.ads.corp.sp1.yahoo.com', 'tss', 'ui_user', 'some_pass');

                $locationDao = new LocationDao();
                $location = $locationDao->createValueObject();

                $location->setName($src);
                $startLocId=$locationDao->searchMatching($conn, $location);

                $location->setName($dest);
                $endLocId=$locationDao->searchMatching($conn, $location);

                $routeDao = new RouteDao();
                $route = $routeDao->createValueObject();

                $route->setStartLocationId($startLocId[0]->getId());
                $route->setEndLocationId($endLocId[0]->getId());

                $routeId = $routeDao->searchMatching($conn, $route);

                $trafficDensityDao = new TrafficDensityDao();
                $trafficDensity = $trafficDensityDao->createValueObject();
                $trafficDensity->setRouteId($routeId[0]->getId());

                return $trafficDensityDao->searchMatching($conn, $trafficDensity);


        }

}
?>
