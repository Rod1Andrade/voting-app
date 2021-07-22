-- Voting app - Memory
-- Version: 1.0.0
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
create trigger update_at_current_timestamp
    before update
    on tb_user
    for each row
    when
        old.update_at = null or new.update_at <= old.update_at
begin
    update tb_user
    set update_at = current_timestamp
    where old.user_id;
end;

