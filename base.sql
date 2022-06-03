-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 03 juin 2022 à 11:06
-- Version du serveur :  10.3.34-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Mangaview`
--

-- --------------------------------------------------------

--
-- Structure de la table `collections`
--

CREATE TABLE `collections` (
  `uid` int(10) NOT NULL,
  `vid` int(10) NOT NULL,
  `fav` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `collections`
--

INSERT INTO `collections` (`uid`, `vid`, `fav`) VALUES
(1, 2, b'1'),
(1, 4, b'0'),
(1, 6, b'0'),
(2, 2, b'1'),
(2, 37, b'1'),
(3, 3, b'0'),
(3, 20, b'0');

-- --------------------------------------------------------

--
-- Structure de la table `comments_v`
--

CREATE TABLE `comments_v` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `vid` int(10) NOT NULL,
  `comment` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments_v`
--

INSERT INTO `comments_v` (`id`, `uid`, `vid`, `comment`) VALUES
(2, 1, 2, 'Super ce premier tome !!'),
(5, 2, 37, '[size=30] [color=blue] Un bon [/color]  petit manga  [color=red] francais [/color] [/size]\r\n\r\nPetit spoil : [spoiler] C\'est génial [/spoiler] '),
(6, 2, 37, '&lt;script&gt; alert(Essayons une injection ) &lt;/script&gt;');

-- --------------------------------------------------------

--
-- Structure de la table `comment_m`
--

CREATE TABLE `comment_m` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `mid` int(10) NOT NULL,
  `comment` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment_m`
--

INSERT INTO `comment_m` (`id`, `uid`, `mid`, `comment`) VALUES
(1, 1, 1, 'Spice And Wolf est probablement ma deuxième série préférée de tout les temps. C\'est le seul manga qui m\'a permis de me mettre dans les light novels et après-coup je ne suis pas déçu du tout.\r\n\r\nC’est une assez drole, le dialogue est réaliste. Il y\'a une vraie romance, pas juste \"je pense que je t\'aime\" \"moi aussi\". Il y a un développement incroyable avec tous les personnages principaux, pas de deus ex machina non plus. L’intrigue est très bien faite. Les dessins sont assez impressionnant aussi. C’est pourquoi je l’aime, du moins.');

-- --------------------------------------------------------

--
-- Structure de la table `comment_n`
--

CREATE TABLE `comment_n` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `nid` int(10) NOT NULL,
  `comment` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment_n`
--

