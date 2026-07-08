@extends('layouts.admin')

@section('title', 'Nhập hàng vào kho')

@section('content')
<style>
.product-container{padding-top:1.5rem}.product-grid{display:grid;grid-template-columns:1fr;gap:1.5rem}@media(min-width:1280px){.product-grid{grid-template-columns:2fr 1fr}}.product-card{background:#fff;border-radius:.5rem;box-shadow:0 1px 3px rgba(0,0,0,.1);padding:1.5rem}.product-title{font-size:1.125rem;font-weight:600;color:#111827;margin-bottom:1.5rem}.product-title a{color:#3b82f6;text-decoration:none}.form-label{display:block;font-size:.875rem;font-weight:500;color:#374151;margin-bottom:.5rem}.form-group{margin-bottom:1.5rem}.form-input,.form-select{width:100%;padding:.625rem .875rem;font-size:.875rem;line-height:1.5;color:#111827;background:#fff;border:1px solid #d1d5db;border-radius:.375rem}.form-text{display:block;font-size:.75rem;color:#6b7280;margin-top:.375rem}.product-info-card{background:#f0f9ff;border:1px solid #3b82f6;border-radius:.375rem;padding:1rem}.product-info-card h6{font-size:.875rem;font-weight:600;color:#3b82f6;margin-bottom:.75rem}.info-row{display:flex;justify-content:space-between;align-items:center;padding:.5rem 0;border-bottom:1px solid #e0f2fe;font-size:.875rem}.info-row:last-child{border-bottom:0}.info-label{color:#6b7280;font-weight:500}.info-value{color:#111827;font-weight:600}.info-value.highlight{color:#3b82f6}.alert-summary{background:#f0fdf4;border:1px solid #86efac;border-radius:.375rem;padding:1rem;display:flex;justify-content:space-between;align-items:center}.summary-label{font-size:.875rem;font-weight:600;color:#166534}.summary-value{font-size:1.5rem;font-weight:700;color:#22c55e;background:#fff;padding:.25rem 1rem;border-radius:.25rem}.btn-submit{display:inline-block;padding:.625rem 1.5rem;font-size:.875rem;font-weight:500;color:#fff;background:#3b82f6;border:0;border-radius:.375rem;cursor:pointer}.btn-submit:hover{background:#2563eb}.btn-secondary-old{display:inline-block;padding:.625rem 1.5rem;font-size:.875rem;font-weight:500;color:#374151;background:#f3f4f6;border:1px solid #d1d5db;border-radius:.375rem;text-decoration:none}.action-buttons{display:flex;gap:.75rem;justify-content:flex-start}.error-text{display:block;font-size:.875rem;color:#dc2626;margin-top:.375rem}@media(max-width:768px){.action-buttons{flex-direction:column}.btn-submit,.btn-secondary-old{width:100%;text-align:center}}
</style>

<div class="container-fluid product-container">
    <form class="product-grid" method="post" id="importForm" action="{{ route('admin.warehouse.store') }}">
        @csrf
        <div>
            <div class="product-card">
                <h6 class="product-title">
                    <a href="{{ route('admin.warehouse') }}">Quản lý kho hàng</a>
                    / Nhập hàng vào kho
                </h6>

                @if($errors->any())
                    <div class="alert alert-danger">Vui lòng kiểm tra lại thông tin.</div>
                @endif

                <div class="form-group">
                    <label class="form-label">Chọn sản phẩm <span class="text-danger">*</span></label>
                    <select name="product_id" id="productSelect" class="form-select" required>
                        <option value="">-- Chọn sản phẩm --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->product_id }}" data-quantity="{{ $product->quantity }}" data-price="{{ $product->price }}" data-name="{{ $product->name }}" @selected(old('product_id') == $product->product_id)>
                                {{ $product->name }} (Tồn: {{ $product->quantity }})
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')<span class="error-text">{{ $message }}</span>@enderror
                </div>

                <div id="productInfo" class="form-group" style="display:none;">
                    <div class="product-info-card">
                        <h6>Thông tin sản phẩm</h6>
                        <div class="info-row"><span class="info-label">Tên sản phẩm:</span><span class="info-value" id="infoName"></span></div>
                        <div class="info-row"><span class="info-label">Tồn kho hiện tại:</span><span class="info-value highlight" id="infoQuantity">0</span></div>
                        <div class="info-row"><span class="info-label">Giá bán hiện tại:</span><span class="info-value" id="infoPrice">0đ</span></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Số lượng nhập <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" class="form-input" min="1" value="{{ old('quantity', 1) }}" required id="importQuantity" placeholder="Nhập số lượng sản phẩm">
                    <span class="form-text">Số lượng sản phẩm muốn nhập vào kho</span>
                    @error('quantity')<span class="error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Giá nhập (tùy chọn)</label>
                    <input type="number" name="import_price" class="form-input" min="0" step="1000" placeholder="Nhập giá nếu muốn cập nhật" value="{{ old('import_price') }}">
                    <span class="form-text">Nếu nhập giá mới, hệ thống sẽ cập nhật giá bán của sản phẩm</span>
                    @error('import_price')<span class="error-text">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div>
            <div class="product-card">
                <div class="form-group">
                    <label class="form-label">Tổng số lượng sau khi nhập</label>
                    <div class="alert-summary">
                        <span class="summary-label">Tổng số lượng:</span>
                        <span class="summary-value" id="totalAfter">1</span>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn-submit">Xác nhận nhập hàng</button>
                    <a href="{{ route('admin.warehouse') }}" class="btn-secondary-old">Hủy</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const productSelect=document.getElementById('productSelect');
    const productInfo=document.getElementById('productInfo');
    const infoName=document.getElementById('infoName');
    const infoQuantity=document.getElementById('infoQuantity');
    const infoPrice=document.getElementById('infoPrice');
    const importQuantity=document.getElementById('importQuantity');
    const totalAfter=document.getElementById('totalAfter');
    let currentQuantity=0;
    function updateTotal(){totalAfter.textContent=currentQuantity+(parseInt(importQuantity.value)||0);}
    function updateProductInfo(){
        const selected=productSelect.options[productSelect.selectedIndex];
        if(productSelect.value){
            currentQuantity=parseInt(selected.dataset.quantity)||0;
            infoName.textContent=selected.dataset.name;
            infoQuantity.textContent=currentQuantity;
            infoPrice.textContent=new Intl.NumberFormat('vi-VN').format(selected.dataset.price||0)+'đ';
            productInfo.style.display='block';
            updateTotal();
        }else{
            currentQuantity=0;
            productInfo.style.display='none';
            updateTotal();
        }
    }
    productSelect.addEventListener('change',updateProductInfo);
    importQuantity.addEventListener('input',updateTotal);
    updateProductInfo();
});
</script>
@endsection
