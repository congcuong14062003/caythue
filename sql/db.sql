
CREATE TABLE IF NOT EXISTS `User` (
  `UserId` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(200) NOT NULL,
  `UserPassword` varchar(200) NOT NULL,
  `UserEmail` varchar(200) NOT NULL,
  PRIMARY KEY (`UserId`)
);
create table if not exists `ProductProperty` (
	`ProdPropertyId` int not null AUTO_INCREMENT Primary key,
	`ProdCategoryName` varchar(250) not null,
	`ProdTitle` varchar(250) not null,
    `ProdPropertyName` varchar(250) not null
);
ALTER TABLE `ProductProperty`
ADD INDEX `idx_ProdCategoryName` (`ProdCategoryName`);

CREATE TABLE IF NOT EXISTS `Product` (
  `ProdId` int NOT NULL AUTO_INCREMENT,
  `ProdName` varchar(250) NOT NULL,
  `ProdDescription` varchar(4000) NOT NULL,
  `ProdImage` varchar(250) NOT NULL,
  `ProdPrice` decimal(18, 2) NOT NULL,
  `ProdPriceSale` decimal(18, 2) not null,
  `ProdQuantity` int NOT NULL,
  `ProdCategoryName` varchar(250) not null,
  `UserId` int,
  PRIMARY KEY (`ProdId`),
  FOREIGN KEY (`ProdCategoryName`) REFERENCES `ProductProperty` (`ProdCategoryName`),
  FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`)
);
-- Bảng Customer
CREATE TABLE IF NOT EXISTS `Customer` (
  `CusId` int NOT NULL AUTO_INCREMENT,
  `CusUserName` varchar(100) NOT NULL,
  `CusPassWord` varchar(150) not null,
  `CusName` nvarchar(150) not null,
  `CusEmail` varchar(250) NOT NULL,
  `CusPhone` varchar(20) NOT NULL,
  `CusAddress` varchar(250) NOT NULL,
  PRIMARY KEY (`CusId`)
);
-- Bảng Order: 
CREATE TABLE IF NOT EXISTS `Order` (
  `OrderId` int NOT NULL AUTO_INCREMENT,
  `CusId` int NOT NULL,
  `OrderTotalPrice` decimal(18, 2) NOT NULL,
  `OrderQuantity` int NOT NULL,
  `OrderStatus` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`OrderId`),
  FOREIGN KEY (`CusId`) REFERENCES `Customer` (`CusId`)
);

-- Bảng OrderDetail:
CREATE TABLE IF NOT EXISTS `OrderDetail` (
  `OrderId` int NOT NULL,
  `ProdId` int NOT NULL,
  `OrdQuantity` int NOT NULL,
  `OrdPrice` decimal(18, 2) NOT NULL,
  PRIMARY KEY (`OrderId`, `ProdId`),
  FOREIGN KEY (`OrderId`) REFERENCES `Order` (`OrderId`),
  FOREIGN KEY (`ProdId`) REFERENCES `Product` (`ProdId`)
);






-- Chèn các đặc điểm của iPhone
INSERT INTO `ProductProperty` (`ProdCategoryName`, `ProdTitle`, `ProdPropertyName`) VALUES
('iPhone', 'Màu sắc', 'Trắng'),
('iPhone', 'Màu sắc', 'Đen'),
('iPhone', 'Màu sắc', 'Tím'),
('iPhone', 'Màu sắc', 'Gold'),
('iPhone', 'Dung lượng', '32GB'),
('iPhone', 'Dung lượng', '64GB'),
('iPhone', 'Dung lượng', '128GB'),
('iPhone', 'Dung lượng', '256GB');

-- Chèn các đặc điểm của iPad
INSERT INTO `ProductProperty` (`ProdCategoryName`, `ProdTitle`, `ProdPropertyName`) VALUES
('iPad', 'Màu sắc', 'Trắng'),
('iPad', 'Màu sắc', 'Đen'),
('iPad', 'Màu sắc', 'Tím'),
('iPad', 'Dung lượng', '32GB'),
('iPad', 'Dung lượng', '64GB'),
('iPad', 'Dung lượng', '128GB'),
('iPad', 'Dung lượng', '256GB'),
('iPad', 'Dung lượng', '1TB');

-- Chèn các đặc điểm của MacBook
INSERT INTO `ProductProperty` (`ProdCategoryName`, `ProdTitle`, `ProdPropertyName`) VALUES
('Macbook', 'Màu sắc', 'Trắng'),
('Macbook', 'Màu sắc', 'Hồng'),
('Macbook', 'Dung lượng', '8/128GB'),
('Macbook', 'Dung lượng', '8/256GB'),
('Macbook', 'Dung lượng', '8/1TB'),
('Macbook', 'Dung lượng', '16/1TB');

-- Chèn các đặc điểm của Phụ kiện
INSERT INTO `ProductProperty` (`ProdCategoryName`, `ProdTitle`, `ProdPropertyName`) VALUES
('Phụ kiện', 'Màu sắc', 'Đen'),
('Phụ kiện', 'Màu sắc', 'Bạc'),
('Phụ kiện', 'Màu sắc', 'Vàng'),
('Phụ kiện', 'Màu sắc', 'Bạch Kim');

-- Chèn các đặc điểm của AirPods
INSERT INTO `ProductProperty` (`ProdCategoryName`, `ProdTitle`, `ProdPropertyName`) VALUES
('AirPod', 'Màu sắc', 'Trắng'),
('AirPod', 'Màu sắc', 'Đen');

-- Chèn các đặc điểm của Thiết bị gia dụng
INSERT INTO `ProductProperty` (`ProdCategoryName`, `ProdTitle`, `ProdPropertyName`) VALUES
('Thiết bị gia dụng', 'Màu sắc', 'Xanh'),
('Thiết bị gia dụng', 'Màu sắc', 'Đỏ');

-- Chèn 10 bản ghi sản phẩm vào bảng Product
INSERT INTO `Product` (`ProdName`, `ProdDescription`, `ProdImage`, `ProdPrice`, `ProdPriceSale`, `ProdQuantity`, `ProdCategoryName`, `UserId`)
VALUES
('Sản phẩm 9', 'Mô tả sản phẩm 9', 'product9.jpg', 180.00, 170.00, 55, 'Phụ kiện', 1),
('Sản phẩm 1', 'Mô tả sản phẩm 1', 'product1.jpg', 100.00, 90.00, 50, 'iPhone', 1),
('Sản phẩm 2', 'Mô tả sản phẩm 2', 'product2.jpg', 150.00, 140.00, 30, 'iPhone', 1),
('Sản phẩm 3', 'Mô tả sản phẩm 3', 'product3.jpg', 200.00, 190.00, 25, 'Macbook', 1),
('Sản phẩm 4', 'Mô tả sản phẩm 4', 'product4.jpg', 120.00, 110.00, 40, 'Macbook', 1),
('Sản phẩm 5', 'Mô tả sản phẩm 5', 'product5.jpg', 80.00, 75.00, 60, 'AirPod', 1),
('Sản phẩm 6', 'Mô tả sản phẩm 6', 'product6.jpg', 250.00, 240.00, 20, 'AirPod', 1),
('Sản phẩm 7', 'Mô tả sản phẩm 7', 'product7.jpg', 300.00, 290.00, 35, 'Thiết bị gia dụng', 1),
('Sản phẩm 8', 'Mô tả sản phẩm 8', 'product8.jpg', 70.00, 65.00, 45, 'Thiết bị gia dụng', 1),
('Sản phẩm 10', 'Mô tả sản phẩm 10', 'product10.jpg', 130.00, 120.00, 50, 'iPad', 1);