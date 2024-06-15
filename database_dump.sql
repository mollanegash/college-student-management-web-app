DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  
  `course_code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `courses` */

insert  into `courses`(`id`,`course_name`,`course_code`) values 
(1,'Web Application Development','cs601'),
(2,'Server-Side Web Development','cs602'),
(3,'Angular Js Development','cs603');

/*Table structure for table `enrollments` */

DROP TABLE IF EXISTS `enrollments`;

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `enrollment_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `enrollments` */

insert  into `enrollments`(`id`,`course_id`,`student_id`,`enrollment_date`) values 
(7,1,5,'2020-03-05 14:32:59');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `role` enum('Admin','Student') NOT NULL DEFAULT 'Student',
  `registration_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`first_name`,`last_name`,`role`,`registration_date`) values 
(4,'admin@test.com','5b37040e6200edb3c7f409e994076872','Admin','Admin','Admin','2020-03-05 14:14:44'),
(5,'student1@test.com','ac1e06d03ce2ad4315e0ce354c87dba5','student1','student','Student','2020-03-05 14:29:35'),
(6,'student2@test.com','95012b400e05352515546511cc4c0894','student2','student','Student','2020-03-05 14:31:44');

