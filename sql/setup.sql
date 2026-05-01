
DROP TABLE IF EXISTS quiz_attempts;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS topics;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at DATETIME NOT NULL
);

CREATE TABLE topics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NULL
);

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    topic_id INT NOT NULL,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,
    correct_answer VARCHAR(255) NOT NULL,
    CONSTRAINT fk_questions_topic FOREIGN KEY (topic_id) REFERENCES topics(id) ON DELETE CASCADE
);

CREATE TABLE quiz_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    topic_id INT NOT NULL,
    score INT NOT NULL,
    total_questions INT NOT NULL,
    played_at DATETIME NOT NULL,
    CONSTRAINT fk_attempts_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_attempts_topic FOREIGN KEY (topic_id) REFERENCES topics(id) ON DELETE CASCADE
);

INSERT INTO users (username, password_hash, role, created_at) VALUES
('admin', '$2y$12$Ddo90l4eWBrqpTpae22pA.WtmPrlrt2Uy6Y7mMXonxtGFbjyOfhgq', 'admin', NOW());

INSERT INTO topics (name, description) VALUES
('Sports', 'Jautājumi par sportu – futbols, basketbols un citi. 🏀⚽'),
('Music', 'Jautājumi par to cik labi pazīsti mūziku 🎧.'),
('Movies', 'Filmu fans vai tikai skatītājs? 😏 Pārbaudi sevi'),
('Science', 'Mazliet loģikas, mazliet zinātnes… cik gudrs tu esi? 🧠'),
('Geography', 'Pasaules karte galvā vai Google Maps? 🌍');

