<?php

namespace App\Filament\Resources\PresaleResource\Pages;

use App\Filament\Resources\PresaleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Carbon\Carbon;

class CreatePresale extends CreateRecord
{
    protected static string $resource = PresaleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();
        $data['account_id'] = Auth::user()->account_id;
        $data['end_date'] = Carbon::parse($data['start_date'])->addHour();
        return $data;
    }

    protected function afterCreate(): void
    {
        $presale = $this->record->load('commercial');

        $apiKey = config('services.mailgun.key');
        $domain = config('services.mailgun.domain');


        /* -------------------------- Invitación Publica ------------------------------ */
        /* ---------------------------------------------------------------------------- */
        Http::withBasicAuth('api', $apiKey)
            ->asForm()
            ->post("https://api.mailgun.net/v3/{$domain}/messages", [
                'from'    => 'noreply@' . $domain,
                'to'      => $presale->notification_emails,
                'cc'      => collect([
                    $presale->commercial->email ?? null,
                    //$presale->assignedTo->email ?? null,
                ])->filter()->implode(','), // filtra nulos y junta con coma
                'subject' => 'Actividad de Preventa  AloGlobal - ' . $presale->companies->name, // opcional, puede venir del template
                'template' => 'notificación preventa', // ID del template creado en Mailgun
                'h:Reply-To' => $presale->commercial->email ?? 'preventa@aloglobal.com',
                'h:X-Mailgun-Variables' => json_encode([
                    'portfolio'       => $presale->portfolio,
                    'inicia'      => $presale->start_date,
                    'tipo_tarea'       => __($presale->task_type),
                    'comercial'      => $presale->commercial->name ?? 'N/A',
                    'ingeniero'      => $presale->assignedTo->name ?? 'N/A',
                    'cliente'      => $presale->companies->name ?? 'N/A',

                ])
            ]);

        /* -------------------------- Invitación Privada ------------------------------ */
        /* ---------------------------------------------------------------------------- */
        Http::withBasicAuth('api', $apiKey)
            ->asForm()
            ->post("https://api.mailgun.net/v3/{$domain}/messages", [
                'from'    => 'noreply@' . $domain,
                //'to'      => $presale->assignedTo->email,
                'to'      => "preventa@aloglobal.com",
                'subject' => 'Actividad de Preventa|' . $presale->companies->name . ' - ' . $presale->assignedTo->name,
                'template' => 'notificación preventa interna', // ID del template creado en Mailgun
                'h:Reply-To' => 'ogalaviz@aloglobal.com',
                'h:X-Mailgun-Variables' => json_encode([
                    'portfolio'       => $presale->portfolio,
                    'inicia'      => $presale->start_date,
                    'tipo_tarea'       => __($presale->task_type),
                    'priority'       => __($presale->priority),
                    'commercial'      => $presale->commercial->name ?? 'N/A',
                    'ingeniero'      => $presale->assignedTo->name ?? 'N/A',
                    'cliente'      => $presale->companies->name ?? 'N/A',
                    'descripcion'      => $presale->description ?? 'N/A',
                    'asunto'      => $presale->meeting_subject ?? 'N/A',
                ])
            ]);
    }
}
