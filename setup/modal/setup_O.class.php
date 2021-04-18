<?php

class Setup{

    protected $conn;
    protected $conn2;

    public function __construct($host, $username, $password){
        $this->conn = new mysqli($host, $username, $password);

        if($this->conn->connect_error){
            die("<h3> Database Connection Failed!!! Error: " . $this->conn->connect_error . "</h3>");
        }
    }

    //***************** Database & Tables Creation Method Section Starts ******************//
    public function CreateDatabase($dbname){

        $sql = "CREATE DATABASE $dbname;
        USE $dbname;

        DROP TABLE IF EXISTS `account_setting`;
        CREATE TABLE `account_setting` (
          `id` int(11) NOT NULL,
          `organization` varchar(255) NOT NULL,
          `logo` varchar(500) NOT NULL,
          `logo_local_path` varchar(500) NOT NULL,
          `contact` int(15) NOT NULL,
          `email` varchar(255) NOT NULL,
          `facebook` varchar(255) NOT NULL,
          `twitter` varchar(255) NOT NULL,
          `instagram` varchar(255) NOT NULL
        );

        DROP TABLE IF EXISTS `admintheme`;
        CREATE TABLE `admintheme` (
          `id` int(11) NOT NULL,
          `theme_color_name` varchar(50) NOT NULL,
          `theme_color` varchar(50) NOT NULL
        );

        INSERT INTO `admintheme` (`id`, `theme_color_name`, `theme_color`) VALUES
        (1, 'cyan', '#396c77');

        DROP TABLE IF EXISTS `category`;
        CREATE TABLE `category` (
          `c_id` int(11) NOT NULL,
          `name` varchar(300) NOT NULL,
          `visibility` int(1) NOT NULL DEFAULT 1,
          `position` int(30) NOT NULL
        );

        INSERT INTO `category` (`c_id`, `name`, `visibility`, `position`) VALUES
        (1, 'Sample Category 1', 1, 1),
        (2, 'Sample Category 2', 1, 2);

        DROP TABLE IF EXISTS `enquiry`;
        CREATE TABLE `enquiry` (
          `id` int(11) NOT NULL,
          `date` datetime NOT NULL DEFAULT current_timestamp(),
          `name` varchar(100) NOT NULL,
          `email` varchar(100) NOT NULL,
          `subject` varchar(300) NOT NULL,
          `content` longtext NOT NULL,
          `reply_date` datetime NOT NULL DEFAULT current_timestamp(),
          `reply` longtext NOT NULL
        );

        INSERT INTO `enquiry` (`id`, `date`, `name`, `email`, `subject`, `content`, `reply_date`, `reply`) VALUES
        (1, '2020-10-01 22:09:55', 'Demo', 'abc@abc.com', 'Sample Enquiry', 'This is a Sample Inquiry.', '2020-10-01 22:09:55', '');

        DROP TABLE IF EXISTS `folder`;
        CREATE TABLE `folder` (
          `f_id` int(11) NOT NULL,
          `c_id` int(11) NOT NULL,
          `name` varchar(300) NOT NULL,
          `visibility` int(1) NOT NULL DEFAULT 1,
          `position` int(30) NOT NULL
        );

        INSERT INTO `folder` (`f_id`, `c_id`, `name`, `visibility`, `position`) VALUES
        (1, 1, 'Sample Folder 1', 1, 1),
        (2, 1, 'Sample Folder 2', 1, 2),
        (3, 2, 'Sample Folder 1', 1, 0);

        DROP TABLE IF EXISTS `posts`;
        CREATE TABLE `posts` (
          `post_id` int(11) NOT NULL,
          `c_id` int(11) NOT NULL,
          `f_id` int(11) NOT NULL,
          `date` datetime NOT NULL DEFAULT current_timestamp(),
          `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          `title` varchar(300) NOT NULL,
          `content` longtext NOT NULL,
          `tags` varchar(500) NOT NULL,
          `draft` int(11) NOT NULL DEFAULT 1,
          `position` int(30) NOT NULL,
          `views` int(30) NOT NULL
        );

        INSERT INTO `posts` (`post_id`, `c_id`, `f_id`, `date`, `last_updated`, `title`, `content`, `tags`, `draft`, `position`, `views`) VALUES
        (1, 2, 1, '2020-09-21 20:37:08', '2020-10-01 22:42:52', 'Sample Article 1', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p style=\"text-align:center\"><input alt=\"\" src=\"https://www.thinkright.me/wp-content/uploads/2019/09/Untitled-design-27.jpg\" style=\"height: 596px; width: 1000px;\" type=\"image\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', 'Tag 1, Tag 2', 0, 1, 0),
        (2, 2, 1, '2020-09-26 20:02:34', '2020-10-01 22:42:57', 'Sample Article 2', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id magni ducimus reprehenderit quibusdam iste tempora nostrum reiciendis eum minus dolorem optio provident, adipisci aperiam porro nesciunt autem, saepe nulla laboriosam ullam veniam quod dolorum? Ipsam eius magnam eum fuga quisquam placeat nostrum veritatis, consequuntur debitis impedit ipsa provident maxime? Repellendus optio voluptate quos explicabo, sint ea qui sit dolore atque veritatis fugiat neque modi itaque mollitia placeat quod excepturi aliquid sequi repudiandae illum! Quia corporis eaque magni unde facilis sed ipsa non earum ullam tempore voluptas expedita, maiores asperiores distinctio impedit ad deserunt fugiat modi commodi accusantium itaque tenetur? Tempora, facilis! Reprehenderit dolore nobis saepe iste corrupti consectetur nisi voluptates maiores labore? Vel minus quam assumenda incidunt quidem beatae perferendis consectetur quasi? Sequi ad adipisci porro quia voluptatem commodi rerum eius temporibus ipsa, dolore dolores veniam! Adipisci vero rem repellendus minima quasi, doloribus sapiente et, magni harum officiis atque, assumenda nam. Numquam odit totam pariatur voluptas saepe porro voluptatibus sed maxime eligendi doloribus quidem ab delectus veniam atque quisquam, quae ratione similique quas obcaecati eaque illum dolorum odio. Nihil error quod earum iusto unde quibusdam quae reiciendis molestias quas cum id praesentium, exercitationem placeat repudiandae laborum dignissimos laboriosam ratione minima!</p>\r\n', 'Tag 1, Tag 2', 0, 2, 0),
        (3, 1, 2, '2020-09-28 23:37:53', '2020-10-01 22:43:00', 'Sample Article 1', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p style=\"text-align:center\"><input alt=\"\" src=\"https://www.thinkright.me/wp-content/uploads/2019/09/Untitled-design-27.jpg\" style=\"height: 596px; width: 1000px;\" type=\"image\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', 'Tag 1, Tag 2', 0, 1, 0),
        (4, 1, 2, '2020-09-29 20:29:20', '2020-10-01 22:43:05', 'Sample Article 2', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id magni ducimus reprehenderit quibusdam iste tempora nostrum reiciendis eum minus dolorem optio provident, adipisci aperiam porro nesciunt autem, saepe nulla laboriosam ullam veniam quod dolorum? Ipsam eius magnam eum fuga quisquam placeat nostrum veritatis, consequuntur debitis impedit ipsa provident maxime? Repellendus optio voluptate quos explicabo, sint ea qui sit dolore atque veritatis fugiat neque modi itaque mollitia placeat quod excepturi aliquid sequi repudiandae illum! Quia corporis eaque magni unde facilis sed ipsa non earum ullam tempore voluptas expedita, maiores asperiores distinctio impedit ad deserunt fugiat modi commodi accusantium itaque tenetur? Tempora, facilis! Reprehenderit dolore nobis saepe iste corrupti consectetur nisi voluptates maiores labore? Vel minus quam assumenda incidunt quidem beatae perferendis consectetur quasi? Sequi ad adipisci porro quia voluptatem commodi rerum eius temporibus ipsa, dolore dolores veniam! Adipisci vero rem repellendus minima quasi, doloribus sapiente et, magni harum officiis atque, assumenda nam. Numquam odit totam pariatur voluptas saepe porro voluptatibus sed maxime eligendi doloribus quidem ab delectus veniam atque quisquam, quae ratione similique quas obcaecati eaque illum dolorum odio. Nihil error quod earum iusto unde quibusdam quae reiciendis molestias quas cum id praesentium, exercitationem placeat repudiandae laborum dignissimos laboriosam ratione minima!</p>\r\n', 'Tag 1, Tag 2', 0, 2, 0),
        (5, 2, 3, '2020-09-30 12:47:16', '2020-10-01 22:43:15', 'Sample Article 1', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><input alt=\"\" src=\"https://www.thinkright.me/wp-content/uploads/2019/09/Untitled-design-27.jpg\" style=\"height: 596px; width: 1000px;\" type=\"image\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p><a href=\"http://localhost/projects/Postman/admin/view/updatePost.php?id=3\">Edit</a><a href=\"http://localhost/projects/Postman/admin/view/postDetail.php?id=3#\">Delete</a></p>\r\n\r\n<p><a href=\"http://localhost/projects/Postman/admin/view/postDetail.php?id=3#\">New Comment</a></p>\r\n', '', 0, 1, 0),
        (6, 2, 3, '2020-09-30 13:02:04', '2020-10-01 22:43:18', 'Sample Article 2', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id magni ducimus reprehenderit quibusdam iste tempora nostrum reiciendis eum minus dolorem optio provident, adipisci aperiam porro nesciunt autem, saepe nulla laboriosam ullam veniam quod dolorum? Ipsam eius magnam eum fuga quisquam placeat nostrum veritatis, consequuntur debitis impedit ipsa provident maxime? Repellendus optio voluptate quos explicabo, sint ea qui sit dolore atque veritatis fugiat neque modi itaque mollitia placeat quod excepturi aliquid sequi repudiandae illum! Quia corporis eaque magni unde facilis sed ipsa non earum ullam tempore voluptas expedita, maiores asperiores distinctio impedit ad deserunt fugiat modi commodi accusantium itaque tenetur? Tempora, facilis! Reprehenderit dolore nobis saepe iste corrupti consectetur nisi voluptates maiores labore? Vel minus quam assumenda incidunt quidem beatae perferendis consectetur quasi? Sequi ad adipisci porro quia voluptatem commodi rerum eius temporibus ipsa, dolore dolores veniam! Adipisci vero rem repellendus minima quasi, doloribus sapiente et, magni harum officiis atque, assumenda nam. Numquam odit totam pariatur voluptas saepe porro voluptatibus sed maxime eligendi doloribus quidem ab delectus veniam atque quisquam, quae ratione similique quas obcaecati eaque illum dolorum odio. Nihil error quod earum iusto unde quibusdam quae reiciendis molestias quas cum id praesentium, exercitationem placeat repudiandae laborum dignissimos laboriosam ratione minima!</p>\r\n', 'Tag 1, Tag 2', 0, 2, 0);

        DROP TABLE IF EXISTS `users`;
        CREATE TABLE `users` (
          `u_id` int(11) NOT NULL,
          `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          `name` varchar(300) NOT NULL,
          `u_name` varchar(100) NOT NULL,
          `u_pass` varchar(255) NOT NULL
        );

        DROP TABLE IF EXISTS `website_setting`;
        CREATE TABLE `website_setting` (
          `id` int(11) NOT NULL,
          `company` varchar(50) NOT NULL,
          `theme_color_name` varchar(50) NOT NULL,
          `theme_color` varchar(50) NOT NULL,
          `contact` int(15) NOT NULL
        );

        INSERT INTO `website_setting` (`id`, `company`, `theme_color_name`, `theme_color`, `contact`) VALUES
        (1, 'abc', 'blue', '#007bff', 123456);

        ALTER TABLE `account_setting`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `admintheme`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `category`
          ADD PRIMARY KEY (`c_id`);

        ALTER TABLE `enquiry`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `folder`
          ADD PRIMARY KEY (`f_id`);

        ALTER TABLE `posts`
          ADD PRIMARY KEY (`post_id`);

        ALTER TABLE `users`
          ADD PRIMARY KEY (`u_id`);

        ALTER TABLE `website_setting`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `account_setting`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

        ALTER TABLE `admintheme`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

        ALTER TABLE `category`
          MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

        ALTER TABLE `enquiry`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

        ALTER TABLE `folder`
          MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

        ALTER TABLE `posts`
          MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

        ALTER TABLE `users`
          MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

        ALTER TABLE `website_setting`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";


        if($this->conn->multi_query($sql)){
            return 1;
        }
        else{
            return 0;
        }
    }
    //***************** Database & Tables Creation Method Section Ends ******************//


