<?php

function buildInquiryEmailTemplate($data)
{
    return '
    <div style="font-family: Arial, sans-serif; background:#f4f6f9; padding:30px;">
        <div style="max-width:700px;margin:auto;background:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,0.08)">
            
            <!-- Header -->
            <div style="background:linear-gradient(135deg,#ff7a18,#ffb347);padding:25px;text-align:center;color:#fff;">
                <h1 style="margin:0;font-size:26px;">🍽️ New Event Inquiry</h1>
                <p style="margin:8px 0 0;font-size:14px;">BabuMosshaii Kitchen & Caterers</p>
            </div>

            <!-- Body -->
            <div style="padding:25px;">
                
                <!-- Confirmation Message -->
                <div style="background:#e9f8f1;border-left:5px solid #2ecc71;padding:14px;border-radius:8px;margin-bottom:20px;">
                    <p style="margin:0;color:#1e7e34;font-size:14px;">
                        ✅ Thank you for your inquiry! <br>
                        <b>We will get back to you soon.</b> Our team will contact you shortly to discuss your event.
                    </p>
                </div>

                <p style="font-size:15px;color:#444;">
                    A new event inquiry has been submitted. Here are the details:
                </p>

                <table style="width:100%;border-collapse:collapse;font-size:14px;">
                    <tr><td style="padding:10px;border-bottom:1px solid #eee;"><b>👤 Name</b></td><td style="padding:10px;border-bottom:1px solid #eee;">' . $data['name'] . '</td></tr>
                    <tr><td style="padding:10px;border-bottom:1px solid #eee;"><b>📞 Contact</b></td><td style="padding:10px;border-bottom:1px solid #eee;">' . $data['number'] . '</td></tr>
                    <tr><td style="padding:10px;border-bottom:1px solid #eee;"><b>📧 Email</b></td><td style="padding:10px;border-bottom:1px solid #eee;">' . $data['email'] . '</td></tr>
                    <tr><td style="padding:10px;border-bottom:1px solid #eee;"><b>👥 Guests</b></td><td style="padding:10px;border-bottom:1px solid #eee;">' . $data['heads'] . '</td></tr>
                    <tr><td style="padding:10px;border-bottom:1px solid #eee;"><b>🎉 Event Type</b></td><td style="padding:10px;border-bottom:1px solid #eee;">' . $data['event_type'] . '</td></tr>
                    <tr><td style="padding:10px;border-bottom:1px solid #eee;"><b>📍 Location</b></td><td style="padding:10px;border-bottom:1px solid #eee;">' . $data['location'] . '</td></tr>
                    <tr><td style="padding:10px;border-bottom:1px solid #eee;"><b>📅 Event Date</b></td><td style="padding:10px;border-bottom:1px solid #eee;">' . $data['event_date'] . '</td></tr>
                    <tr><td style="padding:10px;border-bottom:1px solid #eee;"><b>💰 Budget</b></td><td style="padding:10px;border-bottom:1px solid #eee;">' . $data['budget'] . '</td></tr>
                </table>

                <!-- Menu -->
                <div style="margin-top:20px;">
                    <h3 style="margin-bottom:8px;color:#333;">📜 Menu Preferences</h3>
                    <div style="background:#f8f9fb;padding:12px;border-radius:8px;color:#444;font-size:14px;">
                        ' . nl2br($data['menu_text']) . '
                    </div>
                </div>

                <!-- Notes -->
                <div style="margin-top:20px;">
                    <h3 style="margin-bottom:8px;color:#333;">📝 Additional Notes</h3>
                    <div style="background:#f8f9fb;padding:12px;border-radius:8px;color:#444;font-size:14px;">
                        ' . nl2br($data['notes']) . '
                    </div>
                </div>

                <!-- CTA -->
                <div style="margin-top:25px;text-align:center;">
                    <a href="tel:' . $data['number'] . '" 
                       style="display:inline-block;padding:12px 22px;background:#ff7a18;color:#fff;
                              text-decoration:none;border-radius:25px;font-size:14px;">
                        📞 Contact Client
                    </a>
                </div>

            </div>

            <!-- Footer -->
            <div style="background:#f1f1f1;padding:15px;text-align:center;font-size:12px;color:#666;">
                © ' . date('Y') . ' BabuMosshaii Kitchen & Caterers <br>
                Taste • Trust • Tradition
            </div>

        </div>
    </div>
    ';
}
