/* Drop Tables */

DROP TABLE IF EXISTS bill CASCADE;
DROP TABLE IF EXISTS drink CASCADE;
DROP TABLE IF EXISTS item CASCADE;
DROP TABLE IF EXISTS meal CASCADE;
DROP TABLE IF EXISTS menu CASCADE;
DROP TABLE IF EXISTS menu_item CASCADE;
DROP TABLE IF EXISTS order_item CASCADE;
DROP TABLE IF EXISTS permission CASCADE;
DROP TABLE IF EXISTS restaurant_order CASCADE;
DROP TABLE IF EXISTS restaurant_table CASCADE;
DROP TABLE IF EXISTS user_account CASCADE;
DROP TABLE IF EXISTS user_permission CASCADE;

/* Create Tables */
create table public.item
(
    price       real              not null,
    name        varchar(128)      not null,
    description varchar(256),
    id_item     serial
        constraint pk_item
            primary key,
    state       integer default 1 not null,
    type        varchar(8)
);

create index index_type
    on public.item (type);

create table public.menu
(
    date_to   date,
    date_from date,
    id_menu   serial
        constraint pk_menu
            primary key
);

create table public.menu_item
(
    id_menu_item serial
        constraint pk_menu_item
            primary key,
    id_menu      integer           not null
        constraint fk_menu
            references public.menu,
    id_item      integer           not null
        constraint fk_item
            references public.item,
    state        integer default 1 not null
);

create table public.permission
(
    permission  varchar(64) not null
        constraint pk_user_permission
            primary key,
    description text        not null
);

create table public.restaurant_table
(
    seat_count integer not null,
    id_table   integer not null
        constraint pk_table
            primary key
);

create table public.bill
(
    price_after_sale  real,
    price_before_sale real    not null,
    sale_reason       varchar(256),
    sale_amount       integer,
    id_bill           serial
        constraint pk_bill
            primary key,
    id_order          integer not null
);

create table public.user_account
(
    id_user        uuid    default uuid_generate_v4() not null
        constraint pk_user_account
            primary key,
    display_name   varchar(128)                       not null,
    password       text,
    blocked        boolean default false              not null,
    reset_password boolean default true               not null,
    deletable      boolean default true               not null,
    username       varchar(64)
        constraint unique_username
            unique,
    employee       boolean default false              not null,
    mail           varchar(256)
        constraint unique_mail
            unique,
    id_facebook    text
        constraint unique_id_facebook
            unique
);

create index index_user_account_username
    on public.user_account (username);

create table public.user_permission
(
    id_user    uuid        not null
        constraint fk_user_account
            references public.user_account
            on delete cascade,
    permission varchar(64) not null
        constraint fk_user_permission
            references public.permission
            on delete cascade
);

create table public.restaurant_order
(
    created         timestamp with time zone default CURRENT_TIMESTAMP not null,
    id_order        serial
        constraint pk_order
            primary key,
    id_table        integer
        constraint fk_table
            references public.restaurant_table,
    opened          boolean                  default true              not null,
    customer        uuid
        constraint fk_customer
            references public.user_account,
    editing_user    uuid
        constraint fk_editing_user
            references public.user_account
            on delete set null,
    edit_start_time integer,
    constraint check_table_or_user
        check ((id_table IS NOT NULL) OR (customer IS NOT NULL))
);

create table public.order_item
(
    comment       varchar(256),
    count         integer                                            not null,
    created       timestamp with time zone default CURRENT_TIMESTAMP not null,
    id_order_item serial
        constraint pk_order_item
            primary key,
    id_order      integer                                            not null
        constraint fk_order
            references public.restaurant_order
            on delete cascade,
    id_item       integer                                            not null
        constraint fk_item
            references public.item
            on delete restrict,
    state         integer                  default 0                 not null,
    constraint unique_order_item
        unique (id_order, id_item)
);