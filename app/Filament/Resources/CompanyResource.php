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
                    ->default('empresa')
                    ->label(__('company.type'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('company.name'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('trade_name')
                    ->maxLength(255)
                    ->label(__('company.trade_name'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('identification_type')
                    ->required()
                    ->maxLength(255)
                    ->label(__('company.identification_type'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('identification')
                    ->required()
                    ->maxLength(255)
                    ->label(__('company.identification'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->label(__('company.email'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255)
                    ->label(__('company.website'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\Textarea::make('address')
                    ->label(__('company.address'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('country')
                    ->maxLength(255)
                    ->label(__('company.country'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255)
                    ->label(__('company.city'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)
                    ->label(__('company.phone'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('phone2')
                    ->tel()
                    ->maxLength(255)
                    ->label(__('company.phone2'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('phone3')
                    ->tel()
                    ->maxLength(255)
                    ->label(__('company.phone3'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('category')
                    ->required()
                    ->maxLength(255)
                    ->default('prospecto')
                    ->label(__('company.category'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('activo')
                    ->label(__('company.status'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('employees')
                    ->numeric()
                    ->label(__('company.employees'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\TextInput::make('revenue_range')
                    ->maxLength(255)
                    ->label(__('company.revenue_range'))
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
                Forms\Components\RichEditor::make('notes')
                    ->label(__('company.notes'))
                    ->columnSpanFull()
                    ->extraInputAttributes(['style' => 'height: 50px; padding: 10px; font-size: 16px;']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->label(__('company.type'))->searchable(),
                Tables\Columns\TextColumn::make('name')->label(__('company.name'))->searchable(),
                Tables\Columns\TextColumn::make('trade_name')->label(__('company.trade_name'))->searchable(),
                Tables\Columns\TextColumn::make('identification_type')->label(__('company.identification_type'))->searchable(),
                Tables\Columns\TextColumn::make('identification')->label(__('company.identification'))->searchable(),
                Tables\Columns\TextColumn::make('email')->label(__('company.email'))->searchable(),
                Tables\Columns\TextColumn::make('website')->label(__('company.website'))->searchable(),
                Tables\Columns\TextColumn::make('country')->label(__('company.country'))->searchable(),
                Tables\Columns\TextColumn::make('city')->label(__('company.city'))->searchable(),
                Tables\Columns\TextColumn::make('phone')->label(__('company.phone'))->searchable(),
                Tables\Columns\TextColumn::make('phone2')->label(__('company.phone2'))->searchable(),
                Tables\Columns\TextColumn::make('phone3')->label(__('company.phone3'))->searchable(),
                Tables\Columns\TextColumn::make('category')->label(__('company.category'))->searchable(),
                Tables\Columns\TextColumn::make('status')->label(__('company.status'))->searchable(),
                Tables\Columns\TextColumn::make('employees')->label(__('company.employees'))->numeric()->sortable(),
                Tables\Columns\TextColumn::make('revenue_range')->label(__('company.revenue_range'))->searchable(),
                Tables\Columns\TextColumn::make('owner_id')->label(__('company.owner_id'))->numeric()->sortable(),
                Tables\Columns\TextColumn::make('account_id')->label(__('company.account_id'))->numeric()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('created_at'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label(__('updated_at'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
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
        return [];
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
