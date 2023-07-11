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
CREATE TABLE TBL_USERORDER (
	userOrderID INTEGER PRIMARY KEY AUTO_INCREMENT,
	totalPrice BIGINT NOT NULL,
	originalPrice BIGINT NOT NULL,
	note VARCHAR(255) NOT NULL,
	status INTEGER NOT NULL,
	receiver VARCHAR(255) NOT NULL,
	paymentType VARCHAR(255) NOT NULL,
	shippingFee INT NOT NULL,
	pendingDate VARCHAR(12),
	prepareDate VARCHAR(12),
	deliveryDate VARCHAR(12),
	arrivedDate VARCHAR(12),
	addressID INTEGER NOT NULL,
	userID INTEGER NOT NULL,
	couponID INTEGER
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

INSERT INTO TBL_BRAND (BRANDNAME,STATUS) VALUES
("Dell",1), 
("Lenovo",1),
("Apple",1), 
("ASUS",1), 
("Acer",1), 
("HP",1), 
("MSI",1), 
("Gigabyte",1), 
("Chuwi",1), 
("LG",1); 

INSERT INTO TBL_SCREEN (RESOLUTION, SCREENSIZE,STATUS) VALUES
("2560 x 1440 pixels","15.6 inch", true), 
("1920 x 1080 pixels","15.6 inch", true), 
("1920 x 1080 pixels","14.0 inch",true),
("1920 x 1080 pixels","13.3 inch", true),
("3024 x 1964 pixels","14.2 inch", true),
("2560 x 1600 pixels","16 inch", true),
("1920 x 1200 pixels","16 inch", true),
("2560 x 1600 pixels","13.3 inch", true),
("2560 x 1644 pixels","13.6 inch", true);

INSERT INTO TBL_OPERATINGSYSTEM (OS,VERSION,TYPE,STATUS) VALUES 
("Windows","Window 11 Home","64 bit",true),
("Windows","Window 11 Pro","64 bit",true),
("Windows","Window 11 Home Single Language","64 bit",true),
("Windows","Window 10 Home","64 bit",true),
("MacOS","MacOS Ventura","none",true),
("MacOS","MacOS 12","none",true);

INSERT INTO TBL_PROCESSOR (NAME, CPU_SPEED,CORES,LOGICALPROCESSORS,CACHEMEMORY,STATUS) VALUES
("Intel Core i5 12500H",2.50,12,16,18, true), 
("Intel Core i5 1235U",1.30,10,12,12, true), 
("AMD Ryzen 5",2.10,6,12,8, true), 
("Intel Core i5 1155G7",2.50,4,8,8, true), 
("AMD Ryzen 7",2.00,6,12,16, true), 
("Intel Core i5 12450H",3.30,8,12,12, true), 
("AMD Ryzen 7 5800H",3.20,8,16,16, true), 
("Intel Core i5 11400H",2.70,6,12,12, true), 
("Intel Core i5 1135G7",2.40,4,8,8, true), 
("Intel Core i5 12500H",3.30,12,16,18, true), 
("Intel Celeron N4120",1.10,4,4,4, true), 
("AMD Ryzen 7 4800H",2.40,8,16,12, true), 
("Apple M2 Pro 12-Core",-1,12,-1,-1, true), 
("Intel Core i7 1360P",1.90,12,16,18, true), 
("Intel Core i7 13700H",2.40,14,20,24, true), 
("Apple M2 8 - Core",2.40,-1,-1,-1, true), 
("Intel Core i7 13620H",4.90,10,16,64, true), 
("Intel Core i7 1255U",1.70,10,12,18, true), 
("Apple M2 8 - Core",2.30,-1,-1,-1, true); 


INSERT INTO TBL_MEMORY(CURRENTRAM,TYPE,SPEED,MAXSLOTS,AVAILABLESLOTS,MAXRAM,STATUS) VALUES
("16 GB","DDR5","4800 MHz",2,0,"32 GB", true),
("8 GB","DDR4","3200 MHz",2,0,"32 GB", true),
("16 GB","LPDDR4X","4266 MHz",0,0,"16 GB", true),
("16 GB","DDR4","3200 MHz",1,0,"16 GB", true),
("8 GB","DDR4","3200 MHz",1,1,"16 GB", true),
("8 GB","DDR5","4800 MHz",2,1,"32 GB", true),
("8 GB","DDR4","3200 MHz",2,1,"32 GB", true),
("16 GB","DDR4","3200 MHz",2,0,"64 GB", true),
("8 GB","DDR4","2400 MHz",1,0,"12 GB", true),
("8 GB","LPDDR4","1600 MHz",0,0,"None", true), 
("16 GB","Hidden","Hidden",0,0,"16 GB", true), 
("16 GB","DDR5","6000 MHz",0,0,"None", true),
("16 GB","DDR5","5200 MHz",0,0,"None", true),
("8 GB","LPDDR4","3200 MHz",0,0,"16 GB", true),
("8 GB","DDR5","5200 MHz",2,1,"64 GB", true),
("8 GB","LPDDR4","3200 MHz",0,0,"8 GB", true);

INSERT INTO TBL_STORAGE(TYPE,MAXSLOTS,AVAILABLESLOTS,CURRENTSTORAGE,STATUS) VALUES
("SSD",2,1,"512 GB",true),
("SSD",1,0,"512 GB",true),
("SSD",1,0,"1 TB",true),
("SSD",1,0,"256 GB",true);

INSERT INTO TBL_PRODUCT(PRODUCTNAME,PRODUCTPRICE,PRODUCTQUANTITY,RELEASEDDATE,TOTALRATING,MODELCODE,ONSALE,CURRENTPRICE,MANUFACTURER,WARRANTY,SOLD,LENGTH,WIDTH,HEIGHT,WEIGHT,STATUS,BRANDID,SCREENID,OPERATINGSYSTEMID,PROCESSORID,MEMORYID,STORAGEID) VALUES
("Lenovo Gaming Legion 5 15IAH7H",42990000,20,"2022", 4,"15IAH7H ","%10", 42990000*0.9,"China",36,1,358.5,262.35,19.99,2.35,true,2,1,1,1,1,1),
("HP 15s-fq5163TU",17690000,20,"2022", 2,"7C135PA","%10", 17690000*0.9,"China",12,0,358.5,242,17.9,1.69,true,6,2,1,2,2,2),
("Acer Swift 3 SF314-43-R4X3",20990000,12,"2021", 4,"NX.AB1SV.004","%15", 20990000*0.85,"China",12,0,322.8,212.2,15.9,1.19,true,5,3,3,3,3,2),
("Lenovo IdeaPad 3 15ITL6",15290000,12,"2023", 4,"82H803RWVN","", 15290000,"China",24,0,359.2,236.5,19.9,1.65,true,2,2,3,4,4,2),
("Asus Vivobook A1503ZA-L1139W",21490000,4,"2022", 3,"90NB0WY2-M005R0","%10", 21490000*0.9,"China",24,1,356.8,227.6,19.9,1.7,true,4,2,1,1,5,1),
("MSI Modern 15 B7M-098VN",16490000,10,"2023", 4,"098VN","%10", 16490000*0.9,"China",24,0,359,241,19.9,1.75,true,7,2,1,5,6,1),

("Asus TUF Gaming FX517ZC-HN077W",23990000,5,"2022", 4,"90NR09L3-M00510","%15", 23990000*0.85,"China",24,0,354,251,19.9,2,true,4,2,1,6,6,1),
("Acer Nitro Gaming AN515-45-R86D",32490000,4,"2021", 3,"NH.QBCSV.005","", 32490000,"China",12,0,363.4,255,23.9,2.2,true,5,2,1,7,7,1),
("Gigabyte Gaming G5 GD-51VN123SO",18490000,7,"2021", 4,"G5 GD-51VN123SO","", 18490000,"China",24,0,361,258,24.9,2.2,true,8,2,1,8,8,1),
("Acer Aspire 3 A315-58-54M5",14490000,10,"2021", 3.4,"NX.ADDSV.00M","", 14490000,"China",12,0,363.4,247.5,19.9,1.7,true,5,2,1,9,9,1),
("Acer Nitro 5 Tiger Gaming AN515-58-52SP",27990000,12,"2022", 4,"NH.QFHSV.001","", 27990000,"China",12,1,360.4,271.09,25.9,2.5,true,5,2,1,10,7,1),
("CHUWI LarkBook Celeron",9190000,4,"2021", 3,"CHUWI LarkBook","", 9190000,"China",12,0,363,248,19.9,1.5,true,9,4,4,11,10,2),

("Asus Gaming ROG G513IC-HN729W",25590000,4,"2022", 4,"G513IC-HN729W","", 25590000,"China",24,0,354,259,20.6,2.1,true,4,2,1,12,7,1),
("MacBook Pro 14 inch M2 Pro 2023",65990000,7,"2023", 4.5,"MPHJ3SA/A","", 65990000,"China",12,0,312.6,221.2,15.5,1.6,true,3,5,5,13,11,3),
("LG Gram 16Z90R-G.AH76A5",46990000,4,"2023", 3,"16Z90R-G.AH76A5","", 46990000,"China",12,0,355.1,241.3,15.9,2,true,10,6,1,14,12,2),
("MSI Creator M16 B13VE-830VN",39990000,12,"date", 3.3,"830VN","", 39990000,"China",24,0,359,259,23.95,2.26,true,7,7,1,15,13,1),
("MacBook Pro 13 inch M2 2022 RAM 16 GB ",37990000,6,"2022", 4.3,"Z16R","", 37990000,"China",12,0,304.1,212.4,15.6,1.4,true,3,8,6,16,14,4),
("MSI Gaming Katana 15 B13VEK-252VN",32990000,12,"2022", 3.4,"Katana 15 B13VEK-252VN","", 32990000,"China",24,0,359,259,24.9,2.29,true,7,2,1,17,15,1),

("Dell Inspiron 16 N5620",29490000,5,"2022", 4.1,"N6I7004W1","", 29490000,"China",12,0,355.7,251.9,17.95,1.87,true,1,7,3,18,2,2),
("MacBook Air 13 inch M2 2022",29990000,12,"2022", 4.2,"MLXW3SA/A","", 29990000,"China",12,0,304.1,215,11.3,1.24,true,3,9,5,19,16,4);

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
("https://i.imgur.com/rA72f0r.png",2,20);



INSERT INTO TBL_CART(ITEMQUANTITY,USERID,PRODUCTID) VALUES
(1,1,1),
(1,1,2),
(2,2,2),
(2,2,1),
(1,3,1);

INSERT INTO TBL_RATING (DATEADDED,RATING,COMMENT,STATUS, USERID, PRODUCTID) VALUES
("2023-06-07",3,"Fast delivery",true, 1, 1),
("2023-06-07",4,"Customer services are very helpful",true, 2, 1),
("2023-06-07",2,"Terrible delivery, package were thrown through the window",true, 3, 2),
("2023-06-07",4,"Laptop works well",true, 4, 1),
("2023-06-07",3,"Fast delivery",true, 1, 2);

INSERT INTO TBL_RATINGIMAGE (IMAGELINK, STATUS, RATINGID) VALUES
("https://cdn.pixabay.com/photo/2023/03/17/02/42/architecture-7857832_1280.jpg",1,1),
("https://cdn.pixabay.com/photo/2023/06/11/08/52/waves-8055488_1280.jpg",2,1);

INSERT INTO TBL_FAVORITE (ISFAVORITE,USERID,PRODUCTID) VALUES
(true, 1,1),
(true, 3,2);

INSERT INTO TBL_USERORDER(TOTALPRICE,ORIGINALPRICE,NOTE,STATUS,RECEIVER,PAYMENTTYPE,SHIPPINGFEE,PENDINGDATE,PREPAREDATE,DELIVERYDATE,ARRIVEDDATE, ADDRESSID,USERID) VALUES
(86022000,86022000,"Deliver on Sunday morning",3,"Doroco",'credit card',100000,2023-06-05,2023-06-05,2023-06-06,2023-06-06,4,3);

INSERT INTO TBL_ORDERDETAIL(PRODUCTQUANTITY, USERORDERID, PRODUCTID) VALUES
(1, 1, 1),
(1,1,5),
(1,1,11);