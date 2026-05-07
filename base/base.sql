CREATE DATABASE IF NOT EXISTS regime;

use regime;

CREATE TABLE utilisateur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    mot_de_passe VARCHAR(255),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    genre ENUM('Homme', 'Femme', 'Autre'),
    gold BOOLEAN DEFAULT FALSE
);

CREATE TABLE sante_utilisateur (
    id SERIAL PRIMARY KEY,
    id_utilisateur INT REFERENCES utilisateur(id),
    taille DECIMAL(5,2),
    poids DECIMAL(5,2),
    date_mesure TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE objectif (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100)
);

INSERT INTO objectif(nom) VALUES
('Augmenter poids'),
('Reduire poids'),
('Atteindre IMC ideal');

CREATE TABLE utilisateur_objectif (
    id SERIAL PRIMARY KEY,
    id_utilisateur INT REFERENCES utilisateur(id),
    id_objectif INT REFERENCES objectif(id),
    date_choix TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE regime (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    pourcentage_viande DECIMAL(5,2),
    pourcentage_poisson DECIMAL(5,2),
    pourcentage_volaille DECIMAL(5,2),
    variation_poids DECIMAL(5,2),
    duree_jour INT,
    prix DECIMAL(10,2)
);

CREATE TABLE regime_objectif (
    id SERIAL PRIMARY KEY,
    id_regime INT REFERENCES regime(id),
    id_objectif INT REFERENCES objectif(id)
);

CREATE TABLE activite_sportive (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    variation_poids DECIMAL(10,2),
    duree INT
);

CREATE TABLE activite_objectif (
    id SERIAL PRIMARY KEY,
    id_activite INT REFERENCES activite_sportive(id),
    id_objectif INT REFERENCES objectif(id)
);

CREATE TABLE portefeuille (
    id SERIAL PRIMARY KEY,
    id_utilisateur INT REFERENCES utilisateur(id),
    solde DECIMAL(10,2) DEFAULT 0
);

CREATE TABLE code_rechargement (
    id SERIAL PRIMARY KEY,
    code VARCHAR(100) UNIQUE,
    montant DECIMAL(10,2),
    status ENUM('valide', 'utilise') DEFAULT 'valide'
);

CREATE TABLE rechargement (
    id SERIAL PRIMARY KEY,
    id_portefeuille INT REFERENCES portefeuille(id),
    id_code INT REFERENCES code_rechargement(id),
    date_rechargement TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE achat_regime (
    id SERIAL PRIMARY KEY,
    id_utilisateur INT REFERENCES utilisateur(id),
    id_regime INT REFERENCES regime(id),
    prix_paye DECIMAL(10,2),
    date_achat TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
