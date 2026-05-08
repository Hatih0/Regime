use regime;

ALTER TABLE utilisateur ADD COLUMN email VARCHAR(255) UNIQUE;
ALTER TABLE utilisateur_objectif ADD COLUMN poids DECIMAL(5,2);