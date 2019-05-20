create database if not exists `growth_db` default character set utf8 collate utf8_general_ci;
use `growth_db`;
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS user_score_tab;
create table IF NOT EXISTS user_score_tab(
  acname  varchar(32) not null COMMENT '用户帐号',
  instance_id char(50) NOT NULL default "" COMMENT '实例id',
  score   int not null default 0 COMMENT '积分',
  grade   int not null default 0 COMMENT '等级',
  charm   int not null default 0 COMMENT '魅力',
  create_time integer not null default 0 COMMENT '创建时间',
  PRIMARY KEY (`acname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户积分配置表' ;

DROP TABLE IF EXISTS class_tab;
create table IF NOT EXISTS class_tab(
  class_id int NOT NULL default 0  COMMENT '分类id',
  class_name char(50) NOT NULL default ""  COMMENT '分类名称',
  status   integer not null DEFAULT 0 COMMENT '配置状态，0：未配置；1：启用；2：停用;3:删除',
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='规则分类表';

DROP TABLE IF EXISTS action_config_tab;
create table IF NOT EXISTS action_config_tab(
  action_id  varchar(32) not null COMMENT '行为ID',
  module_name char(100) NOT NULL default "" COMMENT '组件名称',
  action_name char(100) NOT NULL default "" COMMENT '行为英文名称',
  action_name_cn char(100) NOT NULL default "" COMMENT '行为中文名称',
  operator_id char(50) NOT NULL default "" COMMENT '操作员id',
  status   integer not null DEFAULT 1 COMMENT '配置状态，0：未配置；1：启用；2：停用;3:删除',
  create_time integer not null default 0 COMMENT '创建时间',
  PRIMARY KEY (`action_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='行为配置主表' ;

DROP TABLE IF EXISTS rule_class_tab;
create table IF NOT EXISTS rule_class_tab(
  action_id  varchar(32) not null COMMENT '行为ID',
  instance_id char(50) NOT NULL default "" COMMENT '实例id',
  class_id int NOT NULL default 0  COMMENT '分类id',
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='规则分类表';

DROP TABLE IF EXISTS rule_tab;
create table IF NOT EXISTS rule_tab(
  rule_id  varchar(32) not null COMMENT '规则ID',
  action_id  varchar(32) not null COMMENT '行为ID',
  instance_id char(50) NOT NULL default "" COMMENT '实例id',
  rule_name varchar(100) not null default "" COMMENT '规则名称',
  rule_desc varchar(100) not null default "" COMMENT '规则描述',
  rule_type tinyint not null default 0 COMMENT '规则类型:0:每次;1:首次;2:每日首次;3:连续;4:累计;5:未做;6:连续未做;7:累计未做;8:区间',
  add_flag tinyint not null default 0  COMMENT '加分标志0:加分,1:减分',
  random_flag tinyint not null default 1  COMMENT '积分随机标志0:随机,1:不随机',
  score_low   int not null default 0 COMMENT '积分下限',
  score_high   int not null default 0 COMMENT '积分上限',

  #周期内计数用到#
  period_type  tinyint not null default 4 COMMENT '周期类型0:分;1:时;2:天;3:周;4:月;5:年',

  #周期内计数和连续计数用到#
  action_count int not null default 0 COMMENT '行为次数',
  valid_interval int not null default 0 COMMENT '有效间隔',
  interval_unit int not null default 2 COMMENT '有效间隔单位:0:分;1:时;2:天;3:周;4:月;5:年',

  #区间设置使用#
  rang_low   int not null default 0 COMMENT '区间下限',
  rang_high  int not null default 0 COMMENT '区间上限',

  status   integer not null DEFAULT 0 COMMENT '配置状态，0：未配置；1：启用；2：停用;3:删除',
  update_time integer not null default 0 COMMENT '更新时间',
  create_time integer not null default 0 COMMENT '创建时间',
  PRIMARY KEY (`rule_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='周期积分配置表' ;

DROP TABLE IF EXISTS `change_tab`;
CREATE TABLE IF NOT EXISTS  `change_tab` (
  change_id  varchar(32) not null COMMENT '变动ID',
  action_id  varchar(32) not null COMMENT '行为ID',
  instance_id char(50) NOT NULL default "" COMMENT '实例id',
  acname  varchar(32) not null COMMENT '用户帐号',
  type tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型0:积分;1:等级;2:魅力',
  pre_amount int(10) NOT NULL COMMENT '变动前数量',
  amount int(10) NOT NULL COMMENT '变动数量',
  after_amount int(10) NOT NULL COMMENT '变动后数量',
  operator_id char(50) NOT NULL COMMENT '操作用户ID',
  create_time int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`change_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户积分魅力变动表';