INSERT INTO `comment_n` (`id`, `uid`, `nid`, `comment`) VALUES
(1, 2, 1, 'Trop hate de voir Ruka en live action.Même si j\'ai un peu peur du format drama >w<');

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`id`, `label`) VALUES
(-1, 'Blacklisté'),
(0, 'Utilisateur'),
(10, 'Reviewer'),
(20, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `mangas`
--

CREATE TABLE `mangas` (
  `id` int(10) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` smallint(6) DEFAULT NULL,
  `synopsis` varchar(1500) NOT NULL,
  `status` int(5) NOT NULL,
  `chapters` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mangas`
--

INSERT INTO `mangas` (`id`, `titre`, `banner`, `publisher`, `author`, `year`, `synopsis`, `status`, `chapters`) VALUES
(1, 'Spice and Wolf', 'spice_and_wolf.jpg', 'Ototo Manga', 'Isuna Hasekura', 2008, 'Jolie créature mi-femme mi-louve, Holo se retrouve délaissée par les paysans de son village, pour qui les vieilles légendes ne servent plus qu\'à effrayer les enfants. Oubliée des hommes, Holo ne se laisse pas abattre pour autant ! Au contraire, elle s\'en va découvrir le monde à bord de la carriole d\'un marchand itinérant, l\'énigmatique Lawrence Kraft...', 3, 108),
(2, 'Spy X Family', 'spy-x-family-manga-banner.jpg', 'Kurokawa', 'Tatsuya Endō', 2019, 'Twilight, le plus grand espion du monde, vient de recevoir une mission de la plus haute importance, nom de code : Opération STRIX.\r\nSon objectif : s’approcher de Donovan Desmond, le chef du parti « Nation Unifiée », afin d’enquêter sur ses projets politiques douteux.\r\nPour y parvenir, notre agent super secret doit fonder une famille de toute pièce afin de s’introduire dans l’école Eden : la plus prestigieuse école de toute l’aristocratie, dans laquelle étudie le fils de sa cible.\r\nTotalement dépourvu d’expérience familiale, Twilight adopte une petite fille dont il ignore tout des dons de télépathie, et s’associe à une jeune femme à l’allure timide : en réalité une redoutable tueuse à gage.\r\nCe trio hors du commun va devoir tout mettre en œuvre afin de ressembler à une famille unie et aimante… Il en va de la réussite de l’opération STRIX, et de l’avenir du pays tout entier.', 1, 61),
(3, 'L\'atelier des sorcières', 'Atelier_des_sorcieres_banner.jpg', 'Kodancha', 'Kamome Shirahama', 2016, 'Dans un monde fantastique, ceux qui manipulent la magie depuis la naissance sont des sorciers et seuls ces derniers peuvent la pratiquer.\r\n\r\nCoco, une jeune fille qui n\'est pas née sorcière mais qui est passionnée par la magie depuis son enfance et travaillant avec sa mère, rencontre pour la première fois un sorcier du nom de Kieffrey. Elle décide de l’espionner pour découvrir la nature de la magie ainsi que celui des sorciers.\r\n\r\nRedessinant un sort en cachette depuis un livre avec un encrier qu\'elle reçu d\'un individu capuchonné lors d\'un festival quand elle était petite et du fait de son ignorance, elle commet un acte tragique en pétrifiant sa mère par accident en la transformant en cristal. Kieffrey, qui la sauve in extremis, décide de la prendre sous son aile afin qu\'elle puisse sauver sa mère et découvrir le monde de la magie ainsi que des sorciers.', 1, 10),
(4, 'Blitz', 'Blitz-manga-banner.jpg', 'Iwa', 'Cédric Biscay', 2020, 'Tom, jeune collégien, a un coup de cœur pour la belle Harmony. Apprenant que celle- ci se passionne pour les échecs, il décide de s’inscrire au club du collège. Mais il n’en connaît pas les règles ! Il n’a donc pas le choix : il doit tout apprendre et s’entraîner sérieusement.\r\nTrès vite, il découvre l’existence de Garry Kasparov, le plus grand joueur de l’Histoire des échecs. Lors de ses recherches Tom tombe sur une machine de réalité virtuelle qui va lui permettre d’analyser les parties les plus mythiques du maître !\r\nUn événement inattendu va alors ouvrir à Tom les portes du très haut niveau des échecs, et ce malgré lui...\r\n', 1, 6),
(5, 'Evangelion - Perfect Edition', 'evangelion-manga-banner.jpg', 'Glénat', 'SADAMOTO Yoshiyuki', 2022, 'En 2015, alors que les humains ayant survécu au cataclysme du Second Impact se sont réfugiés dans la cité forteresse de Tokyo-3, de mystérieux Anges apparaissent, semant la terreur et la destruction. Pour les combattre, l’organisation Nerv possède la seule arme capable de les repousser : les Evangelion. Seulement, il lui manque encore l’essentiel pour activer ces gigantesques machines de guerre anthropoïdes : un pilote...', 1, 96);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `uid` int(10) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(2500) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`uid`, `date`, `title`, `content`, `banner`, `id`) VALUES
(1, '2022-05-16', 'Le manga Rent-A-Girlfriend adapté en drama !', 'Tandis que la diffusion de la deuxième saison de l\'adaptation animée du manga Rent-A-Girlfriend approche à grands pas, l\'œuvre de Reiji Miyajima sera aussi portée en série live cet été.\n\nPrévue pour le mois de juillet, soit le même mois que la deuxième saison de l\'anime, la série live sera diffusée sur TV Asahi pour le Kanto et sur ABC TV pour le Kansai. Dirigée par Daisuke Yamamoto et Kazunori Ima, elle est scénarisée par Kumiko Asô, en se basant sur le manga d\'origine de Reiji Miyajima.\n\nCôté casting, les deux têtes d\'affiche ont été dévoilées. Ainsi, Kazuya Kinoshita, le protagoniste, sera incarné par l\'idole Ryusei Onishi, membre du groupe de musique Naniwa Danshi. Chizuru Mizuhara, la petite amie de location du héros, sera interprétée par l\'actrice Hiyori Sakurada. Les deux comédiens ont été dévoilés, dans leurs rôles respectifs, via un premier visuel promotionnel.\n\nLancé en 2017 dans le Shônen Magazine de l\'éditeur Kôdansha, sous le titre Kanojo, Okarishimasu, le manga Rent-A-Girlfriend de Reiji Miyajima dénombre actuellement 25 tomes au Japon, le 26e opus étant justement prévu pour demain dans les librairies nippones. De notre côté, la comédie sentimentale est publiée aux éditions Noeve avec 6 opus disponibles. Côté anime, la première saison est disponible en VOD sur Crunchyroll et ADN.\n\nDepuis 2020, le manga a droit à un spin-off des mains de Yunkeru : Kanojo, Hitomishirimasu. Centré sur le personnage de Sumi, introduite en fin de cinquième volume, le dérivé sera publié dès ce mois-ci chez nous par Noeve, sous le titre Rent-A-Really-Shy-Girlfriend. Son premier volume sera disponible le 20 mai.\n\n[u]Synopsis du manga :[/u]\n\nKazuya Kinoshita, 20 ans, étudiant, vient de se faire larguer. Un déboire de plus dans la vie de ce garçon maladroit et malchanceux. Désespéré, il installe l’application Diamond, qui permet de faire appel aux services d’une petite amie de location. C’est la belle et inaccessible Chizuru Mizuhara qui se présente à leur premier rendez-vous... et si cette rencontre changeait la donne pour Kazuya ?\n\n[b][url=https://natalie.mu/comic/news/477410]Source[/url][/b]', '1.png', 1),
(1, '2022-06-02', 'Le manga Ce printemps remanent annoncé par Akata ', 'La mangaka [b]Shiki Kawabata[/b] (Rouge éclipse, Le secret de l\'ange) fera son retour aux éditions [b]Akata[/b] le mois prochain, avec le titre : Ce printemps rémanent, une série nous entrainant dans un étrange voyage temporel.\n\nMêlant mystère, fantastique et psychologie, ce josei nous raconte l’histoire d’une mangaka qui va voyager dans le passé afin d\'essayer de sauver un ancien camarade de classe...\n\nTerminée en 5 tomes, cette série est la première collaboration de l\'auteure avec la maison d\'édition Kôdansha et fût recommandée par le comité du 24e Japan Media Arts Festival (l’année dernière, en 2021).\n\nLe 1er tome est attendu pour le mois de [b]juillet prochain[/b] au prix de [b]6€99[/b].\n\n[u]Synopsis[/u]\n\nHaruta est une autrice de mangas dont la première série est devenue un énorme best-seller. Comme son titre phare touche à sa fin, son éditeur s\'attend à ce qu\'elle se lance rapidement dans un nouveau titre. Il y a juste un petit problème : elle se sent totalement incapable d\'y arriver, et pour cause ! La jeune femme n\'est pas à l\'origine de son propre succès, elle a volé le scénario de son manga à un camarade de lycée, aujourd\'hui décédé. Mais le destin va lui donner une opportunité de se racheter… En remontant le temps, pourra-t-elle réécrire l\'histoire et effacer ses regrets ?', '4.png', 4),
(2, '2022-06-02', 'Retour en France du manhwa Chonchu sur Verytoon\r\n', 'La série coréenne [b]Chonchu/Chunchu[/b] a récemment fait son retour en France, cette fois-ci en numérique via la plateforme [b]Verytoon[/b].\r\n\r\nBouclé en 15 volumes, ce manhwa d\'action a autrefois connu deux éditions papier en France chez feu les éditions Tokebi: la première entre 2003 et 2005, et la deuxième lancée en 2007 mais abandonnée en 2008 suite à la faillite de l\'éditeur.\r\n\r\nOn retrouve aux commandes de l\'oeuvre deux noms bien connus dans notre pays, avec au scénario [b]Kim Song Jae (Warlord)[/b], et au dessin Kim Byung Jin (Warlord, Jackals).\r\n\r\n[b][u]Synopsis :[/u][/b]\r\n\r\nChunchu, désigné par l’oracle comme fils du démon à sa naissance et banni par son peuple, mène une vie de sang et de violence. Porteur de la pierre du démon qui le rend invincible, il sort victorieux de tous les champs de bataille, semant la terreur sur son passage. Décidé à comprendre pourquoi un tel destin lui a été infligé, il découvre que quelque chose de mystérieux se cache derrière cette légende…', '5.jpg', 5),
(3, '2022-06-02', 'Des félins et du mystère dans le nouveau manga de Daisuke Igarashi\r\n', 'Le talentueux [u]Daisuke Igarashi[/u] fait son retour aujourd\'hui avec un nouveau manga de l\'ordre de la tranche de vie, des mystères et des félins.\r\n\r\nIntitulé Kamakura Bake Neko Club, celui-ci reprend l\'histoire courte publiée par l\'artiste fin 2021, dans le premier numéro daté de 2022 du magazine Be Love de l\'éditeur Kôdansha. La sérialisation a démarré ce jour dans le septième numéro annuel de la revue.\r\n\r\nLe récit nous est présenté comme une tranche de vie teintée de mystère dans la boutique Bake Neko Club située à Kamakura, lieu tenu par deux individus aux allures félines.\r\n\r\nDe notre côté, nous avons pu lire Daisuke Igarashi avec plusieurs titres dont Petite forêt, Sorcières, Saru, et bien entendu Les Enfants de la Mer, manga autrefois paru aux éditions Sarbacane et qui sera prochainement de retour dans la collection Moonlight des éditions Delcourt/Tonkam dans une nouvelle édition.', '6.png', 6);

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `vid` int(10) NOT NULL,
  `content` varchar(1500) NOT NULL,
  `note` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `uid`, `vid`, `content`, `note`) VALUES
