<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_code',
        'customer_name',
        'customer_phone',
        'customer_email',
        'shipping_address',
        'payment_method',
        'total_amount',
        'status',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    /**
     * User who placed the order (optional)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Order items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Formatted total accessor
     */
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    /**
     * Payment method label
     */
    public function getPaymentMethodLabelAttribute()
    {
        $methods = [
            'transfer_bca' => 'Transfer Bank BCA',
            'transfer_mandiri' => 'Transfer Bank Mandiri',
            'transfer_bri' => 'Transfer Bank BRI',
            'qris' => 'QRIS (Gopay/OVO/Dana/ShopeePay)',
            'cod' => 'Bayar di Tempat (COD)',
        ];
        return $methods[$this->payment_method] ?? ucfirst($this->payment_method);
    }

    /**
     * Status badge accessor
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning text-dark"><i class="bi bi-clock-history me-1"></i>Menunggu Konfirmasi</span>',
            'processing' => '<span class="badge bg-info text-dark"><i class="bi bi-gear-fill me-1"></i>Diproses</span>',
            'shipped' => '<span class="badge bg-primary"><i class="bi bi-truck me-1"></i>Dikirim</span>',
            'completed' => '<span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>Selesai</span>',
            'cancelled' => '<span class="badge bg-danger"><i class="bi bi-x-circle-fill me-1"></i>Dibatalkan</span>',
        ];
        return $badges[$this->status] ?? '<span class="badge bg-secondary">' . ucfirst($this->status) . '</span>';
    }
}
