# Date Helper - Timezone Makassar (WITA)

Helper ini dibuat untuk memastikan perhitungan tanggal dan waktu konsisten menggunakan timezone Makassar, Indonesia (Asia/Makassar - WITA, UTC+8).

## Fitur

1. **Timezone Konsisten**: Semua operasi tanggal menggunakan timezone Asia/Makassar
2. **Perhitungan Sisa Hari**: Menghitung sisa hari dari hari ini sampai tanggal tertentu dengan tepat
3. **Pergantian Hari**: Perhitungan berubah tepat pada jam 00:00 (tengah malam) waktu Makassar

## Penggunaan

### Get Current Date/Time

```php
use App\Helpers\DateHelper;

// Get current datetime dengan timezone Makassar
$now = DateHelper::now();

// Get current date (start of day) dengan timezone Makassar
$today = DateHelper::today();
```

### Parse Date dengan Timezone

```php
$date = DateHelper::parse('2026-01-25');
```

### Hitung Sisa Hari

```php
$remaining = DateHelper::calculateRemainingDays('2026-01-25');

// Returns:
// [
//     'days' => 4,                    // Jumlah hari (positif = masa depan, negatif = sudah lewat)
//     'text' => '4 days',            // Text untuk display
//     'status' => 'upcoming'         // Status: 'upcoming', 'today', atau 'overdue'
// ]
```

### Format Date

```php
$formatted = DateHelper::format('2026-01-25', 'Y-m-d');
$formatted = DateHelper::format('2026-01-25', 'd F Y');
```

## Contoh di Blade Template

```blade
@php
use App\Helpers\DateHelper;
$remaining = DateHelper::calculateRemainingDays($reservation->end_date);
@endphp

<td>{{ $remaining['text'] }}</td>
<td class="{{ $remaining['status'] == 'overdue' ? 'text-red-600' : 'text-green-600' }}">
    {{ $remaining['days'] }} hari
</td>
```

## Testing

Untuk testing dengan timezone berbeda:

```php
// Set timezone temporarily
config(['app.timezone' => 'Asia/Makassar']);
```

## Catatan

- Perhitungan sisa hari dimulai dari awal hari (00:00:00)
- Pergantian sisa hari terjadi tepat pada jam 00:00 (tengah malam) waktu Makassar
- Jika hari ini 21 Januari dan end_date 25 Januari, sisa hari = 4 hari
- Jika sudah lewat tanggal end_date, akan menampilkan "Overdue X days"
