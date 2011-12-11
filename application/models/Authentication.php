<?php if (!defined('BASEPATH')) {  exit('No direct script access allowed'); }

interface Authentication {
    public function authenticate(Account $account);
}

