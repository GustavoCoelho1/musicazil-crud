-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Tempo de geração: 11-Dez-2021 às 21:27
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_musicazil`
--

CREATE DATABASE db_musicazil;

USE db_musicazil;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_artista`
--

CREATE TABLE `tb_artista` (
  `Id_Artis` int(11) NOT NULL,
  `Id_Clie_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `Id_Clie` int(11) NOT NULL,
  `Nome_Clie` varchar(60) NOT NULL,
  `Dt_Nasc` date NOT NULL,
  `Fone_Clie` varchar(15) NOT NULL,
  `Id_Usua_fk` int(11) NOT NULL,
  `Artista` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_musica`
--

CREATE TABLE `tb_musica` (
  `Id_Mus` int(11) NOT NULL,
  `Nome_Mus` varchar(150) NOT NULL,
  `Genero_Mus` varchar(12) NOT NULL,
  `Album_Mus` varchar(30) NOT NULL,
  `Duracao_Mus` time NOT NULL,
  `Link_Mus` varchar(250) NOT NULL,
  `Capa_Mus` varchar(250) NOT NULL,
  `Data_Lança_Mus` date NOT NULL,
  `Letra_Mus` text DEFAULT NULL,
  `Id_Artis_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_playlist`
--

CREATE TABLE `tb_playlist` (
  `Id_Playlist` int(11) NOT NULL,
  `Id_Mus_fk` int(11) NOT NULL,
  `Id_Clie_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `Id_Usua` int(11) NOT NULL,
  `Email_Usua` varchar(125) NOT NULL,
  `Senha_Usua` varchar(125) NOT NULL,
  `Nome_Usua` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_artista`
--
ALTER TABLE `tb_artista`
  ADD PRIMARY KEY (`Id_Artis`),
  ADD KEY `Id_Clie_Art` (`Id_Clie_fk`);

--
-- Índices para tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`Id_Clie`),
  ADD KEY `Id_Usu_Clie` (`Id_Usua_fk`);

--
-- Índices para tabela `tb_musica`
--
ALTER TABLE `tb_musica`
  ADD PRIMARY KEY (`Id_Mus`),
  ADD KEY `Id_Mus_Artis` (`Id_Artis_fk`);

--
-- Índices para tabela `tb_playlist`
--
ALTER TABLE `tb_playlist`
  ADD PRIMARY KEY (`Id_Playlist`),
  ADD KEY `Id_Play_Clie` (`Id_Clie_fk`),
  ADD KEY `Id_Play_Mus` (`Id_Mus_fk`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`Id_Usua`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_artista`
--
ALTER TABLE `tb_artista`
  MODIFY `Id_Artis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `Id_Clie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_musica`
--
ALTER TABLE `tb_musica`
  MODIFY `Id_Mus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_playlist`
--
ALTER TABLE `tb_playlist`
  MODIFY `Id_Playlist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `Id_Usua` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_artista`
--
ALTER TABLE `tb_artista`
  ADD CONSTRAINT `Id_Clie_Art` FOREIGN KEY (`Id_Clie_fk`) REFERENCES `tb_cliente` (`Id_Clie`);

--
-- Limitadores para a tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD CONSTRAINT `Id_Usu_Clie` FOREIGN KEY (`Id_Usua_fk`) REFERENCES `tb_usuario` (`Id_Usua`);

--
-- Limitadores para a tabela `tb_musica`
--
ALTER TABLE `tb_musica`
  ADD CONSTRAINT `Id_Mus_Artis` FOREIGN KEY (`Id_Artis_fk`) REFERENCES `tb_artista` (`Id_Artis`);

--
-- Limitadores para a tabela `tb_playlist`
--
ALTER TABLE `tb_playlist`
  ADD CONSTRAINT `Id_Play_Clie` FOREIGN KEY (`Id_Clie_fk`) REFERENCES `tb_cliente` (`Id_Clie`),
  ADD CONSTRAINT `Id_Play_Mus` FOREIGN KEY (`Id_Mus_fk`) REFERENCES `tb_musica` (`Id_Mus`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
