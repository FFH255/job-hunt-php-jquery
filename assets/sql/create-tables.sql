CREATE TABLE `vacancies` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `company` varchar(255),
  `employment` varchar(255) NOT NULL,
  `experience_from` int,
  `experience_to` int,
  `city` varchar(255),
  `salary_from` int,
  `salary_to` int,
  `description` TEXT NOT NULL
);

CREATE TABLE `replies` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `vacancy_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
    FOREIGN KEY (vacancy_id)
        REFERENCES vacancies(id)
        ON DELETE CASCADE
);

CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL
);