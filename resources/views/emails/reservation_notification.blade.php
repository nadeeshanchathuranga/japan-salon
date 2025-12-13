<!doctype html>
<html>
    <body style="margin:0;padding:0;background-color:#f6f7fb;font-family:Arial,Helvetica,sans-serif;color:#222">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center" style="padding:30px 10px">
                    <table role="presentation" width="620" style="background:#ffffff;border-radius:8px;overflow:hidden" cellpadding="0" cellspacing="0">
                        
                        <tr>
                            <td style="padding:24px">
                                <h2 style="margin:0 0 8px 0;color:#111;font-size:20px">新しいご予約が入りました</h2>
                                <p style="margin:0 0 12px 0">以下の内容で新規予約が行われましたのでご確認ください。</p>

                                <div style="margin:18px 0;padding:16px;background:#fff6f6;border-radius:6px">
                                    <h3 style="margin:0 0 10px 0;font-size:16px;color:#d63333">お客様情報</h3>
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;color:#333">
                                        <tr><td style="padding:4px 0"><strong>お名前:</strong></td><td style="padding:4px 0">{{ $reservation->name }}</td></tr>
                                        <tr><td style="padding:4px 0"><strong>メールアドレス:</strong></td><td style="padding:4px 0">{{ $reservation->email ?? 'なし' }}</td></tr>
                                        <tr><td style="padding:4px 0"><strong>電話番号:</strong></td><td style="padding:4px 0">{{ $reservation->phone }}</td></tr>
                                    </table>
                                </div>

                                <div style="margin:8px 0 0 0;padding:16px;background:#f8f9ff;border-radius:6px">
                                    <h3 style="margin:0 0 10px 0;font-size:16px;color:#0d6efd">ご予約内容</h3>
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;color:#333">
                                        <tr><td style="padding:4px 0"><strong>ご予約日:</strong></td><td style="padding:4px 0">{{ $reservation->date }}</td></tr>
                                        <tr><td style="padding:4px 0"><strong>ご予約時間:</strong></td><td style="padding:4px 0">{{ $reservation->time }}</td></tr>
                                        <tr><td style="padding:4px 0"><strong>コース:</strong></td><td style="padding:4px 0">{{ $reservation->service ? $reservation->service->title : 'N/A' }}</td></tr>
                                        <tr><td style="padding:4px 0"><strong>ご要望:</strong></td><td style="padding:4px 0">{{ $reservation->other_request ?? '特になし' }}</td></tr>
                                    </table>
                                </div>

                                <p style="margin:16px 0 0 0">ご確認のほどよろしくお願いいたします。<br><strong>CHERISH 福岡店</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#f1f3ff;padding:12px 24px;text-align:center;color:#666;font-size:12px">
                                〒815-0033 福岡県福岡市南区大橋1-4-6 フォックスビルディング603号
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
