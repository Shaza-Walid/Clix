-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2025 at 03:28 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clix`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(15, 4, 10),
(16, 4, 9),
(17, 4, 8),
(18, 4, 7),
(19, 4, 1),
(20, 4, 2),
(21, 4, 13),
(23, 9, 28),
(24, 9, 27),
(25, 9, 26),
(26, 9, 25),
(27, 9, 24),
(28, 9, 23),
(29, 9, 22),
(30, 9, 21),
(31, 9, 20),
(32, 9, 19),
(33, 9, 18),
(34, 9, 17),
(35, 9, 16),
(36, 9, 1),
(37, 9, 5),
(38, 9, 7),
(39, 9, 8),
(40, 9, 9),
(41, 9, 10),
(42, 9, 11),
(43, 8, 28),
(44, 8, 27),
(45, 8, 26),
(46, 8, 25),
(47, 8, 24),
(48, 8, 23),
(50, 8, 22),
(51, 8, 21),
(52, 8, 20),
(53, 8, 19),
(54, 8, 17),
(55, 8, 18),
(56, 8, 16),
(57, 8, 15),
(58, 8, 14),
(59, 8, 11),
(60, 8, 8),
(61, 8, 2),
(62, 8, 5),
(63, 8, 1),
(64, 1, 28),
(65, 1, 27),
(66, 1, 26),
(67, 1, 25),
(68, 1, 24),
(69, 1, 21),
(70, 1, 20),
(71, 1, 19),
(72, 1, 18),
(73, 1, 17),
(74, 1, 16),
(75, 1, 15),
(76, 1, 8),
(77, 1, 7),
(78, 1, 5),
(79, 1, 2),
(80, 1, 1),
(81, 2, 28),
(82, 2, 27),
(83, 2, 26),
(84, 2, 24),
(85, 2, 23),
(86, 2, 22),
(87, 2, 21),
(88, 2, 20),
(89, 2, 19),
(90, 2, 17),
(91, 2, 16),
(92, 2, 15),
(93, 2, 13),
(94, 2, 14),
(95, 2, 12),
(96, 2, 11),
(97, 2, 10),
(98, 2, 9),
(99, 2, 8),
(100, 2, 7),
(101, 2, 5),
(102, 2, 1),
(103, 2, 2),
(105, 3, 27),
(106, 3, 26),
(107, 3, 25),
(108, 3, 24),
(109, 3, 23),
(111, 3, 21),
(112, 3, 20),
(113, 3, 19),
(114, 3, 18),
(115, 3, 17),
(116, 3, 16),
(117, 3, 15),
(118, 3, 14),
(119, 3, 13),
(120, 3, 12),
(121, 3, 11),
(122, 3, 10),
(123, 3, 9),
(124, 3, 8),
(125, 3, 7),
(126, 3, 5),
(127, 3, 2),
(128, 3, 1),
(129, 4, 28),
(130, 4, 27),
(131, 4, 26),
(132, 4, 25),
(133, 4, 24),
(134, 4, 23),
(135, 4, 22),
(136, 4, 21),
(137, 4, 20),
(138, 4, 19),
(139, 4, 18),
(140, 4, 17),
(141, 4, 15),
(142, 5, 28),
(144, 5, 26),
(145, 5, 25),
(146, 5, 27),
(147, 5, 23),
(148, 5, 22),
(149, 5, 20),
(150, 5, 19),
(151, 5, 17),
(152, 5, 14),
(153, 5, 12),
(154, 5, 10),
(155, 5, 8),
(157, 5, 6),
(158, 5, 1),
(159, 5, 5),
(160, 6, 28),
(161, 6, 24),
(162, 6, 20),
(163, 6, 21),
(165, 6, 15),
(166, 6, 13),
(167, 6, 1),
(168, 6, 2),
(169, 6, 5),
(172, 3, 22),
(173, 3, 28),
(175, 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created_at`) VALUES
(1, 1, 'في عزّ الصدام بينك وبين ابنك افتكر ان هو مش عدوك، هو نُسخة لسه بتتكوّن تفاهم، كلمة حنينة، وصبر حقيقي، ممكن يغير سلوكه وطريقة تفكيره و هيرجعلك بقلبه حتى لو تايه عنك شوية.', '2025-04-13 17:02:44'),
(2, 2, 'مهما كنت بتجيب براندات و أياً كان مستواك المادي والاجتماعي هييجي عليك وقت وتدرك ان السعادة الحقيقية بتبدأ من استقرارك النفسي وسلامك الداخلي وراحة البال ودا مش هيتحقق الا اما تدي كل حاجة حجمها الحقيقي.', '2025-04-13 17:06:05'),
(5, 5, 'أعمق راحة تجدها هي حين تخبر الله بكل ما يؤلمك، بكل ما يعجزك، بكل ما يحزنك وأول وسيلة لتحقيق ما تريد أن تستعين به لتيسير أمورك فهو القريب السميع الذي لا يخذلك', '2025-04-13 20:14:43'),
(6, 6, 'ما دام الغيب بيد الله فتوقعه جميلا.', '2025-04-15 07:17:02'),
(7, 5, 'مشكلتنا إننا بنفتكر إن الحب لو قوي هينقذ كل حاجة… الحقيقة إن الحب محتاج “حكمة” معاها. محتاج نعرف إن الزعل جزء طبيعي من القرب، وإن اللي بيفرق بين علاقة بتكمل وعلاقة بتتكسر هو طريقة تعاملنا مع المشاكل والخلافات', '2025-11-24 14:46:04'),
(8, 5, 'أوقات كلمة واحدة في لحظة غضب بتسيب أثر أعمق من الخلاف نفسه لأن الكلام ممكن يفضل ساكن في القلب سنين\n\nحاول على قد ما تقدر تختار كلامك؛ العلاقات الحقيقية بتتبني على ضبط النفس مش على شدّ الأعصاب.', '2025-11-24 14:48:08'),
(9, 12, 'من أجمل لحظات القوة، أن تتعلق بالله وحده، أن تُسلم ضعفك له، وتتيقن أن ما عنده خير مما عندك فمن يتوكل على الله فهو حسبه.', '2025-11-24 19:35:56'),
(10, 4, '\"Some days you won’t feel like yourself, and that’s okay.\nLife shifts, people change, and your heart grows in ways you don’t notice.\nJust remember: healing isn’t loud — sometimes it’s simply choosing to keep going.\"', '2025-11-26 14:54:32'),
(11, 4, '\"You deserve to be surrounded by people who see your worth without you having to prove it.\nPeople who celebrate your smallest wins and stay during your toughest moments.\nProtect your peace — not everyone deserves a seat at your table.\"', '2025-11-26 14:55:33'),
(12, 4, '\"I’m learning to slow down and appreciate the little things.\nA quiet evening, a warm cup of coffee, a message from someone who cares.\nLife isn’t always about big changes; sometimes the smallest moments mean the most.\"', '2025-11-26 14:56:07'),
(13, 4, '\"It’s okay if you’re still figuring things out.\nNobody has everything sorted, even if they look like they do.\nTake your time, trust your journey, and believe that better days are coming.\"', '2025-11-26 14:56:48'),
(14, 4, '\"One day, you’ll look back and realize everything happened the way it should.\nThe storms, the pauses, the difficult choices — they all shaped you.\nGive yourself credit for surviving days you weren’t sure you’d get through.\"', '2025-11-26 14:57:12'),
(15, 5, 'مشكلتنا إننا بنفتكر إن الحب لو قوي هينقذ كل حاجة… الحقيقة إن الحب محتاج “حكمة” معاها. محتاج نعرف إن الزعل جزء طبيعي من القرب، وإن اللي بيفرق بين علاقة بتكمل وعلاقة بتتكسر هو طريقة تعاملنا مع المشاكل والخلافات', '2025-11-26 16:08:29'),
(16, 5, 'من حق أي إنسان يغيّر رأيه، يراجع موقفه، ويعيد تشكيل حياته. \n\nاحياناً كتير النضج بيحصل بسبب التغيير.', '2025-11-26 16:08:58'),
(17, 2, '\"Surround yourself with people who bring peace, not confusion.\nPeople who make you feel seen, heard, and valued just as you are.\nLife is too short to spend it with those who drain your soul.\"', '2025-11-26 16:10:32'),
(18, 2, 'في بداية الارتباط العلاقة بين الطرفين بتكون مليانة مشاعر وصورة جميلة بس مع الوقت بنحتاج حاجات أعمق من الإعجاب...\n هل في مساحة طبيعية للتعبير؟ \nهل في احترام وقت الخلاف؟ \nهل كل طرف قادر يشوف التاني كإنسان له احتياجات مش نسخة مثالية يبنيها في خياله؟ \n\nدي الأسئلة اللي بتخلّي البدايات واعية بدل ما تكون اندفاع.', '2025-11-26 16:11:16'),
(19, 2, '\"You’re not behind.\nYou’re not late.\nYou’re living at your own pace, learning your own lessons, and becoming the person you were meant to be — slowly, beautifully, and honestly.\"', '2025-11-26 16:11:33'),
(20, 5, 'مش شرط التوافق يعني إن الاهتمامات أو العادات متطابقة، التوافق الحقيقي بيظهر في طريقة التعامل مع الاختلاف نفسه. هل الاختلاف بيتحول لنقاش هادي وفضول لمعرفة الآخر؟ ولا لحاجة لازم حد يكسب فيها؟ اللي بيقدر يحتوي الاختلاف هو اللي يعرف يعيش علاقة طويلة بدون استنزاف.\n\nدي آخر فرصة للاستفادة بخصم الحجز المبكر باللاضافة لخصم العضوية...تواصل مع فريقنا لمعرفة كل تفاصيل دورة القرار مع خبير العلاقات حسام الغروري لمعرفة معايير اختيار شريك الحياة', '2025-11-26 16:12:37'),
(21, 5, 'واحنا مرهقين العقل ساعات بيضخم المشكلة!\n\n عشان كده قبل ما ناخد قرار كبير، الأفضل ننام، نروق، نشرب حاجة دافئة، ونرجع نفكر\n\nأحيانًا المشكلة كانت محتاجة بس ذهن رايق.', '2025-11-26 16:13:02'),
(22, 11, '\"Sometimes letting go isn’t about giving up — it’s about making space.\nSpace for growth, for new beginnings, for people who actually care.\nThe right things stay, the wrong things fade, and life gets lighter.\"', '2025-11-26 16:14:16'),
(23, 11, '\"Be proud of how far you’ve come, even if it doesn’t look like much to others.\nNobody knows how many battles you fought silently.\nYou’re stronger than you think, and your story is still unfolding.\"', '2025-11-26 16:14:53'),
(24, 1, 'اختيار شريك الحياة قرار صعب وبيلعب دور محوري في حياتنا كلها من أول سلامنا النفسي لحد استقرار الأبناء مستقبلاً وبناء حياة مستقرة؛ وفي مواقف كتير بتولد اسئلة عادة مش بنتعامل معاها بشكل منطقي فازاي نتعامل مع الاشارات اللي بنشوفها والمواقف اللي بنمر بيها في فترة التعارف بمرجعية علمية سليمة؟\n\n باقي ساعات على بداية دورة \"القرار\" مع خبير العلاقات حسام الغروري لمعرفة معايير اختيار شريك الحياة وتقدر تستفيد بخصم العضوية ...تواصل معانا عشان تعرف كل التفاصيل.', '2025-11-26 16:16:09'),
(25, 1, 'لو ابنك حاسس إنك عايز تسيطر على كل تفاصيله، هيبعد أكتر. خليه يحس إنك شريك في قراراته، مش قاضي عليه مستني يعاقبه', '2025-11-26 16:16:52'),
(26, 1, 'عوّد ابنك يسمع منك \"أنا فخور بيك\"… حتى في الحاجات الصغيرة. الكلمة دي بتبني جواه ثقة صعب تهتز.', '2025-11-26 16:17:20'),
(27, 1, 'لو ابنك في سن المراهقة، وبتحس إنك مش قادر توصله...\nالعناد زاد، الموبايل ما بيفارقش إيده، والمذاكرة بقت حرب كل يوم؟\nاحنا صممنا دورة \"تحدي الأجهزة والمذاكرة\" مع د. نهى أبو ستة عشان متخيلين حجم المعاناة اللي بتمر بيها...\n\nفي الدورة هتعرف:\n\nليه المراهق بيتغير فجأة؟\n\nإزاي تخلي ابنك يسمعك من غير ما يعاند؟\n\nتتعامل مع الشاشات والمذاكرة من غير صراع؟\n\nتبني علاقة أمان وثقة بينكم؟\n\n\nباقي ساعات قليلة على نهاية خصم الحجز المبكر وتقدر تستفيد كمان بخصم العضوية، تواصل مع فريقنا واستغل الفرصة ده وقتك تستثمر في علاقتك بولادك قبل ما المسافة تكبر.', '2025-11-26 16:17:46'),
(28, 9, '\"It’s amazing how much changes when you stop expecting people to be who you want them to be.\nYou start seeing things clearly, accepting reality, and choosing yourself more often.\nThat’s where real peace begins.\"', '2025-11-26 16:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`) VALUES
(1, 'Nana Salah', 'nana@gmail.com', '683470'),
(2, 'Shahd Waleed', 'shahd1503@gmail.com', '123456'),
(3, 'Waleed Fareed', 'waleed3090@gmail.com', '759778'),
(4, 'Mariam Karam', 'Maro2020@gmail.com', '653701'),
(5, 'Shaza Walid', 'shazawalid@gmail.com', '456789'),
(6, 'Amal Hany', 'AHany11@gmail.com', '024680'),
(7, 'Ahmed Ali', 'ahmedali@gmail.com', '135791'),
(8, 'Ali Maher', 'hrzag@gmail.com', '703476'),
(9, 'Walid Ali', 'walidali@outlook.com', '867297'),
(10, 'Alaa Mohammed', 'alaamohammed@gmail.com', '576342'),
(11, 'Marawan khaled', 'marawankhaled@outlook.com', '587395'),
(12, 'Mohammed Gamal', 'gimmy110@yahoo.com', '687592'),
(13, 'Dina Othman', 'didi@yahoo.com', '460381'),
(14, 'Menna Ahmed', 'menna99@outlook.com', '568930');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
