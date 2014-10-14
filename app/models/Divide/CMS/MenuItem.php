<?php

namespace Divide\CMS;

class MenuItem extends \Eloquent {
	protected $fillable = ['menu_id','parent_id','name','type','url'];
    protected $table = 'menuitem';

    public function menu(){
        return $this->belongsTo('Divide\CMS\Menu');
    }
}