(1, 1, 2, 'Adaptation du light novel,la série entame un très  bon début pour une série pleine de douceur.Une lecture assez apaisante qui rend accessible cette histoire touchante qui sera ce faire une place dans le milieu du manga comme le light novel auparavant. ', 9),
(2, 3, 3, 'AAAAAAAAAAAAARRRRRRRRGGGGGGGHHHHHHHHH', 10);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `mid` int(10) NOT NULL,
  `tid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`mid`, `tid`) VALUES
(1, 3),
(1, 4),
(2, 1),
(2, 9),
(3, 10),
(3, 11),
(4, 6),
(4, 12),
(4, 13),
(5, 1),
(5, 5),
(5, 14),
(5, 15),
(5, 16);

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE `themes` (
  `id` int(10) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id`, `label`) VALUES
(1, 'Action'),
(2, 'Aventure'),
(3, 'Fantasy'),
(4, 'Romance'),
(5, 'Mecha'),
(6, 'Sport'),
(7, 'Mystère'),
(8, 'Drama'),
(9, 'Comédie'),
(10, 'Seinen'),
(11, 'Tranche de vie'),
(12, 'Échecs'),
(13, 'Suspense'),
(14, 'Science Ficiton'),
(15, 'Post apocalyptique'),
(16, 'Psychologique');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `grade` int(10) NOT NULL,
  `pseudo` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `bio` varchar(300) NOT NULL,
  `avatar` varchar(44) DEFAULT NULL,
  `avatarValided` bit(1) NOT NULL,
  `connected` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `grade`, `pseudo`, `password`, `bio`, `avatar`, `avatarValided`, `connected`) VALUES
