<?php

class TrafficUpdateHandler
{

        function processRequest($requestContext) {

                $src = $requestContext["src_location"];
                $dest = $requestContext["dest_location"];
                echo " Inside Traffic Update Handler .. from $src to $dest <br>";
        }

}
?>
