# Laravel Like System Package Documentation

The Laravel Like System Package provides a flexible and customizable mechanism for implementing like/dislike functionality in Laravel applications. With this package, developers can easily integrate like and dislike features into their models, such as posts, comments, or any other content, allowing users to interact with content in a meaningful way. The package offers a streamlined API for managing likes and dislikes, along with the ability to retrieve counts, toggle status, and more.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
    - [Liking and Disliking](#liking-and-disliking)
    - [Retrieving Like/Dislike Counts](#retrieving-like-dislike-counts)
    - [Toggling Like/Dislike Status](#toggling-like-dislike-status)
- [Customization](#customization)
    - [Defining Likeable Models](#defining-likeable-models)
    - [Defining Liker Models](#defining-liker-models)
- [Examples](#examples)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## Installation

To install the Laravel Like System Package, use Composer:

```bash
composer require eslamfaroug/laravel-like-system
```

## Configuration

After installing the package, you need to publish the configuration file to customize its behavior. Run the following Artisan command:

```bash
php artisan vendor:publish --provider="EslamFaroug\LaravelLikeDislike\LikeSystemServiceProvider" --tag=config
```

This will create a `like-system.php` configuration file in the `config` directory of your Laravel project.

## Usage

### Liking and Disliking

To allow users to like or dislike a model, you can simply use the `like` and `dislike` methods provided by the `LikeSystem` facade:

```php
use EslamFaroug\LaravelLikeDislike\Facades\LikeSystem;

// Like a post
LikeSystem::like($user, $post);

// Dislike a comment
LikeSystem::dislike($user, $comment);
```

### Retrieving Like/Dislike Counts

You can retrieve the total like and dislike counts for a model using the `getLikeCount` and `getDislikeCount` methods:

```php
use EslamFaroug\LaravelLikeDislike\Facades\LikeSystem;

$likeCount = LikeSystem::getLikeCount($post);
$dislikeCount = LikeSystem::getDislikeCount($comment);
```

### Toggling Like/Dislike Status

You can toggle the like or dislike status of a model for a user using the `toggleLike` and `toggleDislike` methods:

```php
use EslamFaroug\LaravelLikeDislike\Facades\LikeSystem;

LikeSystem::toggleLike($user, $post);
LikeSystem::toggleDislike($user, $comment);
```

## Customization

### Defining Likeable Models

To make a model "likeable," you need to implement the `Likeable` interface and use the `LikeableTrait`:

```php
use Illuminate\Database\Eloquent\Model;
use EslamFaroug\LaravelLikeDislike\Contracts\Likeable;
use EslamFaroug\LaravelLikeDislike\Traits\LikeableTrait;

class Post extends Model implements Likeable
{
    use LikeableTrait;
}
```

### Defining Liker Models

Similarly, to make a model a "liker," you need to implement the `Liker` interface and use the `LikerTrait`:

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use EslamFaroug\LaravelLikeDislike\Contracts\Liker;
use EslamFaroug\LaravelLikeDislike\Traits\LikerTrait;

class User extends Authenticatable implements Liker
{
    use LikerTrait;
}
```

## Examples

Here are some examples of how you can use the Laravel Like System Package:

### Example 1: Liking a Post

```php
use EslamFaroug\LaravelLikeDislike\Facades\LikeSystem;

$user = Auth::user();
$post = Post::find(1);

LikeSystem::like($user, $post);
```

### Example 2: Retrieving Like Count

```php
use EslamFaroug\LaravelLikeDislike\Facades\LikeSystem;

$post = Post::find(1);

$likeCount = LikeSystem::getLikeCount($post);
```

## Troubleshooting

If you encounter any issues or need help, please refer to the [Troubleshooting section](#troubleshooting) in the documentation for assistance.

## Contributing

Contributions are welcome! If you'd like to contribute to

the Laravel Like System Package, please follow the guidelines in the [Contributing section](#contributing) of the documentation.

## License

The Laravel Like System Package is open-source software licensed under the [MIT license](LICENSE).

---

This concludes the documentation for the Laravel Like System Package. For more information and detailed usage instructions, please refer to the sections above. If you have any questions or need further assistance, don't hesitate to reach out to the package author or community for support.

We hope you find the Laravel Like System Package a valuable addition to your Laravel projects! Happy coding!
