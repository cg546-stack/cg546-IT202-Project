USE shirt;

CREATE TABLE shirts (
  shirt_id INT NOT NULL,
  shirt_code VARCHAR(10) NOT NULL UNIQUE,
  shirt_name VARCHAR(255) NOT NULL,
  shirt_description TEXT NOT NULL,
  fabric_type VARCHAR(50) NOT NULL,
  fit VARCHAR(60) NOT NULL,
  shirt_type_id INT DEFAULT NULL,
  buy_price DECIMAL(10,2) NOT NULL,
  sell_price DECIMAL(10,2) NOT NULL,
  date_time_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  date_time_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (shirt_id),
  FOREIGN KEY (shirt_type_id)
    REFERENCES shirt_types (shirt_type_id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);

INSERT INTO shirts
(shirt_id, shirt_code, shirt_name, shirt_description, fabric_type, fit, shirt_type_id, buy_price, sell_price)
VALUES
(1, 'GR001', 'Retro Graphic Tee', 'A bold graphic shirt for everyday wear.', 'Cotton', 'Regular', 1, 8.00, 18.00);

INSERT INTO shirts
(shirt_id, shirt_code, shirt_name, shirt_description, fabric_type, fit, shirt_type_id, buy_price, sell_price)
VALUES
(2, 'BU001', 'Classic Button-Up', 'A clean button-up that works casual or formal.', 'Oxford', 'Slim', 2, 15.00, 35.00);

INSERT INTO shirts
(shirt_id, shirt_code, shirt_name, shirt_description, fabric_type, fit, shirt_type_id, buy_price, sell_price)
VALUES
(3, 'FL001', 'Cozy Flannel', 'Warm flannel shirt for colder days.', 'Flannel', 'Relaxed', 3, 18.00, 40.00);