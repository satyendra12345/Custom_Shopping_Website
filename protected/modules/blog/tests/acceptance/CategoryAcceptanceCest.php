<?php
namespace blog;

use AcceptanceTester;
use Helper;
class CategoryAcceptanceCest

{
    
    public $id;
    
    protected $data = [];
    
    public function _data()
    {
        $this->data['title'] = \Helper::faker()->text(10);
        $this->data['state_id'] = 1;
        // $this->data['type_id'] = 0;
        // $this->data['created_by_id'] = 1;
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
        $I->amOnPage('/blog/category/index');
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
        $I->amOnPage('/blog/category/add');
        $I->seeElement('#blog-category-form');
        $I->amGoingTo('add form without credentials');
        $I->click('#blog-category-form-submit');
        $I->canSeeResponseCodeIs(200);
        $I->expectTo('see validations errors');
        $req = $I->grabMultiple('.required');
        $count = count($req);
        $I->seeNumberOfElements('.has-error', $count);
    }
    
    
    /**
     *
     * @group admin
     *
     */
    public function AddWorksWithData(AcceptanceTester $I)
    {
        $I->amOnPage('/blog/category/add');
        $I->seeElement('#blog-category-form');
        $I->amGoingTo('add form with right data');
        $I->fillField('Category[title]', $this->data['title']);
       // $I->selectOption('Category[state_id]', $this->data['state_id']);
        $I->click('#blog-category-form-submit');
        $I->canSeeResponseCodeIs(200);
        $I->dontseeElement('#category-form');
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
        $I->amOnPage('/blog/category/view?id=' . $this->id);
        $I->amGoingTo('View category details');
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
        $I->amOnPage('/blog/category/update?id=' . $this->id);
        $I->seeElement('#blog-category-form');
        $I->amGoingTo('add form with right data');
        $I->fillField('Category[title]', $this->data['title']);
       // $I->selectOption('Category[state_id]', $this->data['state_id']);
        $I->click('#blog-category-form-submit');
        $I->canSeeResponseCodeIs(200);
        $I->dontseeElement('#category-form');
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
        $I->sendAjaxPostRequest('/blog/category/delete?id=' . $this->id);
        $I->expectTo('delete category works');
        $I->amOnPage('/blog/category/view?id=' . $this->id);
        $I->canSeeResponseCodeIs(404);
    }
}
