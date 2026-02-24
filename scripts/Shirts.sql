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
        REFERENCES shirt_types(shirt_type_id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- Sample inserts (recommended)

INSERT INTO shirts
(shirt_id, shirt_code, shirt_name, shirt_description, fabric_type, fit, shirt_type_id, buy_price, sell_price)
VALUES
(1, 'GR001', 'Retro Graphic Tee', 'A bold graphic shirt for everyday wear.', 'Cotton', 'Regular', 1, 10.00, 24.99),
(2, 'BU001', 'Classic Button-Up', 'A clean button-up that works casual or formal.', 'Poplin', 'Slim', 2, 18.00, 39.99),
(3, 'FL001', 'Cozy Flannel', 'Warm flannel shirt for colder days.', 'Flannel', 'Relaxed', 3, 22.00, 49.99);