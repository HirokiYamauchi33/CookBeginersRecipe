-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-04-28 13:41:20
-- サーバのバージョン： 10.4.25-MariaDB
-- PHP のバージョン: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `cbr`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `tejun_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `file`
--

INSERT INTO `file` (`id`, `file_name`, `file_path`, `recipe_id`, `tejun_id`, `created_at`, `updated_at`) VALUES
(1, 'カレー.jpg', 'images/20230416192826カレー.jpg', 55, 0, '2023-04-16 19:28:26', '2023-04-16 10:28:26'),
(2, '手順ほんとうの 1.jpg', 'images/20230416192826手順ほんとうの 1.jpg', 55, 1, '2023-04-16 19:28:26', '2023-04-16 10:28:26'),
(3, '手順1.jpg', 'images/20230416192826手順1.jpg', 55, 2, '2023-04-16 19:28:26', '2023-04-16 10:28:26'),
(4, '手順2.jpg', 'images/20230416192826手順2.jpg', 55, 3, '2023-04-16 19:28:26', '2023-04-16 10:28:26'),
(5, '手順3.jpg', 'images/20230416192826手順3.jpg', 55, 4, '2023-04-16 19:28:26', '2023-04-16 10:28:26'),
(6, '手順5.jpg', 'images/20230416192826手順5.jpg', 55, 5, '2023-04-16 19:28:26', '2023-04-16 10:28:26'),
(7, '手順6.jpg', 'images/20230416192826手順6.jpg', 55, 6, '2023-04-16 19:28:26', '2023-04-16 10:28:26'),
(8, 'カレー.jpg', 'images/20230416192854カレー.jpg', 56, 0, '2023-04-16 19:28:54', '2023-04-16 10:28:54'),
(9, '手順ほんとうの 1.jpg', 'images/20230416192854手順ほんとうの 1.jpg', 56, 1, '2023-04-16 19:28:54', '2023-04-16 10:28:54'),
(10, '手順1.jpg', 'images/20230416192854手順1.jpg', 56, 2, '2023-04-16 19:28:54', '2023-04-16 10:28:54'),
(11, '手順2.jpg', 'images/20230416192854手順2.jpg', 56, 3, '2023-04-16 19:28:54', '2023-04-16 10:28:54'),
(12, '手順3.jpg', 'images/20230416192854手順3.jpg', 56, 4, '2023-04-16 19:28:54', '2023-04-16 10:28:54'),
(13, '手順5.jpg', 'images/20230416192854手順5.jpg', 56, 5, '2023-04-16 19:28:54', '2023-04-16 10:28:54'),
(14, '手順6.jpg', 'images/20230416192854手順6.jpg', 56, 6, '2023-04-16 19:28:54', '2023-04-16 10:28:54'),
(15, '餃子完成.jpg', 'images/20230416193535餃子完成.jpg', 57, 0, '2023-04-16 19:35:35', '2023-04-16 10:35:35'),
(16, '餃子１.png', 'images/20230416193535餃子１.png', 57, 1, '2023-04-16 19:35:35', '2023-04-16 10:35:35'),
(17, '餃子２.png', 'images/20230416193535餃子２.png', 57, 2, '2023-04-16 19:35:35', '2023-04-16 10:35:35'),
(18, '餃子３.png', 'images/20230416193535餃子３.png', 57, 3, '2023-04-16 19:35:35', '2023-04-16 10:35:35'),
(19, '餃子４.png', 'images/20230416193535餃子４.png', 57, 4, '2023-04-16 19:35:35', '2023-04-16 10:35:35'),
(20, '餃子５.png', 'images/20230416193535餃子５.png', 57, 5, '2023-04-16 19:35:35', '2023-04-16 10:35:35'),
(21, '餃子６.png', 'images/20230416193535餃子６.png', 57, 6, '2023-04-16 19:35:35', '2023-04-16 10:35:35');

-- --------------------------------------------------------

--
-- テーブルの構造 `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `material` varchar(255) NOT NULL,
  `quanity` varchar(255) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `material`
--

