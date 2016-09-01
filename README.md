# write-file
Write a file.

```php
use Jstewmc\WriteFile\Write;

(new Write())('/path/to/foo.txt', 'foo');

file_get_contents('/path/to/foo.txt');  // returns 'foo'
```

This library is a very simple _write_ file service (see [jstewmc/read-file](https://github.com/jstewmc/read-file) for a simple _read_ file service). 

This library wraps PHP's native [`file_put_contents()`](http://php.net/manual/en/function.file-put-contents.php) with a little robust error checking. If the file does not exist, the path is not actually a file, or the file is not readable, an `InvalidArgumentException` will be thrown.

That's about it!

## Author

[Jack Clayton](mailto:clayjs0@gmail.com)

## License

[MIT](https://github.com/jstewmc/read-file/blob/master/LICENSE)

## Version

### 0.1.0, August 31, 2016

* Initial release
