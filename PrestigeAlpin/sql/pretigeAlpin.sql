DROP DATABASE IF EXISTS prestigeAlpin;
CREATE DATABASE prestigeAlpin;
USE prestigeAlpin;

-- Table user
CREATE TABLE user (
    id_user INT(10) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(50),
    mdp VARCHAR(50),
    adresse VARCHAR(50),
    telephone CHAR(12),
    role ENUM('client', 'moniteur'),
    PRIMARY KEY (id_user)
);

-- Table client
CREATE TABLE client (
    id_user INT(10) NOT NULL,
    adresse_vac VARCHAR(50),
    code_postal VARCHAR(50),
    ville_vac VARCHAR(50),
    PRIMARY KEY (id_user),
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);

-- Table moniteur
CREATE TABLE moniteur (
    id_user INT(10) NOT NULL,
    cp CHAR(5),
    ville VARCHAR(50),
    date_debut DATE,
    PRIMARY KEY (id_user),
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);

-- Table materiel
CREATE TABLE materiel (
    id_materiel INT(10) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    marque VARCHAR(50),
    prix_loca FLOAT(6,2),
    stock_initial INT(4),
    etat_materiel VARCHAR(50),
    role ENUM('mat_neige', 'mat_rando'),
    PRIMARY KEY (id_materiel)
);

-- Table mat_neige
CREATE TABLE mat_neige (
    id_materiel INT(10) NOT NULL,
    longeur_skis FLOAT(6,2),
    type_fixation VARCHAR(50),
    niveau_usure VARCHAR(50),
    type_ski VARCHAR(50),
    PRIMARY KEY (id_materiel),
    FOREIGN KEY (id_materiel) REFERENCES materiel(id_materiel)
);

-- Table mat_rando
CREATE TABLE mat_rando (
    id_materiel INT(10) NOT NULL,
    taille_harnais FLOAT(6,2),
    type_corde VARCHAR(50),
    poids_max FLOAT(6,2),
    type_ancrage VARCHAR(50),
    niveau_regidite VARCHAR(30),
    PRIMARY KEY (id_materiel),
    FOREIGN KEY (id_materiel) REFERENCES materiel(id_materiel)
);

-- Table cours
CREATE TABLE cours (
    id_cours INT(10) NOT NULL AUTO_INCREMENT,
    nom_cours VARCHAR(50),
    description_cours VARCHAR(200),
    niveau_difficulte VARCHAR(100),
    date_cours DATE,
    duree_cours TIME,
    prix_cours FLOAT(6,2),
    nb_personne INT(2),
    PRIMARY KEY (id_cours)
);

-- Table reservation
CREATE TABLE reservation (
    id_resa INT(10) NOT NULL AUTO_INCREMENT,
    id_user INT(10) NOT NULL,
    id_materiel INT(10),
    id_cours INT(10),
    date_resa DATE,
    prix FLOAT(6,2),
    dateDebutLoc DATE,
    dateFinLoc DATE,
    etat_resa VARCHAR(50),
    PRIMARY KEY (id_resa),
    FOREIGN KEY (id_user) REFERENCES user(id_user),
    FOREIGN KEY (id_materiel) REFERENCES materiel(id_materiel),
    FOREIGN KEY (id_cours) REFERENCES cours(id_cours)
);

-- Table facture
CREATE TABLE facture (
    ref INT(10) NOT NULL AUTO_INCREMENT,
    datef DATE,
    etat VARCHAR(50),
    id_resa INT(10),
    PRIMARY KEY (ref),
    FOREIGN KEY (id_resa) REFERENCES reservation(id_resa)
);

-- Trigger pour l'insertion dans la table client
DROP TRIGGER IF EXISTS insert_client;
DELIMITER //
CREATE TRIGGER insert_client
BEFORE INSERT ON client
FOR EACH ROW
BEGIN
    if new.id_user is null or new.id_user in (select id_user from user) or new.id_user = 0
        then
            set new.id_user = ifnull((select id_user from user where id_user >= all(select id_user from user)), 0) + 1;
    end if;
    insert into user values (new.id_user, new.nom, new.prenom, new.email, new.mdp, new.adresse,new.telephone, new.role);
END //
DELIMITER ;

-- Trigger pour l'insertion dans la table moniteur
DROP TRIGGER IF EXISTS insert_moniteur;
DELIMITER //
CREATE TRIGGER insert_moniteur
BEFORE INSERT ON moniteur
FOR EACH ROW
BEGIN
    if new.id_user is null or new.id_user in (select id_user from user) or new.id_user = 0
        then
            set new.id_user = ifnull((select id_user from user where id_user >= all(select id_user from user)), 0) + 1;
    end if;
    insert into user values (new.id_user, new.nom, new.prenom, new.email, new.mdp, new.adresse,new.telephone, new.role);
END //
DELIMITER ;


-- exemple d''insertion

