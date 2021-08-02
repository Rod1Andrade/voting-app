-- Voting app
-- Version: 1.1.1
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

-- Alter table
alter table voting.tb_user add constraint unique_email unique (email);

-- triggers
-- ### Triggers
create trigger update_at_current_timestamp
    before update on voting.tb_user
    for each row
    execute procedure func_update_timestamp_update_at();


-- ##### Voting #####
create table if not exists voting.tb_voting(
    voting_uuid uuid, -- UUID is vendor by application
    subject varchar not null,
    start_date timestamp not null, -- is vendor by application
    finish_date timestamp not null, -- is vendor by application
    create_at timestamp default current_timestamp, -- database controlled
    update_at timestamp default null, -- database controlled
    primary key (voting_uuid)
);

-- Triggers
-- ### Triggers
create trigger update_at_current_timestamp_tb_voting
    before update on voting.tb_voting
    for each row
    execute procedure func_update_timestamp_update_at();

-- Relation
-- ## Voting Option ##
create table if not exists voting.tb_voting_option(
     voting_option_uuid uuid, -- vendor by application
     voting_uuid uuid, -- foreign key
     title varchar not null,
    create_at timestamp default current_timestamp, -- database controlled
    update_at timestamp default null, -- database controlled
    primary key (voting_option_uuid),
    foreign key (voting_uuid) references voting.tb_voting(voting_uuid)
);

-- Triggers
-- ### Triggers
create trigger update_at_current_timestamp_tb_voting_option
    before update on voting.tb_voting_option
    for each row
    execute procedure func_update_timestamp_update_at();