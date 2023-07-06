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
CREATE TABLE TBL_USERORDER (
	userOrderID INTEGER PRIMARY KEY AUTO_INCREMENT,
	totalPrice BIGINT NOT NULL,
	originalPrice BIGINT NOT NULL,
	note VARCHAR(255) NOT NULL,
	status INTEGER NOT NULL,
	receiver VARCHAR(255) NOT NULL,
	paymentType VARCHAR(255) NOT NULL,
	shippingFee INT NOT NULL,
	pendingDate VARCHAR(12) NOT NULL,
	prepareDate VARCHAR(12) NOT NULL,
	deliveryDate VARCHAR(12) NOT NULL,
	arrivedDate VARCHAR(12) NOT NULL,
	addressID INTEGER NOT NULL,
	userID INTEGER NOT NULL,
	couponID INTEGER NOT NULL
);
ALTER TABLE TBL_USERORDER ADD CONSTRAINT FK_USERORDER FOREIGN KEY (userID) REFERENCES TBL_USER(userID);
ALTER TABLE TBL_USERORDER ADD CONSTRAINT FK_ORDERCOUPON FOREIGN KEY (couponID) REFERENCES TBL_COUPON(couponID);
ALTER TABLE TBL_USERORDER ADD CONSTRAINT FK_ORDERADDRESS FOREIGN KEY (addressID) REFERENCES TBL_ADDRESS(addressID);


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
	currentStorage INTEGER NOT NULL,
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
	length FLOAT NOT NULL,
	width FLOAT NOT NULL,
	height FLOAT NOT NULL,
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
    status INT NOT NULL,
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
CREATE TABLE TBL_RATINGANDFAVORITE(
	ratingandfavoriteID INT PRIMARY KEY AUTO_INCREMENT,
	dateAdded VARCHAR(12) NOT NULL,
	isFavorite BIT NOT NULL,
	rating INT NOT NULL,
	comment VARCHAR(255) NOT NULL,
	userID INT NOT NULL,
	productID INT NOT NULL
);
ALTER TABLE TBL_RATINGANDFAVORITE ADD CONSTRAINT FK_FAVORITE_PRODUCT FOREIGN KEY (productID) REFERENCES TBL_PRODUCT(productID);
ALTER TABLE TBL_RATINGANDFAVORITE ADD CONSTRAINT FK_FAVORITE_USER FOREIGN KEY (userID) REFERENCES TBL_USER(userID);
CREATE TABLE TBL_RATINGIMAGE(
	ratingImageID INT PRIMARY KEY AUTO_INCREMENT,
	link VARCHAR(255) NOT NULL,
    status INTEGER NOT NULL,
	ratingandfavoriteID INT NOT NULL
);
ALTER TABLE TBL_RATINGIMAGE ADD CONSTRAINT FK_RATINGANDFAVORITE_IMAGE FOREIGN KEY (ratingandfavoriteID) REFERENCES TBL_RATINGANDFAVORITE(ratingandfavoriteID);

CREATE TABLE TBL_ORDERDETAIL(
	orderDetailID INT PRIMARY KEY AUTO_INCREMENT,
	productQuantity INT NOT NULL,
	userOrderID INT NOT NULL, 
	productID INT NOT NULL
);
ALTER TABLE TBL_ORDERDETAIL ADD CONSTRAINT FK_ORDERDETAIL_PRODUCT FOREIGN KEY (productID) REFERENCES TBL_PRODUCT(productID);
ALTER TABLE TBL_ORDERDETAIL ADD CONSTRAINT FK_ORDERDETAIL_USERORDER FOREIGN KEY (userOrderID) REFERENCES TBL_USERORDER(userOrderID);


INSERT INTO TBL_USER (username, userPassword, email, phoneNumber, fullName, imageLink, birthday, createDate, gender, accountStatus, isAdmin) VALUES ("Geronimo","gen123","geronimo@gmail.com","0976854567", "Geronimo Raju", "https://cdn.pixabay.com/photo/2023/05/28/00/34/sunset-8022573_1280.jpg", "1989-06-20", "2023-07-03", "female", "1", false);

INSERT INTO TBL_USER (username, userPassword, email, phoneNumber, fullName, imageLink, birthday, createDate, gender, accountStatus, isAdmin) VALUES ("Debauchery","dechery","debauchery@gmail.com","0976852412", "Debauchery Desmond", "https://cdn.pixabay.com/photo/2023/05/28/00/34/sunset-8022573_1280.jpg", "1989-03-02", "2023-07-03", "male", "1", false);

INSERT INTO TBL_USER (username, userPassword, email, phoneNumber, fullName, imageLink, birthday, createDate, gender, accountStatus, isAdmin) VALUES ("Drask","dra123","drask@gmail.com","0976852222", "Drask Cromon", "https://cdn.pixabay.com/photo/2023/05/28/00/34/sunset-8022573_1280.jpg", "1988-12-31", "2023-07-03", "male", "1", false);

INSERT INTO TBL_USER (username, userPassword, email, phoneNumber, fullName, imageLink, birthday, createDate, gender, accountStatus, isAdmin) VALUES ("Gishmo","gis123","gismo@gmail.com","0975468743", "Gishmo Califau", "https://cdn.pixabay.com/photo/2023/05/28/00/34/sunset-8022573_1280.jpg", "1988-01-01", "2023-07-03", "femai", "1", false);


