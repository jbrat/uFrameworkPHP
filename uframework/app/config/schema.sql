drop table if exists statuses;

CREATE TABLE statuses
(
    id INT PRIMARY KEY NOT NULL,
    user VARCHAR(100),
    message VARCHAR(400)
);