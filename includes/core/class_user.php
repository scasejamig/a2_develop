<?php

class User {

    // GENERAL

    public static function user_info($d) {
        // vars
        $user_id = isset($d['user_id']) && is_numeric($d['user_id']) ? $d['user_id'] : 0;
		$plot_id = isset($d['plot_id']) && is_numeric($d['plot_id']) ? $d['plot_id'] : 0;
        $phone = isset($d['phone']) ? preg_replace('~\D+~', '', $d['phone']) : 0;
        // where
        if ($user_id) $where = "user_id='".$user_id."'";
		if ($plot_id) $where = "plot_id='".$plot_id."'";
        else if ($phone) $where = "phone='".$phone."'";
        else return [];
        // info
        $q = DB::query("SELECT user_id, plot_id, first_name, last_name, phone, email, access, plots FROM users WHERE ".$where." LIMIT 1;") or die (DB::error());		
        if ($row = DB::fetch_row($q)) {
            return [
                'id' => (int) $row['user_id'],
				'plot_id' => $row['plot_id'],
				'first_name' => $row['first_name'],
				'last_name' => $row['last_name'],
				'phone' => $row['phone'],
				'email' => $row['email'],
                'access' => (int) $row['access'],
				'plots' => $row['plots']
            ];
        } else {
            return [
                'id' => 0,
                'access' => 0
            ];
        }
    }