INSERT INTO TBL_ADDRESS (addressName,ward,district,city,status,userID) VALUES("4 Lê Đại Hành","15","11","Ho Chi Minh",2,1);
INSERT INTO TBL_ADDRESS (addressName,ward,district,city,status,userID) VALUES("F30 Đường số 2","Tân Thành","Tân Phú","Ho Chi Minh",1,1);
INSERT INTO TBL_ADDRESS (addressName,ward,district,city,status,userID) VALUES("52 Thoại Ngọc Hầu","Hòa Thanh","Tân Phú","Ho Chi Minh",1,2);
INSERT INTO TBL_ADDRESS (addressName,ward,district,city,status,userID) VALUES("80/15 Ba Vân","13","Tân Bình","Ho Chi Minh",1,3);
INSERT INTO TBL_ADDRESS (addressName,ward,district,city,status,userID) VALUES("875 Cách Mạng Tháng 8","15","10","Ho Chi Minh",1,4);


INSERT INTO TBL_COUPON (NAME, EFFECT, MAXEFFECTVALUE,COUPONCODE,STATUS, USERID) VALUES ("SUMMER DEAL","%15", 200000,"SUMMER2023",0,1);
INSERT INTO TBL_COUPON (NAME, EFFECT, MAXEFFECTVALUE,COUPONCODE,STATUS, USERID) VALUES ("SUMMER DEAL","%15", 200000,"SUMMER2023",0,2);
INSERT INTO TBL_COUPON (NAME, EFFECT, MAXEFFECTVALUE,COUPONCODE,STATUS, USERID) VALUES ("SUMMER DEAL","%15", 200000,"SUMMER2023",0,3);
INSERT INTO TBL_COUPON (NAME, EFFECT, MAXEFFECTVALUE,COUPONCODE,STATUS, USERID) VALUES ("SUMMER DEAL","%15", 200000,"SUMMER2023",0,4);

INSERT INTO TBL_BRAND (BRANDNAME,STATUS) VALUES("Dell",1),("Lenovo",1),("Apple",1),("ASUS",1);

INSERT INTO TBL_SCREEN (RESOLUTION, SCREENSIZE,LENGTH,WIDTH,HEIGHT,STATUS) VALUES("2560 x 1440 pixels","15.6 inch",358.5,262.35,19.99, true),("1920 x 1080 pixels","15.6 inch",358.5,242,17.9, true);



INSERT INTO TBL_OPERATINGSYSTEM (OS,VERSION,TYPE,STATUS) VALUES ("Windows","Window 11 Home","64 bit",true),("Windows","Window 11 Pro","64 bit",true);

INSERT INTO TBL_PROCESSOR (NAME, CPU_SPEED,CORES,LOGICALPROCESSORS,CACHEMEMORY,STATUS) VALUES("Intel Core i5 12500H",2.50,12,16,18, true),("Intel Core i5 1235U",1.30,6,10,12, true);

INSERT INTO TBL_MEMORY(CURRENTRAM,TYPE,SPEED,MAXSLOTS,AVAILABLESLOTS,MAXRAM,STATUS) VALUES("16 GB","DDR5","4800 MHz",2,0,"32 GB", true),("8 GB","DDR4","3200 MHz",2,0,"32 GB", true);

INSERT INTO TBL_STORAGE(TYPE,MAXSLOTS,AVAILABLESLOTS,CURRENTSTORAGE,STATUS) VALUES("SSD",2,1,512,true),("SSD",1,0,512,true);

INSERT INTO TBL_PRODUCT(PRODUCTNAME,PRODUCTPRICE,PRODUCTQUANTITY,RELEASEDDATE,TOTALRATING,MODELCODE,ONSALE,CURRENTPRICE,MANUFACTURER,WARRANTY,SOLD,STATUS,BRANDID,SCREENID,OPERATINGSYSTEMID,PROCESSORID,MEMORYID,STORAGEID) VALUES("Lenovo Gaming Legion 5",42990000,20,"2022", 4,"82RB0048VN","%10", 42990000*0.9,"China",36,2,1,1,1,1,1,1,1),("HP 15s-fq5163TU",17690000,20,"2022", 2,"7C135PA","%10", 17690000*0.9,"China",12,2,1,2,2,2,2,2,2);

INSERT INTO TBL_PRODUCTIMAGE(PRODUCTIMAGELINK,STATUS,PRODUCTID) VALUES
("https://cdn.pixabay.com/photo/2016/03/26/13/09/workspace-1280538_1280.jpg",1,1),
("https://cdn.pixabay.com/photo/2017/08/30/01/05/milky-way-2695569_1280.jpg",2,1),
("https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849825_1280.jpg",2,1),
("https://cdn.pixabay.com/photo/2015/02/02/11/09/office-620822_1280.jpg",1,2),
("https://cdn.pixabay.com/photo/2015/01/08/18/25/desk-593327_1280.jpg",2,2),
("https://cdn.pixabay.com/photo/2016/03/26/13/09/cup-of-coffee-1280537_1280.jpg",2,2);

INSERT INTO TBL_CART(ITEMQUANTITY,USERID,PRODUCTID) VALUES
(1,1,1),
(1,1,2),
(2,2,2),
(2,2,1);