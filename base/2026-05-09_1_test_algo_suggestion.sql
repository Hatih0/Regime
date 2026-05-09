TRUNCATE TABLE regime RESTART IDENTITY CASCADE;
INSERT INTO regime (nom, pourcentage_viande, pourcentage_poisson, pourcentage_volaille,
                    variation_poids, duree_jour, prix) VALUES
('Keto strict',     25.00,  5.00, 10.00, -2.00,  7, 35000.00),
('Hyperprotéiné',   30.00,  5.00, 15.00, -3.00, 14, 50000.00),
('Équilibré léger', 10.00, 10.00, 10.00, -1.00,  7, 15000.00);

-- Activités : variation_poids [kg/séance/jour], duree [heures par séance]
-- contribution journalière = variation_poids  (UNE séance par jour)
-- intensité                = abs(variation_poids / duree)  [kg/h]
TRUNCATE TABLE activite_sportive RESTART IDENTITY CASCADE;
INSERT INTO activite_sportive (nom, variation_poids, duree) VALUES
('Course à pied', -0.50, 2),   -- intensité : 0.50/2 = 0.25 kg/h
('HIIT',          -0.60, 1),   -- intensité : 0.60/1 = 0.60 kg/h
('Natation',      -0.40, 2);   -- intensité : 0.40/2 = 0.20 kg/h

