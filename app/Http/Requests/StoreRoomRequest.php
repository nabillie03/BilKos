<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        $roomId = $this->route('room')?->id;

        return [
            'room_number' => 'required|string|max:10|unique:rooms,room_number,' . $roomId,
            'type' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'facilities' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'status' => 'required|in:tersedia,terisi',
        ];
    }
}
