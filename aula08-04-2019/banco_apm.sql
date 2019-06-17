-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 11-Jun-2019 às 23:40
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `banco_apm`
--
CREATE DATABASE IF NOT EXISTS `banco_apm` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `banco_apm`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_aluno`
--

CREATE TABLE IF NOT EXISTS `tabela_aluno` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(15) COLLATE utf8_bin NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  `foto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tabela_aluno`
--

INSERT INTO `tabela_aluno` (`matricula`, `nome`, `email`, `telefone`, `data`, `valor`, `foto`) VALUES
(8794, 'nara teracin', 'nara.teracin@gmail.com', '35616091', '2019-02-05', '7.00', NULL),
(23562, 'Tuburcinho Junior', 'junior@gmail.com', '78952145', '1989-05-20', '10.00', '2113087d84b3ca4828cd45812d67abe5.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_professor`
--

CREATE TABLE IF NOT EXISTS `tabela_professor` (
  `matricula` int(5) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telefone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `valor` decimal(5,0) NOT NULL,
  `foto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tabela_professor`
--

INSERT INTO `tabela_professor` (`matricula`, `nome`, `email`, `telefone`, `celular`, `data_nascimento`, `valor`, `foto`) VALUES
(7853, 'Bean da Costa', 'bean@gmail.com', '(19)356185354', '986522152', '1986-05-08', '5000', '96b7f47092aebdb73be72b840d8c04a6.jpg'),
(20000, 'Beandilicious Marafasfasdg', 'oi@gmail.com', '(19)2965551221', '515485465154', '1997-01-30', '5000', '778a7d20881f33647cf7eddb28a17ef2.jpg'),
(69533, 'Adriano Virgilio', 'adriano@gmail.com', '6853852', '6398542', '1990-11-03', '6000', '1baabe3e8586b59c0f28ac8f1b484bd6.jpg'),
(365122, 'Girafales Bolanos', 'girafales@gmail.com', '2463255625', '56589652', '1978-01-08', '10000', 'ae2de08a135bbcd1bd044a3d582d4816.png'),
(9965333, 'Tiburcinho da Silva', 'tiburcinho@gmail.com', '(19)35627777', '9989895652', '1994-03-20', '1200', '7bcd54e12aeedac551d3cee34a69708a.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_usuarios`
--

CREATE TABLE IF NOT EXISTS `tabela_usuarios` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `senha` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tipo` char(1) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tabela_usuarios`
--

INSERT INTO `tabela_usuarios` (`id`, `login`, `senha`, `nome`, `tipo`) VALUES
(1, 'nara', '202cb962ac59075b964b07152d234b70', 'Nara Teracin', 'm'),
(2, 'adriano', '202cb962ac59075b964b07152d234b70', 'Adriano Virgilio', 'm');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
