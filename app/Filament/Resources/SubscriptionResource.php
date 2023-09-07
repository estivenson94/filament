<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Filament\Resources\SubscriptionResource\RelationManagers;
use App\Models\Subscription;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?string $slug = 'subscripciones';
    protected static ?string $navigationLabel = 'Subscripciones';
    protected static ?string $navigationGroup = 'Servicios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('client_id')
                ->Relationship('clients','name')
                ->required()
                ->placeholder('Escoge una opción')
                ->label('Cliente'),

                Select::make('plan_id')
                ->Relationship('plans','name')
                ->required()
                ->placeholder('Escoge una opción')
                ->label('Plan'),

                Checkbox::make('state')
                ->label('Estado'),

                Checkbox::make('apply_invoice')
                ->label('Aplica Factura'),

                TextInput::make('discount')
                ->minValue(1)
                ->numeric()
                ->label("Descuento")
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading("Aún no hay publicaciones.")
            ->emptyStateDescription('Crea una subscripción para empezar.')
            ->columns([
                TextColumn::make('clients.name')
                ->sortable()
                ->label('Nombre'),
                TextColumn::make('clients.lastname')
                ->sortable()
                ->label('Apellido'),

                TextColumn::make('plans.name')
                ->sortable()
                ->label('Plan'),

                CheckboxColumn::make('state')
                ->label('Estado'),

                CheckboxColumn::make('apply_invoice')
                ->label('Aplica Factura'),

                TextColumn::make('discount')
                ->sortable()
                ->label('Descuento')
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
                    Select::make('client_id')
                    ->Relationship('clients','name')
                    ->label('Nombre'),
                    Select::make('client_id')
                    ->Relationship('clients','lastname')
                    ->label('Apellido'),
                    Select::make('plan_id')
                    ->Relationship('plans','name')
                    ->label('Plan'),
                    Checkbox::make('state')
                    ->label('Estado'),
                    Checkbox::make('apply_invoice')
                    ->label('Aplica Factura'),
                    TextInput::make('discount')
                    ->label('Descuento'),
                ])->disabledForm(),


                Tables\Actions\EditAction::make()
              ->label('Editar'),

              Tables\Actions\DeleteAction::make('delete')
              ->label('Eliminar')
              ->requiresConfirmation()
              ->action(fn (Subscription $record) => $record->delete())
              ->color('danger')
              ->modalHeading('Eliminar Subscripción?')
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }    
}
