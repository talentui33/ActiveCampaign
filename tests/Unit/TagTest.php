<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\Models\TagModel;
use TalentuI33\ActiveCampaign\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function testGetAllTags()
    {
        try {
            $tags = Tag::getAll();
            $this->assertIsArray($tags);
        } catch (\Exception $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testSearchTagByName()
    {
        $tagNameValue = 'New Candidate';

        try {
            $tags = Tag::getAll($tagNameValue);
            $this->assertIsArray($tags);
        } catch (\Exception $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testGetTagById()
    {
        try {
            $tag = Tag::getTagById('1');
            $this->assertTrue($tag instanceof TagModel);
        } catch (\Exception $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }
}
