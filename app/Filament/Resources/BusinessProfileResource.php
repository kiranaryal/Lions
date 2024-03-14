<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessProfileResource\Pages;
use App\Filament\Resources\BusinessProfileResource\RelationManagers;
use App\Models\BusinessProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Enums\FiltersLayout;
 use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Textarea;

class BusinessProfileResource extends Resource
{
    protected static ?string $model = BusinessProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('org_name')->required(),
                TextInput::make('address')->required(),
                TextInput::make('city')->required(),
                TextInput::make('email')->required(),
                TextInput::make('phone')->required(),
                TextInput::make('website')->required(),
                TextInput::make('services')->required(),
                TextInput::make('facebook')->required(),
                TextArea::make('instagram')->required(),
                TextArea::make('linkedin')->required(),
                TextArea::make('about')->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('org_name')->searchable()
                ->sortable()->wrap(),
                Tables\Columns\TextColumn::make('address')->searchable()
                ->sortable()->wrap(),
                Tables\Columns\TextColumn::make('city')->searchable()
                ->sortable()->wrap(),

                Tables\Columns\TextColumn::make('email')->searchable()
                ->sortable()->wrap(),

                Tables\Columns\TextColumn::make('phone')->searchable()
                ->sortable()->wrap(),
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
            'index' => Pages\ListBusinessProfiles::route('/'),
            'create' => Pages\CreateBusinessProfile::route('/create'),
            'edit' => Pages\EditBusinessProfile::route('/{record}/edit'),
        ];
    }
}
