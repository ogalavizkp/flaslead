<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255)
                    ->default('empresa')->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('trade_name')
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('identification_type')
                    ->required()
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('identification')
                    ->required()
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull()->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('country')
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('phone2')
                    ->tel()
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('phone3')
                    ->tel()
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('category')
                    ->required()
                    ->maxLength(255)
                    ->default('prospecto')->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('activo')->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('employees')
                    ->numeric()->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\TextInput::make('revenue_range')
                    ->maxLength(255)->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                Forms\Components\RichEditor::make('notes')
                      ->columnSpanFull()->extraInputAttributes([
                        'style' => 'height: 50px; padding: 10px; font-size: 16px;',
                    ]),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('trade_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identification_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identification')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('employees')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('revenue_range')
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('account_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
