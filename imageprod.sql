--
-- Database: loja
--
CREATE DATABASE IF NOT EXISTS loja DEFAULT 
CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE loja;

--
-- Table structure for table images
--

CREATE TABLE imagem (
  idImagem int(11) NOT NULL,
  ArqImagem varchar(255) NOT NULL,
  dtCadastro datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table images
--

INSERT INTO imagem (idImagem, arqImagem, dtCadastro) VALUES
(6, '1507802923-main.jpg', '2017-10-12 15:08:43'),
(7, '1507802924-logo-client-4.jpg', '2017-10-12 15:08:44'),
(8, '1507802993-main.jpg', '2017-10-12 15:09:53'),
(9, '1507802993-logo-client-4.jpg', '2017-10-12 15:09:53'),
(10, '1507803086-logo-client-6.jpg', '2017-10-12 15:11:26'),
(11, '1507803086-logo-client-4.jpg', '2017-10-12 15:11:26'),
(12, '1507803086-preloader.gif', '2017-10-12 15:11:26');

--
-- Indexes for table images
--
ALTER TABLE imagem   ADD PRIMARY KEY (idImagem);

--
-- AUTO_INCREMENT for table images
--
ALTER TABLE imagem   MODIFY idImagem int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
