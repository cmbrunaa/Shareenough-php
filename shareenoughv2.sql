-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Nov-2024 às 03:56
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
-- Banco de dados: `shareenoughv2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id_adm` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`id_adm`, `nome`, `email`, `senha`) VALUES
(1, 'Bruna', 'bruna@gmail.com', '200820e3227815ed1756a6b531e7e0d2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `doacoes`
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
  `fotos` varchar(255) DEFAULT NULL,
  `data_doacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `doacoes`
--

INSERT INTO `doacoes` (`doacao_id`, `id_usuario`, `id_ong`, `tipo_doacao`, `tipo_roupa`, `tamanho`, `condicao`, `qntd_pecas`, `tipo_alimento`, `qntd_alimentos`, `cesta_basica`, `peso`, `fotos`, `data_doacao`) VALUES
(6, 14, 2, 'alimento', NULL, NULL, NULL, NULL, 'Arroz', '10', 'Não', '10kg+', NULL, '2024-10-27'),
(8, 14, 1, 'roupa', 'Feminina', 'M', 'Nova', '10', NULL, NULL, NULL, NULL, NULL, '2024-10-29'),
(11, 16, 7, 'roupa', 'masculina', 'adulto', 'nova', '2', NULL, NULL, NULL, NULL, 'upload/3a580e6c728b0e5827e5235606cd21e3.jpg', '2024-10-29'),
(12, 16, 7, 'roupa', 'masculina', 'adulto', 'nova', '1', NULL, NULL, NULL, NULL, 'upload/0c0bdc4727e6a7c01c8accf11d6af457.jpg', '2024-10-30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ongs`
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
-- Extraindo dados da tabela `ongs`
--

INSERT INTO `ongs` (`id_ong`, `nome`, `cnpj`, `endereco`, `email`, `telefone`, `senha`, `data_cadastro`, `foto`) VALUES
(1, 'Calor Humano', '91.432.255/0001-89', ' Rua das Flores, 123, Bairro Centro, Curitiba-PR', 'calorhumano@gmail.com', '423595-8767', '200820e3227815ed1756a6b531e7e0d2', '2024-10-06', ''),
(2, 'Alimentando Vidas', '08.212.421/0001-98', 'Rua da Solidariedade, 123, Bairro do Aconchego', 'alimentandovidas@gmail.com', '423513-4205', '200820e3227815ed1756a6b531e7e0d2', '2024-10-06', ''),
(3, 'Moda Solidaria', '48.126.428/0001-01', 'Rua da Solidariedade, 123, Bairro do Aconchego', 'modasolidaria@gmail.com', '433516-1700', '200820e3227815ed1756a6b531e7e0d2', '2024-10-28', ''),
(5, 'Cesta Solidaria', '81.168.523/0001-43', 'Rua Professor Milton Vianna, 592, Sítio Cercado', 'cestasolidaria@gmail.com', '433357-3865', '200820e3227815ed1756a6b531e7e0d2', '2024-10-29', ''),
(6, 'Sabor Solidario', '30.748.202/0001-87', 'Jardinete Deputado Ladislau Lachowski, 180, Vista Alegre', 'saborsolidario@gmail.com', '413646-3618', '200820e3227815ed1756a6b531e7e0d2', '2024-10-29', ''),
(7, 'Aconchego Seguro', '74.835.182/0001-57', 'Rua Professor Francisco Alberto de Castro, 902, Ganchinho', 'aconchegoseguro@gmail.com', '453217-2477', '200820e3227815ed1756a6b531e7e0d2', '2024-10-29', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem_ong`
--

CREATE TABLE `postagem_ong` (
  `id_post` int(11) NOT NULL,
  `boxpost` text NOT NULL,
  `telefone` int(11) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `numero` int(6) NOT NULL,
  `categoria` varchar(15) NOT NULL,
  `ong_post_file` varchar(100) NOT NULL,
  `data_post` datetime NOT NULL,
  `id_ong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `postagem_ong`
--

INSERT INTO `postagem_ong` (`id_post`, `boxpost`, `telefone`, `endereco`, `numero`, `categoria`, `ong_post_file`, `data_post`, `id_ong`) VALUES
(10, 'Aproveite que o verão está chegando e doe as roupas de inverno que não precisa mais, contamos com o sei apoio!', 2147483647, ' Rua das Flores, Bairro Centro, Curitiba-PR', 123, 'roupa', '987f0a1ba184cb924b2004268c53bddf.jpeg', '2024-11-02 13:31:47', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `cpf_cnpj` decimal(14,0) NOT NULL,
  `data_cadastro` date NOT NULL,
  `imagem` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `telefone`, `cpf_cnpj`, `data_cadastro`, `imagem`) VALUES
(14, 'Marina Tsukuroi', 'marina@gmail.com', '200820e3227815ed1756a6b531e7e0d2', '(45) 97309-8528', 41170548563, '2024-10-28', ''),
(16, 'Naftali Ferrari', 'naftalistudy@gmail.com', 'e69b6335db52c6c429504c83af986012', '41996793323', 5776165288, '2024-10-29', ''),
(17, 'Bruna Candido', 'brunacandido@gmail.com', '200820e3227815ed1756a6b531e7e0d2', '44364646533', 56789034590, '2024-11-02', 'upload/c292cf03992769e2ebb9a2c7f73fb688.png'),
(18, 'Naftali Ferrari da Silva', 'naftaliferrari@gmail.com', '25f9e794323b453885f5181f1b624d0b', '41996793323', 5776165288, '2024-11-02', 'upload/6ef4f6919349392c976c4f3aae09e849.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_adm`);

--
-- Índices para tabela `doacoes`
--
ALTER TABLE `doacoes`
  ADD PRIMARY KEY (`doacao_id`),
  ADD KEY `fk_usuario` (`id_usuario`),
  ADD KEY `fk_ongs` (`id_ong`);

--
-- Índices para tabela `ongs`
--
ALTER TABLE `ongs`
  ADD PRIMARY KEY (`id_ong`);

--
-- Índices para tabela `postagem_ong`
--
ALTER TABLE `postagem_ong`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `fk_post` (`id_ong`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
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
  MODIFY `doacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `ongs`
--
ALTER TABLE `ongs`
  MODIFY `id_ong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `postagem_ong`
--
ALTER TABLE `postagem_ong`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `doacoes`
--
ALTER TABLE `doacoes`
  ADD CONSTRAINT `fk_ongs` FOREIGN KEY (`id_ong`) REFERENCES `ongs` (`id_ong`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `postagem_ong`
--
ALTER TABLE `postagem_ong`
  ADD CONSTRAINT `fk_post` FOREIGN KEY (`id_ong`) REFERENCES `ongs` (`id_ong`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
