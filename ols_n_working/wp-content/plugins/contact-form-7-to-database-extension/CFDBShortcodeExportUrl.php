<?php
/*
    "Contact Form to Database" Copyright (C) 2011-2012 Michael Simpson  (email : michael.d.simpson@gmail.com)

    This file is part of Contact Form to Database.

    Contact Form to Database is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Contact Form to Database is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Contact Form to Database.
    If not, see <http://www.gnu.org/licenses/>.
*/

require_once('ShortCodeLoader.php');

class CFDBShortcodeExportUrl extends ShortCodeLoader {

    /**
     * @param $atts array of short code attributes
     * @param $content string not used
     * @return string export link
     */
    public function handleShortcode($atts, $content = null) {
        $atts = $this->decodeAttributes($atts);
        $params = array();
        $params[] = admin_url('admin-ajax.php');
        $params[] = '?action=cfdb-export';

        $special = array('urlonly', 'linktext', 'role');
        foreach ($atts as $key => $value) {
            if (!in_array($key, $special)) {
                $params[] = sprintf('&%s=%s', urlencode($key), urlencode($value));
            } else if ($key == 'role') {
                require_once('CF7DBPlugin.php');
                $plugin = new CF7DBPlugin();
                $isAuth = $plugin->isUserRoleEqualOrBetterThan($value);
                if (!$isAuth) {
                    // Not authorized. Print no link.
                    return '';
                }
            }
        }
        $url = implode($params);

        if (isset($atts['urlonly']) && $atts['urlonly'] == 'true') {
            return $url;
        }

        $linkText = __('Export', 'contact-form-7-to-database-extension');
        if (isset($atts['linktext'])) {
            $linkText = $atts['linktext'];
        }

        return sprintf('<a href="%s">%s</a>', $url, $linkText);
    }
}
