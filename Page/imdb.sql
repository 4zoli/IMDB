-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2018. Nov 27. 18:45
-- Kiszolgáló verziója: 10.1.36-MariaDB
-- PHP verzió: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `imdb`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekelesek`
--

CREATE TABLE `ertekelesek` (
  `fiokUsername` varchar(255) NOT NULL,
  `FilmID` int(255) NOT NULL,
  `pont` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `ertekelesek`
--

INSERT INTO `ertekelesek` (`fiokUsername`, `FilmID`, `pont`) VALUES
('pelda', 1, 5),
('pelda', 2, 4),
('pelda', 3, 4),
('pelda', 4, 2),
('pelda', 5, 4),
('pelda', 6, 5),
('pelda', 7, 1),
('pelda1', 5, 5);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `film`
--

CREATE TABLE `film` (
  `FilmID` int(255) NOT NULL,
  `FilmCim` varchar(100) NOT NULL,
  `FilmKategoria` varchar(100) DEFAULT NULL,
  `FilmLeiras` varchar(2000) DEFAULT NULL,
  `FilmTrailler` varchar(500) DEFAULT NULL,
  `FilmPoszter` varchar(255) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci; 


--
-- A tábla adatainak kiíratása `film`
--

INSERT INTO `film` (`FilmID`, `FilmCim`, `FilmKategoria`, `FilmLeiras`, `FilmTrailler`, `FilmPoszter`) VALUES
(1, 'Kingsman: The Secret Service', 'Akcio', 'Tokit kicsaptak az iskolabol, munka nelkul tengodik, az anyja lakasaban lakik es zuros eletet el. Amikor autolopasert lecsukjak, felhivja az apja halala utan kapott ermen levo telefonszamot. Ki is hozza ot a sittrol a kifogastalan modoru, angolosan elegans kem, Harry Hart, akinek annak idejen a fiu apja mentette meg az eletet. Harry megutkozik a srac eletmodjan, am lenyugozi a fiu tehetsege es az intelligenciaja, ezert felajanlja neki, hogy jelentkezhet a csapataba, ahol igazi James Bondot faragnak belole.  ', 'https://www.youtube.com/embed/kl8F-8tR8to', 'https://images-na.ssl-images-amazon.com/images/I/71iZKdbfa1L._SY606_.jpg'),
(2, 'Kingsman 2: The Golden Circle', 'Akcio', 'Ha a vilagot valami rettenetes baj, vilaguralomra toro fogonosz vagy mas effele remseg fenyegeti, akkor sem kell felnunk: van szakember, aki megallitja a gonoszsagot. A Kingsman kozelharcra es rejtvenyfejtesre egyarant tokeletesen kikepzett, uriember ugynokei majdnem mindig tudjak, mi a teendo. De neha a "majdnem mindig" is keves. Az uj ellenseg termeszetesen vilaguralomra tor, valoszinuleg orult, es biztosan langesz: sikeresen csapdaba csalja a Kingsman-csapatot, es felrobbantja a kozpontjukat. Csak az ujonc Toki es kikepzoje, Merlin ussza meg a tamadast: ok Amerikaba menekulnek, ahol a szervezetukhoz hasonlo, helyi ceg, a Statesman egy embere varja oket.', 'https://www.youtube.com/embed/4PggfbzJcvA', 'https://cdn.flickeringmyth.com/wp-content/uploads/2017/08/Kingsman-Golden-Circle-intl-poster-600x887.jpg'),
(3, 'Fight club', 'Drama', 'Amerika nagyvarosainak pinceiben egy titkos szervezet mukodik: ha egy ejjel az utca osszes nyilvanos telefonja osszetorik, ok jartak ott; ha egy kozteri szobor orias femgombje legurul talapzatarol, es szetrombol egy gyorsetkezdet, az az o muvuk; ha egy elegans bank parkolojanak osszes autojat rettentoen osszeronditjak a galambok - az sem veletlen. Vigyaznak a leveleinkre, atveszik telefonuzeneteinket, kisernek az utcan: es meg csak keszulnek a vegso dobasra: a nagy bummra... Pedig az egeszet csak ket tulzottan unatkozo jobarat talalta ki: azzal kezdtek, hogy rajottek, nincs jobb stresszoldo, mint ha alaposan megverik egymast. Pofonokat adni jo. Pofonokat kapni jo. Szamukra ez a boldog elet szabalya.', 'https://www.youtube.com/embed/Y6cwmHL2tFI', 'https://images-na.ssl-images-amazon.com/images/I/51v5ZpFyaFL.jpg'),
(4, 'I Origins', 'Drama', 'Dr. Ian Gray molekularis biologus a szem evoluciojan keresztul az emberi let keletkezeset kutatja. Egy este futo kalandba keveredik Sofival, az egzotikus fiatal novel, aki gyokeresen mas velemennyel van a vilag teremteserol. evekkel azutan, hogy Sofit tragikus korulmenyek kozott elveszitette, Dr. Gray es asszisztense, Karen fantasztikus felfedezest tesznek, amely alapjaiban rengetheti meg a tudomanyos vilagot. A munkajat es a maganeletet kockara teve az orvos Indiaba utazik, hogy szembenezzen az igazsaggal.', 'https://www.youtube.com/embed/HBFAf1-KGdY', 'https://images-na.ssl-images-amazon.com/images/I/914I-VXn3cL._RI_.jpg'),
(5, 'Venom', 'Sci-Fi', 'Az urbol jon, es csak akkor letezik, ha egy masik lenyen eloskodhet. Gazdateste Eddie Brock (Tom Hardy) ujsagiro, de o maga hidegfeju szadista, aki a vilag letet fenyegeti, am neha megis kiall az artatlanokert. Pokember egyik kulonleges ereju, veszelyes es kiismerhetetlen ellenfele maga sem tudja, hogy a feny vagy a sotetseg oldalan all-e: kulonleges betegsege (mely egyben az emberek fole emeli) neha a jok, neha a gonoszak koze sodorja. Abban az egesz Univerzumot megrazo csataban, amely most var ra, a josagara es a gonoszsagara is szuksege van.', 'https://www.youtube.com/embed/u9Mv98Gr5pY', 'https://vignette.wikia.nocookie.net/marveldatabase/images/5/57/Venom_%28film%29_poster_007.jpg/revision/latest?cb=20180911060215'),
(6, 'Sharknado', 'Vigjatek', 'A napfenyes Los Angeles fele soha nem latott tornadok kozelednek. A Csendes-ocean vizet felkavaro szeltolcserek capak ezreit repitik magukkal. A szelsoseges idojaras ozonvizet zudit a varosra es a tenger csucsragadozoi ellepik az utcakat. Egy csapat szorfos Baz (Jaason Simmons - Baywatch) vezetesevel sikeresen menekul a varost ellepo capak elol a biztonsagot nyujto Beverly Hills dombjai koze, azonban az ujra es ujra kialakulo tornadok elol sem a foldon, sem a levegoben nincsenek biztonsagban. Felesegevel (Tara Reid - Amerikai pite) es gyerekeivel karoltve hajmereszto taktikakat bevetve harcolnak a mindenhonnan lecsapo capakra.', 'https://www.youtube.com/embed/M-pXDoe5a0E', 'https://m.media-amazon.com/images/M/MV5BODcwZWFiNTEtNDgzMC00ZmE2LWExMzYtNzZhZDgzNDc5NDkyXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_.jpg'),
(7, 'The Hate U Give', 'Drama', 'A tortenet kozeppontjaban egy 16 eves szines boru lany all, Starr, aki szemtanuja lesz, ahogy legjobb baratjat , a fegyvertelen Khalit lelovi egy rendor.Minden, amit Starr ezek utan mond, felhasznalhato ellene: tonkreteheti a helyet, ahol el, onmagara es szeretett csaladjara is veszelyt jelent.', 'https://www.youtube.com/embed/3MM8OkVT0hw', 'https://resizing.flixster.com/pp-b3x1A85A8saF856hx8Rv5Gpk=/206x305/v1.bTsxMjg0NDEzMDtqOzE3OTIzOzEyMDA7MjAyNTszMDAw');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fiok`
--

