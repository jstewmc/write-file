<?php
/**
 * The file for the write-file service tests
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\WriteFile;

use Jstewmc\TestCase\TestCase;
use org\bovigo\vfs\{vfsStream, vfsStreamDirectory, vfsStreamFile};

/**
 * Tests for the write-file service
 */
class WriteTest extends TestCase
{
    /**
     * @var  vfsStreamDirectory  the "root" virtual file system directory
     */
    private $root;
    
	
	/* !Framework methods */
    
    /**
     * Called before every test
     *
     * @return  void
     */
    public function setUp()
    {
        $this->root = vfsStream::setup('test');
        
        return;
    }
    
    
    /* !__invoke() */
    
    /**
     * __invoke() should throw an exception if the file does not exist
     */
    public function testInvokeThrowsExceptionIfFileDoesNotExist()
    {
        $this->setExpectedException('InvalidArgumentException');
        
        (new Write())(vfsStream::url('test/foo.txt'), 'foo');
        
        return;
    }
    
    /**
     * __invoke() should throw an exception if the file is not actually a file
     */
    public function testInvokeThrowsExceptionIfFileIsNotFile()
    {
        $this->setExpectedException('InvalidArgumentException');
        
        $directory = 'foo';
        
        new vfsStreamDirectory($directory);
        
        (new Write())(vfsStream::url($directory), 'foo');
        
        return;
    }
    
    /**
     * __invoke() should throw an exception if the file is not writeable
     */
    public function testInvokeThrowsExceptionIfFileIsNotWriteable()
    {
        $this->setExpectedException('InvalidArgumentException');
        
        $filename = 'test/foo.txt';
        
        new vfsStreamFile($filename, 0000);
        
        (new Write())(vfsStream::url($filename), 'foo');
        
        return;
    }
    
    /**
     * __invoke() should return string if the file is writeable
     */
    public function testInvokeReturnsStringIfTheFileIsWriteable()
    {
        $filename = vfsStream::url('test/foo.txt');
        
        $contents = 'foo';
    
        file_put_contents($filename, $contents);
        
        $this->assertEquals(strlen($contents), (new Write())($filename, $contents));
        
        return; 
    }
}
