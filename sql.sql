-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `qcm`;
CREATE TABLE `qcm` (
                       `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                       `user_id` int unsigned NOT NULL,
                       `validatedcount` int DEFAULT NULL,
                       `end_at` datetime DEFAULT NULL,
                       `successfully` tinyint(1) NOT NULL DEFAULT '0',
                       `created_at` timestamp NULL DEFAULT NULL,
                       `updated_at` timestamp NULL DEFAULT NULL,
                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `qcm_questions`;
CREATE TABLE `qcm_questions` (
                                 `qcm_id` bigint unsigned NOT NULL,
                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                 `question_id` int unsigned NOT NULL,
                                 `successfully` tinyint(1) NOT NULL DEFAULT '0',
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`),
                                 KEY `qcm_id` (`qcm_id`),
                                 CONSTRAINT `qcm_questions_ibfk_1` FOREIGN KEY (`qcm_id`) REFERENCES `qcm` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
                             `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                             `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
                             `replies` text COLLATE utf8mb4_unicode_ci NOT NULL,
                             `validate` text COLLATE utf8mb4_unicode_ci NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                         `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `discord_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `added_role` tinyint NOT NULL DEFAULT '0',
                         `admin` tinyint NOT NULL DEFAULT '0',
                         `can_have_role` tinyint NOT NULL DEFAULT '0',
                         `username_discord` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_username_unique` (`username`),
                         UNIQUE KEY `users_email_unique` (`email`),
                         UNIQUE KEY `users_discord_id_unique` (`discord_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2022-03-31 00:37:58
