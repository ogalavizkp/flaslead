<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PresaleResource\Pages;
use App\Models\Presale;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PresaleResource extends Resource
{
    protected static ?string $model = Presale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('presale.Presales');
    }

    public function getTitle(): string
    {
        return __('presale.Presales');
    }

  public static function getModelLabel(): string
    {
        return __('presale.Presale');
    }
public static function getPluralModelLabel(): string
    {
        return __('presale.Presales');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Forms\Components\Select::make('company_id')
                    ->label(__('presale.Company Name'))
                    ->relationship('companies', 'name') // Relación con el modelo User
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),



                Forms\Components\Select::make('portfolio')
                    ->label(__('presale.portfolio'))
                    ->options([
                        'wvx_crm' => 'WVX CRM',
                        'wvx_omni' => 'WVX OMNI',
                        'wvx_conv_ia' => 'WVX CONV IA',
                        'wvx_chatbot' => 'WVX CHATBOT',
                        'wvx_voicebot' => 'WVX VOICEBOT',
                        'ippbxalo' => 'IPPBXALO',
                        'callcenter_qm' => 'CALLCENTER QM',
                        'power_bi_integration' => 'POWER BI INTEGRATION',
                        'integracion_custom' => 'INTEGRACION CUSTOM',
                    ])
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->columnSpanFull()
                    ->mutateDehydratedStateUsing(fn($state) => is_array($state) ? implode(',', $state) : $state) // <-- ESTO
                    ->extraAttributes([
                        'style' => 'height: auto; padding: 10px; font-size: 16px;',
                    ]),


                Forms\Components\Select::make('task_type')
                    ->label(__('presale.Task type'))
                    ->options([
                        'Advisory' => __('presale.task_types.Advisory'),
                        'Feasibility' => __('presale.task_types.Feasibility'),
                        'Support' => __('presale.task_types.Support'),
                    ])
                    ->default('support') // Opción por defecto
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),


                Forms\Components\TextInput::make('meeting_subject')
                    ->label(__('presale.meeting_subject'))
                    ->maxLength(100) // <- Aquí defines la longitud máxima permitida
                    ->columnSpanFull()
                    ->extraInputAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),


                Forms\Components\DateTimePicker::make('start_date')
                    ->label(__('presale.start_date'))
                    ->required()
                    ->withoutSeconds()
                    ->columnSpanFull()
                    ->extraInputAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),


                Forms\Components\Select::make('assigned_to')
                    ->label(__('presale.assigned_to'))
                    ->relationship('assignedTo', 'name') // Relación con el modelo User
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),

                Forms\Components\Select::make('commercial_id')
                    ->label(__('presale.commercial_id'))
                    ->relationship('commercial', 'name') // Relación con el modelo User
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),



                Forms\Components\Select::make('priority')
                    ->label(__('presale.priority'))
                    ->options([
                        'high' => __('presale.priorities.high'),
                        'medium' => __('presale.priorities.medium'),
                        'low' => __('presale.priorities.low'),
                    ])
                    ->default('medium') // Opción por defecto
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),




                Forms\Components\TagsInput::make('notification_emails')
                    ->label(__('presale.notification_emails'))
                    ->placeholder(__('presale.add email'))
                    ->separator(',')
                    ->columnSpanFull()
                    ->mutateDehydratedStateUsing(fn($state) => is_array($state) ? implode(',', $state) : $state) // <-- ESTO
                    ->extraAttributes([
                        'style' => 'height: auto; padding: 10px; font-size: 16px;',
                    ]),

                Forms\Components\RichEditor::make('description')
                    ->label(__('presale.description'))
                    ->columnSpanFull()->extraInputAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->label(__('id'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('companies.name')
                    ->label(__('presale.companies.name'))
                    ->numeric()
                    ->sortable(),


                Tables\Columns\TextColumn::make('portfolio')
                    ->label(__('presale.portfolio'))
                    ->searchable(),
                /*

                Tables\Columns\TextColumn::make('meeting_subject')
                    ->searchable(),
*/



                Tables\Columns\TextColumn::make('task_type')
                    ->label(__('presale.task_type'))
                    ->formatStateUsing(fn (string $state) => __("presale.task_types.$state")),

                Tables\Columns\TextColumn::make('commercial.name')
                    ->label(__('presale.commercial.name'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('assignedTo.name')
                    ->label(__('presale.assignedTo.name'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('priority')
                    ->label(__('presale.priority'))
                     ->formatStateUsing(fn (string $state) => __("presale.priorities.$state")),


                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('presale.start_date'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('presale.status'))
                    ->formatStateUsing(fn (string $state) => __("presale.status.$state")),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPresales::route('/'),
            'create' => Pages\CreatePresale::route('/create'),
            'edit' => Pages\EditPresale::route('/{record}/edit'),
        ];
    }
}
