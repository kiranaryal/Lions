<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Filament\Resources\ProfileResource\RelationManagers;
use App\Models\Profile;
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

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->relationship('user', 'name'),
                TextInput::make('full_name')->required(),
                TextInput::make('public_email')->required(),
                TextInput::make('public_phone')->required(),
                TextInput::make('nationality')->required(),
                TextInput::make('position')->required(),
                TextInput::make('home_club')->required(),
                TextInput::make('city')->required(),
                TextInput::make('address')->required(),
                TextArea::make('about')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([ Tables\Columns\TextColumn::make('user.name')->searchable()
            ->sortable()->wrap(),
                Tables\Columns\TextColumn::make('full_name')->searchable()
                ->sortable()->wrap(),
                Tables\Columns\TextColumn::make('public_email')->searchable()
                ->sortable()->wrap(),
                Tables\Columns\TextColumn::make('public_phone')->searchable()
                ->sortable()->wrap(),

                Tables\Columns\TextColumn::make('home_club')->searchable()
                ->sortable()->wrap(),

                Tables\Columns\TextColumn::make('address')->searchable()
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
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