CREATE TABLE `fiok` (
  `FiokUsername` varchar(255) NOT NULL,
  `FiokNev` varchar(255) NOT NULL,
  `FiokEmail` varchar(255) NOT NULL,
  `FiokJelszo` varchar(255) NOT NULL,
  `Jog` int(255) NOT NULL,
  `Bann` tinyint(1) NOT NULL,
  `Nema` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `fiok`
--

INSERT INTO `fiok` (`FiokUsername`, `FiokNev`, `FiokEmail`, `FiokJelszo`, `Jog`, `Bann`, `Nema`) VALUES
('admin', 'Admin', 'admin@admin.admin', '$2y$10$9cGgAiZ0VFck1PEugjN5Eu3dKf4gdwlhRTWwDoVU5ckEMwTt5RuRq', 3, 0, 0),
('asdqwe', 'Asdqwe', 'asd@asd', '$2y$10$nEx9KiyomjWICNyHqFoIquRkE21ZPq1wh3R/iwWKbYSGDIfdyTs1e', 1, 0, 0),
('mod', 'Mod', 'mod@mod.mod', '$2y$10$40ESdsuGNReqN4pQKb.V2OCX7ooOWPyhiHP7YdO4PhAXbB0cidRHu', 2, 0, 0),
('oliver', 'Oliver', 'oliver@oliver.hu', '$2y$10$Vnb863bpcz9yzqZQyQ3wCuwiecaB2uNxBU8DJwe.yv5WixGrcRUnu', 3, 0, 0),
('pelda', 'Pelda', 'pelda@pelda1.com', '$2y$10$F6d7dRonU1sJD7LS2Gtc6e0StvdDSB1E5J7drV4JWG6cR7RAJ0lE2', 1, 0, 0),
('pelda1', 'Pelda1', 'pelda1@pleda1.com', '$2y$10$zsMDHoNnSbQ8uzSWRn79W.lo9ygVs9rypy8z43diol3jqcmsgtTrG', 1, 0, 0),
('qweqwe', 'Qweqwe', 'qwe@qweqwe', '$2y$10$gRsxxzzPaL8wItnbyhdjhOVKj8cLDFZJL7sBYyHlFv3KmjUKnbxee', 1, 0, 0),
('user', 'User', 'user@user.hu', '$2y$10$eHxWKnEox/70wkAU/AO60.iRjHiHtdxYQwVgy1ngK3Mx7nuvcMlZu', 1, 0, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzaszolasok`
--

CREATE TABLE `hozzaszolasok` (
  `HozzaszolasID` int(255) NOT NULL,
  `HozzaszolasIdo` varchar(255) NOT NULL,
  `HozzaszolasSzoveg` varchar(255) NOT NULL,
  `FilmID` int(11) NOT NULL,
  `FiokUsername` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `hozzaszolasok`
--

INSERT INTO `hozzaszolasok` (`HozzaszolasID`, `HozzaszolasIdo`, `HozzaszolasSzoveg`, `FilmID`, `FiokUsername`) VALUES
(1, '2018-11-27', 'probacomment1', 6, 'pelda'),
(2, '2018-11-27', 'probacomment2', 6, 'pelda'),
(3, '2018-11-27', 'probacomment3', 6, 'pelda'),
(4, '2018-11-27', 'probacomment1', 1, 'pelda'),
(5, '2018-11-27', 'probacomment2', 1, 'pelda'),
(6, '2018-11-27', 'probacomment3', 1, 'pelda'),
(7, '2018-11-27', 'probacomment4', 6, 'pelda1'),
(8, '2018-11-27', 'probacomment4', 1, 'pelda1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kedvencek`
--

CREATE TABLE `kedvencek` (
  `fiokUsername` varchar(255) NOT NULL,
  `FilmID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `kedvencek`
--

INSERT INTO `kedvencek` (`fiokUsername`, `FilmID`) VALUES
('admin', 3),
('oliver', 1),
('oliver', 2),
('oliver', 3),
('oliver', 4),
('oliver', 5),
('pelda', 1),
('pelda', 2),
('pelda', 3),
('pelda', 4),
('pelda', 5),
('pelda', 6),
('pelda1', 1),
('pelda1', 6);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szerepel`
--

CREATE TABLE `szerepel` (
  `FilmID` int(11) NOT NULL,
  `SzineszID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `szerepel`
--

INSERT INTO `szerepel` (`FilmID`, `SzineszID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 5),
(2, 6),
(2, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 29),
(6, 21),
(6, 22),
(6, 23),
(6, 24),
(7, 25),
(7, 26),
(7, 27),
(7, 28),
(7, 29);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szinesz`
--

CREATE TABLE `szinesz` (
  `SzineszID` int(255) NOT NULL,
  `SzineszNev` varchar(255) NOT NULL,
  `SzineszTwitter` varchar(255) DEFAULT NULL,
  `SzineszInstagram` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `szinesz`
--

INSERT INTO `szinesz` (`SzineszID`, `SzineszNev`, `SzineszTwitter`, `SzineszInstagram`) VALUES
(1, 'Taron Egerton', NULL, NULL),
(2, 'Colin Firth', NULL, NULL),
(3, 'Samuel L. Jackson', NULL, NULL),
(4, 'Michael Caine', NULL, NULL),
(5, 'Julianne Moore', NULL, NULL),
(6, 'Mark Strong', NULL, NULL),
(7, 'Halle Berry', NULL, NULL),
(8, 'Edward Norton', NULL, NULL),
(9, 'Brad Pitt', NULL, NULL),
(10, 'Helena Bonham Carter', NULL, NULL),
(11, 'Meat Loaf', NULL, NULL),
(12, 'Jared Leto', NULL, NULL),
(13, 'Michael Pitt', NULL, NULL),
(14, 'Brit Marling', NULL, NULL),
(15, 'Astrid Berges-Frisbey', NULL, NULL),
(16, 'Steven Yeun', NULL, NULL),
(17, 'Archie Panjabi', NULL, NULL),
(18, 'Tom Hardy', NULL, NULL),
(19, 'Michelle Williams', NULL, NULL),
(20, 'Riz Ahmed', NULL, NULL),
(21, 'Jaason Simmons', NULL, NULL),
(22, 'Ian Ziering', NULL, NULL),
(23, 'Tara Reid', NULL, NULL),
(24, 'John Heard', NULL, NULL),
(25, 'Amandla Stenberg', NULL, NULL),
(26, 'Russell Hornsby', NULL, NULL),
(27, 'Anthony Mackie', NULL, NULL),
(28, 'Issa Rae', NULL, NULL),
(29, 'Regina Hall', NULL, NULL);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD PRIMARY KEY (`fiokUsername`,`FilmID`),
  ADD KEY `FilmID` (`FilmID`);

--
-- A tábla indexei `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`FilmID`);

--
-- A tábla indexei `fiok`
--
ALTER TABLE `fiok`
  ADD PRIMARY KEY (`FiokUsername`);

--
-- A tábla indexei `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  ADD PRIMARY KEY (`HozzaszolasID`),
  ADD KEY `FilmID` (`FilmID`);

--
-- A tábla indexei `kedvencek`
--
ALTER TABLE `kedvencek`
  ADD PRIMARY KEY (`fiokUsername`,`FilmID`),
  ADD KEY `FilmID` (`FilmID`);

--
-- A tábla indexei `szerepel`
--
ALTER TABLE `szerepel`
  ADD PRIMARY KEY (`FilmID`,`SzineszID`),
  ADD KEY `SzineszID` (`SzineszID`);

--
-- A tábla indexei `szinesz`
--
ALTER TABLE `szinesz`
  ADD PRIMARY KEY (`SzineszID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `film`
--
ALTER TABLE `film`
  MODIFY `FilmID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
 ALTER TABLE `film`;

--
-- AUTO_INCREMENT a táblához `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  MODIFY `HozzaszolasID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `szinesz`
--
ALTER TABLE `szinesz`
  MODIFY `SzineszID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
  

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD CONSTRAINT `ertekelesek_ibfk_1` FOREIGN KEY (`fiokUsername`) REFERENCES `fiok` (`FiokUsername`),
  ADD CONSTRAINT `ertekelesek_ibfk_2` FOREIGN KEY (`FilmID`) REFERENCES `film` (`FilmID`);

--
-- Megkötések a táblához `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  ADD CONSTRAINT `FilmID` FOREIGN KEY (`FilmID`) REFERENCES `film` (`FilmID`),
  ADD CONSTRAINT `hozzaszolasok_ibfk_1` FOREIGN KEY (`FiokUsername`) REFERENCES `fiok` (`FiokUsername`);

--
-- Megkötések a táblához `kedvencek`
--
ALTER TABLE `kedvencek`
  ADD CONSTRAINT `kedvencek_ibfk_1` FOREIGN KEY (`FilmID`) REFERENCES `film` (`FilmID`),
  ADD CONSTRAINT `kedvencek_ibfk_2` FOREIGN KEY (`fiokUsername`) REFERENCES `fiok` (`FiokUsername`);

--
-- Megkötések a táblához `szerepel`
--
ALTER TABLE `szerepel`
  ADD CONSTRAINT `szerepel_ibfk_1` FOREIGN KEY (`FilmID`) REFERENCES `film` (`FilmID`),
  ADD CONSTRAINT `szerepel_ibfk_2` FOREIGN KEY (`SzineszID`) REFERENCES `szinesz` (`SzineszID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
