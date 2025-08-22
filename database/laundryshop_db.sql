-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 02:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundryshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_services`
--

CREATE TABLE `additional_services` (
  `as_id` bigint(20) NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `extra_wash` decimal(10,2) DEFAULT 0.00,
  `extra_dry` decimal(10,2) DEFAULT 0.00,
  `extra_rinse` decimal(10,2) DEFAULT 0.00,
  `spin_dry` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `additional_services`
--

INSERT INTO `additional_services` (`as_id`, `booking_id`, `extra_wash`, `extra_dry`, `extra_rinse`, `spin_dry`, `created_at`) VALUES
(2, 2227982, 12.00, 19.00, 19.00, 19.00, '2024-09-03 08:07:26'),
(3, 9469241, 12.00, 0.00, 0.00, 19.00, '2024-09-03 08:08:03'),
(4, 5420044, 12.00, 19.00, 0.00, 0.00, '2024-09-08 12:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `pickup_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `status` varchar(50) DEFAULT 'scheduled',
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(120) NOT NULL,
  `gcash_reference_number` text NOT NULL,
  `gcash_receipt` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `customer_id`, `pickup_date`, `delivery_date`, `status`, `total_amount`, `payment_method`, `gcash_reference_number`, `gcash_receipt`, `created_at`, `updated_at`, `message`) VALUES
(2227982, 11, '2024-09-03 18:18:00', '2024-09-03 18:15:00', 'completed', 273.00, 'gcash', '1002031204', 'gcash-qrcode.jpg', '2024-09-03 08:07:26', '2024-09-03 10:22:18', ''),
(5420044, 11, '0000-00-00 00:00:00', '2024-09-08 20:45:53', 'pending', 120.00, 'cash on pickup', '', '', '2024-09-08 12:45:53', '2024-09-08 12:45:53', ''),
(9469241, 11, '0000-00-00 00:00:00', '2024-09-03 16:08:03', 'accepted', 195.00, 'cash on pickup', '', '', '2024-09-03 08:08:03', '2024-09-03 08:57:26', '');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` bigint(250) NOT NULL,
  `initiator_id` bigint(250) NOT NULL,
  `staff_id` bigint(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `initiator_id`, `staff_id`, `created_at`, `updated_at`, `status`) VALUES
(18, 11, 712089, '2024-09-04 14:17:32', '2024-09-04 14:17:32', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(100) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`faq_id`, `question`, `answer`) VALUES
(1, 'How do I book a service?', 'To book a service, first, you need to log in to your account. If you don’t have an account, you’ll need to sign up by clicking on the \"Sign Up\" button on the login page. Once logged in, look for the calendar icon, which will take you to the booking page. Here, you can pick the type of laundry service you need, choose a date and time that works for you, and confirm your booking. The process is quick and easy, so you’ll be done in just a few steps.'),
(2, 'What services do you offer?', 'We offer several laundry services to meet different needs. You can choose \"Wash and Dry\" for laundry loads between 3 to 8 kilos or 8 to 10 kilos. We also offer a \"Full Service,\" which includes washing, drying, and folding, available for both 3 to 8 kilos and 8 to 10 kilos. You can pick the service that’s right for you when making your booking.'),
(3, 'I forgot my password. How can I reset it?', 'If you forget your password, it’s easy to get a new one. On the login page, click \"Forgot Password.\" You’ll be asked to enter your email address, and we’ll send you a verification code. After you enter this code, you can create a new password. This way, you’ll be able to access your account again in no time.'),
(4, 'Can I cancel or reschedule a booking?', 'Yes, you can cancel or reschedule your booking as long as it hasn’t been accepted yet. To do this, log in to your account and go to your booking history. There, you can choose the booking you want to cancel or reschedule. Just remember that once a booking is accepted, you can’t make changes to it. But if your booking is still pending, you can easily update it.'),
(5, 'How do I view my booking history?', 'To see your booking history, simply log in to your account and go to the booking page. There, you’ll find a section that shows all your past and upcoming bookings. This makes it easy to keep track of all the laundry services you’ve booked.'),
(6, 'What payment methods do you accept?', 'We accept two payment methods to make things easy for you. You can pay with \"Cash on Pickup,\" which means you pay when you pick up your laundry. Or, you can use \"GCash,\" a mobile wallet that lets you pay directly through the app. Both options are simple and secure, so you can choose the one that works best for you.'),
(7, 'How can I contact customer support?', 'If you need help or have any questions, our customer support team is here for you. You can contact us by email, phone, or live chat, whichever you prefer. We’re always ready to assist you and make sure you have a great experience with our service.'),
(8, 'What happens if there’s an issue with my booking?', 'If there’s a problem with your booking, don’t worry. Just get in touch with our customer support team, and we’ll work with you to fix it as quickly as possible. We’re committed to making sure everything goes smoothly for you.'),
(9, 'Is my personal information secure?', 'Yes, we take your privacy seriously. Your personal information is protected with strong security measures, including encryption. We make sure your data is stored safely and never share it with anyone without your permission. You can trust us to keep your information secure.'),
(10, 'Can I change my booking after it’s been accepted?', 'Once your booking has been accepted, you can no longer make changes to it. However, if your booking is still pending and hasn’t been accepted yet, you’re free to cancel or reschedule it. This gives you the flexibility to adjust your plans if something comes up.'),
(11, 'How do I sign up for an account?', 'Signing up for an account is easy. Just go to the login page and click on the \"Sign Up\" button. You’ll need to provide some basic information like your name, email address, and a password. Once you’ve signed up, you can log in and start booking services right away.'),
(12, 'How do I know if my booking has been accepted?', 'After you make a booking, you’ll receive a notification in your account once it’s been accepted. You can also check the status of your bookings by going to the booking page. There, you’ll see whether your booking is pending, accepted, or completed.'),
(13, 'Can I book multiple services at once?', 'Yes, you can book multiple services at the same time. Just choose the services you need on the booking page, select your preferred dates and times, and confirm your bookings. This way, you can take care of all your laundry needs in one go.'),
(14, 'What happens if I miss my pickup or delivery?', 'If you miss your scheduled pickup or delivery, please contact our customer support as soon as possible. We’ll do our best to reschedule it at a time that works for you. We understand that things happen, so we’re here to help make sure you still get your laundry done.'),
(15, 'Can I use someone else’s account to make a booking?', 'We recommend using your own account to make bookings. This helps us keep track of your orders and ensures that everything is processed smoothly. If you don’t have an account yet, you can easily sign up for one in just a few minutes.');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` bigint(250) NOT NULL,
  `conversation_id` bigint(250) NOT NULL,
  `sender_id` bigint(250) NOT NULL,
  `receiver_id` bigint(250) NOT NULL,
  `message_body` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `conversation_id`, `sender_id`, `receiver_id`, `message_body`, `sent_at`, `status`) VALUES