    //***************** User Signup Method Section Starts ******************//
    public function CreateUser($hostname, $username, $password='', $dbname, $name, $u_name, $u_pass){
      $this->conn2 = new mysqli($hostname, $username, $password, $dbname);

        if($this->conn->connect_error){
            die("<h3> Database Connection Failed!!! Error: " . $this->conn->connect_error . "</h3>");
        }

      $sql = "INSERT INTO users (u_id, name, u_name, u_pass) VALUES (1, '$name', '$u_name', '$u_pass');";
      $sql2 = "INSERT INTO `account_setting` (`organization`, `contact`, `email`) VALUES ('$name', 1234567890, 'abc@gmail.com');";

      if($this->conn2->query($sql) && $this->conn2->query($sql2)){
        return 1;
      }
      else{
        return 0;
      }
    }
    //***************** User Signup Method Section Ends ******************//

    //***** Select Data from Users Table Method Section Starts ******//
    public function GetUser($hostname, $username, $password='', $dbname){
      $this->conn2 = new mysqli($hostname, $username, $password, $dbname);

        if($this->conn->connect_error){
            die("<h3> Database Connection Failed!!! Error: " . $this->conn->connect_error . "</h3>");
        }

        $sql = "SELECT * FROM users;";

        if($result = $this->conn2->query($sql)){
            if($result->num_rows < 1){
              return '2';
            }
            else{
              return $result;
            }
        }
        else{
          return '0';
        }
    }
    //***** Select Data from Users Table Method Section Ends ******//

}
