DROP DATABASE eproject;
CREATE DATABASE eproject;
USE eproject;

CREATE TABLE `eproject`.`user` (
  `userID` INT NOT NULL AUTO_INCREMENT,
  `password` VARCHAR(20) NULL,
  `userName` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `address` VARCHAR(100) NULL,
  `phone` VARCHAR(12) NULL,
  `dob` DATE NULL,
  `roleUser` int NULL,
  PRIMARY KEY (`userID`));

CREATE TABLE `eproject`.`category` (
  `categoryID` INT NOT NULL AUTO_INCREMENT,
  `categoryName` VARCHAR(50) NULL,
  PRIMARY KEY (`categoryID`));

CREATE TABLE `eproject`.`brand` (
  `brandID` INT NOT NULL AUTO_INCREMENT,
  `brandName` VARCHAR(50) NULL,
  PRIMARY KEY (`brandID`));
  
CREATE TABLE `eproject`.`products` (
  `productID` INT NOT NULL AUTO_INCREMENT,
  `productName` VARCHAR(100) NULL,
  `imageLink` VARCHAR(200) NULL,
  `unitPrice` FLOAT NULL,
  `quantity` INT NULL,
  `categoryID` INT NULL,
  `brandID` INT NULL,
  `memory` VARCHAR(10) NULL,
  `speed` VARCHAR(50) NULL,
  `color` VARCHAR(25) NULL,
  `warranty` VARCHAR(30) NULL,
  `dimension` VARCHAR(30) NULL,
  `description` VARCHAR(500) NULL,
  PRIMARY KEY (`productID`));
  
CREATE TABLE `eproject`.`carts` (
  `cartID` INT NOT NULL AUTO_INCREMENT,
  `productID` INT NULL,
  `cartCode` VARCHAR(30) NULL,
  `userID` INT NULL,
  `cartQuantity` INT NULL,
  `totalMoney` INT NULL,
  PRIMARY KEY (`cartID`));
  
CREATE TABLE `eproject`.`order` (
  `orderID` INT NOT NULL AUTO_INCREMENT,
  `userID` INT NULL,
  `cartId` INT NULL,
  `orderEmail` VARCHAR(45) NULL,
  `orderAddress` VARCHAR(100) NULL,
  `orderPhone` VARCHAR(12) NULL,
  `orderDate` DATETIME DEFAULT NOW(),
  PRIMARY KEY (`orderID`));
  
CREATE TABLE `eproject`.`orderDetails` (
  `orderDetailsID` INT NOT NULL AUTO_INCREMENT,
  `orderID` INT NULL,
  `productID` INT NULL,
  `unitPrice` FLOAT NULL,
  `discount` FLOAT NULL,
  `orderQuantity` INT NULL,
  `totalMoney` INT NULL,
  PRIMARY KEY (`orderDetailsID`));
    
CREATE TABLE `eproject`.`feedback` (
  `feedbackID` INT NOT NULL AUTO_INCREMENT,
  `userID` INT NULL,
  `orderID` INT NULL,
  `productID` INT NULL,
  `message` VARCHAR(200) NULL,
  PRIMARY KEY (`feedbackID`));

ALTER TABLE `eproject`.`products` ADD CONSTRAINT fk_categoryID_products FOREIGN KEY (categoryID) REFERENCES `eproject`.`category`(categoryID);
ALTER TABLE `eproject`.`products` ADD CONSTRAINT fk_brandID_products FOREIGN KEY (brandID) REFERENCES `eproject`.`brand`(brandID);

ALTER TABLE `eproject`.`carts` ADD CONSTRAINT fk_productID_carts FOREIGN KEY (productID) REFERENCES `eproject`.`products`(productID);
ALTER TABLE `eproject`.`carts` ADD CONSTRAINT fk_userID_carts FOREIGN KEY (userID) REFERENCES `eproject`.`user`(userID);

ALTER TABLE `eproject`.`feedback` ADD CONSTRAINT fk_orderID_feedback FOREIGN KEY (orderID) REFERENCES `eproject`.`order`(orderID);
ALTER TABLE `eproject`.`feedback` ADD CONSTRAINT fk_userID_feedback FOREIGN KEY (userID) REFERENCES `eproject`.`user`(userID);

ALTER TABLE `eproject`.`order` ADD CONSTRAINT fk_userID_order FOREIGN KEY (userID) REFERENCES `eproject`.`user`(userID);

ALTER TABLE `eproject`.`orderDetails` ADD CONSTRAINT fk_orderID_orderDetails FOREIGN KEY (orderID) REFERENCES `eproject`.`order`(orderID);
ALTER TABLE `eproject`.`orderDetails` ADD CONSTRAINT fk_productID_orderDetails FOREIGN KEY (productID) REFERENCES `eproject`.`products`(productID);

DELIMITER //
CREATE TRIGGER trg_order_insert
AFTER INSERT
ON `eproject`.`order`
FOR EACH ROW
BEGIN
  DELETE FROM `eproject`.`carts` WHERE `cartID` = NEW.cartID;
END;
//
CREATE TRIGGER trg_orderDetails_insert
AFTER INSERT
ON `eproject`.`orderDetails`
FOR EACH ROW
BEGIN
	UPDATE `eproject`.`products` SET `quantity` = `quantity` - NEW.orderQuantity WHERE `productID` = NEW.productID;
END;

DELIMITER ;

INSERT INTO `eproject`.`brand`
VALUES
	(DEFAULT,'Samsung'),
    (DEFAULT,'Western Digital (WD)'),
    (DEFAULT,'Seagate'),
    (DEFAULT,'SanDisk'),
    (DEFAULT,'Kingston'),
    (DEFAULT,'Transcend');

INSERT INTO `eproject`.`category`
VALUES
	(DEFAULT,'Hard Disk Drive - HDD'),
    (DEFAULT,'Solid State Drive - SSD'),
    (DEFAULT,'USB Flash Drive'),
    (DEFAULT,'Memory Card'),
    (DEFAULT,'Random Access Memory - RAM'),
    (DEFAULT,'Portable Hard Drive');
    