INSERT INTO `material` (`id`, `material`, `quanity`, `recipe_id`) VALUES
(1, 'S&Bとろけるカレー', '1/2箱', 55),
(2, '牛もも肉', '200g', 55),
(3, '玉ねぎ', '中1と1/2個（300g）', 55),
(4, 'にんじん', '小1本（100g）', 55),
(5, 'じゃがいも', '中１個（150g）', 55),
(6, 'サラダ油', '大さじ1', 55),
(7, '水', '700ml', 55),
(8, 'S&Bクミンシード', '小さじ1/2', 55),
(9, 'S&Bガラムマサラ', '適量', 55),
(10, 'S&Bローレル（ホール', '1枚', 55),
(11, 'S&Bとろけるカレー', '1/2箱', 56),
(12, '牛もも肉', '200g', 56),
(13, '玉ねぎ', '中1と1/2個（300g）', 56),
(14, 'にんじん', '小1本（100g）', 56),
(15, 'じゃがいも', '中１個（150g）', 56),
(16, 'サラダ油', '大さじ1', 56),
(17, '水', '700ml', 56),
(18, 'S&Bクミンシード', '小さじ1/2', 56),
(19, 'S&Bガラムマサラ', '適量', 56),
(20, 'S&Bローレル（ホール', '1枚', 56),
(21, '豚ひき肉', '150g', 57),
(22, 'キャベツ（または白菜）', '180g', 57),
(23, 'にら', '30g(約1/3束)', 57),
(24, '餃子の皮', '1袋(約25枚)', 57),
(25, 'モランボン　手作り餃子の素', '70g', 57);

-- --------------------------------------------------------

