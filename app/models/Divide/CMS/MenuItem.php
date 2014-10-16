<?php

namespace Divide\CMS;

/**
 * Divide\CMS\MenuItem
 *
 * @property-read \Divide\CMS\Menu $menu
 */
class MenuItem extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = ['menu_id', 'parent_id', 'name', 'type', 'url'];
    /**
     * @var string
     */
    protected $table = 'menuitem';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo('Divide\CMS\Menu');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne('Divide\CMS\MenuItem', 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('Divide\CMS\MenuItem', 'id', 'parent_id');
    }

    /**
     * @return array
     */
    public static function types()
    {
        return array('fooldal' => 'Főoldal',
            'kulso-hivatkozas' => 'Külső hivatkozás',
            'bejegyzesek' => 'Bejegyzések',
            'egy-bejegyzes' => 'Egy bejegyzés',
            'esemenyek' => 'Események',
            'egy-esemeny' => 'Egy esemény',
            'galeriak' => 'Galériák',
            'egy-galeria' => 'Egy galéria',
            'egy-oldal' => 'Egy oldal',
            'dokumentumok' => 'Dokumentumok');
    }

    /**
     * @param int $id
     * @return array
     */
    public static function getMenuItems($id = 0)
    {

        $menuItems = array(0 => 'Nincs szülőmenüpont');

        foreach (static::where('id', '<>', $id)->get(['id', 'name']) as $menuItem) {
            $menuItems[$menuItem->id] = $menuItem->name;
        }

        return $menuItems;
    }

}