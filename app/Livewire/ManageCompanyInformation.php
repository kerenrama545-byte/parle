<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CompanyInformation;
use Illuminate\Support\Facades\Storage;

class ManageCompanyInformation extends Component
{
    use WithFileUploads;

    public $company_name;
    public $logo;
    public $icon;
    public $phones = [];
    public $email;
    public $address;
    public $google_map_link;
    public $opening_hours_days = [];
    public $opening_hours_times = [];
    public $video_profile_link;

    public $logoFile;
    public $iconFile;

    public $companyInfo;

    protected $rules = [
        'company_name' => 'nullable|string|max:255',
        'logoFile' => 'nullable|image|max:1024',
        'iconFile' => 'nullable|mimes:jpg,jpeg,png,ico|max:512',
        'phones.*' => 'nullable|string',
        'email' => 'nullable|email',
        'address' => 'nullable|string',
        'google_map_link' => 'nullable|url',
        'opening_hours_days.*' => 'nullable|string',
        'opening_hours_times.*' => 'nullable|string',
        'video_profile_link' => 'nullable|url',
    ];

    public function mount()
    {
        $this->loadCompanyInfo();
    }

    public function loadCompanyInfo()
    {
        $this->companyInfo = CompanyInformation::first();

        if ($this->companyInfo) {
            $this->company_name = $this->companyInfo->company_name;
            $this->logo = $this->companyInfo->logo;
            $this->icon = $this->companyInfo->icon;
            $this->phones = $this->companyInfo->phones ?? [''];
            $this->email = $this->companyInfo->email;
            $this->address = $this->companyInfo->address;
            $this->google_map_link = $this->companyInfo->google_map_link;
            $this->video_profile_link = $this->companyInfo->video_profile_link;

            if ($this->companyInfo->opening_hours && is_array($this->companyInfo->opening_hours)) {
                $this->opening_hours_days = array_keys($this->companyInfo->opening_hours);
                $this->opening_hours_times = array_values($this->companyInfo->opening_hours);
            } else {
                $this->opening_hours_days = [''];
                $this->opening_hours_times = [''];
            }
        } else {
            $this->phones = [''];
            $this->opening_hours_days = [''];
            $this->opening_hours_times = [''];
        }
    }

    public function save()
    {
        $this->validate();

        $data = [];

        // ====================== Logo ======================
        if ($this->logoFile) {
            $this->validateOnly('logoFile');

            if ($this->logo && Storage::disk('logoicon')->exists($this->logo)) {
                Storage::disk('logoicon')->delete($this->logo);
            }

            $logoName = 'logo_' . time() . '.' . $this->logoFile->getClientOriginalExtension();
            $this->logoFile->storeAs('', $logoName, 'logoicon');
            $data['logo'] = $logoName;
            $this->logoFile = null;
        }

        // ====================== Icon ======================
        if ($this->iconFile) {
            $this->validateOnly('iconFile');

            if ($this->icon && Storage::disk('logoicon')->exists($this->icon)) {
                Storage::disk('logoicon')->delete($this->icon);
            }

            $iconName = 'icon_' . time() . '.' . $this->iconFile->getClientOriginalExtension();
            $this->iconFile->storeAs('', $iconName, 'logoicon');
            $data['icon'] = $iconName;
            $this->iconFile = null;
        }

        // ====================== Other Fields ======================
        if (!is_null($this->company_name)) $data['company_name'] = $this->company_name;
        if (!is_null($this->email)) $data['email'] = $this->email;
        if (!is_null($this->address)) $data['address'] = $this->address;
        if (!is_null($this->google_map_link)) $data['google_map_link'] = $this->google_map_link;
        if (!is_null($this->video_profile_link)) $data['video_profile_link'] = $this->video_profile_link;

        $phones = array_filter($this->phones, fn($p) => !empty($p));
        if (!empty($phones)) $data['phones'] = $phones;

        // ====================== Opening Hours ======================
        $combinedHours = [];
        foreach ($this->opening_hours_days as $i => $day) {
            $time = $this->opening_hours_times[$i] ?? null;
            if (!empty($day) && !empty($time)) $combinedHours[$day] = $time;
        }
        if (!empty($combinedHours)) $data['opening_hours'] = $combinedHours;

        // ====================== Save ======================
        if ($this->companyInfo) {
            $this->companyInfo->update($data);
        } else {
            $this->companyInfo = CompanyInformation::create($data);
        }

        session()->flash('message', 'Company information updated successfully!');
        $this->loadCompanyInfo();
    }

    // ====================== Helpers ======================
    public function updatedLogoFile() { $this->validateOnly('logoFile'); }
    public function updatedIconFile() { $this->validateOnly('iconFile'); }

    public function addPhone() { $this->phones[] = ''; }
    public function removePhone($index) { unset($this->phones[$index]); $this->phones = array_values($this->phones); }

    public function addOpeningHour() { $this->opening_hours_days[] = ''; $this->opening_hours_times[] = ''; }
    public function removeOpeningHour($index) {
        unset($this->opening_hours_days[$index], $this->opening_hours_times[$index]);
        $this->opening_hours_days = array_values($this->opening_hours_days);
        $this->opening_hours_times = array_values($this->opening_hours_times);
    }

    public function render()
    {
        return view('livewire.manage-company-information');
    }
}
