# CodeIgniter 4 Framework Project

## User Create, Add, Edit, Delete
## Role Create, Add, Edit, Delete
## Permission Create, Add, Edit, Delete



# user table
CREATE TABLE `tbl_users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_type` int(11) NOT NULL,
 `email` varchar(255) NOT NULL,
 `password` varchar(255) NOT NULL,
 `verified` tinyint(4) NOT NULL DEFAULT 0,
 `first_name` varchar(255) NOT NULL,
 `last_name` varchar(255) NOT NULL,
 `gender_id` int(11) NOT NULL,
 `verification_code` varchar(255) NOT NULL,
 `status` tinyint(4) NOT NULL DEFAULT 0,
 `created_at` datetime NOT NULL,
 `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
 `deleted_at` datetime NOT NULL,
 `deleted` tinyint(4) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`),
 KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4

# gender table
CREATE TABLE `tbl_gender` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `display_name` varchar(100) NOT NULL,
 `name` varchar(100) NOT NULL,
 `priority` int(11) NOT NULL DEFAULT 0,
 `remarks` varchar(200) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4

# user_type table
CREATE TABLE `tbl_users_type` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `display_name` varchar(100) NOT NULL,
 `name` varchar(100) NOT NULL,
 `priority` int(11) NOT NULL DEFAULT 0,
 `remarks` varchar(255) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

# permissions table
CREATE TABLE `tbl_permissions` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `routing_url` varchar(255) NOT NULL,
 `parent` int(11) NOT NULL,
 `name` varchar(255) NOT NULL,
 `display_name` varchar(255) NOT NULL,
 `status` tinyint(4) NOT NULL,
 `menu_visibility` tinyint(4) NOT NULL,
 `priority` int(11) NOT NULL,
 `remarks` varchar(255) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

# roles 
CREATE TABLE `tbl_roles` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `display_name` varchar(255) NOT NULL,
 `status` tinyint(4) NOT NULL DEFAULT 0,
 `remarks` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

# roles_permissions
CREATE TABLE `tbl_roles_permissions` (
 `role_id` int(11) NOT NULL,
 `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

# users_permissions
CREATE TABLE `tbl_users_permissions` (
 `user_id` int(11) NOT NULL,
 `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

# users_roles
CREATE TABLE `tbl_users_roles` (
 `user_id` int(11) NOT NULL,
 `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

# permission data
INSERT INTO `tbl_permissions` (`id`, `routing_url`, `parent`, `name`, `display_name`, `status`, `menu_visibility`, `priority`, `remarks`) VALUES
(1, 'users', 0, 'users', 'Users', 1, 1, 1, ''),
(2, 'add-user', 1, 'add', 'Add', 1, 0, 2, ''),
(3, 'edit-user', 1, 'edit', 'Edit', 1, 0, 3, ''),
(4, 'delete-user', 1, 'delete', 'Delete', 1, 0, 4, ''),
(5, 'roles', 0, 'roles', 'Roles', 1, 1, 1, ''),
(6, 'add-role', 5, 'add', 'Add', 1, 0, 2, ''),
(7, 'edit-role', 5, 'edit', 'Edit', 1, 0, 3, ''),
(8, 'delete-role', 5, 'delete', 'Delete', 1, 0, 4, ''),
(9, 'permissions', 0, 'permissions', 'Permissions', 1, 1, 1, ''),
(10, 'add-permission', 9, 'add', 'Add', 1, 0, 2, ''),
(11, 'edit-permission', 9, 'edit', 'Edit', 1, 0, 3, ''),
(12, 'delete-permission', 9, 'delete', 'Delete', 1, 0, 4, ''),
(13, 'user-permissions', 0, 'user_permissions', 'User Permissions', 1, 0, 5, ''),
(14, 'role-permissions', 5, 'role_permissions', 'Role Permissions', 1, 0, 5, '');