(1, 20, 'Lukas', '$2y$10$TMtlRMbnVPUbci3Wat1Gse8h4bQ8ofjrpZiLxrwIPPaXpx5UwKtCK', '[b]to answer that, we need to talk about parallel universes.[/b]', 'c46c1237fa0ecc12628a2a5004543d2beeb2e2f2.png', b'0', b'1'),
(2, 20, 'Nekotaku', '$2y$10$4rgKqwiKtXHF0bedVKcRTeWMwc3N.H0sknblEbUDQndq72ZuBqVeS', '', 'da4b9237bacccdf19c0760cab7aec4a8359010b0.jpg', b'1', b'1'),
(3, 20, '5_rei', '$2y$10$jbg.l1MuXLXIcUggDazN9OAHo9SwktNCJEo.ICt4PfJjTjXsx3.Cq', 'L\'alcool c\'est de l\'eau LOL', '77de68daecd823babbb58edb1c8e14d7106e83bb.jpg', b'1', b'0');

-- --------------------------------------------------------

--
-- Structure de la table `volumes`
--

CREATE TABLE `volumes` (
  `id` int(10) NOT NULL,
  `mid` int(10) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `num` int(10) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `releaseDate` date NOT NULL,
  `next` int(10) DEFAULT NULL,
  `prev` int(11) DEFAULT NULL,
  `synopsis` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `volumes`
--

INSERT INTO `volumes` (`id`, `mid`, `title`, `num`, `cover`, `releaseDate`, `next`, `prev`, `synopsis`) VALUES
(2, 1, 'Spice and Wolf, Vol. 1 ', 1, 'Spice_and_Wolf_tome_1.png', '2012-07-12', 4, NULL, 'Lawrence rencontre Holo dans la ville de Pasloe. Holo estime que les habitants de Pasloe l\'ont rejetée et convainc Lawrence de la ramener chez elle, dans le nord, à Yoitsu. Alors qu\'ils commencent leur voyage ensemble, Lawrence entend parler d\'une opération de spéculation monétaire potentiellement rentable, mais Lawrence et Holo ne tardent pas à être dépassés, et Lawrence doit décider si le profit vaut la peine de sacrifier sa nouvelle compagne.'),
(3, 2, 'Spy X Family Vol.1', 1, 'SpyXFamilly_tome_1', '2019-07-04', 20, NULL, 'Le célèbre espion Twilight n\'a pas de rival lorsqu\'il s\'agit de s\'infiltrer dans des missions dangereuses pour le bien du monde. Mais lorsqu\'il reçoit l\'ultime mission - se marier et avoir un enfant - il est peut-être dépassé par les événements !\r\nN\'étant pas du genre à dépendre des autres, Twilight a du pain sur la planche pour se procurer une femme et un enfant pour sa mission d\'infiltration d\'une école privée d\'élite. Ce qu\'il ne sait pas, c\'est que la femme qu\'il a choisie est une assassine et que l\'enfant qu\'il a adopté est un télépathe ! \r\n'),
(4, 1, 'Spice and Wolf, Vol. 2 ', 2, 'Spice_and_Wolf_tome_2.png', '2009-01-27', 6, 2, 'Lawrence et Holo retournent à la société Milone pour solliciter leur aide pour profiter du stratagème de Zheren. Plus tard, des hommes de la société Medio, qui travaille avec Zheren, tentent de tendre une embuscade à Lawrence et Holo. Holo agit comme un leurre, permettant à Lawrence d\'atteindre la Milone Company. Lawrence négocie avec la société Milone, les persuadant de l\'aider à sauver Holo. Après avoir libéré Holo, Lawrence apprend que son ami de Pasloe, Yarei, travaille également avec la société Medio et prévoit de remettre Holo à l\'église pour empêcher la société Milone d\'interférer avec leur plan. Avec Yarei et la Medio Company à leur recherche, Lawrence et Holo tentent de s\'échapper par les égouts de Pazzio.'),
(6, 1, 'Spice and Wolf, Vol. 3', 3, 'Spice_and_Wolf_tome_3.png', '2009-07-27', 7, 4, 'Alors que les hommes de la Medio Company et Yarei se rapprochent d\'eux, Lawrence et Holo tentent de trouver leur chemin hors de Pazzio. Lawrence est poignardé par l\'un des poursuivants, et les deux sont bientôt acculés. Yarei tente de convaincre Lawrence de remettre Holo, mais il refuse. Alors que les hommes Medio se préparent à tuer Lawrence, Holo se transforme en sa vraie forme - un loup géant - et les vainc. Cependant, la peur de Lawrence de la vraie forme de Holo la blesse et elle l\'abandonne alors qu\'il perd connaissance. Il se réveille à la Milone Company, où il reçoit sa part des bénéfices du stratagème en poivre et se réconcilie avec Holo. Plus tard, ils se rendent à Poroson, la ville voisine, pour vendre le poivre à la Latparron Company.'),
(7, 1, 'Spice and Wolf, Vol. 4', 4, 'Spice_and_Wolf_tome_4-.png', '2010-03-27', 8, 6, 'À la Latparron Company, Holo découvre le plan du propriétaire du magasin pour escroquer Lawrence. En échange de ne pas exposer la malhonnêteté du propriétaire, Lawrence persuade le propriétaire de lui vendre une grosse charge d\'armure sur marge (ce qui signifie qu\'il est endetté envers l\'entreprise jusqu\'à ce qu\'il vende l\'armure). En route vers Ruvenheigen, les voyageurs rencontrent Norah Arendt, une jeune bergère, qui convainc Lawrence de l\'engager pour les protéger des loups, malgré les objections de Holo. Après s\'être séparés au mur de la ville de Ruvenheigen, Lawrence se rend à la société Remelio pour vendre son armure, où il apprend que le prix de l\'armure s\'est effondré et qu\'il est maintenant profondément endetté.'),
(8, 1, 'Spice and Wolf, Vol. 5', 5, 'Spice_and_Wolf_tome_5.png', '2010-10-27', 9, 7, 'La société Remelio exige que Lawrence rembourse sa dette en deux jours ou fasse faillite. Après avoir tenté en vain d\'amener d\'autres marchands à lui prêter de l\'argent, Lawrence blâme Holo pour son échec dans un moment de désespoir, et elle le quitte, retournant à l\'auberge. Ensuite, Lawrence essaie de s\'excuser auprès de Holo, qui s\'en prend à lui pour ne pas être en colère contre elle. Après leur réconciliation, Holo conçoit un plan pour faire passer de l\'or en contrebande dans la ville en le transportant dans l\'estomac des moutons de Norah, et les deux persuadent la société Remelio et Norah de participer. Le lendemain, Lawrence, Holo et Norah partent pour Lamtra avec Liebert (le représentant de la société Remelio) et acquièrent l\'or, mais sont attaqués par des loups lors du voyage de retour.'),
(9, 1, 'Spice and Wolf, Vol. 6', 6, 'Spice_and_Wolf_tome_6.png', '2011-04-27', 10, 8, 'Holo dit aux autres, dont Lawrence, de la laisser derrière, afin qu\'elle puisse s\'occuper des loups. Ensuite, en attendant Holo, Lawrence est attaqué et lié par trois hommes de la Remelio Company, qui prévoient de tuer Norah et de garder le produit de la contrebande pour eux-mêmes. Lawrence se libère et trouve Holo, et lui raconte leur trahison. Holo se transforme en sa vraie forme, prend Lawrence sur son dos et rattrape Liebert et les hommes de Remelio, les ravageant avant qu\'ils ne puissent tuer Norah. Après avoir pris l\'or de Liebert et l\'avoir donné à Norah, Lawrence se rend à la Remelio Company avec Holo, où ils font chanter le propriétaire pour qu\'il leur achète l\'or pour 500 pièces d\'or - assez pour couvrir la dette de Lawrence. Plus tard, Lawrence et Holo retrouvent Norah, qui a réussi à amener l\'or dans la ville.'),
(10, 1, 'Spice and Wolf, Vol. 7', 7, 'Spice_and_Wolf_tome_7.png', '2012-02-27', 11, 9, 'Holo et Lawrence visitent une église à Tereo, un petit village du nord, dans l\'espoir de rencontrer un prêtre qui pourrait avoir des informations sur Yoitsu, le lieu de naissance de Holo. À leur arrivée, Elsa, la diaconesse, leur apprend la mort récente du prêtre et les renvoie. Elsa est en fait la fille du prêtre, et est enfermée dans une dispute avec Enberch, la commune voisine, qui cherche à profiter de la mort de son père pour reprendre le contrôle de Tereo. Lawrence et Holo parviennent plus tard à persuader Elsa de les laisser lire les écrits de son père, mais leur étude est interrompue lorsque Tereo est accusé d\'avoir vendu du blé empoisonné à Enberch - un stratagème pour forcer Tereo à se soumettre au contrôle d\'Enberch. Face aux menaces des habitants de la ville, qui leur reprochent d\'avoir empoisonné le blé, Lawrence, Holo, Elsa et Evan (le meunier de la ville) sont contraints de s\'échapper.'),
(11, 1, 'Spice and Wolf, Vol. 8', 8, 'Spice_and_Wolf_tome_8.png', '2012-10-27', 12, 10, ''),
(12, 1, 'Spice and Wolf, Vol. 9', 9, 'Spice_and_Wolf_tome_9.png', '2013-08-27', 13, 11, ''),
(13, 1, 'Spice and Wolf, Vol. 10', 10, 'Spice_and_Wolf_tome_10.png', '2014-04-26', 14, 12, ''),
(14, 1, 'Spice and Wolf, Vol. 11', 11, 'Spice_and_Wolf_tome_11.png', '2014-12-20', 15, 13, ''),
(15, 1, 'Spice and Wolf, Vol. 12', 12, 'Spice_and_Wolf_tome_12.png', '2015-08-27', 16, 14, ''),
(16, 1, 'Spice and Wolf, Vol. 13', 13, 'Spice_and_Wolf_tome_13.png', '2016-02-27', 17, 15, ''),
(17, 1, 'Spice and Wolf, Vol. 14', 14, 'Spice_and_Wolf_tome_14.png', '2016-09-27', 18, 16, ''),
(18, 1, 'Spice and Wolf, Vol. 15', 15, 'Spice_and_Wolf_tome_15.png', '2017-05-27', 19, 17, ''),
(19, 1, 'Spice and Wolf, Vol. 16', 16, 'Spice_and_Wolf_tome_16.png', '2018-02-27', NULL, 18, ''),
(20, 2, 'Spy X Family Vol.2', 2, 'SpyXFamilly_tome_2', '2019-10-04', 21, 3, 'Deux nations voisines partageant une haine réciproque, une paix fragile menacée par des hommes politiques ambitieux... Tel est le décor de SPYxFAMILY, avec, en premier rôle, Twilight, espion de Westalis missionné pour éviter la guerre qui se prépare en coulisses. Accompagné d\'Anya, sa (fausse) fille adoptive, et de Yor, sa (fausse) épouse et vraie tueuse, Twilight alias Loid Forger doit approcher le chef du parti Nation Unifiée. Le plan consiste à faire admettre la petite Anya à la prestigieuse école Éden, où se retrouvent les enfants de l\'élite d\'Ostania, puis de la faire figurer parmi les meilleurs élèves de l\'école. Un objectif qui relève de l\'impossible, à moins de déployer des trésors de ruse et d\'ingéniosité... Mais n\'est-ce pas là, justement, le cœur du métier d\'espion ?'),
(21, 2, 'Spy X Family Vol.3\r\n', 3, 'SpyXFamilly_tome_3', '2020-01-04', 22, 20, 'Pour Twilight, espion d\'un État en froid avec son voisin, l\'opération « Strix » consistant à approcher un dangereux homme politique est l\'absolue priorité. Mais il lui faut aussi gérer sa vie de famille, factice, avec son épouse Yor, employée de mairie le jour, tueuse la nuit, et sa fille adoptive Anya, dont le don de capter les pensées des gens n\'a d\'égal que les difficultés scolaires. Et la famille ne s\'arrête pas là, puisque Yor a un jeune frère, qui cache à tous son activité d\'agent de la police secrète. Quand Yuri leur rend une visite inattendue, Twilight doit composer avec les différents mensonges mis en place depuis des semaines. Une mission compliquée, d\'autant que le frère de Yor se méfie de ce mari dont il ignorait jusqu\'à présent l\'existence...'),
(22, 2, 'Spy X Family Vol.4\r\n', 4, 'SpyXFamilly_tome_4', '2020-05-13', 23, 21, 'Face à la menace d\'attentat qui pèse sur un ministre de Westalis en visite à Ostania, Twilight et la cellule de WISE se mobilisent. Les conspirateurs comptent employer des chiens pour arriver à leurs fins, une curieuse coïncidence alors que la famille Forger souhaite adopter un canidé pour récompenser Anya d\'avoir décroché sa première étoile à l\'école Eden. Et voilà qu\'Anya est enlevée par les terroristes au détour d\'un salon canin ! Une fois de plus, son intervention (maladroite) comme celle (inattendue) de Yor mettront Twilight sur la bonne piste...'),
(23, 2, 'Spy X Family Vol.5\r\n', 5, 'SpyXFamilly_tome_5', '2020-09-04', 24, 22, 'Après avoir déjoué en deux temps trois mouvements un complot terroriste (rien que ça), la (fausse) famille Forger accueille un nouveau membre dont le nom est Bond, le chien Bond. Sous son abondante pilosité canine se cachent un amour infini pour Anya et, plus discret, un don de prescience. Alors que l\'opération « Strix » semble enfin sur les rails, les examens qu\'Anya doit passer dans le cadre de sa scolarité pourraient à nouveau mettre en péril la délicate mission de Loid Forger, alias Twilight, le meilleur espion du monde...'),
(24, 2, 'Spy X Family Vol.6\r\n', 6, 'SpyXFamilly_tome_6', '2020-12-28', 25, 23, 'Twilight doit impérativement récupérer un document menaçant le fragile équilibre des forces entre l\'Est et l\'Ouest. Pour cette mission, il fait équipe avec Nocturna, une collaboratrice secrètement éprise de lui. Tout va se jouer lors d\'un tournoi de tennis clandestin, dont l\'issue pourrait bien remettre en cause la position de Yor au sein de la famille Forger. En effet, Noctuna s\'est juré de prendre la place de fausse épouse de Twilight dans le cadre de l\'opération « Strix ». Consciente du danger qui la guette, Yor n\'en éprouve pas moins des doutes sur son aptitude à jouer le rôle de Mme Forger. Dans le même temps, Twilight désespère de se rapprocher de sa cible, le dangereux et plus que jamais inatteignable Donovan Desmond...'),
(25, 2, 'Spy X Family Vol.7\r\n', 7, 'SpyXFamilly_tome_7', '2021-06-04', 26, 24, 'Twilight, vrai espion et faux père de famille, a enfin réussi à entrer en contact avec Donovan Desmond, sa cible sur l\'opération « Strix ». Mais l\'homme politique reste insaisissable. Anya demeure peut-être finalement la meilleure carte à jouer pour mener à bien la mission de son « père »...'),
(26, 2, 'Spy X Family Vol.8\r\n', 8, 'SpyXFamilly_tome_8', '2021-11-04', NULL, 25, ''),
(28, 3, 'L\'atelier des sorcières , Vol. 1 ', 1, 'ADS1.png', '2017-01-23', 29, NULL, 'Coco a toujours été fascinée par la magie. Hélas, seuls les sorciers peuvent pratiquer cet art et les élus sont choisis dès la naissance. Un jour, Kieffrey, un sorcier, arrive dans le village de la jeune fille. En l’espionnant, Coco comprend alors la véritable nature de la magie et se rappelle d’un livre de magie et d’un encrier qu’elle a achetés à un mystérieux inconnu quand elle était enfant. Elle s’exerce alors en cachette. Mais, dans son ignorance, Coco commet un acte tragique !\r\nDès lors, elle devient la disciple de Kieffrey et va découvrir un monde dont elle ne soupçonnait pas l’existence !'),
(29, 3, 'L\'atelier des sorcières , Vol. 2', 2, 'ADS2.png', '2017-08-23', 30, 28, 'On naît sorcier, on ne le devient pas. C\'est la règle. Pourtant, Kieffrey a pris Coco sous son aile et a fait d\'elle sa disciple : d\'humaine normale, la voilà devenue apprentie sorcière !\r\nKieffrey, Coco et ses trois camarades se sont rendus à Carn, petite ville de sorciers, pour acheter des fournitures magiques. Mais soudain, les quatre fillettes tombent dans un piège tendu par un mystérieux sorcier encapuchonné : elles sont coincées dans une dimension parallèle et doivent échapper à un dragon !'),
(30, 3, 'L\'atelier des sorcières , Vol. 3', 3, 'ADS3.png', '2018-02-23', 31, 29, 'Pour sauver un jeune garçon, Coco a utilisé un sort pour transformer un rocher en sable. Mais catastrophe ! Son sort a eu bien plus de portée qu’elle ne le pensait, et tout le lit de la rivière s’est effondré en conséquence. Coco est accusée par la milice magique d’avoir eu recours à un sort interdit et condamnée à voir sa mémoire effacée. Elle est sur le point d’être bannie à jamais du monde des sorciers…'),
(31, 3, 'L\'atelier des sorcières , Vol. 4', 4, 'ADS4.png', '2018-09-21', 32, 30, 'Agathe s’est inscrite au deuxième examen du monde des sorciers qui lui permettra de pratiquer la magie en public. Kieffrey, Coco et les autres apprenties l’accompagnent sur place, mais la présence néfaste de la Confrérie du Capuchon va bientôt venir troubler le bon déroulement de l’épreuve…'),
(32, 3, 'L\'atelier des sorcières , Vol. 5', 5, 'ADS5.png', '2019-05-22', 33, 31, 'En plein second examen de sorcellerie, Agathe, Trice et le timide Yinny se font attaquer par un sorcier renégat de la Confrérie du Capuchon. Celui-ci utilise un sort interdit pour transformer Yinny en bête sauvage…\nCoco, Tetia et Kieffrey sont eux aussi dans une bien triste posture : ils sont encerclés par les anciens habitants de Romonon, qui semblent vouer une haine farouche aux sorciers. Comble de malheur, Kieffrey est gravement blessé… Comment vont-ils s\'en sortir ?'),
(33, 3, 'L\'atelier des sorcières , Vol. 6', 6, 'ADS6.png', '2019-11-21', 34, 32, 'Après leur agression par la Confrérie du Capuchon lors de leur examen, Coco et ses camarades sont rapatriées à l’Académie, la citadelle des sorciers. Tandis que Kieffrey se remet de ses blessures, Coco fait la rencontre du sage Berdalute, responsable de l’enseignement des sorciers. Compréhensif, il promet aux apprenties de valider leur examen si elles parviennent à le surprendre avec leur magie. Mais émerveiller l’un des trois sorciers les plus talentueux de leur génération en seulement trois jours est loin d’être une mince affaire…'),
(34, 3, 'L\'atelier des sorcières , Vol. 7', 7, 'ADS7.png', '2020-05-22', 35, 33, 'À l’Académie, les apprenties sorcières ont passé avec brio leur épreuve de rattrapage pour le deuxième examen. Mais dans la foulée, Coco se fait convoquer, en pleine nuit, par Berdalute, l’un des trois grands sages. À sa grande surprise, il lui propose de rester à l’Académie pour devenir sa disciple et la mettre à l’abri de la confrérie du Capuchon et de Kieffrey. Coco, perplexe, se demande pourquoi elle devrait renoncer à son maître. Avant de prendre sa décision, elle décide de partir à la recherche de la vérité et se dirige vers la Tour-bibliothèque...'),
(35, 3, 'L\'atelier des sorcières , Vol. 8', 8, 'ADS8.png', '2020-12-23', 36, 34, 'Après avoir réussi leur examen à l’Académie, Coco et les autres apprenties sorcières sont de retour à l’Atelier. C’est alors qu’arrive Tarta, qui propose à Coco et à ses amies de l’aider à tenir un stand lors du grand festival annuel des sorciers, la Fête de la Nuit d’argent. Excitées comme des puces à l’idée de prendre part à ces festivités, les petites sorcières entament les préparatifs. Alors que Coco accompagne Tarta voir son grand-père à l’hôpital, elle recroise le chemin de Kustas, le petit garçon qui s’était blessé lors de l’incident près de la rivière…\n'),
(36, 3, 'L\'atelier des sorcières , Vol. 9', 9, 'ADS9.png', '2021-07-21', NULL, 35, 'Emportant chacune un objet magique de sa confection, Coco et ses amies partent pour l’île-cité d’Esrest, afin de participer à la Fête de la Nuit d’argent. Au milieu des stands et de la foule de visiteurs, la ville est plus animée que jamais. Il y flotte une atmosphère festive ! Mais parmi les convives se cachent aussi des invités indésirables. Sorciers, milice, nobles, sages… Beaucoup de forces se croisent et les contours de ce monde se dessinent peu à peu. Entre lumière et ténèbres, le rideau se lève enfin sur le grand festival des sorciers.'),
(37, 4, 'Blitz Vol. 1', 1, 'blitz-1-iwa.jpg', '2020-02-14', 38, NULL, 'Tom, jeune collégien, a un coup de cœur pour la belle Harmony. Apprenant que celle- ci se passionne pour les échecs, il décide de s’inscrire au club du collège. Mais il n’en connaît pas les règles ! Il n’a donc pas le choix : il doit tout apprendre et s’entraîner sérieusement. Très vite, il découvre l’existence de Garry Kasparov, le plus grand joueur de l’Histoire des échecs. Lors de ses recherches Tom tombe sur une machine de réalité virtuelle qui va lui permettre d’analyser les parties les plus mythiques du maître ! Un événement inattendu va alors ouvrir à Tom les portes du très haut niveau des échecs, et ce malgré lui...'),
(38, 4, 'Blitz Vol. 2', 2, 'blitz-2-iwa.jpg', '2020-10-23', NULL, 37, 'Suite à l\'incident avec Caïssa, le niveau de Tom aux échecs a considérablement progressé. De retour à l\'école, il retrouve Harmony, Laurent, Saori, mais aussi Anne, Marius et Zhang. Les sept membres du club d\'échecs de l\'International School of Shibuya doivent maintenant s\'affronter afin de déterminer les cinq représentants de l\'école qui participeront aux championnats inter-collèges de la région du Kantô.Face à des adversaires redoutables à bien des égards, les nerfs de nos héros vont être mis à rude épreuve...Souvenirs, rivalité, retrouvailles inattendues... difficile de garder sa concentration ! La team ISS sera-t-elle assez solide pour s\'en sortir ?'),
(39, 5, 'Evangelion Vol 1', 1, 'Evangelion_tome1.jpeg', '2022-05-25', NULL, NULL, 'En 2015, alors que les humains ayant survécu au cataclysme du Second Impact se sont réfugiés dans la cité forteresse de Tokyo-3, de mystérieux Anges apparaissent, semant la terreur et la destruction. Pour les combattre, l’organisation Nerv possède la seule arme capable de les repousser : les Evangelion. Seulement, il lui manque encore l’essentiel pour activer ces gigantesques machines de guerre anthropoïdes : un pilote...');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`uid`,`vid`),
  ADD KEY `collections_tid_tomes_id_foreign` (`vid`);

