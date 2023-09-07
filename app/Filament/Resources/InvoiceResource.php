<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use DatePeriod;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Servicios';
    protected static ?string $slug = 'facturas';
    protected static ?string $navigationLabel = 'Facturas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('month')
                ->options(self::$model::MONTH)
                ->label('Mes')
                ->required()
                ->placeholder('Escoge una opción'),

                Select::make('year')
                ->options(self::$model::YEAR)
                ->label('Año')
                ->required()
                ->placeholder('Escoge una opción'),

                TextInput::make('total_to_pay')
                ->required()
                ->maxLength(255)
                ->label('Precio')
                ->numeric(),

                Select::make('subscription_id')
                ->Relationship('sunscriptions','id')
                ->required()
                ->placeholder('Escoge una opción')
                ->label('Subscripción'),

                TextInput::make('state')
                ->label("Estado")
            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
        ->emptyStateHeading("Aún no hay publicaciones.")
                ->emptyStateDescription('Crea una factura para empezar.')
            ->columns([
                TextColumn::make('period')
                ->sortable()
                ->label('Periodo'),

                TextColumn::make('price')
                ->sortable()
                ->label('Precio'),

                TextColumn::make('plans.name')
                ->toggleable(isToggledHiddenByDefault: false)
                ->sortable()
                ->label('Plan'),

                TextColumn::make('state')
                ->sortable()
                ->label('Estado'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
              ->label('Editar'),

              Action::make('delete')
              ->label('Eliminar')
              ->requiresConfirmation()
              ->action(fn (Invoice $record) => $record->delete())
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
            'index' => Pages\ListInvoices::route('/'),
            // 'generate' => Pages\GenerateInvoice::route('/generate'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }    
}
