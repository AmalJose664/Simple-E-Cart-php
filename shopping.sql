-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 03:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `quantity`, `price`, `total_price`) VALUES
(15, 5004, 9045, 1, 21119.56, 21119.56),
(16, 5004, 9036, 1, 22495.50, 22495.50),
(17, 5004, 9022, 1, 34875.45, 34875.45),
(19, 5004, 9040, 1, 36079.12, 36079.12),
(20, 5004, 9016, 1, 54990.00, 54990.00),
(21, 5004, 9038, 1, 15309.00, 15309.00),
(22, 5004, 9017, 1, 50243.30, 50243.30),
(23, 5004, 9033, 1, 101249.25, 101249.25),
(26, 5005, 9034, 1, 11000.00, 11000.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `oit_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`oit_id`, `order_id`, `user_id`, `item_id`, `quantity`) VALUES
(2035, 8, 5004, 9017, 1),
(2036, 8, 5004, 9018, 1),
(2037, 9, 5004, 9021, 1),
(2038, 9, 5004, 9020, 1),
(2039, 10, 5004, 9045, 1),
(2040, 1147483648, 5004, 9041, 1),
(2041, 1147483649, 5004, 9025, 1),
(2042, 1147483650, 5005, 9023, 1),
(2043, 1147483651, 5005, 9034, 2),
(2044, 1147483652, 5005, 9016, 1),
(2045, 1147483653, 5203, 9025, 1),
(2046, 1147483654, 5203, 9033, 1),
(2047, 1147483655, 5203, 9033, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pro_name` text NOT NULL,
  `pro_simple_name` varchar(30) NOT NULL,
  `pro_price` decimal(10,2) NOT NULL,
  `pro_discount_price` decimal(10,2) NOT NULL,
  `pro_type` varchar(20) NOT NULL,
  `pro_brand` varchar(20) NOT NULL,
  `pro_stocks` int(11) NOT NULL,
  `pro_description` text NOT NULL,
  `pro_src` varchar(30) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pro_name`, `pro_simple_name`, `pro_price`, `pro_discount_price`, `pro_type`, `pro_brand`, `pro_stocks`, `pro_description`, `pro_src`, `added_date`) VALUES
(9016, 'Infinix Y3 Max Series Intel Core i3 12th Gen 1215U - (16 GB/256 GB SSD/Windows 11 Home) YL613 Thin and Light Laptop  (16 Inch, Silver, 1.78 Kg)', 'Infinix Y3 Max Serie....', 54990.00, 54990.00, 'laptop', 'dell', 31, 'The Infinix Y3 Max Series laptop is a blend of style and performance, featuring a 40.64 cm (16) FHD+ display with a 16:10 aspect ratio for immersive visuals. Its slim 18 mm aluminum alloy body is lightweight at 1.78 kg, combining durability with elegance. Powered by 12th Gen Intel Core processors, up to 16GB RAM, and 512GB SSD, it offers seamless multitasking and fast performance. The 70 Wh battery provides up to 8 hours of usage, while 65W fast charging ensures quick recharges. With WiFi 6, a 1080P FHD+ camera, and Windows 11, it\'s ideal for modern users.    ', '60b293c1c12bf0d4cbf8.webp', '2024-12-28'),
(9017, 'ASUS TUF Gaming F15 - AI Powered Gaming Intel Core i5 11th Gen 11400H - (8 GB/512 GB SSD/Windows 11 Home/4 GB Graphics/NVIDIA GeForce RTX 2050/144 Hz/70 TGP) FX506HF-HN024W Gaming Laptop  (15.6 Inch, Graphite Black, 2.30 kg)', 'ASUS TUF Gaming F15 ....', 74990.00, 50243.30, 'laptop', 'asus', 31, '\r\nThe Asus TUF Gaming F15 is a feature-packed laptop that is perfect for all your gaming needs. Powered by the 11th Gen Intel Core H-series CPU and GeForce RTX 2050 GPU so that you can engage in immersive gaming sessions every time. The NVIDIA RTX ensures to create life-like visuals for your intense gaming sessions. It features four heatpipes and two heatsinks to prevent your system from overheating so that you can concentrate more on your games. It has a refresh rate of 144 Hz so that you can have a lag-free and smooth gaming experience. This laptop has everything a gamer needs from lightweight and stunning design to long-lasting battery so that you can indulge in prolonged gaming sessions without worrying about recharging every now and then.', 'e719686292539e4f0adb.webp', '2024-12-28'),
(9018, 'Apple MacBook AIR Apple M2 - (8 GB/256 GB SSD/Mac OS Monterey) MLY13HN/A  (13.6 Inch, Starlight, 1.24 kg)', 'Apple MacBook AIR Ap....', 99900.00, 73926.00, 'laptop', 'mac', 42, '\r\nCharged in a blazing-fast speed with the next-level M2 chip, this redesigned Apple’s notebook comes with mind blowing and has an excellent battery backup that can last up to 18 hours, which comes with an aluminium enclosure.', '1838404589c27ce93586.webp', '2024-12-28'),
(9019, 'Motorola G85 5G (Viva Magenta, 128 GB)  (8 GB RAM)', 'Motorola G85 5G (Viv....', 20999.00, 18059.14, 'mobile', 'motorolo', 20, 'Experience the first moto g with groundbreaking endless edge display with the advanced display technology The moto g85 5G, features an impressive 3D Curved Display. This engineering marvel boasts a 120 Hz pOLED screen protected by extremely durable Corning Gorilla Glass 5. The elegantly curved display provides an immersive viewing experience that goes beyond traditional flat screens. Indulge in captivating entertainment on a 16.67 cm pOLED FHD+ ultra-vivid display that has deeper blacks, bringing images to life with life-like clarity. The cinematic Billion Colour 10-Bit Display with 100% DCI-P3 works its magic to bring every moment to life and SGS eye protection gives added protection to your eyes.', 'be0ba08bdcd311a2da07.webp', '2024-12-28'),
(9020, 'POCO M7 Pro 5G (Lavender Frost, 128 GB)  (6 GB RAM)', 'POCO M7 Pro 5G (Lave....', 18999.00, 15009.21, 'mobile', 'xiaomi', 64, 'MTK Dimensity 7025 Ultra\r\nEnjoy lightning-fast performance for gaming, multitasking, and browsing, powered by an advanced, efficient processor.\r\n\r\n\r\n2100 nits Peak Brightness AMOLED Display\r\nStay Lit, literally! Enjoy vibrant, crystal-clear visuals even under the brightest sunlight, whether you\'re relaxing outdoors or catching up on your favorite sport', 'b19217627aca3edfbf1a.webp', '2024-12-28'),
(9022, 'DELL Inspiron 3520 Intel Core i3 12th Gen 1215U - (8 GB/512 GB SSD/Windows 11 Home) New Inspiron 15 Laptop | Inspiron 3520 Thin and Light Laptop  (15.6 Inch, Platinum Silver, 1.65 Kg, With MS Office)', 'DELL Inspiron 3520 I....', 61185.00, 34875.45, 'laptop', 'dell', 43, '\r\nFull HD WVA AG Display\r\nSporting a 39.624 cm (15.6) Full HD WVA AG Anti-Glare display, this laptop delivers impressive visual clarity and smooth performance. The anti-glare feature reduces reflections, making it suitable for use in various lighting conditions without causing eye strain. Whether you\'re watching movies, editing photos, or browsing the web, the vibrant display enhances your viewing experience.\r\nStylish and Portable Design\r\nAs the DELL Inspiron 3520 laptop boasts a stylish and portable design, it is an ideal choice for users who prioritise both aesthetics and convenience. With its sleek profile and lightweight build, it offers effortless portability, allowing users to carry it comfortably wherever they go. Whether you\'re commuting to work, attending classes, or working from home, this laptop\'s design ensures you can do so with ease and style', 'cafda78b55cc0cfb1cc6.jpg', '2024-12-28'),
(9023, 'Boult Flex 80Hrs Battery, ENC Mic, 40mm Boosted Drivers, 4EQ Modes, Supreme Bass, 5.4v Bluetooth & Wired  (Black, On the Ear)', 'Boult Flex 80Hrs Bat....', 5499.00, 1924.65, 'headphones', 'boult', 57, '\r\nThe Boult Flex Headphones are designed for an immersive audio experience with 40mm bass-boosted drivers, delivering deep bass and pure clarity through BoomX technology and AAC/SBC codec support. With 4 EQ modes (Bass, Rock, Pop, Vocal), you can tailor the sound to your vibe. Enjoy seamless connectivity with Bluetooth 5.4 and Blink & Pair technology, ensuring the fastest pairing every time. The ZEN ENC Mic provides unmatched clarity for calls, while 16-bit DSP ensures every note is engineered to perfection. With up to 80 hours of battery life, 60ms low latency Combat gaming mode, and IPX5 water resistance, these headphones are built for comfort, power, and performance. Switch between wired and wireless modes effortlessly and enjoy voice assistant support with Google Assistant and Siri.', 'a6e26f48117c0a40f00b.webp', '2024-12-28'),
(9024, 'ZEBRONICS Zeb- Thunder, With 60H Backup, BT v5.3, Gaming Mode, ENC, AUX, mSD, Dual Pairing Bluetooth  (Black, On the Ear)', 'ZEBRONICS Zeb- Thund....', 1699.00, 815.52, 'headphones', 'zebronics', 86, 'Incredible Audio\r\nIf you are fond of headphones that come in exciting colours to match your outfit, then opt for the ZEB-Thunder headphones launched in 4 different vibrant colour combinations.\r\n\r\nLonger Playtime\r\nImmerse yourself in the ultimate gaming adventure with the Zeb-Thunder headphones, ensuring a lag-free experience. With a built-in rechargeable battery, these headphones provide an astounding 60 hours(at 50% volume) of continuous play, keeping the fun going for longer periods.', '784e22eecbde77a8a147.webp', '2024-12-28'),
(9025, 'Boult Flex 80Hrs Battery, ENC Mic, 40mm Boosted Drivers, 4EQ Modes, Supreme Bass, 5.4v Bluetooth & Wired  (Blue, On the Ear)', 'Boult Flex 80Hrs Bat....', 5499.00, 2034.63, 'headphones', 'boult', 63, 'The Boult Flex Headphones are designed for an immersive audio experience with 40mm bass-boosted drivers, delivering deep bass and pure clarity through BoomX technology and AAC/SBC codec support. With 4 EQ modes (Bass, Rock, Pop, Vocal), you can tailor the sound to your vibe. Enjoy seamless connectivity with Bluetooth 5.4 and Blink & Pair technology, ensuring the fastest pairing every time. The ZEN ENC Mic provides unmatched clarity for calls, while 16-bit DSP ensures every note is engineered to perfection. With up to 80 hours of battery life, 60ms low latency Combat gaming mode, and IPX5 water resistance, these headphones are built for comfort, power, and performance. Switch between wired and wireless modes effortlessly and enjoy voice assistant support with Google Assistant and Siri.', 'caee6722467b786bdb56.webp', '2024-12-28'),
(9026, 'Apple Watch Series 10 GPS 46mm Jet Black Aluminium with Black Sport Band  (Jet Black Strap, Free Size)', 'Apple Watch Series 1....', 49900.00, 49900.00, 'smartwatch', 'apple', 74, 'Amazing product, Big screen and really good battery life. Newest OS has really good features. Note all the bigger sizes of previous gen apple watch fit series 10 big size. For example my old series 3 42mm band size fits 46mm series 10 fit perfectly. I had more than 10 bands now i can use them with my new watch', '104045dabc7810646598.webp', '2024-12-28'),
(9027, 'Apple Watch Series 9 GPS 45mm Aluminium Case with Sport Band - S/M  (Midnight Strap, Free Size)', 'Apple Watch Series 9....', 44900.00, 28287.00, 'smartwatch', 'apple', 32, '\r\nSeries 9 helps you stay connected, active, healthy, and safe. Featuring double tap, a magical way to interact witWatch, and an even-brighter display.\r\n\r\nElegance and Functionality\r\nOffering an excellent fusion of style and practicality, the Apple Watch Series 9 is an exceptional addition to your smartwatch repertoire. Beyond being a fashionable accessory, this sophisticated wearable is a robust choice for those leading an active lifestyle.\r\n\r\nRobust Craftsmanship\r\nWith its vibrant always-on Retina display, this smartwatch allows you to effortlessly check the time, notifications, and fitness metrics with a single glance. The display, characterised by its brightness and energy efficiency, contributes to extended battery life. Additionally, the smartwatch\'s high water resistance ensures it remains a reliable choice during water-related activities or intense workouts.', 'b7d3cad2d6a147368a8e.webp', '2024-12-28'),
(9028, 'Boult Crown 1.95\'\' Screen, BT Calling, Working Crown, Zinc Alloy Frame, 900 Nits, SpO2 Smartwatch  (Black Strap, Free Size)', 'Boult Crown 1.95\'\'....', 4499.00, 1439.68, 'smartwatch', 'boat', 43, 'Prepare to conquer it all with the king of smartwatches, Boult Crown. Crafted with a premium zinc alloy frame, this watch is designed to accompany you on every adventure. With its grand 1.95\" HD Display and 900 Nits Brightness, the Crown smartwatch truly stands majestic. Experience supreme connectivity with Bluetooth 5.2, while the dedicated speaker and mic enable seamless single-chip Bluetooth calling. Rule every style with over 150 watch faces, and let the stunning smartwatch be an extension of your personality. Train like a true king, with Crown\'s 100+ sports modes to track your progress and motivate you toward your goals. No need to worry about water damage, as Crown is IP67 dust and water-resistant, making it ready to dominate every terrain.', '3423cf1569a575bbbdd1.webp', '2024-12-28'),
(9029, 'SONY ULT WEAR Noise Cancelling with Massive Bass & Comfortable Design Bluetooth  (Forest Gray, On the Ear)', 'SONY ULT WEAR Noise ....', 24990.00, 14994.00, 'headphones', 'sony', 71, 'The Sony Bluetooth Headphone is designed to elevate your music experience with its ULT Power Sound feature. You can choose to enhance the bass at your convenience based on your mood by clicking on the ULT button. With the elite noise cancellation and dual noise sensor tech, it provides an immersive audio experience. These headphones have mouldable cushions to provide you with comfortable wear for prolonged periods without hurting your ears. It provides a long-lasting playtime for up to 50 hours continuously on a single charge so that you are ready to hit the day with some good music.', '7055053f502b4a430a90.webp', '2024-12-28'),
(9031, 'Apple New AirPods Max Bluetooth  (Pink, On the Ear)', 'Apple New AirPods Ma....', 59990.00, 59990.00, 'headphones', 'apple', 53, 'AirPods Max reimagine over-ear headphones. An Apple designed dynamic driver provides immersive high fidelity audio. Every detail, from canopy to cushions, has been designed for an exceptional fit. Industry leading Active Noise Cancellation blocks outside noise, while Transparency mode lets it in. And spatial audio with dynamic head tracking provides theatre like sound that surrounds you.', '152e2d1b5653f61c6c4d.webp', '2024-12-28'),
(9032, 'SAMSUNG Galaxy S24 Ultra 5G (Titanium Black, 256 GB)  (12 GB RAM)', 'SAMSUNG Galaxy S24 U....', 134999.00, 122849.09, 'mobile', 'samsung', 75, 'Behold the Samsung Galaxy S24 Ultra smartphone, an exceptional amalgamation of incredible technology and superior sophistication. Whether you\'re typing up a storm or jotting something down, Note Assist makes a long story short. New AI-powered editing options let you get the photo you want, like relocating objects and intelligently filling in the space they left behind. With a durable shield of titanium built right into the frame and better scratch resistance with Corning Gorilla Armor, your IP68 water and dust-resistant Galaxy S24 Ultra is ready for adventure. Write, tap, and navigate with the precision your fingers wish they had on the new, flat display.\r\n\r\n', 'ba8cb257dca210cf7777.webp', '2024-12-28'),
(9033, 'SAMSUNG Galaxy S24 Ultra 5G (Titanium Yellow, 256 GB)  (12 GB RAM)', 'SAMSUNG Galaxy S24 U....', 134999.00, 101249.25, 'mobile', 'samsung', 32, 'Quad Camera Setup: 200MP Wide Angle Camera (f/1.7 Aperture) + 50MP Telephoto Camera (f/3.4 Aperture) + 12MP Ultra Angle Camera (f/2.2 Aperture) + 10MP Telephoto Camera (f/2.4 Aperture), Features: Auto Focus, OIS, Optical Zoom 3X and 5X, Optical Quality Zoom 2X and 10X (Enabled by Adaptive Pixel Sensor), Quad Tele Zoom System, Nightography, Super HDR, Generative Edit, Edit Suggestion', 'ac8f65a7e960a3950b8f.webp', '2024-12-28'),
(9034, 'MOTOROLA 80 cm (32 inch) HD Ready LED Smart Google TV  (32HDGDMBSXP)', 'MOTOROLA 80 cm (32 i....', 20000.00, 11000.00, 'television', 'motorola', 41, 'Set your stage for the ultimate viewing experience on this bezel-less display with the availability of 7 picture modes. This HDR10 TV offers a crystal-clear display and has 16.7 million vibrant colors that provide lifelike images. Furthermore, enjoy your TV time with loud and clear audio powered by Dolby technology and have an immersive experience. Also, this Motorola TV is sleek and comes with 1.5 GB RAM and 8 GB ROM. It has a Mediatek quad-core processor that brings seamless navigation, lets you multitask, and offers ample storage space for all your content. Moreover, with the availability of a built-in Chromecast, you can easily cast your favourite movies, shows, etc., from your phone to your TV and enjoy watching them on the big screen', 'c33dfac309814091c7b6.webp', '2024-12-28'),
(9036, 'MOTOROLA EnvisionX 109 cm (43 inch) Ultra HD (4K) LED Smart Google TV with Inbuilt Box Speakers  (43UHDGDMBSXP)', 'MOTOROLA EnvisionX 1....', 49990.00, 22495.50, 'television', 'motorola', 54, '\r\nThis Motorola HDR10 TV brings to you 6 display modes, 4 sound modes, and 3D Dolby audio. It provides a crystal-clear display and offers 1.07 billion vibrant colours that elevate your entertainment experience. This bezel-less Google TV has a Mediatek quad-core processor that enables seamless navigation. You can mirror your favourite content on the TV screen from your smartphone with the built-in Chromecast feature.\r\n', '11df2bd4ca652df9ee27.webp', '2024-12-28'),
(9037, 'Coocaa 108 cm (43 inch) Full HD LED Smart Coolita TV 2024 Edition with Dolby Audio and Eye Care Technology  (43C3U Plus)', 'Coocaa 108 cm (43 in....', 29999.00, 12599.58, 'television', 'kodak', 54, 'Coocaa TV redefines home entertainment with cutting-edge technology and a sleek, frameless design. Powered by Coolita OS, it offers seamless navigation and effortless control. Enjoy instant connectivity with CC Cast, while Dolby Audio delivers cinematic sound. Eye care technology ensures a comfortable viewing experience with low blue light and flicker-free visuals. Trochilus Extreme enhances picture quality with vibrant colors and lifelike details. Coocaa TV combines style, innovation, and user-friendly features to create an immersive viewing experience, making it the perfect addition to any home. Unleash the future of entertainment with Coocaa TV.', '58d4331ca697df0fd411.webp', '2024-12-28'),
(9038, 'SAMSUNG 80 cm (32 Inch) HD Ready LED Smart Tizen TV with Bezel-Free Design | 300+ Free Channels | PurColor | Hyper Real Picture Engine | Triple Protection | SmartThings App Support | TV Key | Connect Share (HDD) | ConnectShare (USB 2.0)  (UA32T4380AKXXL)', 'SAMSUNG 80 cm (32 In....', 18900.00, 15309.00, 'television', 'samsung', 43, '\r\nWith this Samsung TV, every image on the screen comes to life, giving you a home theatre experience. With the HD visual quality of this TV, you can enjoy vibrant movie scenes. Additionally, HDR increases the screen\'s brightness and brings out the subtleties of the material. Moreover, the Contrast Enhancer on this TV improves contrast and offers superb image quality with increased depth.3-side Bezel-less Design\r\nThanks to the 3-side bezel-less design of this TV, you get more screen space so that you can enjoy an immersive visual experience by being drawn into the beautiful colours.', '0b20630a649ac3c3a7ee.webp', '2024-12-28'),
(9039, 'realme 12x 5G (Coral Red, 128 GB)  (8 GB RAM)', 'realme 12x 5G (Coral....', 18999.00, 13679.28, 'mobile', 'realme', 45, '45 W SUPERVOOC Charge 5000 mAh Massive Battery\r\nIndulge in swift charging with the 45W SUPERVOOC Charge, accompanied by a robust 5000mAh battery for prolonged usage. Enhance your connectivity experience with minimized wait times. The VCVT Intelligent Tuning Algorithm mitigates unnecessary heat loss during charging, and the VFC Trickle Charging Optimization Algorithm boosts efficiency within the 90%-100% charging interval. An intelligent 4-core protection system ensures both efficient charging and top-tier device safety.\r\nDimensity 6100+ 6 nm 5G\r\nFeaturing the advanced 6nm Process Chipset, this device introduces Dual SA Modes for concurrent 5G capabilities on both cards. Experience the efficiency of New Smart 5G technology, optimize signal strength with Super Network Searching, and enjoy the 5G Low Power Smart Hotspot. Elevate your connectivity with this compact powerhouse.', 'faf0e3bfd94e9015e79f.webp', '2024-12-28'),
(9040, 'realme 13 Pro+ 5G (Emerald Green, 512 GB)  (12 GB RAM)', 'realme 13 Pro+ 5G (E....', 40999.00, 36079.12, 'mobile', 'realme', 43, 'Dual Sony Cameras with Dual OIS\r\nIntroducing the Dual 50MP Sony Cameras with Dual OIS, backed by HyperImage+! These advanced cameras feature AIS and OIS to reduce blurring from hand tremors, ensuring stable and clear images. Both primary and telephoto lenses support optical stabilization, minimizing shake and improving the hit rate of sharp images. Capture stunning high dynamic range daylight photos and clear, bright nighttime photos with a high photo shooting success rate and stable video recording, making the realme 13 Pro+ 5G perfect for ultra clarity and stability in every shot.\r\n\r\nSony LYT-600 Periscope & LYT-701\r\nFeaturing the Sony LYT-600 Periscope Sensor, the only periscope telephoto lens in its segment, it boosts light sensitivity by 30% over the 12 Pro+. With the 120X SuperZoom, the realme 13 Pro+ enables ultra-long-distance shooting to capture distant images with clarity. The Sony LYT-701 captures stunning high dynamic range photos in daylight and clear, bright shots at night. With OIS, enjoy sharp photos and stable videos every time!', 'fdd79c0cb8f04a4e9145.webp', '2024-12-28'),
(9041, 'OnePlus Nord Buds 2r in Ear Earbuds with Dual Mic & AI Crystal Clear Call Bluetooth  (Deep Grey, True Wireless)', 'OnePlus Nord Buds 2r....', 2299.00, 2000.13, 'smartwatch', 'oneplus', 73, '\r\nThe buds comes with 12.4mm driver unit, which delivers crisp clear and enhanced bass quality sound experience. It allows users to access a plethora of features while playing supported games on a OnePlus handset. They can be accessed at any time while playing games and give players the option to toggle different features and settings. With the OnePlus Nord Buds 2r, you get to choose how heavy or light you want your sound with the help of sound master equalizer\'s 3 unique audio profiles -Bold, Bass & Balanced.Avoid cutouts and broken audio while gaming with Bluetooth 5.3 transmission and 94ms low latency. The flagship-level battery life for the all-new OnePlus Nord Buds 2r delivers up to 38 hrs of non-stop music on a single charge. Get a fast and seamless listening experience with lightspeed pairing with OnePlus Fast Pair for your OnePlus devices.', '155571f32b6df6db6a1f.webp', '2024-12-28'),
(9042, 'OnePlus Nord CE 3 Lite 5G (Chromatic Gray, 128 GB)  (8 GB RAM)', 'OnePlus Nord CE 3 Li....', 19999.00, 14599.27, 'mobile', 'oneplus', 75, 'NA', '8d2a9ccd682c762e2a46.webp', '2024-12-28'),
(9043, 'OnePlus Nord CE 3 Lite 5G (Pastel Lime, 256 GB)  (8 GB RAM)', 'OnePlus Nord CE 3 Li....', 21999.00, 19139.13, 'mobile', 'oneplus', 53, 'Generous Storage\r\nThanks to a substantial storage capacity, this smartphone includes up to 8 GB of RAM and up to 256 GB of ROM. This extensive internal storage provides ample space for your apps, photos, videos, and files. Whether you\'re a power user or someone who loves capturing countless memories, this smartphone ensures you never run out of space.\r\n\r\nHigh-resolution Camera\r\nSporting an up to 108 MP rear camera, this smartphone captures attractive, detailed photos effortlessly. The high-resolution camera ensures every shot is sharp and vibrant, ideal for photography enthusiasts wanting to take professional-quality pictures. Whether it\'s a scenic landscape, a close-up portrait, or low-light photography, this smartphone\'s camera delivers clarity and detail.', 'bdd2df4dde544d923d9a.webp', '2024-12-28'),
(9044, 'Acer Aspire 7 Intel Core i5 12th Gen 12450H - (16 GB/512 GB SSD/Windows 11 Home/4 GB Graphics/NVIDIA GeForce RTX 3050/144 Hz) A715-76G-548J Gaming Laptop  (15.6 Inch, Charcoal Black, 2.1 Kg)', 'Acer Aspire 7 Intel ....', 84999.00, 53549.37, 'laptop', 'acer', 89, '\r\nGet yourself a powerful laptop that can satisfy all your gaming needs. Sporting an array of stunning features like 12th Gen Intel Core processor, NVIDIA GeForce GTXTM 3050 with large storage capacity this laptop ensures fast and smooth performance. The air inlet keyboard ensures that your system doesn\'t overheat during intense gaming sessions. It has a sleek and stylish design built in aluminium chassis. It also comes with a backlit keyboard which adds to its total style. The FHD IPS display with a screen-to-body ratio of 81.67% along with other features like Acer BlueLightShield and Acer ExaColour technology provide a comfortable viewing experience. This Acer laptop has a Thunderbolt 4 port so that you can connect external devices to level up your gaming. With AI voice reduction you can enjoy noise-free video calling sessions with friends and family.', 'a9b9c01da02b1e0763de.webp', '2024-12-28'),
(9045, 'Acer G plus Series 108 CM (43 inch) Ultra HD (4K) LED Smart Google TV with (black) 2024 Model  (AR43UDGGR2851AD', 'Acer G plus Series 1....', 47999.00, 21119.56, 'television', 'acer', 32, '\r\nDesigned to elevate your viewing and listening pleasure, the Acer G Plus Series AR43UDGGR2851AD 108 cm (43) Smart TV is an excellent choice. Featuring Google TV, this TV allows you to effortlessly stream movies, TV shows, and more. You can quickly browse through various streaming platforms to enjoy your favourite content. In addition, equipped with a high-performance OS with direct AI integration, this TV offers an improved user experience. With 4K Ultra HDR, this TV delivers excellent contrast and vibrant details.', '045c026feb7136aec331.webp', '2024-12-28'),
(9046, 'MSI Cyborg 15 Intel Core i5 12th Gen 12450H - (16 GB/512 GB SSD/Windows 11 Home/4 GB Graphics/NVIDIA GeForce RTX 2050/144 Hz) Cyborg 15 A12UCX-264IN Gaming Laptop  (15.6 Inch, Translucent Black, 1.98 Kg)', 'MSI Cyborg 15 Intel ....', 89990.00, 57593.60, 'laptop', 'msi', 78, 'Multicore Architecture Reinvented\r\nThis MSI Cyborg gaming laptop with multi-core architecture allows for seamless transition between performance and efficiency cores, optimising power consumption and performance based on the task at hand. With this innovative technology, users can experience faster speeds, improved multitasking capabilities, and enhanced overall performance\r\nUnparalleled Performance\r\nExperience exceptional performance and visual fidelity on the go with these NVIDIA GeForce RTX 50 Series Laptop GPUs. They\'re built with Ampere—NVIDIA\'s 2nd gen RTX architecture to deliver incredible graphics and AI features. The combination of ray-tracing technology and AI features like DLSS allows for incredibly realistic graphics and smoother gameplay. And with Max-Q Technologies, these powerful GPUs can be efficiently utilised in thin and lightweight laptops, providing a level of performance previously thought impossible in such portable devices.', '4438dab3e57273d2a360.webp', '2024-12-28'),
(9047, 'ASUS TUF Gaming F17 - AI Powered Gaming Intel Core i5 11th Gen 11400H - (16 GB/512 GB SSD/Windows 11 Home/4 GB Graphics/NVIDIA GeForce RTX 2050/70 W) FX706HF-NY040W Gaming Laptop  (17.3 Inch, Graphite Black, 2.60 kg)', 'ASUS TUF Gaming F17 ....', 85990.00, 58473.20, 'laptop', 'asus', 54, 'The Asus TUF Gaming F17 is a powerful gaming laptop designed for serious gamers. Featuring an 11th Gen Intel Core H-Series CPU and GeForce RTX 2050 GPU, it delivers smooth gameplay and fast load times with its NVMe PCIe SSD. The laptop boasts a 165 Hz IPS-level display with Adaptive Sync for seamless visuals and comprehensive cooling for long-lasting performance. With a military-grade build, a customizable RGB keyboard, and extensive connectivity options, it’s both durable and versatile. Plus, enjoy a one-month Xbox Game Pass for PC, giving access to over 100 games. Elevate your gaming experience with the TUF Gaming F17.\r\nOutlast the Competition\r\nWhen it comes to gaming, performance and durability are paramount. The Asus TUF Gaming F17 is engineered to meet the demands of serious gamers and is built to withstand the rigors of intense play. This fully loaded Windows 11 gaming laptop offers the power and features needed to carry you to victory in any gaming scenario.', '7fd04815b02f48560d8a.webp', '2024-12-28'),
(9048, 'Redmi13 Pro+ 5G (Emerald Green, 512 GB) (12 GB RAM)', 'Redmi13 Pro+ 5G (Eme....', 40999.00, 36079.12, 'mobile', 'xiaomi', 77, 'Dual Sony Cameras with Dual OIS Introducing the Dual 50MP Sony Cameras with Dual OIS, backed by HyperImage+! These advanced cameras feature AIS and OIS to reduce blurring from hand tremors, ensuring stable and clear images. Both primary and telephoto lenses support optical stabilization, minimizing shake and improving the hit rate of sharp images. Capture stunning high dynamic range daylight photos and clear, bright nighttime photos with a high photo shooting success rate and stable video recording, making the realme 13 Pro+ 5G perfect for ultra clarity and stability in every shot. Sony LYT-600 Periscope & LYT-701 Featuring the Sony LYT-600 Periscope Sensor, the only periscope telephoto lens in its segment, it boosts light sensitivity by 30% over the 12 Pro+. With the 120X SuperZoom, the realme 13 Pro+ enables ultra-long-distance shooting to capture distant images with clarity. The Sony LYT-701 captures stunning high dynamic range photos in daylight and clear, bright shots at night. With OIS, enjoy sharp photos and stable videos every time!', '7b303dc72b45d6ba999f.jpg', '2025-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_orders`
--

CREATE TABLE `shopping_orders` (
  `order_id` int(15) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `address` varchar(40) NOT NULL,
  `pincode` int(11) NOT NULL,
  `delivery_type` varchar(20) NOT NULL,
  `mobile` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_orders`
--

INSERT INTO `shopping_orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`, `payment_method`, `total_quantity`, `address`, `pincode`, `delivery_type`, `mobile`) VALUES
(8, 5004, '2024-12-28', 124169.00, 'placed', 'cod', 2, 'Mattathiparas', 686651, 'Sameday', 8301943079),
(9, 5004, '2024-12-28', 21509.00, 'placed', 'online', 2, 'Mattathiparas', 686651, 'Sameday', 8301943079),
(10, 5004, '2025-01-05', 21119.56, 'placed', 'online', 1, 'Mattathipara', 686651, 'Sameday', 8301943079),
(1147483648, 5004, '2025-01-05', 2000.13, 'placed', 'cod', 1, 'Mattathipara', 686651, 'Sameday', 8301943079),
(1147483649, 5004, '2025-01-05', 2034.63, 'placed', 'cod', 1, 'Mattathipara', 686651, 'Sameday', 8301943079),
(1147483650, 5005, '2025-01-06', 1924.00, 'placed', 'cod', 1, 'Mattathipara', 686651, 'Sameday', 8301943079),
(1147483651, 5005, '2025-01-06', 22000.00, 'placed', 'cod', 2, 'Mattathipara', 686651, 'Express', 8301943079),
(1147483652, 5005, '2025-01-06', 54990.00, 'placed', 'cod', 1, 'Mattathipara', 686651, 'Normal', 8301943079),
(1147483653, 5203, '2025-01-06', 2034.63, 'placed', 'cod', 1, 'New York', 686651, 'Sameday', 5453535354353),
(1147483654, 5203, '2025-01-06', 101249.25, 'placed', 'cod', 1, 'New York', 686651, 'Sameday', 434343422322),
(1147483655, 5203, '2025-01-06', 101249.25, 'placed', 'cod', 1, 'New York', 684332, 'Sameday', 43434322222);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `password`, `email`, `role`) VALUES
(5004, 'Amal bros', '123456', 'amal446446@gmail.com', 'admin'),
(5005, 'Mystic wong', '123456', 'renderstest446446@gmail.coms', 'user'),
(5006, 'tony bro', 'tony12', 'example@email.com', 'user'),
(5007, 'Mystic strange', '098765', 'callbeackme@gmail.com', 'user'),
(5008, 'thankan', 'thankan123', 'thankan@gmail.com', 'user'),
(5193, 'Tony Stark', '!@#$%^&', 'TonyStark@Gmail.com', 'user'),
(5194, 'Clark Kent', '!rootvwx', 'ClarkKent@Outlook.org', 'user'),
(5195, 'Bruce Wayne', '!@#$%^&*', 'BruceWayne@YahooMail.net', 'user'),
(5196, 'Natasha Romanoff', '$secure$', 'NatashaRomanoff@ZohoMail.gov', 'user'),
(5197, 'Loki Laufeyson', 'ACCESS', 'LokiLaufeyson@GMXMail.ai', 'user'),
(5198, 'Peter Parker', '$SRVdef', 'PeterParker@ProtonMail.edu', 'user'),
(5199, 'Thor Odinson', 'ABC123', 'ThorOdinson@Mail.com.io', 'user'),
(5200, 'Severus Snape', 'AMfghrst', 'SeverusSnape@LycosMail.de', 'user'),
(5201, 'Albus Dumbledore', 'ALLINONE', 'Albusmhcn@Hushmail.au', 'user'),
(5202, 'Ron Weasley', 'ALLIN1MAIL', 'RonWeasley@Runbox.ca', 'user'),
(5203, 'Harry Potter', 'ADMINstu', 'HarryPotter@Tutanota.uk', 'user'),
(5204, 'Hermione Granger', 'ALLIN1', 'HermioneGranger@Posteo.us', 'user'),
(5205, 'Frodo Baggins', 'AMIvwx', 'FrodoBaggins@NewtonMail.jp', 'user'),
(5206, 'James Bond', 'ADLDEMO', 'JamesBond@FastMail.in', 'user'),
(5207, 'Aragorn Elessar', 'AMI.KEY', 'AragornElessar@BlueMail.ru', 'user'),
(5208, 'Gandalf Greyhame', 'AMI.KEZ', 'GandalfGreyhame@Hey.it', 'user'),
(5209, 'Samwise Gamgee', 'AMI!SW', 'SamwiseGamgee@Mailfence.fr', 'user'),
(5210, 'Legolas Greenleaf', 'AMI?SW', 'LegolasGreenleaf@Rediffmail.nl', 'user'),
(5211, 'Gollum Smeagol', 'AMIAMI', 'GollumSmeagol@SwissMail.br', 'user'),
(5212, 'Bruce Banner', 'A.M.Iz', 'BruceBanner@YandexMail.co', 'user'),
(5213, 'Diana Prince', '@#$%^&', 'DianaPrince@iCloudMail.biz', 'user'),
(5214, 'Steve Rogers', '*3noguru', 'SteveRogers@AOLMail.info', 'user'),
(5216, 'Darth Vader', '!@#$%^&', 'DarthVader@Gmail.com', 'user'),
(5217, 'Finn Stormtrooper', '!rootbcd', 'FinnStormtrooper@Outlook.org', 'user'),
(5218, 'Fiona Princess', 'A.M.Idef', 'FionaPrincess@YandexMail.co', 'user'),
(5219, 'Buzz Lightyear', 'ACCESS', 'BuzzLightyear@GMXMail.ai', 'user'),
(5220, 'Lord Farquaad', 'ABC123', 'LordFarquaad@Mail.com.io', 'user'),
(5221, 'Donkey Sidekick', '@#$%^&', 'DonkeySidekick@iCloudMail.biz', 'user'),
(5222, 'Andy Davis', 'ALLIN1MAIL', 'AndyDavis@Runbox.ca', 'user'),
(5223, 'Elsa Arendelle', 'ALLINONE', 'ElsaArendelle@Hushmail.au', 'user'),
(5224, 'Qui-Gon Jinn', '$secure$', 'Qui-GonJinn@ZohoMail.gov', 'user'),
(5225, 'Woody Sheriff', 'ADLDEMO', 'WoodySheriff@FastMail.in', 'user'),
(5226, 'Jabba Hutt', '!@#$%^&*', 'JabbaHutt@YahooMail.net', 'user'),
(5227, 'Poe Dameron', '$SRVklm', 'PoeDameron@ProtonMail.edu', 'user'),
(5228, 'Olaf Snowman', 'AMI!SW', 'OlafSnowman@Mailfence.fr', 'user'),
(5229, 'Simba Lion', 'AMI.KEY', 'SimbaLion@BlueMail.ru', 'user'),
(5230, 'Kristoff Reindeer', 'AMIstu', 'KristoffReindeer@NewtonMail.jp', 'user'),
(5231, 'Scar Villain', 'AMI?SW', 'ScarVillain@Rediffmail.nl', 'user'),
(5232, 'Mufasa Lion', 'AMI.KEZ', 'MufasaLion@Hey.it', 'user'),
(5233, 'Nala Lioness', 'AMIAMI', 'NalaLioness@SwissMail.br', 'user'),
(5234, 'Anna Arendelle', 'AMghiz', 'AnnaArendelle@LycosMail.de', 'user'),
(5235, 'Jessie Cowgirl', 'ADMINghi', 'JessieCowgirl@Tutanota.uk', 'user'),
(5236, 'Shrek Ogre', '*3noguru', 'ShrekOgre@AOLMail.info', 'user'),
(5237, 'Sid Phillips', 'ALLIN1', 'SidPhillips@Posteo.us', 'user'),
(5238, 'Finn Stormtrooper', '!rootjkl', 'Goofy@Outlook.org', 'user'),
(5239, 'Darth Vader', '!@#$%^&', 'MickeyMouse@Gmail.com', 'user'),
(5240, 'Jabba Hutt', '!@#$%^&*', 'DonaldDuck@YahooMail.net', 'user'),
(5241, 'Poe Dameron', '$SRVefg', 'DaffyDuck@ProtonMail.edu', 'user'),
(5242, 'Shrek Ogre', '*3noguru', 'ElmerFudd@AOLMail.info', 'user'),
(5243, 'Qui-Gon Jinn', '$secure$', 'BugsBunny@ZohoMail.gov', 'user'),
(5244, 'Fiona Princess', 'A.M.Ivwx', 'TomCat@YandexMail.co', 'admin'),
(5245, 'Woody Sheriff', 'ADLDEMO', 'BarneyRubble@FastMail.in', 'user'),
(5246, 'Donkey Sidekick', '@#$%^&', 'PorkyPig@iCloudMail.biz', 'user'),
(5247, 'Simba Lion', 'AMI.KEY', 'VelmaDinkley@BlueMail.ru', 'user'),
(5248, 'Kristoff Reindeer', 'AMImno', 'Scooby-Doo@NewtonMail.jp', 'admin'),
(5249, 'Elsa Arendelle', 'ALLINONE', 'LisaSimpson@Hushmail.au', 'user'),
(5250, 'Jessie Cowgirl', 'ADMINabc', 'HomerSimpson@Tutanota.uk', 'user'),
(5251, 'Mufasa Lion', 'AMI.KEZ', 'DaphneBlake@Hey.it', 'user'),
(5252, 'Lord Farquaad', 'ABC123', 'JerryMouse@Mail.com.io', 'user'),
(5253, 'Olaf Snowman', 'AMI!SW', 'ShaggyRogers@Mailfence.fr', 'user'),
(5254, 'Scar Villain', 'AMI?SW', 'FredJones@Rediffmail.nl', 'user'),
(5255, 'Nala Lioness', 'AMIAMI', 'SpongeBobSquarePants@SwissMail.br', 'user'),
(5256, 'Anna Arendelle', 'AMopqwxy', 'MaggieSimpson@LycosMail.de', 'user'),
(5257, 'Sid Phillips', 'ALLIN1', 'MargeSimpson@Posteo.us', 'user'),
(5258, 'Buzz Lightyear', 'ACCESS', 'FredFlintstone@GMXMail.ai', 'user'),
(5259, 'Andy Davis', 'ALLIN1MAIL', 'BartSimpson@Runbox.ca', 'user'),
(5260, 'Isaac Newton', '!@#$%^&*', 'Beavis@YahooMail.net', 'user'),
(5261, 'Nikola Tesla', '$SRVvwx', 'Dexter@ProtonMail.edu', 'user'),
(5262, 'Albert Einstein', '!@#$%^&', 'DougFunnie@Gmail.com', 'user'),
(5263, 'Charles Darwin', '*3noguru', 'PowerpuffGirls@AOLMail.info', 'user'),
(5264, 'Marie Curie', '!rootjkl', 'Butthead@Outlook.org', 'user'),
(5265, 'Galileo Galilei', '$secure$', 'DeeDee@ZohoMail.gov', 'user'),
(5266, 'Ada Lovelacess', '@#$%^&', 'Bubbl@iCloudMail.biz', 'user'),
(5267, 'Stephen Hawking', 'ABC123', 'Buttercup@Mail.com.io', 'user'),
(5268, 'Abraham Lincoln', 'ADMINklm', 'KimPossible@Tutanota.uk', 'user'),
(5269, 'Thomas Edison', 'A.M.Ixyz', 'Blossom@YandexMail.co', 'user'),
(5270, 'Mahatma Gandhi', 'ALLIN1MAIL', 'FerbFletcher@Runbox.ca', 'user'),
(5271, 'John F. Kennedy', 'AMI!SW', 'FinntheHuman@Mailfence.fr', 'user'),
(5272, 'Queen Elizabeth II', 'AMI.KEY', 'JaketheDog@BlueMail.ru', 'user'),
(5273, 'Winston Churchill', 'ADLDEMO', 'SamuraiJack@FastMail.in', 'user'),
(5274, 'Barack Obama', 'AMIghi', 'TheAmazingWorldofGumball@NewtonMail.jp', 'user'),
(5275, 'Audrey Hepburn', 'AMI?SW', 'RickSanchez@Rediffmail.nl', 'user'),
(5276, 'Princess Diana', 'AMI.KEZ', 'AdventureTime@Hey.it', 'user'),
(5277, 'George Washington', 'AMqrsjkl', 'Stitch@LycosMail.de', 'user'),
(5278, 'Leonardo da Vinci', 'ACCESS', 'JohnnyBravo@GMXMail.ai', 'user'),
(5279, 'Nelson Mandela', 'ALLINONE', 'LiloPelekai@Hushmail.au', 'user'),
(5280, 'Martin Luther King J', 'ALLIN1', 'PhineasFlynn@Posteo.us', 'user'),
(5281, 'Marilyn Monroe', 'AMIAMI', 'MortySmith@SwissMail.br', 'user'),
(5282, 'Clark Kent', '!rootklm', 'ClarkKent@Outlsxkiook.org', 'user'),
(5283, 'Bruce Wayne', '!@#$%^&*', 'BruceWayne@YaiqeahooMail.net', 'user'),
(5284, 'Natasha Romanoff', '$secure$', 'NatashaRqafzomanoff@ZohoMail.gov', 'user'),
(5285, 'Loki Laufeyson', 'ACCESS', 'LokiLaufeysjuwbon@GMXMail.ai', 'user'),
(5286, 'Peter Parker', '$SRVefg', 'PeterParker@ProoswdtonMail.edu', 'user'),
(5287, 'Thor Odinson', 'ABC123', 'ThorOdinson@Mcemyail.com.io', 'user'),
(5288, 'Severus Snape', 'AMrstghi', 'SeverusecznSnape@LycosMail.de', 'user'),
(5289, 'Albus Dumbledore', 'ALLINONE', 'Albsayqussayq@Hushmail.au', 'user'),
(5290, 'Ron Weasley', 'ALLIN1MAIL', 'RonWeahrkasley@Runbox.ca', 'user'),
(5291, 'Harry Potter', 'ADMINstu', 'HarryPotteyozhr@Tutanota.uk', 'user'),
(5292, 'Hermione Granger', 'ALLIN1', 'HermiontfuneGranger@Posteo.us', 'user'),
(5293, 'Frodo Baggins', 'AMIqrs', 'FrodoBagginhduos@NewtonMail.jp', 'user'),
(5294, 'James Bond', 'ADLDEMO', 'JamesBjfxzond@FastMail.in', 'user'),
(5295, 'Aragorn Elessar', 'AMI.KEY', 'ArdtheagornElessar@BlueMail.ru', 'user'),
(5296, 'Gandalf Greyhame', 'AMI.KEZ', 'GaanqrndalfGreyhame@Hey.it', 'user'),
(5297, 'Samwise Gamgee', 'AMI!SW', 'SamwijtsgseGamgee@Mailfence.fr', 'user'),
(5298, 'Legolas Greenleaf', 'AMI?SW', 'LegfiadolasGreenleaf@Rediffmail.nl', 'user'),
(5299, 'Gollum Smeagol', 'AMIAMI', 'GollunekkmSmeagol@SwissMail.br', 'user'),
(5300, 'Bruce Banner', 'A.M.Ibcd', 'BruceBanvwxyner@YandexMail.co', 'user'),
(5301, 'Diana Prince', '@#$%^&', 'DianaPyzbirince@iCloudMail.biz', 'user'),
(5302, 'Steve Rogers', '*3noguru', 'StevemlvtRogers@AOLMail.info', 'user'),
(5303, 'Darth Vader', '!@#$%^&', 'DarthVihliader@Gmail.com', 'user'),
(5304, 'Finn Stormtrooper', '!roothij', 'FinkavenStormtrooper@Outlook.org', 'user'),
(5305, 'Fiona Princess', 'A.M.Iijk', 'FionahxsxPrincess@YandexMail.co', 'user'),
(5306, 'Buzz Lightyear', 'ACCESS', 'BuzzgrnpLightyear@GMXMail.ai', 'user'),
(5307, 'Lord Farquaad', 'ABC123', 'LordFakfxvrquaad@Mail.com.io', 'user'),
(5308, 'Donkey Sidekick', '@#$%^&', 'DonkeltlxySidekick@iCloudMail.biz', 'user'),
(5309, 'Andy Davis', 'ALLIN1MAIL', 'AndyDagnukvis@Runbox.ca', 'admin'),
(5310, 'Elsa Arendelle', 'ALLINONE', 'ElsaArrdprendelle@Hushmail.au', 'user'),
(5311, 'Qui-Gon Jinn', '$secure$', 'Qui-GonJnqpbinn@ZohoMail.gov', 'user'),
(5312, 'Woody Sheriff', 'ADLDEMO', 'WoodyShelbzuriff@FastMail.in', 'admin'),
(5313, 'Jabba Hutt', '!@#$%^&*', 'JabbaHutt@aqfcYahooMail.net', 'user'),
(5314, 'Poe Dameron', '$SRVtuv', 'PoeDameron@PrwyfhotonMail.edu', 'user'),
(5315, 'Olaf Snowman', 'AMI!SW', 'OlafSnsrggowman@Mailfence.fr', 'user'),
(5316, 'Simba Lion', 'AMI.KEY', 'SimnujlbaLion@BlueMail.ru', 'user'),
(5317, 'Kristoff Reindeer', 'AMIvwx', 'KfrsoristoffReindeer@NewtonMail.jp', 'user'),
(5318, 'Scar Villain', 'AMI?SW', 'ScartrfrVillain@Rediffmail.nl', 'user'),
(5319, 'Mufasa Lion', 'AMI.KEZ', 'MufxxwnasaLion@Hey.it', 'user'),
(5320, 'Nala Lioness', 'AMIAMI', 'NalacykfLioness@SwissMail.br', 'user'),
(5321, 'Anna Arendelle', 'AMvwxfgh', 'AnnaArentfwpdelle@LycosMail.de', 'user'),
(5322, 'Jessie Cowgirl', 'ADMINpqr', 'JesskgcsieCowgirl@Tutanota.uk', 'user'),
(5323, 'Shrek Ogre', '*3noguru', 'ShrekewsyOgre@AOLMail.info', 'user'),
(5324, 'Sid Phillips', 'ALLIN1', 'SidPhilqisolips@Posteo.us', 'user'),
(5325, 'Finn Stormtrooper', '!rootnop', 'Goosuwafy@Outlook.org', 'user'),
(5326, 'Darth Vader', '!@#$%^&', 'MickeymgwpMouse@Gmail.com', 'user'),
(5327, 'Jabba Hutt', '!@#$%^&*', 'DonaldljosDuck@YahooMail.net', 'user'),
(5328, 'Poe Dameron', '$SRVvwx', 'DaffyDuckxkih@ProtonMail.edu', 'user'),
(5329, 'Shrek Ogre', '*3noguru', 'ElmerFoyahudd@AOLMail.info', 'user'),
(5330, 'Qui-Gon Jinn', '$secure$', 'BugsBBunnyunny@ZohoMail.gov', 'user'),
(5331, 'Fiona Princess', 'A.M.Inop', 'TomBunnyCat@YandexMail.co', 'user'),
(5332, 'Woody Sheriff', 'ADLDEMO', 'BaBunnyrneyRubble@FastMail.in', 'user'),
(5333, 'Donkey Sidekick', '@#$%^&', 'PorBunnykyPig@iCloudMail.biz', 'user'),
(5334, 'Simba Lion', 'AMI.KEY', 'VelmaDBunnyinkley@BlueMail.ru', 'user'),
(5335, 'Kristoff Reindeer', 'AMIfgh', 'ScoobBunnyy-Doo@NewtonMail.jp', 'user'),
(5336, 'Elsa Arendelle', 'ALLINONE', 'LiBunnysaSimpson@Hushmail.au', 'user'),
(5337, 'Jessie Cowgirl', 'ADMINnop', 'HomerBunnySimpson@Tutanota.uk', 'user'),
(5338, 'Mufasa Lion', 'AMI.KEZ', 'DaphneBunnyBlake@Hey.it', 'user'),
(5339, 'Lord Farquaad', 'ABC123', 'JerryBunnyMouse@Mail.com.io', 'user'),
(5340, 'Olaf Snowman', 'AMI!SW', 'ShaggyBunnyRogers@Mailfence.fr', 'user'),
(5341, 'Scar Villain', 'AMI?SW', 'FredJoBunnynes@Rediffmail.nl', 'user'),
(5342, 'Nala Lioness', 'AMIAMI', 'SpongeBBunnyobSquarePants@SwissMail.br', 'user'),
(5343, 'Anna Arendelle', 'AMxyzfgh', 'MaggieSiBunnympson@LycosMail.de', 'user'),
(5344, 'Sid Phillips', 'ALLIN1', 'MargeSBunnyimpson@Posteo.us', 'user'),
(5345, 'Buzz Lightyear', 'ACCESS', 'FredFBunnylintstone@GMXMail.ai', 'user'),
(5346, 'Andy Davis', 'ALLIN1MAIL', 'BartSiBunnympson@Runbox.ca', 'user'),
(5347, 'Isaac Newton', '!@#$%^&*', 'BeaBunnyvis@YahooMail.net', 'user'),
(5348, 'Nikola Tesla', '$SRVabc', 'Dexter@BunnyProtonMail.edu', 'user'),
(5349, 'Albert Einstein', '!@#$%^&', 'DoBunnyugFunnie@Gmail.com', 'user'),
(5350, 'Charles Darwin', '*3noguru', 'PowBunnyerpuffGirls@AOLMail.info', 'user'),
(5351, 'Marie Curie', '!roothij', 'ButtheBunnyad@Outlook.org', 'user'),
(5352, 'Galileo Galilei', '$secure$', 'DBunnyeeDee@ZohoMail.gov', 'user'),
(5353, 'Ada Lovelace', '@#$%^&', 'BubblBunnyes@iCloudMail.biz', 'user'),
(5354, 'Stephen Hawking', 'ABC123', 'ButBunnytercup@Mail.com.io', 'admin'),
(5355, 'Abraham Lincoln', 'ADMINklm', 'KimBunnyPossible@Tutanota.uk', 'user'),
(5356, 'Thomas Edison', 'A.M.Icde', 'BlossBunnyom@YandexMail.co', 'user'),
(5357, 'Mahatma Gandhi', 'ALLIN1MAIL', 'FerBunnybFletcher@Runbox.ca', 'user'),
(5358, 'John F. Kennedy', 'AMI!SW', 'FinntBunnyheHuman@Mailfence.fr', 'user'),
(5359, 'Queen Elizabeth II', 'AMI.KEY', 'JakBunnyetheDog@BlueMail.ru', 'user'),
(5360, 'Winston Churchill', 'ADLDEMO', 'SamBunnyuraiJack@FastMail.in', 'user'),
(5361, 'Barack Obama', 'AMIjkl', 'TheAmazingBunnyWorldofGumball@NewtonMail.jp', 'user'),
(5362, 'Audrey Hepburn', 'AMI?SW', 'RickBunnySanchez@Rediffmail.nl', 'user'),
(5363, 'Princess Diana', 'AMI.KEZ', 'AdventuBunnyreTime@Hey.it', 'user'),
(5364, 'George Washington', 'AMopqnop', 'Stitch@LycoBunnysMail.de', 'user'),
(5365, 'Nelson Mandela', 'ALLINONE', 'LiloPeBunnylekai@Hushmail.au', 'user'),
(5366, 'Leonardo da Vinci', 'ACCESS', 'JohnnyBunnyBravo@GMXMail.ai', 'user'),
(5367, 'Marilyn Monroe', 'AMIAMI', 'MortySmiBunnyth@SwissMail.br', 'user'),
(5368, 'Robert Ned Stark', 'strtssss', 'ned@ned.com', 'user'),
(5369, 'Legend true', 'truefa\'', 'legend@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`oit_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_items_ibfk_3` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `shopping_orders`
--
ALTER TABLE `shopping_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `oit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2048;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9049;

--
-- AUTO_INCREMENT for table `shopping_orders`
--
ALTER TABLE `shopping_orders`
  MODIFY `order_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1147483656;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5370;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `products` (`pid`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
