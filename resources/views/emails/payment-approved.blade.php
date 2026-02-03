<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم قبول طلبك - منصة طالب</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.8;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .header .logo {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px;
        }
        .success-icon {
            text-align: center;
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .greeting {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .message h2 {
            color: #155724;
            margin-top: 0;
            font-size: 18px;
        }
        .message p {
            color: #155724;
            margin-bottom: 0;
        }
        .details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .details h3 {
            margin-top: 0;
            color: #495057;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .details-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .details-row:last-child {
            border-bottom: none;
        }
        .details-label {
            font-weight: bold;
            color: #495057;
        }
        .details-value {
            color: #212529;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
        .social-links {
            margin-top: 15px;
        }
        .social-links a {
            margin: 0 10px;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">📚</div>
            <h1>منصة طالب</h1>
        </div>
        
        <div class="content">
            <div class="success-icon">✅</div>
            
            <p class="greeting">مرحباً {{ $user->name }}،</p>
            
            <div class="message">
                <h2>🎉 تم قبول طلبك بنجاح!</h2>
                <p>يسعدنا إبلاغك بأنه تم التحقق من دفعتك الإلكترونية والموافقة على طلب تسجيلك تلقائياً. حسابك نشط الآن ويمكنك البدء باستخدام جميع ميزات المنصة.</p>
            </div>
            
            <div class="details">
                <h3>تفاصيل الاشتراك</h3>
                <div class="details-row">
                    <span class="details-label">نوع الحساب:</span>
                    <span class="details-value">
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
                        {{ $typeLabels[$subscription->type] ?? $subscription->type }}
                    </span>
                </div>
                <div class="details-row">
                    <span class="details-label">المبلغ المدفوع:</span>
                    <span class="details-value">{{ $subscription->amount }} دينار</span>
                </div>
                <div class="details-row">
                    <span class="details-label">طريقة الدفع:</span>
                    <span class="details-value">
                        @if($subscription->payment_method === 'card')
                            بطاقة ائتمان/خصم (فيزا)
                        @elseif($subscription->payment_method === 'paypal')
                            باي بال
                        @else
                            {{ $subscription->payment_method }}
                        @endif
                    </span>
                </div>
                <div class="details-row">
                    <span class="details-label">رقم المرجع:</span>
                    <span class="details-value">{{ $subscription->payment_reference }}</span>
                </div>
                <div class="details-row">
                    <span class="details-label">تاريخ الدفع:</span>
                    <span class="details-value">{{ $subscription->paid_at ? $subscription->paid_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i') }}</span>
                </div>
            </div>
            
            <div class="button-container">
                <a href="{{ route('dashboard') }}" class="button">الذهاب إلى لوحة التحكم</a>
            </div>
            
            <p>إذا كانت لديك أي أسئلة أو استفسارات، لا تتردد في التواصل مع فريق الدعم.</p>
            
            <p>مع أطيب التحيات،<br>فريق منصة طالب</p>
        </div>
        
        <div class="footer">
            <p>هذا البريد الإلكتروني تم إرساله تلقائياً من منصة طالب.</p>
            <p>© {{ date('Y') }} منصة طالب - جميع الحقوق محفوظة</p>
            <div class="social-links">
                <a href="mailto:support@talib.live">📧 الدعم الفني</a>
                <a href="https://talib.live">🌐 الموقع</a>
            </div>
        </div>
    </div>
</body>
</html>
