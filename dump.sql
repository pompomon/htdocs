-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ����� ��������: ��� 15 2012 �., 07:35
-- ������ �������: 5.0.24
-- ������ PHP: 5.1.6
-- 
-- ��: `test`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `pr_todos`
-- 

DROP TABLE IF EXISTS `pr_todos`;
CREATE TABLE IF NOT EXISTS `pr_todos` (
  `id` int(11) NOT NULL auto_increment COMMENT '�������������',
  `desc` text NOT NULL,
  `date_add` datetime NOT NULL,
  `date_finish` datetime NOT NULL,
  `date_done` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
