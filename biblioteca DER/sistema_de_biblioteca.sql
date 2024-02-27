-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/06/2023 às 09:39
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_de_biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `idaluno` int(11) NOT NULL,
  `nome_aluno` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `ra` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`idaluno`, `nome_aluno`, `cpf`, `ra`) VALUES
(1, 'Cleber', '138.361.979-39', '200'),
(2, 'Joelinton', '150.366.949-44', '201'),
(3, 'Guilherme', '070.286.573-41', '202'),
(4, 'Roberto', '130.346.479-04', '203'),
(6, 'Rafael', '138.451.469-19', '205');

-- --------------------------------------------------------

--
-- Estrutura para tabela `autor`
--

CREATE TABLE `autor` (
  `idautor` int(11) NOT NULL,
  `nome_autor` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autor`
--

INSERT INTO `autor` (`idautor`, `nome_autor`) VALUES
(71, 'J.K. Rowling'),
(72, 'Robert C. Martin'),
(73, ' J.K. Rowling'),
(74, 'Aditya Y. Bhargava');

-- --------------------------------------------------------

--
-- Estrutura para tabela `autor_livro`
--

CREATE TABLE `autor_livro` (
  `idautor_livro` int(11) NOT NULL,
  `autor_idautor` int(11) NOT NULL,
  `livro_idlivro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autor_livro`
--

INSERT INTO `autor_livro` (`idautor_livro`, `autor_idautor`, `livro_idlivro`) VALUES
(36, 71, 53),
(37, 71, 54),
(38, 72, 55),
(39, 71, 56),
(40, 73, 57),
(41, 73, 58),
(42, 71, 59),
(43, 71, 60),
(44, 71, 61),
(45, 74, 62);

-- --------------------------------------------------------

--
-- Estrutura para tabela `editora`
--

CREATE TABLE `editora` (
  `ideditora` int(11) NOT NULL,
  `nome_editora` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `editora`
--

INSERT INTO `editora` (`ideditora`, `nome_editora`) VALUES
(56, 'Rocco'),
(57, 'Alta Books'),
(58, 'Novatec');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo_livro`
--

CREATE TABLE `emprestimo_livro` (
  `idemprestimo_livro` int(11) NOT NULL,
  `idexemplar_livro` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `data_emprestimo` date DEFAULT NULL,
  `data_devolucao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestimo_livro`
--

INSERT INTO `emprestimo_livro` (`idemprestimo_livro`, `idexemplar_livro`, `idaluno`, `data_emprestimo`, `data_devolucao`) VALUES
(37, 37, 6, '2023-07-01', '2023-07-09'),
(38, 42, 2, '2023-07-01', '2023-07-09'),
(39, 50, 2, '2023-08-31', '2023-09-06'),
(40, 43, 4, '2023-12-12', '2023-12-16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `exemplar_livro`
--

CREATE TABLE `exemplar_livro` (
  `idexemplar_livro` int(11) NOT NULL,
  `idlivro` int(11) NOT NULL,
  `numero_exemplar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `exemplar_livro`
--

INSERT INTO `exemplar_livro` (`idexemplar_livro`, `idlivro`, `numero_exemplar`) VALUES
(37, 53, 1),
(41, 54, 1),
(42, 55, 1),
(43, 55, 2),
(44, 56, 1),
(45, 57, 5),
(46, 58, 2),
(47, 59, 10),
(48, 60, 2),
(49, 61, 3),
(50, 62, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE `livro` (
  `idlivro` int(11) NOT NULL,
  `ideditora` int(11) NOT NULL,
  `nome_livro` varchar(45) DEFAULT NULL,
  `ano_publicacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livro`
--

INSERT INTO `livro` (`idlivro`, `ideditora`, `nome_livro`, `ano_publicacao`) VALUES
(53, 56, 'Harry Potter e a Pedra Filosofal', 1997),
(54, 56, 'Harry Potter e a Câmara Secreta', 1998),
(55, 57, 'Código limpo', 2009),
(56, 56, 'Harry Potter e o Prisioneiro de Azkaban', 1999),
(57, 56, 'Harry Potter e o Cálice de Fogo', 2000),
(58, 56, 'Harry Potter e a Ordem da Fênix', 2003),
(59, 56, 'Harry Potter e o Enigma do Príncipe', 2005),
(60, 56, 'Harry Potter e as Relíquias da Morte', 2007),
(61, 56, 'Harry Potter e a Criança Amaldiçoada', 2016),
(62, 58, 'Entendendo Algoritmos', 2017);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome_usuario` varchar(32) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome_usuario`, `senha`) VALUES
(1, 'Gabriel', 'A665A45920422F9D417E4867EFDC4FB8A04A1F3FFF1FA07E998E86F7F7A27AE3');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idaluno`);

--
-- Índices de tabela `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`idautor`);

--
-- Índices de tabela `autor_livro`
--
ALTER TABLE `autor_livro`
  ADD PRIMARY KEY (`idautor_livro`),
  ADD KEY `fk_autor_has_livro_livro1_idx` (`livro_idlivro`),
  ADD KEY `fk_autor_has_livro_autor1_idx` (`autor_idautor`);

--
-- Índices de tabela `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`ideditora`);

--
-- Índices de tabela `emprestimo_livro`
--
ALTER TABLE `emprestimo_livro`
  ADD PRIMARY KEY (`idemprestimo_livro`),
  ADD KEY `fk_exemplar_livro_has_aluno_aluno1_idx` (`idaluno`),
  ADD KEY `fk_exemplar_livro_has_aluno_exemplar_livro1_idx` (`idexemplar_livro`);

--
-- Índices de tabela `exemplar_livro`
--
ALTER TABLE `exemplar_livro`
  ADD PRIMARY KEY (`idexemplar_livro`),
  ADD KEY `fk_exemplar_livro_livro1_idx` (`idlivro`);

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`idlivro`),
  ADD KEY `fk_livro_editora1_idx` (`ideditora`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idaluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `autor`
--
ALTER TABLE `autor`
  MODIFY `idautor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de tabela `autor_livro`
--
ALTER TABLE `autor_livro`
  MODIFY `idautor_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `editora`
--
ALTER TABLE `editora`
  MODIFY `ideditora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `emprestimo_livro`
--
ALTER TABLE `emprestimo_livro`
  MODIFY `idemprestimo_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `exemplar_livro`
--
ALTER TABLE `exemplar_livro`
  MODIFY `idexemplar_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `idlivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `autor_livro`
--
ALTER TABLE `autor_livro`
  ADD CONSTRAINT `fk_autor_has_livro_autor1` FOREIGN KEY (`autor_idautor`) REFERENCES `autor` (`idautor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_autor_has_livro_livro1` FOREIGN KEY (`livro_idlivro`) REFERENCES `livro` (`idlivro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `emprestimo_livro`
--
ALTER TABLE `emprestimo_livro`
  ADD CONSTRAINT `fk_exemplar_livro_has_aluno_aluno1` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exemplar_livro_has_aluno_exemplar_livro1` FOREIGN KEY (`idexemplar_livro`) REFERENCES `exemplar_livro` (`idexemplar_livro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `exemplar_livro`
--
ALTER TABLE `exemplar_livro`
  ADD CONSTRAINT `fk_exemplar_livro_livro1` FOREIGN KEY (`idlivro`) REFERENCES `livro` (`idlivro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `fk_livro_editora1` FOREIGN KEY (`ideditora`) REFERENCES `editora` (`ideditora`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
