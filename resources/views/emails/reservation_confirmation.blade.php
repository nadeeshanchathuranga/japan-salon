<!doctype html>
<html>
    <body style="margin:0;padding:0;background-color:#f6f7fb;font-family:Arial,Helvetica,sans-serif;color:#222">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center" style="padding:30px 10px">
                    <table role="presentation" width="620" style="background:#ffffff;border-radius:8px;overflow:hidden" cellpadding="0" cellspacing="0">
                         
                        <tr>
                            <td style="padding:24px">
                                <h2 style="margin:0 0 8px 0;color:#111;font-size:20px">ご予約完了のお知らせ</h2>
                                <p style="margin:0 0 12px 0">{{ $reservation->name }} 様</p>

                                <p style="margin:0 0 16px 0;line-height:1.5">
                                    この度は、CHERISHにご予約いただき、誠にありがとうございます。<br>
                                    店長の平田でございます。<br>
                                    下記の内容でご予約を承りましたので、ご確認をお願いいたします。
                                </p>

                                <div style="margin:18px 0;padding:16px;background:#f8f9ff;border-radius:6px">
                                    <h3 style="margin:0 0 10px 0;font-size:16px;color:#0d6efd">ご予約内容</h3>
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;color:#333">
                                        <tr><td style="padding:4px 0"><strong>メニュー:</strong></td><td style="padding:4px 0">{{ $reservation->service ? $reservation->service->title : 'N/A' }}</td></tr>
                                        <tr><td style="padding:4px 0"><strong>ご予約日:</strong></td><td style="padding:4px 0">{{ $reservation->date }}</td></tr>
                                        <tr><td style="padding:4px 0"><strong>ご予約時間:</strong></td><td style="padding:4px 0">{{ $reservation->time }}</td></tr>
                                    </table>
                                </div>

                                <p style="margin:0 0 12px 0"><strong>【サロン所在地】</strong><br/>
                                 福岡市南区大橋1-4-6 フォクスビルディング603号室
                                </p>

                                 <p style="margin:0 0 12px 0"><strong>【当日のお願い】</strong><br/>
                                 ・5分前を目安にお越しください。<br/>
                                 ・体調やご不安な点があれば、いつでもお気軽にお知らせください。<br/>
                                 ・駐車場はございません。マンション裏手にコインパーキングがございます。
                                </p>

                                <p style="margin:0 0 12px 0"><strong>【キャンセル・変更】</strong><br/>
                                 ご予約の変更やキャンセルがある場合は、前日までにご連絡いただけますと幸いです。
                                </p>

                                <p style="margin:0 0 12px 0">心も身体もゆるめていただけるよう、丁寧にご案内いたします。<br/>
                                当日お会いできますことを、心より楽しみにしております。</p>
                                <br/>
                                <p style="margin:14px 0 0 0;color:#666"><strong>CHERISH −チェリッシュ−</strong><br>平田 路乃</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
