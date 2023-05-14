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
CREATE TABLE permission (
    id_permission uuid NOT NULL DEFAULT uuid_generate_v4(),
    permission_key VARCHAR(32),
    display_name VARCHAR(128),
    description TEXT NULL
);
ALTER TABLE permission ADD CONSTRAINT pk_user_permission PRIMARY KEY (id_permission);

CREATE TABLE user_account (
    id_user uuid NOT NULL DEFAULT uuid_generate_v4(),
    mail VARCHAR(128),
    password TEXT NOT NULL,
    name VARCHAR(64) NOT NULL,
    surname VARCHAR(64),
    blocked BOOLEAN NOT NULL DEFAULT FALSE,
    deletable BOOLEAN NOT NULL DEFAULT TRUE
);
ALTER TABLE user_account ADD CONSTRAINT pk_user_account PRIMARY KEY (id_user);

CREATE TABLE user_permission (
    id_user uuid NOT NULL,
    id_permission uuid NOT NULL
);
ALTER TABLE user_permission ADD CONSTRAINT pk_user_permission PRIMARY KEY (id_user, id_permission);
ALTER TABLE user_permission ADD CONSTRAINT fk_user_account FOREIGN KEY (id_user) REFERENCES user_account (id_user) ON DELETE CASCADE;
ALTER TABLE user_permission ADD CONSTRAINT fk_user_permission FOREIGN KEY (id_permission) REFERENCES permission (id_permission) ON DELETE CASCADE;

CREATE TABLE item (
    id_item uuid NOT NULL DEFAULT uuid_generate_v4(),
    name VARCHAR(128) NOT NULL,
    price DOUBLE PRECISION NOT NULL,
    description VARCHAR(256),
    state INTEGER NOT NULL DEFAULT 1
);
ALTER TABLE item ADD CONSTRAINT pk_item PRIMARY KEY (id_item);

CREATE TABLE drink (
    id_item uuid NOT NULL,
    volume DOUBLE PRECISION NOT NULL
);
ALTER TABLE drink ADD CONSTRAINT pk_drink PRIMARY KEY (id_item);
ALTER TABLE drink ADD CONSTRAINT fk_item FOREIGN KEY (id_item) REFERENCES item (id_item) ON DELETE CASCADE;

CREATE TABLE meal (
    id_item uuid NOT NULL,
    allergens VARCHAR(128)
);
ALTER TABLE meal ADD CONSTRAINT pk_meal PRIMARY KEY (id_item);
ALTER TABLE meal ADD CONSTRAINT fk_item FOREIGN KEY (id_item) REFERENCES item (id_item) ON DELETE CASCADE;

CREATE TABLE menu (
    id_menu uuid NOT NULL DEFAULT uuid_generate_v4(),
    date_to DATE,
    date_from DATE
);
ALTER TABLE menu ADD CONSTRAINT pk_menu PRIMARY KEY (id_menu);

CREATE TABLE menu_item (
    id_menu uuid NOT NULL,
    id_item uuid NOT NULL,
    state INTEGER NOT NULL DEFAULT 1
);
ALTER TABLE menu_item ADD CONSTRAINT pk_menu_item PRIMARY KEY (id_menu, id_item);
ALTER TABLE menu_item ADD CONSTRAINT fk_menu FOREIGN KEY (id_menu) REFERENCES menu (id_menu) ON DELETE CASCADE;
ALTER TABLE menu_item ADD CONSTRAINT fk_item FOREIGN KEY (id_item) REFERENCES item (id_item) ON DELETE CASCADE;

CREATE TABLE restaurant_table (
    id_table uuid NOT NULL DEFAULT uuid_generate_v4(),
    table_number INTEGER NOT NULL,
    seat_count INTEGER NOT NULL
);
ALTER TABLE restaurant_table ADD CONSTRAINT pk_table PRIMARY KEY (id_table);

CREATE TABLE restaurant_order (
    id_order uuid NOT NULL DEFAULT uuid_generate_v4(),
    id_table uuid,
    id_user uuid,
    created TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT current_timestamp,
    state INTEGER NOT NULL DEFAULT 1
);
ALTER TABLE restaurant_order ADD CONSTRAINT pk_order PRIMARY KEY (id_order);
ALTER TABLE restaurant_order ADD CONSTRAINT fk_user_account FOREIGN KEY (id_user) REFERENCES user_account (id_user) ON DELETE SET NULL;
ALTER TABLE restaurant_order ADD CONSTRAINT fk_table FOREIGN KEY (id_table) REFERENCES restaurant_table (id_table) ON DELETE RESTRICT;
ALTER TABLE restaurant_order ADD CONSTRAINT check_table_or_user_is_filled CHECK (id_order IS NOT NULL OR id_table IS NOT NULL);

CREATE TABLE order_item (
    id_order_item uuid NOT NULL DEFAULT uuid_generate_v4(),
    id_order uuid NOT NULL,
    id_item uuid NOT NULL,
    count INTEGER NOT NULL,
    created TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT current_timestamp,
    comment VARCHAR(256),
    state INTEGER NOT NULL DEFAULT 0
);
ALTER TABLE order_item ADD CONSTRAINT pk_order_item PRIMARY KEY (id_order_item);
ALTER TABLE order_item ADD CONSTRAINT fk_order FOREIGN KEY (id_order) REFERENCES restaurant_order (id_order) ON DELETE CASCADE;
ALTER TABLE order_item ADD CONSTRAINT fk_item FOREIGN KEY (id_item) REFERENCES item (id_item) ON DELETE RESTRICT;

CREATE TABLE bill (
    id_bill uuid NOT NULL DEFAULT uuid_generate_v4(),
    id_order uuid NOT NULL,
    price_before_sale DOUBLE PRECISION NOT NULL,
    price_after_sale DOUBLE PRECISION,
    sale_reason VARCHAR(256),
    sale_amount INTEGER
);
ALTER TABLE bill ADD CONSTRAINT pk_bill PRIMARY KEY (id_bill);
ALTER TABLE bill ADD CONSTRAINT fk_order FOREIGN KEY (id_order) REFERENCES restaurant_order (id_order) ON DELETE CASCADE;