INSERT INTO `eproject`.`products`
VALUES
    (DEFAULT, 'Canvas React Plus SD Memory Card', 'https://media.kingston.com/kingston/product/SDR2_256GB-lg.jpg', 374.05, 1000, 4, 5, '256GB', '300MB/s Read, 260MB/s Write', 'White Red', '3 years', '24mm x 32mm x 2.1mm (SD)', 'Kingston\'s Canvas React Plus SD card delivers high-performance speeds which are designed to work with industry-standard professional UHS-II cameras for creatives that shoot 8K/3D/VR videos and high-resolution photos'),
    (DEFAULT, 'XS1000 External Solid State Drive (SSD)', 'https://media.kingston.com/kingston/product/SXS1000_1000GB-angle-lg.jpg', 84.00, 1000, 2, 5, '1TB', '1,050MB/s read, 1,000MB/s write', 'Black', '5 years', '69.54 x 32.58 x 13.5mm', 'The Kingston XS1000 External Solid State Drive (SSD) is a portable storage solution known for its high-speed connectivity, compact design, and durability. It offers various capacity options and is suitable for users who prioritize fast data transfer and portability'),
    (DEFAULT, 'DataTraveler microDuo 3C USB Flash Drive', 'https://media.kingston.com/kingston/product/ktc-product-usb-dtduo3cg3-64gb-2-lg.jpg', 28.38, 1000, 3, 5, '64GB', 'USB 3.2 Gen 1', 'Purple', '5 years', '29.94mm x 16.60mm x 8.44mm', 'The Kingston DataTraveler microDuo 3C is a USB flash drive with a dual-interface design, featuring both USB Type-A and USB Type-C connectors. Key features include USB 3.1 Gen 1 support for fast data transfer, various capacities, a compact and portable design, plug-and-play functionality, and compatibility with devices featuring both USB-A and USB-C ports. It\'s a versatile solution for users needing to transfer data between different devices.'),
    (DEFAULT,'SanDisk Extreme M.2 NVMe PCIe Gen 4.0 Internal SSD','https://www.westerndigital.com/content/dam/store/en-us/assets/products/internal-storage/extreme-m2-nvme-pcie-ssd/gallery/extreme-m2-nvme-pcie-ssd-500gb.png.wdthumb.1280.1280.webp',54.99,350,2,4,'500GB','5,150MB/s2','Black','5 years','800x220mm','Minimize lag with a PCIe® Gen4 interface for more powerful photo retouching, video editing, and 3D rendering.Amp up your computer with ample space for your music, photos, videos, and documents.Efficient nCache 4.0 technology helps you copy and publish your files in less time'),
    (DEFAULT,'SanDisk PRO-CINEMA CFexpress™ Type B Memory Card','https://www.westerndigital.com/content/dam/store/en-us/assets/products/memory-cards/pro-cinema-cfexpress-type-b/gallery/sandisk-pro-cinema-cfexpress-type-b-320gb-front.png.wdthumb.1280.1280.webp',399.99,600,4,4,'320GB',' 1700MB/s2','Black','4 years',' 38x29.6x3.8 mm','For professional filmmakers using cinema cameras with CFexpress™ technology.Durable design that withstands up to 1-meter drops and up to 50 newtons (11.2 pounds-force).'),
    (DEFAULT,'Ultra Dual Drive Go USB Type-C','https://www.westerndigital.com/content/dam/store/en-us/assets/products/usb-flash-drives/ultra-dual-drive-go-usb-3-1-type-c/gallery/ultra-dual-drive-go-usb-3-1-type-c-hero.png.wdthumb.1280.1280.webp',9.99,294,3,4,'32GB','1s/MB1','Black','5 years','8.60x12.10x44.41 mm','The 2-in-1 flash drive with USB Type-C™ and Type-A connectors.Seamlessly move content between your USB Type-C™ smartphone, tablets, and Mac and USB Type-A computers.Automatically back up photos using the SanDisk Memory Zone app.'),
    (DEFAULT, 'Transcend USB Flash Drive 32GB', 'https://transcendvietnam.com/wp-content/uploads/2017/07/ts32gjf700-600x600.jpg', 15, 200, 3, 6, '32GB', 'USB 3.0', 'Black', '5 years', '50x20x10 mm', 'Small bar design.\nIntegrated with USB 3.0 port.\nConvenient LED light.\nSmooth bar design.\nStrong, elegant black color'),
    (DEFAULT, 'Transcend MicroSD Card 64GB', 'https://www.memoryc.com/images/products/bb/transcend-15743-3_25875.jpg', 25, 150, 4, 6, '64GB', 'Class 10', 'Black', '3 years', '8x6x1 mm', 'Performance and durability of the MLC Flash chip.\nSmooth Full HD, 3D and 4K movie recording performance.\nSupports Ultra High Speed Class 3 (U3) specification.'),
    (DEFAULT, 'Transcend DDR4 RAM 8GB', 'https://salt.tikicdn.com/ts/product/91/0a/91/2a774afdf9960c1a42b4f226be071139.jpg', 50, 50, 5, 6, '8GB', 'DDR4', 'Green', '8 years', '150x50x10 mm', 'Ram Transcend 8GB JM DDR4 2666Mhz 1Rx8 (1Gx8)x8 CL19 1.2V (JM2666HLB-8G).\nImprovements in DDR3 and DDR3L RAM with faster speeds, meeting the needs of PC users.'),
	(DEFAULT, 'Samsung SSD 1TB T7 Shield 1050MB/s MU-PE1T0', 'https://www.h2shop.vn/images/thumbnails/837/733/detailed/52/tr%E1%BA%AFng.jpg', '275', '100', 2, 1, '1TB', '1050MB/s', 'Beige', '3 years', '880 x 590 x 130mm', 'Samsung T7 Shield 1TB SSD Portable Hard Drive has the Ability to download applications for mobile phones, tablets, PC and Mac, gaming consoles, etc. and upgrade software for PC and Mac.\nThe Samsung Portable T7 Shield 1TB SSD mobile storage product absolutely secures your data.\nSamsung portable SSD hard drive with the highest quality rubber outer casing, water and dust resistance meeting IP65 standards, and resistant to falling at a height of up to 3m.'),
    (DEFAULT, 'PRO Ultimate + Reader Full Size SDXC Card 512GB','https://image-us.samsung.com/SamsungUS/home/computing/memory-storage/pdp/mb-sy512sb-am/MB-SY512SB-AM_006_Front-SD-Adapter-Combination_White.jpg?$product-details-jpg$',77.99,300,4,1,'512GB','200MB/s Read, 130MB/s Write','White','3 years','32mm x 24mm x 2.1mm','Spend more time creating and less time saving with read and write speeds up to 200/130 MB/s1 when using Samsung USB readers.\nWhether you’re using a DSLR camera or a PC, count on the PRO Ultimate for compatibility.\nDesigned to survive the rough and tumble of field work, the PRO Ultimate has built-in protection from elements like water and heat.\nSave every second in mere minutes with storage capacities ranging from 64GB to 512GB.'),
    (DEFAULT, 'PRO Ultimate Full Size SDXC 512GB','https://image-us.samsung.com/SamsungUS/home/computing/memory-storage/memory-cards/10022023/gallery/mb-sy512s-am/MB-SY512S-AM_001_Front_White.jpg?$product-details-jpg$',77.99,400,4,1,'512GB','200MB/s Read, 130MB/s Write','White','3 years','32mm x 24mm x 2.1mm','Spend more time creating and less time saving with read and write speeds up to 200/130 MB/s¹ when using Samsung USB readers.\nWhether you’re using a DSLR camera or a PC, count on the PRO Ultimate for compatibility.\nDesigned to survive the rough and tumble of field work, the PRO Ultimate has built-in protection from elements like water and heat.\nSave every second in mere minutes with storage capacities ranging from 64GB to 512GB.'),
    (DEFAULT, 'PRO Ultimate + Adapter microSDXC 512GB','https://image-us.samsung.com/SamsungUS/home/mobile/mobile-accessories/all-mobile-accessories/08102023/gallery/512/MB-MY512SA-AM_001_Front_Blue_1600x1200.jpg?$product-details-jpg$',54.99,200,4,1,'512GB','200MB/s Read, 130MB/s Write','Black','4 years','15mm x 11mm x 1 mm','Spend more time creating and less time saving with read and write speeds up to 200/130 MB/s¹ when using Samsung USB readers\nWhether you’re using a smartphone or a gaming console, count on the PRO Ultimate microSD for compatibility\nWith 10-year limited warranty, PRO Ultimate MicroSD is tough enough to take on anything with protection from water⁵ to extreme temps.\nPile in the files and expand your portfolio with a wide range of storage options from 128GB to 512GB'),
    (DEFAULT, 'BAR Plus USB 3.1 Flash Drive 256GB Titan Grey','https://image-us.samsung.com/SamsungUS/home/computing/memory-and-storage/usb-flash-drives/pd/muf-256be4-am/gallery/01_MUF-256BE4_Front_Titan-Gray041918042018.jpg?$product-details-jpg$',26.99,200,3,1,'256GB','400MB/s Data Transfer Speed','Grey','4 years','80mm x 30mm x 25mm','A modern take on a classic. The next generation Bar Plus elevates the flash drive to an everyday essential, offering impressive speeds in a striking design. Fits in your hand, a pure minimalism that cleverly blends style, speed, and reliability.\nGet your time back. Fast and convenient read speeds up to 400MB/s¹ with the latest USB 3.1 standard gives you more time to work, play, watch, and create. Send a 3GB 4K UHD video file from your Bar Plus to your PC in just 10 seconds.'),
    (DEFAULT, 'FIT Plus USB 3.1 Flash Drive 256GB','https://image-us.samsung.com/SamsungUS/home/computing/memory-and-storage/usb-flash-drives/pd/muf-256ab-am/gallery01-heroimage-MUF256ABAM-061918.jpg?$product-details-jpg$',25.99,200,3,1,'256GB','400MB/s Data Transfer Speed','grey','4 years','31mm x 25mm x 10mm','Expand your storage with a compact fit designed to plug in and stay. Read speeds up to 400 MB/s with the latest USB 3.1 standard.\nSafeguard your data with a 5-year limited warranty.'),
    (DEFAULT, 'DUO Plus USB Type-C Flash Drive 64GB','https://image-us.samsung.com/SamsungUS/home/computing/memory-and-storage/usb-flash-drives/pd/muf-64db/gallery/MUF-64DB-AM_Gallery_1.jpg?$product-details-jpg$',17.99,300,3,1,'64GB','300MB/s Data Transfer Speed','Grey','4 years','76mm x 24mm x 9mm"','Two flash drives in one, to double your connectivity\nBlazing USB 3.1 read speeds up to 300 MB/s. Backward compatible with USB 3.0/2.0.'),
    (DEFAULT, 'Portable SSD T5 EVO USB 3.2 2TB (Black)','https://image-us.samsung.com/SamsungUS/home/computing/memory-storage/portable-solid-state-drives/10-31-2023/gallery-images/MU-PH8T0S-WW_001_Front_Black.jpg?$product-details-jpg$',189.99,400,6,1,'2TB ','460 MB/s Read','Black','4 years','93.98mm x 40.64mm x 17.78mm','Make a big save wherever your projects take you with the small but mighty T5 EVO—available in storage capacity of 2TB.\nThe T5 EVO is optimized for large file transfers with improved Intelligent TurboWrite and speeds\nThis strong, sturdy sidekick will help you see it through with shock resistance and fall protection up to 6 feet.\n Whether you’re using a desktop or a gaming console,² count on the T5 EVO Portable SSD for compatibility.'),
    (DEFAULT, 'Portable SSD T9 USB 3.2 Gen2x2 1TB (Black)','https://image-us.samsung.com/SamsungUS/home/computing/memory-storage/pdp/mupg2t0bam/01.jpg?$product-details-jpg$',129.99,400,6,1,'1TB ','2,000MB/s','Black','4 years','93.98mm x 40.64mm x 17.78mm','Load, edit and transfer with sustained read and write speeds of up to 2,000MB/s.\nStay cool with its advanced thermal solution.\nWhether you’re using a desktop or a gaming console,³ count on the T9 Portable SSD for compatibility.\nWith up to 4TB capacity, the T9 Portable SSD offers plenty of storage space making it a safe bet for capturing all your creative endeavors.'),
    (DEFAULT, 'Portable SSD T7 Shield USB 3.2 2TB (Black)','https://image-us.samsung.com/SamsungUS/home/easy-asset/cbsr-4342/SG22-14K-0813-MKTCreativeMEMORY-T7Shield_BlackMock1-Gallery-1600x1200.jpg?$product-details-jpg$',179.99,500,6,1,'2TB ','1,050 MB/s Read,/1,000 MB/s Write','Black','3 years','59 x 88 x 13mm','High performance on-the-go, with rugged durability.\nIP65 rating for water and dust resistance, with Dynamic Thermal Guard to control heat.'),
    (DEFAULT, 'Portable SSD T7 USB 3.2 500GB (Gray)','https://image-us.samsung.com/SamsungUS/home/computing/01242022/MU-PC500T_001_Front_Black.jpg?$product-details-jpg$',89.99,100,6,1,'500GB','1,050 MB/s Read, 1,050 MB/s Write','Gray','4 years','11mm x 75mm x 10mm','SSD with strong durability & blazing fast transfer speeds/n1st Flash Memory Brand'),
    (DEFAULT, 'Portable SSD T7 TOUCH USB 3.2 1TB (Black)','https://image-us.samsung.com/SamsungUS/home/computing/memory-and-storage/portable-solid-state-drives/portable-ssd-t7/08-01-2022/MU-PC500GB.1TB.2TB_008_Front_Black-1600x1200.jpg?$product-details-jpg$',159.99,150,6,1,'1TB','1,050 MB/s Read,/1,000 MB/s Write','Black','5 years','11mm x 75mm x 10mm','The Portable T7 Touch SSD gives you speed and fingerprint security in a palm-sized package./nBuilt-in security options on the T7 Touch utilize AES 256-bit encryption and give you the option of unlocking with a touch of your finger or with a password/nWith read/write speeds of up to 1,050/1,000 MB/s, the T7 Touch is 9.5x faster than an external hard disk drive.'),
	(DEFAULT, '990 PRO w/ Heatsink PCIe® 4.0 NVMe™ SSD 4TB','https://image-us.samsung.com/SamsungUS/home/computing/memory-storage/pdp/mz-v9p4t0cw/gallery-images/MZ-V9P4T0CW_008_Front-LED-ON_Black.jpg?$product-details-jpg$',359.99,250,2,1,'4TB','7,450 MB/s Read','Black Red','6 years',' 80.15mm x 25mm x 8.88mm','Gen4 steps up to the arena with more than 55% improvement in random performance compared to 980 PRO.\nWith read and write speeds up to 7450/6900 MB/s², you’ll reach near max performance of PCIe® 4.0³ powering through for any use.\nGive yourself some space with storage capacities from 1TB to 4TB.\nThe ultra-slim Integrated Heatsink dissipates heat from your device for uninterrupted play.'),
    (DEFAULT, '990 PRO PCIe® 4.0 NVMe® SSD 1TB','https://image-us.samsung.com/SamsungUS/home/computing/memory-and-storage/10142022/MZ-V9P1T0B-AM_001_Front_Black-Gallery-1600x1200.jpg?$product-details-jpg$',99.99,350,2,1,'1TB','7,450 MB/s Read, 6,900 MB/s Write','Black','2 years','80mm x 22mm x 2.3mm','Designed for tech enthusiasts, hardcore gamers and heavy-workload professionals who want blazing fast speed.\nEnjoy up to 50% improved performance per watt over 980 PRO, plus optimal power efficiency with max PCIe® 4.0 performance.\nSequential read/write speeds up to 7,450/6,900 MB/s.'),
    (DEFAULT, '980 PRO PCIe® 4.0 NVMe® SSD 1TB','https://image-us.samsung.com/SamsungUS/home/computing/memory-and-storage/solid-state-drives/pdp/mz-v8p/1t0b-am/gallery/MZ-V8P1T0BW_001_Front_Black.jpg?$product-details-jpg$',89.99,300,2,1,'1TB','7,000 MB/s Read, 5,000 MB/s Write','Black','1 years','105mm x 31mm x 2.9mm','Genuine PCIe 4.0 NVMe™ speed (up to 7,000/5,000MB/s for read/write speed). Ideal for heavy computing, high resolution graphics and PC gaming.\nFor console gaming, compatible only with Playstation® 5. Must be installed with a heatsink (sold separately).'),
    (DEFAULT, '870 EVO SATA 2.5" SSD 500GB','https://image-us.samsung.com/SamsungUS/home/computing/memory-and-storage/ssd/mz-77e/500gb/MZ-77E500BW_001_Black.jpg?$product-details-jpg$',49.99,400,2,1,'500GB','560 MB/s Read, 530 MB/s Write','Black','3 years','131mm x 92mm x 9mm','Maximize SATA interface limit up to 560/530 MB/s for read and write sequential speeds.\nUp to 300 TBW* under a 5 year limited warranty.'),
    (DEFAULT, '970 EVO Plus NVMe® M.2 SSD 1TB','https://image-us.samsung.com/SamsungUS/home/computing/memory-and-monitors/9-27-21/mz-v7s1t0b-am-gallery/MZ-V7S1T0BW_001.jpg?$product-details-jpg$',99.99,500,2,1,'1TB','3,500 MB/s Read, 3,300 MB/s Write','Black','4 years','105mm x 29mm x 3mm','Superior NVMe® Read/Write performance with speeds up to 3,500/3,300 MB/s\nV-NAND reliability backed by up to 5 yr. warranty'),
    (DEFAULT, '980 PRO w/ Heatsink PCIe® 4.0 NVMe® SSD 1TB','https://image-us.samsung.com/SamsungUS/home/92121/dve53bb8700ta3/pc/MZ-V8P2T0CW_01.jpg?$product-details-jpg$',89.99,400,2,1,'1TB','7000 MB/s Read, 5000 MB/s Write','Black','5 years','24mm x 80mm x 8.6 mm','True PCIe® 4.0 NVMe™ speed (up to 7,000 MB/s for seq. reads,  5,100MB/s for seq. writes)\nIdeal for heavy computing, high resolution graphics and PC gaming.\nFor console gaming, compatible only with Playstation® 5.')
    ;

 INSERT INTO `eproject`.`products` (
  `productID`,
  `productName`,
  `imageLink`,
  `unitPrice`,
  `quantity`,
  `categoryID`,
  `brandID`,
  `memory`,
  `speed`,
  `color`,
  `warranty`,
  `dimension`,
  `description`
)
VALUES
(DEFAULT, 'Industrial SD Memory Card', 'https://media.kingston.com/kingston/product/SDIT_64GB-lg.jpg', 18.21,1000, 4, 5, '64GB', '100MB/s read, 80MB/s write', 'Grey', '3 years', '24mm x 32mm x 2.1mm', 'Industrial SD memory cards are designed for use in demanding industrial environments. Key features include extended temperature range, high reliability, shock and vibration resistance, error correction, wear leveling, long product lifecycle, security features, compatibility with standard SD slots, and various capacity options. These cards are tailored to meet the rigorous requirements of applications in manufacturing, automation, transportation, and other industrial settings.'),
(DEFAULT, 'Industrial microSD Memory Card', 'https://media.kingston.com/kingston/product/ktc-product-flash-sdcards-sdcit2-32gb-sp-1-lg.jpg', 21.85,1000, 4, 5, '32GB', '100MB/s read, 80MB/s write', 'Black', '3 years', '11mm x 15mm x 1mm', 'Industrial microSD memory cards are compact storage solutions specifically crafted for use in demanding industrial environments. These cards share similarities with standard microSD cards but are engineered to meet the robust requirements of industrial applications. Key features include extended temperature range, high reliability, resistance to shock and vibration.'),
(DEFAULT, 'High-Endurance microSD Memory Card', 'https://media.kingston.com/kingston/product/ktc-product-microsd-class10-sdce-sdce128gb-1-lg.jpg', 27.95,1000, 4, 5, '128GB', '95MB/s Read and 45MB/s Write', 'White', '3 years', '11mm x 15mm x 1mm', 'High-endurance microSD cards are designed for applications with frequent data access. They offer durability through a high number of read and write cycles, extended lifespan, advanced error correction, wear leveling, and compatibility with standard microSD slots. Ideal for continuous recording devices, dashcams, and surveillance systems, these cards come in various capacities and may include brand-specific technologies for enhanced performance and reliability.'),
(DEFAULT, 'Canvas Select Plus SD Card', 'https://media.kingston.com/kingston/product/ktc-product-flash-sdcards-sds2-512gb-1-lg.jpg', 12.42,1000, 4, 5, '512GB', '100/85MB/s Read/Write', 'White', 'Lifetime', '24mm x 32mm x 2.1mm', 'The Canvas Select Plus SD Card, offered by Kingston, provides reliable storage with options for different performance levels, capacities, and speed class ratings. Designed for compatibility with various devices, it is suitable for tasks like photo capture, video recording, and general digital content storage. For the latest and detailed information, it is recommended to check Kingston\'s official website.'),
(DEFAULT, 'DC1000B M.2 NVMe SSD', 'https://media.kingston.com/kingston/product/ktc-product-ssd-sedc1000b-960gb-1-lg.jpg', 65.57,1000, 2, 5, '960GB', '3,400MBs/925MBs', 'Blue', '5 years', '80mm x 22mm x 3.8mm', 'The DC1000B M.2 NVMe SSD by Kingston is a compact and high-performance storage solution designed for use in M.2 slots. It offers various capacity options, fast data transfer speeds typical of NVMe technology, and is likely targeted at enterprise or business applications.'),
(DEFAULT, 'DC600M 2.5” SATA Enterprise SSD', 'https://media.kingston.com/kingston/product/SEDC600M_7680G_1-lg.jpg', 65.57,1000, 2, 5, '7680GB', '560MBs/530MBs', 'Black', '5 years', '69.9mm x 100mm x 7mm', 'The DC600M 2.5” SATA Enterprise SSD by Kingston is a reliable and high-performance solid-state drive designed for enterprise use. With a 2.5-inch SATA form factor, it offers various capacity options and features tailored for data center applications, emphasizing durability and consistent performance. For the latest details, refer to Kingston\'s official website.'),
(DEFAULT, 'A400 SATA SSD', 'https://media.kingston.com/kingston/product/ktc-product-ssd-a400-sa400s37-480gb-1-lg.jpg', 37.11,1000, 2, 5, '480GB', '500MB/s Read and 450MB/s Write', 'Grey', '3 years', '100.0mm x 69.9mm x 7.0mm', 'The A400 SATA SSD is a solid-state drive manufactured by Kingston Technology. It utilizes SATA III (6Gb/s) interface for data transfer and is designed to significantly enhance system responsiveness and overall performance. With no moving parts, it offers faster boot times, quicker application loading, and improved system efficiency compared to traditional hard drives.'),
(DEFAULT, 'Mini Dragon USB Flash Drive', 'https://media.kingston.com/kingston/product/DTCNY24-128gb-lg.jpg', 22.68,1000, 3, 5, '128GB', '200MB/s-Read, 60MB/s-Write', 'Green', '5 years', '31.77mm x 33.63mm x 40.24mm', 'The Mini Dragon USB Flash Drive is a compact and portable storage solution characterized by its unique dragon-inspired design. Manufactured by an unspecified company (as of my last knowledge update in January 2022), this USB drive typically offers plug-and-play functionality with USB connectivity for quick and easy data transfer.'),
(DEFAULT, 'Kingston IronKey Vault Privacy 50 Series', 'https://media.kingston.com/kingston/product/ktc-product-usb-ikvp50-8gb-1-lg.jpg', 123.3,1000, 3, 5, '8GB', '250MB/s read, 180MB/s write', 'Blue', '5 years', '77.9 mm x 21.9 mm x 12.0 mm', 'The Kingston IronKey Vault Privacy 50 Series is a secure USB flash drive designed to protect sensitive data. It features hardware-based encryption and a keypad for PIN authentication, providing robust security for confidential information. The drive is built with a rugged metal casing, making it durable and resistant to physical damage.'),
(DEFAULT, 'Kingston IronKey S1000 Encrypted USB Flash Drive', 'https://media.kingston.com/kingston/product/ktc-product-usb-ironkey-s1000-basic-iks1000b-1-lg.jpg', 226.9,1000, 3, 5, '4GB', '180MB/s read, 80MB/s write', 'Grey', '5 years', '82.3mm x 21.1mm x 9.1mm', 'The Kingston IronKey S1000 is an encrypted USB flash drive designed to provide robust security for sensitive data. It features hardware-based encryption and a durable, tamper-evident design to protect against physical and cyber threats.'),
(DEFAULT, 'Kingston IronKey D500S Hardware-encrypted USB Flash Drive', 'https://media.kingston.com/kingston/product/IKD500S_256GB-lg.jpg', 288.07,1000, 3, 5, '256GB', '240MB/s read, 170MB/s write', 'Black', '5 years', '77.9 mm x 21.9 mm x 12.0 mm', 'The Kingston IronKey D500S is a hardware-encrypted USB flash drive designed for secure data storage. It features robust hardware-based encryption to protect sensitive information. The drive is FIPS 140-2 Level 3 certified, ensuring a high level of security for government and enterprise use'),
(DEFAULT, 'NV2 PCIe 4.0 NVMe SSD', 'https://media.kingston.com/kingston/product/ktc-product-ssd-snv2s-4000g-1-lg.jpg', 27.99,1000, 2, 5, '4TB', '3,500/2,800MB/s', 'Blue', '3 years', '22mm x 80mm x 2.2mm', 'The NV2 PCIe 4.0 NVMe SSD is a high-performance solid-state drive designed for ultra-fast data transfer. Utilizing the PCIe 4.0 interface, it offers significantly higher bandwidth compared to previous generations, delivering blazing-fast read and write speeds.'),
(DEFAULT, 'XS2000 External Solid State Drive', 'https://media.kingston.com/kingston/product/ktc-product-ssd-sxs2000-500gb-1-lg.jpg', 59.99,1000, 2, 5, '500GB', '2,000MB/s Read, 2,000MB/s Write', 'White', '5 years', '69.54 x 32.58 x 13.5mm', 'The XS2000 External Solid State Drive is likely a high-speed, portable storage solution designed for external use. It employs solid-state technology for faster data transfer rates compared to traditional hard drives.'),
(DEFAULT, 'KC600 2.5" and mSATA SSD', 'https://media.kingston.com/kingston/product/ktc-product-ssd-kc600-256gb-1-lg.jpg', 28.87,1000,  2, 5, '256GB', '550MB/s Read, 500MB/s Write', 'Black', '5 years', '100.1mm x 69.85mm x 7mm', 'The KC600 2.5" and mSATA SSDs are solid-state drives produced by Kingston Technology. The 2.5" variant is designed to fit into standard 2.5-inch drive bays, commonly found in laptops and desktops, while the mSATA variant is a smaller form factor suitable for devices with mSATA slots.'),
(DEFAULT, 'DT4000G2 Encrypted USB Flash Drive', 'https://media.kingston.com/kingston/product/ktc-product-usb-dt4000g2-managed-dt4000g2dm8gb-1-lg.jpg', 68.99,1000, 3, 5, '8GB', '165MB/s read, 22MB/s write', 'black', '5 years', '77.9 mm x 22.2 mm x 12.05 mm', 'The DT4000G2 Encrypted USB Flash Drive is a secure and portable storage solution provided by Kingston Technology. It features hardware-based encryption, ensuring data protection with robust security measures. The drive is designed to safeguard sensitive information and prevent unauthorized access.'),
(DEFAULT, 'DataTraveler Exodia Onyx USB Flash Drive', 'https://media.kingston.com/kingston/product/ktc-product-usb-dtxon-64gb-1-lg.jpg', 10.27,1000, 3, 5, '500GB', 'USB 3.2 Gen 1 compliant', 'Black', '5 years', '60.7mm x 21mm x 10.2mm', 'The DataTraveler Exodia Onyx is a USB flash drive produced by Kingston. It features a sleek black design and offers convenient portable storage for files, documents, and media. With USB 3.2 Gen 1 connectivity, it provides fast data transfer speeds.'),
(DEFAULT, 'DataTraveler Exodia USB Flash Drive', 'https://media.kingston.com/kingston/product/ktc-product-usb-dtx-256gb-1-lg.jpg', 9.44,1000, 3, 5, '256GB', 'USB 3.2 Gen 1 compliant', 'BLack', '5 years', '	67.3mm x 21.04mm x 10.14mm', 'The DataTraveler Exodia is a USB flash drive developed by Kingston Technology. It offers portable storage with a sleek design and is equipped with a capless, retractable USB connector, eliminating the need for a separate cap. The drive provides quick and convenient data transfer through USB 3.2 Gen 1 connectivity.'),
(DEFAULT, 'DataTraveler Kyson USB Flash Drive', 'https://media.kingston.com/kingston/product/ktc-product-usb-dtkn-32gb-1-lg.jpg', 17.32,1000, 3, 5, '32GB', ' 200MB/s read, 60MB/s write', 'Silver', '5 years', '	39mm x 12.6mm x 4.9mm', 'The DataTraveler Kyson is a USB flash drive developed by Kingston. It provides portable storage with a sleek design and USB 3.2 Gen 1 (USB 3.0) connectivity for fast data transfer speeds. Available in different capacities, the Kyson offers a convenient way to store and transfer files, documents, and multimedia'),
(DEFAULT, 'Kingston IronKey Keypad 200 Series', 'https://media.kingston.com/kingston/product/ktc-product-usb-ikkp200-8gb-1-lg.jpg', 271.75,1000, 3, 5, '8GB', '145MB/s read, 115MB/s write', 'Blue', '5 years', '80mm x 20mm x 11mm', 'The Kingston IronKey Keypad 200 Series is a secure USB flash drive designed for enhanced data protection. It features a built-in alphanumeric keypad for PIN authentication, adding an extra layer of security.'),
(DEFAULT, 'Kingston IronKey D300S Encrypted USB Flash Drive', 'https://media.kingston.com/kingston/product/ktc-product-usb-d300s-d300s64gb-1-lg.jpg', 59,1000, 3, 5, '64GB', '250MB/s read, 85MB/s write', 'Black', '5 years', '77.9 mm x 22.2 mm x 12.05 mm', 'The Kingston IronKey D300S is an encrypted USB flash drive designed for secure data storage. It features hardware-based encryption, using 256-bit AES in XTS mode, providing robust protection for sensitive information.'),
(DEFAULT, 'High-Endurance microSD Memory Card', 'https://media.kingston.com/kingston/product/ktc-product-microsd-class10-sdce-sdce32gb-1-lg.jpg', 26.76,1000, 4, 5, '64GB', '95MB/s Read and 30MB/s Write', 'Black', '3 years', '11mm x 15mm x 1mm', 'A high-endurance microSD memory card is a storage solution designed for continuous and demanding use, such as in surveillance cameras, dashcams, or other devices that require frequent read/write cycles.'),
(DEFAULT, 'DataTraveler Max USB 3.2 Gen 2 Series Flash Drive', 'https://media.kingston.com/kingston/product/ktc-product-usb-dtmaxa-256gb-1-lg.jpg', 110.93,1000, 3, 5, '256GB', ' 1,000MB/s read, 900MB/s write', 'Pink', '3 years', '82.17 mm x 22.00 mm x 9.02 mm', 'The DataTraveler Max USB 3.2 Gen 2 Series is a high-performance flash drive by Kingston Technology. It features USB 3.2 Gen 2 connectivity for fast data transfer speeds. With a sleek design and durable metal casing, it provides reliable and secure storage in capacities ranging from moderate to high.'),
(DEFAULT, 'Canvas Select Plus microSD Memory Card', 'https://media.kingston.com/kingston/product/ktc-product-flash-microsd-sdcs2-32gb-1-lg.jpg', 6.56,1000, 4, 5, '32GB', '100MB/s Read, UHS-I Speed Class, U1, V10', 'Black', '5 years', '11mm x 15mm x 1mm', 'The Canvas Select Plus microSD Memory Card is a product offered by Kingston Technology. It is a microSD card designed for use in various devices such as cameras, smartphones, and tablets.'),
(DEFAULT, 'DataTraveler Exodia M USB Flash Drive', 'https://media.kingston.com/kingston/product/ktc-product-usb-dtxm-64gb-1-lg.jpg', 3.09,1000, 3, 5, '64GB', 'USB 3.2 Gen 1 compliant', 'Blue', '5 years', '	67.4mm x 21.8mm x 11.6mm', 'The DataTraveler Exodia M is a USB flash drive manufactured by Kingston. It offers portable storage with a compact and durable design. The "M" in its name likely denotes its compatibility with USB Type-C ports. With various storage capacities.');

