-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Out-2016 às 15:49
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guiaseriesfilmes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `diretores`
--

CREATE TABLE `diretores` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `diretores`
--

INSERT INTO `diretores` (`id`, `nome`) VALUES
(40, ''),
(12, 'Alessandro Carloni'),
(22, 'Alfonso Cuaron'),
(10, 'Andrew Stanton'),
(6, 'Anthony Russo'),
(23, 'Blabla'),
(7, 'Bryan Singer'),
(9, 'Byron Howard'),
(19, 'Chris Columbus'),
(41, 'Christopher Nolan'),
(8, 'David Ayer'),
(21, 'David Yates'),
(25, 'Don Hall'),
(18, 'Francis Lawrence'),
(15, 'Garry Marshall'),
(3, 'Gary Ross'),
(16, 'Henry Joost'),
(30, 'James Bobin'),
(36, 'James Cameron'),
(32, 'James Marsh'),
(14, 'Jon M. Chu'),
(39, 'Lana Wachowski'),
(26, 'Marc Webb'),
(33, 'Martin Scorsese'),
(20, 'Mike Newell'),
(34, 'Morten Tyldum'),
(13, 'Paul Feig'),
(28, 'Paul Greengrass'),
(29, 'Rawson Marshall Thurber'),
(2, 'Rich Moore'),
(24, 'Richard Ayoade'),
(42, 'Richard Kelly'),
(37, 'Robert Zemeckis'),
(27, 'Roland Emmerich'),
(38, 'Stephen Chbosky'),
(17, 'Thea Sharrock'),
(1, 'Tim Burton'),
(4, 'Tim Miller'),
(31, 'Tom Shadyac'),
(35, 'Woody Allen'),
(11, 'Yarrow Cheney'),
(5, 'Zack Snyder');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estudios`
--

CREATE TABLE `estudios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estudios`
--

INSERT INTO `estudios` (`id`, `nome`) VALUES
(6, '21st Century Fox'),
(13, 'Columbia Pictures'),
(1, 'DreamWorks'),
(18, 'FilmNation Entertainment'),
(16, 'Globo Estúdios'),
(14, 'HeyDay Films'),
(20, 'Legendary Pictures'),
(4, 'Lions Gate Entertainment'),
(11, 'Marvel Studios'),
(2, 'MGM(Metro Goldwyn Mayer)'),
(19, 'Mr. Mudd'),
(5, 'Paramount Pictures Group'),
(9, 'Sony Pictures'),
(3, 'The Weinstein Company'),
(10, 'Tim Burton Productions'),
(7, 'Universal Pictures'),
(12, 'Walt Disney Pictures'),
(8, 'Warner Bros.'),
(15, 'Working Title Filmes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `diretor_id` int(11) DEFAULT NULL,
  `estudio_id` int(11) DEFAULT NULL,
  `genero_id` int(11) DEFAULT NULL,
  `nome` varchar(70) NOT NULL,
  `classificacao` char(2) DEFAULT NULL,
  `duracao` tinyint(4) DEFAULT NULL,
  `sinopse` text,
  `avaliacaoIMBD` float DEFAULT NULL,
  `dataEstreia` date DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `premios` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `filmes`
--

INSERT INTO `filmes` (`id`, `diretor_id`, `estudio_id`, `genero_id`, `nome`, `classificacao`, `duracao`, `sinopse`, `avaliacaoIMBD`, `dataEstreia`, `imagem`, `premios`) VALUES
(1, 4, 6, 23, 'Deadpool', '16', 108, 'Ex-militar e mercenário, Wade Wilson (Ryan Reynolds) é diagnosticado com câncer em estado terminal, porém encontra uma possibilidade de cura em uma sinistra experiência científica. Recuperado, com poderes e um incomum senso de humor, ele torna-se Deadpool e busca vingança contra o homem que destruiu sua vida.', 8.1, '2016-02-12', 'http://ia.media-imdb.com/images/M/MV5BMjQyODg5Njc4N15BMl5BanBnXkFtZTgwMzExMjE3NzE@._V1_SX300.jpg', '4 wins & 11 nominations'),
(2, 1, 10, 15, 'O Lar das Crianças Peculiares', '13', 127, 'When Jacob discovers clues to a mystery that spans different worlds and times, he finds Miss Peregrine''s Home for Peculiar Children. But the mystery and danger deepen as he gets to know the residents and learns about their special powers.', 7.9, '2016-09-30', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTA1NDg2MzM5NDleQTJeQWpwZ15BbWU4MDA5OTg5MTkx._V1_SX300.jpg', 'Não Informado'),
(4, 6, 11, 23, 'Captain America: Civil War', '13', 127, 'With many people fearing the actions of super heroes, the government decides to push for the Hero Registration Act, a law that limits a hero''s actions. This results in a division in The Avengers. Iron Man stands with this Act, claiming that their actions must be kept in check otherwise cities will continue to be destroyed, but Captain America feels that saving the world is daring enough and that they cannot rely on the government to protect the world. This escalates into an all-out war between Team Iron Man (Iron Man, Black Panther, Vision, Black Widow, War Machine, and Spiderman) and Team Captain America (Captain America, Bucky Barnes, Falcon, Sharon Carter, Scarlet Witch, Hawkeye, and Ant Man) while a new villain emerges.', 8.2, '2016-05-06', 'http://ia.media-imdb.com/images/M/MV5BMjQ0MTgyNjAxMV5BMl5BanBnXkFtZTgwNjUzMDkyODE@._V1_SX300.jpg', '2 wins & 7 nominations.'),
(5, 7, 6, 23, 'X-Men: Apocalypse', '13', 127, 'After the re-emergence of the world''s first mutant, world-destroyer Apocalypse, the X-Men must unite to defeat his extinction level plan.', 7.3, '2016-05-27', 'http://ia.media-imdb.com/images/M/MV5BMjU1ODM1MzYxN15BMl5BanBnXkFtZTgwOTA4NDE2ODE@._V1_SX300.jpg', '2 nominations.'),
(7, 8, 8, 23, 'Esquadrão Suícida', '13', 123, 'It feels good to be bad...Assemble a team of the world''s most dangerous, incarcerated Super Villains, provide them with the most powerful arsenal at the government''s disposal, and send them off on a mission to defeat an enigmatic, insuperable entity. U.S. intelligence officer Amanda Waller has determined only a secretly convened group of disparate, despicable individuals with next to nothing to lose will do. However, once they realize they weren''t picked to succeed but chosen for their patent culpability when they inevitably fail, will the Suicide Squad resolve to die trying, or decide it''s every man for himself?', 6.7, '2016-08-05', 'http://ia.media-imdb.com/images/M/MV5BMjM1OTMxNzUyM15BMl5BanBnXkFtZTgwNjYzMTIzOTE@._V1_SX300.jpg', '2 wins & 3 nominations.'),
(8, 9, 12, 11, 'Zootopia', 'LV', 108, 'In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy.', 8.1, '2016-03-04', 'http://ia.media-imdb.com/images/M/MV5BOTMyMjEyNzIzMV5BMl5BanBnXkFtZTgwNzIyNjU0NzE@._V1_SX300.jpg', '1 win & 2 nominations'),
(9, 10, 12, 11, 'Procurando Dory', 'LV', 97, 'The friendly but forgetful blue tang fish begins a search for her long-lost parents, and everyone learns a few things about the real meaning of family along the way.', 7.8, '2016-06-17', 'http://ia.media-imdb.com/images/M/MV5BNzg4MjM2NDQ4MV5BMl5BanBnXkFtZTgwMzk3MTgyODE@._V1_SX300.jpg', '2 wins.'),
(10, 11, 7, 11, 'Pets - A Vida Secreta dos Bichos', 'LV', 87, 'Taking place in a Manhattan apartment building, Max''s life as a favorite pet is turned upside down, when his owner brings home a sloppy mongrel named Duke. They have to put their quarrels behind when they find out that an adorable white bunny named Snowball is building an army of lost pets determined to take revenge', 6.8, '2016-07-08', 'http://ia.media-imdb.com/images/M/MV5BMjIzMzA1OTkzNV5BMl5BanBnXkFtZTgwODE3MjM4NzE@._V1_SX300.jpg', 'Não Informado'),
(11, 12, 1, 11, 'Kung Fu Panda 3', 'LV', 95, 'When Po''s long-lost panda father suddenly reappears, the reunited duo travels to a secret panda paradise to meet scores of hilarious new panda characters. But when the supernatural villain Kai begins to sweep across China defeating all the kung fu masters, Po must do the impossible-learn to train a village full of his fun-loving, clumsy brethren to become the ultimate band of Kung Fu Pandas.', 7.2, '2016-01-29', 'http://ia.media-imdb.com/images/M/MV5BMTUyNzgxNjg2M15BMl5BanBnXkFtZTgwMTY1NDI1NjE@._V1_SX300.jpg', '2 nominations.'),
(12, 13, 13, 12, 'Os Caça Fantasmas', '13', 116, 'Following a ghost invasion of Manhattan, paranormal enthusiasts Erin Gilbert and Abby Yates, nuclear engineer Jillian Holtzmann, and subway worker Patty Tolan band together to stop the otherworldly threat.', 5.5, '2016-07-15', 'http://ia.media-imdb.com/images/M/MV5BMTg3OTM4NTM4NV5BMl5BanBnXkFtZTgwOTI3NDc0OTE@._V1_SX300.jpg', '4 nominations'),
(13, 14, 5, 24, 'Now You See Me 2', '13', 127, 'The Four Horsemen resurface and are forcibly recruited by a tech genius to pull off their most impossible heist yet.', 6.6, '2016-06-10', 'http://ia.media-imdb.com/images/M/MV5BNzQ0NDgwODQ3NV5BMl5BanBnXkFtZTgwOTYxNjc2ODE@._V1_SX300.jpg', '3 nominations.'),
(14, 15, 5, 12, 'O Maior Amor do Mundo', '13', 118, 'Follows the lives of different mothers on Mothers Day. Sandy (Aniston) is happily divorced, until she finds out her ex-husband eloped with a much younger woman. Now she must learn to deal with big changes in her life as her two boys now have a step-mom. Sisters Jesse (Hudson) and Gabi (Chalke) get an unexpected surprise from their mother, who is not happy to find out Gabi is a lesbian and Jesse is married to a man of color. Miranda (Roberts) doesn''t have any kids and is focusing on her career. Kristin (Robertson) is enjoying life as a new mother but is feeling pressure from her boyfriend to get married. Bradley (Sudeikis) is trying hard to be the best parent for his two girls since their mom passed away last year, however his idea of Mothers Day is pretending it doesn''t exist at all.', 5.6, '2016-04-29', 'http://br.web.img3.acsta.net/r_1280_720/pictures/16/04/06/21/47/254058.jpg', 'Não Informado'),
(15, 16, 9, 24, 'Nerve', '13', 96, 'A high school senior finds herself immersed in an online game of truth or dare, where her every move starts to become manipulated by an anonymous community of "watchers."', 7, '2016-07-27', 'http://ia.media-imdb.com/images/M/MV5BMTUzOTg1OTM4NV5BMl5BanBnXkFtZTgwMTg2Mjg0OTE@._V1_SX300.jpg', 'Não Informado'),
(16, 17, 2, 3, 'Como eu era antes de Você', '13', 110, 'Lou Clark knows lots of things. She knows how many footsteps there are between the bus stop and home. She knows she likes working in The Buttered Bun tea shop and she knows she might not love her boyfriend Patrick. What Lou doesn''t know is she''s about to lose her job or that knowing what''s coming is what keeps her sane. Will Traynor knows his motorcycle accident took away his desire to live. He knows everything feels very small and rather joyless now and he knows exactly how he''s going to put a stop to that. What Will doesn''t know is that Lou is about to burst into his world in a riot of color. And neither of them knows they''re going to change each other for all time.', 7.5, '2016-06-03', 'http://ia.media-imdb.com/images/M/MV5BMTQ2NjE4NDE2NV5BMl5BanBnXkFtZTgwOTcwNDE5NzE@._V1_SX300.jpg', '1 win & 1 nomination.'),
(17, 3, 4, 2, 'Jogos Vorazes', '13', 127, 'In a dystopian future, the totalitarian nation of Panem is divided into 12 districts and the Capitol. Each year two young representatives from each district are selected by lottery to participate in The Hunger Games. Part entertainment, part brutal retribution for a past rebellion, the televised games are broadcast throughout Panem. The 24 participants are forced to eliminate their competitors while the citizens of Panem are required to watch. When 16-year-old Katniss'' young sister, Prim, is selected as District 12''s female representative, Katniss volunteers to take her place. She and her male counterpart, Peeta, are pitted against bigger, stronger representatives, some of whom have trained for this their whole lives.', 7.3, '2012-03-23', 'http://ia.media-imdb.com/images/M/MV5BMjA4NDg3NzYxMF5BMl5BanBnXkFtZTcwNTgyNzkyNw@@._V1_SX300.jpg', 'Nominated for 1 Golden Globe. Another 33 wins & 42 nominations.'),
(18, 18, 4, 2, 'Jogos Vorazes - Em Chamas', '13', 127, 'Katniss Everdeen and Peeta Mellark become targets of the Capitol after their victory in the 74th Hunger Games sparks a rebellion in the Districts of Panem.', 7.6, '2013-11-22', 'http://ia.media-imdb.com/images/M/MV5BMTAyMjQ3OTAxMzNeQTJeQWpwZ15BbWU4MDU0NzA1MzAx._V1_SX300.jpg', 'Nominated for 1 Golden Globe. Another 21 wins & 59 nominations.'),
(19, 18, 4, 2, 'Jogos Vorazes - A Esperança - Parte 1', '13', 123, 'With the Games destroyed, Katniss Everdeen, along with Gale, Finnick and Beetee, end up in the so thought "destroyed" District 13. Under the leadership of President Coin and the advice of her friends, Katniss becomes the "Mockingjay", the symbol of rebellion for the districts of Panem.', 6.7, '2014-11-21', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTcxNDI2NDAzNl5BMl5BanBnXkFtZTgwODM3MTc2MjE@._V1_SX300.jpg', 'Nominated for 1 Golden Globe. Another 16 wins & 26 nominations.'),
(20, 18, 4, 2, 'Jogos Vorazes - A Esperança - Parte 2', '13', 127, 'As the war of Panem escalates to the destruction of other districts, Katniss Everdeen, the reluctant leader of the rebellion, must bring together an army against President Snow, while all she holds dear hangs in the balance.', 6.6, '2015-11-20', 'http://ia.media-imdb.com/images/M/MV5BNjQzNDI2NTU1Ml5BMl5BanBnXkFtZTgwNTAyMDQ5NjE@._V1_SX300.jpg', '17 wins & 28 nominations.'),
(21, 19, 14, 15, 'Harry Potter e a Pedra Filosofal', 'LV', 127, 'Rescued from the outrageous neglect of his aunt and uncle, a young boy with a great destiny proves his worth while attending Hogwarts School of Witchcraft and Wizardry.', 7.5, '2001-11-16', 'http://ia.media-imdb.com/images/M/MV5BMTYwNTM5NDkzNV5BMl5BanBnXkFtZTYwODQ4MzY5._V1_SX300.jpg', 'Nominated for 3 Oscars. Another 17 wins & 60 nominations.'),
(22, 19, 14, 15, 'Harry Potter e a Câmara Secreta', 'LV', 127, 'Harry ignores warnings not to return to Hogwarts, only to find the school plagued by a series of mysterious attacks and a strange voice haunting him.', 7.4, '2002-11-15', 'http://ia.media-imdb.com/images/M/MV5BMTcxODgwMDkxNV5BMl5BanBnXkFtZTYwMDk2MDg3._V1_SX300.jpg', 'Nominated for 3 BAFTA Film Awards. Another 11 wins & 39 nominations.'),
(23, 20, 14, 15, 'Harry Potter e o Cálice de Fogo', '13', 127, 'Harry''s fourth year at Hogwarts is about to start and he is enjoying the summer vacation with his friends. They get the tickets to The Quidditch World Cup Final but after the match is over, people dressed like Lord Voldemort''s ''Death Eaters'' set a fire to all the visitors'' tents, coupled with the appearance of Voldemort''s symbol, the ''Dark Mark'' in the sky, which causes a frenzy across the magical community. That same year, Hogwarts is hosting ''The Triwizard Tournament'', a magical tournament between three well-known schools of magic : Hogwarts, Beauxbatons and Durmstrang. The contestants have to be above the age of 17, and are chosen by a magical object called Goblet of Fire. On the night of selection, however, the Goblet spews out four names instead of the usual three, with Harry unwittingly being selected as the Fourth Champion. Since the magic cannot be reversed, Harry is forced to go with it and brave three exceedingly difficult tasks.', 7.7, '2005-11-18', 'http://ia.media-imdb.com/images/M/MV5BMTI1NDMyMjExOF5BMl5BanBnXkFtZTcwOTc4MjQzMQ@@._V1_SX300.jpg', 'Nominated for 1 Oscar. Another 12 wins & 41 nominations'),
(24, 21, 14, 15, 'Harry Potter e o Enigma do Príncipe', 'LV', 127, 'As Harry Potter begins his sixth year at Hogwarts, he discovers an old book marked as "the property of the Half-Blood Prince" and begins to learn more about Lord Voldemort''s dark past.', 7.5, '2009-07-15', 'http://ia.media-imdb.com/images/M/MV5BNzU3NDg4NTAyNV5BMl5BanBnXkFtZTcwOTg2ODg1Mg@@._V1_SX300.jpg', 'Nominated for 1 Oscar. Another 8 wins & 30 nominations.'),
(25, 21, 14, 15, 'Harry Potter e a Ordem da Fênix', '13', 127, 'After a lonely summer on Privet Drive, Harry returns to a Hogwarts full of ill-fortune. Few of students and parents believe him or Dumbledore that Voldemort is really back. The ministry had decided to step in by appointing a new Defence Against the Dark Arts teacher that proves to be the nastiest person Harry has ever encountered. Harry also can''t help stealing glances with the beautiful Cho Chang. To top it off are dreams that Harry can''t explain, and a mystery behind something Voldemort is searching for. With these many things Harry begins one of his toughest years at Hogwarts School of Witchcraft and Wizardry.', 7.5, '2007-07-11', 'http://ia.media-imdb.com/images/M/MV5BMTM0NTczMTUzOV5BMl5BanBnXkFtZTYwMzIxNTg3._V1_SX300.jpg', 'Nominated for 2 BAFTA Film Awards. Another 14 wins & 38 nominations.'),
(26, 22, 14, 15, 'Harry Potter e o Prisioneiro de Azkaban', 'LV', 127, 'Harry Potter is having a tough time with his relatives (yet again). He runs away after using magic to inflate Uncle Vernon''s sister Marge who was being offensive towards Harry''s parents. Initially scared for using magic outside the school, he is pleasantly surprised that he won''t be penalized after all. However, he soon learns that a dangerous criminal and Voldemort''s trusted aide Sirius Black has escaped from the Azkaban prison and wants to kill Harry to avenge the Dark Lord. To worsen the conditions for Harry, vile creatures called Dementors are appointed to guard the school gates and inexplicably happen to have the most horrible effect on him. Little does Harry know that by the end of this year, many holes in his past (whatever he knows of it) will be filled up and he will have a clearer vision of what the future has in store...', 7.8, '2004-06-04', 'http://ia.media-imdb.com/images/M/MV5BMTY4NTIwODg0N15BMl5BanBnXkFtZTcwOTc0MjEzMw@@._V1_SX300.jpg', 'Nominated for 2 Oscars. Another 14 wins & 42 nominations.'),
(27, 21, 14, 15, 'Harry Potter e as Relíquias da Morte: Parte 1', '13', 127, 'Voldemort''s power is growing stronger. He now has control over the Ministry of Magic and Hogwarts. Harry, Ron, and Hermione decide to finish Dumbledore''s work and find the rest of the Horcruxes to defeat the Dark Lord. But little hope remains for the Trio, and the rest of the Wizarding World, so everything they do must go as planned.', 7.7, '2010-11-19', 'http://ia.media-imdb.com/images/M/MV5BMTQ2OTE1Mjk0N15BMl5BanBnXkFtZTcwODE3MDAwNA@@._V1_SX300.jpg', 'Nominated for 2 Oscars. Another 14 wins & 51 nominations'),
(28, 21, 14, 15, 'Harry Potter e as Relíquias da Morte - Parte 2', '13', 127, 'Harry, Ron and Hermione search for Voldemort''s remaining Horcruxes in their effort to destroy the Dark Lord as the final battle rages on at Hogwarts.', 8.1, '2011-07-15', 'http://ia.media-imdb.com/images/M/MV5BMTY2MTk3MDQ1N15BMl5BanBnXkFtZTcwMzI4NzA2NQ@@._V1_SX300.jpg', 'Nominated for 3 Oscars. Another 46 wins & 87 nominations.'),
(30, 5, 6, 23, 'Batman VS. Superman - A Origem da Justiça', '13', 127, 'Preocupado com as ações de um super-herói com poderes quase divinos e sem restrições, o formidável e implacável vigilante de Gotham City enfrenta o mais adorado salvador de Metrópolis, enquanto todos se questionam sobre o tipo de herói que o mundo realmente precisa. E com Batman e Superman em guerra um com o outro, surge uma nova ameaça, colocando a humanidade sob um risco maior do que jamais conheceu.', 6.9, '2016-03-25', 'http://ia.media-imdb.com/images/M/MV5BYThjYzcyYzItNTVjNy00NDk0LTgwMWQtYjMwNmNlNWJhMzMyXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', '1 win & 7 nominations.'),
(31, 24, 6, 13, 'Submarine', 'LV', 97, 'Precocious Oliver struggles with being popular in school but when a dark-haired beauty takes interest in him, he''s determined to become the best boyfriend in the world. Meanwhile, his parents'' already rocky relationship is threatened when his mother''s ex-boyfriend moves in next door. Oliver makes some unorthodox plans to ensure that his parents stay together and that Jordana still likes him.', 7.3, '2011-03-18', 'http://ia.media-imdb.com/images/M/MV5BMTQ5ODMxNTIyNV5BMl5BanBnXkFtZTcwNjQ1ODgyNQ@@._V1_SX300.jpg', 'Nominated for 1 BAFTA Film Award. Another 6 wins & 13 nominations'),
(32, 25, 12, 11, 'Operação Big Hero', 'LV', 102, 'Na cidade high-tech de San Fransokyo, o prodígio da robótica Hiro Hamada vê a paz local ser ameaçada por forças poderosas e, acompanhado pelo robô Baymax, se une a um time de combatentes inexperientes determinados a enfrentar os inimigos e salvar o paraíso futurista da destruição.', 7.9, '2014-11-07', 'http://ia.media-imdb.com/images/M/MV5BMDliOTIzNmUtOTllOC00NDU3LWFiNjYtMGM0NDc1YTMxNjYxXkEyXkFqcGdeQXVyNTM3NzExMDQ@._V1_SX300.jpg', 'Won 1 Oscar. Another 13 wins & 53 nominations.'),
(33, 26, 6, 3, '(500) Dias com Ela', '13', 95, 'Quando Tom, azarado escritor de cartões comemorativos e românticos sem esperanças, fica sem rumo depois de levar um fora da namorada Summer, ele volta a vários momentos dos 500 dias que passaram juntos para tentar entender o que deu errado.\r\n\r\nSuas reflexões acabam levando-o a redescobrir suas verdadeiras paixões na vida.', 7.7, '2009-08-07', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTk5MjM4OTU1OV5BMl5BanBnXkFtZTcwODkzNDIzMw@@._V1_SX300.jpg', 'Nominated for 2 Golden Globes. Another 18 wins & 52 nominations.'),
(34, 27, 13, 10, 'Independence Day - O Ressurgimento', '13', 120, 'Vinte anos após uma invasão alienígena quase dizimar toda a humanidade, eles voltaram em busca de vingança nesta incrível e explosiva sequência de Independence Day! Usando parte da tecnologia recuperada da primeira invasão alienígena, liderados pelo brilhante cientista David Levinston (Jeff Goldblum está de volta ao papel), as nações da Terra desenvolveram um programa avançado para a proteção do planeta. Mas nada conseguiu prever o tamanho e a força dessa nova ameaça e agora apenas algumas pessoas corajosas e com recursos limitados irão tentar salvar nosso mundo da extinção. Também estrelando Liam Hemsworth, Jesse T. Usher, Bill Pullman e William Fichtner Independence Day está de volta numa trama ainda mais repleta de ação e suspense do início ao fim!', 5.4, '2016-06-24', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjIyMTg5MTg4OV5BMl5BanBnXkFtZTgwMzkzMjY5NzE@._V1_SX300.jpg', '1 win & 2 nominations.'),
(35, 28, 7, 10, 'Jason Bourne', '13', 123, 'A organização Outcome, que montou um esquema de uso de remédios para diminuir a dor e aumentar a força e a inteligência de seus soldados, acreditava que Jason Bourne (Matt Damon) estava morto. Bourne lembrou de tudo o que lhe aconteceu, porém, não sabe de tudo e volta a ficar na mira da Outcome.', 7, '2016-07-29', 'http://ia.media-imdb.com/images/M/MV5BMTU1ODg2OTU1MV5BMl5BanBnXkFtZTgwMzA5OTg2ODE@._V1_SX300.jpg', '3 nominations.'),
(36, 29, 3, 10, 'Um Espião e Meio', '13', 107, 'Antes de se tornar um agente da CIA, Bob (Dwayne Johnson) foi um nerd que sofria bullying na época do colégio. Já na agência, para resolver um caso ultrassecreto, ele recorre a um antigo colega, popular nos tempos da escola, hoje contador (Kevin Hart).', 6.4, '2016-06-17', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjA2NzEzNjIwNl5BMl5BanBnXkFtZTgwNzgwMTEzNzE@._V1_SX300.jpg', '1 win & 2 nominations.'),
(37, 30, 12, 2, 'Alice Através do Espelho', 'LV', 113, 'A Disney convida você para uma viagem ao lado de Alice (Mia Wasikowska), através de um espelho mágico, de volta ao País das Maravilhas. Lá, para salvar o Chapeleiro Maluco (Johnny Depp), ela embarca em uma perigosa volta no tempo, onde descobre como os eventos passados moldaram a vida de seus amigos (e inimigos). Em uma espetacular combinação de ação, esplendor visual e muita emoção, Alice Através do Espelho é uma aventura que celebra o perdão, a família e a amizade.', 6.4, '2016-05-27', 'http://ia.media-imdb.com/images/M/MV5BMTc2NjExMTIyN15BMl5BanBnXkFtZTgwMjg0OTIwODE@._V1_SX300.jpg', '1 nomination.'),
(38, 31, 7, 22, 'Patch Adams - O Amor é Contagioso', '13', 115, 'Em 1969, após tentar se suicidar, Hunter Adams (Robin Williams) voluntariamente se interna em um sanatório. Ao ajudar outros internos, descobre que deseja ser médico, para poder ajudar as pessoas. Deste modo, sai da instituição e entra na faculdade de medicina. Seus métodos poucos convencionais causam inicialmente espanto, mas aos poucos vai conquistando todos, com exceção do reitor, que quer arrumar um motivo para expulsá-lo, apesar dele ser o primeiro da turma.', 6.7, '1998-12-25', 'http://ia.media-imdb.com/images/M/MV5BMTM0NjM2Mjg4Ml5BMl5BanBnXkFtZTcwMDAxOTMyMQ@@._V1_SX300.jpg', 'Nominated for 1 Oscar. Another 1 win & 7 nominations.'),
(39, 32, 15, 22, 'A Teoria de Tudo', '13', 123, 'Baseado na biografia de Stephen Hawking, o filme mostra como o jovem astrofísico (Eddie Redmayne) fez descobertas importantes sobre o tempo, além de retratar o seu romance com a aluna de Cambridge Jane Wide (Felicity Jones) e a descoberta de uma doença motora degenerativa quando tinha apenas 21 anos.', 7.7, '2014-11-26', 'http://ia.media-imdb.com/images/M/MV5BMTAwMTU4MDA3NDNeQTJeQWpwZ15BbWU4MDk4NTMxNTIx._V1_SX300.jpg', 'Won 1 Oscar. Another 24 wins & 118 nominations.'),
(40, 33, 5, 22, 'O Lobo de Wall Street', 'LV', 127, 'Durante seis meses, Jordan Belfort (Leonardo DiCaprio) trabalhou duro em uma corretora de Wall Street, seguindo os ensinamentos de seu mentor Mark Hanna (Matthew McConaughey). Quando finalmente consegue ser contratado como corretor da firma, acontece o Black Monday, que faz com que as bolsas de vários países caiam repentinamente. Sem emprego e bastante ambicioso, ele acaba trabalhando para uma empresa de fundo de quintal que lida com papéis de baixo valor, que não estão na bolsa de valores. É lá que Belfort tem a ideia de montar uma empresa focada neste tipo de negócio, cujas vendas são de valores mais baixos mas, em compensação, o retorno para o corretor é bem mais vantajoso. Ao lado de Donnie (Jonah Hill) e outros amigos dos velhos tempos, ele cria a Stratton Oakmont, uma empresa que faz com que todos enriqueçam rapidamente e, também, levem uma vida dedicada ao prazer.', 8.2, '2013-12-25', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjIxMjgxNTk0MF5BMl5BanBnXkFtZTgwNjIyOTg2MDE@._V1_SX300.jpg', 'Nominated for 5 Oscars. Another 35 wins & 155 nominations.'),
(41, 34, 5, 22, 'O Jogo da Imitação', '13', 114, 'Durante a Segunda Guerra Mundial, o governo britânico monta uma equipe que tem por objetivo quebrar o Enigma, o famoso código que os alemães usam para enviar mensagens aos submarinos. Um de seus integrantes é Alan Turing (Benedict Cumberbatch), um matemático de 27 anos estritamente lógico e focado no trabalho, que tem problemas de relacionamento com praticamente todos à sua volta. Não demora muito para que Turing, apesar de sua intransigência, lidere a equipe. Seu grande projeto é construir uma máquina que permita analisar todas as possibilidades de codificação do Enigma em apenas 18 horas, de forma que os ingleses conheçam as ordens enviadas antes que elas sejam executadas. Entretanto, para que o projeto dê certo, Turing terá que aprender a trabalhar em equipe e tem Joan Clarke (Keira Knightley) sua grande incentivadora.', 8.1, '2014-12-25', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNDkwNTEyMzkzNl5BMl5BanBnXkFtZTgwNTAwNzk3MjE@._V1_SX300.jpg', 'Won 1 Oscar. Another 44 wins & 150 nominations.'),
(43, 35, 18, 3, 'Café Society', '13', 96, 'In the 1930s, a young Bronx native moves to Hollywood where he falls in love with the secretary of his powerful uncle, an agent to the stars. After returning to New York, he is swept up in the vibrant world of high society nightclub life.', 7.1, '2016-08-05', 'http://ia.media-imdb.com/images/M/MV5BNjk1NjY4NjE5N15BMl5BanBnXkFtZTgwMTU0NDg0OTE@._V1_SX300.jpg', 'N/A'),
(44, 36, 7, 13, 'Titanic', '13', 127, 'Jack Dawson (Leonardo DiCaprio) é um jovem aventureiro que, na mesa de jogo, ganha uma passagem para a primeira viagem do transatlântico Titanic. Trata-se de um luxuoso e imponente navio, anunciado na época como inafundável, que parte para os Estados Unidos. Nele está também Rose DeWitt Bukater (Kate Winslet), a jovem noiva de Caledon Hockley (Billy Zane). Rose está descontente com sua vida, já que sente-se sufocada pelos costumes da elite e não ama Caledon. Entretanto, ela precisa se casar com ele para manter o bom nome da família, que está falida. Um dia, desesperada, Rose ameaça se atirar do Titanic, mas Jack consegue demovê-la da ideia. Pelo ato ele é convidado a jantar na primeira classe, onde começa a se tornar mais próximo de Rose. Logo eles se apaixonam, despertando a fúria de Caledon. A situação fica ainda mais complicada quando o Titanic se choca com um iceberg, provocando algo que ninguém imaginava ser possível: o naufrágio do navio.', 7.7, '1997-12-19', 'http://ia.media-imdb.com/images/M/MV5BMzg1MDA0MTU2Nl5BMl5BanBnXkFtZTcwMTMzMjkxNw@@._V1_SX300.jpg', 'Won 11 Oscars. Another 110 wins & 73 nominations.'),
(45, 37, 7, 13, 'Forrest Gump', '13', 127, 'Quarenta anos da história dos Estados Unidos, vistos pelos olhos de Forrest Gump (Tom Hanks), um rapaz com QI abaixo da média e boas intenções. Por obra do acaso, ele consegue participar de momentos cruciais, como a Guerra do Vietnã e Watergate, mas continua pensando no seu amor de infância, Jenny Curran.\r\n', 8.8, '1994-07-06', 'https://images-na.ssl-images-amazon.com/images/M/MV5BYThjM2MwZGMtMzg3Ny00NGRkLWE4M2EtYTBiNWMzOTY0YTI4XkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SX300.jpg', 'Won 6 Oscars. Another 39 wins & 65 nominations.'),
(46, 38, 19, 13, 'As Vantagens de Ser Invisível', '13', 102, 'A história é narrada por um adolescente tímido e impopular que descreve a sua vida em uma série de cartas para uma pessoa anônima e explora as fases difíceis da adolescência, incluindo o uso de drogas e sexualidade.', 8, '2012-10-12', 'http://ia.media-imdb.com/images/M/MV5BMzIxOTQyODU1OV5BMl5BanBnXkFtZTcwMDQ4Mjg4Nw@@._V1_SX300.jpg', '19 wins & 48 nominations.'),
(47, 39, 8, 17, 'The Matrix', 'LV', 127, 'Em um futuro próximo, Thomas Anderson (Keanu Reeves), um jovem programador de computador que mora em um cubículo escuro, é atormentado por estranhos pesadelos nos quais encontra-se conectado por cabos e contra sua vontade, em um imenso sistema de computadores do futuro. Em todas essas ocasiões, acorda gritando no exato momento em que os eletrodos estão para penetrar em seu cérebro. À medida que o sonho se repete, Anderson começa a ter dúvidas sobre a realidade. Por meio do encontro com os misteriosos Morpheus (Laurence Fishburne) e Trinity (Carrie-Anne Moss), Thomas descobre que é, assim como outras pessoas, vítima do Matrix, um sistema inteligente e artificial que manipula a mente das pessoas, criando a ilusão de um mundo real enquanto usa os cérebros e corpos dos indivíduos para produzir energia. Morpheus, entretanto, está convencido de que Thomas é Neo, o aguardado messias capaz de enfrentar o Matrix e conduzir as pessoas de volta à realidade e à liberdade.\r\n', 8.7, '1999-03-31', 'http://ia.media-imdb.com/images/M/MV5BMTkxNDYxOTA4M15BMl5BanBnXkFtZTgwNTk0NzQxMTE@._V1_SX300.jpg', 'Won 4 Oscars. Another 33 wins & 43 nominations.'),
(48, 37, 8, 17, 'De volta para o Futuro', 'LV', 116, 'Um jovem (Michael J. Fox) aciona acidentalmente uma máquina do tempo construída por um cientista (Christopher Lloyd) em um Delorean, retornando aos anos 50. Lá conhece sua mãe (Lea Thompson), antes ainda do casamento com seu pai, que fica apaixonada por ele. Tal paixão põe em risco sua própria existência, pois alteraria todo o futuro, forçando-o a servir de cupido entre seus pais.', 8.5, '1985-07-03', 'http://ia.media-imdb.com/images/M/MV5BZmU0M2Y1OGUtZjIxNi00ZjBkLTg1MjgtOWIyNThiZWIwYjRiXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 'Won 1 Oscar. Another 18 wins & 26 nominations.'),
(49, 41, 20, 23, 'Batman Begins', '13', 127, 'When his parents are killed, billionaire playboy Bruce Wayne relocates to Asia where he is mentored by Henri Ducard and Ra''s Al Ghul in how to fight evil. When learning about the plan to wipe out evil in Gotham City by Ducard, Bruce prevents this plan from getting any further and heads back to his home. Back in his original surroundings, Bruce adopts the image of a bat to strike fear into the criminals and the corrupt as the icon known as ''Batman''. But it doesn''t stay quiet for long.', 8.3, '2005-06-15', 'https://images-na.ssl-images-amazon.com/images/M/MV5BNTM3OTc0MzM2OV5BMl5BanBnXkFtZTYwNzUwMTI3._V1_SX300.jpg', 'Nominated for 1 Oscar. Another 15 wins & 66 nominations.'),
(50, 41, 20, 23, 'Batman - O Cavalheiro das Trevas', '13', 127, 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, the caped crusader must come to terms with one of the greatest psychological tests of his ability to fight injustice.', 9, '2008-07-18', 'http://ia.media-imdb.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SX300.jpg', 'Won 2 Oscars. Another 146 wins & 142 nominations.'),
(51, 41, 20, 23, 'Batman - O Cavalheiro das Trevas Ressurge', '13', 127, 'Despite his tarnished reputation after the events of The Dark Knight, in which he took the rap for Dent''s crimes, Batman feels compelled to intervene to assist the city and its police force which is struggling to cope with Bane''s plans to destroy the city.', 8.5, '2012-07-20', 'http://ia.media-imdb.com/images/M/MV5BMTk4ODQzNDY3Ml5BMl5BanBnXkFtZTcwODA0NTM4Nw@@._V1_SX300.jpg', 'Nominated for 1 BAFTA Film Award. Another 38 wins & 96 nominations.'),
(52, 42, 7, 19, 'Donnie Darko', 'LV', 113, 'A troubled teenager is plagued by visions of a large bunny rabbit that manipulates him to commit a series of crimes, after narrowly escaping a bizarre accident.', 8.1, '2001-10-26', 'http://ia.media-imdb.com/images/M/MV5BMGIwNTc0NmMtZTFlZC00ZmY4LWE1NDItODhkZGJkMzFjZjg1XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', '11 wins & 15 nominations.'),
(53, 1, 6, 13, 'Edward Mãos de Tesoura', '13', 105, 'A gentle man, with scissors for hands, is brought into a new community after living in isolation.', 7.9, '1990-12-14', 'http://ia.media-imdb.com/images/M/MV5BOTE2NDExNjQxMF5BMl5BanBnXkFtZTgwMzQ3NzMxMDE@._V1_SX300.jpg', 'Nominated for 1 Oscar. Another 6 wins & 15 nominations.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `generos`
--

INSERT INTO `generos` (`id`, `nome`) VALUES
(10, 'Acao'),
(11, 'Animacao'),
(2, 'Aventura'),
(22, 'Biografico'),
(12, 'Comedia'),
(3, 'Comedia Romantica'),
(13, 'Drama'),
(15, 'Fantasia'),
(16, 'Faroeste'),
(17, 'Ficcao Cientifica'),
(23, 'Herois'),
(18, 'Medico'),
(24, 'Misterio'),
(21, 'Nacional'),
(25, 'Policial'),
(19, 'Suspense'),
(20, 'Terror');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `dataNasc` date NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `sexo`, `dataNasc`, `senha`) VALUES
(1, 'Henrique Pessolato', 'pessolatohenrique@gmail.com', 'M', '1995-05-26', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Joana D''Arc', 'joana@gmail.com', 'F', '1945-01-12', '3f1da108609f5350558015494e69cae1'),
(10, 'Barney Stinson', 'barney.stinson@awesome.com', 'M', '1975-06-09', '3f1da108609f5350558015494e69cae1'),
(13, 'Lily Aldrin', 'lily.aldrin@himym.com', 'F', '1976-10-12', '3f1da108609f5350558015494e69cae1'),
(15, 'Barry Allen', 'barry.allen@flash.com', 'M', '1992-10-29', '3f1da108609f5350558015494e69cae1'),
(16, 'Cisco Ramon', 'cisco@starlabs.com', 'M', '1980-05-12', '3f1da108609f5350558015494e69cae1'),
(17, 'Peter Parker', 'peter.parker@gmail.com', 'M', '1990-10-15', '3f1da108609f5350558015494e69cae1'),
(18, 'Emma Swan', 'emma.swan@gmail.com', 'F', '1985-05-10', '3f1da108609f5350558015494e69cae1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diretores`
--
ALTER TABLE `diretores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `diretor_id` (`diretor_id`),
  ADD KEY `estudio_id` (`estudio_id`),
  ADD KEY `genero_id` (`genero_id`);

--
-- Indexes for table `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diretores`
--
ALTER TABLE `diretores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `estudios`
--
ALTER TABLE `estudios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `filmes`
--
ALTER TABLE `filmes`
  ADD CONSTRAINT `filmes_ibfk_1` FOREIGN KEY (`diretor_id`) REFERENCES `diretores` (`id`),
  ADD CONSTRAINT `filmes_ibfk_2` FOREIGN KEY (`estudio_id`) REFERENCES `estudios` (`id`),
  ADD CONSTRAINT `filmes_ibfk_3` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
