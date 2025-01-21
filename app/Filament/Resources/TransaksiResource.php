<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Transaksi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\TransaksiResource\Pages;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kendaraan_id')
                    ->label('Kendaraan')
                    ->relationship('kendaraan', 'jenis_mobil')
                    ->required()
                    ->searchable(),

                TextInput::make('lokasi')
                    ->label('Lokasi')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required()
                    ->default(now()),

                DatePicker::make('tanggal_berakhir')
                    ->label('Tanggal Berakhir')
                    ->required(),

                Select::make('payment')
                    ->label('Metode Pembayaran')
                    ->options([
                        'BRI' => 'BRI',
                        'BCA' => 'BCA',
                        'BANK' => 'BANK',
                        'BANK JAGO' => 'BANK JAGO',
                    ])
                    ->required(),

                TextInput::make('no_rekening')
                    ->label('Nomor Rekening')
                    ->nullable()
                    ->maxLength(255),

                Select::make('status_pembayaran')
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
                TextColumn::make('lokasi')->label('Lokasi'),
                TextColumn::make('tanggal_mulai')->label('Tanggal Mulai'),
                TextColumn::make('tanggal_berakhir')->label('Tanggal Berakhir'),
                TextColumn::make('payment')->label('Metode Pembayaran'),
                TextColumn::make('no_rekening')->label('Nomor Rekening')->default('-'),
                TextColumn::make('status_pembayaran')->label('Status Pembayaran')->sortable(),
                TextColumn::make('total_pembayaran')->label('Total Pembayaran')->money('IDR'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
