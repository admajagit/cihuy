<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Transaksi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Checkbox;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TransaksiResource\Pages;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\TransaksiResource\RelationManagers;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Dropdown for selecting 'kendaraan_id' with the relationship
                Forms\Components\Select::make('kendaraan_id')
                    ->label('Kendaraan')
                    ->relationship('kendaraan', 'jenis_mobil') // Make sure the relationship and field names are correct
                    ->required()
                    ->searchable(),

                // Input for 'lokasi'
                Forms\Components\TextInput::make('lokasi')
                    ->label('Lokasi')
                    ->maxLength(255)
                    ->required(), // Make 'lokasi' required to prevent the SQL error you faced

                // Date Picker for 'tanggal_mulai'
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required()
                    ->default(now()),

                // Input for 'durasi' (in days)
                Forms\Components\TextInput::make('durasi')
                    ->label('Durasi (Hari)')
                    ->required()
                    ->numeric(),

                // Date Picker for 'tanggal_berakhir'
                Forms\Components\DatePicker::make('tanggal_berakhir')
                    ->label('Tanggal Berakhir')
                    ->required(),

                // Input for 'total_harga'
                Forms\Components\TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->required()
                    ->numeric()
                    ->maxLength(15),

                // Dropdown for 'status_pembayaran'
                Forms\Components\Select::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kendaraan.jenis_mobil')->label('Kendaraan'),
                TextColumn::make('lokasi'),
                TextColumn::make('tanggal_mulai'),
                TextColumn::make('durasi'),
                TextColumn::make('tanggal_berakhir'),
                TextColumn::make('total_harga'),
                TextColumn::make('status_pembayaran'),
            ])
            ->filters([
                // Add filters as necessary
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
            // Define any relations if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
