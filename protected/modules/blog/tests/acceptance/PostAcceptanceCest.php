<?php
namespace blog;

use AcceptanceTester;
use Helper;

class PostAcceptanceCest

{
    
    public $id;
    
    protected $data = [];
    
    public function _data()
    {
        $this->data['title'] = \Helper::faker()->text(10);
        $this->data['content'] = \Helper::faker()->text;
        /* $this->data['keywords'] = \Helper::faker()->text(10); */
        /* $this->data['image_file'] = \Helper::faker()->text(10); */
        /* $this->data['view_count'] = \Helper::faker()->text(10); */
        $this->data['state_id'] = 1;
        //$this->data['type_id'] = 2;
        $this->data['created_by_id'] = 1;
    }
    
    public function _before(AcceptanceTester $I)
    {
        Helper::login($I);
    }
    
    public function _after(AcceptanceTester $I)
    {}
    
    
    /**
     *
     * @group admin
     *
     */
    public function IndexWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/blog/post/index');
        $I->canSeeResponseCodeIs(200);
        $I->seeElement('.grid-view');
        $this->_data();
    }
    
    
    /**
     *
     * @group admin
     *
     */
    public function AddFormCanBeSubmittedEmpty(AcceptanceTester $I)
    {
        $I->amOnPage('/blog/post/add');
        $I->seeElement('#blog-form');
        $I->amGoingTo('add form without credentials');
        $I->click('#blog-form-submit');
        $I->canSeeResponseCodeIs(200);
        $I->expectTo('see validations errors');
        $req = $I->grabMultiple('.required');
        $count = count($req) - 1;
        $I->seeNumberOfElements('.has-error', $count);
    }
    
    
    /**
     *
     * @group admin
     *
     */
    public function AddBlogCategory(AcceptanceTester $I)
    {
        $I->amOnPage('/blog/category/add');
        $I->seeElement('#blog-category-form');
        $I->amGoingTo('add form with right data');
        
        $I->fillField('Category[title]', $this->data['title']);
        // $I->selectOption('Category[state_id]', $this->data['state_id']);
        // $I->selectOption('Category[type_id]', $this->data['type_id']);
        // $I->fillField('Category[created_by_id]', $this->data['created_by_id']);
        $I->click('#blog-category-form-submit');
        $I->canSeeResponseCodeIs(200);
        $I->dontseeElement('#category-form');
        $this->data['type_id'] = $I->grabFromCurrentUrl('/[=\/](\d+)/');
    }
    
    
    /**
     *
     * @group admin
     *
     */
    public function AddWorksWithData(AcceptanceTester $I)
    {
        $I->amOnPage('/blog/post/add');
        $I->seeElement('#blog-form');
        $I->amGoingTo('add form with right data');
        
        $I->fillField('Post[title]', $this->data['title']);
        $I->fillField('Post[content]', $this->data['content']);
        /* $I->fillField ('Post[keywords]',$this->data['keywords']); */
        $I->attachFile('input[type="file"]', 'blog.jpg');
        /* $I->fillField ('Post[view_count]',$this->data['view_count']); */
        $I->selectOption('Post[state_id]', $this->data['state_id']);
        $I->selectOption('Post[type_id]', $this->data['type_id']);
        // $I->fillField('Post[created_by_id]', $this->data['created_by_id']);
        $I->click('#blog-form-submit');
        $I->canSeeResponseCodeIs(200);
        $I->dontseeElement('#blog-form');
        $I->see(array_key_exists('title', $this->data) ? $this->data['title'] : '', 'h1');
        $I->seeElement('.table-bordered');
        $this->id = $I->grabFromCurrentUrl('/[=\/](\d+)/');
    }
    
    
    /**
     *
     * @group admin
     *
     */
    public function ViewWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/blog/post/view?id=' . $this->id);
        $I->amGoingTo('View post details');
        $I->canSeeResponseCodeIs(200);
        $I->see(array_key_exists('title', $this->data) ? $this->data['title'] : '', 'h1');
        $I->seeElement('.table-bordered');
    }
    
    
    /**
     *
     * @group admin
     *
     */
    public function UpdateWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/blog/post/update?id=' . $this->id);
        $I->seeElement('#blog-form');
        $I->amGoingTo('add form with right data');
        
        $I->fillField('Post[title]', $this->data['title']);
        $I->fillField('Post[content]', $this->data['content']);
        /* $I->fillField ('Post[keywords]',$this->data['keywords']); */
        $I->attachFile('input[type="file"]', 'blog.jpg');
        /* $I->fillField ('Post[view_count]',$this->data['view_count']); */
        $I->selectOption('Post[state_id]', $this->data['state_id']);
        $I->selectOption('Post[type_id]', $this->data['type_id']);
        // $I->fillField('Post[created_by_id]', $this->data['created_by_id']);
        $I->click('#blog-form-submit');
        $I->canSeeResponseCodeIs(200);
        $I->dontseeElement('#blog-form');
        $I->see(array_key_exists('title', $this->data) ? $this->data['title'] : '', 'h1');
        $I->seeElement('.table-bordered');
    }
    
    
    /**
     *
     * @group admin
     *
     */
    public function DeleteWorks(AcceptanceTester $I)
    {
        $I->sendAjaxPostRequest('/blog/post/delete?id=' . $this->id);
        $I->expectTo('delete post works');
        $I->amOnPage('/blog/post/view?id=' . $this->id);
        $I->canSeeResponseCodeIs(404);
    }
}
