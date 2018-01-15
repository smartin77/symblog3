<?php
// tests/Blogger/BlogBundle/Twig/Extensions/BloggerBlogExtensionTest.php

namespace Tests\Blogger\BlogBundle\Twig\Extensions;

use Blogger\BlogBundle\Twig\Extensions\BloggerBlogExtension;
use PHPUnit\Framework\TestCase;

class BloggerBlogExtensionTest extends TestCase
{
    public function testCreatedAgo()
    {
        $blog = new BloggerBlogExtension();

        $this->assertEquals("0 seconds ago", $blog->createdAgo(new \DateTime()));
        $this->assertEquals("34 seconds ago", $blog->createdAgo($this->getDateTime(-34)));
        $this->assertEquals("1 minute ago", $blog->createdAgo($this->getDateTime(-60)));
        $this->assertEquals("2 minutes ago", $blog->createdAgo($this->getDateTime(-120)));
        $this->assertEquals("1 hour ago", $blog->createdAgo($this->getDateTime(-3600)));
        $this->assertEquals("1 hour ago", $blog->createdAgo($this->getDateTime(-3601)));
        $this->assertEquals("2 hours ago", $blog->createdAgo($this->getDateTime(-7200)));

        // Cannot create time in the future
        $this->expectException(\InvalidArgumentException::class);
        $blog->createdAgo($this->getDateTime(60));
    }

    protected function getDateTime($delta)
    {
        return new \DateTime(date("Y-m-d H:i:s", time()+$delta));
    }
}