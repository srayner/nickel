<?php

namespace Nickel\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class IdentityViewHelper extends AbstractHelper
{
    public function __invoke()
    {
        if(!$this->view->zfcUserIdentity()) {
            $login_url = $this->view->url('zfcuser/login');
            return '<a href="' . $login_url . '">Login</a>';
        } else {
            $user_url = $this->view->url('zfcuser');
            $username = $this->view->zfcUserDisplayName();
            return '<a href="' . $user_url . '">' . $username . '</a>';
        }    
    }
}

