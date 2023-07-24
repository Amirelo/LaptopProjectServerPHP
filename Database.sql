DROP DATABASE thuctaptotnghiep;
CREATE DATABASE thuctaptotnghiep;
USE thuctaptotnghiep;
CREATE TABLE TBL_USER(
	userID INTEGER PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	userPassword VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	phoneNumber VARCHAR(12) NOT NULL,
	fullName VARCHAR(255) NOT NULL,
	imageLink VARCHAR(255) NOT NULL,
	birthday DATE NOT NULL,
	createDate DATE NOT NULL,
	gender VARCHAR(255) NOT NULL,
	accountStatus INTEGER NOT NULL,
	isAdmin BIT NOT NULL
);

CREATE TABLE TBL_ADDRESS (
	addressID INTEGER PRIMARY KEY AUTO_INCREMENT,
	addressName VARCHAR(255) NOT NULL,
	district VARCHAR(255) NOT NULL,
	ward VARCHAR(255) NOT NULL,
	city VARCHAR(255) NOT NULL,
	status INTEGER NOT NULL,
	userID INTEGER NOT NULL
);
ALTER TABLE TBL_ADDRESS ADD CONSTRAINT FK_USERADDRESS FOREIGN KEY (userID) REFERENCES TBL_USER(userID);
CREATE TABLE TBL_NOTIFICATION (
	notificationID INTEGER PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	detail VARCHAR(255) NOT NULL,
	createdDate VARCHAR(12) NOT NULL,
	disableDate VARCHAR(12) NOT NULL,
	status INTEGER NOT NULL,
	userID INTEGER NOT NULL
);
ALTER TABLE TBL_NOTIFICATION ADD CONSTRAINT FK_USERNOTIFICATION FOREIGN KEY (userID) REFERENCES TBL_USER(userID);
CREATE TABLE TBL_COUPON (
	couponID INTEGER PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	effect VARCHAR(10) NOT NULL,
	maxEffectValue INT NOT NULL,
	couponCode VARCHAR(20) NOT NULL,
	status INTEGER NOT NULL,
	userID INT NOT NULL
);
ALTER TABLE TBL_COUPON ADD CONSTRAINT FK_USERCOUPON FOREIGN KEY (userID) REFERENCES TBL_USER(userID);

CREATE TABLE TBL_CARD(
	cardID INTEGER PRIMARY KEY AUTO_INCREMENT,
	type VARCHAR(20) NOT NULL,
	cardNumber VARCHAR(30) NOT NULL,
	cardHolder VARCHAR(100) NOT NULL,
	expiryMonth INTEGER,
	expiryYear INTEGER,
	status INTEGER NOT NULL,
	userID INTEGER NOT NULL
);

ALTER TABLE TBL_CARD ADD CONSTRAINT FK_USERCARD FOREIGN KEY (userID) REFERENCES TBL_USER(userID);

CREATE TABLE TBL_USERORDER (
	userOrderID INTEGER PRIMARY KEY AUTO_INCREMENT,
	totalPrice BIGINT NOT NULL,
	originalPrice BIGINT NOT NULL,
	note VARCHAR(255) NOT NULL,
	status INTEGER NOT NULL,
	receiver VARCHAR(255) NOT NULL,
	shippingFee INT NOT NULL,
	pendingDate VARCHAR(12),
	prepareDate VARCHAR(12),
	deliveryDate VARCHAR(12),
	arrivedDate VARCHAR(12),
	addressID INTEGER NOT NULL,
	userID INTEGER NOT NULL,
	couponID INTEGER,
	cardID INTEGER
);
ALTER TABLE TBL_USERORDER ADD CONSTRAINT FK_USERORDER FOREIGN KEY (userID) REFERENCES TBL_USER(userID);
ALTER TABLE TBL_USERORDER ADD CONSTRAINT FK_ORDERCOUPON FOREIGN KEY (couponID) REFERENCES TBL_COUPON(couponID);
ALTER TABLE TBL_USERORDER ADD CONSTRAINT FK_ORDERADDRESS FOREIGN KEY (addressID) REFERENCES TBL_ADDRESS(addressID);
ALTER TABLE TBL_USERORDER ADD CONSTRAINT FK_ORDERCARD FOREIGN KEY (cardID) REFERENCES TBL_CARD(cardID);


CREATE TABLE TBL_BRAND(
	brandID INTEGER PRIMARY KEY AUTO_INCREMENT,
    status BIT NOT NULL,
	brandName VARCHAR(255) NOT NULL
);
CREATE TABLE TBL_STORAGE(
	storageID INTEGER PRIMARY KEY AUTO_INCREMENT,
	type VARCHAR(255) NOT NULL,
	maxSlots INTEGER NOT NULL,
	availableSlots INTEGER NOT NULL,
	currentStorage VARCHAR(20) NOT NULL,
    status BIT NOT NULL
);
CREATE TABLE TBL_MEMORY(
	memoryID INT PRIMARY KEY AUTO_INCREMENT,
	currentRAM VARCHAR(255) NOT NULL,
	type VARCHAR(255) NOT NULL,
	speed VARCHAR(255) NOT NULL,
	maxSlots INTEGER NOT NULL,
	availableSlots INTEGER NOT NULL,
	maxRam VARCHAR(255) NOT NULL,
    status BIT NOT NULL
);
CREATE TABLE TBL_SCREEN(
	screenID INT PRIMARY KEY AUTO_INCREMENT,
	resolution VARCHAR(255) NOT NULL,
	screenSize VARCHAR(255) NOT NULL,
    status BIT NOT NULL
);
CREATE TABLE TBL_OPERATINGSYSTEM(
	operatingSystemID INT PRIMARY KEY AUTO_INCREMENT,
	OS VARCHAR(255) NOT NULL,
	version VARCHAR(255) NOT NULL,
	type VARCHAR(255) NOT NULL,
    status BIT NOT NULL
);


CREATE TABLE TBL_PROCESSOR(
	processorID INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	CPU_Speed INT NOT NULL,
	cores INT NOT NULL,
	logicalProcessors INT NOT NULL,
	cacheMemory INT NOT NULL,
    status BIT NOT NULL
);
CREATE TABLE TBL_PRODUCT(
	productID INT PRIMARY KEY AUTO_INCREMENT,
	productName VARCHAR(255) NOT NULL,
	productPrice BIGINT NOT NULL,
	productQuantity INT NOT NULL,
	releasedDate VARCHAR(12) NOT NULL,
	totalRating FLOAT NOT NULL,
	modelCode VARCHAR(255) NOT NULL,
	onSale VARCHAR(100) NOT NULL,
	currentPrice BIGINT NOT NULL,
	manufacturer VARCHAR(100) NOT NULL,
	warranty INT NOT NULL,
	sold INT NOT NULL,
	length FLOAT NOT NULL,
	width FLOAT NOT NULL,
	height FLOAT NOT NULL,
	weight FLOAT NOT NULL,
    status BIT NOT NULL,
	brandID INT NOT NULL,
	screenID INT NOT NULL,
	operatingSystemID INT NOT NULL,
	processorID INT NOT NULL,
	memoryID INT NOT NULL,
	storageID INT NOT NULL
);
ALTER TABLE TBL_PRODUCT ADD CONSTRAINT FK_PRODUCT_BRAND FOREIGN KEY (brandID) REFERENCES TBL_BRAND(brandID);
ALTER TABLE TBL_PRODUCT ADD CONSTRAINT FK_PRODUCT_SCREEN FOREIGN KEY (screenID) REFERENCES TBL_SCREEN(screenID);
ALTER TABLE TBL_PRODUCT ADD CONSTRAINT FK_PRODUCT_OPERATINGSYSTEM FOREIGN KEY (operatingSystemID) REFERENCES TBL_OPERATINGSYSTEM(operatingSystemID);
ALTER TABLE TBL_PRODUCT ADD CONSTRAINT FK_PRODUCT_PROCESSOR FOREIGN KEY (processorID) REFERENCES TBL_PROCESSOR(processorID);
ALTER TABLE TBL_PRODUCT ADD CONSTRAINT FK_PRODUCT_MEMORY FOREIGN KEY (memoryID) REFERENCES TBL_MEMORY(memoryID);
ALTER TABLE TBL_PRODUCT ADD CONSTRAINT FK_PRODUCT_STORAGE FOREIGN KEY (storageID) REFERENCES TBL_STORAGE(storageID);
 
