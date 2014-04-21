<?php
class FormElem {

    public function create($params = array()) {
        $elem = '<form';
        $elem .= (isset($params['id']))        ? " id='{$params['id']}'"                       : '';
        $elem .= (isset($params['name']))      ? " name='{$params['name']}'"                   : '';
        $elem .= (isset($params['class']))     ? " class='{$params['class']}'"                 : '';
        $elem .= (isset($params['onsubmit']))  ? " onsubmit='{$params['onsubmit']}'"           : '';
        $elem .= (isset($params['method']))    ? " method='{$params['method']}'"               : '';
        $elem .= (isset($params['action']))    ? " action='{$params['action']}'"               : '';
        $elem .= '>';
        return $elem;
    }
 
    public function close() {
        $elem = '</form>';
        return $elem;
    }

    public function text($params = array()) {
        $elem = '<input type="text"';
        $elem .= (isset($params['id']))        ? " id='{$params['id']}'"                       : '';
        $elem .= (isset($params['name']))      ? " name='{$params['name']}'"                   : '';
        $elem .= (isset($params['placeholder']))   ? " placeholder='{$params['placeholder']}'" : '';
        $elem .= (isset($params['class']))     ? " class='{$params['class']}'"                 : " class=''";
        $elem .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"             : '';
        $elem .= (isset($params['onkeypress']))? " onkeypress='{$params['onkeypress']}'"       : '';
        $elem .= (isset($params['value']))     ? ' value="' . $params['value'] . '"'           : '';
        $elem .= (isset($params['length']))    ? " maxlength='{$params['length']}'"            : '';
        $elem .= (isset($params['width']))     ? " style='width:{$params['width']}px;'"        : '';
        $elem .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"           : '';
        $elem .= (isset($params['required']))  ? " required=''"                                : '';
        $elem .= ' />';
        return $elem;
    }

    public function password($params = array()) {
        $elem = '<input type="password"';
        $elem .= (isset($params['id']))        ? " id='{$params['id']}'"                       : '';
        $elem .= (isset($params['name']))      ? " name='{$params['name']}'"                   : '';
        $elem .= (isset($params['placeholder']))   ? " placeholder='{$params['placeholder']}'" : '';
        $elem .= (isset($params['class']))     ? " class='{$params['class']}'"                 : " class=''";
        $elem .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"             : '';
        $elem .= (isset($params['onkeypress']))? " onkeypress='{$params['onkeypress']}'"       : '';
        $elem .= (isset($params['value']))     ? ' value="' . $params['value'] . '"'           : '';
        $elem .= (isset($params['length']))    ? " maxlength='{$params['length']}'"            : '';
        $elem .= (isset($params['width']))     ? " style='width:{$params['width']}px;'"        : '';
        $elem .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"           : '';
        $elem .= (isset($params['required']))  ? " required=''"                                : '';
        $elem .= ' />';
        return $elem;
    }

    public function date($params = array()) {
        $elem = '<input type="date"';
        $elem .= (isset($params['id']))        ? " id='{$params['id']}'"                       : '';
        $elem .= (isset($params['name']))      ? " name='{$params['name']}'"                   : '';
        $elem .= (isset($params['placeholder']))   ? " placeholder='{$params['placeholder']}'" : '';
        $elem .= (isset($params['class']))     ? " class='{$params['class']}'"                 : " class=''";
        $elem .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"             : '';
        $elem .= (isset($params['onkeypress']))? " onkeypress='{$params['onkeypress']}'"       : '';
        $elem .= (isset($params['value']))     ? ' value="' . $params['value'] . '"'           : '';
        $elem .= (isset($params['length']))    ? " maxlength='{$params['length']}'"            : '';
        $elem .= (isset($params['width']))     ? " style='width:{$params['width']}px;'"        : '';
        $elem .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"           : '';
        $elem .= (isset($params['required']))  ? " required=''"                                : '';
        $elem .= ' />';
        return $elem;
    }

    public function select($params = array()) {
        $elem = '<select';
        $elem .= (isset($params['id']))        ? " id='{$params['id']}'"                           : '';
        $elem .= (isset($params['name']))      ? " name='{$params['name']}'"                       : '';
        $elem .= (isset($params['class']))     ? " class='{$params['class']}'"   : " class=''";
        $elem .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"                 : '';
        $elem .= (isset($params['width']))     ? " style='width:{$params['width']}px;'"            : '';
        $elem .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"               : '';
		$elem .= (isset($params['data-width']))? " data-width='{$params['data-width']}'"           : '';
		$elem .= (isset($params['title']))     ? " title='{$params['title']}'"               	   : '';
        $elem .= '>';
        $elem .= '<option value="0">Select country</option>';
        if (isset($params['data']) && is_array($params['data'])) {
            foreach ($params['data'] as $k => $v) {
                if (isset($params['value']) && $params['value'] == $k) {
                    $elem .= "<option value='{$k}' selected='selected'>{$v}</option>";
                } else {
                    $elem .= "<option value='{$k}'>{$v}</option>";
                }
            }
        }
        $elem .= '</select>';
        return $elem;
    }

    public function button($params = array()) {
        $elem = '<button';
        $elem .= (isset($params['id']))        ? " id='{$params['id']}'"                           : '';
        $elem .= (isset($params['name']))      ? " name='{$params['name']}'"                       : '';
        $elem .= (isset($params['class']))     ? " class='{$params['class']}'"                     : " class=''";
		$elem .= (isset($params['style']))     ? " style='{$params['style']}'"                     : " style=''";
        $elem .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"                 : '';
        $elem .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"               : '';
		$elem .= (isset($params['data-goggle']))   ? " data-toggle='{$params['data-toggle']}'"     : '';
        $elem .= ' />';
        $elem .= (isset($params['value']))     ? " {$params['value']}"                             : '';
        return $elem;
    }
	
}
?>