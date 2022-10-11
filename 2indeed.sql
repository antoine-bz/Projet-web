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
  `rep` varchar(3),
  `message` varchar(255)
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

#SECTEUR
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Vente matériel informatique', 'Informatique', 'Vente');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Marketing', 'Se spécialiser dans le commerce', 'Se mettre au service des besoins commerciaux');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Hôtellerie et restauration', 'Contacts avec la clientèle', 'Gastronomie');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Éducation', 'Participer au développement global', 'Enseigner, transmettre et écouter');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Mode', 'Créer des vêtements', 'Vendre les tendances');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Automobile', 'Réparation', 'Vente');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Industrie automobile', 'industrie', 'automobile');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, "Vente d'ameublement et décoration", 'vente', 'decoration');
INSERT INTO `secteur` (`idSecteur`, `nom`, `interet1`, `interet2`) VALUES (NULL, 'Vente produits agroalimentaire', 'Vente', 'Nourriture');

#ETUDIANTS
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`, `CV`, `recherche`) VALUES (NULL, 'Antoine', 'Boez', 'Lens 62300', '0652191780', '19', NULL, NULL);
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`, `CV`, `recherche`) VALUES (NULL, 'Romain', 'Notteau', 'Lens 62300', '0788620222', '19', NULL, NULL);
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`, `CV`, `recherche`) VALUES (NULL, 'Hugo', 'Chopard', '15 Rue Royale 59000 Lille', '0745237895', '18', NULL, NULL);
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`, `CV`, `recherche`) VALUES (NULL, 'Nicolas', 'Fryczka', '2 Pl. du Général Leclerc 59530 Le Quesnoy', '0689234576', '19', NULL, NULL);
INSERT INTO `etudiants` (`idEtudiants`, `prenom`, `nom`, `adresse`, `telephone`, `age`, `CV`, `recherche`) VALUES (NULL, 'Khouloud', 'Bargach', 'Lens 62300', '0611292020', '19', NULL, '1');

#ENTREPRISE
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'LDLC', '1', 'Hénin-Beaumont', '0366980460');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, "McDonald's", '3', 'Rue Maurice Fréchet 62300 Lens', '0321780821');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'H&M ', '5', '15 Bd Emile Basly 62300 Lens', '0805088888');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'Usine Renault de Douai', '7', 'Douai 59500', '0352789045');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'IKEA Hénin-Beaumont', '8', 'Hénin-Beaumont 62110', '0969362006');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'Heineken Lille', '9', 'Lille 59160', '0320336700');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'Carrefour', '9', '62210 Avion', '0658451235');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'Home Sweet Mode', '8', '62950 Noyelles-Godault', '0421596834');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, 'Transdev Artois Gohelle', '2', 'Marseille', '0448219535');
INSERT INTO `entreprises` (`idEntreprises`, `nom`, `idSecteur`, `adresse`, `telephone`) VALUES (NULL, "L'Oreal", '7', 'Aulnay-sous-Bois (93)', '0614281964');

