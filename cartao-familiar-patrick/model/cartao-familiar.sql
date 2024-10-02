-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela cartao_familiar.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` blob DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `utm_parameters` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `plan_id` (`plan_id`),
  CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela cartao_familiar.customers: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela cartao_familiar.partners
CREATE TABLE IF NOT EXISTS `partners` (
  `partner_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` blob DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `type` enum('PF','PJ') DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`partner_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela cartao_familiar.partners: ~0 rows (aproximadamente)
INSERT INTO `partners` (`partner_id`, `name`, `email`, `password`, `phone`, `type`, `cnpj`, `cpf`, `zip_code`, `address`, `number`, `neighborhood`, `city`, `state`) VALUES
	(2, 'WEASE TECNOLOGIA', 'joao.ferreira@wease.com.br', _binary 0x9b6c8de44c3551972daa694464255fb2, '(41) 99644-4425', 'PJ', '49526438000105', NULL, '88058-570', 'Rua Brisamar', '457', 'Ingleses do Rio Vermelho', 'Florianópolis', 'SC');

-- Copiando estrutura para tabela cartao_familiar.partner_services
CREATE TABLE IF NOT EXISTS `partner_services` (
  `partner_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`partner_id`,`service_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `partner_services_ibfk_1` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`partner_id`),
  CONSTRAINT `partner_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela cartao_familiar.partner_services: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela cartao_familiar.partner_specialties
CREATE TABLE IF NOT EXISTS `partner_specialties` (
  `partner_id` int(11) NOT NULL,
  `specialty_id` int(11) NOT NULL,
  PRIMARY KEY (`partner_id`,`specialty_id`),
  KEY `specialty_id` (`specialty_id`),
  CONSTRAINT `partner_specialties_ibfk_1` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`partner_id`),
  CONSTRAINT `partner_specialties_ibfk_2` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`specialty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela cartao_familiar.partner_specialties: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela cartao_familiar.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `customer_id` (`customer_id`),
  KEY `plan_id` (`plan_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela cartao_familiar.payments: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela cartao_familiar.plans
CREATE TABLE IF NOT EXISTS `plans` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela cartao_familiar.plans: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela cartao_familiar.services
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `specialty_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`service_id`),
  KEY `specialty_id` (`specialty_id`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`specialty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela cartao_familiar.services: ~15 rows (aproximadamente)
INSERT INTO `services` (`service_id`, `name`, `description`, `specialty_id`) VALUES
	(1, 'Eletrocardiograma', 'Exame que registra a atividade elétrica do coração.', 2),
	(2, 'Ecocardiograma', 'Ultrassonografia do coração, utilizada para avaliar o funcionamento cardíaco.', 2),
	(3, 'Teste Ergométrico', 'Avaliação da função cardíaca sob esforço físico controlado.', 2),
	(4, 'Holter 24 horas', 'Monitoramento contínuo do coração durante 24 horas para avaliação de arritmias.', 2),
	(5, 'Raio-X', 'Exame de imagem para avaliação de estruturas ósseas e outros tecidos internos.', 33),
	(6, 'Ressonância Magnética', 'Exame detalhado de órgãos e tecidos através de imagens por ressonância magnética.', 33),
	(7, 'Tomografia Computadorizada', 'Exame de imagem seccionado do corpo, utilizado para diagnósticos detalhados.', 33),
	(8, 'Mamografia', 'Exame de imagem especializado na avaliação das mamas.', 33),
	(9, 'Densitometria Óssea', 'Exame para medir a densidade mineral dos ossos e diagnosticar osteoporose.', 33),
	(10, 'Endoscopia Digestiva', 'Exame visual do trato digestivo superior através de endoscópio.', 5),
	(11, 'Colonoscopia', 'Exame visual do intestino grosso com o uso de uma câmera.', 5),
	(12, 'Cintilografia', 'Exame que utiliza radioisótopos para avaliar o funcionamento de órgãos como o coração e os pulmões.', 18),
	(13, 'Ultrassonografia', 'Imagem por ultrassom utilizada para avaliação de órgãos internos e gestação.', 32),
	(14, 'Angiografia', 'Exame que visualiza os vasos sanguíneos através de imagem para diagnóstico de doenças vasculares.', 32),
	(15, 'Polissonografia', 'Estudo do sono para diagnóstico de apneia e outros distúrbios do sono.', 32);

-- Copiando estrutura para tabela cartao_familiar.specialties
CREATE TABLE IF NOT EXISTS `specialties` (
  `specialty_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`specialty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela cartao_familiar.specialties: ~32 rows (aproximadamente)
INSERT INTO `specialties` (`specialty_id`, `name`, `description`) VALUES
	(1, 'Alergologia e Imunologia', 'Diagnóstico e tratamento de alergias e doenças do sistema imunológico.'),
	(2, 'Cardiologia', 'Diagnóstico e tratamento de doenças do coração e sistema cardiovascular.'),
	(3, 'Dermatologia', 'Cuidado da pele, cabelos, unhas e doenças relacionadas.'),
	(4, 'Endocrinologia', 'Tratamento de distúrbios hormonais e metabólicos, como diabetes e problemas de tireoide.'),
	(5, 'Gastroenterologia', 'Tratamento de doenças do sistema digestivo, como estômago, intestinos e fígado.'),
	(6, 'Geriatria', 'Cuidados especializados para idosos, abordando suas condições de saúde específicas.'),
	(7, 'Ginecologia e Obstetrícia', 'Saúde reprodutiva feminina e acompanhamento durante a gestação.'),
	(8, 'Hematologia', 'Tratamento de doenças do sangue, como anemias e leucemia.'),
	(9, 'Infectologia', 'Diagnóstico e tratamento de doenças infecciosas.'),
	(10, 'Nefrologia', 'Tratamento de doenças renais e distúrbios no funcionamento dos rins.'),
	(11, 'Neurologia', 'Tratamento de doenças do sistema nervoso central e periférico.'),
	(12, 'Oftalmologia', 'Cuidado com a visão e tratamento de doenças oculares.'),
	(13, 'Oncologia', 'Diagnóstico e tratamento de diferentes tipos de câncer.'),
	(14, 'Ortopedia e Traumatologia', 'Tratamento de problemas ósseos, articulares e traumas.'),
	(15, 'Otorrinolaringologia', 'Tratamento de doenças do ouvido, nariz e garganta.'),
	(16, 'Pediatria', 'Cuidados médicos para crianças e adolescentes.'),
	(17, 'Psiquiatria', 'Diagnóstico e tratamento de transtornos mentais e emocionais.'),
	(18, 'Reumatologia', 'Tratamento de doenças articulares e autoimunes, como artrite e lúpus.'),
	(19, 'Urologia', 'Diagnóstico e tratamento de doenças do sistema urinário e reprodutor masculino.'),
	(20, 'Mastologia', 'Diagnóstico e tratamento de doenças da mama, como câncer de mama.'),
	(21, 'Proctologia', 'Tratamento de doenças do intestino grosso, reto e ânus.'),
	(22, 'Clínica Geral Odontológica', 'Tratamento odontológico geral, incluindo restaurações, cáries e limpeza.'),
	(23, 'Ortodontia', 'Correção de desalinhamentos dentários através do uso de aparelhos ortodônticos.'),
	(24, 'Periodontia', 'Tratamento de doenças da gengiva e dos tecidos que suportam os dentes.'),
	(25, 'Implantodontia', 'Instalação de implantes dentários para substituição de dentes perdidos.'),
	(26, 'Odontopediatria', 'Cuidados odontológicos especializados para crianças.'),
	(27, 'Endodontia', 'Tratamento de canais radiculares e doenças da polpa dentária.'),
	(28, 'Prótese Dentária', 'Confecção de próteses para substituição de dentes ausentes.'),
	(29, 'Cirurgia Bucomaxilofacial', 'Cirurgia de mandíbula, face e boca para correção de traumas ou anomalias.'),
	(30, 'Odontologia Estética', 'Procedimentos estéticos odontológicos, como clareamento e facetas dentárias.'),
	(31, 'Radiologia Odontológica', 'Exames de imagem dentária, como radiografias para diagnóstico odontológico.'),
	(32, 'Outros', 'Outras especialidades médicas, odontológicas ou exames não listados.'),
	(33, 'Radiologia', 'Exames de imagem para diagnóstico médico, como Raio-X, Tomografia, e Ressonância.');

-- Copiando estrutura para tabela cartao_familiar.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cell_phone` varchar(20) DEFAULT NULL,
  `password` blob DEFAULT NULL,
  `dt_login` timestamp NULL DEFAULT NULL,
  `dt_logout` timestamp NULL DEFAULT NULL,
  `session_id` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela cartao_familiar.users: ~1 rows (aproximadamente)
INSERT INTO `users` (`user_id`, `name`, `email`, `cell_phone`, `password`, `dt_login`, `dt_logout`, `session_id`) VALUES
	(1, 'Suporte Wease', 'suporte@wease.com.br', '(41) 99644-4425', _binary 0x63b601c74e2f70d8e4c34d680c3dcf9df7eaeab3ac0dc320b7bdc27738cdb6ba, '2024-09-23 14:29:54', NULL, 'ove3q68dlobe05ipa2uuuk648b');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
