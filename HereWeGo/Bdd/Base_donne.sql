--mysql -h mysql.etu.umontpellier.fr -u e20220000271 -p
--Entrer le password (Emma16)
--si show databases; montre les bases de données
--use e20220000271;
--source createTableProjet.sql;

CREATE DATABASE herewego;

CREATE TABLE IF NOT EXISTS Internautes ( 
    email VARCHAR(50) NOT NULL , 
    motDePasse VARCHAR(20) NOT NULL , 
    nom VARCHAR(30) NOT NULL ,
    prenom VARCHAR(12) NOT NULL , 
    telephone VARCHAR(12) NULL , 
    PRIMARY KEY (email)) ENGINE = InnoDB;

INSERT INTO Internautes (email, motDePasse, nom, prenom, telephone) 
VALUES ('martin.dupond@gmail.com', 'martin', 'Dupond', 'Martin', '0626231548');
INSERT INTO Internautes (email, motDePasse, nom, prenom, telephone)
VALUES ('bernard.lebreton@gmail.com', 'bernard', 'Lebreton','Bernard', '0656784898');
INSERT INTO Internautes (email, motDePasse, nom, prenom, telephone)
VALUES ('etienne.garbadin@gmail.com', 'etienne', 'Garbadin', 'Etienne', '0610203014');
INSERT INTO Internautes (email, motDePasse, nom, prenom, telephone)
VALUES ('robert.lefevre@gmail.com', 'robert', 'Lefevre', 'Robert', '0612134679');
commit;

CREATE TABLE Trajets ( 
    idTrajet INT NOT NULL AUTO_INCREMENT , 
    villeDepart VARCHAR(40) NOT NULL , 
    villeArrivee VARCHAR(40) NOT NULL , 
    prixRecommande TINYINT NOT NULL , 
    PRIMARY KEY (idTrajet)) ENGINE = InnoDB;

INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Paris', 'Montpellier', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nice', 'Paris', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nantes', 'Strasbourg', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Paris', 'Nantes', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Lille', 'Montpellier', 80);

--Rajout de tous les trajets possibles :
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Paris', 'Nice', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Paris', 'Strasbourg', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Paris', 'Lille', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Montpellier', 'Paris', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Montpellier', 'Nice', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Montpellier', 'Nantes', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Montpellier', 'Lille', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Montpellier', 'Strasbourg', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nice', 'Montpellier', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nice', 'Nantes', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nice', 'Strasbourg', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nice', 'Lille', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nantes', 'Paris', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nantes', 'Montpellier', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nantes', 'Nice', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Nantes', 'Lille', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Strasbourg', 'Paris', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Strasbourg', 'Montpellier', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Strasbourg', 'Nice', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Strasbourg', 'Nantes', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Strasbourg', 'Lille', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Lille', 'Paris', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Lille', 'Nice', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Lille', 'Nantes', 80);
INSERT INTO Trajets (villeDepart, villeArrivee, prixRecommande) 
VALUES ('Lille', 'Strasbourg', 80);
commit;

--modification de dates INT en date type DATE :
CREATE TABLE IF NOT EXISTS Covoiturages (
    idCovoiturage INT NOT NULL AUTO_INCREMENT , 
    idTrajet INT NOT NULL , 
    dates DATE NOT NULL , 
    email VARCHAR(50) NOT NULL , 
    nbPlaces TINYINT NOT NULL , 
    PRIMARY KEY (idCovoiturage),
    CONSTRAINT FK_idTrajet FOREIGN KEY (idTrajet) REFERENCES Trajets(idTrajet), 
    CONSTRAINT FK_email FOREIGN KEY (email) REFERENCES Internautes(email)
);

--Insertion d'un covoiturage possible avec Robert, Paris-Montpellier, le 221220, 4 places)
INSERT INTO covoiturages (idCovoiturage, idTrajet, dates, email, nbPlaces) 
VALUES (NULL, '1', '2022-12-20', 'robert.lefevre@gmail.com', '4');
INSERT INTO covoiturages (idCovoiturage, idTrajet, dates, email, nbPlaces) 
VALUES (NULL, '1', '2022-12-20', 'etienne.garbadin@gmail.com', '4');
INSERT INTO covoiturages (idCovoiturage, idTrajet, dates, email, nbPlaces) 
VALUES (NULL, '2', '2022-12-25', 'martin.dupond@gmail.com', '4');
commit;



--ATTENTION, il y avait le même nom de clé étrangère pour email = erreur !!!!
CREATE TABLE Transports (
    idTransport INT NOT NULL AUTO_INCREMENT,
    idCovoiturage INT NOT NULL,
    email VARCHAR(50) NOT NULL,
    PRIMARY KEY(idTransport),
    CONSTRAINT FK_idCovoiturage FOREIGN KEY (idCovoiturage) REFERENCES Covoiturages(idCovoiturage),
    CONSTRAINT FK_emailTransport FOREIGN KEY (email) REFERENCES Internautes(email));

INSERT INTO Transports (idCovoiturage, email) 
VALUES (1, 'martin.dupond@gmail.com');
commit;

