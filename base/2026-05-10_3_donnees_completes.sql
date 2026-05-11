USE regime;

INSERT INTO admin (id, nom, password) VALUES
(1, 'admin', '$2y$12$qB0tMxe4YvZ8hF47Q7anFu6xU905hgzcUIFW.Pyq0Wi1shS9PWb/m');

INSERT INTO utilisateur (id, nom, email, mot_de_passe, date_inscription, genre, gold) VALUES
(1, 'admin', 'admin@s4plus.local', '$2y$12$qB0tMxe4YvZ8hF47Q7anFu6xU905hgzcUIFW.Pyq0Wi1shS9PWb/m', '2026-05-01 08:00:00', 'Homme', 0),
(2, 'amina', 'amina@s4plus.local', '$2y$12$O8FFxT2JFIy88Nub6EtHwOe2vDc7pPb1F6o8.JCa5j5A/xDXgB8Sa', '2026-05-02 09:12:00', 'Femme', 1),
(3, 'yassine', 'yassine@s4plus.local', '$2y$12$L5mHAhKITOkbi1DWlhuKzu9uJ16kMFPTxh0txUqAzjkpMvnjC7IFK', '2026-05-03 10:24:00', 'Homme', 0),
(4, 'fatou', 'fatou@s4plus.local', '$2y$12$Vzi/LL0WF4UthJfsWfFMfOReVu0DPo9yjMTitcghmJEsY8PGm5deS', '2026-05-04 11:36:00', 'Femme', 0),
(5, 'mohamed', 'mohamed@s4plus.local', '$2y$12$FcJJpU7XU9kyvjfD68M8wenbOPmSuj944wzQWe9CleOPjtYSEWXoe', '2026-05-05 12:48:00', 'Homme', 0);

INSERT INTO sante_utilisateur (id, id_utilisateur, taille, poids, date_mesure) VALUES
(1, 2, 165.00, 62.00, '2026-05-04 08:00:00'),
(2, 3, 180.00, 84.00, '2026-05-04 09:00:00'),
(3, 4, 170.00, 70.00, '2026-05-05 08:15:00'),
(4, 5, 172.00, 76.00, '2026-05-05 09:20:00'),
(5, 2, 165.00, 61.50, '2026-05-06 08:05:00'),
(6, 3, 180.00, 83.50, '2026-05-06 09:10:00'),
(7, 4, 170.00, 69.50, '2026-05-07 08:25:00'),
(8, 5, 172.00, 75.50, '2026-05-07 09:30:00'),
(9, 2, 165.00, 61.00, '2026-05-08 08:40:00'),
(10, 3, 180.00, 83.00, '2026-05-09 09:45:00'),
(11, 4, 170.00, 69.00, '2026-05-10 08:50:00'),
(12, 5, 172.00, 75.00, '2026-05-10 10:00:00');

INSERT INTO utilisateur_objectif (id, id_utilisateur, id_objectif, date_choix, poids) VALUES
(1, 2, 3, '2026-05-02 12:00:00', 62.00),
(2, 3, 2, '2026-05-03 12:15:00', 84.00),
(3, 4, 1, '2026-05-04 12:30:00', 70.00),
(4, 5, 2, '2026-05-05 12:45:00', 76.00);

INSERT INTO regime (id, nom, pourcentage_viande, pourcentage_poisson, pourcentage_volaille, variation_poids, duree_jour, prix) VALUES
(1, 'Keto strict', 25.00, 5.00, 10.00, -2.00, 7, 35000.00),
(2, 'Hyperproteine', 30.00, 5.00, 15.00, -3.00, 14, 50000.00),
(3, 'Equilibre leger', 10.00, 10.00, 10.00, -1.00, 7, 15000.00),
(4, 'Slim detox', 15.00, 15.00, 20.00, -1.50, 10, 28000.00),
(5, 'Masse clean', 35.00, 10.00, 20.00, 2.50, 14, 60000.00);

INSERT INTO regime_objectif (id, id_regime, id_objectif) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 3),
(4, 4, 2),
(5, 5, 1);

INSERT INTO activite_sportive (id, nom, variation_poids, duree) VALUES
(1, 'Course a pied', -0.50, 2),
(2, 'HIIT', -0.60, 1),
(3, 'Natation', -0.40, 2),
(4, 'Musculation', 0.30, 1),
(5, 'Marche rapide', -0.20, 1);

INSERT INTO activite_objectif (id, id_activite, id_objectif) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 3),
(4, 4, 1),
(5, 5, 2);

INSERT INTO portefeuille (id, id_utilisateur, solde) VALUES
(1, 1, 0.00),
(2, 2, 85.00),
(3, 3, 25.00),
(4, 4, 15.00),
(5, 5, 40.00);

INSERT INTO code_rechargement (id, code, montant, status) VALUES
(1, 'PROMO2026A', 10.00, 'utilise'),
(2, 'PROMO2026B', 15.00, 'utilise'),
(3, 'PROMO2026C', 20.00, 'utilise'),
(4, 'WELCOME01', 5.00, 'valide'),
(5, 'WELCOME02', 5.00, 'valide'),
(6, 'GOLD2026', 25.00, 'utilise'),
(7, 'SUMMER001', 15.50, 'valide'),
(8, 'SPRING001', 10.25, 'valide');

INSERT INTO rechargement (id, id_portefeuille, id_code, date_rechargement) VALUES
(1, 2, 1, '2026-05-03 14:00:00'),
(2, 2, 2, '2026-05-06 16:20:00'),
(3, 3, 3, '2026-05-07 09:05:00'),
(4, 5, 6, '2026-05-09 18:10:00');

INSERT INTO achat_regime (id, id_utilisateur, id_regime, prix_paye, date_achat) VALUES
(1, 2, 1, 29750.00, '2026-05-03 15:00:00'),
(2, 2, 3, 12750.00, '2026-05-06 18:00:00'),
(3, 3, 2, 50000.00, '2026-05-04 10:30:00'),
(4, 3, 4, 28000.00, '2026-05-07 11:10:00'),
(5, 4, 3, 15000.00, '2026-05-05 12:40:00'),
(6, 4, 5, 60000.00, '2026-05-10 13:15:00'),
(7, 5, 2, 42500.00, '2026-05-08 14:25:00'),
(8, 5, 4, 23800.00, '2026-05-09 09:55:00'),
(9, 2, 4, 23800.00, '2026-05-10 15:30:00'),
(10, 3, 1, 29750.00, '2026-05-10 16:45:00');
