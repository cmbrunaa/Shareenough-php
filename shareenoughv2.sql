-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/11/2024 às 17:21
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `shareenoughv2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `id_adm` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administrador`
--

INSERT INTO `administrador` (`id_adm`, `nome`, `email`, `senha`) VALUES
(1, 'Bruna', 'bruna@gmail.com', '200820e3227815ed1756a6b531e7e0d2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `doacoes`
--

CREATE TABLE `doacoes` (
  `doacao_id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_ong` int(11) NOT NULL,
  `tipo_doacao` enum('roupa','alimento') NOT NULL,
  `tipo_roupa` varchar(30) DEFAULT NULL,
  `tamanho` char(10) DEFAULT NULL,
  `condicao` varchar(30) DEFAULT NULL,
  `qntd_pecas` char(10) DEFAULT NULL,
  `tipo_alimento` varchar(50) DEFAULT NULL,
  `qntd_alimentos` char(10) DEFAULT NULL,
  `cesta_basica` char(10) DEFAULT NULL,
  `peso` char(10) DEFAULT NULL,
  `fotos` mediumtext DEFAULT NULL,
  `data_doacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `doacoes`
--

INSERT INTO `doacoes` (`doacao_id`, `id_usuario`, `id_ong`, `tipo_doacao`, `tipo_roupa`, `tamanho`, `condicao`, `qntd_pecas`, `tipo_alimento`, `qntd_alimentos`, `cesta_basica`, `peso`, `fotos`, `data_doacao`) VALUES
(16, 21, 11, 'alimento', NULL, NULL, NULL, NULL, 'arroz', '10', 'nao', '10kg+', 'upload/0011db8e46a5178acdca2f145e252ea5.jpg', '2024-11-03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ongs`
--

CREATE TABLE `ongs` (
  `id_ong` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cnpj` varchar(30) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `data_cadastro` date NOT NULL,
  `foto` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ongs`
--

INSERT INTO `ongs` (`id_ong`, `nome`, `cnpj`, `endereco`, `email`, `telefone`, `senha`, `data_cadastro`, `foto`) VALUES
(11, 'Alimentando Vidas', '74835182000157', 'Rua Professor Francisco Alberto de Castro, 902, Ganchinho', 'alimentandovidas@gmail.com', '453217-2477', '200820e3227815ed1756a6b531e7e0d2', '2024-11-03', 'upload/18fbfca106a5eb32f5608ac7b132fc73.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `postagem_ong`
--

CREATE TABLE `postagem_ong` (
  `id_post` int(11) NOT NULL,
  `boxpost` text NOT NULL,
  `telefone` int(11) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `numero` int(6) NOT NULL,
  `categoria` varchar(15) NOT NULL,
  `ong_post_file` mediumtext NOT NULL,
  `data_post` datetime NOT NULL,
  `id_ong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `postagem_ong`
--

INSERT INTO `postagem_ong` (`id_post`, `boxpost`, `telefone`, `endereco`, `numero`, `categoria`, `ong_post_file`, `data_post`, `id_ong`) VALUES
(16, 'Precisamos de doações de alimentos URGENTE!', 2147483647, 'Rua Professor Francisco Alberto de Castro, Ganchin', 902, 'alimento', '311486346ff7f56e1a5da9693def583a.jpg', '2024-11-03 12:10:47', 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `cpf_cnpj` decimal(14,0) NOT NULL,
  `data_cadastro` date NOT NULL,
  `imagem` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `telefone`, `cpf_cnpj`, `data_cadastro`, `imagem`) VALUES
(21, 'Bruna Candido', 'brunac@gmail.com', '200820e3227815ed1756a6b531e7e0d2', '4198729-2790', 23987502305, '2024-11-03', 'upload/5a2bdd5be8c1415ceecabbadde507ef3.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_adm`);

--
-- Índices de tabela `doacoes`
--
ALTER TABLE `doacoes`
  ADD PRIMARY KEY (`doacao_id`),
  ADD KEY `fk_usuario` (`id_usuario`),
  ADD KEY `fk_ongs` (`id_ong`);

--
-- Índices de tabela `ongs`
--
ALTER TABLE `ongs`
  ADD PRIMARY KEY (`id_ong`);

--
-- Índices de tabela `postagem_ong`
--
ALTER TABLE `postagem_ong`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `fk_post` (`id_ong`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `doacoes`
--
ALTER TABLE `doacoes`
  MODIFY `doacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `ongs`
--
ALTER TABLE `ongs`
  MODIFY `id_ong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `postagem_ong`
--
ALTER TABLE `postagem_ong`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `doacoes`
--
ALTER TABLE `doacoes`
  ADD CONSTRAINT `fk_ongs` FOREIGN KEY (`id_ong`) REFERENCES `ongs` (`id_ong`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `postagem_ong`
--
ALTER TABLE `postagem_ong`
  ADD CONSTRAINT `fk_post` FOREIGN KEY (`id_ong`) REFERENCES `ongs` (`id_ong`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