    public static function users_list_plots($number) {
        // vars		
        $items = [];
        // info
        $q = DB::query("SELECT user_id, plot_id, first_name, email, phone, plots
            FROM users WHERE plot_id LIKE '%".$number."%' ORDER BY user_id;") or die (DB::error());
        while ($row = DB::fetch_row($q)) {
            $plot_ids = explode(',', $row['plot_id']);
            $val = false;
            foreach($plot_ids as $plot_id) if ($plot_id == $number) $val = true;
            if ($val) $items[] = [
                'id' => (int) $row['user_id'],
                'first_name' => $row['first_name'],
                'email' => $row['email'],
                'phone_str' => phone_formatting($row['phone'])
            ];
        }
        // output
        return $items;
    }

	public static function users_list($d = []) {
		// vars		
		$search = isset($d['search']) && trim($d['search']) ? $d['search'] : '';
		$search = substr($search, 0, 200);
		$offset = isset($d['offset']) && is_numeric($d['offset']) ? $d['offset'] : 0;
		$limit = 20;
        $items = [];
		// where
        $where = [];
        if ($search) $where[] = "(phone LIKE '%".$search."%' OR first_name LIKE '%".$search."%' OR last_name LIKE '%".$search."%' OR email LIKE '%".$search."%')";
        $where = $where ? "WHERE ".implode(" AND ", $where) : "";
        // info
        $q = DB::query("SELECT user_id, plot_id, first_name, last_name, email, phone, last_login, plots
            FROM users ".$where." ORDER BY user_id ASC LIMIT ".$offset.", ".$limit.";") or die (DB::error());		
        while ($row = DB::fetch_row($q)) {			
			$row['last_login'] = date('Y-m-d H:i:s', $row['last_login']);
			$items[] = $row;
        }		
        // output
		// paginator
        $q = DB::query("SELECT count(*) FROM users ".$where.";");
        $count = ($row = DB::fetch_row($q)) ? $row['count(*)'] : 0;		
		$url = 'users?';
        if ($search) {
			$url .= 'search='.$search;
			$url .= '&';
		}
		paginator($count, $offset, $limit, $url, $paginator);
		return ['items' => $items, 'paginator' => $paginator];
	}
	
	public static function users_fetch($d = []) {
        $info = User::users_list($d);
        HTML::assign('users', $info['items']);
        return ['html' => HTML::fetch('./partials/users_table.html'), 'paginator' => $info['paginator']];
    }
	
	// ACTIONS

    public static function user_edit_window($d = []) {
        //$plot_id = isset($d['plot_id']) && is_numeric($d['plot_id']) ? $d['plot_id'] : 0;
        HTML::assign('user', User::user_info($d));
        return ['html' => HTML::fetch('./partials/user_edit.html')];
    }

    public static function user_edit_update($d = []) {
        // vars
        $plot_id = isset($d['plot_id']) && is_numeric($d['plot_id']) ? $d['plot_id'] : 0;
        $first_name = isset($d['first_name']) && trim($d['first_name']) ? trim($d['first_name']) : '';
		$last_name = isset($d['last_name']) && trim($d['last_name']) ? trim($d['last_name']) : '';
		$d['phone'] = preg_replace('~\D+~', '', $d['phone']);
        $phone = isset($d['phone']) && is_numeric($d['phone']) ? $d['phone'] : '';
		$email = isset($d['email']) && trim($d['email']) ? trim($d['email']) : '';
		$email = strtolower($email);
		$plots = isset($d['plots']) && trim($d['plots']) ? trim($d['plots']) : '';
        $offset = isset($d['offset']) ? preg_replace('~\D+~', '', $d['offset']) : 0;
        // update
        if ($plot_id) {
            $set = [];
            $set[] = "first_name='".$first_name."'";
            $set[] = "last_name='".$last_name."'";
            $set[] = "phone='".$phone."'";
            $set[] = "email='".$email."'";
			$set[] = "plots='".$plots."'";
            $set[] = "updated='".Session::$ts."'";
            $set = implode(", ", $set);
            DB::query("UPDATE users SET ".$set." WHERE plot_id='".$plot_id."' LIMIT 1;") or die (DB::error());
        } else {
            DB::query("INSERT INTO users (
				plot_id,
                first_name,
                last_name,
                phone,
                email,
                updated,
				plots
            ) VALUES (
				'".$plot_id."',
                '".$first_name."',
                '".$last_name."',
                '".$phone."',
                '".$email."',
                '".Session::$ts."',
				'".$plots."'
            );") or die (DB::error());
        }
        // output
        return User::users_fetch(['offset' => $offset]);
    }
	
	public static function user_create_window($d = []) {        
        HTML::assign('user', User::user_info($d));
        return ['html' => HTML::fetch('./partials/user_create.html')];
    }
	
	public static function user_create($d = []) {
        // vars
        $plot_id = isset($d['plot_id']) && is_numeric($d['plot_id']) ? $d['plot_id'] : 0;
        $first_name = isset($d['first_name']) && trim($d['first_name']) ? trim($d['first_name']) : '';
		$last_name = isset($d['last_name']) && trim($d['last_name']) ? trim($d['last_name']) : '';
		$d['phone'] = preg_replace('~\D+~', '', $d['phone']);
        $phone = isset($d['phone']) && is_numeric($d['phone']) ? $d['phone'] : '';
		$email = isset($d['email']) && trim($d['email']) ? trim($d['email']) : ''; 
		$email = strtolower($email);
		$plots = isset($d['plots']) && trim($d['plots']) ? trim($d['plots']) : '';
        $offset = isset($d['offset']) ? preg_replace('~\D+~', '', $d['offset']) : 0;
		
		//create
		DB::query("INSERT INTO users (
			plot_id,
			first_name,
			last_name,
			phone,
			email,
			updated,
			plots
		) VALUES (
			'".$plot_id."',
			'".$first_name."',
			'".$last_name."',
			'".$phone."',
			'".$email."',
			'".Session::$ts."',
			'".$plots."'
		);") or die (DB::error());
				
        // output
        return User::users_fetch(['offset' => $offset]);
    }
	
	public static function user_delete_window($d = []) {
		HTML::assign('user', User::user_info($d));
        return ['html' => HTML::fetch('./partials/delete_warning.html')];
	}
	
	public static function user_delete($d = []) {
        // vars
        $plot_id = isset($d['plot_id']) && is_numeric($d['plot_id']) ? $d['plot_id'] : 0;
		
		//delete
		DB::query("DELETE FROM users WHERE plot_id = ".$plot_id.";") or die (DB::error());
	}
}