CREATE TABLE TBL_PRODUCTIMAGE(
	productImageID INT PRIMARY KEY AUTO_INCREMENT,
	productImageLink VARCHAR(255) NOT NULL,
	status INTEGER NOT NULL,
	productID INT NOT NULL
);
ALTER TABLE TBL_PRODUCTIMAGE ADD CONSTRAINT FK_PRODUCT_IMAGES FOREIGN KEY (productID) REFERENCES TBL_PRODUCT(productID);

CREATE TABLE TBL_CART(
	cartID INT PRIMARY KEY AUTO_INCREMENT,
	itemQuantity INT NOT NULL,
	userID INT NOT NULL,
	productID INT NOT NULL
);
ALTER TABLE TBL_CART ADD CONSTRAINT FK_CART_PRODUCT FOREIGN KEY (productID) REFERENCES TBL_PRODUCT(productID);
ALTER TABLE TBL_CART ADD CONSTRAINT FK_CART_USER FOREIGN KEY (userID) REFERENCES TBL_USER(userID);

CREATE TABLE TBL_RATING(
	ratingID INT PRIMARY KEY AUTO_INCREMENT,
	dateAdded VARCHAR(12) NOT NULL,
	rating FLOAT NOT NULL,
	comment VARCHAR(255) NOT NULL,
	status BIT NOT NULL,
	userID INT NOT NULL,
	productID INT NOT NULL
);
ALTER TABLE TBL_RATING ADD CONSTRAINT FK_PRODUCT_RATING FOREIGN KEY (productID) REFERENCES TBL_PRODUCT(productID);
ALTER TABLE TBL_RATING ADD CONSTRAINT FK_USER_RATING FOREIGN KEY (userID) REFERENCES TBL_USER(userID);

CREATE TABLE TBL_FAVORITE(
	favoriteID INT PRIMARY KEY AUTO_INCREMENT,
	isFavorite BIT NOT NULL,
	userID INT NOT NULL,
	productID INT NOT NULL
);
ALTER TABLE TBL_FAVORITE ADD CONSTRAINT FK_PRODUCT_FAVORITE FOREIGN KEY (productID) REFERENCES TBL_PRODUCT(productID);
ALTER TABLE TBL_FAVORITE ADD CONSTRAINT FK_USER_FAVORITE FOREIGN KEY (userID) REFERENCES TBL_USER(userID);

CREATE TABLE TBL_RATINGIMAGE(
	ratingImageID INT PRIMARY KEY AUTO_INCREMENT,
	imageLink VARCHAR(255) NOT NULL,
    status INTEGER NOT NULL,
	ratingID INT NOT NULL
);
ALTER TABLE TBL_RATINGIMAGE ADD CONSTRAINT FK_RATINGANDFAVORITE_IMAGE FOREIGN KEY (ratingID) REFERENCES TBL_RATING(ratingID);

CREATE TABLE TBL_ORDERDETAIL(
	orderDetailID INT PRIMARY KEY AUTO_INCREMENT,
	productQuantity INT NOT NULL,
	userOrderID INT NOT NULL, 
	productID INT NOT NULL
);
ALTER TABLE TBL_ORDERDETAIL ADD CONSTRAINT FK_ORDERDETAIL_PRODUCT FOREIGN KEY (productID) REFERENCES TBL_PRODUCT(productID);
ALTER TABLE TBL_ORDERDETAIL ADD CONSTRAINT FK_ORDERDETAIL_USERORDER FOREIGN KEY (userOrderID) REFERENCES TBL_USERORDER(userOrderID);


INSERT INTO TBL_USER (userid,username, userPassword, email, phoneNumber, fullName, imageLink, birthday, createDate, gender, accountStatus, isAdmin) VALUES 
(1,"Geronimo","gen123","geronimo@gmail.com","0976854567", "Geronimo Raju", "https://cdn.pixabay.com/photo/2023/05/28/00/34/sunset-8022573_1280.jpg", "1989-06-20", "2015-07-03", "female", "1", false),
(2,"Debauchery","dechery","debauchery@gmail.com","0976852412", "Debauchery Desmond", "https://cdn.pixabay.com/photo/2023/06/14/22/15/huts-8064061_1280.jpg", "1989-03-02", "2015-07-03", "male", "1", false),
(3,"Drask","dra123","drask@gmail.com","0976852222", "Drask Cromon", "https://cdn.pixabay.com/photo/2023/04/01/01/28/piano-7891138_1280.jpg", "1988-12-31", "2015-07-03", "male", "1", false),
(4,"Gishmo","gis123","gismo@gmail.com","0975468743", "Gishmo Califau", "https://cdn.pixabay.com/photo/2023/05/12/19/59/maidens-tower-7989254_1280.jpg", "1988-01-01", "2015-07-03", "femai", "1", false),
(5,"admin","admin123","admin@gmail.com","0675367543","Admin admin", "https://cdn.pixabay.com/photo/2015/11/26/00/14/woman-1063100_1280.jpg", "1989-04-12","2014-07-19","Male",1,true),
(6,"Beatriz","bea123","beatriz@gmail.com","0987654321","Beatriz Aleksandra","https://cdn.pixabay.com/photo/2023/06/27/10/51/man-8091933_1280.jpg","1999-09-04","2015-07-06","unknown",1, false),
(7,"Charles","char123","charles@gmail.com","0967324567","Charles Madyson","https://cdn.pixabay.com/photo/2023/07/16/19/25/animal-8131312_1280.jpg","1998-10-12","2015-07-06","unknown",1, false),
(8,"Diya","diya123","diya@gmail.com","0987543567","Diya Juli","https://cdn.pixabay.com/photo/2023/04/11/16/16/lighthouse-7917690_1280.jpg","1987-12-05","2015-07-06","unknown",1, false),
(9,"Gabriel","gab123","gabriel@gmail.com","0912427865","Gabriel Demelza","https://cdn.pixabay.com/photo/2023/07/12/07/07/cat-8121892_1280.jpg","1994-11-04","2015-07-06","unknown",0, false),
(10,"Dora","dora123","dora@gmail.com","0578463728","Dora Concetto","https://cdn.pixabay.com/photo/2023/05/23/18/12/hummingbird-8013214_1280.jpg","1996-02-12","2015-07-06","unknown",1, false),
(11,"Roslindis","ros123","roslindis@gmail.com","0756382914","Roslindis Clem","https://cdn.pixabay.com/photo/2023/06/29/10/33/lion-8096155_1280.png","2000-05-26","2015-07-06","unknown",1, false),
(12,"Eithne","eith123","eithne@gmail.com","0846372819","Eithne Savitri","https://cdn.pixabay.com/photo/2023/07/08/09/53/monastery-8114076_1280.jpg","2005-02-17","2015-07-06","unknown",1, false),
(13,"Njord","jor123","njord@gmail.com","0967544786","Njord Elikapeka","https://cdn.pixabay.com/photo/2023/07/05/04/45/european-shorthair-8107433_1280.jpg","2010-02-09","2015-07-06","unknown",1, false),
(14,"Bipin","pin123","bipin@gmail.com","0754444678","Bipin Ikaros","https://cdn.pixabay.com/photo/2023/07/03/19/35/border-collie-8104878_1280.jpg","2002-07-15","2015-07-06","unknown",0, false),
(15,"Valentine","val123","valentine@gmail.com","0764737773","Valentine Sudheer","https://cdn.pixabay.com/photo/2023/07/01/18/56/dog-8100754_1280.jpg","1987-11-04","2015-07-06","unknown",1, false),
(16,"Emmerich","emm123","emmerich@gmail.com","0876537786","Emmerich Severin","https://cdn.pixabay.com/photo/2022/08/17/15/46/labrador-7392840_1280.jpg","2000-09-09","2015-07-06","unknown",1, false),
(17,"Euterpe","eut123","euterpe@gmail.com","0977664836","Euterpe Jayla","https://cdn.pixabay.com/photo/2023/06/28/12/43/flower-8094368_1280.jpg","2001-04-08","2015-07-06","unknown",1, false),
(18,"Scipio","sci123","scipio@gmail.com","0864444456","Scipio Adalindis","https://cdn.pixabay.com/photo/2023/06/26/13/41/wolf-8089783_1280.jpg","2002-02-11","2015-07-06","unknown",1, false),
(19,"Wynn","wy123","wynn@gmail.com","0864353356","Wynn Benjamin","https://cdn.pixabay.com/photo/2015/11/16/22/39/balloons-1046658_1280.jpg","2002-02-11","2015-07-06","unknown",1, false),
(20,"Benno","ben123","benno@gmail.com","0864444454","Benno Sendar","https://cdn.pixabay.com/photo/2015/03/30/20/33/heart-700141_1280.jpg","2002-02-11","2015-07-06","unknown",1, false),
(21,"Dakila","daki123","dakila@gmail.com","0864426978","Dakila Gugulethu","https://cdn.pixabay.com/photo/2015/04/19/08/32/rose-729509_1280.jpg","2002-02-11","2015-07-06","unknown",1, false),
(22,"Leah","lea123","leah@gmail.com","0496837583","Leah Miranda","https://cdn.pixabay.com/photo/2016/02/10/21/57/heart-1192662_1280.jpg","2002-02-11","2015-07-06","unknown",1, false);


