/*
Date: 2018-06-26 21:02:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hy_xiand_pay
-- ----------------------------
DROP TABLE IF EXISTS `hy_xiand_pay`;
CREATE TABLE `hy_xiand_pay` (
  `trade_no` varchar(20) NOT NULL COMMENT '订单号',
  `uid` int(10) DEFAULT NULL COMMENT '用户主键',
  `money` int(11) DEFAULT NULL COMMENT '订单金额(以分为单位)',
  `type` tinyint(1) DEFAULT NULL COMMENT '支付方式 0.支付宝 1.微信 2.QQ 3.后台充值',
  `gold` int(10) DEFAULT NULL COMMENT '获得金币数',
  `status` tinyint(1) DEFAULT '0' COMMENT '支付状态 0. 未支付 1. 已支付',
  `pay_time` datetime DEFAULT NULL COMMENT '支付时间',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`trade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
