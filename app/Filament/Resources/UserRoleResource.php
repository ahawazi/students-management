<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserRoleResource\Pages;
use App\Filament\Resources\UserRoleResource\RelationManagers;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class UserRoleResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->label('Assign Roles')
                    ->options(Role::all()->pluck('name', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->sortable()
                    ->badge()
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->visible(fn ($record) => $record->hasRole('teacher')),
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
            'index' => Pages\ListUserRoles::route('/'),
            'create' => Pages\CreateUserRole::route('/create'),
            'edit' => Pages\EditUserRole::route('/{record}/edit'),
        ];
    }
}
