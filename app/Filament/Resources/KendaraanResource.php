<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kendaraan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KendaraanResource\Pages;
use App\Filament\Resources\KendaraanResource\RelationManagers;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Input for jenis_mobil
                TextInput::make('jenis_mobil')
                    ->label('Jenis Mobil')
                    ->required()
                    ->maxLength(255),

                // Input for nomor_plat
                TextInput::make('nomor_plat')
                    ->label('Nomor Plat')
                    ->required()
                    ->maxLength(255)
                    ->regex('/^[A-Z]{1,2}\s\d{1,4}\s[A-Z]{1,3}$/'), // Validasi plat nomor Indonesia,

                // Input for tahun_pembuatan
                TextInput::make('tahun_pembuatan')
                    ->label('Tahun Pembuatan')
                    ->required()
                    ->numeric()
                    ->rules(['min:1900', 'max:' . date('Y')]),

                // Select for status_ketersediaan
                Select::make('status_ketersediaan')
                    ->label('Status Ketersediaan')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak tersedia' => 'Tidak Tersedia',
                    ])
                    ->required(),

                // Input for harga_sewa
                TextInput::make('harga_sewa')
                    ->label('Harga Sewa (Rp)')
                    ->required()
                    ->numeric()
                    ->minValue(0),

                // Input for durasi
                TextInput::make('durasi')
                    ->label('Durasi (Hari)')
                    ->required()
                    ->numeric()
                    ->minValue(1),

                // File upload for gambar
                FileUpload::make('gambar')
                    ->label('Gambar Kendaraan')
                    ->image()
                    ->disk('public') // Menyimpan file di disk 'public'
                    ->directory('kendaraans') // Direktori untuk gambar kendaraan
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_mobil')
                    ->label('Jenis Mobil')
                    ->sortable(),
                
                TextColumn::make('nomor_plat')
                    ->label('Nomor Plat')
                    ->sortable(),
                
                TextColumn::make('tahun_pembuatan')
                    ->label('Tahun Pembuatan')
                    ->sortable(),
                
                TextColumn::make('status_ketersediaan')
                    ->label('Status Ketersediaan')
                    ->sortable(),
                
                TextColumn::make('harga_sewa')
                    ->label('Harga Sewa (Rp)')
                    ->sortable()
                    ->money('IDR'), // Menampilkan harga dalam format IDR

                TextColumn::make('durasi')
                    ->label('Durasi (Hari)')
                    ->sortable(),

            ])
            ->filters([
                // Menambahkan filter berdasarkan status ketersediaan
                Tables\Filters\SelectFilter::make('status_ketersediaan')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak tersedia' => 'Tidak Tersedia',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKendaraans::route('/'),
            'create' => Pages\CreateKendaraan::route('/create'),
            'edit' => Pages\EditKendaraan::route('/{record}/edit'),
        ];
    }
}
