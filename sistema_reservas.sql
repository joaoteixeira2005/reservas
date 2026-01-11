-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Jan-2026 às 19:04
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_reservas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`) VALUES
(1, 'Pedro', 'cliente491@gmail.com'),
(2, 'Joao', 'cliente448@gmail.com'),
(3, 'Ana', 'cliente104@gmail.com'),
(4, 'Pedro', 'cliente287@gmail.com'),
(5, 'Ana', 'cliente343@gmail.com'),
(6, 'Ana', 'cliente260@gmail.com'),
(7, 'Pedro', 'cliente157@gmail.com'),
(8, 'Sofia', 'cliente87@gmail.com'),
(9, 'Beatriz', 'cliente352@gmail.com'),
(11, 'Sofia', 'cliente170@gmail.com'),
(12, 'Ricardo', 'cliente146@gmail.com'),
(13, 'Ricardo', 'cliente408@gmail.com'),
(14, 'Beatriz', 'cliente10@gmail.com'),
(15, 'Beatriz', 'cliente493@gmail.com'),
(16, 'Pedro', 'cliente208@gmail.com'),
(17, 'Joao', 'cliente282@gmail.com'),
(18, 'Ana', 'cliente275@gmail.com'),
(19, 'Ricardo', 'cliente251@gmail.com'),
(20, 'Beatriz', 'cliente302@gmail.com'),
(21, 'Joao Teixeira', 'joaoteixeira1091@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recursos`
--

CREATE TABLE `recursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `lotacao_maxima` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `recursos`
--

INSERT INTO `recursos` (`id`, `nome`, `lotacao_maxima`) VALUES
(1, 'Porto: Douro Sky Lounge', 5),
(2, 'Porto: Ribeira Vintage', 4),
(3, 'Lisboa: Chiado Elegance', 8),
(4, 'Lisboa: Alfama Terrace', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `recurso_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `data_reserva` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `num_pessoas` int(11) DEFAULT NULL,
  `status_presenca` enum('Pendente','Concluído') DEFAULT 'Pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`id`, `recurso_id`, `cliente_id`, `data_reserva`, `hora_inicio`, `hora_fim`, `num_pessoas`, `status_presenca`) VALUES
(1, 1, 1, '2026-01-12', '19:00:00', '21:00:00', 6, 'Pendente'),
(2, 2, 2, '2026-01-12', '13:00:00', '15:00:00', 6, 'Pendente'),
(3, 3, 3, '2026-01-13', '21:00:00', '23:00:00', 4, 'Pendente'),
(4, 3, 4, '2026-01-11', '12:30:00', '14:30:00', 2, 'Pendente'),
(5, 4, 5, '2026-01-10', '13:00:00', '15:00:00', 6, 'Pendente'),
(6, 3, 6, '2026-01-11', '20:30:00', '22:30:00', 3, 'Pendente'),
(7, 2, 7, '2026-01-10', '12:30:00', '14:30:00', 4, 'Concluído'),
(8, 2, 8, '2026-01-14', '13:00:00', '15:00:00', 3, 'Pendente'),
(9, 2, 9, '2026-01-15', '12:30:00', '14:30:00', 3, 'Pendente'),
(10, 4, 10, '2026-01-11', '21:00:00', '23:00:00', 3, 'Pendente'),
(11, 1, 11, '2026-01-12', '19:00:00', '21:00:00', 3, 'Pendente'),
(12, 1, 12, '2026-01-11', '21:00:00', '23:00:00', 5, 'Pendente'),
(13, 1, 13, '2026-01-12', '13:00:00', '15:00:00', 3, 'Pendente'),
(14, 2, 14, '2026-01-10', '13:00:00', '15:00:00', 3, 'Pendente'),
(15, 2, 15, '2026-01-13', '20:30:00', '22:30:00', 4, 'Pendente'),
(16, 4, 16, '2026-01-12', '21:00:00', '23:00:00', 2, 'Pendente'),
(17, 1, 17, '2026-01-13', '13:00:00', '15:00:00', 4, 'Pendente'),
(18, 1, 18, '2026-01-11', '20:30:00', '22:30:00', 3, 'Pendente'),
(19, 4, 19, '2026-01-11', '21:00:00', '23:00:00', 6, 'Pendente'),
(20, 4, 20, '2026-01-12', '19:00:00', '21:00:00', 4, 'Pendente'),
(21, 4, 21, '2026-01-10', '23:00:00', '01:00:00', 6, 'Pendente'),
(22, 4, 21, '2026-01-10', '23:00:00', '01:00:00', 2, 'Pendente'),
(23, 4, 21, '2026-01-10', '23:00:00', '01:00:00', 2, 'Pendente'),
(24, 4, 21, '2026-01-10', '23:00:00', '01:00:00', 2, 'Pendente'),
(25, 4, 21, '2026-01-10', '23:00:00', '01:00:00', 2, 'Pendente');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recurso_id` (`recurso_id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`recurso_id`) REFERENCES `recursos` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
