# php-mvc-framework

A simple PHP MVC framework that uses Apache, MySQL, and PHP. This framework already has .htaccess set up, URLs routed, and database settings ready for configuration (using PDO). A bare-bones 'Home' and 'About' view has also been created.

## Installation
After cloning the repo, you will need to create your `config.php` in the **/app/config/** directory with the following information updated: `DB_USER`, `DB_PASS`, `DB_NAME`, `URLROOT`, and `SITENAME`:

```php
<?php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'my_username');
  define('DB_PASS', 'my_password');
  define('DB_NAME', 'my_database_name');

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));

  // URL Root
  define('URLROOT', 'my_root_url');

  // Site Name
  define('SITENAME', 'my_site_name');
```

You will also need to update the `.htaccess` located in the **/public/** directory. Update the following line to your public working directory:

```
RewriteBase /php-mvc-framework/public
```

## Adding Models
In the **/app/models/** directory, create your model classes. Here's an example:

```php
// Post.php
<?php 
  class Post {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getPosts(){
      $this->db->query("SELECT * FROM posts");

      return $this->db->resultSet();
    }
  }
```

You can now create models in your controller (`app/libraries/Controller.php`) with:
```php
$this->postModel = $this->model('Post');
```

And to create the data set up for your views, simply use:
```php
$posts = $this->postModel->getPosts();
```

Finally, to use this data in your view pages (such as `views/pages/index.php`), you can access as follows:
```php
<ul>
  <?php foreach($data['posts'] as $post) : ?>
    <li><?php echo $post->title; ?></li>
  <?php endforeach; ?>
</ul>
```