INSERT INTO `eproject`.`products` (
	`productID`, 
    `productName`, 
    `imageLink`, 
    `unitPrice`, 
    `quantity`, 
    `categoryID`, 
    `brandID`, 
    `memory`, 
    `speed`, 
    `color`, 
    `warranty`, 
    `dimension`, 
    `description`
) VALUES 
-- HDD
(DEFAULT ,'WD Red Pro NAS Hard Drive','https://www.westerndigital.com/content/dam/store/en-us/assets/products/internal-storage/wd-red-pro-sata-hdd/gallery/wd-red-pro-2tb.png', 92.99, 70, 1, 4, '1TB', '7200RPM', 'Red', '5 year', '3.5 inch', 
    'Ideal for creative pros, medium to large businesses, and commercial/enterprise NAS systems.\nFor RAID-optimized NAS systems with an unlimited number of bays.\nRated for 550TB/year workloads1 and up to 2.5M hours MTBF.'
),
(DEFAULT ,'My Book','https://www.westerndigital.com/content/dam/store/en-us/assets/products/desktop/my-book-usb-3-0-hdd/gallery/my-book-new-front-2.png.thumb.1280.1280.png', 134.99, 150, 1, 4, '4TB', '5Gb/s ', 'Black', '3 year', '3.5 inch', 
    'Complete, streamlined backup solution.\nEasy-to-use password protection.\n256-bit AES hardware encryption.'
),
(DEFAULT ,'WD Elements SE','https://www.westerndigital.com/content/dam/store/en-us/assets/products/portable/wd-elements-se/gallery/1tb/wd-elements-se-1-2tb-front.png.thumb.1280.1280.png', 44.99, 70, 1, 4, '1TB', '291 MB/s', 'Black', '5 year', '3,5 inch', 
    'Improves PC performance .\nBuilt for durability, shock tolerance, and reliability.\nHigh capacity in a compact design.'
),
(DEFAULT ,'My Cloud Pro Series PR4100','https://www.westerndigital.com/content/dam/store/en-us/assets/products/desktop/my-cloud-pro-series-pr4100/gallery/my-cloud-pro-series-pr4100-Hero1.png.thumb.1280.1280.png', 769.99, 210, 1, 4, '8TB', '560MB/s2', 'Black', '4 year', '12.10x44.41 mm', 
    'Third-party app support.\nFeatures four 3.5-inch hard drive bays .\nIdeal for small business and home office.'
),
-- SSD
(DEFAULT ,'SanDisk Extreme PRO SSD','https://www.westerndigital.com/content/dam/store/en-us/assets/products/portable/extreme-pro-usb-3-1-ssd/gallery/extreme-pro-usb-3-1-ssd-front.png', 119.99, 50, 2, 4, '1TB', '2000MB/s2 read/write', 'Black', '5 year', '8.60x12.10x44.41 mm', 
    'Save time storing and transferring data with powerful NVMe solid state performances.\nA forged aluminum chassis acts as a heatsink to deliver higher sustained speeds.\nUp to three-meter drop protection and IP65 water and dust resistance.'
),
(DEFAULT ,'WD_BLACK SN770M NVMe™ SSD','https://www.westerndigital.com/content/dam/store/en-us/assets/products/internal-storage/wd-black-sn770m-nvme-ssd/gallery/wd-black-sn770m-nvme-ssd-front.png', 79.99, 110, 2, 4, '500GB', '5,150 MB/s2', 'Black', '5 year', '8.60x12.10x44.41 mm', 
    'Play more games wherever you are with up to 2TB of trusted Western Digital TLC 3D NAND storage.\nExclusive gaming features including PCIe® Gen 4.0, Western Digital nCache 4.0 technology, and Microsoft’s DirectStorage Support.'
),
(DEFAULT ,'WD_BLACK C50 Expansion Card for Xbox','https://m.media-amazon.com/images/I/81y1WhdOkiL.jpg', 79.99, 200, 2, 4, '512GB', '2000 MB/s2', 'Black', '3 year', '8.60x12.10 mm', 
    'Plug-and-play with your Xbox™ Series X|S, so you don’t have to worry about compatibility or opening your console to install.\nQuick Resume-compatible, allowing you to suspend your current game, play a different game, then come back to the first game as if you never left .'
),
(DEFAULT ,'SanDisk Ultra 3D SSD','https://www.sandisk.com/content/dam/sandisk-main/en_us/assets/about/media/product/retail/ssd/ultra_3d_ssd/ultra-3d-ssd-sandisk-1000x1000.png', 39.99, 150, 2, 4, '500GB', '560MB/s2', 'Black', '5 year', '12.10x44.41 mm', 
    'Endurance of up to 600TBW.\nSpeed up your boot-up, shut-down, and app load and response times.\nGreater drive endurance and reliability, plus lower power usage with new 3D NAND technology.'
),
-- USB
(DEFAULT ,'Ultra Dual Drive Go USB Type-C™','https://www.westerndigital.com/content/dam/store/en-us/assets/products/usb-flash-drives/ultra-dual-drive-go-usb-3-1-type-c/gallery/ultra-dual-drive-go-usb-3-1-type-c-hero.png', 9.99, 300, 3, 4, '32GB', '150MB/s2', 'Black', '4 year', '487x97 mm ', 
    'Third-party app support.\nFeatures four 3.5-inch hard drive bays .\nIdeal for small business and home office.'
),
(DEFAULT ,'SanDisk Ultra Dual Drive Luxe USB Type-C™ Flash Drive','https://www.westerndigital.com/content/dam/store/en-us/assets/products/usb-flash-drives/ultra-dual-drive-luxe-usb-3-1-type-c/gallery/ultra-dual-drive-luxe-usb-3-1-type-c-1.png', 11.49, 500, 3, 4, '32GB', '170MB/s2', ' Silver', '3 year', '487x97 mm', 
    'Dual-purpose swivel design helps protects connectors and features a keyring hole to take your drive on the go.\nSeamlessly move content between compatible smartphones, tablets, and computers .\nThe 2-in-1 flash drive with reversible USB Type-C and Type-A connectors.'
),
(DEFAULT ,'Clearance - Ultra Dual Drive Go USB Type-C™','https://www.westerndigital.com/content/dam/store/en-us/assets/products/usb-flash-drives/ultra-dual-drive-go-usb-3-1-type-c/gallery/green/ultra-dual-drive-go-usb-3-1-type-c-open-green.png', 49.99, 300, 3, 4, '512TB', '150MB/s2', 'Blue', '2 year', '487x97 mm', 
    'The 2-in-1 flash drive with USB Type-C™ and Type-A connectors.\nAutomatically back up photos with SanDisk Memory Zone app.\nThe 2-in-1 flash drive with USB Type-C™ and Type-A connectors.'
),
(DEFAULT ,'SanDisk Ultra Shift USB 3.2 Gen 1 Flash Drive','https://www.westerndigital.com/content/dam/store/en-us/assets/products/usb-flash-drives/ultra-shift-usb-3-2/gallery/ultra-shift-usb-3-2-black-front.png', 129.99, 50, 3, 4, '1TB', 'up to 100MB/s2', 'Black', '2 year', '487x97 mm', 
    'Transfer files easily and quickly with USB 3.2 Gen 1 interface.\nCompact design for on-the-go lifestyle.\nPassword-protect your files using a downloadable software .'
),
-- Memory card
(DEFAULT ,'Nintendo®-Licensed Memory Cards For Nintendo Switch™','https://www.westerndigital.com/content/dam/store/en-us/assets/products/memory-cards/nintendo-switch-microsd/gallery/nintendo-switch-microsd-64gb-yoshi.png.thumb.1280.1280.png', 12.99, 100, 4, 4, '64GB', 'up to 100MB/s2', 'Green', '2 year', '15 x 11 x 1.0 mm', 
    'Load games faster with transfer rates up to 100MB/s.\nInstantly add up to 1TB of additional space.\nDesigned, tested, and approved for the Nintendo Switch console  .'
),
(DEFAULT ,'SanDisk Extreme® microSDXC™ UHS-I CARD','https://www.westerndigital.com/content/dam/store/en-us/assets/products/memory-cards/extreme-uhs-i-microsd/extreme-uhs-i-microsd-128gb.png.thumb.1280.1280.png', 12.99, 400, 4, 4, '128GB', 'up to 190MB/s9', 'Fold&Red', '2 year', '15 x 11 x 1.0 mm', 
    'Water-proof, temperature proof, X-ray proof, magnet proof, shock proof.\nClass 10 for Full HD video playback – watch right from the card.\nUp to 120MB/s transfer speeds let you move photos and files fast.'
),
(DEFAULT ,'SanDisk MAX ENDURANCE microSD™ Card','https://www.westerndigital.com/content/dam/store/en-us/assets/products/memory-cards/max-endurance-uhs-i-microsd/gallery/max-endurance-uhs-i-microsd-256GB.png', 44.99, 156, 4, 4, '256GB', 'up to 100MB/s2', 'Silver', '2 year', '0.04 x 0.59 x 0.43 inch', 
    'Designed to last1, this microSD card can withstand a variety of extreme weather conditions because it’s temperature-proof, waterproof, shockproof, and X-ray proof.2 With capacities of up to 256GB7, you can record and store more Full HD or 4K videos3. And, with read speeds up to 100MB/s5, you’ll be able to spend less time transferring and backing up video footage, and more time living life..\nRecord Full HD and 4K video.'
),
(DEFAULT ,'SanDisk Extreme SD UHS-I Card','https://www.westerndigital.com/content/dam/store/en-us/assets/products/memory-cards/extreme-uhs-i-sd/gallery/extreme-uhs-i-sd-180mbps-512gb-front.png', 62.99, 263, 4, 4, '512B', 'up to 180MB/s6', 'Black Gold', '2 year', '0.04 x 0.59 x 0.43 inch', 
    'With the SanDisk Extreme SD UHS-I memory card save time transferring media with read speeds of up to 180MB/s6 powered by SanDisk® QuickFlow™ Technology8 (64GB - 512GB). Pair with the SanDisk Professional PRO-READER SD and microSD to achieve maximum speeds (sold separately). With shot speeds of up to 130MB/s6 and UHS speed Class 3 (U3)2 recording, you’re ready to capture high-resolution, stutter-free 4K UHD video1.'
),
-- RAM

