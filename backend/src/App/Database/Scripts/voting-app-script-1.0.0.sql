-- Voting app
-- Version: 1.0.0
-- Author: Rodrigo Andrade
-- Since: 2021-20-07

-- ### Schemas
create schema if not exists voting;

-- ### Functions
CREATE OR REPLACE FUNCTION func_update_timestamp_update_at()
    RETURNS TRIGGER AS $$
BEGIN
    NEW.update_at = now();
    RETURN NEW;
END;
$$ language 'plpgsql';

-- ### Relations
-- here goes the table relations split and sorted
-- Keep the pattern.

-- ##### User #####
create table if not exists voting.tb_user
(
    user_id    uuid, -- UUID is vendor by application
    email      varchar not null,
    password   varchar not null,
    birth_date date    not null,
    name       varchar not null,
    last_name  varchar not null,
    created_at timestamp default current_timestamp,
    update_at  timestamp default null,
    primary key (user_id)
);

-- triggers
-- ### Triggers
create trigger update_at_current_timestamp
    before update on voting.tb_user
    for each row
    execute procedure func_update_timestamp_update_at();