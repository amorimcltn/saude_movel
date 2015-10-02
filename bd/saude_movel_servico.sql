-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15-Set-2015 às 21:53
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saude_movel_servico`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `cod_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `endereco` text,
 `longitude` varchar(100),
`latitude` varchar(100), `patologias` text,
  PRIMARY KEY (`cod_paciente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `paciente`
--

INSERT INTO `paciente` (`cod_paciente`, `nome`, `idade`, `endereco`, `patologias`) VALUES
(1, 'Jubileu Peixoto de Castro', 45, 'Cassiano Santos, 33 - Centro, Vitoria da Conquista - Bahia, 45000-315', 'Diabetes tipo II'),
(2, 'João Pereira Cardoso', 68, 'Cassiano Santos, 36 - Centro, Vitoria da Conquista - Bahia, 45000-315', 'Indisponivel'),
(3, 'Pedro Ferraz', 28, 'Cassiano Santos, 38 - Centro, Vitoria da Conquista - Bahia, 45000-315', 'Teste de patologias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional`
--

CREATE TABLE IF NOT EXISTS `profissional` (
  `cod_prof` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `senha` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`cod_prof`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `profissional`
--

INSERT INTO `profissional` (`cod_prof`, `nome`, `cpf`, `senha`) VALUES
(1, 'Cleiton', '11111111111', '1234'),
(2, 'Ana Maria', '00000000000', '1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessao`
--

CREATE TABLE IF NOT EXISTS `sessao` (
  `token` varchar(100) NOT NULL,
  `cod_prof` int(11) DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sessao`
--

INSERT INTO `sessao` (`token`, `cod_prof`, `data_hora`) VALUES
('d26156a325f7cc966d1ef9bdbe11ae73', 1, '2015-09-15 11:29:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `visita`
--

CREATE TABLE IF NOT EXISTS `visita` (
  `cod_prof` int(11) NOT NULL DEFAULT '0',
  `cod_paciente` int(11) NOT NULL DEFAULT '0',
  `data_hora` date DEFAULT NULL,
  `anotacoes` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`cod_prof`,`cod_paciente`),
  KEY `cod_paciente` (`cod_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `visita`
--

INSERT INTO `visita` (`cod_prof`, `cod_paciente`, `data_hora`, `anotacoes`) VALUES
(1, 2, NULL, NULL),
(1, 3, '2015-09-15', NULL),
(2, 1, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`cod_prof`) REFERENCES `profissional` (`cod_prof`),
  ADD CONSTRAINT `visita_ibfk_2` FOREIGN KEY (`cod_paciente`) REFERENCES `paciente` (`cod_paciente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