insert into user values 
(null, "alves", "helder", "helder@gmail.com", "123","rue victor hugo","0654344323","client"); 

insert into user values 
(null, "Leveque", "Vincent", "vincent@gmail.com", "123","rue victor hugo","0654344323","client"); 

INSERT INTO client VALUES (null, "alves","helder","helder2@gmail.com","123", "rue victor hugo",'75016','Paris','0654455676','rue du ski','18000','val disere','client');

INSERT INTO moniteur VALUES (null, "lulu","lolo","vincent2@gmail.com","555", "rue victor hugo",'75016','Paris','0654455676',curdate(),'moniteur');



-- Trigger pour l'insertion dans la table mat_neige
DROP TRIGGER IF EXISTS insert_mat_neige;
DELIMITER //
CREATE TRIGGER insert_mat_neige
BEFORE INSERT ON mat_neige
FOR EACH ROW
BEGIN
    if new.id_materiel is null or new.id_materiel in (select id_materiel from materiel) or new.id_materiel = 0
        then
            set new.id_materiel = ifnull((select id_materiel from materiel where id_materiel >= all(select id_materiel from materiel)), 0) + 1;
    end if;
    insert into materiel values (new.id_materiel, new.nom, new.marque, new.prix_loca, new.stock_initial, new.etat_materiel, new.role);
END //
DELIMITER ;


-- Trigger pour l'insertion dans la table mat_rando
DROP TRIGGER IF EXISTS insert_mat_rando;
DELIMITER //
CREATE TRIGGER insert_mat_rando
BEFORE INSERT ON mat_rando
FOR EACH ROW
BEGIN
    if new.id_materiel is null or new.id_materiel in (select id_materiel from materiel) or new.id_materiel = 0
        then
            set new.id_materiel = ifnull((select id_materiel from materiel where id_materiel >= all(select id_materiel from materiel)), 0) + 1;
    end if;
    insert into materiel values (new.id_materiel, new.nom, new.marque, new.prix_loca, new.stock_initial, new.etat_materiel, new.role);
END //
DELIMITER ;

-- exemple d''insertion
INSERT INTO mat_neige VALUES (null, 'le roi', 'nike',10.2, 50, 'Comme neuf', 30.6, 'forte', 'comme neuf','aerodrift','mat_neige');

INSERT INTO mat_rando VALUES (null, 'la reine', 'adidas', 10.2, 100, 'Comme neuf', 27.6, 'forte', 120.7, 'facile', 'super dur', 'mat_rando');


-- Insertion de matériel neige
INSERT INTO mat_neige (nom, marque, prix_loca, stock_initial, etat_materiel, longeur_skis, type_fixation, niveau_usure, type_ski, role) 
VALUES 
('Ski Rossignol Experience 88 Ti', 'Rossignol', 30.00, 10, 'neuf', 170.00, 'fixations classiques', 'faible', 'piste', 'mat_neige'),
('Snowboard Burton Custom X', 'Burton', 25.00, 8, 'usé', NULL, 'fixations spéciales', 'moyen', 'freestyle', 'mat_neige'),
('Ski Salomon QST 106', 'Salomon', 35.00, 12, 'bon', 160.00, 'fixations réglables', 'élevé', 'piste', 'mat_neige'),
('Snowboard Lib Tech T.Rice Pro', 'Lib Tech', 28.00, 6, 'neuf', NULL, 'fixations spéciales', 'négligeable', 'freeride', 'mat_neige'),
('Ski Atomic Vantage 90 Ti', 'Atomic', 32.00, 9, 'usé', 175.00, 'fixations classiques', 'moyen', 'piste', 'mat_neige'),
('Snowboard Ride Warpig', 'Ride', 29.00, 11, 'bon', NULL, 'fixations réglables', 'faible', 'freestyle', 'mat_neige'),
('Ski Fischer RC One 86 GT', 'Fischer', 26.00, 7, 'usé', 165.00, 'fixations classiques', 'élevé', 'piste', 'mat_neige'),
('Snowboard GNU Carbon Credit', 'GNU', 33.00, 10, 'neuf', NULL, 'fixations spéciales', 'négligeable', 'freestyle', 'mat_neige'),
('Ski Head Kore 93', 'Head', 27.00, 8, 'bon', 180.00, 'fixations réglables', 'moyen', 'freeride', 'mat_neige'),
('Snowboard Arbor Element', 'Arbor', 31.00, 9, 'usé', NULL, 'fixations classiques', 'faible', 'freeride', 'mat_neige');

