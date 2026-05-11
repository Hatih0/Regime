INSERT INTO admin (id, nom, password) VALUES
(1, 'admin', '$2y$12$1oIFi/ZAHZ6mIhO1j7axmexnloHbR7cYgMeoZz2fVuPBUC3ZkYmba');

INSERT INTO utilisateur (id, nom, email, mot_de_passe, date_inscription, genre, gold) VALUES
(1, 'user', 'user@gmail.com', '$2y$12$lJfQXNw98V5dZkz9Fo32f.RdvNq8lFPYs366nSOI9ZBJpENVZU7PG', '2026-05-11 10:38:47', 'Homme', 0),
(2, 'bob', 'bob@gmail.com', '$2y$12$kUZt9x4INRBvXWmd267meeGHxqmFD1ER1Ta.cI9ZQ.cspn/t9S1le', '2026-05-11 10:42:10', 'Homme', 0),
(3, 'alice', 'alice@gmail.com', '$2y$12$hvn/Q.T.8sYOYT5wsCnW6.twkzujZntr.KYrkuAqLCSTW0EfPwPPS', '2026-05-11 10:43:55', 'Femme', 0),
(4, 'charlie', 'charlie@gmail.com', '$2y$12$KRiSDGjrMFOPvBZyfdUBKuOrXUtWOEPhMTaMeBtzuq2ApqoLkRsgq', '2026-05-11 10:45:45', 'Homme', 0),
(5, 'dana', 'dana@gmail.com', '$2y$12$X7midst10Z/pc5vCjFI8DekGvlxcwvsVnTkLSQ2IBEjfouSdL7Ku2', '2026-05-11 10:47:53', 'Femme', 0);

INSERT INTO sante_utilisateur (id, id_utilisateur, taille, poids, date_mesure) VALUES
(1, 1, 172.00, 76.00, '2026-05-11 10:38:47'),
(2, 2, 165.00, 62.00, '2026-05-11 10:42:10'),
(3, 3, 180.00, 84.00, '2026-05-11 10:43:55'),
(4, 4, 170.00, 70.00, '2026-05-11 10:45:45'),
(5, 5, 172.00, 76.00, '2026-05-11 10:47:53');    

INSERT INTO objectif(nom) VALUES
('Augmenter poids'),
('Reduire poids'),
('Atteindre IMC ideal');

INSERT INTO regime (id, nom, pourcentage_viande, pourcentage_poisson, pourcentage_volaille, variation_poids, duree_jour, prix) VALUES
(1, 'Keto strict', 25.00, 5.00, 10.00, -2.00, 7, 3500.00),
(2, 'Hyperproteine', 30.00, 5.00, 15.00, -3.00, 14, 5000.00),
(3, 'Equilibre leger', 10.00, 10.00, 10.00, -1.00, 7, 1500.00),
(4, 'Slim detox', 15.00, 15.00, 20.00, -1.50, 10, 2800.00),
(5, 'Masse clean', 35.00, 10.00, 20.00, 2.50, 14, 6000.00);

INSERT INTO code_rechargement (code, montant, status) VALUES
('PROMO2026A', 1000.00, 'valide'),
('PROMO2026B', 1500.00, 'valide'),
('PROMO2026C', 2000.00, 'valide'),
('WELCOME01', 5000.00, 'valide'),
('WELCOME02', 5000.00, 'valide'),
('WELCOME03', 5000.00, 'valide'),
('GOLD2026', 2500.00, 'valide'),
('SILVER2026', 1200.50, 'valide'),
('BRONZE2026', 8000.75, 'valide'),
('BONUS100', 30000.00, 'valide'),
('BONUS200', 5000.00, 'valide'),
('SUMMER001', 1500.50, 'valide'),
('SUMMER002', 15000.50, 'valide'),
('SUMMER003', 1500.50, 'valide'),
('SPRING001', 1000.25, 'valide');

INSERT INTO activite_sportive (id, nom, variation_poids, duree) VALUES
(1, 'Course a pied', -0.50, 2),
(2, 'HIIT', -0.60, 1),
(3, 'Natation', -0.40, 2),
(4, 'Musculation', 0.30, 1),
(5, 'Marche rapide', -0.20, 1);