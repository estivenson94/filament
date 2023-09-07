<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $slug = 'clientes';
    protected static ?string $navigationLabel = 'Clientes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Nombre'),

                TextInput::make('lastname')
                ->maxLength(255)
                ->label('Apellidos'),

                TextInput::make('phone')
                ->maxLength(255)
                ->label('Telefono'),

                TextInput::make('street')
                ->maxLength(255)
                ->label('Dirección'),

            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
        ->emptyStateHeading("Aún no hay publicaciones.")
        ->emptyStateDescription('Crea un cliente para empezar.')
            ->columns([
                TextColumn::make('name')
                ->wrap()
                ->label('Nombre')
                ->searchable(),

                TextColumn::make('lastname')
                ->wrap()
                ->label('Apellidos')
                ->searchable(),

                TextColumn::make('phone')
                ->wrap()
                ->label('Telefono')
                ->searchable(),

                TextColumn::make('street')
                ->wrap()
                ->label('Dirección')
                ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\ViewAction::make()
                ->label('Ver')
                ->color('info')
                ->form([
                    TextInput::make('name'),
                    TextInput::make('lastname'),
                    TextInput::make('phone'),
                    TextInput::make('street'),
                ]),

                Tables\Actions\EditAction::make()
              ->label('Editar'),

              Tables\Actions\DeleteAction::make('delete')
              ->label('Eliminar')
              ->requiresConfirmation()
              ->action(fn (Client $record) => $record->delete())
              ->color('danger')
              ->modalHeading('Eliminar Cliente ?')
              ->modalSubheading('¿Estás seguro de que deseas eliminar estas publicaciones? Esto no se puede deshacer.')
             ->modalButton('Si, borrarlos')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            // RelationManagers\InstallationRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }    
}