INSERT INTO TBL_ADDRESS (addressID,addressName,ward,district,city,status,userID) VALUES
(1,"4 Lê Đại Hành","15","11","Ho Chi Minh",2,1),
(2,"F30 Đường số 2","Tân Thành","Tân Phú","Ho Chi Minh",1,2),
(3,"52 Thoại Ngọc Hầu","Hòa Thanh","Tân Phú","Ho Chi Minh",1,3),
(4,"80/15 Ba Vân","13","Tân Bình","Ho Chi Minh",1,4),
(5,"875 Cách Mạng Tháng 8","15","10","Ho Chi Minh",1,5),
(6,"571/16 Phạm văn Bạch","15","Gò Vấp","Ho Chi Minh",1,6),
(7,"ĐHT12","Đông Hưng Thuận","12","Ho Chi Minh",1,7),
(8,"12/237 Phạm Văn Chiêu","14","Gò Vấp","Ho Chi Minh",1,8),
(9,"141/276 Thống Nhất","16","Gò Vấp","Ho Chi Minh",1,9),
(10,"539/21/11 Lũy Bán Bích","Hoà Thanh","Tân Phú","Ho Chi Minh",1,10),
(11,"16/363 Kênh Tân Hóa","Phú Trung","Tân Phú","Ho Chi Minh",1,11),
(12,"421 Trần Văn Quang","10","Tân Bình","Ho Chi Minh",1,12),
(13,"12/730 Lạc Long Quân","9","Tân Bình","Ho Chi Minh",1,13),
(14,"127/3 Lê Thị Bạch Cát","13","11","Ho Chi Minh",1,14),
(15,"280/535A Ngô Gia Tự","4","10","Ho Chi Minh",1,15),
(16,"185/33 Đại lộ 3 tháng 2","11","10","Ho Chi Minh",1,16),
(17,"463B/54B Cách Mạng Tháng 8","13","10","Ho Chi Minh",1,17),
(18,"176 Đặng Văn Ngữ","14","Phú Nhuận","Ho Chi Minh",1,18),
(19,"18/2B Bùi Thị Xuân","3","Tân Bình","Ho Chi Minh",1,19),
(20,"19/2B Bùi Thị Xuân","3","Tân Bình","Ho Chi Minh",1,20),
(21,"34/2B Bùi Thị Xuân","3","Tân Bình","Ho Chi Minh",1,21),
(22,"23/2B Bùi Thị Xuân","3","Tân Bình","Ho Chi Minh",1,22);

INSERT INTO TBL_CARD(TYPE,CARDNUMBER,CARDHOLDER,EXPIRYMONTH,EXPIRYYEAR,STATUS,USERID) VALUES
("Credit",302948372985,"Draskon",4,2029,1,3);


INSERT INTO TBL_COUPON (NAME, EFFECT, MAXEFFECTVALUE,COUPONCODE,STATUS, USERID) VALUES 
("SUMMER DEAL","%15", 200000,"SUMMER2023",0,1),
("SUMMER DEAL","%15", 200000,"SUMMER2023",0,2),
("SUMMER DEAL","%15", 200000,"SUMMER2023",0,3),
("SUMMER DEAL","%15", 200000,"SUMMER2023",0,4);

INSERT INTO TBL_BRAND (BRANDID,BRANDNAME,STATUS) VALUES
(1,"Dell",1), 
(2,"Lenovo",1),
(3,"Apple",1), 
(4,"ASUS",1), 
(5,"Acer",1), 
(6,"HP",1), 
(7,"MSI",1), 
(8,"Gigabyte",1), 
(9,"Chuwi",1), 
(10,"LG",1),
(11,"Microsoft",1);

INSERT INTO TBL_SCREEN (SCREENID,RESOLUTION, SCREENSIZE,STATUS) VALUES
(1,"2560 x 1440 pixels","15.6 inch", true), 
(2,"1920 x 1080 pixels","15.6 inch", true), 
(3,"1920 x 1080 pixels","14.0 inch",true),
(4,"1920 x 1080 pixels","13.3 inch", true),
(5,"3024 x 1964 pixels","14.2 inch", true),
(6,"2560 x 1600 pixels","16 inch", true),
(7,"1920 x 1200 pixels","16 inch", true),
(8,"2560 x 1600 pixels","13.3 inch", true),
(9,"2560 x 1644 pixels","13.6 inch", true),
(10,"2880 x 1800 pixels","13.3 inch", true),
(11,"2880 x 1800 pixels","14 inch", true),
(12,"1536 x 1024 pixels","12.4 inch", true),
(13,"2880 x 1920 pixels","13 inch", true),
(14,"3840 x 2400 pixels","16 inch", true),
(15,"1920 x 1200 pixels","17.3 inch", true),
(16,"2160 x 1440 pixels","13 inch", true),
(17,"1200 x 1920 pixels","14 inch", true);

INSERT INTO TBL_OPERATINGSYSTEM (OS,VERSION,TYPE,STATUS) VALUES 
("Windows","Window 11 Home","64 bit",true),
("Windows","Window 11 Pro","64 bit",true),
("Windows","Window 11 Home Single Language","64 bit",true),
("Windows","Window 10 Home","64 bit",true),
("MacOS","MacOS Ventura","none",true),
("MacOS","MacOS 12","none",true);

INSERT INTO TBL_PROCESSOR (PROCESSORID,NAME, CPU_SPEED,CORES,LOGICALPROCESSORS,CACHEMEMORY,STATUS) VALUES
(1,"Intel Core i5 12500H",2.50,12,16,18, true), 
(2,"Intel Core i5 1235U",1.30,10,12,12, true), 
(3,"AMD Ryzen 5",2.10,6,12,8, true), 
(4,"Intel Core i5 1155G7",2.50,4,8,8, true), 
(5,"AMD Ryzen 7 7730U",2.00,6,12,16, true), 
(6,"Intel Core i5 12450H",3.30,8,12,12, true), 
(7,"AMD Ryzen 7 5800H",3.20,8,16,16, true), 
(8,"Intel Core i5 11400H",2.70,6,12,12, true), 
(9,"Intel Core i5 1135G7",2.40,4,8,8, true), 
(10,"Intel Core i5 12500H",3.30,12,16,18, true), 
(11,"Intel Celeron N4120",1.10,4,4,4, true), 
(12,"AMD Ryzen 7 4800H",2.40,8,16,12, true), 
(13,"Apple M2 Pro 12-Core",-1,12,-1,-1, true), 
(14,"Intel Core i7 1360P",1.90,12,16,18, true), 
(15,"Intel Core i7 13700H",2.40,14,20,24, true), 
(16,"Apple M2 8 - Core",2.40,-1,-1,-1, true), 
(17,"Intel Core i7 13620H",4.90,10,16,64, true), 
(18,"Intel Core i7 1255U",1.70,10,12,18, true), 
(19,"Apple M2 8 - Core",2.30,-1,-1,-1, true),
(20,"AMD Ryzen 7 5700U",4.30,8,16,12,true),
(21,"Intel Core i5 1230U",1.00,10,12,12,true),
(22,"AMD Ryzen 5 5600H",3.30,6,12,16,true),
(23,"Intel Core i5 1035G1",1.00,4,8,6,true),
(24,"Intel Core i7 1255U",3.50,10,12,12,true),
(25,"Apple M1 Pro",-1,10,16,-1,true),
(26,"AMD Ryzen 7 6800H",2.70,8,16,16, true),
(27,"Intel Core i5 13500H",3.50,12,16,18,true),
(28,"Intel Core i5 1155G7",2.50,4,8,8,true),
(29,"AMD Ryzen 9 5900HX",3.30,8,16,20,true),
(30,"Intel Core i7 1255U",1.70,10,12,12, true), 
(31,"Intel Core i5 13400",2.10,8,12,12, true), 
(32,"Intel Celeron J4125",2.00,4,4,4, true), 
(33,"Intel Core i3 1220P",1.50,10,12,12, true), 
(34,"Intel Core i5 11320H",3.20,4,8,8, true), 
(35,"AMD Ryzen 3 5300U",2.50,4,8,4,true),
(36,"Intel Core i3 1215U",1.20,6,8,10, true), 
(37,"Intel Core i7 1260U",2.10,12,16,18, true);