(44, 18, 11, 0, 'Hello?', '2024-09-04 14:17:03', ''),
(45, 18, 11, 712089, 'yoo?', '2024-09-04 14:32:04', ''),
(46, 18, 11, 0, 'anyone?', '2024-09-04 14:33:07', ''),
(48, 18, 712089, 0, 'How can I help?', '2024-09-04 15:46:54', ''),
(49, 18, 11, 0, 'I need help in my booking', '2024-09-04 15:54:00', ''),
(50, 18, 712089, 0, 'Nugagawin?', '2024-09-04 15:58:34', ''),
(51, 18, 11, 0, 'Solid attitude mo bossing', '2024-09-04 15:58:56', ''),
(52, 18, 712089, 0, 'talaga ka boss', '2024-09-04 16:01:04', ''),
(54, 18, 11, 0, 'bossing?', '2024-09-04 16:08:37', ''),
(55, 18, 712089, 0, 'dsadsa', '2024-09-04 16:12:59', ''),
(56, 18, 11, 0, 'Hello?', '2024-09-08 12:46:28', ''),
(57, 18, 11, 0, 'Okay, thanks!', '2024-09-08 12:46:36', '');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` bigint(20) NOT NULL,
  `user_id` bigint(250) NOT NULL,
  `assigned_date` datetime NOT NULL,
  `status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `user_id`, `assigned_date`, `status`) VALUES
(712089, 11, '2024-09-04 22:17:32', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users_accounts`
--

CREATE TABLE `users_accounts` (
  `user_id` bigint(250) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_photo` varchar(150) NOT NULL DEFAULT 'default-profile.png',
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_street_address` text NOT NULL,
  `user_optional_address` text NOT NULL,
  `user_town_city` text NOT NULL,
  `user_zip_code` int(20) NOT NULL,
  `user_phone_number` int(15) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'user',
  `user_status` varchar(100) NOT NULL DEFAULT 'active',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_accounts`
--

INSERT INTO `users_accounts` (`user_id`, `user_name`, `user_photo`, `user_email`, `user_password`, `user_street_address`, `user_optional_address`, `user_town_city`, `user_zip_code`, `user_phone_number`, `user_type`, `user_status`, `date_created`) VALUES
(5, 'Ryan James Matanguihan', 'default-profile.png	', 'admin@admin.com', 'YWRtaW4=', '', '', '', 0, 0, 'admin', 'active', '2024-05-18 10:00:20'),
(11, 'John Doe', 'default-profile.png', 'johnd@gmail.com', 'YWRtaW4=', 'Sample street', '', 'Dasmarinas', 1111, 2147483647, 'user', 'active', '2024-07-04 13:05:09'),
(712089, 'Michelle Aquino', 'default-profile.png', 'misyel@gmail.com', 'YWRtaW4=', '', '', '', 0, 2147483647, 'staff', 'active', '2024-09-04 10:56:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_services`
--
ALTER TABLE `additional_services`
  ADD PRIMARY KEY (`as_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `users_accounts`
--
ALTER TABLE `users_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_services`
--
ALTER TABLE `additional_services`
  MODIFY `as_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9487808;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=712090;

--
-- AUTO_INCREMENT for table `users_accounts`
--
ALTER TABLE `users_accounts`
  MODIFY `user_id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=712090;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_services`
--
ALTER TABLE `additional_services`
  ADD CONSTRAINT `additional_services_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users_accounts` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
