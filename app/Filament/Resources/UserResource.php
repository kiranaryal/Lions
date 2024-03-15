<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name'),
                TextInput::make('name')->required(),
                TextInput::make('email')->required(),
                TextInput::make('lion_id')->required(),
                TextInput::make('phone')->required(),
                Forms\Components\Toggle::make('is_admin'),

            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->searchable()
            ->sortable()->wrap(),
            Tables\Columns\TextColumn::make('email')->searchable()
            ->sortable()->wrap(),
            IconColumn::make('is_admin')
            ->icon(fn (string $state): string => match ($state) {
                  '' => 'heroicon-o-user',
                  '0' => 'heroicon-o-user',
                  '1' => 'heroicon-o-check-circle',
                 })
            ->color(fn (string $state): string => match ($state) {
                    '' => 'info',
                    '0' => 'grey',
                    '1' => 'success',
    })
            ])
            ->filters([
                Filter::make('Only Admin')->toggle()
                ->query(fn (Builder $query): Builder => $query->where('is_admin', true)),
                Filter::make('Only Users')->toggle()
                ->query(fn (Builder $query): Builder => $query->whereNot('is_admin', true)),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->actions([

                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
