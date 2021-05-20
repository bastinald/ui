<?php

namespace App\Components\Auth;

use Bastinald\UI\Traits\WithData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileEdit extends Component
{
    use WithData, WithFileUploads;

    public function mount()
    {
        $this->setData(Auth::user()->toArray());
    }

    public function render()
    {
        return view('auth.profile-edit');
    }

    public function rules()
    {
        return [
            'name' => 'required|alpha_dash|min:2|max:20|unique:users,name,' . Auth::user()->id,
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'avatar' => 'nullable' . ($this->hasUploadedData('avatar') ? '|image|max:1024' : ''),
        ];
    }

    public function save()
    {
        $this->validateData();

        if ($this->hasUploadedData('avatar')) {
            $avatar = $this->getData('avatar');
            $path = $avatar->hashName('avatars');

            Storage::put($path, Image::make($avatar)->fit(100)->encode());

            $this->setData('avatar', $path);
        }

        Auth::user()->update($this->getData());

        $this->emit('hideModal');
    }
}
