<?php
/*
$Id$

  This code is part of LDAP Account Manager (http://www.sourceforge.net/projects/lam)
  Copyright (C) 2003  Roland Gruber

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  
  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

  
  confsave saves the new preferences to lam.conf
  
*/

include_once ('config.php');
$conf = new Config();

// check if password is correct 
// if not: load login page
if ($passwd != $conf->get_Passwd()) {
	require('conflogin.php');
	exit;
}

// check new preferences
if (chop($host) == "") {
	echo _("<b>" . _("Hostname is empty!") . "</b>");
	exit;
}
if (chop($port) == "") {
	echo _("<b>" . _("Portnumber is empty!") . "</b>");
	exit;
}
if (chop($admins) == "") {
	echo _("<b>" . _("List of admin users is empty!") . "</b>");
	exit;
}
if (chop($suffusers) == "") {
	echo _("<b>" . _("UserSuffix is empty!") . "</b>");
	exit;
}
if (chop($suffgroups) == "") {
	echo _("<b>" . _("UserSuffix is empty!") . "</b>");
	exit;
}

// set new preferences
$conf->set_Host($host);
$conf->set_Port($port);
$conf->set_Adminstring($admins);
if ($ssl == "on") $conf->set_SSL("True");
else $conf->set_SSL("False");
$conf->set_UserSuffix($suffusers);
$conf->set_GroupSuffix($suffgroups);
$conf->set_HostSuffix($suffhosts);

echo ("<p align=\"center\"><img src=\"../graphics/banner.jpg\"></p><hr><br><br>");


// check if password was changed
if ($pass1 != $pass2) {
	echo _("<b>" . _("Passwords are different!") . "</b>");
	exit;
}
// set new password
if ($pass1 != "") {
	$conf->set_Passwd($pass1);
	echo ("<b>" . _("Password changed!") . "</b><br><br>");
}
// save settings and display new settings
$conf->save();
echo ("<b>" . _("Saving the following settings:") . "</b><br><br>");
$conf->printconf();

?>
