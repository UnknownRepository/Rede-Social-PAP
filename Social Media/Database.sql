-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Mar-2021 às 22:11
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pap`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `posted_at` datetime NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logintokenn`
--
-- Erro ao ler a estrutura para a tabela pap.logintokenn: #1932 - Table 'pap.logintokenn' doesn't exist in engine
-- Erro ao ler dados para tabela pap.logintokenn: #1064 - Você tem um erro de sintaxe no seu SQL próximo a 'FROM `pap`.`logintokenn`' na linha 1

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `sender` int(11) UNSIGNED NOT NULL,
  `receiver` int(11) UNSIGNED NOT NULL,
  `read` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`id`, `body`, `sender`, `receiver`, `read`) VALUES
(138, 'Olá pedroo', 72, 71, 0),
(139, 'Olá tá tudo?', 71, 72, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` int(11) UNSIGNED NOT NULL,
  `receiver` int(10) UNSIGNED NOT NULL,
  `sender` int(11) UNSIGNED NOT NULL,
  `extra` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `receiver`, `sender`, `extra`) VALUES
(1, 1, 52, 50, ' { \"postbody\": \"@RitaGomes Ol&aacute; rita\" } '),
(2, 2, 50, 50, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_token`
--

CREATE TABLE `password_token` (
  `id` int(11) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `body` varchar(160) NOT NULL,
  `posted_at` datetime NOT NULL,
  `likes` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `postimg` varchar(255) DEFAULT NULL,
  `topics` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `body`, `posted_at`, `likes`, `user_id`, `postimg`, `topics`) VALUES
(290, 'Hoje cheguei a casa e estou assim ', '2021-03-30 15:48:09', 0, 68, 'https://i.imgur.com/1PygRbm.jpg', NULL),
(291, 'Ganda Cena comi merda ', '2021-03-30 15:48:20', 0, 68, '', ''),
(292, 'Ontem foi espetacular\r\n', '2021-03-30 15:48:30', 0, 68, '', ''),
(293, 'Ontem foi espetacular\r\n', '2021-03-30 15:48:35', 0, 68, '', ''),
(294, 'asdfasf', '2021-03-30 15:48:55', 0, 68, '', ''),
(295, 'Tou mesmo fixe tou assim ', '2021-03-30 15:50:08', 2, 69, 'https://i.imgur.com/cvqz8Sk.jpg', NULL),
(296, 'LUL UUUUUUUUUUUUUUUUU', '2021-03-30 15:50:17', 1, 69, '', ''),
(297, 'Olá ', '2021-03-30 15:52:49', 2, 71, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`) VALUES
(736, 297, 71),
(737, 296, 71),
(738, 295, 71),
(740, 297, 72),
(741, 295, 72);

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguidores`
--

CREATE TABLE `seguidores` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `follower_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `seguidores`
--

INSERT INTO `seguidores` (`id`, `user_id`, `follower_id`) VALUES
(83, 69, 70),
(84, 69, 71),
(86, 71, 72);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `user_id`) VALUES
(334, '2537e3bbf7fbf9a602ce42c459c7741f70ab23f4', 72),
(335, 'a1f1dd9aeb87c19eda56df5f9e0af0cd21ca3e00', 72);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `PrimeiroNome` varchar(20) NOT NULL,
  `UltimoNome` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `profileimg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `PrimeiroNome`, `UltimoNome`, `username`, `email`, `password`, `profileimg`) VALUES
(68, 'qwer', 'qwerqwer', 'qwerqwer', 'qwerqwer@gmail.com', '$2y$10$ctTbZq5xDJm.gOxbnWlniePXqSBkvzbyM8nMtTQiXHLMgbHZHewhe', ''),
(69, 'Pedro', 'pereira', 'Ricardo fixe', 'ricardo@gmail.com', '$2y$10$Wl0h28sa64CaITfTtLlrlO7QDI1vLFtunpx7tHuc2negWlfMr3meK', ''),
(70, 'pedro', 'pereira', 'Pedro', 'Pedro@gmail.com', '$2y$10$9/d2fmkp3lBTs/6D3Q07ke0vwCUU7X6VuB8Oa74Ypt.6f/aK2tuBi', ''),
(71, 'Pedro ', 'Pereira', 'Pedroo', 'Pedroo@gmail.com', '$2y$10$/8ySWw0RoTFFz0efJCtlTeU1uE.vpR6keC22sh4MfUN1iUwwzHK1C', ''),
(72, 'Rita', 'Pereira', 'Rita', 'Rita@gmail.com', '$2y$10$/m1jSqgVJyDW7haKFbYMOuZryHcNFHDrYbE80JV5cpDdEV5n8GnNq', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadoress`
--
-- Erro ao ler a estrutura para a tabela pap.utilizadoress: #1932 - Table 'pap.utilizadoress' doesn't exist in engine
-- Erro ao ler dados para tabela pap.utilizadoress: #1064 - Você tem um erro de sintaxe no seu SQL próximo a 'FROM `pap`.`utilizadoress`' na linha 1

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_1` (`user_id`),
  ADD KEY `comments_ibfk_2` (`post_id`);

--
-- Índices para tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_token`
--
ALTER TABLE `password_token`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Índices para tabela `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT de tabela `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `password_token`
--
ALTER TABLE `password_token`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT de tabela `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=742;

--
-- AUTO_INCREMENT de tabela `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de tabela `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
