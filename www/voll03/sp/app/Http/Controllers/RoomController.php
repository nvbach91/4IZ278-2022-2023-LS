<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Room;

const ROOMS_REHEARSAL = 'rehearsal';
const ROOMS_STUDIO = 'studio';

class RoomController extends Controller
{
    public function listRooms()
    {
        return view('rooms.index', [
            'heading' => 'Available rehearsing rooms',
            'allRooms' => $this->fetchRooms(ROOMS_REHEARSAL)
        ]);
    }

    public function listStudios()
    {
        return view('rooms.index', [
            'heading' => 'Available studios for recording sessions',
            'allRooms' => $this->fetchRooms(ROOMS_STUDIO)
        ]);
    }

    public function showRoom(int $room_id)
    {
        return view('rooms.show', ['room' => $this->fetchRoom($room_id)]);
    }

    private function fetchRoom(int $id)
    {
        return Room::join('address', 'address.id', '=', 'room.address_id')
            ->where('room.id', $id)
            ->first();
    }

    private function fetchRooms(string $type)
    {
        // get all rooms from db
        $query = Room::join('address', 'address.id', '=', 'room.address_id')
            ->where('type', $type)
            ->orderBy('name', 'asc')
            ->get([
                'room.id', 'room.name', 'room.price', 'room.size', 'room.description',
                'room.photo_file', 'room.type', 'room.address_id', 'address.street',
                'address.city', 'address.zipcode', 'address.country'
            ]);;

        // get addresses
        $addressess = Address::get();
        $rooms = [];

        // prepare city array
        foreach ($addressess as $address) {
            $rooms[$address->city] = [];
        }

        // push all queries into array sorted by city
        foreach ($query as $item) {
            array_push($rooms[$item->city], $item);
        }

        return $rooms;
    }
}
