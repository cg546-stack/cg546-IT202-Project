USE shirt;

CREATE TABLE shirt_types (
  shirt_type_id INT NOT NULL,
  shirt_type_code VARCHAR(255) NOT NULL UNIQUE,
  shirt_type_name VARCHAR(255) NOT NULL,
  shelf_number VARCHAR(50) NOT NULL,
  date_time_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  date_time_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (shirt_type_id)
);

INSERT INTO shirt_types (shirt_type_id, shirt_type_code, shirt_type_name, shelf_number)
VALUES (1, 'GRAPH', 'Graphic', 'A1');

INSERT INTO shirt_types (shirt_type_id, shirt_type_code, shirt_type_name, shelf_number)
VALUES (2, 'BTNUP', 'Button-Up', 'B2');

INSERT INTO shirt_types (shirt_type_id, shirt_type_code, shirt_type_name, shelf_number)
VALUES (3, 'FLANN', 'Flannel', 'C3');

