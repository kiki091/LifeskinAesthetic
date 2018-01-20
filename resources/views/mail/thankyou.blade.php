<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" lang="en">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>The Lifesky Clinic</title>
    <meta name="author" content="The Lifesky Clinic">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- css -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,800" rel="stylesheet">
    <style type="text/css">
        .text_center {
          text-align: center;
        }
        .text_left {
          text-align: left;
        }
        .text_upper {
          text-transform: uppercase;
          font-size: 12px;
        }
        .th_number {
                padding: 10px;
                background: #353535;
                color: #fff;
                font-size: 12px;
                width: 2%;
        }
        .th_email {
                padding: 10px;
                background: #353535;
                color: #fff;
                font-size: 12px;
                width: 10%;
        }
    </style>
  </head>
  <body id="body" style="margin:0;padding:0;color:#7C8495;font-family:'Open Sans', sans-serif;">
    <table cellpadding="0" cellspacing="0" align="center" style="width: 100%;">
      <tr>
        <td>
          <table cellpadding="0" cellspacing="0" align="center" class="container" style="background-color:#F0F0F0;width: 768px !important;">
            <tr>
              <td class="body">
                <table cellpadding="0" cellspacing="0" style="width: 100%;">
                  <tr>
                    <td align="left" valign="top" class="bar" style="background-repeat-x:no-repeat !important;background-image: url(http://image.ibb.co/hUjH15/bg_repeat.png);background-position: right;">
                    </td>

                    <!-- CONTENT -->
                    <td class="content" align="center" style="background-color:#fff;padding:25px 10px;border:0px;outline:0;width:542px !important;">
                      <h1 class="title" style="margin:0 0 8px;font-weight:normal;font-size:24px;color:#C4A57B;letter-spacing:2.4px;line-height:31px;">BOOKING INFORMATION</h1>
                      <br>
                      <p class="desc" style="font-size:14px;color:#7C8495;letter-spacing:0.8px;line-height:27px;">
                        Thank you for your trust in choosing our package service, here is the detail of your booking information with registration number <b>{{ $data['registrasi_id'] }}</b> for date <b>{{ $data['date'] }}</b> </p>
                      <br>
                      <h4 class="text_upper text_left">List User Booking for  {{ $data['date'] }} </h4>
                      <table>
                          <tr>
                              <th class="th_number">Number</th>
                              <th class="th_email">Fullname</th>
                              <th class="th_email">Email</th>
                              <th class="th_email">Booking Date</th>
                          </tr>
                          @php
                            $i = 1;
                          @endphp
                          @foreach($data['user_avability'] as $key=> $user_avability)
                          <tr>
                              <td class="text_center">{{ $i++ }}</td>
                              <td>
                                {{ $user_avability['member']['first_name'] }}
                                {{ $user_avability['member']['last_name'] }}
                              </td>
                              <td>{{ $user_avability['member']['email'] }}</td>
                              <td>{{ $user_avability['member']['phone_number'] }}</td>
                          </tr>
                          @endforeach
                      </table>
                    </td>
                    <!-- END CONTENT -->

                    <td align="right" valign="top" class="bar" style="background-repeat-x:no-repeat !important;background-image: url(http://image.ibb.co/bAMVM5/bg_repeat_right.png);background-position: left;">
                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0" style="width: 100%;">
                  <tr>
                    <td align="left" valign="bottom" class="bar" style="background-repeat-x:no-repeat !important;background-image: url(http://image.ibb.co/hUjH15/bg_repeat.png);background-position: right;">
                    </td>
                    <td class="content" align="center" style="background-color:#fff;padding:25px 10px;border:0px;outline:0;width:542px !important;border-top:1px solid #E0E0E0;">
                      <p class="desc" style="font-size:14px;color:#7C8495;letter-spacing:0.8px;line-height:27px;margin:0;">
                        Call Us <br>
                        <b style="font-weight:800; line-height:24px; font-size:18px; color:#2C3956 !important;"><a href="tel:(+6221)%20573.7777" style="color:#2C3956 !important; text-decoration: none;">{{ $data['contact_us'] }}</a></b>
                      </p>
                    </td>
                    <td align="right" valign="bottom" class="bar" style="background-repeat-x:no-repeat !important;background-image: url(http://image.ibb.co/bAMVM5/bg_repeat_right.png);background-position: left;">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td class="footer" align="center" style="padding:30px;">
                <table cellpadding="0" cellspacing="0" class="socmed" style="padding:0 0 20px;">
                  <tr>
                    <td style="padding:0 5px;">

                    </td>
                    <td style="padding:0 5px;">

                    </td>
                  </tr>
                </table>
                <p class="about" style="font-family:'Helvetica', 'Arial', sans-serif;color:#999999;letter-spacing:0;line-height:19px;margin:0;font-size:13px;"></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>


