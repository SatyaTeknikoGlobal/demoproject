
<?php
$company_logo_url = asset('public/images/logo.png');

$COMPANY_LOGO_URL = CustomHelper::WebsiteSettings('COMPANY_LOGO');

if(!empty($COMPANY_LOGO_URL) && file_exists(public_path('storage/settings/'.$COMPANY_LOGO_URL))){
  $company_logo_url = asset('public/storage/settings/'.$COMPANY_LOGO_URL);
}

$COMPANY_LOGO = '<a href="'.url('').'"><img src="'.$company_logo_url.'" alt="Blindwelfaresociety" height="50" /></a>';

$description = "Donate any Amount of your choice";
if(!empty($donation->payment_desc))
{
  $description = "You ".$donation->payment_desc;
}

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Blindwelfaresociety</title>
</head>
<body>
  <table style="width: 100%;max-width: 100%;margin-bottom: 20px;border: 1px solid #363b97;border-collapse: collapse;border-spacing: 0;">
  <tr>
    <td style="padding: 30px 40px;">
      <table  style="width: 100%;max-width: 100%;border-collapse: collapse;border-spacing: 0;">
        <tr>
          <td style="padding:0 30px 0px 0px;">
            <?php echo $COMPANY_LOGO; ?>
          </td>
          <td style="padding:0 0px 0px 30px; text-align: right;">
            <p style="margin-bottom: 2px; margin-top:2px;font-size: 18px;"><strong>Blind Welfare Society</strong></p>
            <p style="margin-bottom: 2px; margin-top:2px;">Plot Number-5, Block-F, Near New Police Station,<br> Nihal Vihar, New Delhi – 110041</p>
            <p style="margin-bottom: 2px; margin-top:2px;"><strong>PAN:</strong> AAATB0654R</p>
            <p style="margin-bottom: 2px; margin-top:2px;"><strong>Website:</strong> www.blindwelfaresociety.in</p>
            <p style="margin-bottom: 2px; margin-top:2px;"><strong>E-Mail:</strong> info@blindwelfaresociety.in</p>
            <p style="margin-bottom: 2px; margin-top:2px;"><strong>Contact Numbers:</strong> +91-9968969932, +91-9599226427</p>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 8px 0px;"></td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 30px 40px;background: #dceef9;border-radius: 5px;">
            <p style="font-size: 22px;color: #00465f;font-weight: 600; text-align: center;margin-bottom: 15px;">Receipt of Donation</p>
            <ul style="list-style: none;padding: 0px;">
              <li style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">Donor’s Name : <span style="font-weight: 500;"><?php echo $first_name." ".$last_name; ?></span></li>
              <li style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">E-Mail : <span style="font-weight: 500;"><?php echo $email; ?></span></li>
              <!-- <li style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">PAN : <span style="font-weight: 500;"><?php if($pan_card !='')echo $pan_card;?></span></li> -->
              <li style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">Receipt No : <span style="font-weight: 500;"><?php echo 'BWF'.$id;?></span></li>
              <li style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">Description :  <span style="font-weight: 500;"><?php echo $description?></span></li>
              <li style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">Transaction ID :  <span style="font-weight: 500;"><?php echo $transaction_id?></span></li>
              <li style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">Payment Method :  <span style="font-weight: 500;"><?php echo $payment_option; ?></span></li>
              <li style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">Donation Amount :  <span style="font-weight: 500;"><?php echo $donation_amount; ?></span></li>
              <li style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">Date of Donation :  <span style="font-weight: 500;"><?php $date =  strtotime($created_at);echo date('Y/m/d', $date); ?></span></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 8px 0px;"></td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 30px 0px;">
            <p>
              Donations made to Blind Welfare Society are exempted under section 80G of Indian Income Tax Act, 1961.
            </p>
            <p>
              <strong>Note:</strong> This is computer generated receipt and requires no signature.
            </p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>