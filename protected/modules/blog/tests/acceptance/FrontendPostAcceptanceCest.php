<?php
namespace blog;

use AcceptanceTester;
use Helper;

class FrontendPostAcceptanceCest



{
    
    public $id;
    
    protected $data = [];
    
    
    
    public function _before(AcceptanceTester $I)
    {
        
    }
    
    public function _after(AcceptanceTester $I)
    {}
    /**
     * @group admin
    
     * @group guest
     */
    
    public function BlogWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/blog');
        $I->wantTo(' blog page works');
        $I->canSeeResponseCodeIs(200);
        $I->see('Our Blog', 'h1');
    }
    /**
     * @group admin
    
     * @group guest
     */
    public function BlogViewWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/blog/' . $this->id);
        $I->amGoingTo('Blog page details');
        $I->canSeeResponseCodeIs(200);
        $I->see(array_key_exists('title', $this->data) ? $this->data['title'] : '', 'h1');
        
    }
    
    
}