(DEFAULT ,'AORUS RGB Memory DDR5','https://product.hstatic.net/1000333506/product/avatar_41acfc6c09694788b124e89ca5fbff56_82cf3cf240a24996a4b781756578c3a4.png', 102.66, 20, 5, 4, '32GB', '5600MT/s', 'Black', '4 year', '145 mm x 35 mm. ',
'AORUS DDR5 RGB memory adopts a new copper-aluminum composite material heat spreader. Besides, with NanoCarbon coating, enhance passive thermal spreader when under ultra-high performance. The coating material covers the entire heat spreaders. High voltage may cause a memory peak over 70°C and failure.'
),
(DEFAULT ,'Crucial Pro RAM DDR5','https://m.media-amazon.com/images/I/41Un7nOsFyL._AC_SX679_PIbundle-2,TopRight,0,0_SH20_.jpg', 88.65, 320, 5, 4, '32GB', '4800MT/s', 'Black', '4 year', '145 mm x 35 mm ', 
    'Plug-and-play extreme performance. Downclock capable for systems that only support 5200MT/s or 4800MT/s.\nUniversal compatibility. Compatible with 12th–13th Gen Intel Core or AMD Ryzen 7000 Series desktop CPUs.'
),
(DEFAULT ,'Corsair VENGEANCE LPX DDR4 RAM','https://m.media-amazon.com/images/I/41CQ0jxWYPL._AC_SX679_.jpg', 67.99, 230, 5, 4, '32GB', '	3200 MHz', 'Black', '4 year', '145 mm x 35 mm', 
    'Hand-sorted memory chips ensure high performance with generous overclocking headroom.\nVENGEANCE LPX is optimized for wide compatibility with the latest Intel and AMD DDR4 motherboards.\nA low-profile height of just 34mm ensures that VENGEANCE LPX even fits in most small-form-factor builds.'
),
(DEFAULT ,'Lexar ARES RGB DDR4','https://m.media-amazon.com/images/I/51QpTRhJz0L._AC_SX679_PIbundle-2,TopRight,0,0_SH20_.jpg', 44.99, 512, 5, 4, '16GB', '3600MT/s ', 'White', '4 year', '145 mm x 35 mm ', 
    'Delivering blazing-fast DDR4 overclocked performance to elevate your gaming experience.\n Full range RGB support – customize your colors and effects with a vibrant RGB light bar.'
),
-- portable
(DEFAULT ,'WD 5TB Elements Portable HDD, External Hard Drive','https://m.media-amazon.com/images/I/81WFWi9sKlL._AC_SX679_.jpg', 119.99, 30, 6, 4, '5TB', ' 5Gbps', 'Black', '4 year', '2.5 Inches ', 
    'Improve PC performance - When your internal hard drive is almost full your PC slows down. Don’t delete files. Free up space on your internal hard drive by transferring files to your WD Elements portable hard drive and get your laptop moving again.Plug-and-play ready for Windows PC'
),
(DEFAULT ,'Seagate Portable 4TB External Hard Drive HDD','https://m.media-amazon.com/images/I/71iIr9koTGL._AC_SX679_.jpg', 59.99, 629, 6, 4, '4TB', '10Gbps', 'Black', '5 year', '18 Inches', 
    'Easily store and access 4TB of content on the go with the Seagate Portable Drive, a USB external hard drive.Specific uses: Personal.Designed to work with Windows or Mac computers, this external hard drive makes backup a snap just drag and drop.'
),
(DEFAULT ,'Toshiba Canvio Basics 1TB Portable External Hard Drive','https://m.media-amazon.com/images/I/81HElDSuH0L._AC_SX679_.jpg', 61.899, 90, 6, 4, '4TB', '5Gbps', 'Black', '5 year', '2.5 Inches ', 
    'Sleek profile design with a matte, smudge-resistance finish.Plug & Play - Easy to use with no software to install.Quickly add more storage capacity to your PC and other compatible devices.'
),
(DEFAULT ,'Seagate Portable 5TB External Hard Drive HDD','https://m.media-amazon.com/images/I/81o5zJ+FcPL._AC_SX679_.jpg', 109.99, 700, 6, 4, '32GB', '10Gbps', 'Black', '5 year', '18 Inches ', 
    'Easily store and access 5TB of content on the go with the Seagate portable drive, a USB external hard Drive.Designed to work with Windows or Mac computers, this external hard drive makes backup a snap just drag and drop.'
);

