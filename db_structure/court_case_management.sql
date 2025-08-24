-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2025 at 02:34 PM
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
-- Database: `court_case_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(11) NOT NULL,
  `admin_first_name` varchar(50) NOT NULL,
  `admin_last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `admin_first_name`, `admin_last_name`, `email`, `password`, `phone_no`) VALUES
(1, 'test', 'test', 'test@test', '$2y$10$TraCEh6Dmy74N9.JhDWxLO/XCTi45hZhFYUbKVyLLf8Ryvg/c3DTi', NULL),
(2, 'test2', 'test2', 'test2@test2', '$2y$10$YKcA3jx8imPGQJN/OKF4sOYfXM/cHTNLl0LyqBF6wo.E4w6sw0/BW', NULL),
(3, 'Admin', '1', 'admin@gmail.com', '$2y$10$w8nO5T4FjG/UgtrXwdMuC.BfWB0H2gHtU/36OaaQ0qkwddA4AQhTa', 1234454678);

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `case_id` int(11) NOT NULL,
  `case_type` varchar(50) NOT NULL,
  `case_details` varchar(200) NOT NULL,
  `next_hearing_date` date DEFAULT NULL,
  `prev_hearing_date` date DEFAULT NULL,
  `case_status` varchar(50) NOT NULL,
  `court_name` varchar(50) DEFAULT NULL,
  `lawyer_id_assigned` int(11) NOT NULL,
  `lawyer_status` varchar(20) DEFAULT 'not yet accepted',
  `clientforcase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`case_id`, `case_type`, `case_details`, `next_hearing_date`, `prev_hearing_date`, `case_status`, `court_name`, `lawyer_id_assigned`, `lawyer_status`, `clientforcase_id`) VALUES
(1, 'idk_type', 'random case details', '2012-12-12', '2011-11-11', 'pending', 'supreme court', 0, '', 0),
(3, 'test-type', 'test-details', '2011-12-12', '2010-12-12', 'pending', 'high court', 0, '', 0),
(4, 'test-type-updated', 'test-details', '2011-12-12', '2010-12-12', 'pending', 'high court', 0, '', 0),
(5, 'test-type', 'test-details', '2011-12-12', '2010-12-12', 'pending', 'high court', 0, '', 0),
(6, 'test-type', 'test-details', '2011-12-12', '2010-12-12', 'finished', 'high court', 0, '', 0),
(7, 'test-type', 'test-details', '2011-12-12', '2010-12-12', 'finished', 'high court', 0, '', 0),
(8, 'test-type', 'test-details', '2011-12-12', '2010-12-12', 'finished', 'high court', 0, '', 0),
(9, 'test-type', 'test-details', '2011-12-12', '2010-12-12', 'finished', 'high court', 0, '', 0),
(11, 'testing-add-case-feature', 'testing feature', NULL, NULL, 'pending', NULL, 9, 'not yet accepted', 3),
(12, 'Type 1', 'Detail 1', NULL, NULL, 'pending', NULL, 7, 'not yet accepted', 5),
(13, 'Type 2', 'Detail 2', NULL, NULL, 'pending', NULL, 10, 'not yet accepted', 5),
(14, 'Type 3', 'Detail 3', NULL, NULL, 'pending', NULL, 9, 'not yet accepted', 5),
(15, 'Type 4', 'Detail 4', NULL, NULL, 'pending', NULL, 9, 'not yet accepted', 5),
(16, 'Type 5', 'Detail 5', NULL, NULL, 'pending', NULL, 7, 'not yet accepted', 5),
(17, 'Type 6', 'Detail 6', NULL, NULL, 'pending', NULL, 11, 'not yet accepted', 5);

-- --------------------------------------------------------

--
-- Table structure for table `case_invoices`
--

CREATE TABLE `case_invoices` (
  `case_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `image_proof` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_first_name` varchar(50) NOT NULL,
  `client_last_name` varchar(50) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_password` varchar(200) NOT NULL,
  `phone_no` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_first_name`, `client_last_name`, `client_email`, `client_password`, `phone_no`, `address`) VALUES
(5, 'Client', '1', 'client@gmail.com', '$2y$10$4DSNKvz5C8ugb7jOm5vKVexrWQpnKqYl74jZrnds19BSeUxTBunYu', 1234567890, 'Cli ent, markus #0463');

-- --------------------------------------------------------

--
-- Table structure for table `client_notifications`
--

CREATE TABLE `client_notifications` (
  `client_id` int(11) NOT NULL,
  `notification` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_notifications`
--

