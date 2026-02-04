<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    /**
     * Test xeno_clean sanitizes strings by converting special characters to HTML entities.
     */
    public function test_xeno_clean_sanitizes_string()
    {
        $input = '<script>alert("hack");</script>';
        $expected = '&lt;script&gt;alert(&quot;hack&quot;);&lt;/script&gt;';
        $this->assertSame($expected, xeno_clean($input));
    }

    /**
     * Test xeno_clean handles arrays recursively.
     */
    public function test_xeno_clean_handles_arrays()
    {
        $input = [
            'name' => '<b>Bold</b>',
            'nested' => [
                'comment' => '<script>'
            ]
        ];

        $expected = [
            'name' => '&lt;b&gt;Bold&lt;/b&gt;',
            'nested' => [
                'comment' => '&lt;script&gt;'
            ]
        ];

        $this->assertSame($expected, xeno_clean($input));
    }

    /**
     * Test xeno_humanize converts underscores to spaces and capitalizes words.
     */
    public function test_xeno_humanize_formats_text()
    {
        $this->assertSame('Hello World', xeno_humanize('hello_world'));
        $this->assertSame('User Config Id', xeno_humanize('user_config_id'));
        $this->assertSame('Simple', xeno_humanize('simple'));
    }
}
