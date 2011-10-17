# SQL command to create the table:
# Remember to correct VARCHAR column lengths to proper values
# and add additional indexes for your own extensions.

# If you had prepaired CREATE TABLE SQL-statement before,
# make sure that this automatically generated code is
# compatible with your own code. If SQL code is incompatible,
# it is not possible to use these generated sources successfully.
# (Changing VARCHAR column lenghts will not break code.)

CREATE TABLE Route (
        id bigint NOT NULL,
        leg_id bigint NOT NULL,
        start_location_id varchar(255),
        end_location_id varchar(255),
        PRIMARY KEY(id, leg_id),
        INDEX Route_id_INDEX (id),
        INDEX Route_leg_id_INDEX (leg_id));