INSERT INTO TBL_MEMORY(MEMORYID,CURRENTRAM,TYPE,SPEED,MAXSLOTS,AVAILABLESLOTS,MAXRAM,STATUS) VALUES
(1,"16 GB","DDR5","4800 MHz",2,0,"32 GB", true),
(2,"8 GB","DDR4","3200 MHz",2,0,"32 GB", true),
(3,"16 GB","LPDDR4X","4266 MHz",0,0,"16 GB", true),
(4,"16 GB","DDR4","3200 MHz",1,0,"16 GB", true),
(5,"8 GB","DDR4","3200 MHz",1,1,"16 GB", true),
(6,"8 GB","DDR5","4800 MHz",2,1,"32 GB", true),
(7,"8 GB","DDR4","3200 MHz",2,1,"32 GB", true),
(8,"16 GB","DDR4","3200 MHz",2,0,"64 GB", true),
(9,"8 GB","DDR4","2400 MHz",1,0,"12 GB", true),
(10,"8 GB","LPDDR4","1600 MHz",0,0,"None", true), 
(11,"16 GB","Hidden","Hidden",0,0,"16 GB", true), 
(12,"16 GB","DDR5","6000 MHz",0,0,"None", true),
(13,"16 GB","DDR5","5200 MHz",0,0,"None", true),
(14,"8 GB","LPDDR4","3200 MHz",0,0,"16 GB", true),
(15,"8 GB","DDR5","5200 MHz",2,1,"64 GB", true),
(16,"8 GB","LPDDR4","3200 MHz",0,0,"8 GB", true),
(17,"8 GB","DDR4","3200 MHz",0,0,"None", true),
(18,"8 GB","LPDDR4X","4266 MHz",0,0,"8 GB", true),
(19,"8 GB","LPDDR4X","4267 MHz",0,0,"8 GB", true),
(20,"8 GB","LPDDR4X","3733 MHz",0,0,"None", true),
(21,"16 GB","DDR5","4800 MHz",0,0,"None", true),
(22,"16 GB","Hidden","Hidden",0,0,"32 GB", true),
(23,"8 GB","DDR5","4800 MHz",2,1,"64 GB", true),
(24,"16 GB","LPDDR5","6400 MHz",0,0,"16 GB", true),
(25,"8 GB","DDR4","3200 MHz",2,1,"64 GB", true),
(26,"16 GB","DDR4","3200 MHz",0,0,"16 GB", true),
(27,"16 GB","DDR4","3200 MHz",2,1,"32 GB", true),
(28,"8 GB","DDR4","3200 MHz",1,1,"40 GB", true),
(29,"8 GB","DDR5","5200 MHz",2,1,"16 GB", true),
(30,"8 GB","Hidden","Hidden",0,0,"8 GB", true),
(31,"8 GB","LPDDR5","5200 MHz",0,0,"None", true),
(32,"16 GB","LPDDR4X","4266 MHz",0,0,"None", true),
(33,"8 GB","DDR4","3200 MHz",1,0,"32 GB", true),
(34,"8 GB","DDR4","2666 MHz",2,1,"16 GB", true);




INSERT INTO TBL_STORAGE(STORAGEID,TYPE,MAXSLOTS,AVAILABLESLOTS,CURRENTSTORAGE,STATUS) VALUES
(1,"1 SSD",2,1,"512 GB",true),
(2,"1 SSD",1,0,"512 GB",true),
(3,"1 SSD",1,0,"1 TB",true),
(4,"1 SSD",1,0,"256 GB",true),
(5,"1 SSD",1,0,"128 GB",true),
(6,"1 SSD",2,1,"256 GB",true);

INSERT INTO TBL_PRODUCT(PRODUCTID,PRODUCTNAME,PRODUCTPRICE,PRODUCTQUANTITY,RELEASEDDATE,TOTALRATING,MODELCODE,ONSALE,CURRENTPRICE,MANUFACTURER,WARRANTY,SOLD,LENGTH,WIDTH,HEIGHT,WEIGHT,STATUS,BRANDID,SCREENID,OPERATINGSYSTEMID,PROCESSORID,MEMORYID,STORAGEID) VALUES
(1,'Lenovo Gaming Legion 5 15IAH7H i5 12500H/16G/512G/15.6"2K/GeForce RTX 3060 6GB/Win11',42990000,20,"2022", 3.7,"15IAH7H ","%10", 42990000*0.9,"China",36,3,358.5,262.35,19.99,2.35,true,2,1,1,1,1,1),
(2,'HP 15s-fq5163TU i5 1235U/8GB/256GB/15.6"FHD/Win11',17690000,20,"2022", 3,"7C135PA","%10", 17690000*0.9,"China",12,1,358.5,242,17.9,1.69,true,6,2,1,2,2,2),
(3,'Acer Swift 3 SF314-43-R4X3 R5 5500U/16GB/512GB SSD/Win11',20990000,12,"2021", 3.5,"NX.AB1SV.004","%15", 20990000*0.85,"China",12,2,322.8,212.2,15.9,1.19,true,5,3,3,3,3,2),
(4,'Lenovo IdeaPad 3 15ITL6 i5 1155G7/16GB/512GB/15.6"FHD/Win11',15290000,12,"2023", 3.9,"82H803RWVN","", 15290000,"China",24,2,359.2,236.5,19.9,1.65,true,2,2,3,4,4,2),
(5,'Asus Vivobook A1503ZA-L1139W i5 12500H/8GB/512GB/15.6"FHD/Win 11',21490000,4,"2022", 4,"90NB0WY2-M005R0","%10", 21490000*0.9,"China",24,1,356.8,227.6,19.9,1.7,true,4,2,1,1,5,1),
(6,'MSI Modern 15 B7M-098VN R7 7730U/8GB/512GB/15.6"FHD/Win 11',16490000,10,"2023", 3.3,"098VN","%10", 16490000*0.9,"China",24,3,359,241,19.9,1.75,true,7,2,1,5,6,1),

(7,'Asus TUF Gaming FX517ZC-HN077W i5 12450H/8GB/512GB/15.6"FHD/GeForce RTX 3050 4GB/Win 11',23990000,5,"2022", 3.7,"90NR09L3-M00510","%15", 23990000*0.85,"China",24,2,354,251,19.9,2,true,4,2,1,6,6,1),
(8,'Acer Nitro Gaming AN515-45-R86D R7 5800H/8GB/512GB/15.6"FHD/GeForce RTX 3060 6GB/Win 11',32490000,4,"2021", 4,"NH.QBCSV.005","", 32490000,"China",12,1,363.4,255,23.9,2.2,true,5,2,1,7,7,1),
(9,'Gigabyte Gaming G5 GD-51VN123SO i5 11400H/16GB/512GB/15.6" FHD/GeForce RTX 3050 4GB/Win 11',18490000,7,"2021", 3.3,"G5 GD-51VN123SO","", 18490000,"China",24,1,361,258,24.9,2.2,true,8,2,1,8,8,1),
(10,'Acer Aspire 3 A315-58-54M5 i5 1135G7/8GB/512GB/15.6"FHD/Win 11',14490000,10,"2021", 3.6,"NX.ADDSV.00M","", 14490000,"China",12,1,363.4,247.5,19.9,1.7,true,5,2,1,9,9,1),
(11,'Acer Nitro 5 Tiger Gaming AN515-58-52SP i5 12500H/8GB/512GB SSD/GeForce RTX 3050 4GB/Win11',27990000,12,"2022", 3.5,"NH.QFHSV.001","", 27990000,"China",12,2,360.4,271.09,25.9,2.5,true,5,2,1,10,7,1),
(12,'CHUWI LarkBook Celeron N4120/8GB/256GB/13.3"IPS/Win 10',9190000,4,"2021", 3.4,"CHUWI LarkBook","", 9190000,"China",12,2,363,248,19.9,1.5,true,9,4,4,11,10,2),

