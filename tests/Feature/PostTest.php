<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');
        $response->assertSeeText('No posts found!');
    }

    public function testSee1BlogPostsWhenThereIs1()
    {
        // Arrange Part
        $post = new BlogPost();
        $post->title = 'New Title';
        $post->content = 'Content of the blog post';
        $post->save();

        // Act Part
        $response = $this->get('/posts');

        // Assert Part
        $response->assertSeeText('New Title');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title'
        ]);
    }

    public function testPostStoreValid()
    {
        $params = [
            'title' => 'Valid Title',
            'content' => 'At least 10 characters'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status', ''), 'The blog post was created!');        
    }

    public function testPostStoreFail()
    {
        $params = [
            'title' => 'X',
            'content' => 'X'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
        //dd($messages);
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');  
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');      
    }

    public function testPostUpdateValid()
    {
        // Arrange Part
        $post = new BlogPost();
        $post->title = 'New Title';
        $post->content = 'Content of the blog post';
        $post->save();

        // Act Part
        // $response = $this->get('/posts');

        // Assert Part
        // $this->assertDatabaseHas('blog_posts', $post->toArray());

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed'
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status', ''), 'Blog post was updated!'); 
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => $params['title']
        ]);
    }

    public function testPostDelete()
    {
        // Arrange Part
        $post = $this->createDummyBlogPost();
        // $this->assertDatabaseHas('blog_posts', $post->toArray());
        
        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status', ''), 'Blog post with id : '.$post->id.' was deleted!');   
        $this->assertDatabaseMissing('blog_posts', $post->toArray()); 

    }

    public function createDummyBlogPost()
    {
        // Arrange Part
        $post = new BlogPost();
        $post->title = 'New Title';
        $post->content = 'Content of the blog post';
        $post->save();
        return $post;
    }
}
