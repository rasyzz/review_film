-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 20, 2025 at 03:24 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `review_film`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin1@gmail.com|127.0.0.1', 'i:1;', 1738212462),
('admin1@gmail.com|127.0.0.1:timer', 'i:1738212462;', 1738212462),
('rasy1223@gmail.com|127.0.0.1', 'i:2;', 1742264973),
('rasy1223@gmail.com|127.0.0.1:timer', 'i:1742264973;', 1742264973),
('user@example.com|127.0.0.1', 'i:1;', 1738202035),
('user@example.com|127.0.0.1:timer', 'i:1738202035;', 1738202035);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `castings`
--

CREATE TABLE `castings` (
  `id_castings` bigint UNSIGNED NOT NULL,
  `stage_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `real_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_film` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `castings`
--

INSERT INTO `castings` (`id_castings`, `stage_name`, `real_name`, `id_film`, `created_at`, `updated_at`) VALUES
(1, 'Tom Hardy', 'Eddie Brock', 4, '2025-02-16 18:44:28', '2025-02-16 18:44:28'),
(2, 'Juno Templee', 'Dr. Teddy Paine', 4, '2025-02-16 18:56:25', '2025-02-16 18:59:39'),
(9, 'tomiy', 'bambang', 7, '2025-03-16 06:57:14', '2025-03-16 06:57:14'),
(10, 'lembang', 'lukman', 5, '2025-03-17 21:05:44', '2025-03-17 21:05:44'),
(11, 'Juno Temple', 'budi', 6, '2025-03-18 23:26:21', '2025-03-18 23:26:21'),
(12, 'rapa', 'bemo', 21, '2025-03-18 23:38:31', '2025-03-18 23:38:31'),
(13, 'test', 'ludin', 22, '2025-03-19 19:45:37', '2025-03-19 19:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comments` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_film` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comments`, `comment`, `rating`, `id_user`, `id_film`, `created_at`, `updated_at`) VALUES
(2, 'action yang bagus', '5', 3, 4, '2025-02-18 07:20:32', '2025-02-20 06:56:35'),
(7, 'sangat bagus filmnya', '4', 3, 8, '2025-02-20 06:47:57', '2025-02-20 06:54:45'),
(8, 'spiderman nya ada 5', '5', 3, 7, '2025-02-20 23:12:39', '2025-02-20 23:12:54'),
(9, 'fadil gunkid', '3', 3, 6, '2025-02-20 23:36:30', '2025-02-20 23:37:15'),
(10, 'anjayyyyy', '5', 5, 5, '2025-02-23 18:25:37', '2025-02-23 18:26:00'),
(11, 'dramatis dan bagus', '5', 2, 12, '2025-03-05 08:17:25', '2025-03-05 08:17:42'),
(12, 'keren dan bagsus', '4', 6, 12, '2025-03-11 18:54:29', '2025-03-11 19:09:53'),
(13, 'hello', '4', 2, 5, '2025-03-11 21:17:44', '2025-03-11 21:17:55'),
(19, 'test', '5', 1, 4, '2025-03-17 20:32:03', '2025-03-17 20:33:20'),
(20, 'test', '4', 3, 9, '2025-03-18 19:20:36', '2025-03-18 19:20:36'),
(21, 'test', '5', 3, 10, '2025-03-18 22:54:06', '2025-03-18 22:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id_film` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_year` int NOT NULL,
  `duration` int NOT NULL,
  `rating` int NOT NULL,
  `creator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_umur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id_film`, `title`, `poster`, `description`, `release_year`, `duration`, `rating`, `creator`, `kategori_umur`, `trailer`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 'Venom: The Last Dance', 'posters/FtwslrfDeZekuZ0E3Qa3awOF969B6Hq4pTdSqOcr.jpg', 'The Last Dance, Tom Hardy kembali sebagai Venom, salah satu karakter Marvel terhebat dan paling kompleks, untuk film terakhir dalam trilogi tersebut. Eddie dan Venom sedang dalam pelarian. Diburu oleh kedua dunia mereka dan dengan semakin dekatnya jaring, keduanya terpaksa mengambil keputusan yang menghancurkan yang akan menutup tirai tarian terakhir Venom dan Eddie.', 2024, 109, 4, 'Kelly Marcell', NULL, 'trailers/VSWvsrBW1gk7wH43ZV36Xiqahek1xPwHIFyixZsY.mp4', NULL, '2025-02-04 01:18:22', '2025-02-06 23:24:50'),