(13,'Asus Gaming ROG G513IC-HN729W R7 4800H/8GB/512GB/15.6" FHD/GeForce RTX 3050 4GB/Win11',25590000,4,"2022", 3.9,"G513IC-HN729W","", 25590000,"China",24,1,354,259,20.6,2.1,true,4,2,1,12,7,1),
(14,"MacBook Pro 14 inch M2 Pro 2023 12CPU 19GPU 16GB/1TB",65990000,7,"2023", 4.1,"MPHJ3SA/A","", 65990000,"China",12,5,312.6,221.2,15.5,1.6,true,3,5,5,13,11,3),
(15,'LG Gram 16Z90R-G.AH76A5 i7 1360P/16GB/512GB/16"WQXGA+/Win11',46990000,4,"2023", 3.4,"16Z90R-G.AH76A5","", 46990000,"China",12,3,355.1,241.3,15.9,2,true,10,6,1,14,12,2),
(16,'MSI Creator M16 B13VE-830VN i7 13700H/16GB/512GB SSD/16"FHD/RTX4050 8GB/Win 11',39990000,12,"2022", 4.3,"830VN","", 39990000,"China",24,1,359,259,23.95,2.26,true,7,7,1,15,13,1),
(17,"MacBook Pro 13 inch M2 2022 8CPU 10GPU 16GB/256GB ",37990000,6,"2022", 3.6,"Z16R","", 37990000,"China",12,2,304.1,212.4,15.6,1.4,true,3,8,6,16,14,4),
(18,'MSI Gaming Katana 15 B13VEK-252VN i7 13620H/8GB/512GB/15.6"FHD/GeForce RTX 4050 6GB/Win11',32990000,12,"2022", 4,"Katana 15 B13VEK-252VN","", 32990000,"China",24,1,359,259,24.9,2.29,true,7,2,1,17,15,1),

(19,'Dell Inspiron 16 N5620 i7 1255U/16GB/512GB/16.0"FHD+/GeForce MX570 2GB/Win11/Office HS21',29490000,5,"2022", 4.1,"N6I7004W1","", 29490000,"China",12,3,355.7,251.9,17.95,1.87,true,1,7,3,18,2,2),
(20,"MacBook Air 13 inch M2 2022 8CPU 8GPU 8GB/256GB",29990000,12,"2022", 4,"MLXW3SA/A","", 29990000,"China",12,2,304.1,215,11.3,1.24,true,3,9,5,19,16,4),

(21,'Asus Vivobook M513UA-EJ704W R7 5700U/8GB/512GB SSD/15.6" FHD/Win11', 17490000,14,"2022",4,"M513UA-EJ704W","%10", 17490000*0.9,"China", 24, 1, 359.8, 235.3, 18.6, 1.8, true,4,2,1,20, 17,2),
(22,'HP Envy x360 13-bf0113TU i5 1230U/8GB/512GB/13.3"2.8K Touch/Win11', 28790000,12,"2022",4.2,"7C0V8PA","%20", 28790000*0.8,"China", 12, 2	, 298.3, 214.9, 1.61, 1.34, true,6,10,3,21, 18,2),
(23,'Asus Zenbook UM5401QA-KN209W R5 5600H/8GB/512GB SSD/14" OLED 2.8K Touch/Win11', 19990000,21,"2022",3.8,"90NB0UR2-M009R0","%10", 19990000*0.9,"China", 24, 3, 330, 221.7, 15.9, 1.4, true,4,11,1,2, 19,2),
(24,'Microsoft Surface Laptop Go i5 1035G1/8GB/128GB/12.4" Touch/Win10', 18990000,12,"2020",3,"Hidden","%10", 18990000*0.9,"China", 12, 1, 278.18, 205.67, 15.69, 1.1, true,11,12,4,23, 20,5),
(25,'Microsoft Surface Pro 9 i7 1255U/16GB/256GB/13" Touchscreen/Win11', 45990000,12,"2022",3.5,"QIL-00030","", 45990000,"China", 12, 1, 287, 209, 9.3, 0.879, true,11,13,1,24, 21,4),

(26,'MacBook Pro 14 inch M1 Pro 2021 10CPU 16GPU 16GB/1TB', 60000000,12,"2021",3.4,"MKGQ3SA/A","%20", 60000000*0.8,"China", 12, 2, 312.6, 221.2, 15.5, 1.604, true,3,5,6,25, 22,3),
(27,'Gigabyte Gaming Aorus 15 9MF-E2VN583SH i5 12500H/8GB/512GB/15.6"FHD/Nvidia RTX 4050 6GB/Win11', 30500000,12,"2023",3,"9MF-E2VN583SH","%10", 30500000*0.9,"China", 24, 2, 360, 272, 20.9, 2.25, true,8,2,1,1, 23,1),
(28,'Acer Swift Edge SFA16-41-R3L6 R7 6800U/16GB/1TB/16" WQUXGA/Win11', 40000000,12,"2022",4,"NX.KABSV.002","", 40000000,"China", 12, 1, 356.7, 242.3, 13.95, 1.1, true,5,16,1,26, 24,3),
(29,'Acer Nitro 17 Gaming AN17-51-50B9 i5 13500H/8GB/512GB/17.3"FHD/RTX 4050 6GB/Win11', 35500000,12,"2023",3,"NH.QK5SV.001","", 35500000,"China", 12, 2, 400.2, 293.25, 28.9, 3, true,5,15,1,27, 6,1),
(30,'MSI Modern 15 A11MU-1022VN i5 1155G7/8GB/512GB/15.6"FHD/Win 11', 14000000,12,"2022",4.5,"1022VN","", 14000000,"China", 12, 1, 256.9, 233.7, 16.9, 1.6, true,7,2,3,28, 25,1),

(31,'Asus Vivobook M3500QC-L1516W R9 5900HX/16GB/512GB/RTX3050 4GB/15.6" OLED/Win11', 30000000,12,"2022",3.3,"90NB0UT1-M00F30","", 30000000,"China", 24, 1, 359.8, 235.3, 19.0, 1.65, true,4,2,1,29, 26,2),
(32,'HP ProBook 440 G9 i7 1255U/16GB/512GB/14"FHD/Win11', 27000000,12,"2022",0,"6M0X8PA","", 27000000,"China", 12, 0, 321.9, 213.9, 19.9, 1.38, true,6,3,3,30, 27,2),
(33,'Lenovo ThinkBook 15 G2 ITL i5 1135G7/8GB/512GB/15.6”FHD/GeForce MX450 2GB/Win 11', 20000000,12,"2021",0,"20VE00UTVN","", 20000000,"China", 24, 0, 357, 235, 19, 1.7, true,2,2,1,9, 28,2),
(34,'Lenovo Gaming LOQ 15IRH8 i5-13420H/8GB/512GB/15.6"FHD/RTX4050 6GB/Win11', 31000000,12,"2023",3.4,"82XV000PVN","", 31000000,"China", 24, 1, 359.6, 264.8, 25.2, 2.4, true,2,2,3,31, 29,4),

(35,'CHUWI GemiBook Celeron J4125/8GB/256GB/13''IPS/Win 10', 8000000,12,"2022",3.7,"GemiBook Celeron J4125","", 8000000,"China", 12, 1, 289, 219, 17.75, 1.34, true,9,16,4,32, 30,4),
(36,'LG Gram 14Z90Q-G.AJ32A5 i3 1220P/8GB/256GB/14"WUXGA/Win 11', 17000000,12,"2022",3.8,"14Z90Q-G.AJ32A5","", 17000000,"China", 12, 1, 312, 213.9, 16.8, 0.999, true,10,17,1,33, 31,6),
(37,'Lenovo Yoga Slim 7 Pro 14IHU5 O i5 11320H/16GB/512GB/14.0"2.8K/Win11', 20000000,12,"2022",4.2,"82NH00BEVN","", 20000000,"China", 36, 1, 312.4, 221.4, 14.9, 1.38, true,2,11,3,34, 32,2),
(38,'Lenovo ThinkBook 14 G3 ACL R3 5300U/8GB/512GB/14''FHD/Win 11', 9500000,12,"2023",4.2,"21A200RVVN","", 9500000,"China", 24, 1, 323, 218, 17.9, 1.4, true,2,3,3,35, 33,1),
(39,'Dell Inspiron 15 N3520 i5 1235U/8GB/256GB/15.6"FHD/Win 11/Office HS21_Black', 18500000,12,"2022",3.4,"N5I5122W1-Black","", 18500000,"China",12, 4, 235, 358, 18.9, 1.9, true,1,2,3,2, 34,6),

