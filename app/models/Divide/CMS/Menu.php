<?php

namespace Divide\CMS;

class Menu extends \Eloquent {
	protected $fillable = ['name'];
    protected $table = 'menu';

    public function menuitems(){
        return $this->hasMany('Divide\CMS\MenuItem');
    }
}