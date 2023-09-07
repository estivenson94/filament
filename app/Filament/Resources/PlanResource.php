<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Filament\Resources\PlanResource\RelationManagers;
use App\Models\Plan;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationGroup = 'Servicios';
    protected static ?string $navigationIcon = 
    'heroicon-o-squares-2x2';
    protected static ?string $slug = 'planes';
    protected static ?string $navigationLabel = 'Planes';

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Plan'),

                TextInput::make('price')
                ->required()
                ->label('Valor')
                ->numeric(),

                TextInput::make('download_speed')
                ->required()
                ->label('Velocidad de bajada'),

                TextInput::make('upload_speed')
                ->required()
                ->label('Velocidad de subida')
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading("Aún no hay publicaciones.")
            ->emptyStateDescription('Crea un plan para empezar.')
            

            ->columns([
                TextColumn::make('name')
                ->wrap()
                ->label('Nombre')
                ->searchable()
                ->sortable(),

                TextColumn::make('download_speed')
                ->label('V/Bajada')
                ->sortable(),

                TextColumn::make('upload_speed')
                ->label('V/Subida')
                ->sortable(),

                TextColumn::make('price')
                ->wrap()
                ->label('Precio')
                ->searchable()
                ->numeric(
                    decimalPlaces: 0,
                    decimalSeparator: ',',
                    thousandsSeparator: '.',
                )
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->label('Ver')
                ->color('info')
                ->form([
                    TextInput::make('name')
                    ->label('Nombre'),
                    TextInput::make('price')
                    ->label('Precio'),
                    TextInput::make('download_speed')
                    ->label('Velocidad de bajada'),
                    TextInput::make('upload_speed')
                    ->label('Velocidad de subida'),
                ]),


                Tables\Actions\EditAction::make()
                ->label('Editar')
                ->icon('heroicon-o-pencil-square'),
                
                Tables\Actions\DeleteAction::make('delete')
              ->label('Eliminar')
              ->requiresConfirmation()
              ->action(fn (Plan $record) => $record->delete())
              ->color('danger')
              ->modalHeading('Eliminar Ticket?')
              ->modalDescription('¿Estás seguro de que deseas eliminar estas publicaciones? Esto no se puede deshacer.')
             ->modalSubmitActionLabel('Si, borrarlos')
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
            
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }    
}