--
-- Index pour la table `comments_v`
--
ALTER TABLE `comments_v`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_uid_users_id_foreign` (`uid`),
  ADD KEY `comments_vid_volumes_id_foreign` (`vid`);

--
-- Index pour la table `comment_m`
--
ALTER TABLE `comment_m`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_m_uid_users_id_foreign` (`uid`),
  ADD KEY `comment_m_mid_mangas_id_foreign` (`mid`);

--
-- Index pour la table `comment_n`
--
ALTER TABLE `comment_n`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_n_uid_users_id_foreign` (`uid`),
  ADD KEY `comment_n_nid_news_id_foreign` (`nid`);

--
-- Index pour la table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mangas`
--
ALTER TABLE `mangas`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_uid_users_id_foreign` (`uid`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_uid_users_id_foreign` (`uid`),
  ADD KEY `reviews_vid_volumes_id_foreign` (`vid`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`mid`,`tid`),
  ADD KEY `tags_tid_themes_id_foreign` (`tid`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_grade_grade_id_foreign` (`grade`);

--
-- Index pour la table `volumes`
--
ALTER TABLE `volumes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `volumes_next_volumes_id_foreign` (`next`),
  ADD KEY `volumes_mid_mangas_id_foreign` (`mid`),
  ADD KEY `volumes_prev_volumes_id_foreign` (`prev`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments_v`
--
ALTER TABLE `comments_v`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `comment_m`
--
ALTER TABLE `comment_m`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `comment_n`
--
ALTER TABLE `comment_n`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `mangas`
--
ALTER TABLE `mangas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `volumes`
--
ALTER TABLE `volumes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `Collection_uid_users_id_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `collections_tid_tomes_id_foreign` FOREIGN KEY (`vid`) REFERENCES `volumes` (`id`);

--
-- Contraintes pour la table `comments_v`
--
ALTER TABLE `comments_v`
  ADD CONSTRAINT `comments_uid_users_id_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_vid_volumes_id_foreign` FOREIGN KEY (`vid`) REFERENCES `volumes` (`id`);

--
-- Contraintes pour la table `comment_m`
--
ALTER TABLE `comment_m`
  ADD CONSTRAINT `comment_m_mid_mangas_id_foreign` FOREIGN KEY (`mid`) REFERENCES `mangas` (`id`),
  ADD CONSTRAINT `comment_m_uid_users_id_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `comment_n`
--
ALTER TABLE `comment_n`
  ADD CONSTRAINT `comment_n_nid_news_id_foreign` FOREIGN KEY (`nid`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `comment_n_uid_users_id_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_uid_users_id_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_uid_users_id_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_vid_volumes_id_foreign` FOREIGN KEY (`vid`) REFERENCES `volumes` (`id`);

--
-- Contraintes pour la table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_mid_mangas_id_foreign` FOREIGN KEY (`mid`) REFERENCES `mangas` (`id`),
  ADD CONSTRAINT `tags_tid_themes_id_foreign` FOREIGN KEY (`tid`) REFERENCES `themes` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_grade_grade_id_foreign` FOREIGN KEY (`grade`) REFERENCES `grades` (`id`);

--
-- Contraintes pour la table `volumes`
--
ALTER TABLE `volumes`
  ADD CONSTRAINT `volumes_mid_mangas_id_foreign` FOREIGN KEY (`mid`) REFERENCES `mangas` (`id`),
  ADD CONSTRAINT `volumes_next_volumes_id_foreign` FOREIGN KEY (`next`) REFERENCES `volumes` (`id`),
  ADD CONSTRAINT `volumes_prev_volumes_id_foreign` FOREIGN KEY (`prev`) REFERENCES `volumes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