INSERT INTO `client_notifications` (`client_id`, `notification`) VALUES
(5, 'New case \'Type 4\' has been created.'),
(5, 'New case \'Type 5\' has been created.'),
(5, 'New case \'Type 6\' has been created.');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(200) NOT NULL,
  `user_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `feedback_content`, `user_name`) VALUES
(1, 'This is a random feedback , generated for testing', 'Random user'),
(2, 'This is a random feedback generated for testing again.', 'random user 2'),
(3, 'This is a random feedback generated for testing again.', 'random user 2'),
(4, 'This is a random feedback generated for testing again.', 'random user 2'),
(5, 'This is a random feedback generated for testing again.', 'random user 2'),
(6, 'This is a random feedback generated for testing again.', 'random user 2'),
(7, 'This is a random feedback generated for testing again.', 'random user 2'),
(8, 'random feedback', 'testuser'),
(9, 'This system is good', 'Client 1');

-- --------------------------------------------------------

--
-- Table structure for table `lawyer_login`
--

CREATE TABLE `lawyer_login` (
  `lawyer_id` int(11) NOT NULL,
  `lawyer_first_name` varchar(50) NOT NULL,
  `lawyer_last_name` varchar(50) NOT NULL,
  `lawyer_email` varchar(50) NOT NULL,
  `lawyer_password` varchar(200) NOT NULL,
  `lawyer_phone_no` int(11) DEFAULT NULL,
  `lawyer_city` varchar(100) DEFAULT NULL,
  `lawyer_address` varchar(200) DEFAULT NULL,
  `lawyer_rating` int(11) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `lawyer_image` blob DEFAULT NULL,
  `image_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lawyer_login`
--

INSERT INTO `lawyer_login` (`lawyer_id`, `lawyer_first_name`, `lawyer_last_name`, `lawyer_email`, `lawyer_password`, `lawyer_phone_no`, `lawyer_city`, `lawyer_address`, `lawyer_rating`, `specialization`, `lawyer_image`, `image_type`) VALUES
(7, 'test12', 'test11', 'test12@test12', '$2y$10$qAaBkvZnYOpXQ3Uv.4vSJ.q..trXolyGLIdtCoCqd85COE.DrN7DO', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'testing', 'lawyer', 'test@testlawyer', '$2y$10$k0BRpzNruynrtPGQoOrqJe7tlxTsf9Pf/ZLuUC8Kfg47Fkm2aLR0q', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'lawyer', 'lawyer', 'lawyer@lawyer', '$2y$10$0FPNRl9hzn5yFzz9GIS9ZOV3t13yNYXQjywi6Gu4vdTqEqo.gs6cm', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Lawyer', '1', 'lawyer1@gmail.com', '$2y$10$ngUtrxHwvsRIWuu6AB4JEOvdHbywz6i1BLr1hZgjxfoMPzLBTztHO', NULL, NULL, NULL, NULL, NULL, 0xffd8ffe000104a46494600010100000100010000ffdb0084000906071007101010101015111015101210101615101710100e1218171818191719191a2029201e2031201719253224272b2e302e2f23213338332e37292d2e2d010a0a0a0e0d0e1b10101b2d2620252f2b2f352d2d2d2b2d302d2b2d2d2d2f2f2d2d2d2d2d2d2b302d2d2b2d2f2d2d2d2d2d2d352b382d2d2d2d2d2d2b2d2d2b2dffc00011080190019003012200021101031101ffc4001c0001000203010101000000000000000000000607030405020801ffc40047100002020003040606070604060203010000010203040511061221310722415161911314325271812342627292a1b1154353a2c1d17382b2f016335493c2d263e13444f124ffc4001a010100030101010000000000000000000000030405010206ffc4002d1101000201040103020504030000000000000102030411122131134151618105427191e12232a1c114b1d1ffda000c03010002110311003f00bc4000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001f8619e2eb873b20be33480ce0c10c5d7672b22fe124cce000000000000000000000000000000000000000000000000000000000000000000000000000000000000008f67db6780c8758dd888fa45fbb87d2dbf863cbe7a1b18fc9a599eaaec45aabfe1d32f41192ee94a3d77f892f031e0764b2fcbff00e5e0ea5e2e1befce5ab3dd629f9a7f679999f6840734e96eeb75582c13d3b277cb4d7fc91ffd88b661b639d63fdac4ba97755b94af35d6fccbddc70f84e1a555fca303c7af6167c3d2d2fc37e0ff00a93d7362af8a7f9fe11cd724fbc7edfcbe6cc4bc5e2deb65f3b5f6ef5f29feacd4960a71e70d7c99f4ddb94e0f1ebad45362eff47097e670f30e8f32fc5fb109532efae6f4fc32d5162babc5ef1308ad4cdf497cfaa1b9d9a3f8686f60f33c4609eb5622dadfd9ba71fea5859df46989c2a72a251c4c7dd6b72df27c1f9904c665ef0f2709c255cd3eb46517171f8a65aacd3247f4cee866f6af568d9decafa45ccf03a6b72ba2bb2d8296bfe65a3fcc9be49d2b61f13a471554a87cb7e3f4b57cfeb2f26540eb71e67ea478b69b1dbcc3d466b47897d3781c7559841594d91b20f94a32528bf2368f9ab28cd71193cfd261ed9572edd1f567e128f297ccb6b643a41ab37dda713a537be09ebf436bf06fd97e0fcca39b496a775ee13e3d456dd4f49d800a8b00000000000000000000000000000000000000000000000000000000000000000004576976db0f936b5c3e9af5c1c62f4841fda97f45c4093ce6a09b6f44b8b6f8244533ae9070596eb1849e22c5d95fb09f8cf9796a5679f6d262b3c6fd358f735e15c7ab52f976fcf5387202659a74998dc4eaa98c30f1ecd23e927e72e1f9115c7e7d8cc7ebe97136cd773b24a3e4b4469be2161dcbc00d4b3adcf8fc78986515dcbc8ebd5805634bad27d892e2fe4b89ddc16c5e2b15a6ee0e7a3ed9adc5fccc085d774f0ef584e507d8e32707f91ddcb76f733cb34ddc54ac8fbb6e9745f9f1f264aebe8db153e74d31f8d8bfa216f45f887fbaa9fddb9c7fa01bf9074c355cd431d4ba9f2f4956b657f38fb4be5bc4d71b80c06d850a6f72f835d4b2b92de83f092e2b9f27f3454398f46b8aa136a9b17ddddba3fcaf5389809e63b216bb70f2945af6d24dc26bba75bff7dccec4cc4ef0e4c44c6d290ed7ec65fb3adcd7d2e1b5e1625c61e135d9f1e5f022ba685d7b13b7586db183a67155e2771ab29975a16c7b5c35f6a3deb9afcc85f485b14f246f13874de15beb479bc337ff0083ecee34f4fabe7fd37f2a597071eebe10a48f6918ab976336122fc29dba587b07b72f0fbb85c64f5af846ab64f8d7dd19beef1ecede1c55aa9ea7cd49166f46bb54ecddc15f2d5e9a61e4df34bf76dfe9e5d88cfd5e97ae74fbc2d69b53df0b2c900198d0000000000000000000000000000000000000000000000000000000000c389c4430b094ec928c22b5949bd14518f30c75797572b6d96ec22b56ff00a2ef6547b53b496e7b3d38c294f58435fe6977bfd00e96d5edc598fdeab0add74f294f9596fc3dd5f9fc08448cb235efb156b57f2f103c48c2e5af23cc37f1728c63172949eec6315ab93f05dacb2f64fa36d376dc7f17cd529f05fe2497e8808564790e273b969454e493d2537d5ae3f193fd16a58b92f4694d1a4b1563ba5db186b0afcfda7f9139a28861e2a108a8422b48c62946315e091940d3c065b465ab769aa15afb3149bf8be66e00000000d4c765d4e3d696d71b1766b1e2be0f9a36c01596d37460a72588cbec746221253871d1a92e5a4bfbf99dbd8fda196790b7039854abc6d70ddbeb94748622b7d5f4915dcfb5767cc991c9ce7258664ebb62fd1e26a7bd87b92ebd6f938bf7a0f938f6a7f30291dbbd9a96cd627763abc3cf595127dddb06fbd7e9a1c6c35bbfc1f345f5b5d917fc498295528a8de97a4a9ebaa85c93edee7c57c19f3d6b2a25a34d4a326a49f34d734cd8d2e7e75efcc2867c3f0ea2465aa4eb6a516d34d4a2d3d1c5ae4d18ea6a6935c9ad4ca917a219569d977ec767ab3dc3466f4f4b1ea5cbba7debc1f33be52fb079c7ec9c5c149e955ba5567727f565f27fab2e830b5787d2c9d7896de9337ab8fbf30000acb20000000000000000000000000000000000000000000000001831788861212b2c928c229ca4df248cfc8abb6db687f69d9e86b7f4107cd7ef66bb7e0bb00e6ed4e7f3cf2cd78c698b7e8a1ddf69f8b383232c8d4c6e2161a3bcfe0977b03162f10b0eb8f37c9779a996e06fceee8d5545d964b925c14576b6fb1230e5d83bb3cbe1555173b66f44bb12ed6fb92ef2fcd8fd97a76669dc8f5ae968eeb34e337dcbba2bb101afb1db1b4ecdc149e96625ad27669ecfd982ec5f9b25200000000000000000000000288e96f25fd998ef4d15a57888bb3c158b4535f3e0fe6cbdc8374bf95faf65d2b52ebd138dcbbf71f566bc9ebf227d35f8e48faf4f192bbc29acaadd7583fbcbfa9d34b423b86b7d0ce32ee7c7e1da488dec73bc313574e37dfe42f1d93ccff6b60e9b5bd67bbb967df8f07fdfe651c58bd1363bff00c8c3b7eedd15fcb2ff00c4abafc7cb172f87bd064e3976f958c00311b600000000000000000000000000000000000000000000000088ede679ea55fabd72d2cb175debc615ff0077fdcad64d178dd1845394d4744b56da5c3e2d9ce59be5f296eac4619cbbbd2d7afea762267c393310a62eb6352726d2496adebc88be23132cc6c5ba9b6deed715c5f824bbd9f507abd735ec45a7f6534c470b5c5eaab8a6b8a6a093471d45fa3dd918ecd51bd624f15624ed7cfd1ae6ab8bee5dbdefe44bcf337a235a3077ebd6d38e806d834fd49fbefc8fd5836bebbf2036c1ad53d1b5dcf43640035f138baf08b5b2c8d6bbe73505f998b0b9a61f16f4aefaec7dd1b2327e499de33b6fb3cf28df6ddba0038f4000000001a79ae0d66145d4be56553adff9a2d1b800f92e7d46e2df14dc5f1ede4c9160ed56d707aaf678f1f91f453c1d4ff770fc08fd585ad7eee3f851a34d7f1fcbfe54f3e97d4888ddf3d6abfdb249d1ee2fd5b30a78f09a9d4fc758eabf348b87d5abf723f811fb1c3c171508a7d9d55a9dc9f8845eb35e3e7ebfc21c7a09a5a2dcbc7d3f9660019ad2000000000000000000000000000000000000000000000d5cc7190cbeab2eb1e90845ce4fc11b440fa5ccc3d5f090a13d1db671fb90e2ff003dd24c38fd4c915f9459b27a749b7c2b5daada6c46d158dd9271ab57e8ea4fa905d9aafad2f16472715ddf91b534619a3e8e29158dab0c28c9369de522d8adb4bb66ac8c652959846f4b2b6f5f469fd7afb9aeeed2fda2f8e2211b2125284a2a516b94a2d6a9a3e5a9a2d8e88b697d3532c0d92ebd49ce8d7eb55af5a3f26fc9f819baed3c6dea57eed3d2e5fcb2b32db9234a58a75ebbad73d791b587a5492935ab7c78f6197d5e1ee47f0a3297dcdf5eb3de5e47ec71d3f79791d1f5787b91fc287abc3dc8fe1406a55885aeadf17cce1ed96d6c720a7a9a4af9eaaa4f92ef9bf04492caeba9394a314926dbd168922a1da1c5c338be76b82ddf66b4e2bab05cbfb9674b8a325fbf10ababcb34a6d1e6514c7e6766613765d63b26f9b93d7cbbbe46babf75ea9e8d3d535c1a3bef0d5fb91fc28fc786afdc8fe146e7a9b46d10c3f4b79de652ee8eb6d678a97aa6267bf2d1ba66df5a5a717093ede1c99fbd2751b9b989ae4d293f476a52696ba7565c3e6bc88b60773056d76a847584e33f657632dada0cbebccf076a8c22f5afd243aab8b5d64636b71c56fcab1e5b5a2bccd38dbd9f3be618c9f1fa49fe397f72c8e82718fd0e377e4e5f4f5e9ac9cbea78918c6e16bfe1c7f0a277d0fe1ab5562f4847fe743eaaf70a6b89efae47bcc90c4291fbe821eec7f0a3063235e1e129b6a0a317272e497c40dade5ccacf6e7a40dddec3e065c7d9b2e5d9deabff00dbcbbce56d76db599ba7450dc30fca4f94eff8f747c3cfb884d8062b31363fde4ff1cbfb9ad6626cfe24ff00ee4bfb992c35a6b5f8f25e2063b31367f127ff00725fdc906c6ec8e3b6ae69c6cb2ac329693ba529eef8c60b5eb4bf25da4af623a2f962f771198270af9c28e53b3fc4d3d95f679fc0b7f0f4430d18c2b8a8422946318add8c52ec4901ced9dc828d9da55342969ce729c9cecb65df293fff00875c00000000000000000000000000000000000000000000000533d2963fd731ceb4fab4c235ff0099f5a5faa5f22e1c45aa884a727a46317297824b567cd59ee78adbadb1adeb2764a72e3c23bcf5d19a3f86d639cde7dbfdb3bf10e56ac63a799ff4f334619a39566656cfb52f05146d65b899e2e4e0e3bcd4653d52e515cdbec35bd48952ff00879295e53b32cd1eb018fb32ababbeb7a4e12de5f6bbe2fc1ad51fb346bdc8e5e378d9dc56edf4e6418f866985a2fadf5275464bbd70e29f8ae466c5633d0494775b6d6bccadba27cefd5d430937d4b22a556bf56cd38c7e6bf35e25878c928dab5f73fab3e7b363f4ef30dac77e55dd97d75ff0dfe23ccf3070e3e8df999636c4e767b9953975165d634a108394bfb11446fd3dccece1edde7bbb4c6883d2562deb3be35f77cdfe4995fb91a1767d2ccb5b9ad6537bdc79457625e097035de366fb7f246c6188c55e2cec987265b72f0eab660c562e1855acde9dcbb59a36666eb8cb58ef49477968b825aa5abee5ab5e668613072c7376db2d23cf5eff00ec89e27756be39a4ed2cf767ae4f4843cf8b7f245b9b0b9edf8fc0d4e515ac35a65d57f5797f2e85433cd2ac2f56a827e3c97f764f3a24da29db65f876a3c62ae8ae3d9d597eb12b6ae9cb1eff0009f4b3c6fb7ca27b41982c0626ea6c838a8d9249ae3d57c63c3e0d16174356c6ea714e2d35e9a1cbee2387d2ce0e9b2faacb21baedaf777bbe70f1f83469f46b8dff008568c65927bd177c1422b9daf7397ff664b4d71e3f1b5e020ecb25a4579c9f725dacadf69b3db337de4fab524dc609fe72ef663c7e713ce9ab64f83f662b956bb8e6e27d997dd6044e3c8c561923c8eeecc6c8e2368e49c57a3a13d256b5c3c5417d67f9011fcbf2dbb36b634d15bb2c9762e4977b7d8bc59716c5ec051906edd769762b9a969f474fdc5dff0069f1f8120d9fc870f9055e8e8869db393e365afbe4ceb0000000000000000000000000000000000000000000000000000010de95b3679565b76ebd276b8e1e1e1bded3fc2a47ceae3a96af4e3997a6bf0d854f8575cae9fdf9bd23f945f9958389b3a3c7c7144fcf6a792f1cdaee058fd08e4f1c7627176591deae386743d79376be2bf0c5f995f6e97bf42b96fa9e5ced6bad7dd39ebdf08f523fe99798d5db8e297ac73ca7655fb49944b24c4db8796af765d47efc1fb32f2fea71ae45d3d2d643ebb4471705ad94f0b34e72a5bfe8f8fcd94cdc8b18337ab8f97bfbb372e3f4b271f677f2d9ca985328b7194630945ae716b8a65d990636ada0c3d77b5d7d372c49b5b935cd70f3f9a294c12fa2afee47f4257d1fe75fb3313e8e4fe8ae6a0fba33fa92fe9f3452d562e55dfde17b05f69d96a7a957ddfcccaaba57c6578bb23838f1ae1a4eed24fad63f662f8f62e3f3f02c9da2cd639361acbdf34b482f7a6fd95e651189b658894a737bd3949ca4dfd693e6caba5c7bcf295bbdb6e9a75d4a94a315a24b448f47a923a5b33943cf3135d0b5dd6f7ad7eed6bdafedf32e4cc446f2ec3b9b25b2ff00b43058ab26baf7d7255f7c6a8718f9c96bf84836718b7649530e115a26976bee3e84c82a55ea9249462a314b925ddf914066b85596e637d73e118df369bf75f5a3f93447a4cbcad6dff555d4d3c490c35597454adeb4df25cfc91b9b1d9b470399e1ae4b720ed554d76284fa8ff54fe470b33b95f6c9a7ac568a3dc6b6f35cb83ecf897f872acc4fbab4753d2f5e98b2a58ccba56a5d6a671b7c777d997fab5f9159ec45bebd4df54f8b525a3edd34fe85d595dd1da9cb20e5c56230bbb3f094a3bb2f27a9496c4e0ecc2cefde8bd2188f4163f766a2f83f23e7e6369da5a913bba993daea9cea7e2d7c5733a38a7a464df05baff43996f5319c3de5f9a3c6d2e25a8bad76c5ca5f0ec471d77ba36d9bc267f0f58b2e8dca2f474c5e8e0fff0093b7cb87896e555c698a8c528c52d124b4515dc923e4dc8f31bf27b637e1ec955647938f6aee6b935e0cbe7613a45a7683768c469462b925ae955efec37c9fd97f2d409e8000000000000000000000000000000000000000000000000000007136c331fd9381c4dcb84954d43efcbab1fcd9dad66d3111eee5a768de542ed9663fb5f1f8abb5d62ed7187f871eac7f25a9c4703677343cee9f4b5ac5622218beaef3bb5d56e5c12e2f825e3d87d3fb3f97aca70b87c3afddd3083f1924b57e7a9436c1e59fb4f31c2c1ad62acf4b3eedd875bf5497ccfa2ccbfc46ddc57eebfa3ee26cc57551be32849294649c649f2927c1a3e77db0c92590e2ada1ebba9ef54dfd6adfb2ff00a7c8fa3481f4b190fed3c2fa782d6da35970e72abeb2f973f9321d166f4efc67c4bbabc5ce9bc79856d825f455fdc8fe87b923f304be8abfb91fd0f724694a9d25d6da5da3b33baf0d5cb5fa387d27ff0025bcb7bcbf5647648cf246392228ac563685a8b6fe5af245b7d18e45fb3b0cf1138e96dfa35c38c6a5ecaf9f3f2203b25927edcc542b6be8d7d25cfec2ecf9be05e508a8a49704968b4e48a7aabfe585aa39396bf436ca0fc5797129fe9972df53c6c2d4bab6d7a3f1941ffeae3e45c79a52eb92b63e1bde0d726443a55cb639ee5ead8e8ada2c8cff00cb2eac97c38af222d2df86489732d795546ea7e391e6e84a87a4d34ff531399b5ca15228bc7a11cd7d6307761dbe34ddbd1ff0ec5aff00a94cecece64b1a71d9aa71d6abadaafd1ae0dcebd25fcd1932aee87b1965198282f62eae5549bf654975a3fa35f32f2c65d1c245c23ed35c5f6fc4c6d5d76cb3f55cc7fdaad33bd9e9e1314ed86b3a379cb5edafb1297f722f9ec5bb2cfb8b4fc25ed96e13720dc97192d1a7c7abdc4036ff00639d3196230d172828cbd2417194177aef4bf22b3da93a206e551d0c58781bb5c00b37617a45951bb87c7c9ca1ecc2f7c651f0b3bd7daf3ef2d6ae6ac4a5169a6b54d3d535de8f996b8131d8ddafbb206ab96b6e19be30d7ad578c35fd390176834f2dcc2acd2b8db4cd4e0fb5734fb9aec66e00000000000000000000000000000000000000000000002b7e99330dca70f864f8ce6ed97dd8705f9cbf22c8293e91adb331c7dba424e15a8d30eab6b87197f3365cd0d3966899f6ed4f5d93862ebdfa429c0fc71375e0ecfe1cff00048fc782b3f873fc1237ba61c5a53ce85f2edeb713896bd984698fc65d697e4a3e65b444fa34cb9e5f97d5bcb4959295d24d68d6f708ff002a44b0f9dd5df9e5b4fdbf67d0e9abc71406ae3d2945a7cb47a9b460c62d62574ea7b3fca3f63daab4be8dc54eafb8fb3e5c8e4c916e6d1646b3bc3422b456c23ad6fb35d38c5f832abc66167839b8591709ae0d35a335f4f97d4af7e5999b1f0b75e1a724629233c894ec5ecacf32b237dd071c3c5ef2d569e9dae497d9f13de4b4523797ac7bda7684bb60323fd9185529ad2ebb4b27df18fd48fc97e6d92900c7b5a6d3332d088da36799454968f8aed23d9fe4b2c4537575f29d73825db16d70f8f12460f313b3af94d672e1ac2faf569eecb869c573e0cfcfda7865c553c7eec49b6dd64be831d888fa2728ca7e962fd1b92d27d6e7f1d48efec78ffd3bff00b72fec6c45e263745c5cec26d15b4db54e886eb84e135a719707a9f4a6578457461749ef6f2538ae7c1f14d941c3052af846a925e15c97f42ece8f3192c56029524d4ebd697aad1f57d9e7f65a2a6ae378897bac6c931e2df65fc19ecf16fb2fe0ca4f4aab6bba3bf598cb15818e93f6ada5705677ca1e3f67b7e3ceb8856e2da6b469e8d35a34cfa5700b48fc88a6daec3c33adebe84abc4f39764311a7bddd2fb5e7e014f570366b819a5975d449c2754e324f7649c25c1f919ebc259fc39fe0901bd9066f764966fd32d13f6e0fd8b178afea5b5b3f9fd39e4358756c4baf06fad1f15debc4a82bc2cff872fc1237708aec24a3656a709a7ac5a8b4d01750235b35b4bfb474aee83aeee49eeb55dbf0ee7e0494000000000000000000000000000000000000000000000e6e233dc2e1a5284ef846517a493968d3e662ff0089702bff00daaff190de91701e82f8dc9756c8e8fefc787e9a7910e9816d5db6b96512dd9e3a98cb4d74762d4e96559ae1f3883b30d742e8293839425bc94971d3f347ce3b4d86deddb5767565f0ecff007e24bba12cebd4f136e126f48df1dfaffc58767ce3afe102ee3cd91de47a0069adea39715dcfb0d7c42589e165309afb4b7bf5475001c4af054d4f58e1294fbd571d7f437bd666bea2f33741d9999f2e444434bd6acf71798f5ab3dc5e66e838eb4bd6acf71798f5ab3dc5e66e8034bd6acf71798f5ab3dc5e66e8034bd6acf71798f5ab3dc5e66e8034bd6acf71799c5c7ed6e0b0d3953762e9aa71694e2eceb27cf47e678dbfdaa8ecbe19c968f1166b1c3c5f1eb76cdfd95fd9769f3a5f6caf94a739394e5272949bd5ca4deadb2ce1d3f38de7c3ccdb67d2187db4cade9158ea5becd2c36bfe2ccbff00eaeafc68f9db29c3ee2737cdf08fc0e9a65cae82b31bccca8e6d6cd6db5617bffc5797ff00d5d5f8d1bb976654e64a52a2d8d918bd24e2f549f3d0a0f05869e36c8555ade9ce4a315decbdb67f29864b87ae88f1dd5ac9fbf37ed48afaad3e3c311b4cef2f7a6d45f2ccef1d3a47e80525d00000000000000000000000000000000000000000000000071f6a32bfdad869d6975d75ebfbebb3e7c57cca76c5a6a9f3e4cbe8ad3a41c8bd52c789ad7d1d8fe912fa9677fc1febf1020b89ad5d1945f26b4646f0f3b32bba3383ddb6b9a9c1fda4f54fe04a2673332c2fa75bcbda5f9aee02fed99cea1b4185ab110e1bcb49c7b6bb17b517f3fe8758a07a3dda97b357e93d5e1ac695cb9ee35cac4bc3b7c3e08be68ba3888c67092946494a2d3d5493e29a60650000000000000000000039b9f6714e4544f117cb4845705f5ac976422bb5b3266d99d394553bef9a85715ab6f9bee4976b7dc501b69b536ed45dbf2d614c755457af082f79f7c9ff00f44f830ce49fa3c5ef1573769b3cbb68b113c45cf8beac229f56a82e505fef8bd4d1c261bd3be3ecae7e3e07ed343b5f72ed674eb8a824970d0d7a523eca39736d1b479648f03d23c264bfa3fd9679ddbe9ad8ff00fe6ae5c75fdf4fdcf877f912e4c918eb36b28d71cdedc6128e8cf66fd521eb97474b26b4a53fa95bfadf17fa7c49f9e52d0f46065c9392d3696de2c718ebc600011a40000000000000000000000000000000000000000000000000c18ac3c31509576454a124e324f934cce6866b8f59643d2cd3f4517f4b24b57543df6bdd5dbdcb57d80553b59b3b3c8aced95127f473ff00c65e3fa91c997f5f4d59954e3251b6a9c7ef46717c9a6bf54561b53b0f6e5dbd661d4aea79b4b8db57c97b4bc50101c461f57aae7da894ec3eda59b3ed536eb6615be5ce74b7cdc3c3ecf978c76661901f466031d56635c6da66acadf2717aaf87c7c0da3e7ac8f3cbf269efd16b837ed45f184fef47b4b2725e91e9bd28e2ab754bb651d675bf1d3da5f9813c06960734a3305ad3742cfbb34df97337400000039f6e7187ae7e8bd2c656ff000e2f7edfc31d59be9ea07e9cacff003da320a5dd7cf75728c5719db2f762bb59c3daedbcc3e43bd5d7a5f89e2b713ea54fedcbfa2e3f029bce735bf3ab5dd7d8e737c176460bdd8aec45bc1a5b5fbb750832678af51e5b5b5db517ed35bbd6752a8b7e86a4f58d7e2fbe5e3e470aba77fe0648c3bccab81a95a45636852b6497b8251e0b81ed1e133bdb27b3376d25bbb0ea5517f4b635c21e0bbe5e1e67bb5a2b1bcf841159b4ed0c9b23b3766d1ddbab58d3169dd3f757babed32f0c0612bc0570aaa8a8d708eec52ec31655965594550a698eec23f3727db26fb5bef37cc5d46a272cfd1a98304638fa8002ba700000000000000000000000000000000000000000000000000000f128a9a69ad53e0f5e3a9ec015666b8bc4f4677a957077e516cdeed7af5b0537c5c20df25da93e0f9707ce77906d1617686bf4986b54d7d68f2b2b7dd28f346f63f055e635ce9ba0acaa71719c64b5525fefc8a176c364715b0d77ace1a73f57defa3b62da9d3f62cd3f5e4fe258a4572f53d4ff00dbccef1e17167db1d84ceb594a1e8ed7fbcafab27f797297cc80e6dd1a62f0daba250c447b16be8acf27c3f334767fa5dc46192862eb572e5beba967cf4e1f913ecafa45cbf1e97d23adf6ef4755e71d4e5b4d923c46ff00a3c7ad58feeebf5ffdf0a8f30c871981d7d2e16d82eff45271f35aa396ec9d1dae3f91f4761f3cc2627d8c4d52f85b1d7cb536256d36f39572f8b8b219ada3cc3dc5a27c4be6a86676c1f069bfbbc7f23b3976739c5bc30f1c44bbb723735fae85eef1385c37173a61e3bd089a18bdafcbf09ed62a0df741bb1ff2ea7a8c77b7889727256be6615e6032dda8ccb4d6e961a2fb6cb746bfcb1de648b01d1dcefd1e6398e2716fb6b8db2a69f83d1eafcd0cc7a4da2ae14513b1f7cdaaa3fd590ece76eb1b98269daa883fab5753f9bdafccb14d165b798dbf5416d6638f1dfe8b22fccb2cd8cafd1c5574f6fa2aa29db37ded2fd6457bb4bd2062735d6ba75c3d2f83dd7f4b35e325cbe5e6432dc5ae2f8c9b7ab7dff335e5739f82f02ee3d2e3c7dcf72af6cd9327d21967248f1a98d1e9167778e3b3da3d23d6130d663271aea84ac9c9e918c56f4a5f22d3d91e8d6346edd8fd273e71a53d6b8fdf7f5be1cbe247933571c6f676b8ed79e919d8cd89b7681ab6cd6ac2ebc65a693bbc21affa8b972ec05596d71aa98285715a452fd7c5f89b308a82492d12e0925a248f66466cf6cb3df8f85fc58ab8e3a0004294000000000000000000000000000000000000000000000000000000000000315f4c7111709c54a124e328c96f4649f34d3ec328029fdb3e899a72bb2de5ce58794b4d3fc393ff004cbcfb0aaf1187b30163aec84aab22f494651709c7e47d687273cd9fc267d0dcc4d11b52e4dad270fbb25c5732d63d54d7ab76f335ddf3357985b0fadafde4a46c43369ae718bf9685979df4369eb2c16274fb172d74f84e3c7cd10acc760334cbbdac24ac5df53572f25d6fc8bd4d4d67c595eda7a4f9ac398b3697b91fcc4b359bec8af91a97e0edc2bd2caac83fb55ca1faa316f25dabcc9bd499f745ff001f1c7b36e78cb27f5bcb818b5dee7c4f10eb72e3f0e27430792e2b1bff002b0d759f7699b5e7a68726df2f51488f10d44cf489665bd1ae678dd37aa8d117db6d8935fe58eac98e51d11d35692c562256bed856bd143f13d64ff222b6a31d7dddf4ed3eca9e8aa57c9421194e6de918c62e5297c12277b39d18e2b1fa4f14fd5abe7bbc257cbe5ca3f3f22d7ca322c2e4d1ddc3d10abbda5d797c64f8b3a654c9adb4f54e92574f1eee4643b3d85c821b987a9475f6a6fad64fef4b9ff43ae014e66667794f1111e0001c740000000000000000000000000000000000000000000000000000000000000000000000000001e5a4f9986582aa5ceb83ff00244d80061af0f0afd98457c22919800000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000003ffd9, 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `lawyer_notifications`
--

CREATE TABLE `lawyer_notifications` (
  `lawyer_id` int(11) NOT NULL,
  `notification` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`case_id`);

--
-- Indexes for table `case_invoices`
--
ALTER TABLE `case_invoices`
  ADD KEY `foreign_key_to_case_id` (`case_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `lawyer_login`
--
ALTER TABLE `lawyer_login`
  ADD PRIMARY KEY (`lawyer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lawyer_login`
--
ALTER TABLE `lawyer_login`
  MODIFY `lawyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `case_invoices`
--
ALTER TABLE `case_invoices`
  ADD CONSTRAINT `foreign_key_to_case_id` FOREIGN KEY (`case_id`) REFERENCES `cases` (`case_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