(40,'Dell Vostro 15 V3520 i3 1215U/8GB/256GB/15.6"FHD/Win 11/Office HS21_Gray', 14200000,12,"2023",3,"V5I3614W1-Gray","", 14200000,"China", 12, 1, 358.50, 235.56, 18.99, 1.83, true,1,2,3,36, 34,6),
(41,'Asus Zenbook UX3402ZA-KM221W i7 1260P/16GB/512GB/14" OLED 2.8K/Win 11', 32000000,12,"2022",4,"90NB0WC1-M00FZ0","", 32000000,"China", 24, 1, 313.6, 220.6, 16.9, 1.39, true,4,1,3,37, 21,2);


INSERT INTO TBL_PRODUCTIMAGE(PRODUCTIMAGELINK,STATUS,PRODUCTID) VALUES
("https://i.imgur.com/d3kWTts.jpg",1,1),
("https://i.imgur.com/ibRo84N.jpg",2,1),
("https://i.imgur.com/lKxIfY9.jpg",2,1),
("https://i.imgur.com/tYNyper.png",1,2),
("https://i.imgur.com/3Xd5VWQ.png",2,2),
("https://i.imgur.com/1UUPxTn.png",2,2),
("https://i.imgur.com/GV8tGeb.png",1,3),
("https://i.imgur.com/h6BJ5OI.png",2,3),
("https://i.imgur.com/30XLy8y.png",2,3),
("https://i.imgur.com/AWtJwX8.png",1,4),
("https://i.imgur.com/QKE04py.png",2,4),
("https://i.imgur.com/LQdcpcx.png",2,4),
("https://i.imgur.com/rqe6ihX.png",1,5),
("https://i.imgur.com/CswHAQE.png",2,5),
("https://i.imgur.com/MW8JZzH.png",2,5),
("https://i.imgur.com/xaZNJQ4.png",1,6),
("https://i.imgur.com/8wcFvys.png",2,6),
("https://i.imgur.com/TcCkc54.png",2,6),
("https://i.imgur.com/4Zaa04X.png",1,7),
("https://i.imgur.com/wQnAiPp.png",2,7),
("https://i.imgur.com/xj1IGeV.png",2,7),
("https://i.imgur.com/C2TyekM.png",1,8),
("https://i.imgur.com/TvuWum5.png",2,8),
("https://i.imgur.com/2RfEqMu.png",2,8),
("https://i.imgur.com/lxpn4nI.png",1,9),
("https://i.imgur.com/gHbnFTC.png",2,9),
("https://i.imgur.com/bNOtDba.png",2,9),
("https://i.imgur.com/KKSI3RI.png",1,10),
("https://i.imgur.com/XPtX9tn.png",2,10),
("https://i.imgur.com/C8tu0Ud.png",2,10),
("https://i.imgur.com/fXoaUym.png",1,11),
("https://i.imgur.com/YoS8vl8.png",2,11),
("https://i.imgur.com/RUKe9Nk.png",2,11),
("https://i.imgur.com/Ki19H9y.png",1,12),
("https://i.imgur.com/VefjhIB.png",2,12),
("https://i.imgur.com/hl76BK5.png",2,12),
("https://i.imgur.com/P06jMEu.png",1,13),
("https://i.imgur.com/jkVPXOT.png",2,13),
("https://i.imgur.com/XSnNI8Z.png",2,13),
("https://i.imgur.com/waLSRl4.png",1,14),
("https://i.imgur.com/IEHcFK8.png",2,14),
("https://i.imgur.com/sNEVBZ5.png",2,14),
("https://i.imgur.com/bCfzFWv.png",1,15),
("https://i.imgur.com/91MupcF.png",2,15),
("https://i.imgur.com/8wzG2vv.png",2,15),
("https://i.imgur.com/TMHvwZc.png",1,16),
("https://i.imgur.com/qZE241q.png",2,16),
("https://i.imgur.com/JlvhvA0.png",2,16),
("https://i.imgur.com/flpdwYr.png",1,17),
("https://i.imgur.com/pmK04bi.png",2,17),
("https://i.imgur.com/YBF9jeD.png",2,17),
("https://i.imgur.com/5Vv8LLW.png",1,18),
("https://i.imgur.com/hbeuHLn.png",2,18),
("https://i.imgur.com/X0w7xJ1.png",2,18),
("https://i.imgur.com/EGrcGUz.png",1,19),
("https://i.imgur.com/0XdsxGf.png",2,19),
("https://i.imgur.com/O3TrKvm.png",2,19),
("https://i.imgur.com/rxXvemr.png",1,20),
("https://i.imgur.com/9DipOIi.png",2,20),
("https://i.imgur.com/rA72f0r.png",2,20),
("https://i.imgur.com/zg9SooB.png",1,21),
("https://i.imgur.com/A3vfBk1.png",2,21),
("https://i.imgur.com/SIJTWhN.png",2,21),
("https://i.imgur.com/NzFyW0W.png",1,22),
("https://i.imgur.com/ooDWuvh.png",2,22),
("https://i.imgur.com/V1ulpo0.png",2,22),
("https://i.imgur.com/8R0yKGS.png",1,23),
("https://i.imgur.com/HJawPrR.png",2,23),
("https://i.imgur.com/9z0Snme.png",1,24),
("https://i.imgur.com/g09JKrQ.png",2,24),
("https://i.imgur.com/0AWFC83.png",2,24),
("https://i.imgur.com/jkcFZtG.png",1,25),
("https://i.imgur.com/qj5Go1n.png",2,25),
("https://i.imgur.com/NPV4icS.png",2,25),
("https://i.imgur.com/20Wfqyk.png",1,26),
("https://i.imgur.com/Wg0fKNL.png",2,26),
("https://i.imgur.com/oz3PinX.png",2,26),
("https://i.imgur.com/PbircJ2.png",1,27),
("https://i.imgur.com/UxE2I4V.png",2,27),
("https://i.imgur.com/ou06PKs.png",2,27),
("https://i.imgur.com/BZZikS0.png",1,28),
("https://i.imgur.com/EVwxuvY.png",2,28),
("https://i.imgur.com/G6uVH6m.png",2,28),
("https://i.imgur.com/fK7zBHd.png",1,29),
("https://i.imgur.com/KjSrrwa.png",2,29),
("https://i.imgur.com/Wboi9ah.png",2,29),
("https://i.imgur.com/337ingx.png",1,30),
("https://i.imgur.com/l8jPGfe.png",2,30),
("https://i.imgur.com/LiObmUH.png",2,30),
("https://i.imgur.com/ZqoIvkW.png",1,31),
("https://i.imgur.com/3srQ35S.png",2,31),
("https://i.imgur.com/9BlVWgk.png",2,31),
("https://i.imgur.com/4iVVoOm.png",1,32),
("https://i.imgur.com/LeqzefJ.png",2,32),
("https://i.imgur.com/AyK2VTX.png",2,32),
("https://i.imgur.com/4ssRSAg.png",1,33),
("https://i.imgur.com/q0kwEit.png",2,33),
("https://i.imgur.com/TOzN08Y.png",2,33),
("https://i.imgur.com/9viIhLe.png",1,34),
("https://i.imgur.com/y1j9hcc.png",2,34),
("https://i.imgur.com/LNd4j5C.png",2,34),
("https://i.imgur.com/ipICat0.png",1,35),
("https://i.imgur.com/dZrVgyI.png",2,35),
("https://i.imgur.com/DXfseSX.png",2,35),
("https://i.imgur.com/sS1CvAE.png",1,36),
("https://i.imgur.com/I7fxgaW.png",2,36),
("https://i.imgur.com/famAsFZ.png",2,36),
("https://i.imgur.com/i6NIYjX.png",1,37),
("https://i.imgur.com/vezViJx.png",2,37),
("https://i.imgur.com/WFPSwf9.png",2,37),
("https://i.imgur.com/64EYWMg.png",1,38),
("https://i.imgur.com/WH8HCmL.png",2,38),
("https://i.imgur.com/94wwLHZ.png",2,38),
("https://i.imgur.com/qQG3cmm.png",1,39),
("https://i.imgur.com/u1l8gXS.png",2,39),
("https://i.imgur.com/hZ05f3g.png",2,39),
("https://i.imgur.com/LJ2PIc8.png",1,40),
("https://i.imgur.com/2kd9pGs.png",2,40),
("https://i.imgur.com/Uht6wjE.png",2,40),
("https://i.imgur.com/zl3mHF7.png",1,41),
("https://i.imgur.com/0XQYtTv.png",2,41),
("https://i.imgur.com/nptTybS.png",2,41);



