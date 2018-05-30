# WP-Juicer

[![Build Status](https://travis-ci.org/clubdeuce/wp-juicer.svg?branch=master)](https://travis-ci.org/clubdeuce/wp-juicer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/clubdeuce/wp-juicer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/clubdeuce/wp-juicer/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/clubdeuce/wp-juicer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/clubdeuce/wp-juicer/?branch=master)

A [Juicer](https://juicer.io) library for [WordPress](https://wordpress.org).

## Installation

The preferred way to install is via [Composer](https://getcomposer.org):

```
composer require clubdeuce/wp-juicer
```

Then, simply require the `autoload.php` file from the `vendor` directory.

## Usage

A simple example using the default template to display feed items:

```
use \Clubdeuce\WPJuicer\Juicer;

$feed = Juicer::get_feed(array(
    'feed' => 'my_feed_name';
));

$feed->the_template_html();
```

All parameters have a default value set _*except for feed name*_, but
you can set these to any allowed value. For example, one hundred is the 
default number of posts to retrieve. To only retrieve five:

```
$feed = Juicer::get_feed(array('per' => 5));
```

The following parameters can be set when getting a feed:

|Name|Type|Default|Notes|
|---|---|---|----|
|feed|string|null|The feed name.|
|per|int|100|The number of items to retrieve.|
|page|int|1|The page to retrieve, *e.g. if `per` is set to 10, setting `page` to 2 will retrieve items 11 through 20.*|
|filter|string|empty|Pass in either a name of a social account (capitalized) like "Facebook" or "LinkedIn" to only show posts from that source (if you have two Facebook sources it will show the posts from both). Or pass in the name on the account to only show posts from that particular source. For example, if I had an instagram source of #tbt in my feed I could pass in tbt to only show posts from that source.|
|starting_at|string|empty|Pass in a date in the format YYYY-MM-DD HH:MM (HH:MM optional) to show posts newer than this date.|
|ending_at|string|empty|Pass in a date in the format YYYY-MM-DD HH:MM (HH:MM optional) to show posts older than this date.|

