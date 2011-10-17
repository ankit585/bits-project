<?php

class TrafficRequestType
{
        const BROWSE = 0;
        const UPDATE = 1;
        const INVALID = 2;

        function getTrafficRequestType($type) {
                if ($type == "browse") {
                        return TrafficRequestType::BROWSE;
                } else if ($type == "update") {
                        return TrafficRequestType::UPDATE;
                } else {
                        return TrafficRequestType::INVALID;
                }
        }
}





?>