-- Insertion de matériel rando
INSERT INTO mat_rando (nom, marque, prix_loca, stock_initial, etat_materiel, taille_harnais, type_corde, poids_max, type_ancrage, niveau_regidite, role) 
VALUES 
('Harnais Petzl', 'Petzl', 10.00, 15, 'neuf', 60.00, 'corde dynamique', 100.00, 'pitons', 'moyen', 'mat_rando'),
('Corde Beal', 'Beal', 8.00, 20, 'neuf', NULL, 'corde statique', 200.00, 'mousquetons', 'faible', 'mat_rando'),
('Harnais Black Diamond', 'Black Diamond', 12.00, 12, 'usé', 65.00, 'corde dynamique', 110.00, 'pitons', 'élevé', 'mat_rando'),
('Corde Mammut', 'Mammut', 9.00, 18, 'bon', NULL, 'corde dynamique', 180.00, 'mousquetons', 'moyen', 'mat_rando'),
('Harnais Singing Rock', 'Singing Rock', 11.00, 14, 'usé', 62.00, 'corde statique', 105.00, 'pitons', 'faible', 'mat_rando'),
('Corde Sterling', 'Sterling', 7.00, 22, 'neuf', NULL, 'corde statique', 190.00, 'mousquetons', 'élevé', 'mat_rando'),
('Harnais Edelrid', 'Edelrid', 13.00, 10, 'bon', 63.00, 'corde dynamique', 115.00, 'pitons', 'moyen', 'mat_rando'),
('Corde Petzl', 'Petzl', 6.00, 25, 'usé', NULL, 'corde dynamique', 170.00, 'mousquetons', 'faible', 'mat_rando'),
('Harnais Camp', 'Camp', 14.00, 9, 'neuf', 64.00, 'corde statique', 120.00, 'pitons', 'élevé', 'mat_rando'),
('Corde Metolius', 'Metolius', 5.00, 30, 'bon', NULL, 'corde dynamique', 160.00, 'mousquetons', 'moyen', 'mat_rando');


-- Insertion de cours
INSERT INTO cours VALUES (null, 'Ski', 'Dans ce cours, on apprend aux gens a skier', 'Facile', '2024-01-31', 15, 30.6, 3);

INSERT INTO cours (nom_cours, description_cours, niveau_difficulte, date_cours, duree_cours, prix_cours, nb_personne) VALUES
('Cours de Ski', 'Dans ce cours, on apprend aux gens à skier.', 'Facile', '2024-01-31', '15:00:00', 30.60, 3),
('Cours de Snowboard', 'Ce cours est conçu pour apprendre les bases du snowboard.', 'Moyen', '2024-02-15', '14:30:00', 35.50, 5),
('Cours de Patinage sur glace', 'Un cours amusant pour apprendre à patiner sur la glace.', 'Facile', '2024-02-20', '13:45:00', 25.75, 6),
('Cours de Raquette à neige', 'Découvrez les joies de la raquette à neige avec ce cours.', 'Facile', '2024-03-05', '12:00:00', 20.00, 8),
('Cours de Ski de fond', 'Ce cours vous apprendra les techniques de base du ski de fond.', 'Moyen', '2024-03-10', '14:00:00', 28.90, 4),
('Cours de Freestyle Ski', 'Un cours avancé pour maîtriser les sauts et les figures en ski.', 'Difficile', '2024-03-20', '16:00:00', 40.00, 2),
('Cours de Slalom Géant', 'Ce cours intensif vous prépare pour les compétitions de slalom.', 'Difficile', '2024-04-05', '17:30:00', 45.80, 3),
('Cours de Télémark', 'Apprenez l''art du télémark avec ce cours spécialisé.', 'Moyen', '2024-04-15', '13:45:00', 33.25, 4),
('Cours de Freeride', 'Un cours pour les amateurs de hors-piste et de descentes sauvages.', 'Difficile', '2024-05-01', '15:30:00', 37.50, 3),
('Cours de Ski Alpinisme', 'Découvrez l''alpinisme sur skis avec ce cours aventureux.', 'Difficile', '2024-05-10', '18:00:00', 50.00, 2);

-- Insertion de reservation
INSERT INTO reservation (date_resa, prix, dateDebutLoc, dateFinLoc, etat_resa) VALUES
('2024-03-01', 120.00, '2024-04-01', '2024-04-05', 'en attente'),
('2024-03-02', 150.50, '2024-04-10', '2024-04-15', 'confirmee'),
('2024-03-03', 200.75, '2024-05-01', '2024-05-10', 'en attente'),
('2024-03-04', 180.25, '2024-05-15', '2024-05-20', 'confirmee'),
('2024-03-05', 250.00, '2024-06-01', '2024-06-10', 'en attente'),
('2024-03-06', 175.00, '2024-06-15', '2024-06-20', 'confirmee'),
('2024-03-07', 300.00, '2024-07-01', '2024-07-10', 'en attente'),
('2024-03-08', 220.50, '2024-07-15', '2024-07-20', 'confirmee'),
('2024-03-09', 180.75, '2024-08-01', '2024-08-10', 'en attente'),
('2024-03-10', 210.25, '2024-08-15', '2024-08-20', 'confirmee');