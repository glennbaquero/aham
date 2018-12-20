<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class Location extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected $request;

    const MINIMAL_COLUMN = [
        'id', 
        'address',
    ];

    const TABLE_COLUMNS = [
        'id', 'address',
    ];

    protected $casts = [
        'emails' => 'array',
        'contacts' => 'array',
    ];

    /**
     * @TNT Search
     */
    public $asYouType = true;
    
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'contacts' => $this->contact,
            'emails' => $this->email,
        ];
    }

    /**
     * @Methods
     */
    public static function store($request, $item = null) {
        $vars = $request->only(['name', 'address', 'latitude', 'longitude', 'contacts', 'emails']);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        return $item;
    }

    public static function getPositionByAddress($address) {
        $lat = null;
        $lng = null;

        $string = str_replace (" ", "+", urlencode($address));
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?';
        $url .= "address={$string}";
        $url .= '&components=country:PH';
        $url .= '&sensor=true';
        $url .= '&key=' . config('custom.gmap.key');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        if ($response['status'] == 'OK') {
            $lat = $response['results'][0]['geometry']['location']['lat'];
            $lng = $response['results'][0]['geometry']['location']['lng'];
            $message = 'You have successfully fetch the address position.';
        } else {
            $message = $response['status'];
        }

        return [
            'latitude' => $lat,
            'longitude' => $lng,
            'message' => $message,
        ];
    }

    /**
     * @Renders
     */
    public function renderName() {
        return '#' . $this->id . ' ' . $this->name;
    }

    public function renderPosition() {
        return $this->latitude . ', ' . $this->longitude;
    }

    public function renderView() {
        return route('admin.locations.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.locations.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.locations.restore', $this->id);
    }
}
