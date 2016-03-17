-- phpMyAdmin SQL Dump
-- version 4.5.0-rc1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 17/03/2016 às 14:25
-- Versão do servidor: 5.5.47-0+deb8u1
-- Versão do PHP: 5.6.17-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_libpower`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_book`
--

CREATE TABLE `tb_book` (
  `id_book` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(100) NOT NULL,
  `book_year` year(4) NOT NULL,
  `book_edition` int(2) NOT NULL,
  `book_publisher` varchar(50) NOT NULL,
  `book_pages` int(4) NOT NULL,
  `book_country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_book`
--

INSERT INTO `tb_book` (`id_book`, `category_id`, `book_title`, `book_author`, `book_year`, `book_edition`, `book_publisher`, `book_pages`, `book_country`) VALUES
(1, 1, 'Como eu era antes de Você', 'Jojo Moyes', 2001, 2, 'Intrinseca', 297, 'Estados Unidos'),
(2, 3, 'Programando com PHP enquanto come Rapadura', 'Chiquim das Rapaduras', 2015, 1, 'Rapadura do Sucesso', 198, 'Ceará'),
(3, 1, 'As Aventuras de Nailton', 'Agatha Cristie', 2015, 2, 'Novatec', 424, 'Brasil'),
(4, 3, 'Python e Django', 'Chiquim', 2009, 1, 'Novatec', 209, 'Brasil');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_category`
--

CREATE TABLE `tb_category` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(40) NOT NULL,
  `category_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_category`
--

INSERT INTO `tb_category` (`id_category`, `category_name`, `category_desc`) VALUES
(1, 'Romance', 'Pode referir-se a dois gêneros literários. bla bla bla'),
(2, 'Ficção Ciêntifica', 'Ficção Cientifica é a bla bla bla...'),
(3, 'Linguagens de Programação', 'Livros Técnicos que ensinam a programar... E dominar o mundo.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_collection`
--

CREATE TABLE `tb_collection` (
  `id_collection` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `collection_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_collection`
--

INSERT INTO `tb_collection` (`id_collection`, `book_id`, `collection_quantity`) VALUES
(1, 1, 28),
(2, 2, 8),
(3, 3, 1),
(4, 4, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_loan`
--

CREATE TABLE `tb_loan` (
  `id_loan` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `loan_date` int(11) NOT NULL,
  `loan_devolution` tinyint(1) NOT NULL,
  `loan_devolution_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_loan`
--

INSERT INTO `tb_loan` (`id_loan`, `user_id`, `book_id`, `loan_date`, `loan_devolution`, `loan_devolution_date`) VALUES
(1, 3, 1, 1458110710, 1, 1458111623),
(2, 3, 2, 1458156066, 1, 1458156084),
(3, 4, 3, 1458161054, 1, 1458161301),
(4, 4, 4, 1458164628, 1, 1458164681),
(5, 4, 2, 1458164654, 0, 0),
(6, 5, 1, 1458164846, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_profile`
--

CREATE TABLE `tb_profile` (
  `id_profile` int(11) NOT NULL,
  `profile_name` varchar(30) NOT NULL,
  `profile_page` varchar(30) NOT NULL,
  `profile_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_profile`
--

INSERT INTO `tb_profile` (`id_profile`, `profile_name`, `profile_page`, `profile_status`) VALUES
(1, 'Administrador', 'admin.php', 1),
(2, 'Bibliotecario', 'librarian.php', 1),
(3, 'Leitor', 'reader.php', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `user_created_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_last_access` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `profile_id`, `user_name`, `user_email`, `user_password`, `user_status`, `user_created_in`, `user_last_access`) VALUES
(1, 1, 'Alessandro Feitoza', 'admin@admin.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-03-16 05:10:57', 1458164501),
(2, 2, 'Bibliotecário Padrão', 'lib@lib.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-03-16 05:11:55', 1458164828),
(3, 3, 'Leitor Padrão', 'leitor@leitor.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2016-03-16 05:12:10', 0),
(4, 3, 'Marvnen', 'marv@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '2016-03-16 20:43:51', 1458164714),
(5, 3, 'Procopio', 'pro@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '2016-03-16 21:46:35', 1458164802);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_book`
--
ALTER TABLE `tb_book`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `category_id` (`category_id`);

--
-- Índices de tabela `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Índices de tabela `tb_collection`
--
ALTER TABLE `tb_collection`
  ADD PRIMARY KEY (`id_collection`),
  ADD KEY `book_id` (`book_id`);

--
-- Índices de tabela `tb_loan`
--
ALTER TABLE `tb_loan`
  ADD PRIMARY KEY (`id_loan`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Índices de tabela `tb_profile`
--
ALTER TABLE `tb_profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- Índices de tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `profile_id` (`profile_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_book`
--
ALTER TABLE `tb_book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `tb_collection`
--
ALTER TABLE `tb_collection`
  MODIFY `id_collection` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `tb_loan`
--
ALTER TABLE `tb_loan`
  MODIFY `id_loan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `tb_profile`
--
ALTER TABLE `tb_profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_book`
--
ALTER TABLE `tb_book`
  ADD CONSTRAINT `tb_book_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tb_category` (`id_category`);

--
-- Restrições para tabelas `tb_collection`
--
ALTER TABLE `tb_collection`
  ADD CONSTRAINT `tb_collection_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `tb_book` (`id_book`);

--
-- Restrições para tabelas `tb_loan`
--
ALTER TABLE `tb_loan`
  ADD CONSTRAINT `tb_loan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_loan_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `tb_book` (`id_book`);

--
-- Restrições para tabelas `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `tb_profile` (`id_profile`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
