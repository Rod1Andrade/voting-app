-- Voting app - Memory
-- Version: 3.0.0
-- Author: Rodrigo Andrade
-- Since: 2021-20-07

-- ### Relations
-- here goes the table relations split and sorted
-- Keep the pattern.


-- ##### User #####
create table if not exists tb_user
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
create trigger if not exists update_at_current_timestamp
    before update
    on tb_user
    for each row
    when
        old.update_at is null or new.update_at <= old.update_at
begin
    update tb_user
    set update_at = current_timestamp
    where old.user_id;
end;


-- ##### Voting #####
create table if not exists tb_voting
(
    user_uuid   uuid,
    voting_uuid uuid,                                -- UUID is vendor by application
    subject     varchar   not null,
    start_date  timestamp not null,                  -- is vendor by application
    finish_date timestamp not null,                  -- is vendor by application
    create_at   timestamp default current_timestamp, -- database controlled
    update_at   timestamp default null,              -- database controlled
    primary key (voting_uuid),
    foreign key (user_uuid) references tb_user (user_id) on delete cascade
);

-- Triggers
create trigger if not exists update_at_current_timestamp_voting
    before update
    on tb_voting
    for each row
    when
        old.update_at is null or new.update_at <= old.update_at
begin
    update tb_voting
    set update_at = current_timestamp
    where old.voting_uuid;
end;

-- Relation
-- ## Voting Option ##
create table if not exists tb_voting_option
(
    voting_option_uuid uuid,                                -- vendor by application
    voting_uuid        uuid,                                -- foreign key
    title              varchar not null,
    create_at          timestamp default current_timestamp, -- database controlled
    update_at          timestamp default null,              -- database controlled
    primary key (voting_option_uuid),
    foreign key (voting_uuid) references tb_voting (voting_uuid) on delete cascade

);

-- alter tables

-- Triggers
create trigger if not exists update_at_current_timestamp_voting_option
    before update
    on tb_voting_option
    for each row
    when
        old.update_at is null or new.update_at <= old.update_at
begin
    update tb_voting_option
    set update_at = current_timestamp
    where old.voting_uuid;
end;

-- ## Vote
create table if not exists tb_vote
(
    user_uuid          uuid,
    voting_option_uuid uuid,
    voting_uuid        uuid,
    voting_at          timestamp default current_timestamp,

    primary key (user_uuid, voting_uuid),
    foreign key (user_uuid) references tb_user (user_id),
    foreign key (voting_option_uuid) references tb_voting_option (voting_option_uuid),
    foreign key (voting_uuid) references tb_voting (voting_uuid)
);