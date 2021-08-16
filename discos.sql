-- --------------------------------------------------------

--
-- Estrutura da tabela `discos`
--

CREATE TABLE `discos` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantor` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(35) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
