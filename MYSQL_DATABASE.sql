-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 13, 2023 at 03:34 PM
-- Server version: 8.0.33
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MYSQL_DATABASE`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `surname`, `email`, `password`, `date_created`, `phone`) VALUES
(2, 'Admin', 'Admin', 'admin@onlinecars.com', '$2y$10$VqmASQzNMDW8Sbc3PPvWvuA/0E8BdZqlHJ8R0jdJukkDjha4Dcu2K', '2023-05-17 13:27:55', '0659133402');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int NOT NULL,
  `model` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year` int NOT NULL,
  `description` text NOT NULL,
  `mileage` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `maker` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fuel` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `engine_capacity` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `transmission` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `company_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `currency` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` text NOT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `model`, `type`, `color`, `year`, `description`, `mileage`, `price`, `image`, `date_created`, `maker`, `fuel`, `engine_capacity`, `transmission`, `company_name`, `currency`, `url`, `country`, `status`) VALUES
(2, 'Polo GTI', 'Hatch back', 'Red', 2023, 'The VW Polo GTI is a high-performance version of Volkswagen\'s popular Polo model. It boasts a sporty and stylish design with a powerful 2.0-liter turbocharged engine that produces up to 200 horsepower. The Polo GTI also comes with advanced technology and features such as a digital cockpit, touchscreen infotainment system, and advanced driver assistance systems.', '19', 599900, 'VW-Polo-GTI-2023-polo-2022-gt.jpg', '2023-04-23 05:23:27', 'VW', 'Petrol', '2-litre', 'Automatic', 'Cars.co.za', 'R', 'https://www.cars.co.za/for-sale/new/2023-Volkswagen-Polo-2.0-GTI-Auto-147kW-Kwazulu-Natal-Ballito/8655715/', 'South Africa', 1),
(3, 'sDrive18i xLine', 'SUV', 'White', 2022, 'Interior equipped with high-quality materials &amp; innovations such as the BMW Curved Display. Clearly structured design language on the exterior for a sporty and self-assured presence.', '0', 689990, 'BMW-sDrive18i-xLine-2022-bmw_x1.png', '2023-04-23 17:21:29', 'BMW', 'Petrol', '1.5L Turbo 3', 'Automatic', 'Cars.co.za', 'R', 'https://www.cars.co.za/for-sale/used/2022-BMW-X1-BMW-X1-sDrive18i-M-Sport-Kwazulu-Natal-Umhlanga-Rocks/8544814/', 'South Africa', 1),
(4, 'Corolla Cross', 'SUV', 'Silver', 2023, 'The Toyota Corolla Cross is a compact crossover SUV that offers practicality, reliability, and versatility. It features a stylish exterior design, comfortable and spacious interior, advanced safety and driver-assistance technologies, and a fuel-efficient hybrid powertrain. The Corolla Cross is a perfect choice for small families or individuals who want a reliable, affordable, and practical vehicle for their daily commute and weekend adventures.', '0', 589950, 'Toyota-Corolla-Cross-2023-Crop800x600.jpeg', '2023-04-24 01:47:13', 'Toyota', 'Hybrid', '1.8L', 'Automatic', 'Autotrader', 'R', 'https://www.autotrader.co.za/car-for-sale/toyota/corolla-cross/xr/26917140?vf=2&amp;db=1&amp;s360=0&amp;so=1&amp;pl=1&amp;pr=5&amp;po=1', 'South Africa', 1),
(5, 'Grand Vitara', 'SUV', 'White', 2023, 'AutoTrader has established itself as a source of the most up to date information on Suzuki Grand Vitara 1.5 cars for sale. Buying your ideal Suzuki Grand Vitara 1.5 has never been easier, with our search and compare service, we ensure you find the perfect car for you.', '0', 397900, 'Suzuki-Grand-Vitara-2023-suz.jpeg', '2023-04-24 01:54:32', 'Suzuki', 'Petrol', '1.5L', 'Manual', 'Autotrader', 'R', 'https://www.autotrader.co.za/car-research/spec/suzuki/grand-vitara/1.5/766797', 'South Africa', 1),
(6, 'Golf R', 'Hatch back', 'Blue', 2023, 'Researching a 2023 Volkswagen Golf R? Get news, reviews, specifications and more on the 2023 Volkswagen Golf R from the reliable experts - AutoTrader South Africa', '0', 912800, 'VW-Golf-R-2023-golf-r.jpeg', '2023-04-24 01:59:53', 'VW', 'Petrol', '2L', 'Manual', 'Autotrader', 'R', 'https://www.autotrader.co.za/car-research/spec/volkswagen/golf/r/766796', 'South Africa', 1),
(7, 'Ix1 Xdrive30 Xline', 'SUV', 'White', 2022, 'Researching a 2023 BMW Ix1 Xdrive30? Get news, reviews, specifications and more on the 2023 BMW Ix1 Xdrive30 from the reliable experts - AutoTrader South Africa.', '0', 1140000, 'BMW-Ix1-Xdrive30-Xline-2022-23606845.jpeg', '2023-04-24 02:04:39', 'BMW', 'Electric', 'Electric', 'Manual', 'Autotrader', 'R', 'https://www.autotrader.co.za/car-research/spec/bmw/ix1/xdrive30/753012', 'South Africa', 1),
(8, 'Polo Vivo', 'Hatch back', 'Maroon', 2022, 'Researching a 2023 Volkswagen Polo Vivo GT? Get news, reviews, specifications and more on the 2023 Volkswagen Polo Vivo GT from the reliable experts - AutoTrader South Africa.', '0', 332800, 'VW-Polo-Vivo-2022-23652557.jpeg', '2023-04-24 02:08:57', 'VW', 'Petrol', '1-litre', 'Manual', 'Autotrader', 'R', 'https://www.autotrader.co.za/car-research/spec/volkswagen/polo-vivo/gt/752299', 'South Africa', 1),
(9, '2 Series Gran Coupe', 'Coupe', 'Black', 2021, 'The BMW 2 Series Gran Coupe is a compact luxury sedan that combines the practicality of a four-door car with the sporty driving experience that BMW is known for. It features a sleek exterior design, a spacious and luxurious interior, and a range of powerful and efficient engines. With its agile handling, advanced technology features, and exceptional build quality, the 2 Series Gran Coupe is a popular choice for drivers who want a compact car that delivers a fun and engaging driving experience.', '135', 696900, 'BMW-2-Series-Gran-Coupe-2021-ezgif.com-webp-to-jpg-(2).jpg', '2023-04-24 02:15:55', 'BMW', 'Petrol', '2.0-litre', 'Manual', 'We Buy Cars', 'R', 'https://www.webuycars.co.za/buy-a-car/BMW/2%20Series%20Gran%20Coupe/4DC701471', 'South Africa', 1),
(10, 'F-Type', 'Coupe', 'White', 2022, 'The Jaguar F-Type is a two-seater sports car that is available as a coupe or convertible. It boasts a sleek and aggressive exterior design, with a luxurious interior featuring premium materials and advanced technology. The F-Type is available with a range of powerful engines, including a V6 and V8, and offers a dynamic driving experience with sharp handling and impressive acceleration. It\'s a stylish and exhilarating car that appeals to enthusiasts who seek both performance and luxury.', '254', 1261900, 'Jaguar-F-Type-2022-ezgif.com-webp-to-jpg-(3).jpg', '2023-04-24 02:23:56', 'Jaguar', 'Petrol', '3L', 'Automatic', 'We Buy Cars', 'R', 'https://www.webuycars.co.za/buy-a-car/593912246', 'South Africa', 1),
(11, 'Q3', 'Hatch back', 'Beige', 2013, 'The Audi Q3 is a compact luxury SUV that offers a sleek design, sporty handling, and advanced technology features. It features a roomy and well-crafted interior, with comfortable seating and plenty of cargo space. Available with either front-wheel or all-wheel drive, the Q3 is powered by a 2.0-liter turbocharged engine that delivers smooth and responsive performance. It also comes with a range of advanced safety features, such as automatic emergency braking and lane departure warning. Overall, the Audi Q3 is a stylish and practical option for those seeking a premium compact SUV.', '158000', 170900, 'Audi-Q3-2013-ezgif.com-webp-to-jpg-(4).jpg', '2023-04-24 02:39:59', 'Audi', 'Petrol', '2-litre', 'Automatic', 'We Buy Cars', 'R', 'https://www.webuycars.co.za/buy-a-car/Audi/Q3/72AF00888', 'South Africa', 1),
(12, 'KUV', 'SUV', 'White', 2022, 'The Mahindra KUV100 is a subcompact SUV designed for urban driving. It features a unique design with its signature vertical grille and aggressive styling. The KUV100 is equipped with a 1.2-liter petrol engine and a 1.2-liter diesel engine, offering good fuel efficiency. It also features a spacious interior and advanced safety features like ABS and dual front airbags. Overall, the Mahindra KUV100 is a practical and stylish option for city driving.', '3000', 168900, 'Mahindra-KUV-2022-ezgif.com-webp-to-jpg-(5).jpg', '2023-04-24 02:45:12', 'Mahindra', 'Petrol', '2-litre', 'Manual', 'We Buy Cars', 'R', 'https://www.webuycars.co.za/buy-a-car/Mahindra/KUV%20100%20NXT/188E05380', 'South Africa', 1),
(13, 'Challenger SRT Hellcat', 'Sedan', 'Red', 2023, 'The Dodge Challenger SRT Hellcat is a high-performance muscle car powered by a supercharged 6.2-liter V8 engine that produces up to 717 horsepower and 656 lb-ft of torque. It features an aggressive exterior design with a functional hood scoop and dual air intakes, as well as a luxurious interior with high-end materials and advanced technology. The Hellcat also offers a variety of performance upgrades, including a widebody package and adaptive suspension, for an even more exhilarating driving experience.', '100', 69895, 'Dodge-Challenger-SRT-Hellcat-2023-2019-dodge-challenger-srt-hellcat.jpg', '2023-05-01 01:52:42', 'Dodge', 'Petrol', '6.2-L', 'Manual', 'Car and Driver', '$', 'https://www.caranddriver.com/dodge/challenger-srt-srt-hellcat', 'USA', 1),
(14, 'Wrangler', 'SUV', 'Bright White Clearcoat', 2018, 'This Jeep is a certified pre-owned vehicle with 42,916 miles, 4x4 capability, and aluminum wheels. It includes a quick order package with many additional features, such as a 5-speed automatic transmission and Sirius satellite radio. The vehicle also comes with a 7-year/100,000-mile powertrain limited warranty and roadside assistance. The price is reduced from $36,518.', '42916', 31999, 'Jeep-Wrangler-2018-2B5A35MPS2ANFAF4W5CI6JPBNY-cr-540.jpg', '2023-05-05 12:33:39', 'Jeep', 'Petrol', '3.6L V-6', 'Automatic', 'TrueCar', '$', 'https://www.truecar.com/used-cars-for-sale/listing/1C4BJWDGXJL887199/2018-jeep-wrangler/?sponsoredVehiclePosition=0', 'USA', 1),
(15, 'Prius', 'Sedan', 'White', 2010, 'This 2010 Toyota Prius II has a clean title and low mileage of 130,000. It comes fully loaded with options including keyless entry, push start/stop, handsfree system, AUX/USB/BT, and all power features. The car is very reliable and fuel-efficient, making it perfect for students, Uber, and Lyft drivers. It is clean inside and out and comes from a non-smoking, pet-free environment. The car has ice-cold A/C and runs and drives excellent. Contact RELIABLE AUTO SOURCE to learn more about financing, delivery, and shipping options.', '130678', 9991, 'Toyota-Prius-2010-ML2SSA2YCNAL6WPOQFTMYJKFGE-cr-860.jpg', '2023-05-05 12:47:52', 'Toyota', 'Petrol', '1.8L Inline-4 Hybrid', 'Manual', 'TrueCar', '$', 'https://www.truecar.com/used-cars-for-sale/listing/JTDKN3DU2A0027744/2010-toyota-prius/', 'USA', 1),
(16, 'F-150', 'Crew Cab', 'White Platinum Metallic Tri-Coat', 2012, 'This 2012 Ford F-150 Platinum 4WD is part of the Value Direct Program and has not been inspected. It comes equipped with ABS brakes, alloy wheels, AM/FM radio: SIRIUS, electronic stability control, and other features. The vehicle is finished in White Platinum Metallic Tri-Coat and has an odometer reading 34,941 miles below the market average. The dealership, Principle Volvo Cars of San Antonio, is committed to building strong relationships and providing exceptional care to its customers. They offer access to the Volvo brand in San Antonio and other areas in South Texas since 1990.', '108479', 19500, 'Ford-F-150-2012-3UKCDH4RBAS6LZBPFW73LHKD2E-cr-540.jpg', '2023-05-05 12:56:09', 'Ford', 'Petrol', '3.5L V-6 Gas Turbocharged', 'Automatic', 'TrueCar', '$', 'https://www.truecar.com/used-cars-for-sale/listing/1FTFW1ET4CFB84068/2012-ford-f-150/', 'USA', 1),
(17, 'Corolla 130 GLE', 'Sedan', 'Green', 1996, 'Used 1996 Toyota Corolla 130 GLE with 393 000km for sale in Gauteng for R 32 900', '393000', 32900, 'Toyota-Corolla-130-GLE-1996-Toyota-Corolla-130-GLE-1.jpg', '2023-05-06 22:56:57', 'Toyota', 'Petrol', '1.3L', 'Manual', 'Carfind.co.za', 'R', 'https://www.carfind.co.za/cars-for-sale/listing/Toyota-Corolla-130-GLE/6222036', 'South Africa', 1),
(18, 'Tazz 130', 'Hatch Back', 'White', 2005, 'Used 2005 Toyota Tazz 130 with 178 000km for sale in Western Cape for R 55 900.', '55900', 55900, 'Toyota-Tazz-130-2005-53A0101310.jpeg', '2023-05-06 23:10:08', 'Toyota', 'Petrol', '1.3L', 'Manual', 'Carfind.co.za', 'R', 'https://www.carfind.co.za/cars-for-sale/listing/Toyota-Tazz-130/6217111', 'South Africa', 1),
(19, 'Golf 1.4TSI Comfortline', 'Hatch back', 'Silver', 2015, 'The Volkswagen Golf 1.4TSI Comfortline is a reliable and efficient compact car that boasts a 1.4-liter turbocharged engine with a six-speed manual or seven-speed automatic transmission. The car has a comfortable interior with plenty of legroom and cargo space, and comes equipped with a range of advanced safety and convenience features. Overall, it&#039;s a practical and enjoyable car to drive.', '250000', 149900, 'VW-Golf-1.4TSI-Comfortline-2015-405gzp2ilh8yuxbv.jpeg', '2023-05-09 13:41:43', 'VW', 'Petrol', '1.4L', 'Automatic', 'Carzuka', 'R', 'https://www.carzuka.co.za/vehicle/used/volkswagen/golf/1-4tsi-comfortline/sandton/92345?origin=buy', 'South Africa', 1),
(20, 'Fiesta 1.0T Trend auto', 'Hatch back', 'White', 2019, 'The Ford Fiesta 1.0T Trend auto is a stylish and sporty subcompact car that features a 1.0-liter turbocharged engine with a six-speed automatic transmission. The car has a sleek exterior design and a comfortable, modern interior with a range of advanced features such as a touchscreen infotainment system, rearview camera, and automatic climate control. With its agile handling and fuel-efficient engine, the Fiesta is a fun and practical car for everyday driving.', '50000', 229900, 'Ford-Fiesta-1.0T-Trend-auto-2019-405gzp2ilhef68xj.jpeg', '2023-05-09 13:49:47', 'Ford', 'Petrol', '1.0-litre', 'Automatic', 'Carzuka', 'R', 'https://www.carzuka.co.za/vehicle/used/ford/fiesta/1-0t-trend-auto/johannesburg/92384?origin=buy', 'South Africa', 1),
(21, 'H2 1.5T Luxury auto', 'SUV', 'Red', 2021, 'The Haval H2 1.5T Luxury auto is a sleek and stylish compact SUV that features a 1.5-liter turbocharged engine with a six-speed automatic transmission. The car has a modern and comfortable interior with leather seats, a touchscreen infotainment system, and a panoramic sunroof. The H2 also comes equipped with a range of advanced safety features such as blind spot monitoring, lane departure warning, and a 360-degree camera system. With its combination of style, comfort, and safety, the Haval H2 is a great choice for drivers looking for a practical and affordable SUV.', '50000', 319900, 'Haval-H2-1.5T-Luxury-auto-2021-405gzp2rlhecrhf1.jpeg', '2023-05-09 13:56:08', 'Haval', 'Petrol', '1.5L', 'Automatic', 'Carzuka', 'R', 'https://www.carzuka.co.za/vehicle/used/haval/h2/1-5t-luxury-auto/johannesburg/92378?origin=buy', 'South Africa', 1),
(22, '4 Series 420d coupe M Sport auto', 'Coupe', 'White', 2014, 'The BMW 4 Series 420d Coupe M Sport auto is a sleek and sporty luxury car that features a 2.0-liter turbocharged diesel engine with an eight-speed automatic transmission. The car has a dynamic exterior design with sharp lines and a low, aggressive stance. Inside, the car boasts a modern and luxurious interior with leather seats, a digital instrument cluster, and a touchscreen infotainment system with BMW&#039;s iDrive 7.0. The M Sport package adds performance upgrades such as larger brakes and sport-tuned suspension, as well as cosmetic enhancements. With its combination of luxury, performance, and style, the BMW 4 Series 420d Coupe M Sport auto is a great choice for drivers looking for a premium driving experience.', '211000', 229900, 'BMW-4-Series-420d-coupe-M-Sport-auto-2014-405gzp34lhfxe61s.jpeg', '2023-05-09 14:01:55', 'BMW', 'Diesel', '2-litre', 'Automatic', 'Carzuka', 'R', 'https://www.carzuka.co.za/vehicle/used/bmw/4-series/420d-coupe-m-sport-auto/sandton/92388?origin=buy', 'South Africa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `surname`, `email`, `phone`, `address`, `province`, `password`, `date_created`, `status`, `last_login`) VALUES
(1, 'Ntungufhadzeni', 'Mbudzeni', 'mbudzenin@yahoo.com', '0797983145', '11 Thora Cres\r\nWynberg', 'Gauteng', '$2y$10$xtHtPCMrIZb31FGgSRzXG.mHVaofWyCs/Qu5AnwZVCiDM7xOUD116', '2023-04-22 19:40:45', 1, '2023-06-13 15:15:26'),
(2, 'BOITSHOKO', 'KHALO', 'boitshokokhalo@gmail.com', '0812689697', '2946 TEMBA\r\nManyel\r\nLUCAS MANGOPE', 'Gauteng', '$2y$10$gNERHPzG.rN7EniMWPidx.Muy4th2Y6G7UxLMnrE5TEOHJzwq.oiG', '2023-05-07 09:02:16', 1, '2023-06-13 15:15:26'),
(3, 'Matshipi Gift', 'Ramaila', 'MPHO13487@GMAIL.COM', '0798317306', '13487 Street 32\r\nStretford Ext 8', 'Gauteng', '$2y$10$KdbVJFHJ.dBdbeTk3UfAhOKtOoqsnCnQbPa0dMdJID4A7SudZujNS', '2023-05-08 10:07:06', 1, '2023-06-13 15:15:26'),
(4, 'Lebo', 'Raphela', 'leborobynlr1@gmail.com', '0677132638', '226 East Street', 'Gauteng', '$2y$10$7/BXJOOsMmR5SaIX14KovOOSTtJOkHcAn2QUNTYYdaKErQ5TsLhMC', '2023-05-08 11:55:51', 1, '2023-06-13 15:15:26'),
(5, 'Sie', 'Shiburi', 'sie123@gmail.com', '0739138220', '332 MAPUVE\r\nMAPUVE', 'Limpopo', '$2y$10$zPc3qv7flZ0Objrc2ikihuLAo7BW5QwQpf0eiX76wjfWACiyTlUY6', '2023-05-18 13:05:11', 1, '2023-06-13 15:15:26'),
(6, 'thabo', 'mbeki', 'mbeki@gmail.com', '0123829267', '12 College Road\r\nSosha', 'Gauteng', '$2y$10$9kJMYU1jOtxP24CvV2p69uultK.BJGGcL4BA4wIlkIzYkEcSE37e2', '2023-05-23 09:39:10', 1, '2023-06-13 15:15:26'),
(7, 'Brian', 'Mbatha', 'brianmbatha930@gmail.com', '0823087983', 'Madadeni Section 7 L563', 'KwaZulu-Natal', '$2y$10$rYGeskk2MjtCjkfRMHtGyedO9TY/J/6MVFLoX1umdYJ9RJAet9Njy', '2023-05-24 16:56:44', 1, '2023-06-13 15:15:26'),
(8, 'rams', 'ramaila', 'rams123@gmail.com', '0798317305', '13487 Nkounwane', 'Free State', '$2y$10$Tck8oiNxGwitMeTaffLDwuRdaiX8Efhx7515dvzxl6VwdxbfrDbjW', '2023-06-13 12:18:49', 1, '2023-06-13 15:15:26'),
(9, 'Nqobile', 'Biyela', 'nqobilebiyela123@gmail.com', '0725522442', '234 Ladysmith Glen Road', 'KwaZulu-Natal', '$2y$10$/V/jNSu3CYtdojcY2kNX9uEbUp4NWFiQ3fwRbRNHfQdxs3J6qIKTu', '2023-06-13 12:27:24', 1, '2023-06-13 15:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `debit_card`
--

CREATE TABLE `debit_card` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `card_holder` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cvc` int NOT NULL,
  `exp_month` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `exp_year` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `card_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `card_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `debit_card`