#CONNEXION
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, NULL, '1', 'ldlc@gmail.com', 'ldlctropbien');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, '1', NULL, 'antoine.boez@gmail.com', 'antoine1234');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, '2', NULL, 'romain.notteau@hotmail.com', 'romain1234');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, '3', NULL, 'hugo@gmail.com', 'hugo1234', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, '4', NULL, 'nicolas@gmail.com', 'nicolas1234', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, NULL, '2', 'mcdo@gmail.com', 'mcdoctropbon', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, NULL, '3', 'hm@hotmail.fr', 'hmvente', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, NULL, '4', 'renaultdouai@hotmail.fr', 'renaultvoiture', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`) VALUES (NULL, '5', NULL, 'khouloud.bargach@gmail.com', 'khouloud1234');
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, NULL, '5', 'ikea@gmail.com', 'ikea1234', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, NULL, '6', 'heineken@gmail.com', 'heineken1234', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, NULL, '8', 'homesweet@gmail.com', 'homesweet1234', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, NULL, '7', 'carrefour@gmail.com', 'carrefour1234', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, NULL, '10', 'oreal@gmail.com', 'oreal1234', NULL);
INSERT INTO `connexion` (`idConnexion`, `idEtudiants`, `idEntreprises`, `mail`, `password`, `admin`) VALUES (NULL, NULL, '9', 'transdev@gmail.com', 'transdev1234', NULL);




#ANNONCES
INSERT INTO annonces (idAnnonces, nom, idEntreprises, remuneration, date, duree, type, description) VALUES (NULL, 'Vente de matériel informatique', '1', 'Oui', '2019-09-18', '2', 'Ouvrier', 'Vendeur de matériel informatique');
INSERT INTO annonces (idAnnonces, nom, idEntreprises, remuneration, date, duree, type, description) VALUES (NULL, 'Configuration de pc', '1', 'non', '2022-04-06', '3', 'Ouvrier', 'Réaliser des configurations de PC sur demande');
INSERT INTO annonces (idAnnonces, nom, idEntreprises, remuneration, date, duree, type, description) VALUES (NULL, 'Apprenti pole informatique', '4', '1', '2022-03-08', '12', 'Apprentissage', NULL);
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Manager', '2', '1', '2022-05-12', '5', 'Apprentissage', 'Prenez conscience du fonctionnement global d’un restaurant et approfondissez votre sens des responsabilités afin gagner en diplomatie en maintenant et en encourageant les différentes personnes.');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Vente de vêtements', '3', '1', '2022-04-03', '2', 'Apprentissage', 'Vente de vêtements dans un de nos magasins H&M.');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Employé Logistique F/H', '5', '0', '2022-05-09', '1', 'libre', 'We’re the team behind the scenes that make the IKEA products available to the many people. If you’ve wonder who’s responsible for finding effective and efficient ways of picking up the products for our customers, that’s us. We’re passionate about working together to improve the customer experience at IKEA!');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'STAGE Ingénieur Performance Energies H/F', '6', '1', '2022-05-13', '6','Ingenieur Bac+4/5', "Intégré(e) à l'équipe Fabrication/Utilités et rattaché(e) au Responsable Centrale des Fluides, l'ingénieur(e) Energie aura pour principale mission de participer à la réduction des consommations eau et énergie de la brasserie.");
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Responsable de Service Vente F/H', '5', '1', '2022-04-19', '36', 'Alternance', 'Tu vois les choses un peu différemment ? Ça tombe bien nous aussi !?Au-delà d’un diplôme, tu es à la recherche d’une expérience professionnelle unique dans un environnement dynamique qui favorise la découverte et le développement ?\r\nViens apprendre un métier et t’épanouir dans une équipe où chacun est bienvenu.'); 
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, "Architecte d'intérieur F/H", '5', '1', '2022-03-09', NULL, 'Alternance', "Là où les autres voient des articles d'ameublement, nous voyons des solutions astucieuses permettant d'améliorer la vie quotidienne. Nous transformons les couleurs, les textiles et les meubles en ambiances inspirantes qui enthousiasment, attirent et convainquent les visiteurs des magasins IKEA qu'ils peuvent reproduire la même chose chez eux.");
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Alternance - Vendeur F/H', '5', '1', '2022-05-23', '6', 'Alternance', 'Tu vois les choses un peu différemment ? Ça tombe bien nous aussi !?Au-delà d’un diplôme, tu es à la recherche d’une expérience professionnelle unique dans un environnement dynamique qui favorise la découverte et le développement ?');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Employé commercial PVP (H/F) CQP en alternance', '7', '1', '2022-05-18', '12', 'Alternance', 'Près de 5400 magasins au plus près de nos clients, un site marchand et des services connectés pour répondre à tous les modes de consommation et des collaborateurs mobilisés pour rendre accessible, partout, une alimentation de qualité à un prix raisonnable…');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Vendeur en alternance H/F', '8', '1', '2022-05-28', '6', 'Alternance', "Nous sommes à la recherche d\'un alternant en tant que vendeur/euse pour notre magasin de Noyelles-Godault pour l'enseigne HOME SWEET MODE qui mêle décoration et prêt à porter sur 700m2.");
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'STAGIAIRE CHEF DE PRODUIT H/F', '9', '1', '2022-04-27', '4', 'libre', 'Vous intègrerez la Direction Commerciale et l’assisterez dans la commercialisation de la marque et de ses produits. Vous participerez ainsi à la définition et la mise en œuvre de la stratégie de segmentation, notamment à destination des publics jeunes.');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, "Stage Energie/Environnement - L'Oréal For The Future - S1 2022", '10', '1', '2022-05-12', '1', 'Ouvrier', "Charles commence la journée par une réunion avec une entreprise de panneaux solaires, car il aimerait en installer sur le toit de l\'un de nos sites. A la fin de la réunion, il continue à travailler sur le bilan carbone. Bonne nouvelle, les objectifs du programme L\'Oréal For the Future sont atteints!");
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'COMPTABLE EN ALTERNANCE H/F', '2', '1', '2022-03-15', '8', 'Alternance', 'Gestion comptable : Gestion des flux bancaires, suivi des factures et des encaissements, suivi des écarts de caisse, contrôle des rapports mensuels, suivi des contrats. Lettrage de comptes fournisseurs et clients.');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Stagiaire Ingénieur Process Production (H/F)', '3', '1', '2022-06-02', '6', 'Ingenieur Bac+4/5', 'H&M recherche un(e) stagiaire pour les ateliers Process Nettoyage de semences basé(e) sur le site de Portes les Valence (26).');
INSERT INTO `annonces` (`idAnnonces`, `nom`, `idEntreprises`, `remuneration`, `date`, `duree`, `type`, `description`) VALUES (NULL, 'Assistant Responsable du Développement des Ventes B2C', '7', '1', '2022-06-01', '9', 'Alternance', 'Créateur de l’hypermarché et pionnier de la consommation de masse, Carrefour reste fidèle à ses racines mais se réinvente pour permettre à chacun, chaque jour, de manger mieux : plus sain, plus local, plus responsable.');

#FAVORIS
INSERT INTO `favoris` (`idEtudiants`, `idAnnonces`) VALUES ('1', '3'),('2', '4'),('1', '5'),('5', '6'),('5', '7');

#reponses
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('1', '9', '1', 'yes');
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('2', '2', '1', NULL);
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('3', '4', '1', 'no');
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('4', '7', '5', NULL);
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('5', '2', '5', 'yes');
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('6', '1', '5', 'no');
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('7', '9', '2', 'no');
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('8', '4', '2', 'yes');
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('9', '8', '2', NULL);
INSERT INTO reponses (idRep, idAnnonces, idEtudiants, rep) VALUES ('10', '4', '3', NULL);