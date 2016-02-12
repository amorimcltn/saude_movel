-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 12-Fev-2016 às 14:11
-- Versão do servidor: 5.5.32
-- versão do PHP: 5.4.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `1031257`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `cod_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `sexo` varchar(1) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `cep` varchar(12) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `patologias` text,
  `prioridade` int(11) NOT NULL,
  PRIMARY KEY (`cod_paciente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `paciente`
--

INSERT INTO `paciente` (`cod_paciente`, `nome`, `nascimento`, `sexo`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `latitude`, `longitude`, `patologias`, `prioridade`) VALUES
(6, 'Maria Antonia', '1965-05-25', 'F', 'Cassiano Santos', '33', 'Centro', 'Vitoria da Conquista', 'Bahia', '45000-315', '-14.8524272', '-40.8433845', 'Teste de patologias', 4),
(7, 'Pedro Matos', '1952-08-02', 'M', 'Av. MacaÃºbas', '352', 'Ibirapuera', 'Vitoria da Conquista', 'Bahia', '00000-000', '-14.8407444', '-40.8579356', 'Teste de patologias', 4),
(8, 'JoÃ£o Santos', '1987-05-20', 'M', 'Av. Guanambi', '606', 'Brasil', 'Vitoria da Conquista', 'Bahia', '00000-000', '-14.8564743', '-40.8558653', 'Teste de patologias', 4),
(9, 'Pedrina Albuquerque', '1978-11-24', 'F', 'Av. MaceiÃ³', '2', 'Brasil', 'Vitoria da Conquista', 'Bahia', '00000-000', '-14.8576882', '-40.8522536', 'Teste de patologias', 3),
(10, 'Carlos Manoel', '1982-02-11', 'M', 'Dante Menezes', '2', 'Centro', 'Vitoria da Conquista', 'Bahia', '45000-335', '-14.8511695', '-40.8432433', 'Teste de patologias', 5);

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
('86cb0e1e732af561d94058c6fbd1746b', 2, '2016-01-18 12:48:04'),
('8c4f1bc60bb239b3f2b6e6c933c75a58', 1, '2015-10-17 10:31:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `visita`
--

CREATE TABLE IF NOT EXISTS `visita` (
  `cod_visita` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cod_prof` int(11) NOT NULL DEFAULT '0',
  `cod_paciente` int(11) NOT NULL DEFAULT '0',
  `data_visita` date NOT NULL,
  `data_hora` date DEFAULT NULL,
  `anotacoes` varchar(400) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`cod_prof`,`cod_paciente`),
  UNIQUE KEY `cod_visita` (`cod_visita`),
  KEY `cod_paciente` (`cod_paciente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `visita`
--

INSERT INTO `visita` (`cod_visita`, `cod_prof`, `cod_paciente`, `data_visita`, `data_hora`, `anotacoes`, `status`) VALUES
(1, 2, 6, '0000-00-00', NULL, NULL, 0),
(2, 2, 7, '0000-00-00', NULL, NULL, 0),
(3, 2, 8, '0000-00-00', NULL, NULL, 0),
(4, 2, 10, '0000-00-00', NULL, NULL, 0);

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