--
-- テーブルの構造 `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `level` int(11) NOT NULL,
  `users_id` int(100) NOT NULL,
  `recipe_id` int(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `comment`, `level`, `users_id`, `recipe_id`, `created_at`, `updated_at`) VALUES
(1, 'S&Bのカレー', '基本からよくわかるカレーの作り方', 4, 27, 55, '2023-04-16 19:28:26', '2023-04-16 10:28:26'),
(2, 'S&Bのカレー', '基本からよくわかるカレーの作り方', 4, 27, 56, '2023-04-16 19:28:54', '2023-04-16 10:28:54'),
(3, '餃子のおいしい作り方', 'モランボン参照', 2, 27, 57, '2023-04-16 19:35:35', '2023-04-16 10:35:35');

-- --------------------------------------------------------

--
-- テーブルの構造 `sequence`
--

CREATE TABLE `sequence` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `sequence`
--

INSERT INTO `sequence` (`id`) VALUES
(57);

-- --------------------------------------------------------

--
-- テーブルの構造 `tejun`
--

CREATE TABLE `tejun` (
  `id` int(11) NOT NULL,
  `proce_num` int(11) NOT NULL,
  `proce_com` varchar(200) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `tejun`
--

INSERT INTO `tejun` (`id`, `proce_num`, `proce_com`, `recipe_id`) VALUES
(1, 1, '野菜を食べやすい大きさに切ります。', 55),
(2, 2, '鍋にサラダ油を入れ、中火から強火で肉を焼き、その後取り出しておきます。', 55),
(3, 3, '同じ鍋にクミンシードを入れ弱火にかけます。', 55),
(4, 4, '野菜を入れよく炒めます。玉ねぎが茶色くなってきたら取り出しておいた肉を入れて全体を混ぜます。', 55),
(5, 5, '水とローレルを加えて煮込み灰汁をよくとります。その後ルゥを入れて弱火でとろみが出るまで煮込みます。', 55),
(6, 6, '最後にガラムマサラを適量振り、味を調えたら完成です。', 55),
(7, 1, '野菜を食べやすい大きさに切ります。', 56),
(8, 2, '鍋にサラダ油を入れ、中火から強火で肉を焼き、その後取り出しておきます。', 56),
(9, 3, '同じ鍋にクミンシードを入れ弱火にかけます。', 56),
(10, 4, '野菜を入れよく炒めます。玉ねぎが茶色くなってきたら取り出しておいた肉を入れて全体を混ぜます。', 56),
(11, 5, '水とローレルを加えて煮込み灰汁をよくとります。その後ルゥを入れて弱火でとろみが出るまで煮込みます。', 56),
(12, 6, '最後にガラムマサラを適量振り、味を調えたら完成です。', 56),
(13, 1, 'ひき肉に手作り餃子の素を加えよく練り合わせ、みじん切りした野菜を入れて混ぜ合わせます。', 57),
(14, 2, '具はすぐには使わず、一時間ほど冷蔵庫で置きます。', 57),
(15, 3, '皮を手に乗せ、中央に餃子の具をのせます。', 57),
(16, 4, '皮の両端をつかみながら、三本指でひだを作りながらつまみます。', 57),
(17, 5, 'フライパンに油を入れ、餃子を並べ蓋をして中火で加熱し、皮の色が変わったら餃子が1/3浸る程度に水を加え、再度蓋をして強火で蒸し焼きにします。', 57),
(18, 6, '水分がなくなったらフタをとり、餃子の上から油を少量ふりかけ、パリっと焼き目がついたらできあがり。', 57);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `prof_file_name` varchar(255) NOT NULL,
  `prof_file_path` varchar(255) NOT NULL,
  `greeting` varchar(101) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `nickname`, `email`, `password`, `prof_file_name`, `prof_file_path`, `greeting`, `role`, `created_at`, `updated_at`, `status`) VALUES
(16, 'テスト', '3rz5kn8v', 'test@test.jp', '$2y$10$GNHD03Kf5pwpViUKUEf45O9/wdMQQnOpMhl6xjZUQdTray/qNQSSa', '0', '0', '', 0, '2023-03-03 09:27:45', '2023-04-08 14:07:44', 1),
(19, 'aaaa', 'tx16c4pe', 'aaaaaa@aaaaaa.aaaa', '$2y$10$dwd7SW2/BtyYC3hUwpvu.OdS/nBSynJN6.w6/9lQmX34zro7okyKq', '0', '0', '', 0, '2023-03-03 11:13:16', '2023-03-03 02:13:16', 1),
(20, 'テストです。', 'be7rwydz', 'status@test.jp', '$2y$10$/EXLo4B5m9ZB5HaxybC/.uQ6KZyDgihImyuztboodtaBq9F81J9ya', '0', '0', '', 0, '2023-03-03 11:18:42', '2023-03-03 02:18:42', 1),
(21, 'やまうち　ひろき', '紫宮るな推し', 'EditTest@test.jp', '$2y$10$BjSShIcq5XPzQh9eND5g5u7VVqwtNLr18TsPFzouSyR.efH3LEfKW', 'IMG_6079.JPG', 'Profile_images/20230403163640IMG_6079.JPG', 'マシュキリエライト', 2, '2023-03-03 13:43:34', '2023-04-04 04:16:28', 0),
(23, 'たなか', 'たなか', 'test@test.jp', '$2y$10$LJ8oClpgZCUTAV7Ky5v1hOujgLKEBpQruOXj0JvP.jtyq6mg9T3P6', '餃子完成.jpg', 'Profile_images/20230416123805餃子完成.jpg', 'あああああああああああ', 0, '2023-04-03 12:05:02', '2023-04-16 03:39:40', 0),
(24, 'パスリセットくん', 'jdhuakso', 'password@reset.jp', '$2y$10$H0FLX.ACe.ozWKcWpd9ASu02ZVb8vznNL8RG9v0YZUAclbCrYY1Nu', '', '', '', 0, '2023-04-04 03:23:03', '2023-04-03 19:00:20', 0),
(25, '田中', 'sya5qzrf', 'tanaka@co.jp', '$2y$10$tsamSuzFWJFHNoQdc30DJe4hZkOC89dbcI2.62.KMOf.dUhs3wxH2', '', '', '', 0, '2023-04-13 14:38:11', '2023-04-13 05:38:11', 0),
(26, '管理者', '6ij4x3rf', 'admin@admin.jp', '$2y$10$ft0iChmfPtja6pW3apXNGOHMjINLBO37uutBVTfdA8tbHtC6p3OoG', '', '', '', 1, '2023-04-16 17:26:00', '2023-04-16 08:30:48', 0),
(27, 'やまうち', 'やまうち', 'yamauchi@test.jp', '$2y$10$C9T2mjUkHXY/nMeQlUdzt.p2UxklA5dwD6GGQWsOCMsRsyQJv601m', 'とりjpg.jpg', 'Profile_images/20230416192133とりjpg.jpg', '本番です。', 0, '2023-04-16 19:10:06', '2023-04-16 10:21:33', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `tejun`
--
ALTER TABLE `tejun`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- テーブルの AUTO_INCREMENT `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- テーブルの AUTO_INCREMENT `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `tejun`
--
ALTER TABLE `tejun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