-- USB 
INSERT INTO `eproject`.`products` (
  `productName`, `imageLink`, `unitPrice`, `quantity`, `categoryID`, `brandID`,
  `memory`, `speed`, `color`, `warranty`, `dimension`, `description`
) VALUES
  ('Transcend USB Flash Drive 32GB', 'https://transcendvietnam.com/wp-content/uploads/2017/07/Pp-JF590-pkg-201412.jpg', 15, 200, 3, 6, '32GB', 'USB 3.0', 'Black', '3 year', '5x2x1 cm', 'JetFlash 700 supports USB 3.1 Gen 1 standard, making it much easier for you to access your rich content. \n With a combination of speed and great looks, the JetFlash 700 is the perfect entry-level USB 3.1 Gen 1 peripheral for those who demand a stylish aesthetic with leading-edge technology.'),
  ('Transcend USB Flash Drive 16GB', 'https://m.media-amazon.com/images/W/MEDIAX_792452-T2/images/I/613bGz82wWL.jpg', 9.99, 100, 3, 6, '16GB', 'USB 2.0', 'Black', '3 year', '5x2x1 cm', 'JetFlash 700 supports USB 3.1 Gen 1 standard, making it much easier for you to access your rich content. \nWith a combination of speed and great looks, the JetFlash 700 is the perfect entry-level USB 3.1 Gen 1 peripheral for those who demand a stylish aesthetic with leading-edge technology.'),
  ('Transcend USB Flash Drive 64GB', 'https://dylbs6e8mhm2w.cloudfront.net/productimages/500x500/SYN1027162441.JPG', 24.99, 50, 3, 6, '64GB', 'USB 3.0', 'Black', '3 years', '7x2.5x1 cm', 'JetFlash 700 supports USB 3.1 Gen 1 standard, making it much easier for you to access your rich content. \nWith a combination of speed and great looks, the JetFlash 700 is the perfect entry-level USB 3.1 Gen 1 peripheral for those who demand a stylish aesthetic with leading-edge technology.'),
  ('Transcend USB Flash Drive 128GB', 'https://transcendvietnam.com/wp-content/uploads/2017/07/TS128GJF700.webp', 39.99, 30, 3, 6, '128GB', 'USB 3.1 Gen 1', 'Black', '3 years', '8x2.5x0.8 cm', 'JetFlash 700 supports USB 3.1 Gen 1 standard, making it much easier for you to access your rich content. \nWith a combination of speed and great looks, the JetFlash 700 is the perfect entry-level USB 3.1 Gen 1 peripheral for those who demand a stylish aesthetic with leading-edge technology.');
