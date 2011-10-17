# SQL command to create the table:
# Remember to correct VARCHAR column lengths to proper values
# and add additional indexes for your own extensions.

# If you had prepaired CREATE TABLE SQL-statement before,
# make sure that this automatically generated code is
# compatible with your own code. If SQL code is incompatible,
# it is not possible to use these generated sources successfully.
# (Changing VARCHAR column lenghts will not break code.)

CREATE TABLE TrafficDensity (
        route_id bigint NOT NULL,
        leg_id bigint NOT NULL,
        density varchar(255),
        PRIMARY KEY(route_id, leg_id),
        INDEX TrafficDensity_route_id_INDEX (route_id),
        INDEX TrafficDensity_leg_id_INDEX (leg_id));