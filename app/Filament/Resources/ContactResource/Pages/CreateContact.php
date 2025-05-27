<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;

     protected function mutateFormDataBeforeCreate(array $data): array
    {
        
        $data['created_by'] = Auth::id();
        $data['account_id'] = Auth::user()->account_id;
        return $data;
    }
}