(5, 'Sekawan Limo', 'posters/GlQtX0rA8eD2vCX505nGSt3Wac4BO7wwUh8UrKWy.jpg', 'Sekawan Limo adalah sebuah film horor komedi Indonesia tahun 2024 yang disutradarai oleh Bayu Skak. Film yang dibintangi oleh Bayu Skak, Nadya Arina, Keisya Levronka, Dono Pradana, Benidictus Siregar, Indra Pramujito, Firza Valaza, dan Audya Ananta dirilis pada 4 Juli 2024.', 2024, 112, 5, 'Bayu Skak', NULL, 'trailers/4zGWnCVllD2OSthAZdP3y5PWziuF4bxpQOKyjkDo.mp4', NULL, '2025-02-04 20:23:01', '2025-02-04 20:23:01'),
(6, 'Guardians Of The Galaxy Vol.3', 'posters/110XJQVNa1dtz2Z8dZLeqb5s03uIShKSjK27OZ4b.jpg', 'Guardians of the Galaxy Vol. 3 adalah film superhero Marvel yang menceritakan tentang perjuangan Peter Quill dan timnya untuk menyelamatkan alam semesta. Film ini merupakan penutup dari trilogi Guardians of the Galaxy.', 2023, 150, 5, 'James Gunn', NULL, 'trailers/BWh0FQmi92Cbwq6Zx3g1uCqnTFmDzOmH4npV4WDV.mp4', NULL, '2025-02-04 20:29:45', '2025-02-04 20:29:45'),
(7, 'Spider-Man:No Way Home', 'posters/rEAdylxQKVGTgsxPiwxZtMy3kC1wVR1kGxuRndGV.jpg', 'Spider-Man: No Way Home adalah film pahlawan super Amerika Serikat berdasarkan karakter Marvel Comics, Spider-Man, yang diproduksi bersama oleh Marvel Studios, Columbia Pictures dan Pascal Pictures, dan didistribusikan oleh Sony Pictures Releasing. Film ini adalah sekuel Spider-Man: Homecoming (2017) dan Spider-Man: Far From Home (2019), dan merupakan film ke-27 di Marvel Cinematic Universe (MCU). Film ini disutradarai oleh Jon Watts, ditulis oleh Chris McKenna dan Erik Sommers, dan dibintangi oleh Tom Holland, Tobey Maguire, dan Andrew Garfield sebagai Peter Parker / Spider-Man, bersama Zendaya, Jacob Batalon, Marisa Tomei, Jamie Foxx, Benedict Cumberbatch dan Alfred Molina.', 2021, 148, 5, 'Jon Watts', NULL, 'trailers/gNrTIDMTkmVq6qfK9pNNXXtC4D9bydhKrEgcjWJm.mp4', NULL, '2025-02-04 20:43:27', '2025-02-04 20:43:27'),
(8, 'Godzilla x Kong: The New Empire', 'posters/7Mjzw5TQogcpAvhcDNxIy33yep634UuUlloksyEP.jpg', 'Godzilla x Kong: The New Empire[2] adalah sebuah film monster Amerika Serikat 2024 yang disutradarai oleh Adam Wingard. Diproduksi Legendary Pictures dan didistribusikan melalui Warner Bros. Pictures, serta menjadi sequel dari Godzilla vs. Kong (2021).  Film ini merupakan film kelima dari walaraba MonsterVerse. Dan film ke-38 dari seri Godzilla, dan King Kong, serta film Godzilla kelima yang diproduksi oleh studio Amerika. Diperankan oleh Rebecca Hall, Brian Tyree Henry, Dan Stevens, Kaylee Hottle, Alex Ferns, dan Fala Chen. Hall, Henry juga Hottle memerankan peran mereka seperti di film sebelumnya. Didalam film, Kong bertemu lebih banyak spesiesnya di Hollow Earth dan harus bergabung dengan Godzilla untuk menghentikan pemimpin tirani mereka menghancurkan permukaan.', 2024, 115, 5, 'Adam Wingard', '13', 'trailers/RYwwXITfBjvFeRH5e1lEg8y4CUDEbx4BrqxMAsfg.mp4', NULL, '2025-02-04 20:53:42', '2025-03-19 09:26:33'),
(9, 'Avengers: Infinity War', 'posters/SxBQqkDfwRbrk2EZy0ia9FknXFSu7YAauKu5KfWQ.jpg', 'Avengers: Infinity War adalah film pahlawan super Amerika Serikat yang dirilis tahun 2018 dan menceritakan tim superhero Avengers dari Marvel Comics. Film ini diproduksi oleh Marvel Studios dan didistribusikan oleh Walt Disney Studios Motion Pictures. Avengers: Infinity War adalah sekuel dari The Avengers (2012) dan Avengers: Age of Ultron (2015), dan film ke-19 dalam Marvel Cinematic Universe (MCU). Diarahkan oleh Anthony & Joe Russo dan ditulis oleh Christopher Markus and Stephen McFeely, film ini menampilkan sebuah kelompok pemeran termasuk Robert Downey Jr., Chris Hemsworth, Mark Ruffalo, Chris Evans, Scarlett Johansson, Benedict Cumberbatch, Don Cheadle, Tom Holland, Chadwick Boseman, Paul Bettany, Elizabeth Olsen, Anthony Mackie, Sebastian Stan, Danai Gurira, Letitia Wright, Dave Bautista, Zoe Saldaña, Josh Brolin, dan Chris Pratt. Dalam film ini, Avengers dan Guardians of the Galaxy berupaya untuk mencegah Thanos dari mengumpulkan enam maha kuasa Infinity Stones sebagai bagian dari usahanya untuk membunuh setengah dari semua kehidupan di alam semesta.', 2018, 149, 5, 'Anthony & Joe Russo', NULL, 'trailers/nYJv72XwydcRvNVZLdUrMxTQzZ4rajXHdxaq3rig.mp4', NULL, '2025-02-04 20:59:08', '2025-02-04 20:59:08'),
(10, 'Comic 8: Casino Kings part 2', 'posters/VTmWmrOUeHM9Pqh46w7bhd247fXeabpGldCsS3wc.jpg', 'Kedelapan agen rahasia (Arie Kriting, Babe Cabiita, Bintang Bete, Ernest Prakasa, Fico Fachriza, Ge Pamungkas, Kemal Palevi, Mongol Stres) yang memakai nama samaran “COMIC 8” kembali beraksi.  Mereka yang telah dijebak oleh THE KING (Sophia Latjuba) bersama para pasukannya yang dipimpin oleh Isa (Donny Alamsyah) dan Bella (Hannah Al Rashid), serta seorang konspirator licik bernama Dr. Pandji (Pandji Pragiwaksono) ; terpaksa bertaruh akan kelangsungan hidup mereka, di dalam permainan Judi daring yang tersebar ke para Raja Judi di seluruh dunia.', 2016, 95, 5, 'Anggy Umbara', NULL, 'trailers/iMR1R3WjMj9iYsGrX3bwE1y1W6iPqZfsdTYs6CL5.mp4', NULL, '2025-02-05 00:10:11', '2025-02-05 00:10:11'),
(11, 'Transformers: Rise of the Beasts', 'posters/EaT4yjjXlmXJMriGxROynzLessvMEgqstpKs6TI4.jpg', 'Transformers: Rise of the Beasts adalah orang Amerika tahun 2023 science fiction action film berdasarkan Hasbro\'s Transformers garis mainan, dan terutama dipengaruhi oleh Beast Wars alur cerita. Film ini adalah angsuran ketujuh dalam Transformers live-action film series. Melayani sebagai standalone sequel ke Bumblebee (2018) and prequel ke Transformers (2007),[6] film ini disutradarai oleh Steven Caple Jr. dari skenario oleh Joby Harold, Darnell Metayer, Josh Peters, Erich Hoeber, dan Jon Hoeber.[7] Itu dibintangi Anthony Ramos dan Dominique Fishback, serta bakat suara dari Ron Perlman, Peter Dinklage, Michelle Yeoh, Liza Koshy, Michaela Jaé Rodriguez, Pete Davidson, Colman Domingo, Cristo Fernández, Tongayi Chirisa, dan mengembalikan pelanggan tetap waralaba Peter Cullen, John DiMaggio, dan David Sobolov.', 2023, 127, 5, 'Steven Caple Jr.', NULL, 'trailers/kBJLQlhG012AGQ4QS1zIkKbz3tGAq9YRpvRFmPeF.mp4', NULL, '2025-02-05 00:21:42', '2025-02-05 00:21:42'),
(12, 'Perayaan Mati Rasa', 'posters/8Vp8kU7bFbgu5NS2GdPEu5Z2Y6aGTPNjOkoL3yWL.jpg', 'Film ini menceritakan Ian Antono yang selalu dibanding-bandingkan dengan adiknya, Uta Antono. Uta selalu memiliki kehidupan cemerlang sesuai keinginan kedua orangtuanya. Di sisi lain, Ian berusaha mengejar mimpinya dalam karier bermusik. Namun, Uta dan Ian kehilangan orangtua secara mendadak. Ia lalu berusaha untuk kuat dan mengubur semua perasaannya hingga mati rasa.', 2025, 125, 5, 'Umay Shahab & Reka Wijaya', NULL, 'trailers/HFA4OvuizWmsgfdqxLxnQNPs7P4ZXl1OsGC6LA5Y.mp4', NULL, '2025-02-05 00:25:10', '2025-02-06 18:57:37'),
(13, 'Thaghut', 'posters/staJnvzqoYLpsx3S8UjR1Gy4deQl6IGfBeg7rjDQ.jpg', 'Thaghut adalah sebuah film hantu thriller Indonesia tahun 2024 yang disutradarai oleh Bobby Prasetyo. Film yang tayang di bioskop Indonesia pada 29 Agustus 2024 ini dibintangi oleh Yasmin Napper, Arbani Yasiz, Ria Ricis, Whani Dharmawan, Dennis Adhiswara, Hana Saraswati dan Keanu Azka.', 2024, 102, 5, 'Bobby Prasetyo', NULL, 'trailers/Fg3cGXYhA3aaSJVd0nw2uNUp8kxnX9IyCGonlrsr.mp4', NULL, '2025-02-05 00:34:59', '2025-02-05 00:37:21'),
(14, 'Dilan 1983 : Wo Ai Ni', 'posters/0SgjStyBJfd3HAkktEY6EQrwbJawxjEWpUra7mus.jpg', 'Dilan 1983: Wo Ai Ni adalah film drama keluarga Indonesia tahun 2024 yang disutradarai oleh Fajar Bustomi dan ditulis oleh Pidi Baiq dan Alim Sudio. Film tersebut merupakan prekuel dari film-film Dilan 1990, Dilan 1991, Milea: Suara dari Dilan dan Ancika: Dia yang Bersamaku 1995. Film ini dirilis pada 13 Juni 2024.', 2024, 116, 5, 'Fajar Bustomi & Paidi Baiqq', NULL, 'trailers/mNYkYd5Aeaq6ZcqCDUq49vkFSu2Fv4lYvRxxrBoJ.mp4', NULL, '2025-02-06 18:57:07', '2025-03-13 08:04:02'),
(15, 'Di Ambang Kematian', 'posters/GDXGZg3ZCAd5NJKuyj6JIhOYPC1R0dEbOKQfwqIY.jpg', 'Di Ambang Kematian adalah film horor Indonesia tahun 2023 yang disutradarai oleh Azhar Kinoi Lubis. Film ini merupakan adaptasi dari thread viral @jeropoint di Twitter berdasarkan kisah nyata.[1]  Film produksi MVP Pictures ini dibintangi oleh Taskya Namya, Wafda Saifan, dan Teuku Rifnu Wikana.  Di Ambang Kematian tayang perdana di bioskop pada tanggal 28 September 2023.', 2023, 97, 5, 'Azhar Kinoi Lubis', NULL, 'trailers/mU2gDomGgeXabcitA0cHd0tHHHBWmlKGPBIe2sd8.mp4', NULL, '2025-02-06 19:00:49', '2025-02-06 19:00:49'),
(16, 'Mencuri Raden Saleh', '3Lz1UUvw5HmbIPvq0F6DGEHZnVIIaBIpukDZcJYy.jpg', 'Mencuri Raden Saleh adalah sebuah film aksi perampokan Indonesia tahun 2022 yang disutradarai oleh Angga Dwimas Sasongko.[2][3] Film yang ditayangkan di bioskop Indonesia mulai 25 Agustus 2022[4] ini dibintangi oleh Iqbaal Ramadhan, Angga Yunanda, Rachel Amanda, Umay Shahab, Aghniny Haque, dan Ari Irham.', 2022, 154, 5, 'Angga Dwimas Sasongko', NULL, '5alnMB5sfFq2hzPdOAdZcAXC4d1xlhlNJxzDqxl3.mp4', '2025-02-06 19:06:22', '2025-02-06 19:00:51', '2025-02-06 19:06:22'),
(17, 'Mencuri Raden Salehh', 'WltsC1jYBc0bICua1Nf1iygJA2eBE1KA1UEo1xGh.jpg', 'Mencuri Raden Saleh adalah sebuah film aksi perampokan Indonesia tahun 2022 yang disutradarai oleh Angga Dwimas Sasongko.[2][3] Film yang ditayangkan di bioskop Indonesia mulai 25 Agustus 2022[4] ini dibintangi oleh Iqbaal Ramadhan, Angga Yunanda, Rachel Amanda, Umay Shahab, Aghniny Haque, dan Ari Irham.', 2022, 154, 4, 'Angga Dwimas Sasongko', NULL, 'trailers/KHU5XdsHbmGDrPsMb8ld2KOPwCk1ZfniaWIqdHLg.mp4', '2025-03-13 05:58:36', '2025-02-06 19:08:09', '2025-03-13 05:58:36'),
(18, 'Mencuri Raden Saleh', 'posters/Rc3U8g6rJGK3xlXdLdNdyXacoCHHKYrsz9pQWvk5.jpg', 'Sekelompok mahasiswa, Piko \"The Forger\" (Iqbaal Ramadhan), Ucup \"The Hacker\" (Angga Yunanda), Fella \"The Negotiator\" (Rachel Amanda Aurora), Gofar \"The Handyman\" (Umay Shahab), Sarah \"The Brute\" (Aghniny Haque), dan Tuktuk \"The Driver\" (Ari Irham) berencana untuk mencuri lukisan bersejarah. Lukisan tersebut adalah Penangkapan Pangeran Diponegoro karya Raden Saleh, yang berada di Istana Presiden dan tak ternilai harganya. Masing-masing memiliki peran dan tugas yang berbeda dalam menjalankan rencana pencurian ini.  Aksi pencurian ini tentunya tidak akan berjalan mudah. Apalagi, lukisan itu disimpan di Istana Presiden yang tentunya memiliki sistem keamanan superketat.', 2022, 154, 5, 'Angga Dwimas Sasongko', NULL, 'trailers/QD1UNO3vVzDy2iywmP7LJgXEnMk09EtWP27NZyKJ.mp4', '2025-03-18 20:25:12', '2025-03-13 05:56:50', '2025-03-18 20:25:12'),
(19, 'hore', 'posters/JPTKyMQssQzCa7v2ZLwkX7UcQqe0wqae44U0O68u.jpg', 'hwcacvqe', 2022, 134, 5, 'goda', NULL, 'trailers/PcVSP7pkjHhcaXwDg1pSNUBDY9I78W93ZGUXUHIV.mp4', '2025-03-13 06:13:15', '2025-03-13 06:12:43', '2025-03-13 06:13:15'),
(20, 'godzilla', 'posters/3LPlFqHb45704zjThQpQSTSqfNdE0HXHKVcWjgvx.jpg', 'as', 2021, 123, 5, 'budi', NULL, 'trailers/11b9xtPuvWNJWxz8LdDZTgmmupLQHaDE3FyzbYxQ.mp4', '2025-03-13 06:20:41', '2025-03-13 06:18:12', '2025-03-13 06:20:41'),
(21, 'ramalan', 'posters/Gq5a683D4TxOpKkEhPPXqbExS6IPeRccRoiQozMm.jpg', 'wwww', 2021, 123, 5, 'Bayu Skak', '17', 'trailers/nHcmPfrbGkH1sBREui9DtHB1vEC6OkfljmbfIl15.mp4', NULL, '2025-03-18 23:00:08', '2025-03-19 18:02:49'),
(22, 'bebas', 'posters/9YFMkYmo90D5IhfWWy0u9iPPbEcoxJAFLNVJNKrJ.jpg', 'Dilan 1983: Wo Ai Ni adalah film drama keluarga Indonesia tahun 2024 yang disutradarai oleh Fajar Bustomi dan ditulis oleh Pidi Baiq dan Alim Sudio. Film tersebut merupakan prekuel dari film-film Dilan 1990, Dilan 1991, Milea: Suara dari Dilan dan Ancika: Dia yang Bersamaku 1995. Film ini dirilis pada 13 Juni 2024.', 2022, 132, 5, 'Azhar Kinoi Lubis', '14', 'trailers/NTowJt3HneqObb9NMI2gS9kKFuzdfUpANZZ9i2lq.mp4', NULL, '2025-03-19 09:13:28', '2025-03-19 09:26:47'),
(23, 'test', 'posters/xbEFSHEnD4nc0MTWiLJeERaJuT2bW3vJKO0UME8k.jpg', 'Mencuri Raden Saleh adalah sebuah film aksi perampokan Indonesia tahun 2022 yang disutradarai oleh Angga Dwimas Sasongko.[2][3] Film yang ditayangkan di bioskop Indonesia mulai 25 Agustus 2022[4] ini dibintangi oleh Iqbaal Ramadhan, Angga Yunanda, Rachel Amanda, Umay Shahab, Aghniny Haque, dan Ari Irham.', 2025, 162, 5, 'Angga Dwimas Sasongko', '17', 'trailers/kEZ90iBS1QHfGD2UQcIS430dBU1FTXerJU2t6sUG.mp4', NULL, '2025-03-19 19:26:47', '2025-03-19 19:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id_genre` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id_genre`, `title`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Action', 'action', NULL, '2025-02-04 07:24:37', '2025-02-04 07:24:37'),
(2, 'Adventure', 'adventure', NULL, '2025-02-04 07:46:09', '2025-02-04 08:12:39'),
(3, 'Comedy', 'comedy', NULL, '2025-02-04 08:14:36', '2025-02-04 08:14:36'),
(4, 'Drama', 'drama', NULL, '2025-02-04 08:14:50', '2025-02-04 08:14:50'),
(5, 'Fantasy', 'fantasy', NULL, '2025-02-04 08:15:16', '2025-02-04 08:15:16'),
(6, 'Horror', 'horror', NULL, '2025-02-04 08:15:30', '2025-02-04 08:15:30'),
(7, 'Misteri', 'misteri', NULL, '2025-02-04 08:16:01', '2025-02-04 08:16:01'),
(8, 'Romance', 'romance', NULL, '2025-02-04 08:16:20', '2025-02-04 08:16:20'),
(9, 'bagus', 'bagus', '2025-03-13 05:46:40', '2025-03-13 05:29:17', '2025-03-13 05:46:40'),
(10, 'bagus', 'bagus', '2025-03-13 05:51:55', '2025-03-13 05:48:56', '2025-03-13 05:51:55'),
(11, 'komedi', 'komedi', NULL, '2025-03-18 19:23:54', '2025-03-18 19:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `genre_relations`
--

CREATE TABLE `genre_relations` (
  `id` int UNSIGNED NOT NULL,
  `id_film` bigint UNSIGNED NOT NULL,
  `id_genre` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre_relations`
--

INSERT INTO `genre_relations` (`id`, `id_film`, `id_genre`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2025-02-20 19:48:45', '2025-02-20 19:48:45'),
(2, 4, 2, '2025-02-20 19:48:45', '2025-02-20 19:48:45'),
(8, 5, 6, '2025-02-20 20:17:04', '2025-02-20 20:17:04'),
(9, 6, 1, '2025-02-20 20:17:25', '2025-02-20 20:17:25'),
(10, 6, 2, '2025-02-20 20:17:25', '2025-02-20 20:17:25'),
(11, 6, 5, '2025-02-20 20:17:25', '2025-02-20 20:17:25'),
(12, 7, 1, '2025-02-20 20:17:36', '2025-02-20 20:17:36'),
(13, 7, 2, '2025-02-20 20:17:36', '2025-02-20 20:17:36'),
(14, 8, 2, '2025-02-20 20:17:47', '2025-02-20 20:17:47'),
(15, 8, 5, '2025-02-20 20:17:47', '2025-02-20 20:17:47'),
(16, 9, 1, '2025-02-20 20:18:04', '2025-02-20 20:18:04'),
(17, 9, 2, '2025-02-20 20:18:04', '2025-02-20 20:18:04'),
(18, 9, 5, '2025-02-20 20:18:04', '2025-02-20 20:18:04'),
(19, 10, 3, '2025-02-20 20:18:19', '2025-02-20 20:18:19'),
(20, 11, 1, '2025-02-20 20:18:34', '2025-02-20 20:18:34'),
(21, 11, 2, '2025-02-20 20:18:34', '2025-02-20 20:18:34'),
(22, 11, 5, '2025-02-20 20:18:34', '2025-02-20 20:18:34'),
(23, 12, 4, '2025-02-20 20:18:56', '2025-02-20 20:18:56'),
(26, 14, 4, '2025-02-20 20:19:44', '2025-02-20 20:19:44'),
(27, 14, 8, '2025-02-20 20:19:44', '2025-02-20 20:19:44'),
(28, 15, 6, '2025-02-20 20:19:54', '2025-02-20 20:19:54'),
(29, 15, 7, '2025-02-20 20:19:54', '2025-02-20 20:19:54'),
(41, 5, 3, NULL, NULL),
(42, 15, 7, '2025-03-18 20:47:15', '2025-03-18 20:47:15'),
(43, 5, 7, '2025-03-18 20:50:21', '2025-03-18 20:50:21'),
(44, 5, 11, '2025-03-18 20:50:21', '2025-03-18 20:50:21'),
(45, 10, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_30_064532_create_films_table', 2),
(5, '2025_01_30_064855_create_genres_table', 2),
(6, '2025_01_30_071305_create_films_table', 3),
(7, '2025_01_30_071353_create_genre_table', 4),
(8, '2025_01_30_072333_create_genres_table', 5),
(9, '2025_01_30_073055_create_castings_table', 6),
(10, '2025_01_30_074101_create_comments_table', 7),
(11, '2025_01_30_074309_create_genres_relations_table', 8),
(12, '2025_02_21_022129_create_genre_relations_table', 9),
(13, '2025_03_19_160156_add_kategori_umur_to_films_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('LH3W45JhSLHcmHkOtjwmISDi3cqjKlv9tQT3juM3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQW5jdVl2TkZnd0JKbXM5bUdFeVBQaFFMdHBIRDJRYkxlRkVQNm5nVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1742439546),
('qrQkJT7IXf6Nx5vWUsAz0ceAjzEvnjnTVESl1AMx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWtsSmZvN3VNWm1CbXdqUFVMRXlmZ2hYMElWd3NJS0ZzSFk0SmRGTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742436391);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','author','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `no_tlp`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', NULL, 'admin@example.com', NULL, '$2y$12$f4rsmH5H5QIwPp/01x5e4OKah0H7D4wx2JmFWSbGmotqqCKBD073S', 'admin', NULL, '2025-01-29 17:33:53', '2025-01-29 17:33:53'),
(2, 'Author User', NULL, 'author@example.com', NULL, '$2y$12$Aw.X.NWlDprv7H4YTgffBuMcroNONHBd38X5Z5SNhgtc8mbs2cYPS', 'author', NULL, '2025-01-29 17:33:54', '2025-01-29 17:33:54'),
(3, 'Subscriber User', NULL, 'subscriber@example.com', NULL, '$2y$12$mxuSCo9lic1qdmLTSCUr1.F6za.N6vKgINv9Wr4zhkHh7b7PRm3ce', 'user', 'EQJHurn8bUw9lxZhehdCZL3V6tRuKZbwEyZrKWsJmZJKoEI0HzNaUZ7UmMYo', '2025-01-29 17:33:54', '2025-01-29 17:33:54'),
(5, 'andika', NULL, 'andksjp19@gmail.com', NULL, '$2y$12$GdIIarwWRq2yxR6WgCWXdem8hTIGG4/kmIoCMBn2Cc4T1qd1RJkKS', 'user', NULL, '2025-02-23 18:17:27', '2025-02-23 18:17:27'),
(6, 'rasy', NULL, 'rasy1223@gmail.com', NULL, '$2y$12$WrFOWAqv/9eT6PwvVfSGoeyBmykAfwLHCysYugsDK4Q4DX1T1Rqb6', 'admin', NULL, '2025-03-11 07:37:28', '2025-03-17 20:14:12'),
(7, 'budi', NULL, 'budi12@gmail.com', NULL, '$2y$12$cjErJcoTYLrQ/ilg.RxZG.eEQNCf6w.bACyhyDPT8ksrw4qxFcK0S', 'user', NULL, '2025-03-16 06:40:50', '2025-03-16 06:40:50'),
(8, 'fauz', NULL, 'faiz@gmail.com', NULL, '$2y$12$1wSg6zkUzZb5N3yGTWSBuOD.33K/kpBwB3jlIgHDi.dNgTNCdM7ta', 'user', NULL, '2025-03-18 23:16:10', '2025-03-18 23:16:10'),
(9, 'faiz', '082213522241', 'fzz@gmail.com', NULL, '$2y$12$AJT1YlsJ0bHlTwvbPNyiF.FZGrlXEqdsOpfuXgiN4RnaBSyRj8Ugu', 'user', NULL, '2025-03-18 23:24:36', '2025-03-18 23:24:36'),
(10, 'rasy', '083341512231', 'rsy@gmail.com', NULL, '$2y$12$bUYewG4H/It11M.kzjTfi.0T3q8uv8l3smF7ZV0bbAQcdCGHM26xK', 'author', NULL, '2025-03-18 23:25:21', '2025-03-18 23:25:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `castings`
--
ALTER TABLE `castings`
  ADD PRIMARY KEY (`id_castings`),
  ADD KEY `castings_id_film_foreign` (`id_film`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comments`),
  ADD KEY `comments_id_user_foreign` (`id_user`),
  ADD KEY `comments_id_film_foreign` (`id_film`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id_film`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `genre_relations`
--
ALTER TABLE `genre_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_relations_id_film_foreign` (`id_film`),
  ADD KEY `genre_relations_id_genre_foreign` (`id_genre`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `castings`
--
ALTER TABLE `castings`
  MODIFY `id_castings` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comments` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id_film` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id_genre` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `genre_relations`
--
ALTER TABLE `genre_relations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `castings`
--
ALTER TABLE `castings`
  ADD CONSTRAINT `castings_id_film_foreign` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_id_film_foreign` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `genre_relations`
--
ALTER TABLE `genre_relations`
  ADD CONSTRAINT `genre_relations_id_film_foreign` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`) ON DELETE CASCADE,
  ADD CONSTRAINT `genre_relations_id_genre_foreign` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id_genre`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
