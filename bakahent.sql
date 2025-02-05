-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql311.infinityfree.com
-- Generation Time: Feb 05, 2025 at 04:29 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36902011_bakahen`
--

-- --------------------------------------------------------

--
-- Table structure for table `anime_list`
--

CREATE TABLE `anime_list` (
  `id` int(11) NOT NULL,
  `anime_id` varchar(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `jp_name` varchar(150) NOT NULL,
  `status` varchar(50) NOT NULL,
  `studio` varchar(50) NOT NULL,
  `theme` varchar(150) NOT NULL,
  `seasons` tinyint(2) NOT NULL,
  `summary` text NOT NULL,
  `img` varchar(50) NOT NULL,
  `adult` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anime_list`
--

INSERT INTO `anime_list` (`id`, `anime_id`, `name`, `jp_name`, `status`, `studio`, `theme`, `seasons`, `summary`, `img`, `adult`) VALUES
(1, '72215', 'Kaguya-sama: Love is War', 'Kaguya-sama wa Kokurasetai: Tensai-tachi no Renai Zunousen', 'Finished Airing', 'A-1 Pictures', 'Psychological, Romantic Subtext, School', 4, 'At the renowned Shuchiin Academy, Miyuki Shirogane and Kaguya Shinomiya are the student body\'s top representatives. Ranked the top student in the nation and respected by peers and mentors alike, Miyuki serves as the student council president. Alongside him, the vice president Kaguya—eldest daughter of the wealthy Shinomiya family—excels in every field imaginable. They are the envy of the entire student body, regarded as the perfect couple.\r\n\r\nHowever, despite both having already developed feelings for the other, neither are willing to admit them. The first to confess loses, will be looked down upon, and will be considered the lesser. With their honor and pride at stake, Miyuki and Kaguya are both equally determined to be the one to emerge victorious on the battlefield of love!', 'anime/72215.jpg', 0),
(2, '15438718', 'Alya Sometimes Hides Her Feelings in Russian', 'Tokidoki Bosotto Russia-go de Dereru Tonari no Alya-san', 'Currently Airing', 'Doga Kobo', 'School', 1, 'Smart, refined, and strikingly gorgeous, half-Russian half-Japanese Alisa Mikhailovna Kujou is considered the idol of her school. With her long silver hair, mesmerizing blue eyes, and exceptionally fair skin, she has captured the hearts of countless male students while being highly admired by all others. Even so, due to her seemingly unapproachable persona, everyone remains wary around the near-flawless girl.\r\n\r\nOne of the few exceptions is Alisa\'s benchmate Masachika Kuze, a relatively average boy who spends his days watching anime and playing gacha games. Despite his nonchalant demeanor, Masachika is the sole student to receive Alisa\'s attention. Unable to be fully honest, Alisa is frequently harsh on Masachika and only expresses her affection in Russian. Unbeknownst to her, however, Masachika actually understands the language yet simply pretends otherwise for his own amusement.\r\n\r\nAs the odd pair continues to exchange witty and playful remarks, their relationship gradually grows more romantic and delightful—and Alisa might finally learn to freely convey her true feelings.', 'anime/15438718.jpg', 0),
(4, '07186275', 'Your Lie in April', 'Shigatsu wa Kimi no Uso', 'Finished Airing', 'A-1 Pictures', 'Love Polygon, Music, School', 1, 'Kousei Arima is a child prodigy known as the \"Human Metronome\" for playing the piano with precision and perfection. Guided by a strict mother and rigorous training, Kousei dominates every competition he enters, earning the admiration of his musical peers and praise from audiences. When his mother suddenly passes away, the subsequent trauma makes him unable to hear the sound of a piano, and he never takes the stage thereafter.\r\n\r\nNowadays, Kousei lives a quiet and unassuming life as a junior high school student alongside his friends Tsubaki Sawabe and Ryouta Watari. While struggling to get over his mother\'s death, he continues to cling to music. His monochrome life turns upside down the day he encounters the eccentric violinist Kaori Miyazono, who thrusts him back into the spotlight as her accompanist. Through a little lie, these two young musicians grow closer together as Kaori tries to fill Kousei\'s world with color.', 'anime/07186275.jpg', 0),
(5, '383865', 'One Piece', 'One Piece', 'Currently Airing', 'Toei Animation', 'Adventure', 1, 'Barely surviving in a barrel after passing through a terrible whirlpool at sea, carefree Monkey D. Luffy ends up aboard a ship under attack by fearsome pirates. Despite being a naive-looking teenager, he is not to be underestimated. Unmatched in battle, Luffy is a pirate himself who resolutely pursues the coveted One Piece treasure and the King of the Pirates title that comes with it.\r\n\r\nThe late King of the Pirates, Gol D. Roger, stirred up the world before his death by disclosing the whereabouts of his hoard of riches and daring everyone to obtain it. Ever since then, countless powerful pirates have sailed dangerous seas for the prized One Piece only to never return. Although Luffy lacks a crew and a proper ship, he is endowed with a superhuman ability and an unbreakable spirit that make him not only a formidable adversary but also an inspiration to many.\r\n\r\nAs he faces numerous challenges with a big smile on his face, Luffy gathers one-of-a-kind companions to join him in his ambitious endeavor, together embracing perils and wonders on their once-in-a-lifetime adventure.', 'anime/383865.jpg', 0),
(6, '472519919', 'My Deer Friend Nokotan', 'Shikanoko Nokonoko Koshitantan', 'Currently Airing', 'Wit Studio', 'Gag Humor, School', 1, 'Torako Koshi is the epitome of perfection. With her peerless beauty, top-notch grades, and position as student council president, her popularity in school is unrivaled. However, she harbors a dark secretâ€”she was a delinquent back in middle schoolâ€”and this is something she conceals to the best of her abilities.\r\n\r\nUnfortunately, when she meets the mysterious deer girl Noko Shikanoko, Torako\'s hidden shame is constantly on the precipice of being exposed due to Shikanoko\'s rather weird antics. To maintain the reputation she worked so hard for, Torako must go along with Shikanoko\'s whims, even going so far as to become president of the newly established Deer Club. All her efforts will be rewarded if she can prevent the menacing doe from accidentally blurting out damaging details about her personal history that will undoubtedly unleash Torako\'s greatest nightmare.', 'anime/472519919.jpg', 0),
(7, '089171329', 'Kaiju No. 8', 'Kaijuu 8-gou', 'Finished Airing', 'Production I.G', 'Adult Cast, Military', 1, 'After the destruction of their hometown, childhood friends Kafka Hibino and Mina Ashiro make a pact to become officers in the Defense Forceâ€”a militarized organization tasked with protecting Japan from colossal monsters known as \"kaijuu.\" Decades later, the 32-year-old Kafka has all but given up on his dreams of heroism. Instead, he cleans up the remains of the slaughtered kaijuu after they are defeated by valiant soldiersâ€”including Mina, who has successfully achieved their shared goal.\r\n\r\nUpon meeting his new coworker, Reno Ichikawa, Kafka faces a mirror of his past self: an ambitious young man whose one desire is to fight as a member of the Defense Force. Unfortunately, the two are soon involved in a freak encounter with a rogue kaijuu. Though Kafka demonstrates his innate heroic nature and rescues Reno from certain doom, he is left gravely injured.', 'anime/089171329.jpg', 0),
(8, '10412947', 'Horimiya', 'Horimiya', 'Finished Airing', 'CloverWorks', 'School', 2, 'On the surface, the thought of Kyouko Hori and Izumi Miyamura getting along would be the last thing in people\'s minds. After all, Hori has a perfect combination of beauty and brains, while Miyamura appears meek and distant to his fellow classmates. However, a fateful meeting between the two lays both of their hidden selves bare. Even though she is popular at school, Hori has little time to socialize with her friends due to housework. On the other hand, Miyamura lives under the noses of his peers, his body bearing secret tattoos and piercings that make him look like a gentle delinquent.\r\n\r\nHaving opposite personalities yet sharing odd similarities, the two quickly become friends and often spend time together in Hori\'s home. As they both emerge from their shells, they share with each other a side of themselves concealed from the outside world.', 'anime/10412947.jpg', 0),
(9, '7133536', 'Jujutsu Kaisen', 'Jujutsu Kaisen', 'Further Continues', 'MAPPA', 'School', 2, 'Idly indulging in baseless paranormal activities with the Occult Club, high schooler Yuuji Itadori spends his days at either the clubroom or the hospital, where he visits his bedridden grandfather. However, this leisurely lifestyle soon takes a turn for the strange when he unknowingly encounters a cursed item. Triggering a chain of supernatural occurrences, Yuuji finds himself suddenly thrust into the world of Cursesâ€”dreadful beings formed from human malice and negativityâ€”after swallowing the said item, revealed to be a finger belonging to the demon Sukuna Ryoumen, the King of Curses.\r\n\r\nYuuji experiences first-hand the threat these Curses pose to society as he discovers his own newfound powers. Introduced to the Tokyo Prefectural Jujutsu High School, he begins to walk down a path from which he cannot returnâ€”the path of a Jujutsu sorcerer.', 'anime/7133536.jpg', 0),
(10, '404875364', 'Death Note', 'Death Note', 'Finished Airing', 'Madhouse', 'Psychological', 1, 'Brutal murders, petty thefts, and senseless violence pollute the human world. In contrast, the realm of death gods is a humdrum, unchanging gambling den. The ingenious 17-year-old Japanese student Light Yagami and sadistic god of death Ryuk share one belief: their worlds are rotten.\r\n\r\nFor his own amusement, Ryuk drops his Death Note into the human world. Light stumbles upon it, deeming the first of its rules ridiculous: the human whose name is written in this note shall die. However, the temptation is too great, and Light experiments by writing a felon\'s name, which disturbingly enacts his first murder.', 'anime/404875364.jpg', 0),
(11, '4354794', 'Classroom of the Elite', 'Youkoso Jitsuryoku Shijou Shugi no Kyoushitsu e', 'Finished Airing', 'Lerche', 'Psychological, School', 3, 'On the surface, Koudo Ikusei Senior High School is a utopia. The students enjoy an unparalleled amount of freedom, and it is ranked highly in Japan. However, the reality is less than ideal. Four classes, A through D, are ranked in order of merit, and only the top classes receive favorable treatment.\r\n\r\nKiyotaka Ayanokouji is a student of Class D, where the school dumps its worst. There he meets the unsociable Suzune Horikita, who believes she was placed in Class D by mistake and desires to climb all the way to Class A, and the seemingly amicable class idol Kikyou Kushida, whose aim is to make as many friends as possible.', 'anime/4354794.jpg', 0),
(12, '2785840', 'Attack on Titan', 'Shingeki no Kyojin', 'Finished Airing', 'Wit Studio', 'Gore, Military, Survival', 4, 'Centuries ago, mankind was slaughtered to near extinction by monstrous humanoid creatures called Titans, forcing humans to hide in fear behind enormous concentric walls. What makes these giants truly terrifying is that their taste for human flesh is not born out of hunger but what appears to be out of pleasure. To ensure their survival, the remnants of humanity began living within defensive barriers, resulting in one hundred years without a single titan encounter. However, that fragile calm is soon shattered when a colossal Titan manages to breach the supposedly impregnable outer wall, reigniting the fight for survival against the man-eating abominations.\r\n', 'anime/2785840.jpg', 0),
(13, '746857', 'Naruto', 'Naruto', 'Finished Airing', 'Pierrot ', ' Martial Arts', 2, 'Moments before Naruto Uzumaki\'s birth, a huge demon known as the Nine-Tailed Fox attacked Konohagakure, the Hidden Leaf Village, and wreaked havoc. In order to put an end to the demon\'s rampage, the leader of the village, the Fourth Hokage, sacrificed his life and sealed the monstrous beast inside the newborn Naruto.\r\n\r\nIn the present, Naruto is a hyperactive and knuckle-headed ninja growing up within Konohagakure. Shunned because of the demon inside him, Naruto struggles to find his place in the village. His one burning desire to become the Hokage and be acknowledged by the villagers who despite him. However, while his goal leads him to unbreakable bonds with lifelong friends, it also lands him in the crosshairs of many deadly foes.', 'anime/746857.jpg', 0),
(15, '509000011', 'My Dress-Up Darling', 'Sono Bisque Doll wa Koi wo Suru', 'Finished Airing', 'CloverWorks', 'Otaku Culture, School', 1, 'High school student Wakana Gojou spends his days perfecting the art of making hina dolls, hoping to eventually reach his grandfather\'s level of expertise. While his fellow teenagers busy themselves with pop culture, Gojou finds bliss in sewing clothes for his dolls. Nonetheless, he goes to great lengths to keep his unique hobby a secret, as he believes that he would be ridiculed were it revealed.', 'anime/509000011.jpg', 0),
(16, '676543474', 'Demon Slayer : Kimetsu no Yaiba', 'Kimetsu no Yaiba', 'Finished Airing', 'Ufotable', 'Historical', 5, 'Ever since the death of his father, the burden of supporting the family has fallen upon Tanjirou Kamado\'s shoulders. Though living impoverished on a remote mountain, the Kamado family are able to enjoy a relatively peaceful and happy life. One day, Tanjirou decides to go down to the local village to make a little money selling charcoal. On his way back, night falls, forcing Tanjirou to take shelter in the house of a strange man, who warns him of the existence of flesh-eating demons that lurk in the woods at night.\r\n\r\nWhen he finally arrives back home the next day, he is met with a horrifying sightâ€”his whole family has been slaughtered. Worse still, the sole survivor is his sister Nezuko, who has been turned into a bloodthirsty demon. Consumed by rage and hatred, Tanjirou swears to avenge his family and stay by his only remaining sibling. Alongside the mysterious group calling themselves the Demon Slayer Corps, Tanjirou will do whatever it takes to slay the demons and protect the remnants of his beloved sister\'s humanity.', 'anime/676543474.jpg', 0),
(17, '492805771', 'Black Clover', ' Black Clover', 'Finished Airing', 'Pierrot', 'Fantasy', 1, 'Asta and Yuno were abandoned at the same church on the same day. Raised together as children, they came to know of the \"Wizard King\"â€”a title given to the strongest mage in the kingdomâ€”and promised that they would compete against each other for the position of the next Wizard King. However, as they grew up, the stark difference between them became evident. While Yuno is able to wield magic with amazing power and control, Asta cannot use magic at all and desperately tries to awaken his powers by training physically.', 'anime/492805771.jpg', 0),
(18, '70872530', 'Solo Leveling', 'Ore dake Level Up na Ken', 'Finished Airing', 'A-1 Pictures', 'Adult Cast', 1, 'Humanity was caught at a precipice a decade ago when the first gatesâ€”portals linked with other dimensions that harbor monsters immune to conventional weaponryâ€”emerged around the world. Alongside the appearance of the gates, various humans were transformed into hunters and bestowed superhuman abilities. Responsible for entering the gates and clearing the dungeons within, many hunters chose to form guilds to secure their livelihoods.\r\n\r\nSung Jin-Woo is an E-rank hunter dubbed as the weakest hunter of all mankind. While exploring a supposedly safe dungeon, he and his party encounter an unusual tunnel leading to a deeper area. Enticed by the prospect of treasure, the group presses forward, only to be confronted with horrors beyond their imagination. Miraculously, Jin-Woo survives the incident and soon finds that he now has access to an interface visible only to him. This mysterious system promises him the power he has long dreamed ofâ€”but everything comes at a price.', 'anime/70872530.jpg', 0),
(19, '5586', 'My Hero Academia', 'Boku no Hero Academia', 'Finished Airing', 'Bones', 'School, Super Power', 7, 'The appearance of \"quirks,\" newly discovered super powers, has been steadily increasing over the years, with 80 percent of humanity possessing various abilities from manipulation of elements to shapeshifting. This leaves the remainder of the world completely powerless, and Izuku Midoriya is one such individual.\r\n\r\nSince he was a child, the ambitious middle schooler has wanted nothing more than to be a hero. Izuku\'s unfair fate leaves him admiring heroes and taking notes on them whenever he can. But it seems that his persistence has borne some fruit: Izuku meets the number one hero and his personal idol, All Might. All Might\'s quirk is a unique ability that can be inherited, and he has chosen Izuku to be his successor!', 'anime/5586.jpg', 0),
(20, '3101', 'ERASED', 'Boku dake ga Inai Machi', 'Finished Airing', 'A-1 Pictures', 'Psychological, Time Travel', 1, 'When tragedy is about to strike, Satoru Fujinuma finds himself sent back several minutes before the accident occurs. The detached, 29-year-old manga artist has taken advantage of this powerful yet mysterious phenomenon, which he calls \"Revival,\" to save many lives.\r\n\r\nHowever, when he is wrongfully accused of murdering someone close to him, Satoru is sent back to the past once again, but this time to 1988, 18 years in the past. Soon, he realizes that the murder may be connected to the abduction and killing of one of his classmates, the solitary and mysterious Kayo Hinazuki, that took place when he was a child. This is his chance to make things right.', 'anime/3101.jpg', 0),
(21, '868633', 'I Want To Eat Your Pancreas', 'Kimi no Suizou wo Tabetai', 'Finished Airing', 'Studio VOLN', 'School', 1, 'The aloof protagonist: a bookworm who is deeply detached from the world he resides in. He has no interest in others and is firmly convinced that nobody has any interest in him either. His story begins when he stumbles across a handwritten book, titled Living with Dying. He soon identifies it as a secret diary belonging to his popular, bubbly classmate Sakura Yamauchi. She then confides in him about the pancreatic disease she is suffering from and that her time left is finite. Only her family knows about her terminal illness; not even her best friends are aware. Despite this revelation, he shows zero sympathy for her plight, but caught in the waves of Sakura\'s persistent buoyancy, he eventually concedes to accompanying her for her remaining days.', 'anime/868633.jpg', 0),
(22, '128065', 'The Garden of Words', 'Kotonoha no Niwa', 'Finished Airing', 'CoMix Wave Films', 'Visual Arts', 1, 'On a rainy morning in Tokyo, Takao Akizuki, an aspiring shoemaker, decides to skip class to sketch designs in a beautiful garden. This is where he meets Yukari Yukino, a beautiful yet mysterious woman, for the very first time. Offering to make her new shoes, Takao continues to meet with Yukari throughout the rainy season, and without even realizing it, the two are able to alleviate the worries hidden in their hearts just by being with each other. However, their personal struggles have not disappeared completely, and as the end of the rainy season approaches, their relationship will be put to the test.', 'anime/128065.jpg', 0),
(24, '765602', 'NieR:Automata Ver1.1a', 'NieR:Automata Ver1.1a', 'Finished Airing', 'A-1 Pictures', 'Realistic, Game', 2, 'In a post-apocalyptic world overrun by alien-crafted \"Machine Lifeforms,\" humanity is preparing for its last stand. Forced to retreat to the Moon for safety, humans are pinning their hopes on a group of man-made androids known as YoRHa soldiers. Led by the all-purpose battle android YoRHa 2-gou B-gata \"2B,\" the group will fight to take control of the Earth back from its invaders.\r\n\r\nAs war against the machines rages on, the YoRHa slowly begin to see the first shards of truth underlying the brutal conflict. Facing the harsh reality before her, the unwavering warrior 2B starts to question her very existence and just how much she must sacrifice for the sake of humanity.', 'anime/765602.jpg', 0),
(25, '251678', 'Makeine: Too Many Losing Heroines!', 'Make Heroine ga Oosugiru!', 'Currently Airing', 'A-1 Pictures', 'School', 1, 'Despite not understanding much about fleeting teen romance, first-year high school student Kazuhiko Nukumizu still wonders how he would react if his life were to be turned into a love story. Regardless, as a self-proclaimed \"background character,\" Nukumizu is satisfied continuing his life as an introvert with a negligible social life. However, he suddenly finds himself too close to the spotlight when he witnesses his popular classmate Anna Yanami be rejected by her childhood friend in the middle of a family restaurant.', 'anime/251678.jpg', 0),
(26, '9420807', 'Dan Da Dan', 'Dandadan', 'Finished Airing', 'Science SARU', 'Comedy, TeenAge', 1, 'Reeling from her recent breakup, Momo Ayase, a popular high schooler, shows kindness to her socially awkward schoolmate, Ken Takakura, by standing up to his bullies. Ken misunderstands her intentions, believing he has made a new friend who shares his obsession with aliens and UFOs. However, Momo\'s own eccentric occult beliefs lie in the supernatural realm; she thinks aliens do not exist. A rivalry quickly brews as each becomes determined to prove the other wrong.\r\n\r\nDespite their initial clash over their opposing beliefs, Momo and Ken form an unexpected but intimate friendship, a bond forged in a series of supernatural battles and bizarre encounters with urban legends and paranormal entities. As both develop unique superhuman abilities, they learn to supplement each other\'s weaknesses, leading them to wonder if their newfound partnership may be about more than just survival.', 'anime/9420807.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `popular`
--

CREATE TABLE `popular` (
  `id` int(11) NOT NULL,
  `anime_id` varchar(11) NOT NULL,
  `cover` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popular`
--

INSERT INTO `popular` (`id`, `anime_id`, `cover`) VALUES
(1, '72215', 'anime/72215_cover.jpg'),
(2, '7133536', 'anime/7133536_cover.jpg'),
(3, '15438718', 'anime/15438718_cover.png'),
(4, '383865', 'anime/383865_cover.png'),
(5, '089171329', 'anime/89171329_cover.jpg'),
(6, '07186275', 'anime/7186275_cover.jpg'),
(12, '765602', 'anime/765602_cover.jpg'),
(13, '251678', 'anime/251678_cover.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `season`
--

CREATE TABLE `season` (
  `id` int(11) NOT NULL,
  `anime_id` varchar(11) NOT NULL,
  `id_name` varchar(150) NOT NULL,
  `season` varchar(5) NOT NULL,
  `season_name` varchar(150) NOT NULL,
  `ep` smallint(6) NOT NULL,
  `aired_ep` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `season`
--

INSERT INTO `season` (`id`, `anime_id`, `id_name`, `season`, `season_name`, `ep`, `aired_ep`) VALUES
(1, '72215', 'kaguya-sama-wa-kokurasetai-tensai-tachi-no-renai-zunousen', '1', 'Kaguya-sama: Love is War', 12, 12),
(2, '72215', 'kaguya-sama-wa-kokurasetai-tensai-tachi-no-renai-zunousen-2', '2', 'Kaguya-sama: Love is War?', 12, 12),
(3, '72215', 'kaguya-sama-wa-kokurasetai-ultra-romantic', '3', 'Kaguya-sama: Love is War -Ultra Romantic-', 13, 13),
(4, '72215', 'kaguya-sama-wa-kokurasetai-first-kiss-wa-owaranai', '4', 'Kaguya-sama: Love is War -The First Kiss That Never Ends-', 4, 4),
(5, '15438718', 'tokidoki-bosotto-russia-go-de-dereru-tonari-no-alya-san', '1', 'Alya Sometimes Hides Her Feelings in Russian', 12, 12),
(7, '07186275', 'shigatsu-wa-kimi-no-uso', '1', 'Your Lie In April', 22, 22),
(8, '383865', 'one-piece', '1', 'One Piece', 1114, 1117),
(9, '472519919', 'shikanoko-nokonoko-koshitantan', '1', 'My Deer Friend Nokotan', 12, 10),
(10, '089171329', 'kaijuu-8-gou', '1', 'Kaiju No. 8', 12, 12),
(11, '10412947', 'horimiya', '1', 'Horimiya', 13, 13),
(12, '10412947', 'horimiya-piece', '2', 'Horimiya : Piece', 13, 13),
(13, '7133536', 'jujutsu-kaisen-tv', '1', 'Jujutsu Kaisen', 24, 24),
(14, '7133536', 'jujutsu-kaisen-0', '-1', 'Jujutsu Kaisen 0', 1, 1),
(15, '7133536', 'jujutsu-kaisen-2nd-season', '2', 'Jujutsu Kaisen 2nd Season', 23, 23),
(16, '404875364', 'death-note', '1', 'Death Note', 37, 37),
(17, '4354794', 'youkoso-jitsuryoku-shijou-shugi-no-kyoushitsu-e-tv', '1', 'Classroom of the Elite', 12, 12),
(18, '4354794', 'youkoso-jitsuryoku-shijou-shugi-no-kyoushitsu-e-tv-2nd-season', '2', 'Classroom of the Elite II', 13, 13),
(19, '4354794', 'youkoso-jitsuryoku-shijou-shugi-no-kyoushitsu-e-3rd-season', '3', 'Classroom of the Elite III', 13, 13),
(20, '2785840', 'shingeki-no-kyojin', '1', 'Attack On Titan', 25, 25),
(21, '2785840', 'shingeki-no-kyojin-season-2', '2', 'Attack On Titan Season 2', 12, 12),
(22, '2785840', 'shingeki-no-kyojin-season-3', '3', 'Attack On Titan Season 3 Part I', 12, 12),
(23, '2785840', 'shingeki-no-kyojin-season-3-part-2', '3.5', 'Attack On Titan Season 3 Part II', 10, 10),
(24, '2785840', 'shingeki-no-kyojin-the-final-season', '4', 'Attack on Titan: The Final Season', 16, 16),
(25, '2785840', 'shingeki-no-kyojin-the-final-season-part-2', '4.5', 'Attack on Titan: The Final Season Part II', 12, 12),
(26, '383865', 'one-piece-film-gold', '-1', 'One Piece: Film GOLD', 1, 1),
(27, '383865', 'one-piece-film-z', '-2', 'One Piece Film: Z ', 1, 1),
(28, '383865', 'one-piece-film-red', '-3', 'One Piece Film: Red', 1, 1),
(46, '746857', 'naruto', '1', 'Naruto', 220, 220),
(47, '746857', 'naruto-shippuden', '2', 'Naruto: Shippuuden', 500, 500),
(49, '509000011', 'sono-bisque-doll-wa-koi-wo-suru', '1', 'My Dress-Up Darling', 12, 12),
(50, '676543474', 'kimetsu-no-yaiba', '1', 'Demon Slayer: Kimetsu no Yaiba', 26, 26),
(51, '676543474', 'kimetsu-no-yaiba-mugen-ressha-hen', '2', 'Demon Slayer: Kimetsu no Yaiba Mugen Train Arc', 7, 7),
(52, '676543474', 'kimetsu-no-yaiba-yuukaku-hen', '3', 'Demon Slayer: Kimetsu no Yaiba Entertainment District Arc', 11, 11),
(53, '676543474', 'kimetsu-no-yaiba-katanakaji-no-sato-hen', '4', 'Demon Slayer: Kimetsu no Yaiba Swordsmith Village Arc', 11, 11),
(54, '676543474', 'kimetsu-no-yaiba-hashira-geiko-hen', '5', 'Demon Slayer: Kimetsu no Yaiba Hashira Training Arc', 8, 8),
(55, '492805771', 'black-clover-tv', '1', 'Black Clover TV', 170, 170),
(56, '70872530', 'ore-dake-level-up-na-ken', '1', 'Solo Leveling', 12, 12),
(57, '5586', 'boku-no-hero-academia', '1', 'My Hero Academia', 13, 13),
(58, '5586', 'boku-no-hero-academia-2nd-season', '2', 'My Hero Academia Season 2', 25, 25),
(59, '5586', 'boku-no-hero-academia-3rd-season', '3', 'My Hero Academia Season 3', 25, 25),
(60, '5586', 'boku-no-hero-academia-4th-season', '4', 'My Hero Academia Season 4', 25, 25),
(61, '5586', 'boku-no-hero-academia-5th-season', '5', 'My Hero Academia Season 5', 25, 25),
(62, '5586', 'boku-no-hero-academia-6th-season', '6', 'My Hero Academia Season 6', 25, 25),
(63, '5586', 'boku-no-hero-academia-7th-season', '7', 'My Hero Academia Season 7', 21, 2),
(64, '3101', 'boku-dake-ga-inai-machi', '1', 'ERASED', 12, 12),
(65, '868633', 'kimi-no-suizou-wo-tabetai', '-1', 'I Want To Eat Your Pancreas', 1, 1),
(66, '128065', 'kotonoha-no-niwa', '-1', 'The Garden of Words', 1, 1),
(68, '765602', 'nierautomata-ver1-1a', '1', 'NieR:Automata Ver1.1a Part 1', 12, 12),
(69, '765602', 'nierautomata-ver1-1a-part-2', '2', 'NieR:Automata Ver1.1a Part 2', 12, 6),
(70, '251678', 'make-heroine-ga-oosugiru', '1', 'Makeine: Too Many Losing Heroines!', 12, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `remind` tinyint(1) NOT NULL DEFAULT 1,
  `theme` tinyint(1) NOT NULL DEFAULT 1,
  `region` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `fname`, `lname`, `email`, `pass`, `img`, `remind`, `theme`, `region`) VALUES
(1, 645, 'Kishmat', 'Bhattarai', 'bkishmat70@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'uploads/645/5Vb2wspZlQd5pYz.jpg', 1, 1, 1),
(2, 78914, 'Hlokn', 'Vlklh', 'f@gmail.com', 'dbffb25b95f81a9876ea1864d39eee0a54930bd9', '', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anime_list`
--
ALTER TABLE `anime_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`),
  ADD KEY `name` (`name`),
  ADD KEY `status` (`status`),
  ADD KEY `studio` (`studio`),
  ADD KEY `theme` (`theme`),
  ADD KEY `seasons` (`seasons`),
  ADD KEY `img` (`img`),
  ADD KEY `jp_name` (`jp_name`),
  ADD KEY `adult` (`adult`);

--
-- Indexes for table `popular`
--
ALTER TABLE `popular`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`),
  ADD KEY `cover` (`cover`);

--
-- Indexes for table `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`),
  ADD KEY `ep` (`ep`),
  ADD KEY `aired_ep` (`aired_ep`),
  ADD KEY `season` (`season`),
  ADD KEY `season_name` (`season_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `fname` (`fname`),
  ADD KEY `lname` (`lname`),
  ADD KEY `email` (`email`),
  ADD KEY `pass` (`pass`),
  ADD KEY `img` (`img`),
  ADD KEY `remind` (`remind`),
  ADD KEY `theme` (`theme`),
  ADD KEY `region` (`region`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anime_list`
--
ALTER TABLE `anime_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `popular`
--
ALTER TABLE `popular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `season`
--
ALTER TABLE `season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
