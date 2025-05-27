<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActividadResource\Pages;
use App\Filament\Resources\ActividadResource\RelationManagers;
use App\Models\Actividad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\MorphToSelect;


class ActividadResource extends Resource
{
    protected static ?string $model = Actividad::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public function getTitle(): string
    {
        return __('actividad.actividads');
    }

    public static function getModelLabel(): string
    {
        return __('actividad.actividads');
    }

    public static function getPluralModelLabel(): string
    {
        return __('actividad.actividads');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('company_id')
                    ->label(__('actividad.company_id'))
                    ->relationship('company', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),

                Forms\Components\TextInput::make('titulo')
                    ->label(__('actividad.titulo'))
                    ->required()
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),

                Forms\Components\TextInput::make('tipo')
                    ->label(__('actividad.tipo'))
                    ->required()
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('prioridad')
                    ->label(__('actividad.prioridad'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\Toggle::make('estado')
                    ->label(__('actividad.estado'))
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\Toggle::make('recordatorio')
                    ->label(__('actividad.recordatorio'))
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\DateTimePicker::make('recordatorio_fecha')
                    ->label(__('actividad.recordatorio_fecha'))
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\RichEditor::make('description')
                    ->label(__('actividad.description'))
                    ->columnSpanFull()->extraInputAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
            ])
            ->extraAttributes(['class' => 'w-full']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('relacionable.name')
                    ->label(__('actividad.Compañía Relacionada'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('titulo')
                    ->label(__('actividad.titulo'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label(__('actividad.tipo'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('prioridad')
                    ->label(__('actividad.prioridad'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('estado')
                    ->label(__('actividad.estado'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('actividad.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('actividad.updated_at'))
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
            'index' => Pages\ListActividads::route('/'),
            'create' => Pages\CreateActividad::route('/create'),
            'edit' => Pages\EditActividad::route('/{record}/edit'),
        ];
    }
}
