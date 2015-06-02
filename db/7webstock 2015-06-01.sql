/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : 7webstock

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2015-06-01 14:58:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tblbranch`
-- ----------------------------
DROP TABLE IF EXISTS `tblbranch`;
CREATE TABLE `tblbranch` (
  `BranchID` text,
  `BranchName` text,
  `Decription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblbranch
-- ----------------------------
INSERT INTO `tblbranch` VALUES ('123', 'A', 'Branch A');
INSERT INTO `tblbranch` VALUES ('1234', 'B', 'This is B');
INSERT INTO `tblbranch` VALUES ('1429329904', 'C', 'Branch C');
INSERT INTO `tblbranch` VALUES ('1429759395', 'D', 'This is Branch D');
INSERT INTO `tblbranch` VALUES ('0', 'All Branch', null);
INSERT INTO `tblbranch` VALUES ('1430901802', 'E', '');
INSERT INTO `tblbranch` VALUES ('1430903952', 'F', '');

-- ----------------------------
-- Table structure for `tblprdsaletem`
-- ----------------------------
DROP TABLE IF EXISTS `tblprdsaletem`;
CREATE TABLE `tblprdsaletem` (
  `IP` text,
  `ProductID` text,
  `ProductName` text,
  `BranchID` text,
  `ProductCategoryID` text,
  `ProductCode` text,
  `QTY` int(11) DEFAULT NULL,
  `BuyPrice` float DEFAULT NULL,
  `SalePrice` float DEFAULT NULL,
  `PrdCopied` int(11) DEFAULT NULL,
  `UpdateTem` int(11) DEFAULT NULL,
  `isStock` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblprdsaletem
-- ----------------------------

-- ----------------------------
-- Table structure for `tblprdtem`
-- ----------------------------
DROP TABLE IF EXISTS `tblprdtem`;
CREATE TABLE `tblprdtem` (
  `IP` text,
  `ProductID` text,
  `ProductName` text,
  `ProductCategoryID` text,
  `ProductCode` text,
  `QTY` int(11) DEFAULT NULL,
  `BuyPrice` float DEFAULT NULL,
  `SalePrice` float DEFAULT NULL,
  `PrdCopied` int(11) DEFAULT NULL,
  `UpdateTem` int(11) DEFAULT NULL,
  `BranchID` int(11) DEFAULT NULL,
  `isStock` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblprdtem
-- ----------------------------

-- ----------------------------
-- Table structure for `tblproductcategory`
-- ----------------------------
DROP TABLE IF EXISTS `tblproductcategory`;
CREATE TABLE `tblproductcategory` (
  `ProductCategoryID` text,
  `ProductCategoryName` text,
  `Decription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblproductcategory
-- ----------------------------
INSERT INTO `tblproductcategory` VALUES ('1', 'Apple', '');
INSERT INTO `tblproductcategory` VALUES ('2', 'Samsung', null);
INSERT INTO `tblproductcategory` VALUES ('3', 'Nokia', null);
INSERT INTO `tblproductcategory` VALUES ('1429330149', 'LG999', '');
INSERT INTO `tblproductcategory` VALUES ('1429775770', 'Book Store', 'Engish book');
INSERT INTO `tblproductcategory` VALUES ('1430899717', 'Car', '');
INSERT INTO `tblproductcategory` VALUES ('1432021651', 'Service', '123');
INSERT INTO `tblproductcategory` VALUES ('1432372512', '7Technology', 'ssssssssss');

-- ----------------------------
-- Table structure for `tblproducts`
-- ----------------------------
DROP TABLE IF EXISTS `tblproducts`;
CREATE TABLE `tblproducts` (
  `ProductID` text,
  `ProductName` text,
  `ProductCategoryID` text,
  `ProductCode` text,
  `Qty` int(11) DEFAULT NULL,
  `BuyPrice` float DEFAULT NULL,
  `SalePrice` float DEFAULT NULL,
  `Decription` text,
  `isStock` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblproducts
-- ----------------------------
INSERT INTO `tblproducts` VALUES ('14329729672', 'Book1', '1429775770', 'b1', '1', '10', '13', 'Desc', null);
INSERT INTO `tblproducts` VALUES ('14329730112', 'Book2', '1', 'b2', '1', '4', '5', 'Desc', null);
INSERT INTO `tblproducts` VALUES ('14329740422', 'Book3', '1', 'b3', '1', '2', '5.3', 'Desc', null);
INSERT INTO `tblproducts` VALUES ('14329740592', 'Book4', '1', 'b1', '1', '4', '4.5', 'Desc', null);
INSERT INTO `tblproducts` VALUES ('14329750912', 'Gaxa1', '2', 'Gaxa1', '1', '120', '130', 'Desc', null);
INSERT INTO `tblproducts` VALUES ('14329751172', 'Book2', '1429775770', 'B11', '1', '3.3', '5.5', 'Desc', null);

-- ----------------------------
-- Table structure for `tblproductsbranch`
-- ----------------------------
DROP TABLE IF EXISTS `tblproductsbranch`;
CREATE TABLE `tblproductsbranch` (
  `ProductID` text,
  `BranchID` text,
  `BuyPrice` float DEFAULT NULL,
  `OtherCost` float DEFAULT NULL,
  `SalePrice` float DEFAULT NULL,
  `Qty` float DEFAULT NULL,
  `QtyInstock` float DEFAULT NULL,
  `TotalBuyPrice` float DEFAULT NULL,
  `Decription` text,
  `FromBranchID` text,
  `FromPrdID` text,
  `isStock` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblproductsbranch
-- ----------------------------
INSERT INTO `tblproductsbranch` VALUES ('14329729672', '123', '10', '0', '13', '0', null, null, null, null, null, null);
INSERT INTO `tblproductsbranch` VALUES ('14329730112', '123', '4', '0', '5', '0', null, null, null, null, null, null);
INSERT INTO `tblproductsbranch` VALUES ('14329740422', '123', '2', '0', '5.3', '0', null, null, null, null, null, null);
INSERT INTO `tblproductsbranch` VALUES ('14329740592', '123', '4', '0', '4.5', '0', null, null, null, null, null, null);
INSERT INTO `tblproductsbranch` VALUES ('14329750912', '123', '120', '0', '130', '1', null, null, null, null, null, null);
INSERT INTO `tblproductsbranch` VALUES ('14329751172', '123', '3.3', '0', '5.5', '1', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `tblproducts_buy`
-- ----------------------------
DROP TABLE IF EXISTS `tblproducts_buy`;
CREATE TABLE `tblproducts_buy` (
  `BuyID` text,
  `BuyDate` datetime DEFAULT NULL,
  `UserID` text,
  `Decription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblproducts_buy
-- ----------------------------
INSERT INTO `tblproducts_buy` VALUES ('1432972967', '2015-05-30 15:02:47', '1', '');
INSERT INTO `tblproducts_buy` VALUES ('1432973011', '2015-05-30 15:03:31', '1', '');
INSERT INTO `tblproducts_buy` VALUES ('1432974042', '2015-05-30 15:20:42', '1', '');
INSERT INTO `tblproducts_buy` VALUES ('1432974059', '2015-05-30 15:20:59', '1', '');
INSERT INTO `tblproducts_buy` VALUES ('1432975091', '2015-05-30 15:38:11', '1', '');
INSERT INTO `tblproducts_buy` VALUES ('1432975117', '2015-05-30 15:38:37', '1', '');

-- ----------------------------
-- Table structure for `tblproducts_buydetail`
-- ----------------------------
DROP TABLE IF EXISTS `tblproducts_buydetail`;
CREATE TABLE `tblproducts_buydetail` (
  `BuyDetailID` text,
  `BuyID` text,
  `UserID` text,
  `ProductID` text,
  `Qty` float DEFAULT NULL,
  `BuyPrice` float DEFAULT NULL,
  `OtherCost` float DEFAULT NULL,
  `Decription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblproducts_buydetail
-- ----------------------------
INSERT INTO `tblproducts_buydetail` VALUES ('14329729673', '1432972967', '1', '14329729672', '1', '10', null, '');
INSERT INTO `tblproducts_buydetail` VALUES ('14329730113', '1432973011', '1', '14329730112', '1', '4', null, '');
INSERT INTO `tblproducts_buydetail` VALUES ('14329740423', '1432974042', '1', '14329740422', '1', '2', null, '');
INSERT INTO `tblproducts_buydetail` VALUES ('14329740593', '1432974059', '1', '14329740592', '1', '4', null, '');
INSERT INTO `tblproducts_buydetail` VALUES ('14329750913', '1432975091', '1', '14329750912', '1', '120', null, '');
INSERT INTO `tblproducts_buydetail` VALUES ('14329751173', '1432975117', '1', '14329751172', '1', '3.3', null, '');

-- ----------------------------
-- Table structure for `tbltest`
-- ----------------------------
DROP TABLE IF EXISTS `tbltest`;
CREATE TABLE `tbltest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbltest
-- ----------------------------
INSERT INTO `tbltest` VALUES ('1', '1');
INSERT INTO `tbltest` VALUES ('2', '123');
INSERT INTO `tbltest` VALUES ('3', '123');
INSERT INTO `tbltest` VALUES ('4', '123');

-- ----------------------------
-- Table structure for `tblusers`
-- ----------------------------
DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE `tblusers` (
  `UserID` text,
  `BranchID` text,
  `UserName` text,
  `Password` text,
  `Level` int(11) DEFAULT NULL,
  `Decription` text,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tblusers
-- ----------------------------
INSERT INTO `tblusers` VALUES ('1', '123', 'admin', 'a09sNXhtNExpZ1MwZkJSY0wwVGxiQT09', '1', '', '1');
INSERT INTO `tblusers` VALUES ('1431662725', '123', 'a', 'T3JITG9YU1FtWHB5cUJuN0tOUU1BUT09', '1', '', '1');
INSERT INTO `tblusers` VALUES ('1431662756', '123', 'aa', 'T3JITG9YU1FtWHB5cUJuN0tOUU1BUT09', '2', '', '1');

-- ----------------------------
-- Table structure for `tbl_app_setting`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_app_setting`;
CREATE TABLE `tbl_app_setting` (
  `ID` text,
  `Name` text,
  `Value` int(11) DEFAULT NULL,
  `Description` text,
  `IsEdit` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_app_setting
-- ----------------------------
INSERT INTO `tbl_app_setting` VALUES ('12345', 'Android', '1', 'Hello Android.', '127');

-- ----------------------------
-- Table structure for `tbl_customerorder`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_customerorder`;
CREATE TABLE `tbl_customerorder` (
  `CustomerOrderID` text,
  `BranchID` text,
  `ToBranchID` text,
  `InvoiceNo` text,
  `CustomerOrderDate` datetime DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `perDicount` float DEFAULT NULL,
  `AmtDiscount` float DEFAULT NULL,
  `GTotal` float DEFAULT NULL,
  `Recieve` float DEFAULT NULL,
  `Return` float DEFAULT NULL,
  `Decription` text,
  `UserID` text,
  `SelltoOtherBranch` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_customerorder
-- ----------------------------
INSERT INTO `tbl_customerorder` VALUES ('1432973018', '123', null, '1432973018', '2015-05-30 15:03:38', null, null, null, null, null, null, null, '1', null);
INSERT INTO `tbl_customerorder` VALUES ('1432973024', '123', null, '1432973024', '2015-05-30 15:03:44', null, null, null, null, null, null, null, '1', null);
INSERT INTO `tbl_customerorder` VALUES ('1432974107', '123', null, '1432974107', '2015-05-30 15:21:47', null, null, null, null, null, null, null, '1', null);
INSERT INTO `tbl_customerorder` VALUES ('1432974998', '123', null, '1432974998', '2015-05-30 15:36:38', null, null, null, null, null, null, null, '1', null);

-- ----------------------------
-- Table structure for `tbl_customerorderdetail`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_customerorderdetail`;
CREATE TABLE `tbl_customerorderdetail` (
  `CustomerOrderDetailID` text,
  `BranchID` text,
  `ToBranchID` text,
  `CustomerOrderID` text,
  `ProductID` text,
  `Qty` float DEFAULT NULL,
  `OtherCost` float DEFAULT NULL,
  `BuyPrice` float DEFAULT NULL,
  `SalePrice` float DEFAULT NULL,
  `perDicount` float DEFAULT NULL,
  `AmtDiscount` float DEFAULT NULL,
  `LastSalePrice` float DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `Decription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_customerorderdetail
-- ----------------------------
INSERT INTO `tbl_customerorderdetail` VALUES ('14329730182', '123', null, '1432973018', '14329729672', '1', null, '10', '13', '0', '0', '0', '0', 'Powered by 7Technology');
INSERT INTO `tbl_customerorderdetail` VALUES ('14329730242', '123', null, '1432973024', '14329730112', '1', '0.3', '4', '5', '0', '0', '0', '0', 'Powered by 7Technology');
INSERT INTO `tbl_customerorderdetail` VALUES ('14329741072', '123', null, '1432974107', '14329740422', '1', '6.2', '2', '10', '0', '0', '0', '0', 'Powered by 7Technology');
INSERT INTO `tbl_customerorderdetail` VALUES ('14329749982', '123', null, '1432974998', '14329740592', '1', null, '4', '4.5', '0', '0', '0', '0', 'Powered by 7Technology');

-- ----------------------------
-- Table structure for `tbl_service_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_service_type`;
CREATE TABLE `tbl_service_type` (
  `Service_Type_ID` text,
  `BranchID` text,
  `Service_Type_Name` text,
  `Service_Type_Desciption` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_service_type
-- ----------------------------

-- ----------------------------
-- Procedure structure for `spCompanyInsert`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spCompanyInsert`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCompanyInsert`( 
IN 
_ComID NVARCHAR(500),
_ComName NVARCHAR(500),
_ComDate DATE,
_ComProfile NVARCHAR(500),
_ComMobile INT,
_ComEmail NVARCHAR(500),
_ComAddress NVARCHAR(500),
_ComZipCode INT,
_LastUpdate DATE,
_UserID NVARCHAR(500),
_PrdCategID NVARCHAR(500),
_ComStatus INT

)
BEGIN

INSERT INTO tblcompany(
	ComID,
	ComName,
	ComDate,
	ComProfile,
	ComMobileNumber,
	ComEmail,
	ComAddress,
	ComZipCode,
	LastUpdate,
	UserID,
	PrdCategID,
	ComStatus
)
	VALUES ( 
	_ComID,
	_ComName,
	_ComDate,
	_ComProfile,
	_ComMobile,
	_ComEmail,
	_ComAddress,
	_ComZipCode,
	_LastUpdate,
	_UserID,
	_PrdCategID,
	_ComStatus
);

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spSearchPrdBuy`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spSearchPrdBuy`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchPrdBuy`(IN _SearchPrdBuy NVARCHAR(500))
BEGIN
	IF(_SearchPrdBuy = "") THEN
		SELECT 
			`tblproducts`.ProductID,
			`tblproducts`.ProductName,
			`tblproducts`.ProductCategoryID,
			tblproductcategory.ProductCategoryName,
			`tblproducts`.ProductCode,
			`tblproducts`.Qty,
			`tblproducts`.BuyPrice,
			`tblproducts`.SalePrice
			FROM `tblproducts`
			INNER JOIN tblproductcategory
			ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
		INNER JOIN tblproductsbranch
		ON tblproductsbranch.ProductID = tblproducts.ProductID
		WHERE tblproductsbranch.Qty >0
		LIMIT 7;
	ELSE
		SELECT 
			`tblproducts`.ProductID,
			`tblproducts`.ProductName,
			`tblproducts`.ProductCategoryID,
			tblproductcategory.ProductCategoryName,
			`tblproducts`.ProductCode,
			`tblproducts`.Qty,
			`tblproducts`.BuyPrice,
			`tblproducts`.SalePrice
			FROM `tblproducts`
			INNER JOIN tblproductcategory
			ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
			INNER JOIN tblproductsbranch
			ON tblproductsbranch.ProductID = tblproducts.ProductID
			WHERE  
			tblproducts.ProductName LIKE CONCAT(N'%' , _SearchPrdBuy , '%')
			OR tblproducts.ProductCode LIKE CONCAT(N'%' , _SearchPrdBuy , '%')
			AND tblproductsbranch.Qty >0;

	END IF;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spSearchPrdBuyHistory`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spSearchPrdBuyHistory`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchPrdBuyHistory`(IN _SearchPrdSale NVARCHAR(500), IN _SearchPrdBranch NVARCHAR(500))
BEGIN
	IF(_SearchPrdSale ) is NULL THEN
		SELECT 
				`tblproducts`.ProductID,
				`tblproducts`.ProductName,
				`tblproducts`.ProductCategoryID,
				tblproductcategory.ProductCategoryName,
				`tblproducts`.ProductCode,
				`tblproducts`.Qty,
				`tblproducts`.BuyPrice,
				`tblproducts`.SalePrice
				FROM `tblproducts`
				INNER JOIN tblproductcategory
				ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
				INNER JOIN tblproductsbranch
				ON tblproducts.ProductID = tblproductsbranch.ProductID ;
	ELSE
		SELECT 
				`tblproducts`.ProductID,
				`tblproducts`.ProductName,
				`tblproducts`.ProductCategoryID,
				tblproductcategory.ProductCategoryName,
				`tblproducts`.ProductCode,
				`tblproducts`.Qty,
				`tblproducts`.BuyPrice,
				`tblproducts`.SalePrice
				FROM `tblproducts`
				INNER JOIN tblproductcategory
				ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
				INNER JOIN tblproductsbranch
				ON tblproducts.ProductID = tblproductsbranch.ProductID
				WHERE ( `tblproducts`.ProductName LIKE CONCAT(N'%' , _SearchPrdSale  , '%') 
				OR `tblproducts`.ProductCode LIKE CONCAT(N'%' , _SearchPrdSale  , '%'))
				and tblproductsbranch.BranchID = '123' ;
			
	END IF;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spSearchPrdSale`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spSearchPrdSale`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSearchPrdSale`(IN _SearchPrdSale NVARCHAR(500), IN _SearchPrdBranch NVARCHAR(500))
BEGIN
	IF(_SearchPrdSale ) is NULL THEN
		SELECT 
				`tblproducts`.ProductID,
				`tblproducts`.ProductName,
				`tblproducts`.ProductCategoryID,
				tblproductcategory.ProductCategoryName,
				`tblproducts`.ProductCode,
				`tblproducts`.Qty,
				`tblproducts`.BuyPrice,
				`tblproducts`.SalePrice
				FROM `tblproducts`
				INNER JOIN tblproductcategory
				ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
				INNER JOIN tblproductsbranch
				ON tblproducts.ProductID = tblproductsbranch.ProductID ;
	ELSE
		SELECT 
				`tblproducts`.ProductID,
				`tblproducts`.ProductName,
				`tblproducts`.ProductCategoryID,
				tblproductcategory.ProductCategoryName,
				`tblproducts`.ProductCode,
				`tblproducts`.Qty,
				`tblproducts`.BuyPrice,
				`tblproducts`.SalePrice
				FROM `tblproducts`
				INNER JOIN tblproductcategory
				ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
				INNER JOIN tblproductsbranch
				ON tblproducts.ProductID = tblproductsbranch.ProductID
				WHERE ( `tblproducts`.ProductName LIKE CONCAT(N'%' , _SearchPrdSale  , '%') 
				OR `tblproducts`.ProductCode LIKE CONCAT(N'%' , _SearchPrdSale  , '%'))
				and tblproductsbranch.BranchID = '123' ;
			
	END IF;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spTestingSellingQty`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spTestingSellingQty`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spTestingSellingQty`( 
IN _SearchPrdBuy NVARCHAR(500) )
BEGIN

		
	SELECT 
	`tblproducts`.ProductID,
	`tblproducts`.ProductName,
	`tblproducts`.ProductCode,
	`tblproducts`.ProductCategoryID,
	tblproductcategory.ProductCategoryName,
	tblproductsbranch.Qty,
	tblproductsbranch.BuyPrice,
	tblproductsbranch.SalePrice
	FROM `tblproducts`
	INNER JOIN tblproductcategory
	ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
	INNER JOIN tblproductsbranch
	ON tblproducts.ProductID = tblproductsbranch.ProductID;
	

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spUserAccClearData`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spUserAccClearData`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserAccClearData`(_UserName NVARCHAR(500),
_UserPwd NVARCHAR(500))
BEGIN
 
SELECT tblusers.UserID,
tblusers.BranchID,
tblusers.UserName,
tblusers.`Password` AS UserPassword,
tblusers.`Level` AS UserLever,
tblusers.`Status` AS UserStatus,
tblbranch.BranchName
 FROM tblusers INNER JOIN tblbranch
ON tblusers.BranchID = tblbranch.BranchID
WHERE tblusers.UserName = _UserName 
AND tblusers.`Password` = _UserPwd 
AND tblusers.`STATUS` = 1
AND tblusers.UserID = 1;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `spUserAccSelete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `spUserAccSelete`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUserAccSelete`(_UserName NVARCHAR(500),
_UserPwd NVARCHAR(500))
BEGIN
 
SELECT tblusers.UserID,
tblusers.BranchID,
tblusers.UserName,
tblusers.`Password` AS UserPassword,
tblusers.`Level` AS UserLever,
tblusers.`Status` AS UserStatus,
tblbranch.BranchName
 FROM tblusers INNER JOIN tblbranch
ON tblusers.BranchID = tblbranch.BranchID
WHERE tblusers.UserName = _UserName 
AND tblusers.`Password` = _UserPwd 
AND tblusers.`STATUS` = 1;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Branch_Delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Branch_Delete`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Branch_Delete`(IN  _BranchID NVARCHAR(50))
BEGIN
	DELETE From tblbranch 
	WHERE BranchID=_BranchID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Branch_Select`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Branch_Select`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Branch_Select`(IN  _Search NVARCHAR(50))
BEGIN

IF (_Search="") THEN
	SELECT 	
	BranchID,
	BranchName,
	Decription 
	From tblbranch
	WHERE BranchID != 0;
ELSE 
	SELECT 	
	BranchID,
	BranchName,
	Decription 
	From tblbranch 
	WHERE (BranchName Like CONCAT('%' , _Search , '%') OR Decription Like CONCAT('%' , _Search , '%')  )
	AND BranchID != 0;
END IF;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Branch_Update`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Branch_Update`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Branch_Update`(IN  _BranchID NVARCHAR(50),_BranchName NVARCHAR(100),_Decription NVARCHAR(250))
BEGIN
	UPDATE tblbranch SET
			BranchName=_BranchName,
			Decription=_Decription
	WHERE BranchID=_BranchID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Category_Delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Category_Delete`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Category_Delete`(IN  _ProductCategoryID NVARCHAR(50))
BEGIN
	DELETE From tblproductcategory
	WHERE ProductCategoryID=_ProductCategoryID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Category_Select`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Category_Select`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Category_Select`(IN  _Search NVARCHAR(200))
BEGIN

IF (_Search="") THEN
	SELECT 	
	ProductCategoryID,
	ProductCategoryName,
	Decription 
	From tblproductcategory;
ELSE 
	SELECT 	
	ProductCategoryID,
	ProductCategoryName,
	Decription 
	From tblproductcategory
	WHERE (ProductCategoryName Like CONCAT('%' , _Search , '%') OR Decription Like CONCAT('%' , _Search , '%')  );
END IF;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Category_Update`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Category_Update`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Category_Update`(IN  _ProductCategoryID NVARCHAR(50),_ProductCategoryName NVARCHAR(100),_Decription NVARCHAR(250))
BEGIN
	UPDATE tblproductcategory SET
			ProductCategoryName=_ProductCategoryName,
			Decription=_Decription
	WHERE ProductCategoryID=_ProductCategoryID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Insert_Branch`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Insert_Branch`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Insert_Branch`(IN 
_BranchID NVARCHAR(50),
_BranchName NVARCHAR(100),
_Decription NVARCHAR(500))
BEGIN

INSERT INTO tblbranch(
	BranchID,
	BranchName,
	Decription
	
)
	VALUES ( 
	_BranchID,
	_BranchName,
	_Decription
	
);

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Insert_Category`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Insert_Category`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Insert_Category`(IN  _ProductCategoryID NVARCHAR(50),_ProductCategoryName NVARCHAR(100),_Decription NVARCHAR(250))
BEGIN

INSERT INTO tblproductcategory(
	ProductCategoryID,
	ProductCategoryName,
	Decription
	
)
	VALUES ( 
	_ProductCategoryID,
	_ProductCategoryName,
	_Decription
);

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_Insert_UserAccount`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_Insert_UserAccount`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Insert_UserAccount`(IN  _UserID  NVARCHAR(100),_BranchID  NVARCHAR(50),_UserName  NVARCHAR(100),_Password  NVARCHAR(100), _Level int,_Decription NVARCHAR(500),_Status int)
BEGIN

INSERT INTO tblusers(
  UserID,
	BranchID,
	UserName,
	Password,
	Level,
	Decription,
	Status
)
	VALUES ( 
	_UserID,
	_BranchID,
	_UserName,	
	_Password,
	_Level,
	_Decription,
	_Status

);

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_UserAccount_Delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_UserAccount_Delete`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UserAccount_Delete`(IN  _UserID  NVARCHAR(100))
BEGIN
	DELETE From tblusers 
  WHERE UserID=_UserID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_UserAccount_Select`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_UserAccount_Select`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UserAccount_Select`(IN  _Search NVARCHAR(100))
BEGIN

IF (_Search="") THEN
	SELECT 	
	UserID,
	BranchID,
	UserName,
	Password,
	Level,
	Decription,
	Status	
	From tblusers;
ELSE 
	SELECT 	
		UserID,
		BranchID,
		UserName,
		Password,
		Level,
		Decription,
		Status
	From tblusers 
	WHERE (UserName Like CONCAT('%' , _Search , '%') OR Decription Like CONCAT('%' , _Search , '%')  );
END IF;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_UserAccount_Select_By_ID`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_UserAccount_Select_By_ID`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UserAccount_Select_By_ID`(IN  _BranchID NVARCHAR(100))
BEGIN

	SELECT 	
	UserID,
	BranchID,
	UserName,
	Password,
	Level,
	Decription,
	Status	
	From tblusers
	WHERE BranchID=_BranchID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_UserAccount_Update`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_UserAccount_Update`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UserAccount_Update`(IN  _UserID  NVARCHAR(100),_BranchID  NVARCHAR(50),_UserName  NVARCHAR(100), _Level int,_Decription NVARCHAR(500),_Status int)
BEGIN
	UPDATE tblusers SET
			BranchID =_BranchID,
			UserName=_UserName,
			Level=_Level,
			Decription=_Decription,
			Status=_Status
	WHERE UserID=_UserID;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for `IncomeLevel`
-- ----------------------------
DROP FUNCTION IF EXISTS `IncomeLevel`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `IncomeLevel`( monthly_value INT ) RETURNS varchar(20) CHARSET utf8
BEGIN

   DECLARE income_level varchar(20);

   IF monthly_value <= 4000 THEN
      SET income_level = 'Low Income';

   ELSEIF monthly_value > 4000 AND monthly_value <= 7000 THEN
      SET income_level = 'Avg Income';

   ELSE
      SET income_level = 'High Income';

   END IF;

   RETURN income_level;

END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for `PageCount`
-- ----------------------------
DROP FUNCTION IF EXISTS `PageCount`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `PageCount`( value INT ) RETURNS varchar(10) CHARSET utf8
    DETERMINISTIC
BEGIN

   DECLARE level varchar(20);

   IF value < 500 THEN
      SET level = 'Low';

   ELSEIF value >= 500 AND value <= 4000 THEN
      SET level = 'Medium';

   ELSE
      SET level = 'High';

   END IF;

   RETURN level;

END
;;
DELIMITER ;