-- Memory Card
INSERT INTO `eproject`.`products` (
  `productName`, `imageLink`, `unitPrice`, `quantity`, `categoryID`, `brandID`,
  `memory`, `speed`, `color`, `warranty`, `dimension`, `description`
) VALUES
  ('Transcend 32GB microSDHC Memory Card', 'https://marcnetgadgets.com/wp-content/uploads/2022/03/TS32GUSD300S-A.png', 22.99, 40, 4, 6, '32GB', 'UHS-I U1', 'Black', '3 years', '2x1.5x0.1 cm', 'Combining next-generation Ultra High Speed ​​Class 1 technology with high capacity, Transcend \n  microSDXC UHS-I memory cards not only provide the best possible performance across a wide range of mobile activities, but also have enough space. archive to carry your entire collection of personal files.'),
  ('Transcend 64GB SDXC Memory Card', 'https://460estore.com/4959-large_default/transcend-64gb-sdxcsdhc-700s-memory-card.jpg', 34.99, 25, 4, 6, '64GB', 'UHS-I U3', 'Black', '5 years', '3x2x0.2 cm', 'Transcend s SDXC UHS-I Speed ​​Class 3 (U3) card provides the performance and capacity needed to get the most out of your UHS-I compliant camera.\n Incredible read and write capabilities speeds of up to 95 MB/s and 85 MB/s, these cards can easily record high-quality 4K and significantly reduce the time it takes to transfer video to your computer.'),
  ('Transcend 128GB microSDXC Memory Card', 'https://technome.bg/image/cache/catalog/pc-import/0006301430150/2043/00063034391472-446x446.jpg', 49.99, 15, 4, 6, '128GB', 'UHS-I U3', 'Black', '3 years', '2x1.5x0.1 cm', 'Combining next-generation Ultra High Speed ​​Class 1 technology with high capacity, Transcend \n  microSDXC UHS-I memory cards not only provide the best possible performance across a wide range of mobile activities, but also have enough space. archive to carry your entire collection of personal files.'),
  ('Transcend 256GB SDXC Memory Card', 'https://transcendvietnam.com/wp-content/uploads/2017/10/gb_csuSD_moreview_SDU3R60_256G.jpg', 79.99, 10, 4, 6, '256GB', 'UHS-II U3', 'Gold', '5 years', '3x2x0.2 cm', 'Transcend s SDXC UHS-I Speed ​​Class 3 (U3) card provides the performance and capacity needed to get the most out of your UHS-I compliant camera.\nIncredible read and write capabilities speeds of up to 95 MB/s and 85 MB/s, these cards can easily record high-quality 4K and significantly reduce the time it takes to transfer video to your computer.');