--

INSERT INTO `debit_card` (`id`, `customer_id`, `card_holder`, `cvc`, `exp_month`, `exp_year`, `email`, `date_created`, `card_number`, `card_type`) VALUES
(100000, 9, 'Lebogang Raphela', 311, '06', '2026', 'leborobynlrl1@gmail.com', '2023-06-13 13:06:24', '5217489633334582', 'MasterCard');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `car_id` int NOT NULL,
  `shipping_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `shipping_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `shipping_phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `shipping_address` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `payment_method` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `car_id`, `shipping_name`, `shipping_email`, `shipping_phone`, `shipping_address`, `payment_method`, `date_created`, `customer_id`) VALUES
(100006, 13, 'Brian Mbatha', 'brianmbatha930@gmail.com', '0823087983', '                            Madadeni Section 7 L563                        ', 'Bank Deposit', '2023-06-13 12:01:10', 7),
(100007, 15, 'Brian Mbatha', 'brianmbatha930@gmail.com', '0823087983', '                            Madadeni Section 7 L563                        ', 'Debit/Credit Card', '2023-06-13 12:10:31', 7),
(100008, 14, 'rams ramaila', 'rams123@gmail.com', '0798317305', '                            13487 Nkounwane                        ', 'Debit/Credit Card', '2023-06-13 12:22:07', 8),
(100009, 16, 'Nqobile Biyela', 'nqobilebiyela123@gmail.com', '0725522442', '                            234 Ladysmith Glen Road                        ', 'Bank Deposit', '2023-06-13 12:28:14', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `Customer_id` int NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debit_card`
--
ALTER TABLE `debit_card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer` (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_customer` (`customer_id`),
  ADD KEY `fk_car` (`car_id`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `debit_card`
--
ALTER TABLE `debit_card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100001;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100010;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `debit_card`
--
ALTER TABLE `debit_card`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_car` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_orders_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
