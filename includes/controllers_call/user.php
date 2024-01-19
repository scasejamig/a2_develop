<?php

function controller_user($act, $d) {
    if ($act == 'edit_window') return User::user_edit_window($d);
    if ($act == 'edit_update') return User::user_edit_update($d);
	if ($act == 'create_window') return User::user_create_window($d);
    if ($act == 'user_create') return User::user_create($d);
	if ($act == 'user_delete_window') return User::user_delete_window($d);
	if ($act == 'user_delete') return User::user_delete($d);
    return '';
}
