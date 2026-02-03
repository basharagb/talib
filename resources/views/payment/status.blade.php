@extends('layouts.dashboard')

@section('content')
    <div class="container py-5" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-gradient text-white text-center py-4"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <h3 class="mb-0">
                            <i class="bi bi-receipt ms-2"></i>
                            حالة التسجيل والدفع
                        </h3>
                    </div>

                    <div class="card-body p-5">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle ms-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('info'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="bi bi-info-circle ms-2"></i>
                                {{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- حالة التسجيل -->
                        <div class="mb-5">
                            <h4 class="border-bottom pb-3 mb-4">
                                <i class="bi bi-person-check ms-2 text-primary"></i>
                                حالة التسجيل
                            </h4>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <div class="flex-shrink-0">
                                            @if($subscription->user->status === 'active')
                                                <div class="bg-success text-white rounded-circle p-3">
                                                    <i class="bi bi-check-lg fs-4"></i>
                                                </div>
                                            @elseif($subscription->user->status === 'pending')
                                                <div class="bg-warning text-white rounded-circle p-3">
                                                    <i class="bi bi-clock fs-4"></i>
                                                </div>
                                            @else
                                                <div class="bg-secondary text-white rounded-circle p-3">
                                                    <i class="bi bi-hourglass fs-4"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 me-3">
                                            <h6 class="mb-1">حالة الحساب</h6>
                                            <p class="mb-0">
                                                @if($subscription->user->status === 'active')
                                                    <span class="badge bg-success">نشط</span>
                                                @elseif($subscription->user->status === 'pending')
                                                    <span class="badge bg-warning">بانتظار الموافقة</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $subscription->user->status }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <div class="flex-shrink-0">
                                            <div class="bg-info text-white rounded-circle p-3">
                                                <i class="bi bi-person-badge fs-4"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 me-3">
                                            <h6 class="mb-1">نوع الحساب</h6>
                                            <p class="mb-0">
                                                @php
                                                    $typeLabels = [
                                                        'teacher' => 'معلم/معلمة',
                                                        'educational_center' => 'مركز تعليمي',
                                                        'school' => 'مدرسة خاصة',
                                                        'kindergarten' => 'روضة أطفال',
                                                        'nursery' => 'حضانة',
                                                        'student' => 'طالب'
                                                    ];
                                                @endphp
                                                <span
                                                    class="badge bg-info">{{ $typeLabels[$subscription->type] ?? $subscription->type }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- حالة الدفع -->
                        <div class="mb-5">
                            <h4 class="border-bottom pb-3 mb-4">
                                <i class="bi bi-credit-card ms-2 text-primary"></i>
                                حالة الدفع
                            </h4>

                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="text-center p-4 bg-light rounded">
                                        <div class="mb-3">
                                            <i class="bi bi-currency-dollar text-success" style="font-size: 3rem;"></i>
                                        </div>
                                        <h6>المبلغ</h6>
                                        <p class="mb-0">
                                            <strong class="text-success fs-5">{{ $subscription->amount }} دينار</strong>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="text-center p-4 bg-light rounded">
                                        <div class="mb-3">
                                            <i class="bi bi-wallet2 text-primary" style="font-size: 3rem;"></i>
                                        </div>
                                        <h6>طريقة الدفع</h6>
                                        <p class="mb-0">
                                            @if($subscription->payment_method)
                                                @if($subscription->payment_method === 'card')
                                                    <span class="badge bg-primary">بطاقة ائتمان/خصم (فيزا)</span>
                                                @elseif($subscription->payment_method === 'cash')
                                                    <span class="badge bg-success">نقداً (كاش)</span>
                                                @elseif($subscription->payment_method === 'bank_transfer')
                                                    <span class="badge bg-info">تحويل بنكي</span>
                                                @elseif($subscription->payment_method === 'paypal')
                                                    <span class="badge bg-warning">باي بال</span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary">لم يتم الاختيار</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="text-center p-4 bg-light rounded">
                                        <div class="mb-3">
                                            @if($subscription->payment_status === 'paid')
                                                <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                                            @elseif($subscription->payment_status === 'pending')
                                                <i class="bi bi-hourglass-split text-warning" style="font-size: 3rem;"></i>
                                            @elseif($subscription->payment_status === 'failed')
                                                <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
                                            @else
                                                <i class="bi bi-question-circle text-secondary" style="font-size: 3rem;"></i>
                                            @endif
                                        </div>
                                        <h6>حالة الدفع</h6>
                                        <p class="mb-0">
                                            @if($subscription->payment_status === 'paid')
                                                <span class="badge bg-success">مدفوع</span>
                                            @elseif($subscription->payment_status === 'pending')
                                                <span class="badge bg-warning">معلق</span>
                                            @elseif($subscription->payment_status === 'failed')
                                                <span class="badge bg-danger">فشل</span>
                                            @else
                                                <span class="badge bg-secondary">غير مدفوع</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($subscription->payment_reference)
                                <div class="alert alert-info mt-4">
                                    <strong>رقم مرجع الدفع:</strong> {{ $subscription->payment_reference }}
                                </div>
                            @endif

                            @if($subscription->paid_at)
                                <div class="alert alert-success mt-4">
                                    <i class="bi bi-calendar-check ms-2"></i>
                                    <strong>تاريخ الدفع:</strong> {{ $subscription->paid_at->format('Y-m-d H:i') }}
                                </div>
                            @endif
                        </div>

                        <!-- خيارات الدفع - تظهر فقط إذا لم يتم اختيار طريقة دفع -->
                        @if(!$subscription->payment_method || $subscription->payment_status === 'failed')
                            <div class="mb-5">
                                <h4 class="border-bottom pb-3 mb-4">
                                    <i class="bi bi-credit-card-2-front ms-2 text-primary"></i>
                                    اختر طريقة الدفع
                                </h4>

                                <form method="POST" action="{{ route('payment.process', $subscription) }}" id="payment-form"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row g-4">
                                        <!-- الدفع بالفيزا -->
                                        <div class="col-md-6">
                                            <label
                                                class="payment-option-card d-block p-4 border-2 rounded-3 cursor-pointer h-100"
                                                style="cursor: pointer;">
                                                <input type="radio" name="payment_method" value="card"
                                                    class="d-none payment-method-radio">
                                                <div class="text-center">
                                                    <div class="mb-3">
                                                        <i class="bi bi-credit-card text-primary" style="font-size: 3rem;"></i>
                                                    </div>
                                                    <h5 class="mb-2">بطاقة ائتمان/خصم (فيزا)</h5>
                                                    <p class="text-muted small mb-2">الدفع الإلكتروني الآمن</p>
                                                    <span class="badge bg-success">قبول فوري تلقائي</span>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- التحويل البنكي -->
                                        <div class="col-md-6">
                                            <label
                                                class="payment-option-card d-block p-4 border-2 rounded-3 cursor-pointer h-100"
                                                style="cursor: pointer;">
                                                <input type="radio" name="payment_method" value="bank_transfer"
                                                    class="d-none payment-method-radio">
                                                <div class="text-center">
                                                    <div class="mb-3">
                                                        <i class="bi bi-bank text-info" style="font-size: 3rem;"></i>
                                                    </div>
                                                    <h5 class="mb-2">تحويل بنكي</h5>
                                                    <p class="text-muted small mb-2">التحويل من حسابك البنكي</p>
                                                    <span class="badge bg-warning text-dark">يتطلب موافقة الإدارة</span>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- الدفع نقداً -->
                                        <div class="col-md-6">
                                            <label
                                                class="payment-option-card d-block p-4 border-2 rounded-3 cursor-pointer h-100"
                                                style="cursor: pointer;">
                                                <input type="radio" name="payment_method" value="cash"
                                                    class="d-none payment-method-radio">
                                                <div class="text-center">
                                                    <div class="mb-3">
                                                        <i class="bi bi-cash-stack text-success" style="font-size: 3rem;"></i>
                                                    </div>
                                                    <h5 class="mb-2">الدفع نقداً (كاش)</h5>
                                                    <p class="text-muted small mb-2">الدفع في مكتبنا</p>
                                                    <span class="badge bg-warning text-dark">يتطلب موافقة الإدارة</span>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- باي بال -->
                                        <div class="col-md-6">
                                            <label
                                                class="payment-option-card d-block p-4 border-2 rounded-3 cursor-pointer h-100"
                                                style="cursor: pointer;">
                                                <input type="radio" name="payment_method" value="paypal"
                                                    class="d-none payment-method-radio">
                                                <div class="text-center">
                                                    <div class="mb-3">
                                                        <i class="bi bi-paypal text-primary" style="font-size: 3rem;"></i>
                                                    </div>
                                                    <h5 class="mb-2">باي بال</h5>
                                                    <p class="text-muted small mb-2">الدفع عبر حساب باي بال</p>
                                                    <span class="badge bg-success">قبول فوري تلقائي</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- تفاصيل بطاقة الائتمان -->
                                    <div id="credit-card-details" class="mt-4 p-4 bg-light rounded-3 d-none">
                                        <h5 class="mb-4"><i class="bi bi-credit-card ms-2"></i>بيانات البطاقة</h5>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">اسم حامل البطاقة <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="card_holder_name" class="form-control"
                                                    placeholder="الاسم كما يظهر على البطاقة">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">رقم البطاقة <span class="text-danger">*</span></label>
                                                <input type="text" name="card_number" id="card_number" class="form-control"
                                                    placeholder="1234 5678 9012 3456" maxlength="19">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">تاريخ الانتهاء <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="card_expiry" id="card_expiry" class="form-control"
                                                    placeholder="MM/YY" maxlength="5">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">رمز CVV <span class="text-danger">*</span></label>
                                                <input type="text" name="card_cvv" id="card_cvv" class="form-control"
                                                    placeholder="123" maxlength="4">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- تفاصيل التحويل البنكي -->
                                    <div id="bank-transfer-details" class="mt-4 p-4 bg-light rounded-3 d-none">
                                        <h5 class="mb-4"><i class="bi bi-bank ms-2"></i>معلومات الحساب البنكي</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="p-3 bg-white rounded border">
                                                    <strong>اسم البنك:</strong>
                                                    <p class="mb-0">البنك الأردني</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="p-3 bg-white rounded border">
                                                    <strong>رقم الحساب:</strong>
                                                    <p class="mb-0 font-monospace">123456789</p>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="p-3 bg-white rounded border">
                                                    <strong>رقم IBAN:</strong>
                                                    <p class="mb-0 font-monospace">JO12 BANK 1234 5678 9012 3456 78</p>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="p-3 bg-white rounded border">
                                                    <strong>رقم المرجع (يجب ذكره في التحويل):</strong>
                                                    <p class="mb-0 text-primary fw-bold">{{ $subscription->id }}</p>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">رفع إيصال التحويل (اختياري)</label>
                                                <input type="file" name="transfer_receipt" class="form-control"
                                                    accept=".jpg,.jpeg,.png,.pdf">
                                                <small class="text-muted">الصيغ المقبولة: JPG, PNG, PDF (الحد الأقصى: 5
                                                    ميجابايت)</small>
                                            </div>
                                        </div>
                                        <div class="alert alert-warning mt-3 mb-0">
                                            <i class="bi bi-exclamation-triangle ms-2"></i>
                                            يرجى تضمين رقم المرجع في الحوالة. سيتم تفعيل حسابك بعد مراجعة الإدارة للتحويل.
                                        </div>
                                    </div>

                                    <!-- تفاصيل الدفع النقدي -->
                                    <div id="cash-details" class="mt-4 p-4 bg-light rounded-3 d-none">
                                        <h5 class="mb-4"><i class="bi bi-cash-stack ms-2"></i>معلومات الدفع النقدي</h5>
                                        <div class="alert alert-info mb-3">
                                            <h6 class="alert-heading"><i class="bi bi-geo-alt ms-2"></i>عنوان المكتب</h6>
                                            <p class="mb-0">عمان - شارع المدينة المنورة - مجمع الأعمال - الطابق الثاني</p>
                                        </div>
                                        <div class="alert alert-info mb-3">
                                            <h6 class="alert-heading"><i class="bi bi-clock ms-2"></i>أوقات العمل</h6>
                                            <p class="mb-0">الأحد - الخميس: 9:00 صباحاً - 5:00 مساءً</p>
                                        </div>
                                        <div class="alert alert-info mb-0">
                                            <h6 class="alert-heading"><i class="bi bi-telephone ms-2"></i>للتواصل</h6>
                                            <p class="mb-0">+962 6 123 4567</p>
                                        </div>
                                        <div class="alert alert-warning mt-3 mb-0">
                                            <i class="bi bi-exclamation-triangle ms-2"></i>
                                            سيتم تفعيل حسابك بعد استلام المبلغ ومراجعة الإدارة.
                                        </div>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger mt-4">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg px-5" id="submit-payment-btn"
                                            disabled>
                                            <i class="bi bi-check-circle ms-2"></i>
                                            تأكيد طريقة الدفع
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <!-- رسالة انتظار موافقة الإدارة -->
                        @if($subscription->payment_status === 'pending' && in_array($subscription->payment_method, ['cash', 'bank_transfer']))
                            <div class="alert alert-warning border-0 shadow-sm">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill fs-3 ms-3"></i>
                                    <div>
                                        <h5 class="alert-heading mb-2">بانتظار موافقة الإدارة</h5>
                                        <p class="mb-0">
                                            يتم مراجعة طلب الدفع الخاص بك من قبل فريق الإدارة. ستتلقى إشعاراً على بريدك
                                            الإلكتروني عند الموافقة على الدفع وتفعيل حسابك.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- رسالة القبول التلقائي -->
                        @if($subscription->auto_approved)
                            <div class="alert alert-success border-0 shadow-sm">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-shield-check fs-3 ms-3"></i>
                                    <div>
                                        <h5 class="alert-heading mb-2">تم قبول طلبك تلقائياً</h5>
                                        <p class="mb-0">
                                            تم التحقق من دفعتك الإلكترونية والموافقة عليها تلقائياً. حسابك نشط الآن! تم إرسال
                                            رسالة تأكيد إلى بريدك الإلكتروني.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- معلومات المستخدم المسجلة - تظهر بعد القبول -->
                        @if($subscription->status === 'active' || $subscription->auto_approved)
                            <div class="mb-5">
                                <h4 class="border-bottom pb-3 mb-4">
                                    <i class="bi bi-person-lines-fill ms-2 text-primary"></i>
                                    معلوماتك المسجلة
                                </h4>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded">
                                            <strong>الاسم:</strong>
                                            <p class="mb-0">{{ $subscription->user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded">
                                            <strong>البريد الإلكتروني:</strong>
                                            <p class="mb-0">{{ $subscription->user->email }}</p>
                                        </div>
                                    </div>
                                    @if($subscription->user->phone)
                                        <div class="col-md-6">
                                            <div class="p-3 bg-light rounded">
                                                <strong>رقم الهاتف:</strong>
                                                <p class="mb-0">{{ $subscription->user->phone }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if($subscription->user->country)
                                        <div class="col-md-6">
                                            <div class="p-3 bg-light rounded">
                                                <strong>الدولة:</strong>
                                                <p class="mb-0">
                                                    {{ $subscription->user->country->name_ar ?? $subscription->user->country->name }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="text-center mt-4">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil-square ms-2"></i>
                                        تعديل المعلومات
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- أزرار الإجراءات -->
                        <div class="text-center mt-5">
                            @if($subscription->status === 'active')
                                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-house-door ms-2"></i>
                                    الذهاب إلى لوحة التحكم
                                </a>
                            @else
                                <a href="{{ route('home') }}" class="btn btn-secondary btn-lg px-5">
                                    <i class="bi bi-arrow-right ms-2"></i>
                                    العودة للرئيسية
                                </a>
                            @endif
                        </div>

                        <!-- ملاحظات الدفع -->
                        @if($subscription->payment_notes)
                            <div class="mt-4">
                                <h6 class="text-muted">ملاحظات:</h6>
                                <p class="text-muted small">{{ $subscription->payment_notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- قسم المساعدة -->
                <div class="card mt-4 border-0 shadow-sm">
                    <div class="card-body text-center py-4">
                        <h5 class="mb-3">تحتاج مساعدة؟</h5>
                        <p class="text-muted mb-3">
                            إذا كانت لديك أي أسئلة حول تسجيلك أو الدفع، يرجى التواصل مع فريق الدعم.
                        </p>
                        <a href="mailto:support@talib.live" class="btn btn-outline-primary">
                            <i class="bi bi-envelope ms-2"></i>
                            تواصل مع الدعم
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .payment-option-card {
            border: 2px solid #dee2e6 !important;
            transition: all 0.3s ease;
        }

        .payment-option-card:hover {
            border-color: #667eea !important;
            background-color: #f8f9ff;
        }

        .payment-option-card.selected {
            border-color: #667eea !important;
            background-color: #f0f3ff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethods = document.querySelectorAll('.payment-method-radio');
            const creditCardDetails = document.getElementById('credit-card-details');
            const bankTransferDetails = document.getElementById('bank-transfer-details');
            const cashDetails = document.getElementById('cash-details');
            const submitBtn = document.getElementById('submit-payment-btn');
            const paymentCards = document.querySelectorAll('.payment-option-card');

            paymentMethods.forEach(function (method) {
                method.addEventListener('change', function () {
                    // إزالة التحديد من جميع البطاقات
                    paymentCards.forEach(card => card.classList.remove('selected'));

                    // تحديد البطاقة الحالية
                    this.closest('.payment-option-card').classList.add('selected');

                    // إخفاء جميع التفاصيل
                    if (creditCardDetails) creditCardDetails.classList.add('d-none');
                    if (bankTransferDetails) bankTransferDetails.classList.add('d-none');
                    if (cashDetails) cashDetails.classList.add('d-none');

                    // إظهار التفاصيل المناسبة
                    if (this.value === 'card') {
                        if (creditCardDetails) creditCardDetails.classList.remove('d-none');
                    } else if (this.value === 'bank_transfer') {
                        if (bankTransferDetails) bankTransferDetails.classList.remove('d-none');
                    } else if (this.value === 'cash') {
                        if (cashDetails) cashDetails.classList.remove('d-none');
                    }

                    // تفعيل زر الإرسال
                    if (submitBtn) submitBtn.disabled = false;
                });
            });

            // تنسيق رقم البطاقة
            const cardNumberInput = document.getElementById('card_number');
            if (cardNumberInput) {
                cardNumberInput.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
                    let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                    e.target.value = formattedValue;
                });
            }

            // تنسيق تاريخ الانتهاء
            const cardExpiryInput = document.getElementById('card_expiry');
            if (cardExpiryInput) {
                cardExpiryInput.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length >= 2) {
                        value = value.substring(0, 2) + '/' + value.substring(2, 4);
                    }
                    e.target.value = value;
                });
            }

            // تنسيق CVV
            const cardCvvInput = document.getElementById('card_cvv');
            if (cardCvvInput) {
                cardCvvInput.addEventListener('input', function (e) {
                    e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
                });
            }
        });
    </script>
@endsection