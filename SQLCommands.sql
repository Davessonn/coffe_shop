CREATE DATABASE coffeedb;

-- Coffees table with records

CREATE TABLE `coffees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--

INSERT INTO `coffees` (`id`, `name`, `description`, `price`) VALUES
(1, 'Vanilla Latte', 'A classic latte with vanilla syrup added for a sweet twist.', '3.99'),
(2, 'Caramel Macchiato', 'Espresso with steamed milk and caramel drizzle.', '4.49'),
(3, 'Mocha Frappuccino', 'A blended iced coffee with chocolate sauce and whipped cream.', '4.99'),
(4, 'Peppermint Mocha', 'Espresso with chocolate and peppermint syrup, topped with whipped cream.', '4.79'),
(5, 'Hazelnut Cappuccino', 'Espresso with steamed milk and hazelnut syrup, finished with a sprinkle of cinnamon.', '4.29'),
(6, 'Irish Coffee', 'Hot coffee with a shot of Irish whiskey and a dollop of whipped cream.', '5.49');

--

ALTER TABLE `coffees`
  ADD PRIMARY KEY (`id`);

--

ALTER TABLE `coffees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

-- Users table with a root user

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--

INSERT INTO `users` (`user_id`, `username`, `password`, `is_admin`) VALUES
(1, 'root', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 1);

--

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
