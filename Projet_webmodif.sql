#CREATION DES TABLES
CREATE TABLE `etudiants` (
  `idEtudiants` int PRIMARY KEY AUTO_INCREMENT,
  `prenom` varchar(255),
  `nom` varchar(255),
  `adresse` varchar(255),
  `telephone` varchar(255),
  `age` int,
  `CV` varchar(255),
  `recherche` boolean
);

CREATE TABLE `entreprises` (
  `idEntreprises` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255),
  `idSecteur` int,
  `adresse` varchar(255),
  `telephone` varchar(255)
);

CREATE TABLE `favoris` (
  `idEtudiants` int,
  `idAnnonces` int
);

CREATE TABLE `annonces` (
  `idAnnonces` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255),
  `idEntreprises` int,
  `remuneration` boolean,
  `date` date,
  `duree` int,
  `type` varchar(255),
  `description` varchar(255)
);

CREATE TABLE `connexion` (
  `idConnexion` int PRIMARY KEY AUTO_INCREMENT,
  `idEtudiants` int,
  `idEntreprises` int,
  `mail` varchar(255),
  `password` varchar(255),
  `admin` int
);

CREATE TABLE `secteur` (
  `idSecteur` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255),
  `interet1` varchar(255),
  `interet2` varchar(255)
);

CREATE TABLE `reponses` (
  `idRep` int PRIMARY KEY AUTO_INCREMENT,
  `idAnnonces` int,
  `idEtudiants` int,
  `rep` varchar(255)
);


#LIAISONS TABLE
ALTER TABLE `favoris` ADD FOREIGN KEY (`idEtudiants`) REFERENCES `etudiants` (`idEtudiants`);

ALTER TABLE `favoris` ADD FOREIGN KEY (`idAnnonces`) REFERENCES `annonces` (`idAnnonces`);

ALTER TABLE `reponses` ADD FOREIGN KEY (`idEtudiants`) REFERENCES `etudiants` (`idEtudiants`);

ALTER TABLE `annonces` ADD FOREIGN KEY (`idEntreprises`) REFERENCES `entreprises` (`idEntreprises`);

ALTER TABLE `reponses` ADD FOREIGN KEY (`idAnnonces`) REFERENCES `annonces` (`idAnnonces`);

ALTER TABLE `entreprises` ADD FOREIGN KEY (`idSecteur`) REFERENCES `secteur` (`idSecteur`);

ALTER TABLE `connexion` ADD FOREIGN KEY (`idEtudiants`) REFERENCES `etudiants` (`idEtudiants`);

ALTER TABLE `connexion` ADD FOREIGN KEY (`idEntreprises`) REFERENCES `entreprises` (`idEntreprises`);


#DONNEES TABLES
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Vente matériel informatique', 'Informatique', 'Vente');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'industrie automobile', 'industrie', 'automobile');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, "vente d'ameublement et décoration", 'vente', 'decoration');
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`) VALUES (NULL, 'Antoine', 'Boez', 'Lens 62300', '0652191780', '19');
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`) VALUES (NULL, 'Romain', 'Notteau', 'Lens 62300', '0788620222', '19');
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`, `CV`, `recherche`) VALUES (NULL, 'khouloud', 'bargach\r\n', 'Lens 62300', '0611292020', '19', NULL, '1');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'LDLC', '1', 'Hénin-Beaumont', '0366980460');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'Usine Renault Douai', '2', 'Douai 59500', '0176839393');

INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, NULL, '1', 'ldlc@gmail.com', 'ldlctropbien');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, '1', NULL, 'antoine.boez@gmail.com', 'antoine1234');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, '2', NULL, 'romain.notteau@hotmail.com', 'romain1234');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, '3', NULL, 'khouloud.bargach@gmail.com', 'khouloud1234');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Vente de matériel informatique', '1', 'Oui', '2019-09-18', '2', 'ourvrier', 'Vendeur de matériel informatique');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Configuration de pc', '1', 'non', '2022-04-06', '3', 'ouvrier', 'faire des configurations d ordinateurs sur demande');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Apprenti pole informatique', '2', '1', '2022-03-08', '12', 'APPRENTISSAGE', NULL); 