-- RAM 
 INSERT INTO `eproject`.`products` (
  `productName`, `imageLink`, `unitPrice`, `quantity`, `categoryID`, `brandID`,
  `memory`, `speed`, `color`, `warranty`, `dimension`, `description`
) VALUES
  ('Transcend RAM 8GB DDR4', 'https://bizweb.dktcdn.net/thumb/grande/100/329/122/products/ram-laptop-transcend-jetram-jm-ddr4-8gb-3200mhz-1-2v-jm3200hsb-8g.jpg?v=1671726336970', 59.99, 30, 5, 6, '8GB', 'DDR4', 'Green', '3 years', '15x5x1 cm', 'High-performance DDR4 RAM for improved system speed and stability.'),
  ('Transcend RAM 16GB DDR4', 'https://bizweb.dktcdn.net/thumb/grande/100/329/122/products/ram-laptop-transcend-jetram-jm-ddr4-16gb-3200mhz-1-2v-jm3200hse-16g-1.jpg?v=1659599303597', 109.99, 20, 5, 6, '16GB', 'DDR4', 'Green', '3 years', '15x5x1 cm', 'High-capacity DDR4 RAM module for enhanced multitasking and gaming.'),
  ('Transcend RAM 32GB DDR4', 'https://vidatech.vn/wp-content/uploads/2023/07/32-48001.jpg', 159.99, 15, 5, 6, '32GB', 'DDR4', 'Green', '3 years', '15x5x1 cm', 'Extreme performance DDR4 RAM for gaming enthusiasts and content creators.'),
  ('RAM Transcend JM3200HLH-4G DDR4 3200 Mhz', 'https://www.sieuthimaychu.vn/datafiles/setone/16915672123047.jpg', 24.99, 10, 5, 6, '4GB', 'DDR4', 'Green', 'Lifetime', '15x5x1 cm', 'Ultra-high capacity DDR4 RAM for professional workstations and power users.');
