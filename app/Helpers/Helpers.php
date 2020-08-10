<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Admin;
use App\Permission;

class Helpers
{
	public static function isDev() {
		return config('app.debug') && config('app.env') === 'local';
	}

    public static function randomOrCreate($class) {
        if ($class::count()) {
            $model = $class::get()->random(1)->first();
        } else {
            $model = factory($class)->create();
        }

        return $model;
    }

	public static function randomFile($dir = 'public/storage/tmp', $required = 10, $extension = 'jpg') {
		$path = false;
		$files = glob($dir . '/*.' . $extension);

		if (count($files) > $required) {
		    $file = array_rand($files);
		    $path = $files[$file];
		}
		
		return str_replace('public/storage/', '', $path);
	}

	public static function getRandomDates($number = 2) {
		$dates = [];

		for ($i = 0; $i < $number; $i++) { 
			$dates[] = Carbon::now()->addDays($i);
		}

		return $dates;
	}

	public static function truncate($string, $end = 120, $start = 0) {
		return substr($string, $start, $end);
	}

	public static function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '_', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function generateRandomString($length = 20, $additionalString = null)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);

        $randomString = null;

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }

        $randomString .= $additionalString;
        
        return $randomString;
    }

    public static function generateRandomInteger($length = 9, $additionalString = null) 
    {
        $characters = '01234567891234567890';
        $charLength = strlen($characters);

        $randomString = null;

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }

        $randomString .= $additionalString;
        
        return $randomString;
    }

    public static function flash(
        $message = 'The operation has successfully executed',
        $title = 'Success!',
        $type= 'success'){
        session()->flash('status_title', $title);
        session()->flash('status_message', $message);
        session()->flash('status_type', $type);
    }

    /**
     * Get Admins base on guard resources
     * @param  Array|String  $guardResources praxxys admin guard resource in controllers
     * @return PRAXXYS\Admin\Models\Admin
     */
    public static function getNotifiableAdmins($guardResources = [])
    {
        $admins = [];

        if (!$guardResources) {
            $admins = Admin::get();
        }

        if ($guardResources) {

            $toNotifyIds = [];

            if (is_array($guardResources)) {
                foreach ($guardResources as $guardResource) {
                    
                    $superAdminIds = static::getAdminsByResource($guardResource);

                    array_push($toNotifyIds, $superAdminIds);
                }
            } else {

                $superAdminIds = static::getAdminsByResource($guardResources);

                array_push($toNotifyIds, $superAdminIds);
            }

            $superAdminIds = Role::where('name', 'super-admin')->first()->users()->pluck('id')->toArray();

            array_push($toNotifyIds, $superAdminIds);

            $toNotifyIds = array_unique(array_flatten($toNotifyIds));

            $admins = Admin::whereIn('id', $toNotifyIds)->get();
        }

        if (!count($admins)) {
            $admins = false;
        }

        return $admins;
    }

    private static function getAdminsByResource($guardResource)
    {
        $toNotifyIds = [];

        $permissions = Permission::where('name', 'like', $guardResource . '%')->get();

        foreach ($permissions as $key => $permission) {
            foreach ($permission->roles as $role) {
                $ids = $role->users()->pluck('id')->toArray();

                array_push($toNotifyIds, $ids);
            }
        }        

        return $toNotifyIds;
    }
}