INSERT INTO TBL_CART(ITEMQUANTITY,USERID,PRODUCTID) VALUES
(1,1,1),
(1,1,2),
(2,2,2),
(2,2,1),
(1,3,1);

INSERT INTO TBL_RATING (DATEADDED,RATING,COMMENT,STATUS, USERID, PRODUCTID) VALUES
("2023-07-30",3,"ok delivery",true, 1, 1),
("2023-02-12",4,"Awesome",true,12,1),
("2023-08-03",4.2,"Great aesthetic",true,19,1),
("2023-07-24",3,"Box was broken",true,4,2),
("2023-05-21",3.5,"Came at the wrong time",true,7,3),

("2023-04-09",4.1,"Lovely",true,6,3),
("2023-06-28",3.2,"Fine",true,13,4),
("2023-02-01",4.7,"Lovely",true,4,4),
("2023-07-23",4,"Lovely",true,2,5),
("2023-07-09",3.2,"Came too early",true,21,6),

("2023-08-12",3.5,"Didn't arrived as said",true,18,6),
("2023-07-15",3.3,"Didn't arrived as said",true,1,6),
("2023-04-03",3.1,"Didn't arrived as said",true,8,7),
("2023-07-23",4.3,"Didn't arrived as said",true,20,7),
("2023-03-22",4,"Didn't arrived as said",true,3,8),

("2023-07-23",3.3,"Late",true,11,9),
("2023-07-04",3.6,"Laptop was not good",true,1,10),
("2023-03-12",3.3,"Doesn't accept teared cash",true,3,11),
("2023-07-09",3.7,"Good",true,12,11),
("2023-03-12",3.3,"Everything in place",true,16,12),

("2023-08-30",3.4,"Good",true,14,12),
("2023-02-09",3.9,"Super",true,17,13),
("2023-07-20",4,"My friend love this",true,22,14),
("2023-04-01",4.5,"The cover look so cool",true,1,14),
("2023-03-05",4.1,"",true,3,14),

("2023-06-21",4,"",true,7,14),
("2023-02-05",4,"",true,9,14),
("2023-03-12",3,"",true,2,15),
("2023-04-01",3.2,"",true,6,15),
("2023-03-14",3,"",true,11,15),

("2023-02-05",4.3,"",true,5,16),
("2023-04-11",3.6,"",true,10,17),
("2023-06-01",3.7,"",true,13,17),
("2023-02-07",4,"",true,3,18),
("2023-06-11",3.2,"",true,6,19),

("2023-06-24",4.2,"",true,8,19),
("2023-06-11",5,"",true,22,19),
("2023-07-24",4,"",true,9,20),
("2023-06-11",4.1,"",true,10,20),
("2023-02-06",4,"",true,12,21),

("2023-03-25",4.2,"",true,11,22),
("2023-03-30",4.3,"",true,14,22),
("2023-03-17",3.3,"",true,17,23),
("2023-07-18",4.1,"",true,2,23),
("2023-06-07",4.2,"",true,16,23),

("2023-06-13",3,"",true,18,24),
("2023-06-12",3.5,"",true,3,25),
("2023-07-26",3.7,"",true,7,26),
("2023-04-19",3.2,"",true,11,26),
("2023-04-12",2,"",true,11,27),

("2023-03-08",4,"",true,9,27),
("2023-02-14",4,"",true,12,28),
("2023-08-14",3,"",true,1,29),
("2023-07-25",3,"",true,4,29),
("2023-06-12",4.5,"",true,7,30),

("2023-07-19",3.3,"",true,8,31),
("2023-06-27",3.4,"",true,12,34),
("2023-3-09",3.7,"",true,11,35),
("2023-07-26",3.8,"",true,3,36),
("2023-04-17",4.2,"",true,5,37),

("2023-05-16",4.2,"",true,6,38),
("2023-04-12",4.7,"",true,1,39),
("2023-02-11",4,"",true,21,39),
("2023-02-12",2.2,"",true,8,39),
("2023-03-25",3,"",true,20,39),

("2023-02-28",3,"",true,9,40),
("2023-02-14",4,"",true,17,41);



INSERT INTO TBL_RATINGIMAGE (IMAGELINK, STATUS, RATINGID) VALUES
("https://cdn.pixabay.com/photo/2023/03/17/02/42/architecture-7857832_1280.jpg",1,1),
("https://cdn.pixabay.com/photo/2023/06/11/08/52/waves-8055488_1280.jpg",2,1);

INSERT INTO TBL_FAVORITE (ISFAVORITE,USERID,PRODUCTID) VALUES
(true, 1,1),
(true, 3,2);

INSERT INTO TBL_USERORDER(USERORDERID,TOTALPRICE,ORIGINALPRICE,NOTE,STATUS,RECEIVER,SHIPPINGFEE,PENDINGDATE,PREPAREDATE,DELIVERYDATE,ARRIVEDDATE, ADDRESSID,USERID) VALUES
(1,38691000+200000,38691000,"",0,"Ben",200000,"2023-07-30",null,null,null,19,19),
(2,38691000+200000,38691000,"",4,"Affock",200000,"2023-02-12","2023-02-12","2023-02-12","2023-02-12",1,1),
(3,38691000+200000,38691000,"",4,"Utiora",200000,"2023-08-03","2023-08-03","2023-08-03","2023-08-03",12,12),
(4,15921000+200000,15921000,"",3,"Flow",200000,"2023-07-23","2023-07-23","2023-07-24",null,4,4),
(5,17841500+200000,17841500,"",4,"Mon",200000,"2023-05-21","2023-05-21","2023-05-21",null,7,7),

(6,17841500+200000,17841500,"",4,"Mob",200000,"2023-04-09","2023-04-09","2023-04-09","2023-04-09",6,6),
(7,15290000+200000,15290000,"",0,"Heretic",200000,"2023-06-28",null,null,null,13,13),
(8,15290000+200000,15290000,"",4,"Chaos",200000,"2023-02-01","2023-02-01","2023-02-01","2023-02-01",4,4),
(9,19341000+200000,19341000,"",2,"Legion",200000,"2023-07-01","2023-07-23",null,null,2,2),
(10,14841000+200000,14841000,"",1,"Valdoski",200000,"2023-07-09",null,null,null,21,21),

(11,14841000+200000,14841000,"",4,"Rakar",200000,"2023-08-12","2023-08-12","2023-08-12","2023-08-12",18,18),
(12,14841000+200000,14841000,"",0,"Vei",200000,"2023-07-15",null,null,null,1,1),
(13,20391500+200000,20391500,"",4,"Valora",200000,"2023-04-03","2023-04-03","2023-04-03","2023-04-03",8,8),
(14,20391500+200000,20391500,"",3,"Emina",200000,"2023-07-21","2023-07-23","2023-07-23",null,20,20),
(15,32490000+200000,32490000,"",4,"Mike",200000,"2023-03-22","2023-03-22","2023-03-22","2023-03-22",3,3),

(16,18490000+200000,18490000,"",2,"Geronimo",200000,"2023-07-04","2023-07-23",null,null,11,11),
(17,14490000+200000,14490000,"",0,"Fohric",200000,"2023-07-04",null,null,null,1,1),
(18,27990000+200000,27990000,"",4,"Ras",200000,"2023-03-12","2023-03-12","2023-03-12","2023-03-12",12,12),
(19,27990000+200000,27990000,"",0,"Rieo",200000,"2023-07-09",null,null,null,3,3),
(20,9190000+200000,9190000,"",4,"Qerti",200000,"2023-03-12","2023-03-12","2023-03-12","2023-03-12",14,14),

(21,9190000+200000,9190000,"",4,"Possum",200000,"2023-08-30","2023-08-30","2023-08-30","2023-08-30",16,16),
(22,25590000+200000,25590000,"",4,"Lion",200000,"2023-02-09","2023-02-09","2023-02-09","2023-02-09",17,17),
(23,65990000+200000,65990000,"",3,"Yric",200000,"2023-07-18","2023-07-20","2023-07-20",null,22,22),
(24,65990000+200000,65990000,"",0,"Qianta",200000,"2023-04-01",null,null,null,1,1),
(25,65990000+200000,65990000,"",4,"Roppon",200000,"2023-03-05","2023-03-05","2023-03-05","2023-03-05",3,3),

