@props(['sale'])

<div class="modal fade" id="receiptModal{{ $sale->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm shadow-lg">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-2" id="printArea{{ $sale->id }}">
                <div class="text-center mb-4">
                    <h5 class="fw-bold mb-1 text-success">CV KABAYAN GROUP</h5>
                    <p class="text-muted mb-0" style="font-size: 10px; line-height: 1.2;">
                        General Supplier & Trading<br>
                        Telp: 0812-xxxx-xxxx<br>
                        Bandung, Jawa Barat
                    </p>
                </div>

                <div class="border-top border-bottom py-2 mb-3" style="font-size: 11px; border-style: dashed !important;">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">No. Invoice</span>
                        <span class="fw-bold text-dark">#INV-{{ $sale->id }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Tanggal</span>
                        <span>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Pelanggan</span>
                        <span class="fw-bold">{{ $sale->customer->name ?? 'Umum' }}</span>
                    </div>
                </div>

                <table class="table table-sm table-borderless mb-0" style="font-size: 11px;">
                    <thead>
                        <tr class="border-bottom" style="border-style: dotted !important;">
                            <th>Item</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->items as $item)
                        <tr>
                            <td style="max-width: 120px;" class="text-truncate">{{ $item->product->name }}</td>
                            <td class="text-center text-muted">{{ $item->qty }}</td>
                            <td class="text-end fw-semibold text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="border-top mt-3 pt-2" style="border-style: dashed !important;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark">GRAND TOTAL</span>
                        <span class="fs-5 fw-bold text-success">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer border-0 bg-light p-2 rounded-bottom-4">
                <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-sm btn-dark px-3" onclick="printReceipt('printArea{{ $sale->id }}')">
                    <i class="bi bi-printer me-1"></i> Cetak Struk
                </button>
            </div>
        </div>
    </div>
</div>