<?php

/**
 * -----------------------------------------------------------------------------
 * HTML macros
 * -----------------------------------------------------------------------------
 *
 * Saját html függvények definiálása.
 *
 */
/**
 * Létrehoz egy olyan listabeli elemet, ami aktív menüpontként viselkedik.
 */
HTML::macro('activeMenu', function ($link, $route, $more = FALSE, $classes = NULL) {

    $listElement = '<li';

    if ($more) {
        $request = Request::is($route) || Request::is($route . '/*');
    } else {
        $request = Request::is($route);
    }

    if ($request) {

        if (isset($classes) && !empty($classes)) {
            $listElement .= ' class="' . $classes . ' active">';
        } else {
            $listElement .= ' class="active">';
        }
    } else {
        if (isset($classes) && !empty($classes)) {
            $listElement .= ' class="' . $classes . '" >';
        } else {
            $listElement .= '>';
        }
    }

    $listElement .= $link;
    $listElement .= '</li>';

    return HTML::decode($listElement);
});

/**
 * Létrehoz egy olyan leugró listaelemet, ami aktív menüpontként viselkedik.
 */
HTML::macro('activeMenuDropOpen', function ($link, $route, $more = TRUE, $classes = NULL) {

    $listElement = '<li';

    if ($more) {
        $request = Request::is($route) || Request::is($route . '/*');
    } else {
        $request = Request::is($route);
    }

    if ($request) {

        if (isset($classes) && !empty($classes)) {
            $listElement .= ' class="' . $classes . ' active">';
        } else {
            $listElement .= ' class="active">';
        }
    } else {
        if (isset($classes) && !empty($classes)) {
            $listElement .= ' class="' . $classes . '" >';
        } else {
            $listElement .= '>';
        }
    }

    $listElement .= $link;

    return HTML::decode($listElement);
});

/**
 * Lezárja a leugró listaelemet.
 */
HTML::macro('activeMenuDropClose', function () {

    return '</li>';
});

/**
 * A leugró listába létrehoz egy olyan listaelemet, aktív menüként viselkedik.
 */
HTML::macro('activeSubMenuDropOpen', function ($route, $classes = NULL) {

    $listElement = '<ul';

    if (Request::is($route) || Request::is($route . '/*')) {

        if (isset($classes) && !empty($classes)) {
            $listElement .= ' class="' . $classes . ' collapse in">';
        } else {
            $listElement .= ' class="collapse in">';
        }
    } else {
        if (isset($classes) && !empty($classes)) {
            $listElement .= ' class="' . $classes . ' collapse" >';
        } else {
            $listElement .= ' class="collapse">';
        }
    }

    return HTML::decode($listElement);
});

HTML::macro('activeSubMenuDropClose', function () {

    return '</ul>';
});


/**
 * -----------------------------------------------------------------------------
 * Form macros
 * -----------------------------------------------------------------------------
 *
 * Saját form függvények definiálása.
 *
 */
Form::macro('selection', function ($name, $options, $attr = NULL, $selected = NULL) {

    $select = '<select ';

    $select .= 'id="' . $name . '" ';

    $select .= 'name="' . $name . '" ';

    foreach ($attr as $key => $value) {
        $select .= $key . '="' . $value . '" ';
    }

    $select .= '>';

    foreach ($options as $key => $value) {
        $select .= '<option';

        if (is_array($selected)) {
            if (in_array($key, $selected)) {
                $select .= ' selected="selected" ';
            }
        } else if(is_int($selected)) {
            if ($key == $selected) {
                $select .= ' selected="selected" ';
            }
        }


        if (!empty($key)) {
            $select .= ' value="' . $key . '" ';
        }

        $select .= '>' . $value . '</option>';
    }

    $select .= '</select>';

    return $select;
});


/**
 * -----------------------------------------------------------------------------
 * Blade macros
 * -----------------------------------------------------------------------------
 *
 * Saját blade függvények definiálása.
 *
 */