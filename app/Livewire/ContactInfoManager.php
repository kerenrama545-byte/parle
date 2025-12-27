<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactInfo;

class ContactInfoManager extends Component
{
    public $contacts = [];

    public function mount()
    {
        $this->contacts = ContactInfo::all()->map(function ($c) {
            return [
                'id' => $c->id,
                'city' => $c->city,
                'address' => $c->address,
                'email' => $c->email,
            ];
        })->toArray();
    }

    public function addContact()
    {
        $this->contacts[] = ['id' => null, 'city' => '', 'address' => '', 'email' => ''];
    }

    public function removeContact($index)
    {
        if (isset($this->contacts[$index]['id'])) {
            ContactInfo::destroy($this->contacts[$index]['id']);
        }
        array_splice($this->contacts, $index, 1);
    }

    public function save()
    {
        foreach ($this->contacts as $contact) {
            $data = [
                'city' => $contact['city'],
                'address' => $contact['address'],
                'email' => $contact['email'],
            ];

            if (!empty($contact['id'])) {
                ContactInfo::find($contact['id'])->update($data);
            } else {
                ContactInfo::create($data);
            }
        }

        session()->flash('success', 'All contacts saved successfully!');
    }

    public function render()
    {
        return view('livewire.contact-info-manager');
    }
}
