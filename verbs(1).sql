-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Cze 2023, 13:54
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `verbs`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `verbs`
--

CREATE TABLE `verbs` (
  `id` int(11) NOT NULL,
  `verbInPolish` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `verbInInfinitive` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `verbInPastSimple1` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `verbInPastSimple2` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `verbInPastParticiple1` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `verbInPastParticiple2` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `additionalDescription` varchar(5000) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `verbs`
--

INSERT INTO `verbs` (`id`, `verbInPolish`, `verbInInfinitive`, `verbInPastSimple1`, `verbInPastSimple2`, `verbInPastParticiple1`, `verbInPastParticiple2`, `additionalDescription`) VALUES
(12, 'Bić', 'Beat ', 'Beat ', '', 'Beaten', '', ''),
(13, 'Stawać Się', 'Become ', 'Became ', '', 'Become ', '', '\r\n'),
(14, 'Zaczynać', 'Begin', 'Began', '', 'Begun', '', ''),
(15, 'Łamać', 'Break ', 'Broke', '', 'Broken ', '', ''),
(16, 'Przynosić', 'Bring', 'Brought ', '', 'Brought ', '', '\r\n'),
(17, 'Budować', 'Build ', 'Built', '', 'Built ', '', ''),
(18, 'Spalić', 'Burn ', 'Burnt ', '', 'Burnt ', '', ''),
(19, 'Kupować', 'Buy ', 'Bought ', '', 'Bought ', '', '\r\n'),
(20, 'Wybierać', 'Choose ', 'Chose ', '', 'Chosen ', '', '\r\n'),
(21, 'ciąć', 'cut', 'cut', '', 'cut', '', ''),
(22, 'Śnić', 'Dream ', 'Dreamt', '', 'Dreamt ', '', '\r\n'),
(23, 'Sprzedawać', 'Sell ', 'Sold ', '', 'Sold ', '', '\r\n'),
(24, 'Wykopywać / Kopać', 'Dig', 'Dug', '', 'Dug', '', ''),
(25, 'Czuć', 'Feel', 'Felt', '', 'Felt', '', '\r\n');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `verbs`
--
ALTER TABLE `verbs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `verbs`
--
ALTER TABLE `verbs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