(26,65990000+200000,65990000,"",0,"Skyler Ranjeet",200000,"2023-06-21",null,null,null,7,7),
(27,65990000+200000,65990000,"",4,"Mekaisto Angélica",200000,"2023-02-05","2023-02-05","2023-02-05","2023-02-05",8,8),
(28,46990000+200000,46990000,"",0,"Notus Ethne",200000,"2023-03-12",null,null,null,2,2),
(29,46990000+200000,46990000,"",4,"Gastón Sabela",200000,"2023-04-01","2023-04-01","2023-04-01","2023-04-01",6,6),
(30,46990000+200000,46990000,"",4,"Anej Albina",200000,"2023-03-14","2023-03-14","2023-03-14","2023-03-14",11,11),

(31,39990000+200000,39990000,"",4,"Nicolaas Jana",200000,"2023-02-05","2023-02-05","2023-02-05","2023-02-05",5,5),
(32,37990000+200000,37990000,"",4,"Thamarai Athanasios",200000,"2023-04-11","2023-04-11","2023-04-11","2023-04-11",10,10),
(33,37990000+200000,37990000,"",0,"Apurva Marinela",200000,"2023-06-01",null,null,null,13,13),
(34,32990000+200000,32990000,"",4,"Dierk Syed",200000,"2023-02-07","2023-02-07","2023-02-07","2023-02-07",3,3),
(35,29490000+200000,29490000,"",4,"Ravi Michaela",200000,"2023-06-11","2023-06-11","2023-06-11","2023-06-11",6,6),

(36,29490000+200000,29490000,"",4,"Tam Nagi",200000,"2023-06-24","2023-06-24","2023-06-24","2023-06-24",8,8),
(37,29490000+200000,29490000,"",4,"Voestaa'e Hardy",200000,"2023-06-11","2023-06-11","2023-06-11","2023-06-11",22,22),
(38,29990000+200000,29990000,"",3,"Eha Akmal",200000,"2023-07-21","2023-07-24","2023-07-24",null,9,9),
(39,29990000+200000,29990000,"",4,"Sibyl Natálie",200000,"2023-06-11","2023-06-11","2023-06-11","2023-06-11",10,10),
(40,15741000+200000,15741000,"",4,"Batu Cecilio",200000,"2023-02-06","2023-02-06","2023-02-06","2023-02-06",12,12),

(41,23032000+200000,23032000,"",4,"Tafari Ljupcho",200000,"2023-03-25","2023-03-25","2023-03-25","2023-03-25",11,11),
(42,23032000+200000,23032000,"",0,"Trevon Ilya",200000,"2023-03-30",null,null,null,14,14),
(43,17991000+200000,17991000,"",4,"Fajr Erminia",200000,"2023-03-17","2023-03-17","2023-03-17","2023-03-17",16,16),
(44,17991000+200000,17991000,"",0,"Natan Anna",200000,"2023-07-18",null,null,null,2,2),
(45,17991000+200000,17991000,"",4,"Lazare Yitro",200000,"2023-06-07","2023-06-07","2023-06-07","2023-06-07",17,17),

(46,17091000+200000,17091000,"",0,"Františka Ursella",200000,"2023-06-13",null,null,null,18,18),
(47,45990000+200000,45990000,"",0,"Marwa Kenny",200000,"2023-06-12",null,null,null,3,3),
(48,48000000+200000,48000000,"",3,"Arshtat Mahihkan",200000,"2023-07-25","2023-07-26","2023-07-26",null,7,7),
(49,48000000+200000,48000000,"",4,"Maria Pia Felinus",200000,"2023-04-19","2023-04-19","2023-04-19","2023-04-19",11,11),
(50,27450000+200000,27450000,"",4,"Matheus Halvor",200000,"2023-04-12","2023-04-12","2023-04-12","2023-04-12",11,11),

(51,27450000+200000,27450000,"",0,"Anayeli Sitaram",200000,"2023-03-08",null,null,null,9,9),
(52,40000000+200000,40000000,"",4,"Marwa Kenny",200000,"2023-02-14","2023-02-14","2023-02-14","2023-02-14",12,12),
(53,35500000+200000,35500000,"",4,"Arshtat Mahihkan",200000,"2023-08-14","2023-08-14","2023-08-14","2023-08-14",1,1),
(54,35500000+200000,35500000,"",3,"Maria Pia Felinus",200000,"2023-07-04","2023-07-25","2023-07-25",null,4,4),
(55,14000000+200000,14000000,"",4,"Matheus Halvor",200000,"2023-06-12","2023-06-12","2023-06-12","2023-06-12",7,7),

(56,30000000+200000,30000000,"",3,"Anayeli Sitaram",200000,"2023-07-11","2023-07-19","2023-07-19",null,8,8),
(57,31000000+200000,31000000,"",4,"Corine Tadesse",200000,"2023-06-27","2023-06-27","2023-06-27","2023-06-27",12,12),
(58,8000000+200000,8000000,"",4,"Eyvǫr Yeshua",200000,"2023-3-09","2023-3-09","2023-3-09","2023-3-09",11,11),
(59,17000000+200000,17000000,"",3,"Lishan Philandros",200000,"2023-07-24","2023-07-26","2023-07-26",null,3,3),
(60,20000000+200000,20000000,"",4,"Modron Guðrún",200000,"2023-04-17","2023-04-17","2023-04-17","2023-04-17",5,5),

(61,9500000+200000,9500000,"",4,"Michel Volodymyr",200000,"2023-05-16","2023-05-16","2023-05-16",null,6,6),
(62,18500000+200000,18500000,"",4,"Apoorva Boyan",200000,"2023-04-12","2023-04-12","2023-04-12","2023-04-12",1,1),
(63,18500000+200000,18500000,"",0,"Darius Taqqiq",200000,"2023-02-11",null,null,null,21,21),
(64,18500000+200000,18500000,"",4,"Thore Patritsiya",200000,"2023-02-12","2023-02-12","2023-02-12","2023-02-12",8,8),
(65,18500000+200000,18500000,"",0,"Margarita Valeri",200000,"2023-03-25",null,null,null,20,20),

(66,14200000+200000,14200000,"",4,"Əhməd Yentl",200000,"2023-02-28","2023-02-28","2023-02-28","2023-02-28",9,9),
(67,32000000+200000,32000000,"",0,"Tahmasp Angelino",200000,"2023-02-14",null,null,null,17,17);

INSERT INTO TBL_ORDERDETAIL(PRODUCTQUANTITY, USERORDERID, PRODUCTID) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 2),
(1, 5, 3),
(1, 6, 3),

(1, 7, 13),
(1, 8, 4),
(1, 9, 2),
(1, 10, 21),
(1, 11, 18),
(1, 12, 1),

(1, 13, 8),
(1, 14, 20),
(1, 15, 3),
(1, 16, 11),
(1, 17, 1),

(1, 18, 12),
(1, 19, 3),
(1, 20, 14),
(1, 21, 16),

(1, 22, 17),
(1, 23, 22),
(1, 24, 1),
(1, 25, 3),
(1, 26, 7),
(1, 27, 9),

(1, 28, 2),
(1, 29, 6),
(1, 30, 11),

(1, 31, 5),
(1, 32, 10),
(1, 33, 13),

(1, 34, 3),
(1, 35, 6),
(1, 36, 8),
(1, 37, 22),
(1, 38, 9),
(1, 49, 10),

(1, 40, 12),
(1, 41, 11),
(1, 42, 14),

(1, 43, 16),
(1, 44, 2),
(1, 45, 17),
(1, 46, 18),
(1, 47, 3),

(1, 48, 7),
(1, 49, 11),
(1, 50, 11),
(1, 51, 9),

(1, 52, 12),
(1, 53, 1),
(1, 54, 4),
(1, 55, 7),

(1, 56, 8),
(1, 57, 12),
(1, 58, 11),
(1, 59, 3),
(1, 60, 5),

(1, 61, 6),
(1, 62, 1),
(1, 63, 21),
(1, 64, 8),
(1, 65, 20),
(1, 66, 9),
(1, 67, 17);