INSERT INTO questions (topic_id, question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES

(1, 'Kāds sporta veids ir saistīts ar NBA?😆', 'Basketbols', 'Hokejs', 'Teniss', 'Golfs', 'Basketbols'),
(1, 'Cik spēlētāju vienlaikus ir futbola komandā laukumā?', '11', '9', '7', '5', '11'),
(1, 'Kurā sporta veidā izmanto raketi un tīklu?', 'Teniss', 'Bokss', 'Peldēšana', 'Riteņbraukšana', 'Teniss'),
(1, 'Kura valsts uzvarēja 2014. gada FIFA Pasaules kausā?', 'Vācija', 'Brazīlija', 'Argentīna😆', 'Spānija', 'Vācija'),
(1, 'Kurā sporta veidā lieto ripu?', 'Hokejs', 'Beisbols', 'Handbols', 'Regbijs', 'Hokejs'),
(1, 'Maratona distance ir aptuveni...', '42.195 km', '21 km', '50 km', '10 km', '42.195 km'),
(1, 'Kurā sporta veidā ir ''slam dunk''?😆', 'Basketbols', 'Volejbols', 'Futbols', 'Badmintons', 'Basketbols'),
(1, 'Cik punkti ir touchdown amerikāņu futbolā?', '6', '3', '1', '9', '6'),
(1, 'Kurš no šiem ir ziemas sporta veids?', 'Biatlons', 'Sērfošana', 'Krikets', 'Beisbols', 'Biatlons'),
(1, 'Kādā sporta veidā slavenas ir Tour de France sacensības?😆', 'Riteņbraukšana', 'Autosports', 'Skriešana', 'Airēšana', 'Riteņbraukšana'),
(1, 'Kurā spēlē izmanto terminu ''checkmate''?', 'Šahs', 'Dambrete', 'Pokeris', 'Biljards', 'Šahs'),
(1, 'Kurš ekipējums ir obligāts bokserim ringā?', 'Cimdi', 'Slidas', 'Nūja', 'Raketa', 'Cimdi'),
(1, 'Kādā sporta veidā izmanto servi, setu un geimu?😆', 'Teniss', 'Regbijs', 'Polo', 'Hokejs', 'Teniss'),
(1, 'Kurā sporta veidā Latvija bieži tiek saistīta ar Porziņģi?', 'Basketbols', 'Futbols', 'Hokejs', 'Bobslejs', 'Basketbols'),
(1, 'Kurš no šiem nav komandu sporta veids?', 'Peldēšana', 'Basketbols', 'Futbols', 'Volejbols', 'Peldēšana');
(1, 'Kurš no šiem NAVV sporta veids? vispār', 'šautriņas', 'Basketbols', '😆šahs', 'staigāšana, soļošana i mean ', 'gulēšana');

INSERT INTO questions (topic_id, question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES
(2, 'Cik notis ir klasiskajā diatoniskajā gammā?', '7', '5', '8', '12', '7'),
(2, 'Kurš instruments pieder stīgu instrumentiem?', 'Ģitāra', 'Bungas', 'Trompete', 'Flauta', 'Ģitāra'),
(2, 'Kurš mūzikas stils saistās ar improvizāciju?', 'Džezs', 'Maršs', 'Himna', 'Opera', 'Džezs'),
(2, 'Kas parasti nosaka dziesmas tempu?(nezinu pats)', 'BPM', 'RGB', 'PDF', 'CPU', 'BPM'),
(2, 'Kurš no šiem ir sitaminstruments?', 'Bungas', 'Vijole', 'Klarnete', 'Čells', 'Bungas'),
(2, 'Kā sauc ļoti augstu sievietes balsi?', 'Soprāns', 'Bass', 'Tenors', 'Baritons', 'Soprāns'),
(2, 'Kurš komponists sarakstīja ''Für Elise''?', 'Bēthovens', 'Mozarts', 'Bahs', 'Vivaldi', 'Bēthovens'),
(2, 'Kurš no šiem ir taustiņinstruments?', 'Klavieres', 'Trombons', 'Arfa', 'Oboja', 'Klavieres'),
(2, 'Kas ir albums?', 'Dziesmu apkopojums', 'Mikrofona statīvs', 'Skatuves gaisma', 'Koncerta biļete', 'Dziesmu apkopojums'),
(2, 'Kurš no šiem nav mūzikas žanrs?', 'Bluetooth', 'Roks', 'Pops', 'Hip-hop', 'Bluetooth'),
(2, 'Kā sauc dziesmas vārdus?', 'Lirika', 'Taktsmērs', 'Akords', 'Metrs', 'Lirika'),
(2, 'Kurš simbols bieži norāda pauzi?', 'Rests', 'Sharp', 'Flat', 'Clef', 'Rests'),
(2, 'Kā sauc vairāku nošu skanējumu kopā?', 'Akords', 'Takts', 'Solo', 'Bīts', 'Akords'),
(2, 'Kurš no šiem ir pūšaminstruments?', 'Saksofons', 'Kontrabass', 'Bungas', 'Pianīns', 'Saksofons'),
(2, 'Kas ir refrēns?', 'Atkārtojošā dziesmas daļa', 'Dziesmas nosaukums', 'Instrumenta marka', 'Skatuves fons', 'Atkārtojošā dziesmas daļa');

INSERT INTO questions (topic_id, question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES
(3, 'Kurš režisēja filmu ''Titanic''? LEonardo DiCaprio ha-ha neuzkeries', 'James Cameron', 'Steven Spielberg', 'Christopher Nolan', 'Ridley Scott', 'James Cameron'),
(3, 'Kurš varonis dzīvo Gothamas City?', 'Batman', 'Superman', 'Shrek', 'Harry Potter', 'Batman'),
(3, 'Kurā filmā ir tēls Jack Sparrow? Johnny Depp ja kas', 'Pirates of the Caribbean', 'Avatar', 'Gladiator', 'Inception', 'Pirates of the Caribbean'),
(3, 'Kā sauc filmu sēriju par burvi ar rētu uz pieres?', 'Harry Potter', 'Star Wars🪖', 'Matrix', 'Rocky', 'Harry Potter'),
(3, 'Kura filma ieguva Oskaru kā labākā filma 2020. gadā?', 'Parasite', 'Joker', '1917', 'Ford v Ferrari', 'Parasite'),
(3, 'Kas ir animācijas filma? tev sis jazina ez ', 'Filma ar zīmētiem vai datorveidotiem tēliem', 'Tikai melnbalta filma', 'Tikai dokumentāla filma', 'Filma bez skaņas', 'Filma ar zīmētiem vai datorveidotiem tēliem'),
(3, 'Kurā filmā redzams tēls Forrest Gump? sito pats nezinu🥹', 'Forrest Gump', 'Cast Away', 'Top Gun🔫', 'The Terminal', 'Forrest Gump'),
(3, 'Kurš no šiem ir zinātniskās fantastikas žanrs?', 'Sci-fi', 'Romantika', 'Biogrāfija', 'Vesterns', 'Sci-fi'),
(3, 'Kā sauc filmas priekšskatījumu?', 'Treileris', 'Titri', 'Kadra plāns', 'Montāža', 'Treileris'),
(3, 'Kurā filmā ir citāts ''I am your father''?', 'Star Wars', 'The Godfather', 'Rocky', 'Jaws', 'Star Wars'),
(3, 'Kas ir režisors?', 'Cilvēks, kurš vada filmas veidošanu', 'Galvenais aktieris', 'Filmas skatītājs', 'Kinoteātra īpašnieks', 'Cilvēks, kurš vada filmas veidošanu'),
(3, 'Kurš no šiem ir multfilmas tēls?', 'Shrek', 'Sherlock Holmes', 'Napoleon', 'Hamlet', 'Shrek'),
(3, 'Kā sauc balvu kino industrijā ASV?', 'Oskars', 'Grammy', 'Pulicers', 'Emmy Sports', 'Oskars'),
(3, 'Kurā filmā cilvēki dzīvo pasaulē ar zilas ādas? (mana mīļākā filma ja kas)', 'Avatar', 'Dune', 'Frozen', 'Coco', 'Avatar'),
(3, 'Filmas noslēguma uzraksti tiek saukti par... (edit)', 'Titriem', 'Kadriem', 'Scenāriju', 'Treileri', 'Titriem');

INSERT INTO questions (topic_id, question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES
(4, 'Kura planēta ir vistuvāk Saulei? (mazs hint: tur ir karsti 🔥)', 'Merkurs🧠', 'Venēra', 'Marss', 'Jupiters', 'Merkurs'),
(4, 'H2O ir kāds ķīmiskais apzīmējums...', 'Ūdenim', 'Skābeklim', 'Sālim', 'Ogleklim', 'Ūdenim🌊'),
(4, 'Kurš orgāns pumpē asinis cilvēka ķermenī?', 'Sirds', 'Aknas', 'Plaušas', 'Nieress', 'Sirds'),
(4, 'Kā sauc spēku, kas velk objektus uz Zemi? (tev sitais jazin)', 'Gravitācija', 'Berze', 'Magnētisms', 'Elektrība', 'Gravitācija'),
(4, 'Kurš no šiem ir zīdītājs?(šo daudzi sajauc 😅)', 'Delfīns', 'Haizivs🦈', 'Ķirzaka', 'Varde', 'Delfīns'),
(4, 'Augu zaļā krāsa pārsvarā rodas no...', 'Hlorofila', 'Dzelzs', 'Skābekļa', 'Slāpekļa', 'Hlorofila'),
(4, 'Kurā temperatūrā normālā spiedienā sasalst ūdens?🧊', '0°C', '100°C', '🧊-10°C', '32°C', '0°C'),
(4, 'Kas ir Saules sistēmas lielākā planēta?', 'Jupiters', 'Saturns', 'Zeme', 'Neptūns', 'Jupiters'),
(4, 'Kura gāze cilvēkam nepieciešama elpošanai?🪟', 'Skābeklis', 'Hēlijs', 'Oglekļa monoksīds. kaut kass', 'Argons', 'Skābeklis'),
(4, 'DNS satur...', 'Ģenētisko informāciju', 'Tikai ūdeni', 'Minerālvielas', 'Saules enerģiju', 'Ģenētisko informāciju'),
(4, 'Kurš no šiem ir metāls?', 'Dzelzs', 'Plastmasa', 'Stikls', 'Koks', 'Dzelzs'),
(4, 'Kas notiek fotosintēzes laikā?', 'Augs ražo glikozi un skābekli', 'Augs ražo tikai sāli', 'Augs izdala benzīnu', 'Augs kļūst par akmeni', 'Augs ražo glikozi un skābekli'),
(4, 'Kurā zinātnes nozarē pēta zvaigznes un planētas?', 'Astronomija', 'Ģeoloģija', 'Psiholoģija', 'Ekonomika', 'Astronomija'),
(4, 'Cik kāju ir kukainim?', '6', '8', '4', '10', '6'),
(4, 'pH 7 šķīdums parasti ir...', 'Neitrāls', 'Skābs', 'Sārms', 'Radioaktīvs', 'Neitrāls');

INSERT INTO questions (topic_id, question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES
(5, 'Kura ir Francijas galvaspilsēta?', 'Parīze', 'Roma', 'Madride', 'Berlīne', 'Parīze'),
(5, 'Kurš kontinents ir lielākais pēc platības?', 'Āzija', 'Āfrika', 'Eiropa', 'Austrālija', 'Āzija'),
(5, 'Latvijas galvaspilsēta ir...', 'Rīga', 'Liepāja', 'Daugavpils', 'Jelgava', 'Rīga'),
(5, 'Kura upe tek cauri Londonai?', 'Temza', 'Daugava', 'Nīla', 'Donava', 'Temza'),
(5, 'Kur atrodas piramīdas Gīzā?', 'Ēģiptē', 'Meksikā', 'Indijā', 'Grieķijā', 'Ēģiptē'),
(5, 'Kura valsts ir pazīstama kā Uzlecošās saules zeme?', 'Japāna', 'Ķīna', 'Taizeme', 'Norvēģija', 'Japāna'),
(5, 'Kurš okeāns ir lielākais?🚣‍♀️🚣‍♀️', 'Klusais okeāns', 'Atlantijas okeāns', 'Indijas okeāns', '🧊Arktikas okeāns', 'Klusais okeāns'),
(5, 'Kurš no šiem ir kontinents?', 'Antarktīda', 'Grenlande', 'Madagaskara', 'Sicīlija', 'Antarktīda'),
(5, 'Kura valūta tiek lietota Vācijā?', 'Eiro', 'Dolārs', 'Jena', 'Mārciņa', 'Eiro'),
(5, 'Kurā valstī atrodas pilsēta Barselona?', 'Spānija', 'Portugāle', 'Itālija', 'Francija', 'Spānija'),
(5, 'Kura ir pasaules augstākā virsotne?', 'Everests', 'Monblāns', 'Kilimandžāro', 'Elbruss', 'Everests'),
(5, 'Kura jūra apskalo Latviju?', '🧊Baltijas jūra', 'Vidusjūra', 'Melnā jūra', 'Sarkanā jūra', 'Baltijas jūra'),
(5, 'Kura valsts robežojas ar Latviju dienvidos?', 'Lietuva', 'Somija', 'Zviedrija', 'Polija', 'Lietuva'),
(5, 'Kur atrodas Brīvības statuja?', 'Ņujorkā', 'Toronto', 'Sidnejā', 'Dublinā', 'Ņujorkā'),
(5, 'Kura ir Itālijas galvaspilsēta?', 'Roma', 'Milāna', 'Venēcija', 'Napole', 'Roma');
