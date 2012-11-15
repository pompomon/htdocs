-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Ноя 15 2012 г., 07:35
-- Версия сервера: 5.0.24
-- Версия PHP: 5.1.6
-- 
-- БД: `test`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `pr_todos`
-- 

DROP TABLE IF EXISTS `pr_todos`;
CREATE TABLE IF NOT EXISTS `pr_todos` (
  `id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор',
  `desc` text NOT NULL,
  `date_add` datetime NOT NULL,
  `date_finish` datetime NOT NULL,
  `date_done` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
