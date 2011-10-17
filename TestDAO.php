<?php

require_once 'DAO_VO/TrafficDensityDao.php';
require_once 'DAO_VO/TrafficDensity.php';
require_once 'DAO_VO/LocationDao.php';
require_once 'DAO_VO/Location.php';
require_once 'DAO_VO/RouteDao.php';
require_once 'DAO_VO/Route.php';
require_once 'DAO_VO/Datasource.php';

$startLoc="Marathahalli Bridge";
$endLoc="4th Cross Airport Road";

$conn = new Datasource('fa3.ads.corp.sp1.yahoo.com', 'tss', 'ui_user', 'some_pass');
echo "Connection created...";

$locationDao = new LocationDao();
$location = $locationDao->createValueObject();

$location->setName($startLoc);
$startLocId=$locationDao->searchMatching($conn, $location);

$location->setName($endLoc);
$endLocId=$locationDao->searchMatching($conn, $location);

echo "<br>Start Loc ID: " . $startLocId[0]->getId();

echo "<br>End Loc ID: " . $endLocId[0]->getId();

$routeDao = new RouteDao();
$route = $routeDao->createValueObject();

$route->setStartLocationId($startLocId[0]->getId());
$route->setEndLocationId($endLocId[0]->getId());

$routeId = $routeDao->searchMatching($conn, $route);

var_dump($routeId);
echo "<br>Route ID: " . $routeId[0]->getId();

$trafficDensityDao = new TrafficDensityDao();
$trafficDensity = $trafficDensityDao->createValueObject();
$trafficDensity->setRouteId($routeId[0]->getId());

print_r($trafficDensityDao->searchMatching($conn, $trafficDensity));


?>
