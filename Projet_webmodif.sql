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
  `telephone` varchar(255),
  `logo` varchar(255)
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
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Industrie automobile', 'industrie', 'automobile');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, "Vente d'ameublement et décoration", 'vente', 'decoration');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Vente produits agroalimentaire', 'Vente', 'Nourriture');
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`) VALUES (NULL, 'Antoine', 'Boez', 'Lens 62300', '0652191780', '19');
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`) VALUES (NULL, 'Romain', 'Notteau', 'Lens 62300', '0788620222', '19');
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`, `CV`, `recherche`) VALUES (NULL, 'Khouloud', 'Bargach', 'Lens 62300', '0611292020', '19', NULL, '1');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'LDLC', '1', 'Hénin-Beaumont', '0366980460');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'Usine Renault Douai', '2', 'Douai 59500', '0176839393');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'IKEA Hénin-Beaumont', '2', 'Hénin-Beaumont 62110', '0969362006');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'Heineken Lille', '4', 'Lille 59160', '0320336700');

INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, NULL, '1', 'ldlc@gmail.com', 'ldlctropbien');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, '1', NULL, 'antoine.boez@gmail.com', 'antoine1234');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, '2', NULL, 'romain.notteau@hotmail.com', 'romain1234');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, '3', NULL, 'khouloud.bargach@gmail.com', 'khouloud1234');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Vente de matériel informatique', '1', 'Oui', '2019-09-18', '2', 'ouvrier', 'Vendeur de matériel informatique');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Configuration de pc', '1', 'non', '2022-04-06', '3', 'ouvrier', 'faire des configurations d ordinateurs sur demande');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Apprenti pole informatique', '2', '1', '2022-03-08', '12', 'APPRENTISSAGE', NULL); 
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Employé Logistique F/H', '3', '0', '2022-05-09', '1', 'libre', 'We’re the team behind the scenes that make the IKEA products available to the many people. If you’ve wonder who’s responsible for finding effective and efficient ways of picking up the products for our customers, that’s us. We’re passionate about working together to improve the customer experience at IKEA!');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'STAGE Ingénieur Performance Energies H/F', '4', '1', '2022-05-13', '6','Ingenieur Bac+4/5', "Intégré(e) à l'équipe Fabrication/Utilités et rattaché(e) au Responsable Centrale des Fluides, l'ingénieur(e) Energie aura pour principale mission de participer à la réduction des consommations eau et énergie de la brasserie.");
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Responsable de Service Vente F/H', '3', '1', '2022-04-19', '36', 'Alternance', 'Tu vois les choses un peu différemment ? Ça tombe bien nous aussi !?Au-delà d’un diplôme, tu es à la recherche d’une expérience professionnelle unique dans un environnement dynamique qui favorise la découverte et le développement ?\r\nViens apprendre un métier et t’épanouir dans une équipe où chacun est bienvenu.'); 
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, "Architecte d'intérieur F/H", '3', '1', '2022-03-09', NULL, 'Alternance', "Là où les autres voient des articles d'ameublement, nous voyons des solutions astucieuses permettant d'améliorer la vie quotidienne. Nous transformons les couleurs, les textiles et les meubles en ambiances inspirantes qui enthousiasment, attirent et convainquent les visiteurs des magasins IKEA qu'ils peuvent reproduire la même chose chez eux.");
