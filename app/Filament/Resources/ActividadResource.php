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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                MorphToSelect::make('relacionable')
                    ->types([
                        MorphToSelect\Type::make(\App\Models\Company::class)
                            ->titleAttribute('name')
                            ->label('Compañía'),
                    ])
                    ->required()
                    ->label('actividad.Relacionado con')
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
                Forms\Components\RichEditor::make('description')
                    ->label(__('actividad.description'))
                    ->columnSpanFull()->extraInputAttributes([
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('relacionable.name')
                    ->label('actividad.Compañía Relacionada')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('titulo')
                    ->label('actividad.titulo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('actividad.tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prioridad')
                    ->label('actividad.prioridad')
                    ->searchable(),
                Tables\Columns\IconColumn::make('estado')
                    ->label('actividad.estado')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('actividad.created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('actividad.updated_at')
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
