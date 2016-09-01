<?php
/**
 * The file for the write-file service
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\WriteFile;

use InvalidArgumentException;

/**
 * The write-file service
 *
 * @since  0.1.0
 */
class Write
{
    /* !Magic methods */
    
    /**
     * Writes the file
     *
     * @param   string  $filename  the file's name
     * @param   string  $contents  the file's contents
     * @return  int
     * @throws  InvalidArgumentException  if $filename does not exist
     * @throws  InvalidArgumentException  if $filename is not a file
     * @throws  InvalidArgumentException  if $filename is not writeable
     * @since   0.1.0
     */
    public function __invoke(string $filename, string $contents): int
    {
        // if the file (or directory) does not exist, short-circuit
        if ( ! file_exists($filename)) {
            throw new InvalidArgumentException(
                __METHOD__ . "() expects parameter one, filename, to exist"  
            );
        }
        
        // if the file is not actually a file, short-circuit
        if ( ! is_file($filename)) {
            throw new InvalidArgumentException(
                __METHOD__ . "() expects parameter one, filename, to be a file"
            );
        }
        
        // if the file is not writeable, short-circuit
        if ( ! is_writeable($filename)) {
            throw new InvalidArgumentException(
                __METHOD__ . "() expects parameter one, filename, to be writeable"
            );
        }
        
        return file_put_contents($filename, $contents);
    } 
}