-- portable Hard drive
INSERT INTO `eproject`.`products` (
  `productName`, `imageLink`, `unitPrice`, `quantity`, `categoryID`, `brandID`,
  `memory`, `speed`, `color`, `warranty`, `dimension`, `description`
) VALUES
  ('Transcend Portable HDD 1TB', 'https://vitinhlehuy.com/upload/images/500x500/617a453e718f5_lehuycomputer.png', 79.99, 50, 6, 6, '1TB', 'USB 3.0', 'Black', '2 years', '12x8x2 cm', 'With the desire to provide enthusiasts with fast transfer speeds, large storage capacity and a unique three-layer shock protection system, the StoreJet 25H3P USB 3.0 portable hard drive is an ideal storage device. Ideal for data backup, archiving and file movement.'),
  ('Transcend Portable HDD 2TB', 'https://storesradar.com/wp-content/uploads/2022/06/transcend-2tb-external-hdd.jpg', 109.99, 30, 6, 6, '2TB', 'USB 3.0', 'Black', '2 years', '12x8x2 cm', 'With the desire to provide enthusiasts with fast transfer speeds, large storage capacity and a unique three-layer shock protection system, the StoreJet 25H3P USB 3.0 portable hard drive is an ideal storage device. Ideal for data backup, archiving and file movement.'),
  ('Transcend Portable HDD 4TB', 'https://www.goldfries.com/images/hwreviews/2016/transcend25h34tb/storejet_01.jpg', 159.99, 20, 6, 6, '4TB', 'USB 3.0', ' Purple', '3 years', '12x8x2 cm', 'With the desire to provide enthusiasts with fast transfer speeds, large storage capacity and a unique three-layer shock protection system, the StoreJet 25H3P USB 3.0 portable hard drive is an ideal storage device. Ideal for data backup, archiving and file movement.'),
  ('Transcend Portable HDD 8TB', 'https://thietbiluutru.com.vn/media/product/250_3289_dc3e83fa396da1229962f10cae5bbe4c.jpg', 259.99, 10, 6, 6, '8TB', 'USB 3.1 Gen 1', 'Black', '3 years', '15x10x3 cm', 'Ultra-large storage capacity with USB 3.1 Gen 1 interface for high-speed data transfer and reliable backups.');
-- HDD
INSERT INTO `eproject`.`products` (
  `productName`, `imageLink`, `unitPrice`, `quantity`, `categoryID`, `brandID`,
  `memory`, `speed`, `color`, `warranty`, `dimension`, `description`
) VALUES
  ('Transcend HDD 500GB', 'https://m.media-amazon.com/images/W/MEDIAX_792452-T2/images/I/81BZop9qY1L._AC_UF1000,1000_QL80_.jpg', 59.99, 50, 1, 6, '500GB', '7200 RPM', 'Black', '2 years', '10x7x2 cm', 'With fast transfer speeds, massive storage capacity, and three layers of shock protection, the StoreJet 25M3 USB 3.0 portable hard drive is an ideal storage device for daily backups, archives, and file transfers. believe.'),
  ('Transcend HDD 1TB', 'https://vitinhlehuy.com/upload/images/500x500/617a453e718f5_lehuycomputer.png', 79.99, 40,1, 6, '1TB', '7200 RPM', 'Black', '2 years', '10x7x2 cm', 'With fast transfer speeds, massive storage capacity, and three layers of shock protection, the StoreJet 25M3 USB 3.0 portable hard drive is an ideal storage device for daily backups, archives, and file transfers. believe.'),
  ('Transcend HDD 2TB', 'https://bizweb.dktcdn.net/100/329/122/products/25m3s-2tb.jpg?v=1683012681160', 109.99, 30, 1, 6, '2TB', '7200 RPM', 'Black', '3 years', '10x7x2 cm', 'Massive 2TB HDD with 7200 RPM for ample storage space and reliable performance.'),
  ('Transcend HDD 4TB', 'https://bizweb.dktcdn.net/100/329/122/products/25m3s-4tb-02.jpg?v=1683012671820', 159.99, 20, 1, 6, '4TB', '7200 RPM', 'Black', '3 years', '10x7x2 cm', 'Ultra-large 4TB HDD with 7200 RPM for high-capacity and high-speed data storage.');
-- SSD
INSERT INTO `eproject`.`products` (
  `productName`, `imageLink`, `unitPrice`, `quantity`, `categoryID`, `brandID`,
  `memory`, `speed`, `color`, `warranty`, `dimension`, `description`
) VALUES
  ('Transcend SSD 240GB', 'https://www.oempcworld.com/mm5/graphics/00000001/501518.jpg', 69.99, 50, 5, 6, '240GB', 'SATA III', 'Silver', '3 years', '7x5x0.7 cm', 'High-speed 240GB SSD with SATA III interface for improved system performance.'),
  ('Transcend SSD 500GB', 'https://m.media-amazon.com/images/W/MEDIAX_792452-T2/images/I/51kIAI6RhFL.jpg', 99.99, 40, 5, 6, '500GB', 'SATA III', 'Silver', '3 years', '7x5x0.7 cm', 'Large-capacity 500GB SSD with SATA III interface for fast data access and storage.'),
  ('Transcend SSD 1TB', 'https://nguyencongpc.vn/media/product/20166-transcend-220q-1tb-4.jpg', 159.99, 30, 5, 6, '1TB', 'SATA III', 'Silver', '5 years', '7x5x0.7 cm', 'Massive 1TB SSD with SATA III interface for ultra-fast data transfer and reliability.'),
  ('Transcend SSD 2TB', 'https://cdn-amz.woka.io/images/I/71Y+ESEz25L.SS400.jpg', 259.99, 20, 5, 6, '2TB', 'NVMe PCIe Gen3 x4', 'Silver', '5 years', '7x5x0.7 cm', 'Ultra-large 2TB SSD with NVMe PCIe Gen3 x4 interface for extreme performance and storage capacity.');